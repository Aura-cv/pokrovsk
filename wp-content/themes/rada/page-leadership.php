<?php
/*
Template Name: Керівництво
Template Post Type: page
*/

get_header(); ?>

<section id="content" class="page">
	<div class="container">
		<div class="wrap-bread"><?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(''); ?></div>
		<aside>
			<div class="head leader-page clear">
				<div class="photo">
					<?php echo get_the_post_thumbnail( $page->ID, 'large'); ?>
				</div>
				<?php if( get_field( "position" ) ): ?>
					<div class="desc">
						<p><?php the_field( "position" ); ?></p>
					</div>
				<?php endif; ?>
			</div>
		</aside>
		<div class="left">
			<article id="post-<?php the_ID(); ?>" class="leadership">
				<div class="panel">
					<a href="#" class="icon print">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
						  <path d="M5 24a.7.7 0 0 1-.8-.7v-5h-2a2.1 2.1 0 0 1-2.2-2V9a2.1 2.1 0 0 1 1.4-2v-.8a2.1 2.1 0 0 1 2.1-2h.7V.6A.7.7 0 0 1 5 0h10a.7.7 0 0 1 .5.2l4 4h1a2.1 2.1 0 0 1 2.2 2.1v.9a2.1 2.1 0 0 1 1.4 2v7a2.1 2.1 0 0 1-2.1 2.1h-2.1v5a.7.7 0 0 1-.7.7zm.6-1.4h12.8v-5.7H5.6zm13.5-7a.7.7 0 0 1 .7.6v.7h2a.7.7 0 0 0 .8-.7v-7a.7.7 0 0 0-.7-.8h-2.1v1.4h.7a.7.7 0 0 1 .7.7.7.7 0 0 1-.7.7h-17a.7.7 0 0 1-.7-.7.7.7 0 0 1 .7-.7h.7V8.4H2.1a.7.7 0 0 0-.7.7v7.1a.7.7 0 0 0 .7.7h2.1v-.7a.7.7 0 0 1 .7-.7zM5.6 9.7h12.8V5.6h-3.5a.7.7 0 0 1-.7-.7V1.4H5.6zM19.8 7h1.4v-.7a.7.7 0 0 0-.7-.7h-.7zm-17-.7V7h1.4V5.6h-.7a.7.7 0 0 0-.7.7zm12.8-2h1.8l-1.8-1.9zm4.2 9.1a.7.7 0 0 1 .7-.7.7.7 0 0 1 .7.7.7.7 0 0 1-.7.7.7.7 0 0 1-.7-.7z"/>
						</svg>
					</a>
					<div class="social">
						<div class="icon">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 22.5">
							  <path d="M14.4 15.4a3.5 3.5 0 0 0-2.4 1l-5.2-3.7a3.5 3.5 0 0 0 0-3L12 6.2a3.5 3.5 0 1 0-.8-1L6 8.6a3.6 3.6 0 1 0 0 5.1l5.2 3.7a3.6 3.6 0 1 0 3.2-2.1zm0 5.7a2.2 2.2 0 1 1 2.3-2.2 2.2 2.2 0 0 1-2.3 2.2zM3.6 13.5a2.2 2.2 0 1 1 2.2-2.3 2.2 2.2 0 0 1-2.2 2.3zm8.6-10a2.2 2.2 0 1 1 2.2 2.3 2.2 2.2 0 0 1-2.2-2.2zm0 0"/>
							</svg>
						</div>
					</div>
				</div>
				<h1 class="l1"><?php the_title(); ?></h1>
				<?php while ( have_posts() ) : the_post();
				the_content();
				endwhile; ?>
			</article>
		</div>
	</div>
</section>

<?php get_footer(); ?>