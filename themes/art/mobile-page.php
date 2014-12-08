
<h2 class="mobile-padded"> <?php the_title(); ?></h2>

<div id="mobile-content">

<?php
if( has_post_thumbnail()) { ?>
										
										<div id="featured-image-container">
											<img class="featured-image" src="
											<?php
										
												$thumb_id = get_post_thumbnail_id();
												$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
												echo $thumb_url_array[0];
										
											?>
											">
										</div><!-- end featured image -->
										<?php }
										?>
										<div id="page-anchor-links"><ul></ul></div>


<div class="mobile-padded"><?php the_content(); ?></div>


</div><!-- end #mobile-content -->

