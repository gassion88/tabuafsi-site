<?php 
	global $redux_demo;
	$classieraIconsStyle = 'icon';
	$classiera_cat_child = 'child';
	if(isset($redux_demo)){
		$classieraIconsStyle = $redux_demo['classiera_cat_icon_img'];
		$classiera_cat_child = $redux_demo['classiera_cat_child'];
	}	
	$classieraCurrencyTag = $redux_demo['classierapostcurrency'];	
	$primaryColor = $redux_demo['color-primary'];
	$category_icon_code = "";
	$category_icon_color = "";
	$classieraCatIcoIMG = "";
	$catIcon = "";
	global $post;
	$category = get_the_category();
	$catID = $category[0]->cat_ID;
	if ($category[0]->category_parent == 0) {
		$tag = $category[0]->cat_ID;
		$tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
		if (isset($tag_extra_fields[$tag])) {
			if(isset($tag_extra_fields[$tag]['category_icon_code'])){
				$category_icon_code = $tag_extra_fields[$tag]['category_icon_code'];
			}
			if(isset($tag_extra_fields[$tag]['category_icon_color'])){
				$category_icon_color = $tag_extra_fields[$tag]['category_icon_color'];
			}
			if(isset($tag_extra_fields[$tag]['your_image_url'])){
				$classieraCatIcoIMG = $tag_extra_fields[$tag]['your_image_url'];
			}			
		}
	}elseif(isset($category[1]->category_parent) && $category[1]->category_parent == 0){
		$tag = $category[0]->category_parent;
		$tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
		if (isset($tag_extra_fields[$tag])) {
			if(isset($tag_extra_fields[$tag]['category_icon_code'])){
				$category_icon_code = $tag_extra_fields[$tag]['category_icon_code'];
			}
			if(isset($tag_extra_fields[$tag]['category_icon_color'])){
				$category_icon_color = $tag_extra_fields[$tag]['category_icon_color'];
			}
			if(isset($tag_extra_fields[$tag]['your_image_url'])){
				$classieraCatIcoIMG = $tag_extra_fields[$tag]['your_image_url'];
			}
		}
	}else{
		$tag = $category[0]->category_parent;
		$tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
		if (isset($tag_extra_fields[$tag])) {
			if(isset($tag_extra_fields[$tag]['category_icon_code'])){
				$category_icon_code = $tag_extra_fields[$tag]['category_icon_code'];
			}
			if(isset($tag_extra_fields[$tag]['category_icon_color'])){
				$category_icon_color = $tag_extra_fields[$tag]['category_icon_color'];
			}
			if(isset($tag_extra_fields[$tag]['your_image_url'])){
				$classieraCatIcoIMG = $tag_extra_fields[$tag]['your_image_url'];
			}
		}
	}	
	if($classiera_cat_child == 'child'){
		foreach ($category as $cat){
			$tag = $cat->cat_ID;
			$tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
			if (isset($tag_extra_fields[$tag])) {				
				if(isset($tag_extra_fields[$tag]['category_icon_code'])){
					$category_icon_code = $tag_extra_fields[$tag]['category_icon_code'];
				}
				if(isset($tag_extra_fields[$tag]['category_icon_color'])){
					$category_icon_color = $tag_extra_fields[$tag]['category_icon_color'];
				}
				if(isset($tag_extra_fields[$tag]['your_image_url'])){
					$classieraCatIcoIMG = $tag_extra_fields[$tag]['your_image_url'];
				}
			}
		}
	}
	if(!empty($category_icon_code)) {
		$category_icon = stripslashes($category_icon_code);
	}	
	if(empty($category_icon_color)) {
		$category_icon_color = $primaryColor;
	}
	$post_price = get_post_meta($post->ID, 'post_price', true);
	$theTitle = get_the_title();
	$postCatgory = get_the_category( $post->ID );							
	$categoryLink = get_category_link($catID);
	$classiera_ads_type = get_post_meta($post->ID, 'classiera_ads_type', true);
	$post_currency_tag = get_post_meta($post->ID, 'post_currency_tag', true);
	
	$post_location = get_post_meta($post->ID, 'post_location', true);
	$post_state = get_post_meta($post->ID, 'post_state', true);
	$post_city = get_post_meta($post->ID, 'post_city', true);	
	$featured_post = get_post_meta($post->ID, 'featured_post', true);
	$classieraPostAuthor = $post->post_author;
	$classieraAuthorEmail = get_the_author_meta('user_email', $classieraPostAuthor);
