<?php
	
?>
<form role="search" method="get" class="search-form clear page-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( '<!--:en-->Start search<!--:--><!--:ru-->Начать поиск<!--:--><!--:ua-->Почати пошук<!--:-->', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( '<!--:en-->Search<!--:--><!--:ru-->Поиск<!--:--><!--:ua-->Пошук<!--:-->: ', 'label' ) ?>" autocomplete="off" />
	<input type="submit" class="button search-submit" value="<?php echo esc_attr_x( '<!--:en-->Search<!--:--><!--:ru-->Поиск<!--:--><!--:ua-->Пошук<!--:-->', 'submit button' ) ?>" />
	<div class="close">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 371.2 371.2">
		  <path d="M371.2 21.2L350 0 185.6 164.4 21.2 0 0 21.2l164.4 164.4L0 350l21.2 21.2 164.4-164.4L350 371.2l21.2-21.2-164.4-164.4z"/>
		</svg>
	</div>
</form>