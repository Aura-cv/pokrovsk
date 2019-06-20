<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title><?php echo wp_get_document_title(); ?></title>
	

	
	<script src="/wp-content/themes/rada/js/jquery.min.js"></script>

	<script src="/wp-content/themes/rada/js/simple-lightbox.js"></script>
	<script src="/wp-content/themes/rada/js/slick.min.js"></script>
	<script src="/wp-content/themes/rada/js/masonry.pkgd.min.js"></script>
	<script src="/wp-content/themes/rada/js/script.js"></script>

	<?php wp_head(); ?>
</head>
<body class="<?php if( is_front_page() ) { ?>mainpage<?php } else {?> inner<?php } ?>">
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = 'https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v3.2&appId=751762811559339&autoLogAppEvents=1';
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<header>
		<div class="container">
			<div class="top clear">
				<div class="vision">
					<?php echo do_shortcode( '[bvi]' ); ?>
				</div>
				<div class="lang down white">
					<?php qtranxf_generateLanguageSelectCode('dropdown', 'language'); ?>
				</div>
			</div>
			<div class="center clear">
				<a href="/" class="logo"><img src="/wp-content/themes/rada/images/logo.png" alt=""></a>
				<div class="emblem"><img src="/wp-content/themes/rada/images/emblem.svg" alt=""></div>
				<div class="name">
					<p class="l1"><a href="/"><?php _e('<!--:en-->Pokrovskaya district state<br> administration of the Donetsk region<!--:--><!--:ru-->Покровская районная государственная<br> администрация Донецкой области<!--:--><!--:ua-->Покровська районна державна<br> адміністрація Донецької області<!--:-->'); ?></a></p>
					<div><?php _e('<!--:en-->Official website<!--:--><!--:ru-->Официальный веб-сайт<!--:--><!--:ua-->Офіційний веб-сайт<!--:-->'); ?></div>
				</div>
			</div>
		</div>
	</header>
	<nav>
		<div class="container">
			<div class="butmenu"><?php _e('<!--:en-->Menu<!--:--><!--:ru-->Меню<!--:--><!--:ua-->Меню<!--:-->'); ?></div>
			<?php
				wp_nav_menu( array(
					'theme_location'  => 'header_menu',
					'menu'            => '', 
					'container'       => '',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'menu',
					'menu_id'         => '',
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'           => 0,
					'walker'          => '',
				) );
			?>
			<div class="search clear">
				<div><?php _e('<!--:en-->Search<!--:--><!--:ru-->Поиск<!--:--><!--:ua-->Пошук<!--:-->'); ?></div>
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16.6">
				  <path d="M15.8 15.1l-4-4.1a6.7 6.7 0 1 0-5.1 2.4 6.6 6.6 0 0 0 3.8-1.2l4 4.1a.9.9 0 1 0 1.3-1.2zM6.7 1.7a5 5 0 1 1-5 5 5 5 0 0 1 5-5z"/>
				</svg>
			</div>
		</div>
	</nav>