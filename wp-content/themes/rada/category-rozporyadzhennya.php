<?php get_header(); ?>

<section id="content" class="regular">
	<div class="container">
		<div class="wrap-bread"><?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(''); ?></div>
		<div class="left">
			<div class="namecat l1"><?php echo get_queried_object()->cat_name; ?></div>
				<div class="news post-view">
					<div class="list">
						<?php
							if ( get_query_var( 'paged' ) ) {
								$page = get_query_var( 'paged' );
							} else {
								$page = 1;
							}
						
							$args = array(
								'posts_per_page' => 10,
								'cat' => $cat,
								'paged' => $page,
								'orderby' => 'date',
								'order' => 'DESC'
							);

							$q = new WP_Query($args);
						
							if($q->have_posts()) {
								while($q->have_posts()){ $q->the_post(); ?>
									<div class="posts norm rozp clear">
										<div class="desc">
											<a href="<?php the_permalink() ?>">
												<div class="ttl l3"><?php the_title(); ?></div>
											</a>
											<ul class="info">
												<li class="headrozp">
													<?php if(get_field('number')){
													   the_field('rozp-info');
													} ?>
												</li>
												<?php if(get_field('number')){ ?>
												   <li class="number">№<?php the_field('number') ?></li>
												<?php } ?>
												<li class="date-r"><?php _e('<!--:en-->from <!--:--><!--:ru-->от <!--:--><!--:ua-->від <!--:-->'); ?> <?php echo get_the_date('j.m.Y'); ?></li>
											</ul>
										</div>
									</div>
								<?php }
								the_posts_pagination();
							}
							wp_reset_postdata();
						
							/*the_posts_pagination( array(
								'end_size' => 1
							));*/
						?>
					</div>
				</div>
			</div>
			<aside><?php get_template_part( 'sidebar' ); ?></aside>
		</div>
	</div>
</section>

<?php get_footer(); ?>