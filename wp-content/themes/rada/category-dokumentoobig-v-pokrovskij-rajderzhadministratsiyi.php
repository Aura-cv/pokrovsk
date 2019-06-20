<?php get_header(); ?>

<section id="content" class="regular">
	<div class="container">
		<div class="wrap-bread"><?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(''); ?></div>
		<div class="left">
			<div class="namecat l1"><?php echo get_queried_object()->cat_name; ?></div>
				<div class="news post-view">
					<div class="list">
						
						
						<?php	if(have_posts()): ?>
								<?php while(have_posts()): the_post(); ?>
									<div class="posts norm clear">
										<div class="desc">
											<a href="<?php the_permalink() ?>">
												<div class="ttl l2"><?php the_title(); ?></div>
											</a>
											
										</div>
									</div>
								<?php endwhile; ?>
							<?php endif; ?>
							<?php 
						
							the_posts_pagination( array(
								'end_size' => 1
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