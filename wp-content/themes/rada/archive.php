<?php get_header(); ?>

<section id="content">
	<div class="container">
		<div class="wrap-bread"><?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(''); ?></div>
		<div class="left">
			<div class="search-form">
				<?php get_search_form(); ?>
			</div>
			<div class="namecat l1"><?php echo get_queried_object()->cat_name; ?></div>
				<div class="news post-view">
					<div class="list search-result">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<div class="posts clear">
								<a href="#" class="photo">
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
							<?php endwhile; else: ?>
							<p>Нічого не знайдено.</p>
						<?php endif;
						wp_reset_postdata();

						the_posts_pagination( array(
							'end_size' => 1,
						));
						?>
					</div>
				</div>
			</div>
			<aside><?php get_template_part( 'sidebar' ); ?></aside>
		</div>
	</div>
</section>

<?php get_footer(); ?>