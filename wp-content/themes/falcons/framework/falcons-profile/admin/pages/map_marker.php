<style>
.bs-callout {
    margin: 20px 0;
    padding: 15px 30px 15px 15px;
    border-left: 5px solid #eee;
}
.bs-callout-info {
    background-color: #E4F1FE;
    border-color: #22A7F0;
}
.html-active .switch-html, .tmce-active .switch-tmce {
	height: 28px!important;
	}
	.wp-switch-editor {
		height: 28px!important;
	}
</style>	
<?php
wp_enqueue_media(); 
	$directory_url_1=get_option('_iv_directory_url_1');					
	if($directory_url_1==""){$directory_url_1='law-firms';}	
	
	$directory_url_2=get_option('_iv_directory_url_2');					
	if($directory_url_2==""){$directory_url_2='lawyers';}
?>
<br/>
	<div id="update_message"> </div>	
	<form class="form-horizontal" role="form"  name='map_marker' id='map_marker'>
		 <h3  class="panel-heading"><?php echo ucfirst($directory_url_1); ?> <?php _e(' Category Image / Map Marker','falcons'); ?></h3> 
		  <a class="btn btn-success btn-xs" href="<?php echo admin_url().'edit-tags.php?taxonomy='.$directory_url_1.'-category&post_type='.$directory_url_1; ?>"> <?php _e('Create Category','falcons'); ?> </a>
		<div class="row ">
			<div class="col-md-12 ">				 	
			<table class="table table-bordered table-hover table-responsive">												  
			  <thead>
				<tr>
				  <th><?php _e('Category Main','falcons'); ?>  </th>
				  <th><?php _e('Sub Category','falcons'); ?>  </th>
				  <th><?php _e('Map Marker','falcons'); ?> </th>
				   <th><?php _e('Category Image','falcons'); ?> </th>
				</tr>
			  </thead>
			  <tbody>
				 
			  <?php				
					//directories
					$taxonomy = $directory_url_1.'-category';
					$args = array(
						'orderby'           => 'name', 
						'order'             => 'ASC',
						'hide_empty'        => false, 
						'exclude'           => array(), 
						'exclude_tree'      => array(), 
						'include'           => array(),
						'number'            => '', 
						'fields'            => 'all', 
						'slug'              => '',
						'parent'            => '0',
						'hierarchical'      => true, 
						'child_of'          => 0,
						'childless'         => false,
						'get'               => '', 
						
					);
					$terms = get_terms($taxonomy,$args); // Get all terms of a taxonomy
					if ( $terms && !is_wp_error( $terms ) ) :
					
						foreach ( $terms as $term ) {  ?>
							<tr>							  
							  <td>							
									<?php //echo $term->slug;?>
									<?php echo strtoupper($term->name);  ?>									
									<input type="hidden" name="<?php echo $term->slug;?>" id="<?php echo $term->slug;?>" value="<?php echo $term->term_id;?>">
							</td>
							<td>
									
							</td>
							<td> 
							
								<div id="marker_<?php echo $term->term_id;?>" class="col-md-2">
								<?php
									$marker = get_option('_cat_map_marker_'.$term->term_id);
									if($marker!=''){
										echo wp_get_attachment_image($marker);																	
									}else{ ?>
										<img  width="20px" src="<?php echo  wp_iv_directories_URLPATH."/assets/images/map-marker/map-marker.png";?>">	
								<?php									
									}
								?>
								</div>
							
							<button type="button" onclick="change_marker_image('<?php echo $term->term_id;?>');"  class="btn btn-success btn-xs">Change Image</button>
							</td>	
							<td> 
									<div id="cate_<?php echo $term->term_id;?>" class="">
										<?php
											$marker = get_option('_cate_main_image_'.$term->term_id);
											if($marker!=''){
												echo wp_get_attachment_image($marker);																	
											}else{ ?>
												
										<?php									
											}
										?>
										</div>	
										<br/>
									 
									<button type="button" onclick="change_cate_image('<?php echo $term->term_id;?>');"  class="btn btn-success btn-xs">Set Image</button>
									</td>
						</tr>
						<?php
								$category_id=$term->term_id;
										 											
										$args2 = array(
												'type'                     => $directory_url_1,
												'child_of'                 => $category_id,
												'parent'                   => '',
												'orderby'                  => 'name',
												'order'                    => 'ASC',
												'hide_empty'               => 0,
												'hierarchical'             => 1,
												'exclude'                  => '',
												'include'                  => '',
												'number'                   => '',
												'taxonomy'                 => $directory_url_1.'-category',
												'pad_counts'               => false 

											); 											
											$categories = get_categories( $args2 );
										
							
								if ( $categories && !is_wp_error( $categories ) ) :										
									foreach ( $categories as $term_sub ) { ?>
										<tr>							  
											<td>	
											</td>
											<td>
												<?php echo $term_sub->name;  ?>		
											</td>
											<td> 
											<div id="marker_<?php echo $term_sub->term_id;?>" class="col-md-2">
												<?php
													$marker = get_option('_cat_map_marker_'.$term_sub->term_id);
													if($marker!=''){
														echo wp_get_attachment_image($marker);																	
													}else{ ?>
														<img  width="20px" src="<?php echo  wp_iv_directories_URLPATH."/assets/images/map-marker/map-marker.png";?>">	
												<?php									
													}
												?>
												</div>	
											<button type="button" onclick="change_marker_image('<?php echo $term_sub->term_id;?>');"  class="btn btn-success btn-xs">Change Image</button>
											</td>	
												<td> 
													<div id="cate_<?php echo $term_sub->term_id;?>" class="">
													<?php
														$marker = get_option('_cate_main_image_'.$term_sub->term_id);
														if($marker!=''){
															echo wp_get_attachment_image($marker);																	
														}else{ ?>
																
													<?php									
														}
													?>
													</div>
												<br/>	
													
													 	<br/>	
												<button type="button" onclick="change_cate_image('<?php echo $term_sub->term_id;?>');"  class="btn btn-success btn-xs">Set Image</button>
												</td>
										</tr>
									<?php
									} 	
																
								endif;			
					
						
						} 								
					endif;	
					?>
				
			  </tbody>
			</table>  
			 </div> 
		</div>	 
		<h3  class=""><?php echo ucfirst($directory_url_2); ?> <?php _e(' Category Image / Map Marker','falcons'); ?> </h3> 	
		 <a class="btn btn-success btn-xs" href="<?php echo admin_url().'edit-tags.php?taxonomy='.$directory_url_2.'-category&post_type='.$directory_url_2; ?>"> <?php _e('Create Category','falcons'); ?> </a>
		<div class="row ">
			<div class="col-md-12 ">
				 
			<table class="table table-bordered table-hover table-responsive">												  
			  <thead>
				<tr>
				  <th><?php _e('Category Main','falcons'); ?>  </th>
				  <th><?php _e('Sub Category','falcons'); ?>  </th>
				  <th><?php _e('Map Marker','falcons'); ?> </th>
				   <th><?php _e('Category Image','falcons'); ?> </th>
				</tr>
			  </thead>
			  <tbody>
				 
			  <?php				
					//directories
					$taxonomy = $directory_url_2.'-category';
					$args = array(
						'orderby'           => 'name', 
						'order'             => 'ASC',
						'hide_empty'        => false, 
						'exclude'           => array(), 
						'exclude_tree'      => array(), 
						'include'           => array(),
						'number'            => '', 
						'fields'            => 'all', 
						'slug'              => '',
						'parent'            => '0',
						'hierarchical'      => true, 
						'child_of'          => 0,
						'childless'         => false,
						'get'               => '', 
						
					);
					$terms = get_terms($taxonomy,$args); // Get all terms of a taxonomy
					if ( $terms && !is_wp_error( $terms ) ) :
					
						foreach ( $terms as $term ) {  ?>
							<tr>							  
							  <td>							
									<?php //echo $term->slug;?>
									<?php echo strtoupper($term->name);  ?>									
									<input type="hidden" name="<?php echo $term->slug;?>" id="<?php echo $term->slug;?>" value="<?php echo $term->term_id;?>">
							</td>
							<td>									
							</td>
							
							<th> 
							
								<div id="marker_<?php echo $term->term_id;?>" class="col-md-2">
								<?php
									$marker = get_option('_cat_map_marker_'.$term->term_id);
									if($marker!=''){
										echo wp_get_attachment_image($marker);																	
									}else{ ?>
										<img  width="20px" src="<?php echo  wp_iv_directories_URLPATH."/assets/images/map-marker/map-marker.png";?>">	
								<?php									
									}
								?>
								</div>
							
							<button type="button" onclick="change_marker_image('<?php echo $term->term_id;?>');"  class="btn btn-success btn-xs">Change Image</button>
							</td>	
							<td> 
									<div id="cate_<?php echo $term->term_id;?>" class="">
										<?php
											$marker = get_option('_cate_main_image_'.$term->term_id);
											if($marker!=''){
												echo wp_get_attachment_image($marker);																	
											}else{ ?>
												
										<?php									
											}
										?>
										</div>	
										<br/>
									 
									<button type="button" onclick="change_cate_image('<?php echo $term->term_id;?>');"  class="btn btn-success btn-xs">Set Image</button>
									</td>
						</tr>
						<?php
								$category_id=$term->term_id;
										 											
										$args2 = array(
												'type'                     => $directory_url_2,
												'child_of'                 => $category_id,
												'parent'                   => '',
												'orderby'                  => 'name',
												'order'                    => 'ASC',
												'hide_empty'               => 0,
												'hierarchical'             => 1,
												'exclude'                  => '',
												'include'                  => '',
												'number'                   => '',
												'taxonomy'                 => $directory_url_2.'-category',
												'pad_counts'               => false 

											); 											
											$categories = get_categories( $args2 );
										
							
								if ( $categories && !is_wp_error( $categories ) ) :										
									foreach ( $categories as $term_sub ) { ?>
										<tr>							  
											<td>	
											</td>
											<td>
												<?php echo $term_sub->name;  ?>		
											</td>
											<td> 
											<div id="marker_<?php echo $term_sub->term_id;?>" class="col-md-2">
												<?php
													$marker = get_option('_cat_map_marker_'.$term_sub->term_id);
													if($marker!=''){
														echo wp_get_attachment_image($marker);																	
													}else{ ?>
														<img  width="20px" src="<?php echo  wp_iv_directories_URLPATH."/assets/images/map-marker/map-marker.png";?>">	
												<?php									
													}
												?>
												</div>	
											<button type="button" onclick="change_marker_image('<?php echo $term_sub->term_id;?>');"  class="btn btn-success btn-xs">Change Image</button>
											</td>	
												<td> 
													<div id="cate_<?php echo $term_sub->term_id;?>" class="">
													<?php
														$marker = get_option('_cate_main_image_'.$term_sub->term_id);
														if($marker!=''){
															echo wp_get_attachment_image($marker);																	
														}else{ ?>
																
													<?php									
														}
													?>
													</div>
												<br/>	
													
													 	<br/>	
												<button type="button" onclick="change_cate_image('<?php echo $term_sub->term_id;?>');"  class="btn btn-success btn-xs">Set Image</button>
												</td>
										</tr>
									<?php
									} 	
																
								endif;			
					
						
						} 								
					endif;	
					?>
				
			  </tbody>
			</table>  
			 </div> 
		</div>	
	</form>
