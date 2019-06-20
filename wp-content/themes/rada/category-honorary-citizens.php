<?php get_header(); ?>

<section id="content" class="leaderspage honor">
	<div class="container">
		<div class="wrap-bread"><?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(''); ?></div>
		<div class="left">
			<div class="namecat l1"><?php echo get_queried_object()->cat_name; ?></div>
				<div class="news">
					<div class="list">
						<?php
							$args = array(
								'posts_per_page' => -1,
						        'order' => 'ASC',
						        'cat' => 72
					        );

					        $q = new WP_Query($args);

							if($q->have_posts()) {
								while($q->have_posts()){ $q->the_post(); ?>
									<div class="leader">
										<div class="wrap clear">
											<div class="photo">
												<?php echo get_the_post_thumbnail( $page->ID, 'medium'); ?>
											</div>
											<div class="desc">
												<div class="name l2 bold"><?php the_title(); ?></div>
											</div>
										</div>
									</div>
								<?php }
							}

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