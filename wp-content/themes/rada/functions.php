<?php

	/*function my_scripts_method() {
		wp_deregister_script( 'jquery' );
	}
	add_action( 'wp_enqueue_scripts', 'my_scripts_method' ); */


	add_action('after_setup_theme', function(){
		register_nav_menus( array(
			'header_menu' => 'Меню в шапке',
		) );
	});
	
	add_theme_support('menus');
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'slider-image', 720, 480, true );
	add_image_size( 'category-thumbnails', 56, 56 );

	register_sidebar(
		array(
			'id' => 'sideright', // уникальный id
			'name' => 'Боковая колонка', // название сайдбара
			'description' => 'Перетащите сюда виджеты, чтобы добавить их в сайдбар.', // описание
			'before_widget' => '<div id="%1$s" class="side widget %2$s">', // по умолчанию виджеты выводятся <li>-списком
			'after_widget' => '</div>'
		)
	);

	register_sidebar(
		array(
			'id' => 'topbutton', // уникальный id
			'name' => 'Версия для слабовидящих', // название сайдбара
			'description' => 'Перетащите сюда виджеты, чтобы добавить их в сайдбар.', // описание
			'before_widget' => '<div id="%1$s" class="side widget %2$s">', // по умолчанию виджеты выводятся <li>-списком
			'after_widget' => '</div>'
		)
	);

	/* Пошук */

	function __search_by_title_only( $search, &$wp_query )
	{
		 global $wpdb;
		 if ( empty( $search ) )
		 return $search; // skip processing - no search term in query
		 $q = $wp_query->query_vars;
		 $n = ! empty( $q['exact'] ) ? '' : '%';
		 $search =
		 $searchand = '';
		 foreach ( (array) $q['search_terms'] as $term ) {
		 $term = esc_sql( like_escape( $term ) );
		 $search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
		 $searchand = ' AND ';
		 }
		 if ( ! empty( $search ) ) {
		 $search = " AND ({$search}) ";
		 if ( ! is_user_logged_in() )
		 $search .= " AND ($wpdb->posts.post_password = '') ";
		 }
		 return $search;
	}
	
	add_filter( 'posts_search', '__search_by_title_only', 500, 2 );

	/**
	 * Хлебные крошки для WordPress (breadcrumbs)
	 *
	 * @param  string [$sep  = '']      Разделитель. По умолчанию ' » '
	 * @param  array  [$l10n = array()] Для локализации. См. переменную $default_l10n.
	 * @param  array  [$args = array()] Опции. См. переменную $def_args
	 * @return string Выводит на экран HTML код
	 *
	 * version 3.3.2
	 */
	function kama_breadcrumbs( $sep = ' » ', $l10n = array(), $args = array() ){
		$kb = new Kama_Breadcrumbs;
		echo $kb->get_crumbs( $sep, $l10n, $args );
	}

	class Kama_Breadcrumbs {

		public $arg;

		// Локализация
		static $l10n = array(
			'home'       => 'Головна',
			'paged'      => '',
			'_404'       => 'Помилка 404',
			'search'     => '<li>Результати пошуку за запитом - <b>%s</b></li>',
			'author'     => 'Архив автора: <b>%s</b>',
			'year'       => '<li>Архів за <b>%d</b> рік</li>',
			'month'      => '<li>Архів за: <b>%s</b></li>',
			'day'        => '<li>%s</li>',
			'attachment' => 'Медиа: %s',
			'tag'        => 'Записи по метке: <b>%s</b>',
			'tax_tag'    => '%1$s из "%2$s" по тегу: <b>%3$s</b>',
			// tax_tag выведет: 'тип_записи из "название_таксы" по тегу: имя_термина'.
			// Если нужны отдельные холдеры, например только имя термина, пишем так: 'записи по тегу: %3$s'
		);

		// Параметры по умолчанию
		static $args = array(
			'on_front_page'   => true,  // выводить крошки на главной странице
			'show_post_title' => true,  // показывать ли название записи в конце (последний элемент). Для записей, страниц, вложений
			'show_term_title' => true,  // показывать ли название элемента таксономии в конце (последний элемент). Для меток, рубрик и других такс
			'title_patt'      => '<li class="kb_title">%s</li>', // шаблон для последнего заголовка. Если включено: show_post_title или show_term_title
			'last_sep'        => true,  // показывать последний разделитель, когда заголовок в конце не отображается
			'markup'          => 'schema.org', // 'markup' - микроразметка. Может быть: 'rdf.data-vocabulary.org', 'schema.org', '' - без микроразметки
											   // или можно указать свой массив разметки:
											   // array( 'wrappatt'=>'<div class="kama_breadcrumbs">%s</div>', 'linkpatt'=>'<a href="%s">%s</a>', 'sep_after'=>'', )
			'priority_tax'    => array('category'), // приоритетные таксономии, нужно когда запись в нескольких таксах
			'priority_terms'  => array(), // 'priority_terms' - приоритетные элементы таксономий, когда запись находится в нескольких элементах одной таксы одновременно.
										  // Например: array( 'category'=>array(45,'term_name'), 'tax_name'=>array(1,2,'name') )
										  // 'category' - такса для которой указываются приор. элементы: 45 - ID термина и 'term_name' - ярлык.
										  // порядок 45 и 'term_name' имеет значение: чем раньше тем важнее. Все указанные термины важнее неуказанных...
			'nofollow' => false, // добавлять rel=nofollow к ссылкам?

			// служебные
			'sep'             => '',
			'linkpatt'        => '',
			'pg_end'          => '',
		);

		function get_crumbs( $sep, $l10n, $args ){
			global $post, $wp_query, $wp_post_types;

			self::$args['sep'] = $sep;

			// Фильтрует дефолты и сливает
			$loc = (object) array_merge( apply_filters('kama_breadcrumbs_default_loc', self::$l10n ), $l10n );
			$arg = (object) array_merge( apply_filters('kama_breadcrumbs_default_args', self::$args ), $args );

			//$arg->sep = '<span class="kb_sep">'. $arg->sep .'</span>'; // дополним

			// упростим
			$sep = & $arg->sep;
			$this->arg = & $arg;

			// микроразметка ---
			if(1){
				$mark = & $arg->markup;

				// Разметка по умолчанию
				if( ! $mark ) $mark = array(
					'wrappatt'  => '<ul class="breadcrumbs clear">%s</ul>',
					'linkpatt'  => '<a href="%s">%s</a>',
					'sep_after' => '',
				);
				// rdf
				elseif( $mark === 'rdf.data-vocabulary.org' ) $mark = array(
					'wrappatt'   => '<ul class="breadcrumbs clear" prefix="v: http://rdf.data-vocabulary.org/#">%s</ul>',
					'linkpatt'   => '<span typeof="v:Breadcrumb"><a href="%s" rel="v:url" property="v:title">%s</a>',
					'sep_after'  => '</span>', // закрываем span после разделителя!
				);
				// schema.org
				elseif( $mark === 'schema.org' ) $mark = array(
					'wrappatt'   => '<ul class="breadcrumbs clear" itemscope itemtype="http://schema.org/BreadcrumbList">%s</ul>',
					'linkpatt'   => '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="%s" itemprop="item"><span itemprop="name">%s</span></a></li>',
					'sep_after'  => '',
				);

				elseif( ! is_array($mark) )
					die( __CLASS__ .': "markup" parameter must be array...');

				$wrappatt  = $mark['wrappatt'];
				$arg->linkpatt  = $arg->nofollow ? str_replace('<a ','<a rel="nofollow"', $mark['linkpatt']) : $mark['linkpatt'];
				$arg->sep      .= $mark['sep_after']."\n";
			}

			$linkpatt = $arg->linkpatt; // упростим

			$q_obj = get_queried_object();

			// может это архив пустой таксы?
			$ptype = null;
			if( empty($post) ){
				if( isset($q_obj->taxonomy) )
					$ptype = & $wp_post_types[ get_taxonomy($q_obj->taxonomy)->object_type[0] ];
			}
			else $ptype = & $wp_post_types[ $post->post_type ];

			// paged
			$arg->pg_end = '';
			if( ($paged_num = get_query_var('paged')) || ($paged_num = get_query_var('page')) )
				$arg->pg_end = $sep . sprintf( $loc->paged, (int) $paged_num );

			$pg_end = $arg->pg_end; // упростим

			// ну, с богом...
			$out = '';

			if( is_front_page() ){
				return $arg->on_front_page ? sprintf( $wrappatt, ( $paged_num ? sprintf($linkpatt, get_home_url(), $loc->home) . $pg_end : $loc->home ) ) : '';
			}
			// страница записей, когда для главной установлена отдельная страница.
			elseif( is_home() ) {
				$out = $paged_num ? ( sprintf( $linkpatt, get_permalink($q_obj), esc_html($q_obj->post_title) ) . $pg_end ) : esc_html($q_obj->post_title);
			}
			elseif( is_404() ){
				$out = $loc->_404;
			}
			elseif( is_search() ){
				$out = sprintf( $loc->search, esc_html( $GLOBALS['s'] ) );
			}
			elseif( is_author() ){
				$tit = sprintf( $loc->author, esc_html($q_obj->display_name) );
				$out = ( $paged_num ? sprintf( $linkpatt, get_author_posts_url( $q_obj->ID, $q_obj->user_nicename ) . $pg_end, $tit ) : $tit );
			}
			elseif( is_year() || is_month() || is_day() ){
				$y_url  = get_year_link( $year = get_the_time('Y') );

				if( is_year() ){
					$tit = sprintf( $loc->year, $year );
					$out = ( $paged_num ? sprintf($linkpatt, $y_url, $tit) . $pg_end : $tit );
				}
				// month day
				else {
					$y_link = sprintf( $linkpatt, $y_url, $year);
					$m_url  = get_month_link( $year, get_the_time('m') );

					if( is_month() ){
						$tit = sprintf( $loc->month, get_the_time('F') );
						$out = $y_link . $sep . ( $paged_num ? sprintf( $linkpatt, $m_url, $tit ) . $pg_end : $tit );
					}
					elseif( is_day() ){
						$m_link = sprintf( $linkpatt, $m_url, get_the_time('F'));
						$out = $y_link . $sep . $m_link . $sep . get_the_time('l');
					}
				}
			}
			// Древовидные записи
			elseif( is_singular() && $ptype->hierarchical ){
				$out = $this->_add_title( $this->_page_crumbs($post), $post );
			}
			// Таксы, плоские записи и вложения
			else {
				$term = $q_obj; // таксономии

				// определяем термин для записей (включая вложения attachments)
				if( is_singular() ){
					// изменим $post, чтобы определить термин родителя вложения
					if( is_attachment() && $post->post_parent ){
						$save_post = $post; // сохраним
						$post = get_post($post->post_parent);
					}

					// учитывает если вложения прикрепляются к таксам древовидным - все бывает :)
					$taxonomies = get_object_taxonomies( $post->post_type );
					// оставим только древовидные и публичные, мало ли...
					$taxonomies = array_intersect( $taxonomies, get_taxonomies( array('hierarchical' => true, 'public' => true) ) );

					if( $taxonomies ){
						// сортируем по приоритету
						if( ! empty($arg->priority_tax) ){
							usort( $taxonomies, function($a,$b)use($arg){
								$a_index = array_search($a, $arg->priority_tax);
								if( $a_index === false ) $a_index = 9999999;

								$b_index = array_search($b, $arg->priority_tax);
								if( $b_index === false ) $b_index = 9999999;

								return ( $b_index === $a_index ) ? 0 : ( $b_index < $a_index ? 1 : -1 ); // меньше индекс - выше
							} );
						}

						// пробуем получить термины, в порядке приоритета такс
						foreach( $taxonomies as $taxname ){
							if( $terms = get_the_terms( $post->ID, $taxname ) ){
								// проверим приоритетные термины для таксы
								$prior_terms = & $arg->priority_terms[ $taxname ];
								if( $prior_terms && count($terms) > 2 ){
									foreach( (array) $prior_terms as $term_id ){
										$filter_field = is_numeric($term_id) ? 'term_id' : 'slug';
										$_terms = wp_list_filter( $terms, array($filter_field=>$term_id) );

										if( $_terms ){
											$term = array_shift( $_terms );
											break;
										}
									}
								}
								else
									$term = array_shift( $terms );

								break;
							}
						}
					}

					if( isset($save_post) ) $post = $save_post; // вернем обратно (для вложений)
				}

				// вывод

				// все виды записей с терминами или термины
				if( $term && isset($term->term_id) ){
					$term = apply_filters('kama_breadcrumbs_term', $term );

					// attachment
					if( is_attachment() ){
						if( ! $post->post_parent )
							$out = sprintf( $loc->attachment, esc_html($post->post_title) );
						else {
							if( ! $out = apply_filters('attachment_tax_crumbs', '', $term, $this ) ){
								$_crumbs    = $this->_tax_crumbs( $term, 'self' );
								$parent_tit = sprintf( $linkpatt, get_permalink($post->post_parent), get_the_title($post->post_parent) );
								$_out = implode( $sep, array($_crumbs, $parent_tit) );
								$out = $this->_add_title( $_out, $post );
							}
						}
					}
					// single
					elseif( is_single() ){
						if( ! $out = apply_filters('post_tax_crumbs', '', $term, $this ) ){
							$_crumbs = $this->_tax_crumbs( $term, 'self' );
							$out = $this->_add_title( $_crumbs, $post );
						}
					}
					// не древовидная такса (метки)
					elseif( ! is_taxonomy_hierarchical($term->taxonomy) ){
						// метка
						if( is_tag() )
							$out = $this->_add_title('', $term, sprintf( $loc->tag, esc_html($term->name) ) );
						// такса
						elseif( is_tax() ){
							$post_label = $ptype->labels->name;
							$tax_label = $GLOBALS['wp_taxonomies'][ $term->taxonomy ]->labels->name;
							$out = $this->_add_title('', $term, sprintf( $loc->tax_tag, $post_label, $tax_label, esc_html($term->name) ) );
						}
					}
					// древовидная такса (рибрики)
					else {
						if( ! $out = apply_filters('term_tax_crumbs', '', $term, $this ) ){
							$_crumbs = $this->_tax_crumbs( $term, 'parent' );
							$out = $this->_add_title( $_crumbs, $term, esc_html($term->name) );                     
						}
					}
				}
				// влоежния от записи без терминов
				elseif( is_attachment() ){
					$parent = get_post($post->post_parent);
					$parent_link = sprintf( $linkpatt, get_permalink($parent), esc_html($parent->post_title) );
					$_out = $parent_link;

					// вложение от записи древовидного типа записи
					if( is_post_type_hierarchical($parent->post_type) ){
						$parent_crumbs = $this->_page_crumbs($parent);
						$_out = implode( $sep, array( $parent_crumbs, $parent_link ) );
					}

					$out = $this->_add_title( $_out, $post );
				}
				// записи без терминов
				elseif( is_singular() ){
					$out = $this->_add_title( '', $post );
				}
			}

			// замена ссылки на архивную страницу для типа записи
			$home_after = apply_filters('kama_breadcrumbs_home_after', '', $linkpatt, $sep, $ptype );

			if( '' === $home_after ){
				// Ссылка на архивную страницу типа записи для: отдельных страниц этого типа; архивов этого типа; таксономий связанных с этим типом.
				if( $ptype && $ptype->has_archive && ! in_array( $ptype->name, array('post','page','attachment') )
					&& ( is_post_type_archive() || is_singular() || (is_tax() && in_array($term->taxonomy, $ptype->taxonomies)) )
				){
					$pt_title = $ptype->labels->name;

					// первая страница архива типа записи
					if( is_post_type_archive() && ! $paged_num )
						$home_after = sprintf( $this->arg->title_patt, $pt_title );
					// singular, paged post_type_archive, tax
					else{
						$home_after = sprintf( $linkpatt, get_post_type_archive_link($ptype->name), $pt_title );

						$home_after .= ( ($paged_num && ! is_tax()) ? $pg_end : $sep ); // пагинация
					}
				}
			}

			$before_out = sprintf( $linkpatt, home_url(), $loc->home ) . ( $home_after ? $sep.$home_after : ($out ? $sep : '') );

			$out = apply_filters('kama_breadcrumbs_pre_out', $out, $sep, $loc, $arg );

			$out = sprintf( $wrappatt, $before_out . $out );

			return apply_filters('kama_breadcrumbs', $out, $sep, $loc, $arg );
		}

		function _page_crumbs( $post ){
			$parent = $post->post_parent;

			$crumbs = array();
			while( $parent ){
				$page = get_post( $parent );
				$crumbs[] = sprintf( $this->arg->linkpatt, get_permalink($page), esc_html($page->post_title) );
				$parent = $page->post_parent;
			}

			return implode( $this->arg->sep, array_reverse($crumbs) );
		}

		function _tax_crumbs( $term, $start_from = 'self' ){
			$termlinks = array();
			$term_id = ($start_from === 'parent') ? $term->parent : $term->term_id;
			while( $term_id ){
				$term       = get_term( $term_id, $term->taxonomy );
				$termlinks[] = sprintf( $this->arg->linkpatt, get_term_link($term), esc_html($term->name) );
				$term_id    = $term->parent;
			}

			if( $termlinks )
				return implode( $this->arg->sep, array_reverse($termlinks) ) /*. $this->arg->sep*/;
			return '';
		}

		// добалвяет заголовок к переданному тексту, с учетом всех опций. Добавляет разделитель в начало, если надо.
		function _add_title( $add_to, $obj, $term_title = '' ){
			$arg = & $this->arg; // упростим...
			$title = $term_title ? $term_title : esc_html($obj->post_title); // $term_title чиститься отдельно, теги моугт быть...
			$show_title = $term_title ? $arg->show_term_title : $arg->show_post_title;

			// пагинация
			if( $arg->pg_end ){
				$link = $term_title ? get_term_link($obj) : get_permalink($obj);
				$add_to .= ($add_to ? $arg->sep : '') . sprintf( $arg->linkpatt, $link, $title ) . $arg->pg_end;
			}
			// дополняем - ставим sep
			elseif( $add_to ){
				if( $show_title )
					$add_to .= $arg->sep . sprintf( $arg->title_patt, $title );
				elseif( $arg->last_sep )
					$add_to .= $arg->sep;
			}
			// sep будет потом...
			elseif( $show_title )
				$add_to = sprintf( $arg->title_patt, $title );

			return $add_to;
		}

	}


	add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
	
	function my_navigation_template( $template, $class ){
		return '
		<div class="navigation %1$s" role="navigation">
			<div class="nav-links">%3$s</div>
		</div>
		';
	}






	if ( qtrans_getLanguage() == 'en' ) { 
		add_filter('kama_breadcrumbs_default_loc', function($l10n){
			// Локализация
			return array(
				'home'       => 'Front page',
				'paged'      => 'Page %d',
				'_404'       => 'Error 404',
				'search'     => '<li>Search results by query - <b>%s</b></li>',
				'author'     => 'Author archve: <b>%s</b>',
				'year'       => '<li>Archive by <b>%d</b> год</li>',
				'month'      => '<li>Archive by: <b>%s</b></li>',
				'day'        => '<li>%s</li>',
				'attachment' => 'Media: %s',
				'tag'        => 'Posts by tag: <b>%s</b>',
				'tax_tag'    => '%1$s from "%2$s" by tag: <b>%3$s</b>',
				// tax_tag выведет: 'тип_записи из "название_таксы" по тегу: имя_термина'. 
				// Если нужны отдельные холдеры, например только имя термина, пишем так: 'записи по тегу: %3$s'
			);
		});
	}
	elseif ( qtrans_getLanguage() == 'ru' ) {
		add_filter('kama_breadcrumbs_default_loc', function($l10n){
			// Локализация
			return array(
				'home'       => 'Главная',
				'paged'      => '',
				'_404'       => 'Ошибка 404',
				'search'     => '<li>Результат поиска по запросу - <b>%s</b></li>',
				'author'     => 'Архив автора: <b>%s</b>',
				'year'       => '<li>Архив за <b>%d</b> рік</li>',
				'month'      => '<li>Архив за: <b>%s</b></li>',
				'day'        => '<li>%s</li>',
				'attachment' => 'Медиа: %s',
				'tag'        => 'Записи по метке: <b>%s</b>',
				'tax_tag'    => '%1$s из "%2$s" по тегу: <b>%3$s</b>',
				// tax_tag выведет: 'тип_записи из "название_таксы" по тегу: имя_термина'.
				// Если нужны отдельные холдеры, например только имя термина, пишем так: 'записи по тегу: %3$s'
			);
		});
	}
	else {
		add_filter('kama_breadcrumbs_default_loc', function($l10n){
			// Локализация
			return array(
				'home'       => 'Головна',
				'paged'      => '',
				'_404'       => 'Помилка 404',
				'search'     => '<li>Результати пошуку за запитом - <b>%s</b></li>',
				'author'     => 'Архів автора: <b>%s</b>',
				'year'       => '<li>Архів за <b>%d</b> рік</li>',
				'month'      => '<li>Архів за: <b>%s</b></li>',
				'day'        => '<li>%s</li>',
				'attachment' => 'Медиа: %s',
				'tag'        => 'Записи по метке: <b>%s</b>',
				'tax_tag'    => '%1$s из "%2$s" по тегу: <b>%3$s</b>',
				// tax_tag выведет: 'тип_записи из "название_таксы" по тегу: имя_термина'.
				// Если нужны отдельные холдеры, например только имя термина, пишем так: 'записи по тегу: %3$s'
			);
		});
	}


	add_filter( 'document_title_separator', function(){ return ' | '; } );






	


