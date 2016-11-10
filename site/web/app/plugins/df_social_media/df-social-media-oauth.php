<?php
if( !class_exists( "DF_Social_Media" ) ){
	class DF_Social_Media {
		/**
		 * URL to check it's shares
		 * @var string
		 */
		private $url;

		/**
		 * Timeout (Maximum time for CURL request)
		 * @var integer
		 */
		private $timeout;

		/**
		 * The constructor
		 * @param string  $url
		 * @param integer $timeout
		 */
		public function __construct( ) {
			add_action( 'publish_post', array( $this, 'df_postToPage' ), 10, 2 );
			add_action( 'publish_post', array( $this, 'df_postToTwitter' ), 10, 2 );
   			add_action( 'wp_ajax_nopriv_df_get_all_social_media_counter', array( $this, 'df_get_all_social_media_counter' ) );
   			add_action( 'wp_ajax_df_get_all_social_media_counter', array( $this, 'df_get_all_social_media_counter' ) );
		}
		/**
		 * Get Facebook Shares
		 * @return integer
		 */

		/**
		 * Group 
		**/

		static function df_disable_auto_publish () {
			remove_action( 'publish_post', array( $this, 'df_postToPage' ), 10, 2 );
			remove_action( 'publish_post', array( $this, 'df_postToTwitter' ), 10, 2 );
		} 

		static function df_get_facebook_count( $url ) {
			$return_data = wp_remote_get( 'http://graph.facebook.com/?id='. rawurlencode( $url ) );
			//print_r(  $return_data );
			if ( is_wp_error( $return_data ) ) {
				$likes = 0;
				return $likes;

			}
			$return_data = wp_remote_retrieve_body( $return_data );
			$json = json_decode( $return_data, true );
			return isset( $json['share']['share_count'] ) ? intval( $json['share']['share_count'] ) : 0;
		}

		static function df_init_facebook( ) {
			$retArray =  array();
			$options=DF_Global_Options::$options;
			$social_account = DF_Options::df_get_social_account();
			$appID = $social_account['oauth']['facebook']['app_id'];
			$appSecret = $social_account['oauth']['facebook']['app_secret'];
			$pageID =  $social_account['oauth']['facebook']['page_id'];
			$wprg = array('sslverify'=>false, 'timeout' => 30); 

			//$access_token = wp_remote_get("https://graph.facebook.com/".$appID."/accounts/?access_token=". $appID . "|". $appSecret . "&fields=access_token");
			/** Get access Token **/
			$redirect_uri =  get_admin_url().'admin.php?page=df_theme_options';
			$access_token = $options['social_account']['oauth']['facebook']['facebook_code'];
			$tknURL = 'https://graph.facebook.com/v2.6/oauth/access_token?client_id='.$appID.'&state=df-fb-auth-0&redirect_uri='.urlencode($redirect_uri).'&client_secret='.$appSecret.'&code='.$access_token;

	      	$access_token  = wp_remote_get($tknURL, $wprg);
	      	//$res = "<br/>TKN URL: "; prr($tknURL);  
			if ( is_wp_error( $access_token ) ) {
				$ret =  $error_string = $access_token->get_error_message();
				return "Error when Get access Token ";//$ret;

			}else {
				$access_token = wp_remote_retrieve_body( $access_token );
				 
				 $access_token = json_decode( $access_token, true );
				 if ( !isset( $access_token['error'] ) ) {

				 		$access_token = $access_token['access_token'] ;

				 		$retArray['access_token'] = $access_token;
				 		$retArray['user_auth_code'] = $user_auth_code;
				 		$retArray['appID'] = $appID;
				 		$retArray['appSecret'] = $appSecret;
				 		$options['social_account']['oauth']['facebook']['access_token'] = $access_token;
				 		$options['social_account']['oauth']['facebook']['user_auth_code'] = $user_auth_code;
						update_option( DF_THEME_OPTIONS_NAME, $options );
				 }else {
				 		$access_token = $options['social_account']['oauth']['facebook']['access_token'];
				 		$retArray['access_token'] = $options['social_account']['oauth']['facebook']['access_token'];
				 		$retArray['user_auth_code'] = $options['social_account']['oauth']['facebook']['user_auth_code'];
				 		$retArray['appID'] = $appID;
				 		$retArray['appSecret'] = $appSecret;

				 	//return $retArray;//"Error when Get access Token array value not set ";//$access_token;
				 }

			}
			 
			//return "access_token = " . $access_token;//"https://graph.facebook.com/".$appID."/accounts/?access_token=". $appID . "|". $appSecret . "&fields=access_token";
			/** Grant Token For User**/
			$response  = wp_remote_get('https://graph.facebook.com/v2.6/oauth/access_token?client_secret='.$appSecret.'&client_id='.$appID.'&grant_type=fb_exchange_token&fb_exchange_token='.$access_token, $wprg); 
			if ((is_object($response) && isset($response->errors))) {  
				return " error when Grant Token For User";//$response . "asdasd"; 
				}
			if ( ( is_object( $response ) && isset( $response->errors ) ) ) {  
					return $response . " Failed get grant for";
				}
	      	if ( substr( $response['body'],0,1 ) =='{' ) {
	      		$params = json_decode( $response['body'], true);
	      		
	      	}else {
	      		parse_str( $response['body'] , $params );  
	      		

	      	}
	      	$user_auth_code = $params['access_token']; 
	      	$fbAppAuthToken = $user_auth_code; 	
	      	$retArray['user_auth_code'] = $user_auth_code;
	      	$retArray['fbAppAuthToken'] = $fbAppAuthToken;
	      	$options['social_account']['oauth']['facebook']['user_auth_code'] = $user_auth_code;
			$options['social_account']['oauth']['facebook']['fbAppAuthToken'] = $fbAppAuthToken;
			update_option( DF_THEME_OPTIONS_NAME, $options );
			/**Get User **/
			//return $user_auth_code;
			$access_token = $options['social_account']['oauth']['facebook']['access_token'];
			$appsecret_proof = hash_hmac('sha256', $fbAppAuthToken, $appSecret );
			$aacct = array('access_token'=> $user_auth_code, 'appsecret_proof'=>$appsecret_proof, 'method'=>'get');  
	      	$user_url = "https://graph.facebook.com/v2.6/me?".http_build_query($aacct, null, '&');
	      	
			//$user_url = 'https://graph.facebook.com/v2.6/me?access_token=' . $access_token . '&appsecret_proof='.$appsecret_proof.'&method=get';
			$userDetails  = wp_remote_get($user_url, $wprg); 
			if ( is_wp_error( $return_data ) ) {
				$ret =  $error_string = $return_data->get_error_message();
				return $ret;

			}else {
				$userDetails = wp_remote_retrieve_body( $userDetails );
				 $userDetails = json_decode( $userDetails, true );
				 $username = $userDetails['name'] ;
				 $userid = $userDetails['id'] ;
				 $options['social_account']['oauth']['facebook']['username'] = $username;
				 $options['social_account']['oauth']['facebook']['userid'] = $userid;
				update_option( DF_THEME_OPTIONS_NAME, $options );
			}

			/**-= Getting List of Pages =-<br/>**/
			if ( isset( $userid ) || isset( $options['social_account']['oauth']['facebook']['userid'] ) ) {
				$userid = $userid ? $userid : $options['social_account']['oauth']['facebook']['userid'];
				$resP = wp_remote_get('https://graph.facebook.com/v2.6/'.$userid.'/accounts?'.http_build_query($aacct, null, '&'), $wprg);  
				$pages = json_decode($resP['body'], true); 
				/**Getting Page Token **/              
	            //echo "https://graph.facebook.com/v2.6/$page_id?fields=access_token&".http_build_query($aacct, null, '&');
	            
	            $res = wp_remote_get( "https://graph.facebook.com/v2.6/$pageID?fields=access_token&".http_build_query($aacct, null, '&'), $wprg);
	            //return "https://graph.facebook.com/v2.6/$pageID?fields=access_token&".http_build_query($aacct, null, '&') ;
	              if (is_wp_error( $res ) || empty($res['body'])) { 
	              		return "Can't get Page Token."; 
	              	} else {
	                  $token = json_decode( $res['body'], true );
	                  	if ( empty( $token ) )  {
	                  		return "Can't get Page Token. JSON Error. ";
	                  	} else {
	                    	if ( !empty( $token['error'] ) ) 
	                    		if (!empty($token['error']['message'])) { 
	                    			$errMsg = $token['error']['message'];
	                      		if ( stripos($errMsg, 'Unknown fields: access_token')!==false || 
	                      			 stripos($errMsg, 'Cannot query users by their username')!==false || 
	                      			 stripos($errMsg, 'node type (User)')!==false ) {
	                          $token['access_token'] = $fbAppAuthToken; 
	                          $destType =  (stripos($fbURL, '/groups/')!=false)?'gr':'pr'; 
	                  	} else { 
	                        	if (stripos($errMsg, 'Unsupported get request')!==false)
	                        	return "<b style='color:red;'>Error </b>: Your Facebook user don't have rights to post there.<br/>";
	                        	//echo '<br/>Reported Error: ',  $errMsg, "\n"; die(); 
	                    }                    
	                }                      
	                if ( !empty($token['access_token'])) { 
	                    	$pageAuthToken = $token['access_token']; 
	                    	$page_app_secret_proff = hash_hmac('sha256', $pageAuthToken, $appSecret);
	                    	$options['social_account']['oauth']['facebook']['pageAuthToken'] = $pageAuthToken;
							$options['social_account']['oauth']['facebook']['page_app_secret_proff'] = $page_app_secret_proff;
							update_option( DF_THEME_OPTIONS_NAME, $options );

	                    } else { 
	                    	return "Can't get Page Token. NO TOKEN RETURNED. Are you sure that user you are trying to authorize is an admin of the page? This message means user was authorized as profile, but page refused to return authorization token. This usually happens when user has <b>no rights</b> to post to that page. "; 
	                    }
	                  } 
	              }
			}
	        if (isset($pageAuthToken  ))  {
	        	return "\n<p>this app has been authorized , facebook name : " . $options['social_account']['oauth']['facebook']['username'] . "<p>";
	        } else {
	        	return "\n<p><p>";
	        }   
			//$page_app_secret_proff = hash_hmac('sha256', $pageAuthToken, $appSecret); 
		}

		static function df_postToPage (  $ID, $post ) {
			$options=DF_Global_Options::$options;
			$social_account = DF_Options::df_get_social_account();
			$post_to_page = isset( $social_account['oauth']['facebook']['post_to_page'] ) ? $social_account['oauth']['facebook']['post_to_page'] : 'no';
			if ( false != self::df_facebook_oauth_status() || $post_to_page == 'no' ) {
				return 0;
			}
			$options=DF_Global_Options::$options;
			$social_account = DF_Options::df_get_social_account();
			$appID = $social_account['oauth']['facebook']['app_id'];
			$appSecret = $social_account['oauth']['facebook']['app_secret'];
			$pageID =  $social_account['oauth']['facebook']['page_id'];
			$pageAuthToken = $social_account['oauth']['facebook']['pageAuthToken'];
			$page_app_secret_proff = $social_account['oauth']['facebook']['page_app_secret_proff'];
			$wprg = array('sslverify'=>false, 'timeout' => 30); 
			$excerpt = self::df_excerpt_by_id( $ID, 20, '<a><em><strong><p>');
			$excerpt=str_ireplace('<p>','',$excerpt);
			$excerpt=str_ireplace('</p>','',$excerpt);  
			$param = array(
				'access_token' => $pageAuthToken,//page token
				'appsecret_proof'=>$page_app_secret_proff,
	            'message'=> $post->post_title . "\n" . strip_tags( $excerpt,'<p>' ),
	            'from' => $appID,//appID
	            'to' => $pageID, //pageID
	            'caption' => get_site_url(),//websitename
	            'name' => $post->post_title,
	            'link' => get_permalink( $ID ),//postlink
	            'picture' => wp_get_attachment_url( get_post_thumbnail_id( $ID ) ),//featuredimage
	            'description' => strip_tags( $excerpt,'<p>' )//exerpt
	            );

			//return $param;
			$return_data = wp_remote_post( "https://graph.facebook.com/". $pageID . "/feed/" , 
					 array(
						'method' => 'POST',
						'timeout' => 45,
						'redirection' => 1,
						'httpversion' => '1.0',
						'blocking' => true,
						'headers' => array(),
						'body' => $param ,
						'cookies' => array()
				    )
				);
			if ( is_wp_error( $return_data ) ) {
				
				return 0;

			}
			$return_data = wp_remote_retrieve_body( $return_data );
			$json = json_decode( $return_data, true );
			//print_r($return_data);
			//die();
			return 1;
		}

		// static function facebook_oauth_status () {

			// $status = ( !isset($social_account['oauth']['facebook']['app_id']) && !empty( $social_account['oauth']['facebook']['app_id'] ) )
						// && ( !isset($social_account['oauth']['facebook']['app_secret']) && !empty( $social_account['oauth']['facebook']['app_secret'] ) )
						// && ( !isset($social_account['oauth']['facebook']['page_id']) && !empty( $social_account['oauth']['facebook']['page_id'] ) )
						// && ( !isset($social_account['oauth']['facebook']['pageAuthToken']) && !empty( $social_account['oauth']['facebook']['pageAuthToken'] )  )
						// && ( !isset($social_account['oauth']['facebook']['page_app_secret_proff']) && !empty( $social_account['oauth']['facebook']['page_app_secret_proff'] ) );
			// return $status;

		// }
		static function df_facebook_oauth_status () {

			$status = ( isset($social_account['oauth']['facebook']['app_id']) ?   '' != $social_account['oauth']['facebook']['app_id'] ? true : false : false )
						&& ( isset($social_account['oauth']['facebook']['app_secret']) ? '' != $social_account['oauth']['facebook']['app_secret'] ? true : false : false )
						&& ( isset($social_account['oauth']['facebook']['page_id']) ? '' != $social_account['oauth']['facebook']['page_id'] ? true : false : false )
						&& ( isset($social_account['oauth']['facebook']['pageAuthToken']) ? '' != $social_account['oauth']['facebook']['pageAuthToken'] ? true : false : false )
						&& ( isset($social_account['oauth']['facebook']['page_app_secret_proff']) ? '' !=  $social_account['oauth']['facebook']['page_app_secret_proff'] ? true : false : false );
			return $status;
		}

		static function df_get_facebook_like( ) {
			if ( false != self::df_facebook_oauth_status() ) {
				return 0;
			}

			$options=DF_Global_Options::$options;
			$social_account = DF_Options::df_get_social_account();
			$appID = isset( $social_account['oauth']['facebook']['app_id'] ) ? $social_account['oauth']['facebook']['app_id'] : '';
			$appSecret = isset( $social_account['oauth']['facebook']['app_secret'] ) ? $social_account['oauth']['facebook']['app_secret'] : '';
			$pageID =  isset( $social_account['oauth']['facebook']['page_id'] ) ? $social_account['oauth']['facebook']['page_id'] : '';
			$pageAuthToken = isset( $social_account['oauth']['facebook']['pageAuthToken'] ) ? $social_account['oauth']['facebook']['pageAuthToken'] : '';
			$page_app_secret_proff = isset( $social_account['oauth']['facebook']['page_app_secret_proff'] ) ? $social_account['oauth']['facebook']['page_app_secret_proff'] : '';
			$aacct = array('access_token'=> $pageAuthToken, 'appsecret_proof'=>$page_app_secret_proff, 'method'=>'get');  
			$wprg = array('sslverify'=>false, 'timeout' => 30); 
			$return_data = wp_remote_get( "https://graph.facebook.com/v2.6/$pageID?fields=fan_count&".http_build_query($aacct, null, '&'), $wprg);
			
			if ( is_wp_error( $return_data ) ) {
				
				return 0;

			}
			$return_data = wp_remote_retrieve_body( $return_data );
			
			$json = json_decode( $return_data, true );
			return isset( $json['fan_count'] ) ? intval( $json['fan_count'] ) : 0;
		}

		//** Twitter *//
		/*
		static function twitter_oauth_status () {
			$status = ( !isset($social_account['oauth']['twitter']['consumer_key']) && !empty( $social_account['oauth']['twitter']['consumer_key'] ) )
						&& ( !isset($social_account['oauth']['twitter']['consumer_secret']) && !empty( $social_account['oauth']['twitter']['consumer_secret'] ) )
						&& ( !isset($social_account['oauth']['twitter']['access_token']) && !empty( $social_account['oauth']['twitter']['access_token'] ) )
						&& ( !isset($social_account['oauth']['twitter']['access_token_secret']) && !empty( $social_account['oauth']['twitter']['access_token_secret'] ) );
			return $status;
		}
		*/

		static function df_twitter_oauth_status () {

			 $status = ( isset($social_account['oauth']['twitter']['consumer_key']) ? '' != $social_account['oauth']['twitter']['consumer_key'] ? true : false : false  )
						 && ( isset($social_account['oauth']['twitter']['consumer_secret']) ? '' != $social_account['oauth']['twitter']['consumer_secret'] ? true : false : false )
						 && ( isset($social_account['oauth']['twitter']['access_token']) ? '' != $social_account['oauth']['twitter']['access_token'] ? true : false : false )
						 && ( isset($social_account['oauth']['twitter']['access_token_secret']) ? '' != $social_account['oauth']['twitter']['access_token_secret']  ? true : false : false );
			 return $status;
		}

		/** Get Twitter Post Count **/
		static function df_get_twitter_count( $url  ) {
			if ( false != self::df_twitter_oauth_status() ) {
				return 0;
			}
			//DF_Global_Options::$options = get_option( DF_THEME_OPTIONS_NAME );
			$options=DF_Global_Options::$options;
			$social_account = DF_Options::df_get_social_account();
			$consumer_key = $social_account['oauth']['twitter']['consumer_key'];
			$consumer_secret = $social_account['oauth']['twitter']['consumer_secret'];
			$access_token =  $social_account['oauth']['twitter']['access_token'];
			$access_token_secret = $social_account['oauth']['twitter']['access_token_secret'];
			$post_id = url_to_postid( $url );
			$metadata = get_post_meta ( $post_id, 'df_twitter_metadata');
			$last_count =  get_post_meta ( $post_id, 'df_twitter_count' );
			$last_count = isset($last_count[0]) ? $last_count[0] : 0;

			if ( isset( $metadata[0]['max_id_str']) ) {
				//print_r( $metadata['max_id_str'] );
				$params_array =array( 'q' => $url ,
								  'result_type' => 'recent',
								  'count' => '100',
								  'since_id' => $metadata[0]['max_id_str']
								);
			}else {
				//print_r("askdjgaskdjhaisgdlajsd");
				$params_array =array( 'q' => $url ,
								  'result_type' => 'recent',
								  'count' => '10'
								);
				}
			require_once( DF_SOCIAL_OAUTH__PLUGIN_DIR . '/api/tmhOAuth.php' );
				$settings = array(
				    'oauth_access_token' => $access_token,
				    'oauth_access_token_secret' => $consumer_secret,
				    'consumer_key' => $consumer_key,
				    'consumer_secret' => $consumer_secret
				);
				$tmhOAuth = new DF_tmhOAuth( $settings );	
				//$api_url = 'https://api.twitter.com/1.1/search/tweets.json';
				


				$code = $tmhOAuth->request('GET', $tmhOAuth->url('/1.1/search/tweets.json?') , $params_array );
				//print_r($twitter_data);
				if ($code == 200){

		  			$twResp = json_decode($tmhOAuth->response['response'], true);
		  			//print_r($twResp);
		  			$count = count ( $twResp['statuses'] ) ;
		  			
		  			$metadata = $twResp['search_metadata'];
		  			//print_r( $metadata );
		  			update_post_meta($post_id, 'df_twitter_metadata', $metadata);
		  			update_post_meta($post_id, 'df_twitter_count', $count + $last_count );
		  		//return $twResp;
		  		} else { 
		  			//$badOut['Error'] .= "Resp: ".print_r($tmhOAuth->response['response'], true)."| Error: ".print_r($tmhOAuth->response['error'], true)."| MSG: ".print_r($msg, true); 
		        	return $last_count;
		  		}
		  		//print_r( $last_count );
		  		
				return  $count +  $last_count;
		}

		static function df_get_twitter_follower_count( ) {
			if ( false != self::df_twitter_oauth_status() ) {
				return 0;
			}
			//DF_Global_Options::$options = get_option( DF_THEME_OPTIONS_NAME );
			$options=DF_Global_Options::$options;
			$social_account = DF_Options::df_get_social_account();
			$consumer_key = $social_account['oauth']['twitter']['consumer_key'];
			$consumer_secret = $social_account['oauth']['twitter']['consumer_secret'];
			$access_token =  $social_account['oauth']['twitter']['access_token'];
			$access_token_secret = $social_account['oauth']['twitter']['access_token_secret'];
			$screen_name = $social_account['oauth']['twitter']['username'];
			$user_id = $social_account['oauth']['twitter']['userid'];
			require_once( DF_SOCIAL_OAUTH__PLUGIN_DIR . '/api/tmhOAuth.php' );
			// $msg =$post->post_title. get_permalink( $ID ) ;
			$params_array =array( 'user_id' => $user_id ,
								  'screen_name' => $screen_name
								);

			$tmhOAuth = new DF_tmhOAuth( array( 
												'consumer_key' => $consumer_key,
												'consumer_secret' => $consumer_secret, 
												'user_token' => $access_token, 
												'user_secret' => $access_token_secret
												)
										);
			$code = $tmhOAuth->request('GET', $tmhOAuth->url('1.1/users/show.json?'), $params_array ); //prr($msg);
			
  			 
		  	if ($code == 200){
		  		$twResp = json_decode($tmhOAuth->response['response'], true);
		  		$followers_count = $twResp['followers_count'];
		  		return $followers_count;
		  	} else { 
		  		$badOut = "Resp: ".print_r($tmhOAuth->response['response'], true)."| Error: ".print_r($tmhOAuth->response['error'], true); 
		        return 0;
		  	}
		  return $badOut;
		}	

		/**Post TO twitter **/
		static function df_postToTwitter ( $ID, $post ) {
			$options=DF_Global_Options::$options;
			$social_account = DF_Options::df_get_social_account();
			$post_to_page = isset( $social_account['oauth']['facebook']['post_to_twitter'] ) ? $social_account['oauth']['facebook']['post_to_twitter'] : 'no';
			if ( false != self::df_twitter_oauth_status() || $post_to_page == 'no' ) {
				return false;
			}
			$consumer_key = $social_account['oauth']['twitter']['consumer_key'];
			$consumer_secret = $social_account['oauth']['twitter']['consumer_secret'];
			$access_token =  $social_account['oauth']['twitter']['access_token'];
			$access_token_secret = $social_account['oauth']['twitter']['access_token_secret'];

			require_once( DF_SOCIAL_OAUTH__PLUGIN_DIR . '/api/tmhOAuth.php' );
			$msg =$post->post_title . " ". get_permalink( $ID ) ;
			$params_array =array( 'status' => $msg);

			$tmhOAuth = new DF_tmhOAuth( array( 
												'consumer_key' => $consumer_key,
												'consumer_secret' => $consumer_secret, 
												'user_token' => $access_token, 
												'user_secret' => $access_token_secret
												)
										);
			$code = $tmhOAuth->request('POST', $tmhOAuth->url('1.1/statuses/update'), $params_array); //prr($msg);	
			// if ( $code=='403' && stripos($tmhOAuth->response['response'], 'User is over daily photo limit')!==false && $options['attchImg']!=false && $img!='') { 

		  	if ($code == 200){
		    	$twResp = json_decode($tmhOAuth->response['response'], true);  if (is_array($twResp) && isset($twResp['id_str'])) $twNewPostID = $twResp['id_str'];  
		     	if (is_array($twResp) && isset($twResp['user'])) $twPageID = $twResp['user']['screen_name'];
		     return array('postID'=>$twNewPostID, 'isPosted'=>1, 'postURL'=>'https://twitter.com/'.$twPageID.'/status/'.$twNewPostID, 'pDate'=>date('Y-m-d H:i:s'));          
		  	} else { 
		  		$badOut['Error'] .= "Resp: ".print_r($tmhOAuth->response['response'], true)."| Error: ".print_r($tmhOAuth->response['error'], true)."| MSG: ".print_r($msg, true); 
		        return $badOut;
		  	}
		  return $badOut;
		}
	
		/**
		 * Get Linked In Shares
		 * @return integer
		 */
		static function df_get_linkedin_count( $url ) { 
			$return_data = wp_remote_get( "http://www.linkedin.com/countserv/count/share?url=$url&format=json" );
			
			if ( is_wp_error( $return_data ) ) {
				
				return 0;
			}
			$return_data = wp_remote_retrieve_body( $return_data );
			$json = json_decode( $return_data, true );
			return isset( $json['count'] ) ? intval( $json['count'] ) : 0;
		}

		static function df_google_plus_oauth_status () {

			$status = ( isset($social_account['oauth']['google_plus']['username']) ? '' !=  $social_account['oauth']['twitter']['username']  ? true : false : false )
						&& ( isset($social_account['oauth']['google_plus']['api_key']) ? '' != $social_account['oauth']['twitter']['api_key'] ? true : false : false );
			return $status;
		}

		/** Google PLus**/
		static function df_get_google_plus_follower() {
			if ( false != self::df_google_plus_oauth_status() ) {
				return 0;
			}
			$options=DF_Global_Options::$options;
			$social_account = DF_Options::df_get_social_account();

		    $id =$social_account['oauth']['google_plus']['username'];
		    $apikey = $social_account['oauth']['google_plus']['api_key'];
		    
		    $followers = 0;
			    $request = @wp_remote_get( 'https://www.googleapis.com/plus/v1/people/' . $id . '?key=' . $apikey );
			    
					if ( false == $request ) {
					 return null;
					}
					$response = json_decode( @wp_remote_retrieve_body( $request ) );
		      if ( isset( $response->circledByCount ) ) {
		      	
		      	$followers = $response->circledByCount;

		      }

		    return  $followers;
		}

		/**
		 * Get Goolge+ ones
		 * @return integer
		 */
		static function df_get_google_plus_count( $url ) {

			$args = array(
		          'method' => 'POST',
		          'headers' => array(
		              // setup content type to JSON 
		              'Content-Type' => 'application/json'
		          ),
		          // setup POST options to Google API
		          'body' => json_encode(array(
		              'method' => 'pos.plusones.get',
		              'id' => 'p',
		              'method' => 'pos.plusones.get',
		              'jsonrpc' => '2.0',
		              'key' => 'p',
		              'apiVersion' => 'v1',
		              'params' => array(
		                  'nolog'=>true,
		                  'id'=> rawurldecode( $url ),
		                  'source'=>'widget',
		                  'userId'=>'@viewer',
		                  'groupId'=>'@self'
		              ) 
		           )),
		           // disable checking SSL sertificates               
		          'sslverify'=>false
		      );
		      $return_data = wp_remote_post("https://clients6.google.com/rpc", $args);
		      
		      
		      if ( is_wp_error( $return_data ) ) {
		      	
		      	return 0;
		      }
		      $return_data = wp_remote_retrieve_body( $return_data );
			$json = json_decode( $return_data, true );
			return isset( $json[0]['result']['metadata']['globalCounts']['count'] ) ? intval( $json[0]['result']['metadata']['globalCounts']['count'] ) : 0;
		}
		/** Get Youtube FOllower**/

		static function df_youtube_oauth_status () {

			$status = ( isset($social_account['oauth']['youtube']['ID']) ? '' != $social_account['oauth']['youtube']['ID'] ? true : false : false )
						&& ( isset($social_account['oauth']['youtube']['api_key']) ? '' != $social_account['oauth']['youtube']['api_key'] ? true : false : false )
						&& ( isset($social_account['oauth']['youtube']['type']) ? '' != $social_account['oauth']['youtube']['type'] ? true : false : false );
			return $status;
		}

		static function df_get_youtube_follower(){
			if ( false != self::df_youtube_oauth_status() ) {
				return 0;
			}
			$options=DF_Global_Options::$options;
			$social_account = DF_Options::df_get_social_account();
			$id =$social_account['oauth']['youtube']['ID'];
	   		$api = $social_account['oauth']['youtube']['api_key'];
			$type = isset( $social_account['oauth']['youtube']['type'] ) ? $social_account['oauth']['youtube']['type'] : 'chanel';
			if( $type == 'chanel' ){
				$json = wp_remote_get("https://www.googleapis.com/youtube/v3/channels?part=statistics&id=$id&key=$api");
			} else{
				$json = wp_remote_get("https://www.googleapis.com/youtube/v3/channels?part=statistics&forUsername=$id&key=$api");
			}
			// Check for error
			if ( is_wp_error( $json ) ) {
				$likes = 0;
				return $likes;
			}
			$data = wp_remote_retrieve_body( $json );
			$json_output = json_decode($data);

			$result = isset( $json_output->items{0}->statistics->subscriberCount ) ? $json_output->items{0}->statistics->subscriberCount : 0;
			//Extract the likes count from the JSON object
			$likes = $result ? $result : 0;
			return $likes;	
		}

		/** get Vimeo Followers */
		static function df_get_vimeo_follower(){
				$options=DF_Global_Options::$options;
				$social_account = DF_Options::df_get_social_account();

			    $channel =$social_account['oauth']['vimeo']['channel'];
			  
				
				$json = wp_remote_get("http://vimeo.com/api/v2/channel/$channel/info.json");

				// Check for error
				if ( is_wp_error( $json ) ) {
					$likes = 0;
					return $likes;
				}
				$data = wp_remote_retrieve_body( $json );
				$json_output = json_decode($data);
				
				//$result = $json_output->total_subscribers;
					
				//Extract the likes count from the JSON object
				$likes = isset( $json_output->total_subscribers ) ? $json_output->total_subscribers : 0;
			return $likes;	
		}

		//Get Instagram Follower Count
		static function df_instagram_oauth_status () {

			$status = ( isset($social_account['oauth']['instagram']['instagram_id']) ? '' != $social_account['oauth']['instagram']['instagram_id'] ? true : false : false )
						&& ( isset($social_account['oauth']['instagram']['access_token']) ? '' != $social_account['oauth']['instagram']['access_token'] ? true : false : false );
			return $status;
		}

		static function df_get_instagram_follower () {
			if ( false != self::df_instagram_oauth_status() ) {
				return 0;
			}
			$options=DF_Global_Options::$options;
			$social_account = DF_Options::df_get_social_account();

		    $id =$social_account['oauth']['instagram']['instagram_id'];
		    $api_key = $social_account['oauth']['instagram']['access_token'];

		    

			    $request = wp_remote_get( 'https://api.instagram.com/v1/users/' . $id . '?access_token=' . $api_key );
			    //return $request;
		      if ( false == $request ) {
		        return 0;
		      }
		  
		      $response = json_decode( @wp_remote_retrieve_body( $request ) );
		  
		      if ( isset( $response->data ) && isset( $response->data->counts ) && isset( $response->data->counts->followed_by ) ) {
		      	
		      	$followers = $response->data->counts->followed_by;
		        
		      }else {
		      	$followers = 0;
		      }

		   return $followers ;
		}

		/** get pinterest count*/
		static function df_get_pinterest_count( $url ) {
			$return_data = wp_remote_get( 'http://api.pinterest.com/v1/urls/count.json?url='.$url );
			
			if ( is_wp_error( $return_data ) ) {
				$likes = 0;
				return $likes;
			}
			$return_data = wp_remote_retrieve_body( $return_data );
			$json_string = preg_replace("/[^(]*\((.*)\)/", "$1", $return_data );
			$json = json_decode( $json_string, true );
	
			return isset( $json['count'] ) ? intval( $json['count'] ) : 0;
		}

		static function df_get_all_social_media_counter ( $url , $method = "get" ) {
			if ( isset($_POST['url'] ) ) {
				$url = $_POST['url'];
				$method = $_POST['method'];
				 
			}
			$post_id = url_to_postid( $url );
			if ( $method == "get" ) {

				$sum = get_post_meta( $post_id, 'social_counter', true )  ? get_post_meta( $post_id, 'social_counter', true ) : 0; ////$facbook + $twitter + $linkedin + $google_plus + $pinterest;
				$sum = intval($sum);
			}else {
				$facbook = self::df_get_facebook_count( $url );
				$twitter = self::df_get_twitter_count( $url );
				$linkedin = self::df_get_linkedin_count( $url );
				$google_plus = self::df_get_google_plus_count( $url );
				$pinterest = self::df_get_pinterest_count( $url );
				$sum = $facbook + $twitter + $linkedin + $google_plus + $pinterest;
				update_post_meta($post_id, 'social_counter', $sum);
				printf( self::custom_number_format( $sum ) );
				die();
			}
			
			return self::custom_number_format( $sum );
		} 

		static function df_excerpt_by_id($post, $length = 10, $tags = '<a><em><strong><p>', $extra = ' . . .') {
	 
			if(is_int($post)) {
				// get the post object of the passed ID
				$post = get_post($post);
			} elseif(!is_object($post)) {
				return false;
			}
		 
			if(has_excerpt($post->ID)) {
				$the_excerpt = $post->post_excerpt;
				return apply_filters('the_content', $the_excerpt);
			} else {
				$the_excerpt = $post->post_content;
			}
		 
			$the_excerpt = strip_shortcodes(strip_tags($the_excerpt), $tags);
			$the_excerpt = preg_split('/\b/', $the_excerpt, $length * 2+1);
			$excerpt_waste = array_pop($the_excerpt);
			$the_excerpt = implode($the_excerpt);
			$the_excerpt .= $extra;
		 
			return apply_filters('the_content', $the_excerpt);
		}

		static function linkify_tweet($tweet) {

			$tweet = preg_replace("/([\w]+\:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/", "<a target=\"_blank\" href=\"$1\">$1</a>", $tweet);
	 		$tweet = preg_replace("/#([A-Za-z0-9\/\.]*)/", "<a target=\"_new\" href=\"http://twitter.com/search?q=$1\">#$1</a>", $tweet);
	  		$tweet = preg_replace("/@([A-Za-z0-9\/\.]*)/", "<a href=\"http://www.twitter.com/$1\">@$1</a>", $tweet);

	 		return $tweet;
		}

		static function custom_number_format($n, $precision = 1 ) {
		    if ($n < 1000) {
		        // Anything less than a million
		        $n_format = number_format($n);
		    } else if ($n < 1000000) {
		        // Anything less than a billion
		        $n_format = number_format($n / 1000, $precision) . ' K';
		    } else if ($n < 1000000000) {
		        // Anything less than a billion
		        $n_format = number_format($n / 1000000, $precision) . ' M';
		    } else {
		        // At least a billion
		        $n_format = number_format($n / 1000000000, $precision) . ' B';
		    }

		    return $n_format;
		}
	}
}
new DF_Social_Media();

?>
