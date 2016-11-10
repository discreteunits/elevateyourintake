! function(o) {
	$colorhover = "", $textcolorhover = "";
	wp.customize("df_magz_theme_options[logo][logo_header_1]", function(t) {
		t.bind(function(t) {
			$bloginfo = wp.customize("blogname").get();
			if ( o("body").find(".df-header-1").length > 0 && "" != t ){
				 o("body").find(".df-logo-inner span").remove(),o("body").find("img.df-header-logo").attr("src", t)
			} else {
			  o("body").find("img.df-header-logo").removeAttr("src"), o("body").find(".df-logo-inner").append("<span>" + $bloginfo + "</span>")
			} 
		})
	}), wp.customize("df_magz_theme_options[logo][logo_header_2]", function(t) {
		t.bind(function(t) {
			$bloginfo = wp.customize("blogname").get();
			if ( o("body").find(".df-header-2").length > 0 && "" != t ){
				 o("body").find(".df-logo-inner span").remove(),o("body").find("img.df-header-logo").attr("src", t)
				
			} else {
			  o("body").find("img.df-header-logo").removeAttr("src"), o("body").find(".df-logo-inner").append("<span>" + $bloginfo + "</span>")
			} 
		})
	}),  wp.customize("df_magz_theme_options[logo][logo_header_3]", function(t) {
		t.bind(function(t) {
			$bloginfo = wp.customize("blogname").get();
			if ( o("body").find(".df-header-3").length > 0 && "" != t ){
				 o("body").find(".df-logo-inner span").remove(),o("body").find("img.df-header-logo").attr("src", t)
				
			} else {
			  o("body").find("img.df-header-logo").removeAttr("src"), o("body").find(".df-logo-inner").append("<span>" + $bloginfo + "</span>")
			} 
		})
	}),  wp.customize("df_magz_theme_options[logo][logo_header_4]", function(t) {
		t.bind(function(t) {
			$bloginfo = wp.customize("blogname").get();
			if ( o("body").find(".df-header-4").length > 0 && "" != t ){
				 o("body").find(".df-logo-inner span").remove(),o("body").find("img.df-header-logo").attr("src", t)
				
			} else {
			  o("body").find("img.df-header-logo").removeAttr("src"), o("body").find(".df-logo-inner").append("<span>" + $bloginfo + "</span>")
			} 
		})
	}),  wp.customize("df_magz_theme_options[logo][logo_header_5]", function(t) {
		t.bind(function(t) {
			$bloginfo = wp.customize("blogname").get();
			if ( o("body").find(".df-header-5").length > 0 && "" != t ){
				 o("body").find(".df-logo-inner span").remove(),o("body").find("img.df-header-logo").attr("src", t)
				
			} else {
			  o("body").find("img.df-header-logo").removeAttr("src"), o("body").find(".df-logo-inner").append("<span>" + $bloginfo + "</span>")
			} 
		})
	}),  wp.customize("df_magz_theme_options[logo][logo_header_6]", function(t) {
		t.bind(function(t) {
			$bloginfo = wp.customize("blogname").get();
			if ( o("body").find(".df-header-6").length > 0 && "" != t ){
				 o("body").find(".df-logo-inner span").remove(),o("body").find("img.df-header-logo").attr("src", t)
				
			} else {
			  o("body").find("img.df-header-logo").removeAttr("src"), o("body").find(".df-logo-inner").append("<span>" + $bloginfo + "</span>")
			} 
		})
	}), wp.customize("df_magz_theme_options[logo][sticky_header]", function(t) {
		t.bind(function(t) {
			$bloginfo = wp.customize("blogname").get();
			if (o("body").find("#wraper-outer-sticky .df-navbar-brand a img").length > 0 && "" != t){
				o("body").find("#wraper-outer-sticky .df-navbar-brand a img").attr("src", t)
			} else {
				o("body").find("#wraper-outer-sticky .df-navbar-brand a img").removeAttr("src"), o("body").find("#wraper-outer-sticky .df-navbar-brand a img").append("<span>" + $bloginfo + "</span>")
			}
		})
	}), 

	 wp.customize("df_magz_theme_options[logo][mobile_logo]", function(t) {
		t.bind(function(t) {
			$bloginfo = wp.customize("blogname").get();
			if ( o("body").find(".mobile-menu").length > 0 && "" != t ){
				 o("body").find(".df-logo-inner span").remove(),o("body").find(".mobile-menu img.df-header-logo").attr("src", t)
			} else {
			  o("body").find(".mobile-menu img.df-header-logo").removeAttr("src"), o("body").find(".df-logo-inner").append("<span>" + $bloginfo + "</span>")
			} 
		})
	}), 

	wp.customize("df_magz_theme_options[side_area][background][color]", function(t) {
		t.bind(function(t) {
			o("#page #df-side-menu").css("background-color", t)
		})
	}), wp.customize("df_magz_theme_options[side_area][background][position]", function(t) {
		t.bind(function(t) {
			o("#page #df-side-menu").css("background-position", t)
		})
	}), wp.customize("df_magz_theme_options[side_area][background][repeat]", function(t) {
		t.bind(function(t) {
			o("#page #df-side-menu").css("background-repeat", t)
		})
	}), wp.customize("df_magz_theme_options[side_area][background][attachment]", function(t) {
		t.bind(function(t) {
			o("#page #df-side-menu").css("background-attachment", t)
		})
	}), wp.customize("df_magz_theme_options[side_area][background][size]", function(t) {
		t.bind(function(t) {
			o("#page #df-side-menu").css("background-size", t)
		})
	}), wp.customize("df_magz_theme_options[side_area][background][image]", function(t) {
		t.bind(function(t) {
			o("#page #df-side-menu").css("background-image", 'url("' + t + '")')
		})
	}), wp.customize("df_magz_theme_options[side_area][enable_side_area]", function(t) {
		t.bind(function(t) {
			if ("no" == t){
				o(".df-navigator").css("display", "none"),o(".df-navigator").click()
			}  else {
				o(".df-navigator").css("display", "block")
			} 
		})
	}), wp.customize("df_magz_theme_options[side_area][widget_title]", function(t) {
		t.bind(function(t) {
			o("#df-side-menu .df-widget-title").css("color", t)
		})
	}), wp.customize("df_magz_theme_options[side_area][heading_element_color]", function(t) {
		t.bind(function(t) {
			o("#page #df-side-menu h1,#page #df-side-menu h5.df-widget-title,#page #df-side-menu h4 a,#page #df-side-menu h5 a").css("color", t)
		})
	}), wp.customize("df_magz_theme_options[side_area][heading_paragraph_color]", function(t) {
		t.bind(function(t) {
			o("#page #df-side-menu .widget_text .textwidget,.df-shortcode-blocks-main .article-content p").css("color", t)
		})
	}), wp.customize("df_magz_theme_options[side_area][link_color]", function(t) {
		t.bind(function(t) {
			o("#page #df-side-menu .post-meta-desc a,#df-side-menu .nano-content .widget .cat-item a,#df-side-menu .nano-content .widget_archive a").css("color", t)
		})
	}), wp.customize("df_magz_theme_options[color_style][general][heading_color]", function(t) {
		t.bind(function(t) {
			o("#df-wrapper-content-single header.td-post-tittle, #df-wrapper-content-single header h1, #df-content-wrapper .entry-title, .df-wraper #page h1, .df-wraper #page h2, .df-wraper #page h3, .df-wraper #page h4, .df-wraper #page h5, .df-wraper #page h6, .df-wraper #page h1 > a, .df-wraper #page h2 > a, .df-wraper #page h3 > a, .df-wraper #page h4 > a, .df-wraper #page h5 > a, .df-wraper #page h6 > a, #df-search-result h1 > a, #df-search-result h2 > a, #df-search-result h3 > a, #df-search-result h4 > a, #df-search-result h5 > a, #df-search-result h6 > a, .collapse-button i, #df-wrapper-content-single .df-wrapper-inner .container df-bg-content .content-single-wrap .df-post-content h1, #df-wrapper-content-single .vcard a, ul.tags li a, .authors-post .df-post-sharing li a, #search input[type='search']").css("color", t)
		})
	}), wp.customize("df_magz_theme_options[color_style][general][main_accent_color]", function(t) {
		t.bind(function(t) {
			o("#df-wrapper-content-single .authors-meta a,#df-wrapper-content-single dd a,#df-wrapper-content-single p a,#df-wrapper-content-single table  a,#df-wrapper-content-single .entry-content li a,#df-wrapper-content-single figcaption a,#df-wrapper-content-single a,#df-wrapper-content-single a ").css("color", t)
		})
	}), wp.customize("df_magz_theme_options[color_style][general][body_p_color]", function(t) {
		t.bind(function(t) {
			o(".df-wraper #page #df-content-wrapper p:not(.megamenu-item-title):not(.megamenu-item-date), #df-wrapper-content-single table, #df-wrapper-content-single li:not(.df-btn), #df-wrapper-content-single address, #df-wrapper-content-single dl, .page-numbers li.active span, #df-content-top-post .df-category-top-post.layout-5 p.article-content, .df-post-content .wp-caption-text, .entry-content ul li, .modal-search-caption, p.article-content").css("color", t)
		})
	}), wp.customize("df_magz_theme_options[color_style][general][blockquote_color]", function(t) {
		t.bind(function(t) {
			o("#df-content-wrapper blockquote p").css("color", t)
		})
	}), wp.customize("df_magz_theme_options[color_style][general][extra_color]", function(t) {
		t.bind(function(t) {
			o("#df-content-wrapper .post-meta li span,#df-content-wrapper .post-meta li a,#df-content-wrapper .post-meta a,#df-content-wrapper .social-sharing-count span,#df-content-wrapper .post-meta .post-meta-desc .post-meta-desc-top a,#df-content-wrapper .post-meta .post-meta-desc .post-meta-desc-btm a,.post-meta a,.entry-crumb li a,.post-meta li i,.post-meta li span,.post-meta .post-meta-desc a,.post-meta .meta-top a,.post-meta .meta-bottom a,.post-date").css("color", t)
		})
	}), wp.customize("df_magz_theme_options[color_style][button][button_text]", function(t) {
		t.bind(function(t) {
			o(".df-btn.df-btn-normal").css("color", t)
		})
	}), wp.customize("df_magz_theme_options[color_style][button][button_text_hover]", function(o) {
		o.bind(function(o) {
			$textcolorhover = o
		})
	}), wp.customize("df_magz_theme_options[color_style][button][button]", function(t) {
		t.bind(function(t) {
			o(".df-btn.df-btn-normal").css("background-color", t)
		})
	}), wp.customize("df_magz_theme_options[color_style][button][button]", function(t) {
		t.bind(function(t) {
			o(".df-btn.df-btn-normal").mouseout(function() {
				$colorhover = wp.customize("df_magz_theme_options[color_style][button][button_hover]").get(), $color_text = wp.customize("df_magz_theme_options[color_style][button][button_text]").get(), o(".df-btn.df-btn-normal").css("background-color", t), o(".df-btn.df-btn-normal").css("color", $color_text), o(".df-btn.df-btn-normal").mouseover(function() {
					o(".df-btn.df-btn-normal").css("background-color", $colorhover), o(".df-btn.df-btn-normal").css("color", $textcolorhover)
				})
			})
		})
	}), wp.customize("df_magz_theme_options[color_style][button][button_hover]", function(t) {
		t.bind(function(t) {
			o(".df-btn.df-btn-normal").mouseover(function() {
				o(".df-btn.df-btn-normal").css("background-color", t), o(".df-btn.df-btn-normal").css("color", $textcolorhover), $buttoncolor = wp.customize("df_magz_theme_options[color_style][button][button]").get(), $buttontextcolor = wp.customize("df_magz_theme_options[color_style][button][button_text]").get(), o(".df-btn.df-btn-normal").mouseout(function() {
					o(".df-btn.df-btn-normal").css("background-color", $buttoncolor), o(".df-btn.df-btn-normal").css("color", $buttontextcolor)
				})
			})
		})
	}), wp.customize("df_magz_theme_options[footer][background][color]", function(t) {
		t.bind(function(t) {
			o(" .df-container-footer ").css("background-color", t)
		})
	}), wp.customize("df_magz_theme_options[footer][background][position]", function(t) {
		t.bind(function(t) {
			o(" .df-container-footer ").css("background-position", t)
		})
	}), wp.customize("df_magz_theme_options[footer][background][repeat]", function(t) {
		t.bind(function(t) {
			o(" .df-container-footer ").css("background-repeat", t)
		})
	}), wp.customize("df_magz_theme_options[footer][background][attachment]", function(t) {
		t.bind(function(t) {
			o(" .df-container-footer ").css("background-attachment", t)
		})
	}), wp.customize("df_magz_theme_options[footer][background][size]", function(t) {
		t.bind(function(t) {
			o(" .df-container-footer ").css("background-size", t)
		})
	}), wp.customize("df_magz_theme_options[footer][background][image]", function(t) {
		t.bind(function(t) {
			o(" .df-container-footer ").css("background-image", 'url("' + t + '")')
		})
	}), wp.customize("df_magz_theme_options[footer][top_border][color]", function(t) {
		t.bind(function(t) {
			o(" .df-container-footer ").css("border-top-color", t)
		})
	}), wp.customize("df_magz_theme_options[footer][top_border][style]", function(t) {
		t.bind(function(t) {
			o(" .df-container-footer:nth-of-type(1) ").css("border-top-style", t)
		})
	}), wp.customize("df_magz_theme_options[footer][top_border][border]", function(t) {
		t.bind(function(t) {
			o(" .df-container-footer:nth-of-type(1) ").css("border-top-width", t + "px")
		})
	}), wp.customize("df_magz_theme_options[footer][bottom_border][color]", function(t) {
		t.bind(function(t) {
			o(" .df-container-footer:nth-of-type(1) ").css("border-bottom-color", t)
		})
	}), wp.customize("df_magz_theme_options[footer][bottom_border][style]", function(t) {
		t.bind(function(t) {
			o(" .df-container-footer:nth-of-type(1) ").css("border-bottom-style", t)
		})
	}), wp.customize("df_magz_theme_options[footer][bottom_border][border]", function(t) {
		t.bind(function(t) {
			o(" .df-container-footer:nth-of-type(1) ").css("border-bottom-width", t + "px")
		})
	}), wp.customize("df_magz_theme_options[footer][subfooter][background][color]", function(t) {
		t.bind(function(t) {
			o(".df-container-subfooter").css("background-color", t)
		})
	}), wp.customize("df_magz_theme_options[footer][subfooter][background][position]", function(t) {
		t.bind(function(t) {
			o(" .df-container-subfooter ").css("background-position", t)
		})
	}), wp.customize("df_magz_theme_options[footer][subfooter][background][repeat]", function(t) {
		t.bind(function(t) {
			o(" .df-container-subfooter").css("background-repeat", t)
		})
	}), wp.customize("df_magz_theme_options[footer][subfooter][background][attachment]", function(t) {
		t.bind(function(t) {
			o(" .df-container-subfooter ").css("background-attachment", t)
		})
	}), wp.customize("df_magz_theme_options[footer][subfooter][background][size]", function(t) {
		t.bind(function(t) {
			o(" .df-container-subfooter").css("background-size", t)
		})
	}), wp.customize("df_magz_theme_options[footer][subfooter][background][image]", function(t) {
		t.bind(function(t) {
			o(" .df-container-subfooter ").css("background-image", 'url("' + t + '")')
		})
	}), wp.customize("df_magz_theme_options[footer][subfooter_text_color]", function(t) {
		t.bind(function(t) {
			o(" .df-footer-copyright .df-copyright,.df-footer-copyright ul li a ").css("color", t)
		})
	}), wp.customize("df_magz_theme_options[footer][footer_widget_title_color]", function(t) {
		t.bind(function(t) {
			o(" #df-footer-wrapper h5.df-widget-title , #df-footer-wrapper h5.df-heading").css("color", t)
		})
	}), wp.customize("df_magz_theme_options[footer][footer_heading_color]", function(t) {
		t.bind(function(t) {
			o("#page #df-footer-wrapper h1 a, #page #df-footer-wrapper h2 a, #page #df-footer-wrapper h3 a, #page #df-footer-wrapper h4 a, #page #df-footer-wrapper h5 a, #page #df-footer-wrapper h6 a").css("color", t)
		})
	}), wp.customize("df_magz_theme_options[footer][footer_p_color]", function(t) {
		t.bind(function(t) {
			o("#df-footer-wrapper .df-container-footer,#df-footer-wrapper .df-container-footer div p,#df-footer-wrapper .df-container-footer span,#df-footer-wrapper .df-container-footer p").css("color", t)
		})
	}), wp.customize("df_magz_theme_options[footer][footer_link_color]", function(t) {
		t.bind(function(t) {
			o("#df-footer-wrapper .df-container-footer a, #df-footer-wrapper .df-container-footer a:hover").css("color", t)
		})
	}), wp.customize("df_magz_theme_options[footer][footer_border_color]", function(t) {
		t.bind(function(t) {
		   o("#df-footer-wrapper .widget_archive select,#df-footer-wrapper .widget_archive a,#df-footer-wrapper .widget_categories select,#df-footer-wrapper .widget_categories a,#df-footer-wrapper .widget_nav_menu a,#df-footer-wrapper .widget_meta a,#df-footer-wrapper .widget_pages a,#df-footer-wrapper #recentcomments li,#df-footer-wrapper .widget_recent_entries li,#df-footer-wrapper .df-form-search,#df-footer-wrapper button.df-button-search,#df-footer-wrapper .tagcloud a,#df-footer-wrapper .df-separator,#df-footer-wrapper #df-widget-popular-tab ul.df-nav-tab li,#df-footer-wrapper #df-widget-popular-tab .tab-pane.df-tab-pane,#df-footer-wrapper #df-widget-popular-tab .df-most-popular-list").css("border-color", t)
		})
	}), wp.customize("df_magz_theme_options[sidebars][background_color]", function(t) {
		t.bind(function(t) {
			o("section.widget").css("background-color", t)
		})
	}), wp.customize("df_magz_theme_options[sidebars][widget_title_color]", function(t) {
		t.bind(function(t) {
			o("section.widget .df-widget-title").css("color", t)
		})
	}), wp.customize("df_magz_theme_options[sidebars][heading_element_color]", function(t) {
		t.bind(function(t) {
			o(".widget .widget-article-title a,.sidebar .widget .df-thumbnail-title h5,#page .widget .df-thumbnail-title h4,.df-wraper #df-content-wrapper .sidebar h5.article-title a,.df-wraper #df-content-wrapper .sidebar h4.article-title a").css("color", t)
		})
	}), wp.customize("df_magz_theme_options[sidebars][p_element_color]", function(t) {
		t.bind(function(t) {
			o("#wp-calendar tbody th,#wp-calendar tbody td,.widget_text .textwidget,.widget_tag_cloud .tagcloud a,.df-wraper .content-single-wrap .sidebar .widget p,.df-wraper .df-archive-wrapper-inner .sidebar .widget p").css("color", t)
		})
	}), wp.customize("df_magz_theme_options[sidebars][extra_color]", function(t) {
		t.bind(function(t) {
			o("#df-wrapper-content-single .sidebar .post-meta li span, #df-wrapper-content-single .sidebar .post-meta li a, #df-wrapper-content-single .sidebar .social-sharing-count span,#df-wrapper-content-single .sidebar .post-meta a,.sidebar .entry-crumb li a").css("color", t)
		})
	}), wp.customize("df_magz_theme_options[sidebars][link_color]", function(t) {
		t.bind(function(t) {
			o(".df-wraper .content-single-wrap .sidebar .widget a,.df-wraper #df-content-wrapper .sidebar .widget a").css("color", t)
		})
	}), wp.customize("df_magz_theme_options[sidebars][border_color]", function(t) {
		t.bind(function(t) {
			o("section.widget.widget_archive select, section.widget.widget_archive a,section.widget.widget_categories select, section.widget.widget_categories a, section.widget.widget_nav_menu a, section.widget.widget_meta a, section.widget.widget_pages a,section.widget #recentcomments li,section.widget.widget_recent_entries li,section.widget .df-form-search,section.widget button.df-button-search,section.widget .tagcloud a,section.widget .df-separator,section.widget #df-widget-popular-tab ul.df-nav-tab li,section.widget #df-widget-popular-tab .tab-pane.df-tab-pane,section.widget #df-widget-popular-tab .df-most-popular-list,.df-wraper .content-single-wrap .sidebar .widget a,.df-wraper .df-archive-wrapper-inner .sidebar .widget a").css("border-color", t)
		})
	})
}(jQuery);