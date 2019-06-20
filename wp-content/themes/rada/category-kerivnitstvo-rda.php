<?php get_header(); ?>

<section id="content" class="leaderspage">
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
						        'cat' => 39
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
												<div class="position l5">
													<?php $position = get_field('position');
													if( $position ){
														the_field('position');
													} ?>
												</div>
												<div class="info">
													<?php $phones = get_field('phones');
													if( $phones ){?>
														<a href="tel:<?php the_field('phones') ?>" class="phone"><?php the_field('phones') ?></a>
													<?php } ?>
													<?php $shedule = get_field('shedule'); ?>
														<div class="shedule"><?php the_field('shedule') ?></div>
													<div class="but dov"><?php _e('<!--:en-->Biographical note<!--:--><!--:ru-->Биографическая справка<!--:--><!--:ua-->Біографічна довідка<!--:-->'); ?></div>
													<div class="but nap"><?php _e('<!--:en-->Directions<!--:--><!--:ru-->Направления<!--:--><!--:ua-->Напрямки<!--:-->'); ?></div>
												</div>
												<div class="modal dov">
													<?php $bio = get_field('bio');
													if( $bio ){?>
														<?php the_field('bio') ?>
													<?php } ?>
												</div>
												<div class="modal nap">
													<?php $directions = get_field('directions');
													if( $directions ){?>
														<p class="directions"><?php the_field('directions') ?></p>
													<?php } ?>
												</div>
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