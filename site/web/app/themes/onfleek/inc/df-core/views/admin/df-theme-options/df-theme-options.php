<?php
	$documentation = 'http://dahz.daffyhazan.com/onfleek/docs';
	$support = 'http://support.daffyhazan.com/';
?>
<div class="to-wrap">
	<div class="df-aside">
		<div class="df-logo">
		   <img src="<?php echo esc_url(DF_Global_Options::$menu_list['option_list']['panel_logo']);?>" class="img-responsive">
		   <?php echo esc_html(DF_Global_Options::$menu_list['option_list']['title']); ?>
		</div>
		<ul class="df-navbar tabs" id="side-menu">
			<?php
				$collapse='collapse';
				$active='active';
				foreach(DF_Global_Options::$menu_list['option_list']['options'] as $option_id=>$option){
					if($option['is_parent']){
				?>
				<li class="sub-menu">
					<a href='#<?php echo esc_attr($option['href']);?>'> <i class='<?php echo esc_attr($option['icon']);?>'></i><?php echo esc_html($option['text']);?> </a>
					<ul class="df-navbar df-submenu <?php echo esc_attr($collapse);?>">
						<?php
						$collapse='';
						} else if($option['end_child']){
						?>
						<li class="<?php echo esc_attr($active);?>">
							<a href='#<?php echo esc_attr($option['href']);?>' id='<?php echo esc_attr($option_id);?>'>
								<i class='<?php echo esc_url($option['icon']);?>'></i> <?php echo esc_html($option['text']);?>
							</a>
						</li>
					</ul>
				</li>
			<?php
						$active='';
					} else {
			?>
				<li class="<?php echo esc_attr($active);?>">
					<a href='#<?php echo esc_attr($option['href']);?>' id='<?php echo esc_attr($option_id);?>'>
					<i class='<?php echo esc_attr($option['icon']);?>'></i> <?php echo esc_html($option['text']);?>
					</a>
				</li>
			<?php
						$active='';
					};
				}
			?>
		</ul>
	</div>
	<div class="df-main">
		<div class="df-to-header">
			<div class="df-button-to-header">
				<a href="<?php printf( esc_url( $documentation ) );?>" class="df-btn-to" target="_blank"><i class="fa fa-file-o"></i> Documentation</a>
				<a href="<?php printf( esc_url( $support ) );?>" class="df-btn-to btn-forum" target="_blank"><i class="fa fa-life-ring"></i> Forum</a>
			</div>
		</div>
		<form method="post" id="theme-options">
			<div class="df-to-content">
			<div class="df-col-1 df-to-section">
				<div class="btn-wrapp">
					<button class="btn btn-default btn-save df-button-save" /><?php _e( 'Save Options', 'onfleek' ); ?></button>
					<button type="button" class="btn btn-default df-btn-edit df-button-reset-section"><?php _e('Reset Section', 'onfleek');?></button>
					<button type="button" class="btn btn-default df-btn-edit df-button-reset-all"><?php _e('Reset All', 'onfleek');?></button>
				</div>
			</div>
			<div class="df-view">
				<div class="pre-loader"><img src="<?php echo get_template_directory_uri().'/inc/df-core/asset/images/admin/loader.gif';?>" class="img-responsive loader"></div>
			<?php
			$active='active in';
				foreach(DF_Global_Options::$menu_list['option_list']['options'] as $option_id=>$option){
					if(!$option['is_parent']){
						if(isset($option['view'])){
							if($option['href']=='additional-sidebar'){
			?>
							<div class="tab-pane fade " id="<?php echo esc_attr($option['href']);?>">
			<?php
								require get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/sidebars/additional-sidebar.php';
			?>	
							</div>
			<?php
							} else {
					?>
								<div class="tab-pane fade <?php echo esc_attr($active);?>" id="<?php echo esc_attr($option['href']);?>" data-content="none"></div>
					<?php
							$active='';
							}
						}
					}
				}
			?>
			</div>
			</div>
			<div class="df-col-1 df-no-padding">
				<div class="btn-wrapp">
					<button class="btn btn-default btn-save df-button-save" /><?php _e( 'Save Options', 'onfleek' ); ?></button>
					<button type="button" class="btn btn-default df-btn-edit df-button-reset-section"><?php _e('Reset Section', 'onfleek');?></button>
					<button type="button" class="btn btn-default df-btn-edit df-button-reset-all"><?php _e('Reset All', 'onfleek');?></button>
				</div>
			</div>
		</form>
	</div>
</div>

