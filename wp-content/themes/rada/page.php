<?php get_header(); ?>

<section id="content" class="page not-panel">
	<div class="container">
		<div class="wrap-bread"><?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(''); ?></div>
		<div class="left">
			<article id="post-<?php the_ID(); ?>">
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
					
				<?php
				$args = array(
					'posts_per_page' => -1,
					'post_type' => 'page',
					'post_parent' => get_the_ID()
				);

				$query = new WP_Query( $args );
				
				/*$slug_cat = $wp_query->post->post_name;
				$term = get_term_by('slug', $slug_cat, 'category');
				$category_id = $term->term_id;*/
				
				$ancestors = get_ancestors( get_the_ID(), 'page' );

				if($query->have_posts() and $ancestors[0] != 299) : ?>
					<div class="news post-view d-pages">
						<div class="list">
						<?php while($query->have_posts()): $query->the_post(); ?>
							<a href="<?php the_permalink() ?>" class="l3"><?php the_title(); ?></a>
						<?php endwhile; ?>
						<?php
							
							/*$slug_cat = $wp_query->post->post_name;
							$category = get_category_by_slug( 'grodivska-selishhna-rada' );
							echo $category->term_id;*/
							
							$slug_cat = $wp_query->post->post_name;
							// echo $slug_cat;
							$term = get_term_by('slug', $slug_cat, 'category');
							$category_id = $term->term_id;
							
							// echo $category_id;
							
							/*$category = get_category_by_slug( 'grodivska-selishhna-rada' );
							echo $category->cat_id;*/
							
							//$category_id = get_cat_ID($slug_page);
							
							/* $args = get_categories(array(
								'parent' => 66
							)); */
							
							// $categories = get_categories( $args );
							
							/*foreach ($categories as $category) {
								$option = '<option value="/category/archives/'.$category->category_nicename.'">';
								$option .= $category->cat_name;
								$option .= ' ('.$category->category_count.')';
								$option .= '</option>';
								echo $option;
							  }*/
							
							if(!is_page(302) and $category_id){
								wp_list_categories("orderby=id&show_count=0&use_desc_for_title=0&hide_empty=0&style=none&child_of=$category_id");
							}
							
							/*echo $category_id;
							
							$args = array(
							  'child_of' => $category_id
							);
							
							wp_list_categories($args);*/ ?>
						</div>
					</div>
				
				<?php else : ?>
				
					<?php while ( have_posts() ) : the_post();?>

						<div class="page-text">
							<?php the_content(); ?>
						</div>


					<?php
						endwhile;
						endif;
						wp_reset_query();
					?>


							

				<div class="photos clear">
					<?php
					    //Get the images ids from the post_metadata
					    $images = acf_photo_gallery('gallery', $post->ID);
					    //Check if return array has anything in it
					    if( count($images) ): 
					        //Cool, we got some data so now let's loop over it
					        foreach($images as $image):
					            $id = $image['id']; // The attachment id of the media
					            $title = $image['title']; //The title
					            $caption= $image['caption']; //The caption
					            $full_image_url= $image['full_image_url']; //Full size image url
					            $full_image_url = acf_photo_gallery_resize_image($full_image_url, 262, 160); //Resized size to 262px width by 160px height image url
					            $thumbnail_image_url= $image['thumbnail_image_url']; //Get the thumbnail size image url 150px by 150px
					            $url= $image['full_image_url']; //Goto any link when clicked
					            $target= $image['target']; //Open normal or new tab
					            $alt = get_field('photo_gallery_alt', $id); //Get the alt which is a extra field (See below how to add extra fields)
					            $class = get_field('photo_gallery_class', $id); //Get the class which is a extra field (See below how to add extra fields)
					?>
				    <div class="item">
				        <?php if( !empty($url) ){ ?><a href="<?php echo $url; ?>" <?php echo ($target == 'true' )? 'target="_blank"': ''; ?>><?php } ?>
				            <img src="<?php echo $full_image_url; ?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>">
				        <?php if( !empty($url) ){ ?></a><?php } ?>
				    </div>
					<?php endforeach; endif; ?>
				</div>
			</article>
		</div>
		<aside><?php get_template_part( 'sidebar' ); ?></aside>
	</div>
</section>

<?php get_footer(); ?>