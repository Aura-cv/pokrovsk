<?php get_header(); ?>

<section id="content" class="page not-panel">
	<div class="container">
		<div class="wrap-bread"><?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(''); ?></div>
		<div class="left">
			<article id="post-<?php the_ID(); ?>">
				<h1 class="l1"><?php the_title(); ?></h1>
				<div class="list-admin">
					<?php
						$args = array(
						  'post_type' => 'post',
						  'posts_per_page' => -1,
						  'cat' => 213, 
						  'order' => 'DESC',
						);

						$query = new WP_Query( $args );

						if($query->have_posts()) :
						  while($query->have_posts()): $query->the_post(); ?>
						
						<div class="wrap mywrap">
							<a href="<?php the_permalink() ?>" class="photo"><?php the_title(); ?></a>
						</div>

					<?php 
						  endwhile;
						endif; wp_reset_query();
					?>
				</div>
			</article>
		</div>
		<aside><?php get_template_part( 'sidebar' ); ?></aside>
	</div>
</section>

<?php get_footer(); ?>