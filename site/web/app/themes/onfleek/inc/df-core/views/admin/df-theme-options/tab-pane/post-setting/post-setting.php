	<div class="df-to-content-inner">
   		<div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Post Layout</h4>
                    <span class="description">Choose the default layout of your post</span>
                </div>
            </div>
            <div class="df-col-2">
               	<?php
               		DF_Element_Generator::df_html_visual_select(array(
						'name' => array('post_setting','layout'),
						'class'=>'df-to-styled-select',
						'options' => array(
                            array(
                            	'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/post-style-1.png',
                            	'value' => 'layout-1'
                            ),
                            array(
                            	'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/post-style-2.png',
                            	'value' => 'layout-2'
                            ),
                            array(
                            	'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/post-style-3.png',
                            	'value' => 'layout-3'
                            ),
                            array(
                            	'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/post-style-4.png',
                            	'value' => 'layout-4'
                            ),
                            array(
                            	'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/post-style-5.png',
                            	'value' => 'layout-5'
                            ),
                            array(
                            	'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/post-style-6.png',
                            	'value' => 'layout-6'
                            ),
                            array(
                            	'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/post-style-7.png',
                            	'value' => 'layout-7'
                            ),
                            array(
                            	'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/post-style-8.png',
                            	'value' => 'layout-8'
                            ),
                            array(
                            	'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/post-style-9.png',
                            	'value' => 'layout-9'
                            ),
                        )
					));
               	?>
			
            </div>
        </div>
        <div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Feature Image</h4>
					<span class="description">Enable/Disable Feature image in single post</span>
			</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_switch(array(
						'name'=>array('post_setting','is_feature_image')
					));
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Feature Image Lightbox</h4>
					<span class="description">Enabling this option will add lightbox feature when you click the featured image</span>
			</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_switch(array(
						'name'=>array('post_setting','is_feature_image_lightbox')
					));
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Enable Categories</h4>
					<span class="description">Enabling this option will let you show categories meta tag in your single post</span>
			</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_switch(array(
						'name'=>array('post_setting','is_show_categories_tag')
					));
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Enable Author</h4>
					<span class="description">Enabling this option will let you show author name meta tag in your single post</span>
			</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_switch(array(
						'name'=>array('post_setting','is_show_author_name')
					));
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Enable Date</h4>
					<span class="description">Enabling this option will let you show date meta tag in your single post</span>
			</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_switch(array(
						'name'=>array('post_setting','is_show_date')
					));
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Enable Post View Counter</h4>
					<span class="description">Enabling this option will let you show post view meta tag in your single post</span>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_switch(array(
						'name'=>array('post_setting','is_show_post_views')
					));
				?>
			</div>
        </div>

		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Enable Tags</h4>
					<span class="description">Enabling this option will let you show tags in your single post</span>
			</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_switch(array(
						'name'=>array('post_setting','is_show_tag')
					));
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Enable Comment Counts</h4>
					<span class="description">Enabling this option will let you show commnet counts meta tag in your single post</span>
			</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_switch(array(
						'name'=>array('post_setting','is_show_comment_counts')
					));
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Enable Author box</h4>
					<span class="description">Enabling this option will let you show author information box in your single post</span>
			</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_switch(array(
						'name'=>array('post_setting','is_show_author_box')
					));
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Enable Next and Previous Post button</h4>
					<span class="description">Enabling this option will add a Next and Previous button under your post</span>
			</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_switch(array(
						'name'=>array('post_setting','is_show_next_prev_post')
					));
				?>
			</div>
		</div>

	<h3>Sharing</h3>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Enable Top Share Button</h4>
					<span class="description">Enabling this option will add sharing buttons right before your post</span>
			</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_switch(array(
						'name'=>array('post_setting','is_top_article_sharing')
					));
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Enable Bottom Share Button</h4>
					<span class="description">Enabling this option will add sharing buttons under your post</span>
			</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_switch(array(
						'name'=>array('post_setting','is_bottom_article_sharing')
					));
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Enable Sticky Share Button</h4>
					<span class="description">Enabling this option will add sharing buttons on your sticky header</span>
			</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_switch(array(
						'name'=>array('post_setting','is_sticky_menu_article_sharing')
					));
				?>
			</div>
		</div>
	<h3>Related Article (You May Also Like)</h3>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Enable Related Post</h4>
					<span class="description">Enabling this option will let you show Related Posts section under your posts</span>
			</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_switch(array(
						'name'=>array('post_setting','is_related_article')
					));
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Number Of Related Post</h4>
					<span class="description">Choose the number of Related Posts displayed under your posts</span>
			</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_numeric(array(
						'name'		=> array('post_setting','number_of_related_post'),
						'class'		=> 'df-input-styled', 
					));
				?>
			</div>
		</div>
		<h3>Infinite loading on Article Pages</h3>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Infinite loading</h4>
					<span class="description">This will alter the overall styling of various theme elements</span>
			</div>
			</div>
			<div class="df-col-2">
			<?php
				DF_Element_Generator::df_html_switch(array(
					'name'=>array('post_setting','infinite_loading')
				));
			?>
			</div>
		</div>