?>
<div class="col-lg-4 col-md-4 col-sm-6 match-height item <?php echo classiera_grid_classes(); ?>">
	<div class="classiera-box-div classiera-box-div-v1">
		<figure class="clearfix">
			<div class="premium-img">
			<?php 
			$classieraFeaturedPost = get_post_meta($post->ID, 'featured_post', true);
			if($classieraFeaturedPost == 1){
				?>
				<div class="featured-tag">
					<span class="left-corner"></span>
					<span class="right-corner"></span>
					<div class="featured">
						<p><?php esc_html_e( 'Featured', 'classiera' ); ?></p>
					</div>
				</div>
				<?php
			}
			if( has_post_thumbnail()){
				$imageurl = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'classiera-370');
				$thumb_id = get_post_thumbnail_id($post->ID);
				?>
				<img class="img-responsive" src="<?php echo esc_url( $imageurl[0] ); ?>" alt="<?php echo esc_html( $theTitle ); ?>">
				<?php
			}else{
				?>
				<img class="img-responsive" src="<?php echo get_template_directory_uri() . '/images/nothumb.png' ?>" alt="No Thumb"/>
				<?php
			}
			?>
				<span class="hover-posts">
					<a href="<?php the_permalink(); ?>" class="btn btn-primary outline btn-sm active"><?php esc_html_e( 'view ad', 'classiera' ); ?></a>
				</span>
				<?php if(!empty($classiera_ads_type)){?>
				<span class="classiera-buy-sel">
					<?php classiera_buy_sell($classiera_ads_type); ?>
				</span>
				<?php } ?>
			</div><!--premium-img-->
			<?php if(!empty($post_price)){?>
			<span class="classiera-price-tag" style="background-color:<?php echo esc_html( $category_icon_color ); ?>; color:<?php echo esc_html( $category_icon_color ); ?>;">
				<span class="price-text">
					<?php 
					if(is_numeric($post_price)){
						echo classiera_post_price_display($post_currency_tag, $post_price);
					}else{ 						 
						echo esc_attr( $post_price ); 
					}
					?>
				</span>
			</span>
			<?php } ?>
			<figcaption>
				<h5>
					<a href="<?php echo esc_url(the_permalink()); ?>">
						<?php echo esc_html( $theTitle ); ?>
					</a>
				</h5>
				<p>
					<?php esc_html_e( 'Category', 'classiera' ); ?> : 
					<a href="<?php echo esc_url( classiera_get_category_link($post->ID) ); ?>">
						<?php echo classiera_get_category($post->ID); ?>
					</a>
				</p>
				<?php if(!empty($category_icon_code) || !empty($classieraCatIcoIMG)){?>
				<span class="category-icon-box" style=" background:<?php echo esc_html( $category_icon_color ); ?>; color:<?php echo esc_html( $category_icon_color ); ?>; ">
					<?php 
					if($classieraIconsStyle == 'icon'){
						?>
						<i class="<?php echo esc_attr( $category_icon_code ); ?>"></i>
						<?php
					}elseif($classieraIconsStyle == 'img'){
						?>
						<img src="<?php echo esc_url( $classieraCatIcoIMG ); ?>" alt="<?php echo esc_attr( $postCatgory[0]->name ); ?>">
						<?php
					}
					?>
				</span>
				<?php } ?>
				<p class="description">
					<?php echo substr(get_the_excerpt(), 0,260); ?>
				</p>
				<div class="post-tags">
					<span><i class="fas fa-tags"></i>
					<?php esc_html_e('Tags', 'classiera'); ?>&nbsp; :
					</span>
					<?php the_tags('','',''); ?>
				</div><!--post-tags-->
			</figcaption>
		</figure>
	</div><!--classiera-box-div-->
</div><!--col-lg-4-->