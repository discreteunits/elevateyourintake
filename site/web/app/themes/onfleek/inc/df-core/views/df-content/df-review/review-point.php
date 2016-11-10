								<div class="clearfix"></div>
								<div class="df-review">
									<div class="row-eq-height df-review-wrap">
										<div class="col-md-8 col-sm-8 col-xs-12 review-inner review-left">
											<div class="df-title-summary">
												<h4><?php _e( 'SUMMARY & RESULTS' , 'onfleek')?></h4>
											</div>
											<p>
												<?php echo $review_summary; ?>
											</p>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 review-right review-inner-score">
											<div class="df-percentage">

												<h1><?php
												$sum = 0;
												$count = count( $list_reviews['_review_points_value'] );
												foreach( $list_reviews['_review_points_value'] as $value) { 
													$sum = $sum + $value;
												}
												$avg =  $sum / $count ;
												echo number_format( $avg, 1, '.', '');
												
												?></h1>
												<p><?php echo  $review_positive_title; ?></p>
											</div>
										</div>
									</div>
									<div class="df-review-wrap">
										<div class="col-md-12 review-inner">
										<?php $i = 0;
											foreach($list_reviews['_review_points_name'] as $list_review) {
								        ?>
											<div class="barWrapper">
											 	<span class="progressText"><p class="small"><?php echo  $list_review;?></p></span>
												<div class="progress">
													<div class="progress-bar point" role="progressbar" aria-valuenow="<?php echo esc_attr( $list_reviews['_review_points_value'][$i] ); ?>" aria-valuemin="0" aria-valuemax="10">
														<p><?php echo  $list_reviews['_review_points_value'][$i]; ?></p>
													</div>
												</div>
											</div>
									    <?php 
										       $i++;
										    }
										?>
										</div>
									</div>
								</div>
