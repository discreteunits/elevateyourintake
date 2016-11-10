var dfTOMenu = new function(){
	this.content = [];
	this.selector = [];
	this.links = [];
	this.active = [];
	this.init = function(){
		
		
		dfTOMenu.selector = jQuery('ul.tabs');
		dfTOMenu.links = jQuery('ul.tabs').find('a');
		dfTOMenu.active = jQuery(dfTOMenu.links.filter('[href="'+location.hash+'"]')[0] || dfTOMenu.links[0]);
		dfTOMenu.content = jQuery(dfTOMenu.active.attr('href'));
		dfTOMenu.bindMenu();
	}
	this.bindMenu = function(){
		
		dfTOMenu.selector.on('click', 'a', function(e){
			
			dfTOMenu.active.removeClass('active');
			dfTOMenu.content.hide();
			dfTOMenu.active = jQuery(this);
			dfTOMenu.content = jQuery(jQuery(this).attr('href'));
			dfThemeOptions.contentID = dfTOMenu.content;
			dfThemeOptions.menuID = jQuery(this).attr('id');
			
			dfTOMenu.active.addClass('active');
			if(dfTOMenu.content.attr('data-content') == 'none' ){
				dfTOMenu.selector.unbind('click');
				dfThemeOptions.dfAjaxCall("df_load_extended_view",dfTOMenu.active.attr('id'),function(response){
					dfTOMenu.content.html(response);
					if( dfTOMenu.content.attr('id') !== 'demo-import' ){
						dfTOMenu.content.removeAttr('data-content');
						dfThemeOptions.preInit(dfTOMenu.content);
						var opened={'contentID':dfTOMenu.content,'menuID':dfTOMenu.active.attr('id')};
						dfThemeOptions.openedMenu.push(opened);
					} else {
						dfTOMenu.content.show();
						dfThemeOptions.preInit(dfTOMenu.content);
					}
					dfTOMenu.bindMenu();
				})
			} else {
				dfTOMenu.content.show();
			}
			e.preventDefault();
		});
	
	}
	
}

jQuery(document).ready(function(jQuery){
	jQuery(".pre-loader").hide();
	jQuery("#additional-sidebar").hide();
	var $active, $content, $links = jQuery('ul.tabs').find('a');

	$active = jQuery($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);

	$content = jQuery($active.attr('href'));

	$links.not($active).each(function () {
		jQuery(jQuery('ul.tabs').attr('href')).hide();
	});
	
	dfTOMenu.init();

	jQuery('#df_global').click();
	
	jQuery(".df-navbar .sub-menu > a").click(function(e) {
		var menu=jQuery("#side-menu li ul");
		var subMenu=jQuery(this).parent().find('ul');
		if( subMenu.hasClass('collapse') ){
			menu.removeClass('collapse');
			subMenu.removeClass('collapse');
		} else {
			menu.removeClass('collapse');
			subMenu.addClass('collapse');
			firstChild=subMenu.find('li').first().find('a');
			firstChild.click();
		}
		jQuery(".df-navbar ul").slideUp(), jQuery(this).next().is(":visible") || jQuery(this).next().slideDown(),
		e.stopPropagation();
	});
	
	jQuery(".df-navbar .sub-menu .collapse").slideDown();
	dfThemeOptions.init();
	dfThemeOptions.sidebarInit();
	var opened={'contentID':jQuery('#additional-sidebar'),'menuID':'df_additional_sidebars'};
	dfThemeOptions.openedMenu.push(opened);
	 if(window.location.hash) {
	   var hash = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
	   hash = hash.split('=');
	   if (hash[0] == 'access_token') {
	   	window.location.href = 'admin.php?page=df_theme_options' + '&' + window.location.hash.substring(1)
	   }
  		
	 } 
	
			
});