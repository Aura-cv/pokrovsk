<?php get_header(); ?>

<section id="content" class="regular">
	<div class="container">
		<div class="wrap-bread"><?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(''); ?></div>
		<div class="left">
			<div class="namecat l1"><?php echo get_queried_object()->cat_name; ?></div>
				<div class="news">
					<div class="list">
						<?php
							if(have_posts()) {
								while(have_posts()){ the_post(); ?>
									<div class="posts norm clear">
										<div class="desc">
											<div class="info clear">
												<div class="date"><?php echo get_the_date('j.m.Y'); ?> в <?php the_time('G:i'); ?></div>
											</div>
											<a href="<?php the_permalink() ?>">
												<div class="ttl l2"><?php the_title(); ?></div>
											</a>
											<a href="<?php the_permalink() ?>" class="more"><?php _e('<!--:en-->More<!--:--><!--:ru-->Далее<!--:--><!--:ua-->Далі<!--:-->'); ?></a>
										</div>
									</div>
								<?php }
							}
							wp_reset_postdata();
						?>
					</div>
				</div>
			</div>
			<aside><?php get_template_part( 'sidebar' ); ?></aside>
		</div>
	</div>
</section>

<?php get_footer(); ?>