add_action('wp_enqueue_scripts', 'wp_load_style_scrtips');

function wp_load_style_scrtips() {

	

    wp_enqueue_style( 'slick.css', get_template_directory_uri() . '/styles/slick.css');

    wp_enqueue_style( 'slick-theme.css', get_template_directory_uri() . '/styles/slick-theme.css');


    wp_enqueue_style( 'fonts.css', get_template_directory_uri() . '/styles/fonts/fonts.css');


    wp_enqueue_style( 'simplelightbox.min.css', get_template_directory_uri() . '/styles/simplelightbox.min.css');

    wp_enqueue_style( 'MYstyle.css', get_template_directory_uri() . '/styles/style.css');


    wp_enqueue_style( 'media.css', get_template_directory_uri() . '/styles/media.css');


   wp_enqueue_style( 'style.css', get_template_directory_uri() . '/style.css');



} 

// allow SVG uploads
add_filter('upload_mimes', 'custom_upload_mimes');
function custom_upload_mimes ( $existing_mimes=array() ) {
  $existing_mimes['svg'] = 'image/svg+xml';
  return $existing_mimes;
}
function fix_svg() {
    echo '<style type="text/css">
          .attachment-266x266, .thumbnail img {
               width: 100% !important;
               height: auto !important;
          }
          </style>';
 }
 add_action('admin_head', 'fix_svg');





