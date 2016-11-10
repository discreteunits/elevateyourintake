								<div class="clearfix"></div>
								<div class="df-review">
									<div class="row-eq-height df-review-wrap">
										<div class="col-md-8 col-sm-8 col-xs-12 review-inner review-left">
											<div class="df-title-summary">
												<h4><?php _e( 'SUMMARY & RESULTS' , 'onfleek')?></h4>
											</div>
											<p class="small">
												<?php  echo $review_summary; ?>
											</p>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 review-inner review-right review-inner-score">
											<div class="df-percentage">

												<h1><?php
												$sum = 0;
												$count = count( $list_reviews['_review_stars_value'] );
												foreach( $list_reviews['_review_stars_value'] as $value) { 
													$sum = $sum + $value;
												}
												$avg =  $sum / $count ;
												echo number_format($avg, 1, '.', '') . '<i class="ion-ios-star"></i>' ;
												?></h1>
												<p><?php  echo  $review_positive_title; ?></p>
											</div>
										</div>
									</div>

									<div class="df-review-wrap">
										<div class="df-title-summary">
											<div class="col-md-12 review-inner">
												<h4>Review</h4>
												<?php
												 		$i = 0;
														foreach($list_reviews['_review_stars_name'] as $list_review) {
													       ?>
													       <ul class="list-inline df-stars-review">
																<li><p><?php  echo  $list_review ;?></p></li>
																<ul class="list-inline pull-right">
																<?php 
																	$stars_value =  $list_reviews['_review_stars_value'][$i] ;
																	for( $iterator = 0 ; $iterator < 5 ; $iterator++) {
																		if ( ( $stars_value - $iterator ) >= 1 ) {
																			$class = '';
																		}else {
																			if ( ( $stars_value - $iterator ) == 0.5 ) {
																				$class = '-half';
																			}else {
																				$class = '-outline';
																			}
																		}
																		 echo   '<li><i class="ion-ios-star'. $class .'"></i></i></li>';
																	}
																?>
																
				
																</ul>
															</ul>
													       <?php 
													       $i++;
													    }
												?>
												
											</div>
										</div>
									</div>
								</div>
