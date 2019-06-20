<?php get_header(); ?>

<section id="content" class="<?php if(get_queried_object()->parent == 201){ ?> listlink <?php } ?>">
	<div class="container">
		<div class="wrap-bread"><?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(''); ?></div>
		<div class="left">
			<div class="namecat l1"><?php echo get_queried_object()->cat_name; ?></div>
				<div class="news post-view">
					<div class="list">
						<?php						
							if(in_category(40) or in_category(41)) { ?>
							<div class="personnel">
								<div class="list">
									<?php
									
									$args = array(
										'posts_per_page' => -1,
										'cat' => $cat,
									);

									$q = new WP_Query($args);
								
									if($q->have_posts()) {
										while($q->have_posts()){ $q->the_post(); ?>
											<div class="item">
												<div class="card">
													<div class="photo">
														<?php echo get_the_post_thumbnail( $page->ID, 'medium'); ?>
													</div>
													<div class="name l2"><?php the_title(); ?></div>
													<?php $position = get_field('position');
													if( $position ){ ?>
														<div class="position"><?php the_field('position') ?></div>
													<?php } ?>
												</div>
												<div class="info">
													<div class="l3"><?php _e('<!--:en-->Contact information<!--:--><!--:ru-->Контактная информация<!--:--><!--:ua-->Контактна інформація<!--:-->'); ?></div>
													<?php $address = get_field('address');
													if( $address ){?>
													<p class="addss"><span class="bold"><?php _e('<!--:en-->Address<!--:--><!--:ru-->Адрес<!--:--><!--:ua-->Адреса<!--:-->'); ?>:</span> <?php the_field('address') ?></p>
													<?php } ?>
													<?php
													$phone_1 = get_field('phone_1');
													$phone_2 = get_field('phone_2');
													if( $phone_1 ){?>
														<p class="phones">
															<span class="bold"><?php _e('<!--:en-->Phone<!--:--><!--:ru-->Тел.<!--:--><!--:ua-->Тел.<!--:-->'); ?>:</span>
													<div class="phone"><?php the_field('phone_1') ?></div>
																<?php if( $phone_2 ){?>
																	<div class="phone"><?php the_field('phone_2') ?></div>
																<?php } ?>
														</p>
													<?php } ?>
													<?php $email = get_field('email');
													if( $email ){?>
													<p class="email"><span class="bold">E-mail:</span> <a href="mailto:<?php the_field('email') ?>"><?php the_field('email') ?></a></p>
													<?php } ?>
												</div>
											</div>
									<?php }
										$str=category_description();
										if($cat_desc=get_field("cat_desc",get_category($cat))){?>
											<div class="cat-desc"><?php echo $cat_desc; ?></div>
									<?php 	}
									}

									wp_reset_postdata();
									?>
								</div>
							</div>
						<?php } elseif (is_category(array(46, 162, 172, 102, 144, 90, 132, 78, 120, 71, 108, 49, 150, 96, 138, 84, 126, 114, 156, 55))){ ?>
						<?php
							if ( get_query_var( 'paged' ) ) {
								$page = get_query_var( 'paged' );
							} else {
								$page = 1;
							}
						
							$args = array(
								'posts_per_page' => 10,
								'cat' => $cat,
								'paged' => $page,
								'orderby' => 'date',
								'order' => 'DESC'
							);

							$q = new WP_Query($args);
						
							if($q->have_posts()) {
								while($q->have_posts()){ $q->the_post(); ?>
									<div class="posts norm rozp clear">
										<div class="desc">
											<a href="<?php the_permalink() ?>">
												<div class="ttl l3"><?php the_title(); ?></div>
											</a>
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
									</div>
								<?php }
								the_posts_pagination();
							}
							wp_reset_postdata();
						
							/*the_posts_pagination( array(
								'end_size' => 1
							));*/
						?>
						<?php } elseif (is_category(201)) { ?>
							<div class="list-admin">		
								<div class="wrap">
									<?php wp_list_categories("orderby=id&show_count=0&use_desc_for_title=0&hide_empty=0&style=none&child_of=201"); ?>
								</div>
							</div>
						<?php } elseif (is_category(206)) { ?>
								<div class="albums">
								
								<?php 
								$args = array(
									'posts_per_page' => 10,
									'cat' => $cat,
									'orderby' => 'date',
									'order' => 'DESC'
								);

								$q = new WP_Query($args);
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
						<?php
									the_posts_pagination( array(
										'end_size' => 1,
									));
						?>
						<?php } elseif (get_queried_object()->parent == 201) { ?>
								<?php if(have_posts()) {
									while(have_posts()){ the_post(); ?>
										<a href="<?php the_permalink() ?>" class="l3"><?php the_title(); ?></a>
									<?php }
								}

								wp_reset_postdata();
								?>
						<?php } elseif (have_posts()) {
								if ( get_query_var( 'paged' ) ) {
									$page = get_query_var( 'paged' );
								} else {
									$page = 1;
								}
								
								$args = array(
									'posts_per_page' => 10,
									'cat' => $cat,
									'paged' => $page,
									'orderby' => 'date',
									'order' => 'DESC'
								);

								$q = new WP_Query($args);
								while($q->have_posts()){ $q->the_post(); ?>
									<div class="posts clear <?php if(is_category(array(44, 45))) { ?>comptns<?php } ?>">
										<?php if(!is_category(array(44, 45))) { ?>
										<a href="<?php the_permalink() ?>" class="photo">
											<?php echo get_the_post_thumbnail( $page->ID, 'medium'); ?>
										</a>
										<?php } ?>
										<div class="desc <?php if(is_category(array(44, 45))) { ?>date-ttl<?php } ?>" <?php if(is_category(array(44, 45))) { ?>style="padding-left:0;"<?php } ?>>
											<div class="info clear">
												<div class="date"><?php echo get_the_date('j.m.Y'); ?> <?php if(!is_category(array(44, 45))) { ?> в <?php the_time('G:i'); ?> <?php } ?></div>
												<?php
													$categories = get_the_category();

													if($categories and !is_category(array(44, 45))){
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
												<?php if(!is_category(array(44, 45))) { the_excerpt(); } ?>
											</a>
										</div>
									</div>
								<?php }
								
								wp_reset_postdata();

								the_posts_pagination( array(
									'end_size' => 1,
								));
							}
						?>
					</div>
				</div>
			</div>
			<aside><?php get_template_part( 'sidebar' ); ?></aside>
		</div>
	</div>
</section>

<?php get_footer(); ?>