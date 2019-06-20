<?php get_header(); ?>

<section id="content">
	<div class="container">
		<div class="top clear">
			<div class="slider clear">
				<div class="slide-arrow arrow-left"></div>
				<div class="slide-arrow arrow-right"></div>
				<div class="full">
					<?php 

						$args = array(
							'post_type' => 'post',
							'posts_per_page' => 5,
							'cat' => 3,
							'orderby' => 'date',
							'order' => 'DESC'
						);

						$q = new WP_Query($args);

						if($q->have_posts()) {
							while($q->have_posts()){ $q->the_post(); ?>
								<div class="item">
									<?php echo get_the_post_thumbnail( $page->ID, 'slider-image'); ?>
									<div class="desc">
										<div class="main"><?php _e('<!--:en-->Main<!--:--><!--:ru-->Главное<!--:--><!--:ua-->Головне<!--:-->'); ?></div>
										<a href="<?php the_permalink() ?>" class="l2">
												<?php the_title(); ?>
											</a>
									</div>
								</div>
							<?php }
						}

						wp_reset_postdata();
					?>
				</div>
				<div class="switch post-view">
					<?php 
						if($q->have_posts()) {
							while($q->have_posts()){ $q->the_post(); ?>
								<div class="item">
									<div class="post">
										<div class="photo">
											<?php echo get_the_post_thumbnail( $page->ID, 'slider-image'); ?>
										</div>
										<p><?php the_title(); ?></p>
									</div>
									<div class="bg"></div>
								</div>
							<?php }
						}

						wp_reset_postdata();
					?>
				</div>
			</div>
			<div class="head clear">
				<a href="/kerivnictvo-rda/shishko-anatolij-vasilovich/">
					<div class="photo">
						<img src="<?php bloginfo('template_url'); ?>/images/head.png" alt="">
					</div>
					<div class="desc">
						<div><?php _e('<!--:en-->Shishko Anatoly Vasilyevich<!--:--><!--:ru-->Шишко Анатолий Васильевич<!--:--><!--:ua-->Шишко Анатолій Васильович<!--:-->'); ?></div>
						<p><?php _e('<!--:en-->Сhairman of the regional state administration<!--:--><!--:ru-->Председатель райгосадминистрации<!--:--><!--:ua-->Голова райдержадміністрації<!--:-->'); ?></p>
					</div>
				</a>
			</div>
		</div>
		<div class="left">
			<div class="news post-view">
				<div class="tabs clear">
					<ul>
						<li class="active">
							<?php _e('<!--:en-->Last news<!--:--><!--:ru-->Посл. новости<!--:--><!--:ua-->Останні новини<!--:-->'); ?>
						</li>
						<li>
							<?php _e('<!--:en-->Ads<!--:--><!--:ru-->Объявления<!--:--><!--:ua-->Оголошення<!--:-->'); ?>
						</li>
						<li>
							<?php _e('<!--:en-->Preview<!--:--><!--:ru-->Анонсы<!--:--><!--:ua-->Анонси<!--:-->'); ?>
						</li>
					</ul>
					<a href="/archive/" class="archive"><span><?php _e('<!--:en-->Archive<!--:--><!--:ru-->Архив<!--:--><!--:ua-->Архів<!--:-->'); ?> <div class="sm"> <?php _e('<!--:en--> news<!--:--><!--:ru--> новостей<!--:--><!--:ua--> новин<!--:-->'); ?></div></span></a>
				</div>
				<div class="list">
					<div class="col active">
						<?php 
							$args = array(
								'posts_per_page' => 10,
								'cat' => 3,
								'offset' => 5,
								'orderby' => 'date',
								'order' => 'DESC'
							);

							$q = new WP_Query($args);

							if($q->have_posts()) {
								while($q->have_posts()){ $q->the_post(); ?>
									<div class="posts clear">
										<a href="<?php the_permalink() ?>" class="photo">
											<?php echo get_the_post_thumbnail( $page->ID, 'medium'); ?>
										</a>
										<div class="desc">
											<div class="info clear">
												<div class="date"><?php echo get_the_date('j.m.Y'); ?> в <?php the_time('G:i'); ?></div>
												<?php
													$categories = get_the_category();

													if($categories){
														echo '<ul class="cats">';
														foreach($categories as $category) {
															echo '<li><a href="'. get_category_link($category->term_id) . '" class="cat">' . $category->cat_name . '</a></li>';
														}
														echo '</ul>';
													}
												?>
											</div>
											<a href="<?php the_permalink() ?>">
												<div class="ttl l2"><?php the_title(); ?></div>
												<?php the_excerpt(); ?>
											</a>
										</div>
									</div>
								<?php }
							}

							wp_reset_postdata();
						?>
						<a href="/category/news/" class="more"><?php _e('<!--:en-->More news<!--:--><!--:ru-->Все новости<!--:--><!--:ua-->Ще новини<!--:-->'); ?></a>
					</div>
					<div class="col">
						<?php 
							$args = array(
								'posts_per_page' => 10,
								'cat' => 9,
								'orderby' => 'date',
								'order' => 'DESC'
							);

							$q = new WP_Query($args);

							if($q->have_posts()) {
								while($q->have_posts()){ $q->the_post(); ?>
									<div class="posts clear">
										<a href="<?php the_permalink() ?>" class="photo">
											<?php echo get_the_post_thumbnail( $page->ID, 'medium'); ?>
										</a>
										<div class="desc">
											<div class="info clear">
												<div class="date"><?php echo get_the_date('j.m.Y'); ?> в <?php the_time('G:i'); ?></div>
												<?php
													$categories = get_the_category();

													if($categories){
														echo '<ul class="cats">';
														foreach($categories as $category) {
															echo '<li><a href="'. get_category_link($category->term_id) . '" class="cat">' . $category->cat_name . '</a></li>';
														}
														echo '</ul>';
													}
												?>
											</div>
											<a href="<?php the_permalink() ?>">
												<div class="ttl l2"><?php the_title(); ?></div>
												<?php the_excerpt(); ?>
											</a>
										</div>
									</div>
								<?php }
							}

							wp_reset_postdata();
						?>
					</div>
					<div class="col">
						<?php 
							$args = array(
								'posts_per_page' => 10,
								'cat' => 8,
								'orderby' => 'date',
								'order' => 'DESC'
							);

							$q = new WP_Query($args);

							if($q->have_posts()) {
								while($q->have_posts()){ $q->the_post(); ?>
									<div class="posts clear">
										<a href="<?php the_permalink() ?>" class="photo">
											<?php echo get_the_post_thumbnail( $page->ID, 'medium'); ?>
										</a>
										<div class="desc">
											<div class="info clear">
												<div class="date"><?php echo get_the_date('j.m.Y'); ?> в <?php the_time('G:i'); ?></div>
												<?php
													$categories = get_the_category();

													if($categories){
														echo '<ul class="cats">';
														foreach($categories as $category) {
															echo '<li><a href="'. get_category_link($category->term_id) . '" class="cat">' . $category->cat_name . '</a></li>';
														}
														echo '</ul>';
													}
												?>
											</div>
											<a href="<?php the_permalink() ?>">
												<div class="ttl l2"><?php the_title(); ?></div>
												<?php the_excerpt(); ?>
											</a>
										</div>
									</div>
								<?php }
							}

							wp_reset_postdata();
						?>
					</div>
				</div>
			</div>
		</div>
		<aside><?php get_template_part( 'sidebar' ); ?></aside>
	</div>
	<?php 
		$args = array(
			'posts_per_page' => 10,
			'cat' => 14,
			'orderby' => 'date',
			'order' => 'DESC'
		);

		$q = new WP_Query($args);

		if($q->have_posts()) {
			while($q->have_posts()){ $q->the_post(); ?>
		<div class="video">
			<div class="container">
				<div class="ttl l1"><?php _e('<!--:en-->Video<!--:--><!--:ru-->Видео<!--:--><!--:ua-->Відео<!--:-->'); ?></div>
				<div class="list">
					<div class="postsvideo">
						<div class="photo">
							<a href="<?php the_permalink() ?>">
								<?php echo get_the_post_thumbnail( $page->ID, 'medium'); ?>
								<div class="play"></div>
							</a>
						</div>
						<a href="<?php the_permalink() ?>" class="desc">
							<div class="text l2"><?php the_title(); ?></div>
							<div class="date"><?php echo get_the_date('j.m.Y'); ?> в <?php the_time('G:i'); ?></div>
						</a>
					</div>
				</div>
			</div>
		</div>
		<?php }
			}

		wp_reset_postdata();
	?>
	<?php 
		$args = array(
			'posts_per_page' => 8,
			'cat' => 206,
			'orderby' => 'date',
			'order' => 'DESC'
		);

		$q = new WP_Query($args);
		if ($q->have_posts() ) {
	?>
	<div class="gallery">
		<div class="container">
			<div class="clear"><div class="ttl l1"><?php _e('<!--:en-->Gallery<!--:--><!--:ru-->Фотогалерея<!--:--><!--:ua-->Фотогалерея<!--:-->'); ?></div><a href="/gallery/" class="more"><?php _e('<!--:en-->All photos<!--:--><!--:ru-->Все фото<!--:--><!--:ua-->Всі фото<!--:-->'); ?></a></div>
			<div class="albums main-alb">	
			<?php
				while($q->have_posts()){ $q->the_post(); ?>
				<div class="album">
					<a href="<?php the_permalink() ?>">
						<div class="photo">
							<?php echo get_the_post_thumbnail( $page->ID, 'medium'); ?>
						</div>
						<div class="ttl l4"><?php the_title(); ?></div>
					</a>
				</div>
				<?php }
				wp_reset_postdata();
				?>
			</div>
		</div>
	</div>
	<?php } ?>
	<div class="partners">
		<div class="container">
			<div class="ttl l1"><?php _e('<!--:en-->Partners<!--:--><!--:ru-->Партнёры<!--:--><!--:ua-->Партнери<!--:-->'); ?></div>
			<?php
				//echo do_shortcode('[wpaft_logo_slider]'); 
				echo do_shortcode('[logoshowcase]');
			?>
			<!--<div class="list">
				<?php
					/*$gallery = get_post_meta(872);

					echo $gallery['part1-link'][0];
					echo wp_get_attachment_image_url( 872 );*/

					if ( get_post_meta(872, 'part1-link', true) ):
					$file_id = get_post_meta( 872, 'part1-img', true );
				?>
				<div class="item">
					<a href="<?php echo get_post_meta(872, 'part1-link', true); ?>" target="blank">
						<img src="<?php echo wp_get_attachment_image_url( $file_id, 'medium' ); ?>" alt="">
					</a>
				</div>
				<?php endif; 
					if ( get_post_meta(872, 'part2-link', true) ):
					$file_id = get_post_meta( 872, 'part2-img', true );
				?>
				<div class="item">
					<a href="<?php echo get_post_meta(872, 'part2-link', true); ?>" target="blank">
						<img src="<?php echo wp_get_attachment_image_url( $file_id, 'medium' ); ?>" alt="">
					</a>
				</div>
				<?php endif;

					if ( get_post_meta(872, 'part3-link', true) ):
					$file_id = get_post_meta( 872, 'part3-img', true );
				?>
				<div class="item">
					<a href="<?php echo get_post_meta(872, 'part3-link', true); ?>" target="blank">
						<img src="<?php echo wp_get_attachment_image_url( $file_id, 'medium' ); ?>" alt="">
					</a>
				</div>
				<?php endif;
					if ( get_post_meta(872, 'part4-link', true) ):
					$file_id = get_post_meta( 872, 'part4-img', true );
				?>
				<div class="item">
					<a href="<?php echo get_post_meta(872, 'part4-link', true); ?>" target="blank">
						<img src="<?php echo wp_get_attachment_image_url( $file_id, 'medium' ); ?>" alt="">
					</a>
				</div>
				<?php endif;

					if ( get_post_meta(872, 'part4-link', true) ):
					$file_id = get_post_meta( 872, 'part4-img', true );
				?>
				<div class="item">
					<a href="<?php echo get_post_meta(872, 'part4-link', true); ?>" target="blank">
						<img src="<?php echo wp_get_attachment_image_url( $file_id, 'medium' ); ?>" alt="">
					</a>
				</div>
				<?php endif; ?>
			</div>-->
		</div>
	</div>
</section>

<?php get_footer(); ?>