<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) );?>" class="input-group df-widget-search-inner">
	<input type="search" class="form-control df-form-search" placeholder="Search" value="<?php echo get_search_query()?>" name="s" title="search">
	<!-- <input type="submit" class="submit button df-btn df-button-search" name="submit" value="<?php //_e('Search');?>" /> -->
	<input type="hidden" name="post_type" value="post" />
	<span class="input-group-btn">
		<button class="submit button df-btn df-button-search" type="submit" name="submit" value="<?php _e('Search', 'onfleek');?>">
			<span class="ion-search ion-search-large"></span>
		</button>
	</span>
</form>
