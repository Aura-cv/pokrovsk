<?php
// Проекти рішень

get_header(); ?>

<section id="content" class="listlink">
	<div class="container">
		<div class="wrap-bread"><?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(''); ?></div>
		<div class="left">
			<div class="namecat l1"><?php echo get_queried_object()->cat_name; ?></div>
				<div class="news post-view">
					<div class="list">
						<?php
							$args = array(
								'posts_per_page' => -1,
						        'order' => 'ASC',
						        'cat' => 174
					        );
					
					        $q = new WP_Query($args);
					
							if($q->have_posts()) {
								while($q->have_posts()){ $q->the_post(); ?>
									<a href="<?php the_permalink() ?>" class="l3"><?php the_content(); ?></a>
								<?php }
							}
					
							wp_reset_postdata();
						?>
					</div>
				</div>
			</div>
			<aside><?php get_template_part( 'sidebar' ); ?></aside>
		</div>
</section>

<?php get_footer(); ?>