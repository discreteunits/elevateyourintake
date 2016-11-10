'use strict';
var DFMetaBox = new function () {
    this.init = function () {

      DFMetaBox.init_page_attr();
      DFMetaBox.init_post_format();
      DFMetaBox.background_click_ads_post();
      DFMetaBox.background_click_ads_page();
      DFMetaBox.reviewSectionInit();
      DFMetaBox.menuMeta();
    }

    this.menuMeta = function () {
      jQuery('.df-section').hide();
      jQuery( '#general' ).fadeIn( "slow" );
      jQuery('.df-menu ul li:eq(0)').addClass('active');
      jQuery('.df-menu').height(jQuery('.df-content').height());
      jQuery('.df-menu a').on('click', function () {
        jQuery('.df-section').hide();
        var section = jQuery(this).attr('href');
        jQuery( section ).fadeIn( "slow" );
        jQuery( ".df-menu li" ).removeClass( "active");
        jQuery(this).parent().addClass("active");
        jQuery('.df-menu').height(jQuery('.df-content').height());
        return false;
      });
    }
    /*df ads background*/
    this.background_click_ads_post = function () {
      var ads_background_type   = jQuery('#df_magz_post_ads_background_type');
      var details = jQuery('#background_ads_detail'); 
      if (ads_background_type.val() == 'custom') {
        details.show();
      }else {
        details.hide();
      }

      ads_background_type.on('change', function () {

        if ( ads_background_type.val() == 'custom' ) {

          details.slideDown();

        }else {

          details.slideUp();

        }

      });
    }
    this.init_page_attr = function () {
      DFMetaBox.page_template_behaviour();
      jQuery('#page_template').on('change', function (){
           DFMetaBox.page_template_behaviour();
      })

    }

    this.page_template_behaviour = function () {
      var page_template = jQuery('#page_template').val();
      if ( ( "default" == page_template ) || ( "page-pagebuilder.php" == page_template ) ) {
        jQuery( '.df-menu a[href="#postsetting"]' )
          .parent()
          .hide()
          .removeClass( 'active' );
        jQuery( '#postsetting' ).hide();
        // jQuery( '.df-menu a[href="#uniquearticle"]' )
        //   .parent()
        //   .hide()
        //   .removeClass('active');
        // jQuery( '#uniquearticle' ).hide();
        jQuery( '.df-menu li:eq(0)' ).addClass('active');
        var default_section = jQuery( '.df-menu li:eq(0) a' ).attr('href');
        jQuery( default_section ).show();
      }else {
        jQuery( '.df-menu a[href="#postsetting"]' )
          .parent()
          .show();
        // jQuery( '.df-menu a[href="#uniquearticle"]' )
        //   .parent()
        //   .show();
      }
    }
    this.init_post_format = function () {
      DFMetaBox.post_format_behaviour();
      jQuery('input[name=post_format]').on('click', function (){
           DFMetaBox.post_format_behaviour();
      })
    }
    this.post_format_behaviour = function () {
      var post_format =  jQuery("input[name=post_format]:checked").val() ;
        if ( ( "audio" == post_format ) || ( "video" == post_format ) ) {
          jQuery("#df_magz_post .cmb-type-df-post-layout li:eq(1),#df_magz_post  .cmb-type-df-post-layout li:eq(2), #df_magz_post  .cmb-type-df-post-layout li:eq(3) , #df_magz_post .cmb-type-df-post-layout li:eq(9)").hide();
          jQuery("#df_magz_post .cmb-type-df-post-layout li:eq(6), #df_magz_post .cmb-type-df-post-layout li:eq(7), #df_magz_post .cmb-type-df-post-layout li:eq(8) ").show();
        } else {
          jQuery("#df_magz_post .cmb-type-df-post-layout li:eq(6), #df_magz_post .cmb-type-df-post-layout li:eq(7), #df_magz_post .cmb-type-df-post-layout li:eq(8) ").hide();
          jQuery("#df_magz_post .cmb-type-df-post-layout li:eq(1), #df_magz_post .cmb-type-df-post-layout li:eq(2), #df_magz_post .cmb-type-df-post-layout li:eq(3) , #df_magz_post .cmb-type-df-post-layout li:eq(9)").show();
        }
    }
    this.background_click_ads_page = function () {
      var ads_background_type   = jQuery('#df_magz_page_ads_background_type');
      var details = jQuery('#background_ads_detail'); 
      if (ads_background_type.val() == 'custom') {
        details.show();
      }else {
        details.hide();
      }

      ads_background_type.on('change', function () {

        if ( ads_background_type.val() == 'custom' ) {

          details.slideDown();

        }else {

          details.slideUp();

        }

      });
    }
    /*End df ads background*/

    /*df Review Section */
    this.reviewSectionInit = function () {
        DFMetaBox.reviewTypeSelect();
        DFMetaBox.pointReviewInit();
        DFMetaBox.starsReviewInit();
        DFMetaBox.percentReviewInit();
    }

    this.reviewTypeSelect = function () {

        var reviewType   = jQuery('#df_magz_post_review_post');
        var reviewPointSection = jQuery('.review_point');
        var reviewPercentSection = jQuery('.review_percent');
        var reviewStarsSection = jQuery('.review_stars');
        var featureNameSection = jQuery('.cmb2-id-df-magz-post-feature-reviews');
        var reviewLocationSection = jQuery('.cmb2-id-df-magz-post-review-location');
        var reviewSummarySection = jQuery('.cmb2-id-df-magz-post-summary');
        var reviewPositiveTitleSection = jQuery('.cmb2-id-df-magz-post-positive-title')

        if ( reviewType.val() == 'point' ) {
          reviewPointSection.show();
          reviewPercentSection.hide();
          reviewStarsSection.hide();
        }else if ( reviewType.val() == 'percentage' ){
          reviewPointSection.hide();
          reviewStarsSection.hide()
          reviewPercentSection.show()    
        }else if  ( reviewType.val() == 'stars' ){
          reviewPointSection.hide();
          reviewPercentSection.hide()
          reviewStarsSection.show();
        }else {
          reviewPointSection.hide();
          reviewPercentSection.hide();
          reviewStarsSection.hide();
          featureNameSection.hide();
          reviewLocationSection.hide();
          reviewSummarySection.hide();
          reviewPositiveTitleSection.hide();
        }


        reviewType.on('change', function () {
        //alert(reviewType.val() );
        if ( reviewType.val() == 'point' ) {
          reviewPointSection.show();
          reviewPercentSection.hide();
          reviewStarsSection.hide();
          featureNameSection.show();
          reviewLocationSection.show();
          reviewSummarySection.show();  
          reviewPositiveTitleSection.show();
        }else if ( reviewType.val() == 'percentage' ){
          reviewPointSection.hide();
          reviewStarsSection.hide();
          reviewPercentSection.show();
          featureNameSection.show();
          reviewLocationSection.show();
          reviewSummarySection.show();
          reviewPositiveTitleSection.show();
        }else if  ( reviewType.val() == 'stars' ){
          reviewPointSection.hide();
          reviewPercentSection.hide();
          reviewStarsSection.show();
          featureNameSection.show();
          reviewLocationSection.show();
          reviewSummarySection.show(); 
          reviewPositiveTitleSection.show();
        }else {
          reviewPointSection.hide();
          reviewPercentSection.hide();
          reviewStarsSection.hide();
          featureNameSection.hide();
          reviewLocationSection.hide(); 
          reviewSummarySection.hide(); 
          reviewPositiveTitleSection.hide();
        }

        });
    }

    this.pointReviewInit = function () {
       jQuery('.delete_point_value').unbind('click');
       jQuery('.copy_review_point').unbind('click');
       jQuery('.delete_point_value').on('click', function () {
            var confirmation = confirm("This action can not be undone, are you sure?");
            
            if ( confirmation == true ) {

              var countDiv = jQuery('.review_box.review_point input').length;
              var countDiv = countDiv/2;
              var divIDtoRemove = parseInt( jQuery(this).attr('data-id') );
              /*Remove selected Div*/
              jQuery('.review_box_wrap[data-id="' + divIDtoRemove + '"]').remove();

              /*Update iterator all input element and button*/

              for (var i = 0; i < countDiv ; i++ ) {
                
                  if ( i > divIDtoRemove ) {
                    var newValue =  i - 1 ;
                    /* change div wraper data-id*/
                    jQuery('.review_box_wrap[data-id="' + i + '"]').attr('data-id', newValue);
                    jQuery('#df_magz_post_feature_reviews_review_points_name_' + i ).attr('name', 'df_magz_post_feature_reviews[_review_points_name][' + newValue +']' );
                    jQuery('#df_magz_post_feature_reviews_review_points_name_' + i ).attr('id', 'df_magz_post_feature_reviews_review_points_name_' + newValue );
                    jQuery('#df_magz_post_feature_reviews_review_points_value_' + i ).attr('name', 'df_magz_post_feature_reviews[_review_points_value][' + newValue +']'  );
                    jQuery('#df_magz_post_feature_reviews_review_points_value_' + i ).attr('id', 'df_magz_post_feature_reviews_review_points_value_' + newValue );
                    jQuery('.delete_point_value[data-id="' + i + '"]').attr('data-id', newValue);
                    
                  }

              }

            } 
            /*Reinit point Review*/
            DFMetaBox.pointReviewInit();

            return false;
        }); 
        
        jQuery('.copy_review_point').on('click', function () {
          var next_id = jQuery('.review_box.review_point input').length;
          var next_id = next_id/2;
          var element = '<div class="review_box_wrap" data-id="' + next_id + '"><input type="text" id="df_magz_post_feature_reviews_review_points_' + next_id +'_name" name="df_magz_post_feature_reviews[_review_points_name][' + next_id +']" class="regular-text name df-cmb-input-styled">';
          element = element + ' <input type="number" max="10" id="df_magz_post_feature_reviews_review_points_value_' + next_id +'" name="df_magz_post_feature_reviews[_review_points_value][' + next_id +']" class="regular-text value df-value">';
          element = element + '<a class="button delete_point_value" data-id="' + next_id +'" href="#">Delete</a>';
          element = element + '<a class="button reorder" href="#"><i class="dashicons dashicons-sort"></i></a></div>';
          jQuery( element ).insertBefore('.copy_review_point');
           
           /*Reinit point Review*/
            DFMetaBox.pointReviewInit();

          return false;
        });

        jQuery('.review_point .review_box_wrap .button.reorder').mousedown(function() {
            
            jQuery( '.review_point' ).sortable({
                    update: function(event, ui) {
                         jQuery(".review_point .review_box_wrap").each(function( index, value  ){
                                    var lastID = jQuery(this).data('id');
                                    jQuery(this).children( '.name' ).attr('name', 'df_magz_post_feature_reviews[_review_points_name][' + index +']' );
                                    jQuery(this).children( '.name' ).attr('id', 'df_magz_post_feature_reviews_review_points_name_' + index );
                                    jQuery(this).children( '.value' ).attr('name', 'df_magz_post_feature_reviews[_review_points_value][' + index +']'  );
                                    jQuery(this).children( '.value' ).attr('id', 'df_magz_post_feature_reviews_review_points_value_' + index );
                                    jQuery(this).children( '.button' ).attr('data-id', index);
                                    jQuery(this).attr('data-id', index);
                            });
                      },
            }).enableSelection();
            jQuery( '.review_point' ).sortable('enable');
        });

        jQuery('.review_point .review_box_wrap .button.reorder').mouseup(function() {
            jQuery( '.review_point' ).sortable('disable');
            DFMetaBox.pointReviewInit();
        });
    }

    this.percentReviewInit = function () {
       jQuery('.delete_percent_value').unbind('click');
       jQuery('.copy_review_percent').unbind('click');
              jQuery('.review_stars .review_box_wrap .button.reorder').unbind('mousedown');
       jQuery('.review_stars .review_box_wrap .button.reorder').unbind('mouseup');
       jQuery('.delete_percent_value').on('click', function () {
            var confirmation = confirm("This action can not be undone, are you sure?");
            
            if ( confirmation == true ) {

              var countDiv = jQuery('.review_box.review_percent input').length;
              var countDiv = countDiv/2;
              var divIDtoRemove = parseInt( jQuery(this).attr('data-id') );
              /*Remove selected Div*/
              jQuery('.review_box_wrap[data-id="' + divIDtoRemove + '"]').remove();

              /*Update iterator all input element and button*/

              for (var i = 0; i < countDiv ; i++ ) {
                
                  if ( i > divIDtoRemove ) {
                    var newValue =  i - 1 ;
                    /* change div wraper data-id*/
                    jQuery('.review_box_wrap[data-id="' + i + '"]').attr('data-id', newValue);
                    jQuery('#df_magz_post_feature_reviews_review_percents_name_' + i ).attr('name', 'df_magz_post_feature_reviews[_review_percent_name][' + newValue +']' );
                    jQuery('#df_magz_post_feature_reviews_review_percents_name_' + i ).attr('id', 'df_magz_post_feature_reviews_review_percent_name_' + newValue );
                    jQuery('#df_magz_post_feature_reviews_review_percents_value_' + i ).attr('name', 'df_magz_post_feature_reviews[_review_percent_value][' + newValue +']'  );
                    jQuery('#df_magz_post_feature_reviews_review_percents_value_' + i ).attr('id', 'df_magz_post_feature_reviews_review_percent_value_' + newValue );
                    jQuery('.delete_percent_value[data-id="' + i + '"]').attr('data-id', newValue);
                    
                  }

              }

            } 
            /*Reinit percent Review*/
            DFMetaBox.percentReviewInit();

            return false;
        }); 
        
        jQuery('.copy_review_percent').on('click', function () {
          var next_id = jQuery('.review_box.review_percent input').length;
          var next_id = next_id/2;
          var element = '<div class="review_box_wrap" data-id="' + next_id + '"><input type="text" id="df_magz_post_feature_reviews_review_percent_' + next_id +'_name" name="df_magz_post_feature_reviews[_review_percent_name][' + next_id +']" class="regular-text name df-cmb-input-styled">';
          element = element + ' <input type="number" max="100" id="df_magz_post_feature_reviews_review_percent_value_' + next_id +'" name="df_magz_post_feature_reviews[_review_percent_value][' + next_id +']" class="regular-text value df-value">';
          element = element + '<a class="button delete_percent_value" data-id="' + next_id +'" href="#">Delete</a>';
          element = element + '<a class="button reorder" href="#"><i class="dashicons dashicons-sort"></i></a></div>';
          jQuery( element ).insertBefore('.copy_review_percent');
           
           /*Reinit percent Review*/
            DFMetaBox.percentReviewInit();

          return false;
        });

        jQuery('.review_percent .review_box_wrap .button.reorder').mousedown(function() {
            console.log('enable');

            jQuery( '.review_percent' ).sortable({
                    update: function(event, ui) {
                         jQuery(".review_stars .review_box_wrap").each(function( index, value  ){
                                    var lastID = jQuery(this).data('id');
                                    jQuery(this).children( '.name' ).attr('name', 'df_magz_post_feature_reviews[_review_percent_name][' + index +']' );
                                    jQuery(this).children( '.name' ).attr('id', 'df_magz_post_feature_reviews_review_percent_name_' + index );
                                    jQuery(this).children( '.value' ).attr('name', 'df_magz_post_feature_reviews[_review_percent_value][' + index +']'  );
                                    jQuery(this).children( '.value' ).attr('id', 'df_magz_post_feature_reviews_review_percent_value_' + index );
                                    jQuery(this).children( '.button' ).attr('data-id', index);
                                    jQuery(this).attr('data-id', index);
                            });
                      },
            }).enableSelection();
            jQuery( '.review_percent' ).sortable('enable');
        });

        jQuery('.review_percent .review_box_wrap .button.reorder').mouseup(function() {
            jQuery( '.review_percent' ).sortable('disable');
            DFMetaBox.starsReviewInit();
        });
    }

    this.starsReviewInit = function () {

       jQuery('.delete_stars_value').unbind('click');
       jQuery('.copy_review_stars').unbind('click');
       jQuery('.review_stars .review_box_wrap .button.reorder').unbind('mousedown');
       jQuery('.review_stars .review_box_wrap .button.reorder').unbind('mouseup');
       jQuery('.delete_stars_value').on('click', function () {
            var confirmation = confirm("This action can not be undone, are you sure?");
            
            if ( confirmation == true ) {

              var countDiv = jQuery('.review_box.review_stars input').length;
              var countDiv = countDiv;
              var divIDtoRemove = parseInt( jQuery(this).attr('data-id') );
              /*Remove selected Div*/
              jQuery('.review_box_wrap[data-id="' + divIDtoRemove + '"]').remove();

              /*Update iterator all input element and button*/

              for (var i = 0; i < countDiv ; i++ ) {
                
                  if ( i > divIDtoRemove ) {
                    var newValue =  i - 1 ;
                    /* change div wraper data-id*/
                    jQuery('.review_box_wrap[data-id="' + i + '"]').attr('data-id', newValue);
                    jQuery('#df_magz_post_feature_reviews_review_stars_name_' + i ).attr('name', 'df_magz_post_feature_reviews[_review_stars_name][' + newValue +']' );
                    jQuery('#df_magz_post_feature_reviews_review_stars_name_' + i ).attr('id', 'df_magz_post_feature_reviews_review_stars_name_' + newValue );
                    jQuery('#df_magz_post_feature_reviews_review_stars_value_' + i ).attr('name', 'df_magz_post_feature_reviews[_review_stars_value][' + newValue +']'  );
                    jQuery('#df_magz_post_feature_reviews_review_stars_value_' + i ).attr('id', 'df_magz_post_feature_reviews_review_stars_value_' + newValue );
                    jQuery('.delete_stars_value[data-id="' + i + '"]').attr('data-id', newValue);
                    
                  }

              }

            } 
            /*Reinit stars Review*/
            DFMetaBox.starsReviewInit();

            return false;
        }); 
        
        jQuery('.copy_review_stars').on('click', function () {
          var next_id = jQuery('.review_box.review_stars input').length;
          var next_id = next_id;
          var element = '<div class="review_box_wrap" data-id="' + next_id + '"><input type="text" id="df_magz_post_feature_reviews_review_stars_' + next_id + '_name" name="df_magz_post_feature_reviews[_review_stars_name][' + next_id +']" class="regular-text name df-cmb-input-styled">';
          element = element + ' <select id="df_magz_post_feature_reviews_review_stars_value_'+ next_id + '" class="cmb2_select-text df-selectopt value df-cmb-select" name="df_magz_post_feature_reviews[_review_stars_value]['+ next_id +']" type="cmb2_select">';
          element = element + ' <option value="0.5">½ </option>';
          element = element + ' <option value="1">1</option>';
          element = element + ' <option value="1.5">1 ½ </option>';
          element = element + '<option value="2">2</option>';
          element = element + '<option value="2.5">2 ½ </option>';
          element = element + '<option value="3">3</option>';
          element = element + '<option value="3.5">3 ½ </option>';
          element = element + '<option value="4">4</option>';
          element = element + '<option value="4.5">4 ½ </option>';
          element = element + '<option value="5">5</option>';
          element = element + '</select>';
          element = element + '<a class="button delete_stars_value" data-id="' + next_id +'" href="#">Delete</a>';
          element = element + '<a class="button reorder" href="#"><i class="dashicons dashicons-sort"></i></a></div>';
          jQuery( element ).insertBefore('.copy_review_stars');
           
           /*Reinit stars Review*/
            DFMetaBox.starsReviewInit();

          return false;
        });
        
        jQuery('.review_stars .review_box_wrap .button.reorder').mousedown(function() {
            
            jQuery( '.review_stars' ).sortable({
                    update: function(event, ui) {
                         jQuery(".review_stars .review_box_wrap").each(function( index, value  ){
                                    var lastID = jQuery(this).data('id');
                                    jQuery(this).children( '.name' ).attr('name', 'df_magz_post_feature_reviews[_review_stars_name][' + index +']' );
                                    jQuery(this).children( '.name' ).attr('id', 'df_magz_post_feature_reviews_review_stars_name_' + index );
                                    jQuery(this).children( '.value' ).attr('name', 'df_magz_post_feature_reviews[_review_stars_value][' + index +']'  );
                                    jQuery(this).children( '.value' ).attr('id', 'df_magz_post_feature_reviews_review_stars_value_' + index );
                                    jQuery(this).children( '.button' ).attr('data-id', index);
                                    jQuery(this).attr('data-id', index);
                            });
                      },
            }).enableSelection();
            jQuery( '.review_stars' ).sortable('enable');
        });

        jQuery('.review_stars .review_box_wrap .button.reorder').mouseup(function() {
            jQuery( '.review_stars' ).sortable('disable');
            DFMetaBox.starsReviewInit();
        });
    }


    /*End Review Section*/

}