##  отменим показ выбранного термина наверху в checkbox списке терминов
add_filter( 'wp_terms_checklist_args', 'set_checked_ontop_default', 10 );
function set_checked_ontop_default( $args ) {
	// изменим параметр по умолчанию на false
	if( ! isset($args['checked_ontop']) )
		$args['checked_ontop'] = false;

	return $args;
}



add_action('login_head', 'my_custom_login_logo');
function my_custom_login_logo(){
	echo '<style type="text/css">
	h1 a { background-image:url('.get_bloginfo('template_directory').'/images/logo.png) !important; height: 135px !important; background-size: 175px !important; width: 213px !important;}
	</style>';
}

/*
//Розпорядження
add_action('init','documents');

function documents() {
	register_post_type('documents',array(
		
		'public'=>true,
		'supports' => array('title', 'editor'),
		'menu_position' =>5,
		'menu_icon' => 'dashicons-format-aside',
		'taxonomies' => array('order'),
		'labels' => array(
			'name' => 'Розпорядження',
			'all_items' => 'Усі',
			'add_new' => 'Додати',
			'add_new_item' => 'Нове розпорядження'
		)
	));
}

// хук для регистрации
add_action( 'init', 'create_order' );
function create_order(){

	register_taxonomy('orders', array('documents'), array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => array(
			'name'              => 'Розділ',
			'singular_name'     => 'Розділ',
			'search_items'      => 'Пошук по розділу',
			'all_items'         => 'Всі розділи',
			'view_item '        => 'Переглянути розділ',
			'parent_item'       => 'Батьківський',
			'parent_item_colon' => 'Батьківський:',
			'edit_item'         => 'Редогувати',
			'update_item'       => 'Оновити',
			'add_new_item'      => 'Додати',
			'new_item_name'     => 'Новий',
			'menu_name'         => 'Розділ',
		),
		'description'           => '', // описание таксономии
		'public'                => true,
		'publicly_queryable'    => null, // равен аргументу public
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_in_menu'          => true, // равен аргументу show_ui
		'show_tagcloud'         => true, // равен аргументу show_ui
		'show_in_rest'          => null, // добавить в REST API
		'rest_base'             => null, // $taxonomy
		'hierarchical'          => true,
		//'update_count_callback' => '_update_post_term_count',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	) );
}
*/

/*function wpcf7_remove_assets() {
	add_filter( 'wpcf7_load_js', '__return_false' );
	add_filter( 'wpcf7_load_css', '__return_false' );
}

add_action( 'wpcf7_init', 'wpcf7_remove_assets' );

function wpcf7_add_assets( $atts ) {
	wpcf7_enqueue_styles();

	return $atts;
}

add_filter( 'shortcode_atts_wpcf7', 'wpcf7_add_assets' );*/