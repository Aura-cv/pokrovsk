<?php get_header(); ?>

<section id="content" <?php if(in_category(40) or in_category(41)) : ?> class="leaderspage single-leader" <?php endif; ?><?php if(in_category(array(46, 162, 172, 102, 144, 90, 132, 78, 120, 71, 108, 49, 150, 96, 138, 84, 126, 114, 156, 55))): ?> class="not-panel" <?php endif; ?>>
	<div class="container">
		<div class="wrap-bread"><?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(''); ?></div>
		<div class="left">
			<article id="post-<?php the_ID(); ?>">
				<div class="panel">
					<?php echo do_shortcode('[printicon]'); ?>
					<div class="social">
						<div class="icon">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 22.5">
							  <path d="M14.4 15.4a3.5 3.5 0 0 0-2.4 1l-5.2-3.7a3.5 3.5 0 0 0 0-3L12 6.2a3.5 3.5 0 1 0-.8-1L6 8.6a3.6 3.6 0 1 0 0 5.1l5.2 3.7a3.6 3.6 0 1 0 3.2-2.1zm0 5.7a2.2 2.2 0 1 1 2.3-2.2 2.2 2.2 0 0 1-2.3 2.2zM3.6 13.5a2.2 2.2 0 1 1 2.2-2.3 2.2 2.2 0 0 1-2.2 2.3zm8.6-10a2.2 2.2 0 1 1 2.2 2.3 2.2 2.2 0 0 1-2.2-2.2zm0 0"/>
							</svg>
						</div>
						<div class="list">
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink());?>&p[images][0]=<?php echo wp_get_attachment_url(get_post_thumbnail_id());?>" target="_blank">facebook</a>
							<a href="https://plus.google.com/share?url=<?php echo urlencode(get_permalink());?>" target="_blank">Google+</a>
						</div>
					</div>
				</div>
				<h1 class="l1"><?php the_title(); ?></h1>
				<?php if(!in_category(array(46, 162, 172, 102, 144, 90, 132, 78, 120, 71, 108, 49, 150, 96, 138, 84, 126, 114, 156, 55))){ ?>
				<div class="date"><?php echo get_the_date('j.m.Y'); ?> в <?php the_time('G:i'); ?></div>
				<?php } else { ?>
				<div class="posts rozp">
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
				<?php } ?>
				<?php while ( have_posts() ) : the_post(); ?>
				<?php if(in_category(array(40,41)) and get_field('name')) : ?>
				<div class="list">
					<div class="leader">
						<div class="wrap clear">
							<div class="photo">
								<?php $photo = get_field('photo');
									if( $photo ){ ?>
										<img src="<?php the_field('photo'); ?>" alt="">
								<?php } ?>
							</div>
							<div class="desc">
								<div class="name l2 bold">
									<?php $name = get_field('name');
									if( $name ){
										the_field('name');
									} ?>
								</div>
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
									<!--<div class="but dov">Біографічна довідка</div>
									<div class="but nap">Напрямки</div>-->
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
				</div>
				<?php endif; ?>
				<?php the_content();
				endwhile; ?>
				
				<?php if( has_tag() ) { ?>
					<div class="tags clear">
						<?php the_tags('',''); ?>
					</div>
				<?php } ?>
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