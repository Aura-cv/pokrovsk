
	<?php $cat_advertisement =  9; ?>
	<?php $advertisement = new WP_Query(array(

                                                     'posts_per_page' => 3,
													  'cat' => $cat_advertisement,


	));  ?>

	<?php if ( $advertisement->have_posts() ) : ?>
		
	<div class="anons">
		<div class="l1">
			<?php _e('<!--:en-->Ads<!--:--><!--:ru-->Объявления<!--:--><!--:ua-->Оголошення<!--:-->'); ?>
		</div>
	<?php while ( $advertisement->have_posts() ) : $advertisement->the_post(); ?>
				
					<a href="<?php the_permalink() ?>" class="postsmed">
						<div class="photo">
							<?php the_post_thumbnail('thumbnail'); ?>
						</div>
						<div class="ttl"><?php the_title(); ?></div>
					</a>


	<?php endwhile; ?>
	<a href="<?php echo get_category_link($cat_advertisement); ?>" class="more">
			<?php _e('<!--:en-->All ads<!--:--><!--:ru-->Все объявления<!--:--><!--:ua-->Всі оголошення<!--:-->'); ?>
		</a>
	</div>
	<?php else: ?>
	<!-- no posts found -->
	<?php endif; ?>
	<?php wp_reset_postdata(); ?> 





	<?php 
		
			$args_announce = array(
				'posts_per_page' => 3,
				'category__in' => 177
			);
		

		$announce = new WP_Query($args_announce);
        
		if($announce->have_posts()): ?>
			<div class="announce post-view">
					<div class="ttl l1">
						
								<a href="<?php //echo get_category_link(177); ?>">
								<?php _e('<!--:en-->Announcements<!--:--><!--:ru-->Анонсы<!--:--><!--:ua-->Анонси<!--:-->'); ?>
								</a>
					</div>
			<?php while($announce->have_posts()): $announce->the_post(); ?>
            
				<a href="<?php the_permalink() ?>" class="postsmini clear">
					<div class="photo"><?php echo get_the_post_thumbnail( $page->ID, 'thumbnail'); ?></div>
					<div class="desc">
						<p><?php the_title(); ?></p>
						<div class="date"><?php the_field('date_anons'); ?> 
						<?php if(get_field('time_anons')): ?> 
							в <?php the_field('time_anons'); ?> 
						<?php endif; ?>
						</div>
					</div>
				</a>
			
			
			<?php endwhile; ?>
		<?php endif; ?>

		<?php  wp_reset_postdata(); ?>
	
</div>

<?php
	if ( is_active_sidebar( 'sideright' ) ) :
			dynamic_sidebar( 'sideright' );
 	endif;
?>