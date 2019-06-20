<?php get_header(); ?>

<section id="content" class="listlink">
	<div class="container">
		<div class="wrap-bread"><?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(''); ?></div>
		<div class="left">
			<div class="namecat l1"><?php echo get_queried_object()->cat_name; ?></div>
			<?php if(is_category(40)) : ?>
				<div class="news post-view d-pages">
					<div class="list">
						<?php
						wp_list_categories("orderby=id&show_count=0&use_desc_for_title=0&hide_empty=0&style=none&child_of=40");
						?>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<aside><?php get_template_part( 'sidebar' ); ?></aside>
	</div>
</section>

<?php get_footer(); ?>