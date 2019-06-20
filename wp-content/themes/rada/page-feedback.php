<?php
/*
Template Name: Форми
Template Post Type: page
*/

get_header(); ?>

<section id="content" class="forms">
	<div class="container">

		<div class="wrap-bread"><?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(''); ?></div>
		<div class="left">
			<h1 class="l1"><?php the_title(); ?></h1>
			<div class="forms">
				<div class="form active">
					<?php
						$s = get_field("code");
						echo do_shortcode( "[contact-form-7 id=$s]" );
					?>
				</div>
			</div>
		</div>
		<aside>
			<?php 
			while(have_posts()){
				the_post();
				if(get_the_content()){
					the_content();
				}else{
					get_template_part( 'sidebar' );
				}
			}?>
		</aside>
	</div>
</section>

<?php get_footer(); ?>