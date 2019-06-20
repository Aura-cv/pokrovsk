	<footer>
		<div class="container">
			<div class="top clear">
				<div class="col logos clear">
					<img src="/wp-content/themes/rada/images/logo.png" alt="">
					<img src="/wp-content/themes/rada/images/emblem.svg" alt="">
				</div>
				<div class="col2 name">
					<div class="l2">
						<?php _e('<!--:en-->Pokrovskaya district state<br> administration of the Donetsk region<!--:--><!--:ru-->Покровская районная государственная<br> администрация Донецкой области<!--:--><!--:ua-->Покровська районна державна<br> адміністрація Донецької області<!--:-->'); ?>
					</div>
					<div class="of l5"><?php _e('<!--:en-->Official website<!--:--><!--:ru-->Официальный веб-сайт<!--:--><!--:ua-->Офіційний веб-сайт<!--:-->'); ?></div>
				</div>
				<div class="col right">
					<div class="vision clear">
						<div class="icon"></div>
						<div class="text">
							<?php echo do_shortcode( '[bvi]' ); ?>
							<?php _e('<!--:en-->Version for people<br> with visual impairment<!--:--><!--:ru-->Версия для людей<br> с нарушением зрения<!--:--><!--:ua-->Версія для людей<br> із порушенням зору<!--:-->'); ?>
						</div>
					</div>
				</div>
			</div>
			<?php
				wp_nav_menu( array(
					'theme_location'  => 'header_menu',
					'menu'            => '', 
					'container'       => '',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'clear',
					'menu_id'         => '',
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'items_wrap'      => '<ul id="masonry-grid" class="list">%3$s</ul>',
					'depth'           => 0,
					'walker'          => '',
				) );
			?>
			<div class="bottom clear">
				<ul class="fullinform">
					<li>
						<div class="ttl"><?php _e('<!--:en-->Address:<!--:--><!--:ru-->Адрес:<!--:--><!--:ua-->Адреса:<!--:-->'); ?></div>
						<div class="addr"><?php _e('<!--:en-->85300, Pokrovsk,<br> square Shibankova, 11<!--:--><!--:ru-->85300, г. Покровск,<br> пл. Шибанкова, 11<!--:--><!--:ua-->85300, м. Покровськ,<br> пл. Шибанкова, 11<!--:-->'); ?></div>
					</li>
					<li>
						<div class="ttl"><?php _e('<!--:en-->Phone:<!--:--><!--:ru-->Телефон:<!--:--><!--:ua-->Телефон:<!--:-->'); ?></div>
						<a href="tel:0623521318">(0623) 52-13-18</a>
					</li>
					<li>
						<div class="ttl"><?php _e('<!--:en-->Fax:<!--:--><!--:ru-->Факс:<!--:--><!--:ua-->Факс:<!--:-->'); ?></div>
						<a href="tel:0623521318">(0623) 52-13-18</a>
					</li>
					<li>
						<div class="ttl">Email:</div>
						<a href="mailto:krs.a@dn.gov.ua">krs.a@dn.gov.ua</a>
					</li>
				</ul>
				<div class="copyright"><?php _e('<!--:en-->Site development<!--:--><!--:ru-->Разработка сайта<!--:--><!--:ua-->Розробка сайту<!--:-->'); ?> <a href="#" class="bold">pavlov.ua</a></div>
				<div class="col right clear">
					<div class="search clear">
						<div><?php _e('<!--:en-->Search<!--:--><!--:ru-->Поиск<!--:--><!--:ua-->Пошук<!--:-->'); ?></div>
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16.6">
						  <path d="M15.8 15.1l-4-4.1a6.7 6.7 0 1 0-5.1 2.4 6.6 6.6 0 0 0 3.8-1.2l4 4.1a.9.9 0 1 0 1.3-1.2zM6.7 1.7a5 5 0 1 1-5 5 5 5 0 0 1 5-5z"/>
						</svg>
					</div>
					<!--<div class="lang up white">
						<?php qtranxf_generateLanguageSelectCode('dropdown', 'language'); ?>
					</div>-->
				</div>
			</div>
		</div>
	</footer>
	<div class="searchform">
		<div class="container">
			<?php get_search_form(); ?>
		</div>
	</div>
	<div class="wrapbg"></div>


<script>
	jQuery(document).ready( function($){
	$('section:contains("View Fullscreen")').each(function(){
    $(this).html($(this).html().split("View Fullscreen").join(""));
});
});
</script>
	
<?php wp_footer(); ?>
</body>
</html>