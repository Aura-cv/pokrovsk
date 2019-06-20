<?php
/*
Template Name: Архів новин
Template Post Type: page
*/

get_header(); ?>

<section id="content">
	<div class="container">
		<div class="wrap-bread"><?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(''); ?></div>
		<div class="left">
			<div class="search-form">
				<?php get_search_form(); ?>
			</div>
			<div class="namecat l1"><?php the_title(); ?></div>
				<div class="news post-view">
					<div class="list">
						<?php

							if ( get_query_var( 'paged' ) ) {

								$page = get_query_var( 'paged' );
							} else {

								$page = 1;
							}

							$args = array(
								'post_type' => 'post',
								'posts_per_page' => get_option( 'posts_per_page' ),
								'paged' => $page,
								'nopaging' => false,
								'cat' => 3
							);

							// отсюда
							$tmp = $wp_query; // сохранили значение
							$wp_query  = new WP_Query( $args );
							if ($wp_query->have_posts()) {
								while ($wp_query->have_posts()) {
									$wp_query->the_post(); ?>

							<div class="posts clear">
								<a href="<?php the_permalink() ?>" class="photo">
									<?php echo get_the_post_thumbnail( $page->ID, 'medium'); ?>
								</a>
								<div class="desc">
									<div class="info clear">
										<div class="date"><?php echo get_the_date('j.m.Y'); ?> в <?php the_time('G:i'); ?></div>
										<?php
											$categories = get_the_category();

											if($categories){
												echo '<ul class="cats">';
												foreach($categories as $category) {
													echo '<li><a href="'. get_category_link($category->term_id) . '" class="cat">' . $category->cat_name . '</a></li>';
												}
												echo '</ul>';
											}
										?>
									</div>
									<a href="<?php the_permalink() ?>">
										<div class="ttl l2"><?php the_title(); ?></div>
										<p><?php the_excerpt(); ?></p>
									</a>
								</div>
							</div>
							
							<?php
								}
								the_posts_pagination();
							}
							$wp_query = $tmp; // вернули значение

						?>
					</div>
				</div>
			</div>
			<aside><?php get_template_part( 'sidebar' ); ?></aside>
		</div>
	</div>
</section>

<?php get_footer(); ?>