<script>
  function change_marker_image(cat_image_id){	
				var image_gallery_frame;

               // event.preventDefault();
                image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: '<?php _e( 'Marker Image', 'easy-image-gallery' ); ?>',
                    button: {
                        text: '<?php _e( 'Marker Image', 'easy-image-gallery' ); ?>',
                    },
                    multiple: false,
                    displayUserSettings: true,
                });                
                image_gallery_frame.on( 'select', function() {
                    var selection = image_gallery_frame.state().get('selection');
                    selection.map( function( attachment ) {
                        attachment = attachment.toJSON();
                        if ( attachment.id ) {							
							var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
							var search_params = {
								"action": 	"iv_directories_update_map_marker",
								"attachment_id": attachment.id,
								"category_id": cat_image_id,
							};
                             jQuery.ajax({
										url: ajaxurl,
										dataType: "json",
										type: "post",
										data: search_params,
										success: function(response) {   
											if(response=='success'){					
												
												jQuery('#marker_'+cat_image_id).html('<img width="20px" src="'+attachment.url+'">');                              
						

											}
											
										}
							});									
                              
						}
					});
                   
                });               
				image_gallery_frame.open(); 
				
	}
	  function change_cate_image(cat_image_id){	
				var image_gallery_frame;

               // event.preventDefault();
                image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: '<?php _e( 'Category Image', 'easy-image-gallery' ); ?>',
                    button: {
                        text: '<?php _e( 'Category Image', 'easy-image-gallery' ); ?>',
                    },
                    multiple: false,
                    displayUserSettings: true,
                });                
                image_gallery_frame.on( 'select', function() {
                    var selection = image_gallery_frame.state().get('selection');
                    selection.map( function( attachment ) {
                        attachment = attachment.toJSON();
                        if ( attachment.id ) {							
							var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
							var search_params = {
								"action": 	"iv_directories_update_cate_image",
								"attachment_id": attachment.id,
								"category_id": cat_image_id,
							};
                             jQuery.ajax({
										url: ajaxurl,
										dataType: "json",
										type: "post",
										data: search_params,
										success: function(response) {   
											if(response=='success'){					
												
												jQuery('#cate_'+cat_image_id).html('<img width="100px" src="'+attachment.url+'">');                              
						

											}
											
										}
							});									
                              
						}
					});
                   
                });               
				image_gallery_frame.open(); 
				
	}
</script>	

