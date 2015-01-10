<?php


 get_header(); ?>

			
			<div class="mobile" style="display: none">
			 	<?php get_template_part( 'mobile-page' ); ?>
			</div>

			<div id="content">
			
			<div id="inner-content" class="wrap cf">

				<?php the_breadcrumb() ?>
				
					<?php if(is_archive()) {
					
					?>
					
					<h1 id="page-title" class="over-blue"><?php post_type_archive_title(); ?></h1>
					
					<?php
					
					} else if(is_search()) { ?>
					
					<h1 id="page-title" class="over-blue"><span><?php _e( 'Search Results for:', 'bonestheme' ); ?></span> <?php echo esc_attr(get_search_query()); ?></h1>
					
					
					<?php } else { ?>
					<h1 id="page-title" class="over-blue"><?php the_title() ?></h1>
					
						<?php }  ?>
						<div id="main" class="m-all t-2of3 d-5of7 cf" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

						

								<section class="entry-content cf" itemprop="articleBody">
									<?php
										// the content (pretty self explanatory huh)
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
										<!--<div id="page-anchor-links"><ul></ul></div>-->
										<?php
										}
										
									 the_content(); 
									 
									 	$args = array(
												'numberposts' => -1,
												'post_type' => 'board-meeting',
											);
 
											// get results
											$the_query = new WP_Query( $args );
 
											// The Loop
											?>

											<?php if( $the_query->have_posts() ): ?>
												<h2>ATN Board Meetings/Minutes</h2>
												<table id="board-meeting-table" style="text-align: center;">
											
												<tr>
													<?php if(current_user_can( 'manage_options' )) {
														echo '<th>Edit Meeting<br/>(only visible to admin)</th>';
													} ?>
													<th>Meeting Date</th>
													<th>Meeting Type</th>
													<th>Agenda</th>
													<th>Minutes</th>
												</tr>
												
												<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

												<tr>
													<?php if(current_user_can( 'manage_options' )) {
														echo '<td><a href="'.get_edit_post_link().'">Edit</a></td>';
													} ?>
													

												
													<td><?php
echo date_format(new DateTime(get_field('meeting_date')),"F j, Y");
?></td>
													<td><?php the_field('meeting_type'); ?></td>
													<td>
													<?php if(get_field('agenda_link') != "") {?>
													 	<a href="<?php echo get_field('agenda_link'); ?>">Agenda Page</a>
													 <?php } else if(get_field('agenda') != "") {?>
														<a href="<?php echo get_field('agenda'); ?>">Agenda [PDF]</a>
													<?php } else {?>
													 -
													 <?php } ?>
													</td>
													<td>
													<?php if(get_field('minutes') != "") {?>
														<a href="<?php echo get_field('board_meeting_minutes'); ?>">Minutes [PDF]</a>
													<?php } else {?>
													 -
													 <?php } ?>
													</td>
												
												</tr>
												
												
											
													
												<?php endwhile; ?>
												</table>
											<?php endif; ?>
 
 										<!--	<a href="<?php echo get_site_url(); ?>/meetings-archive">Meetings Archive</a> -->
											<?php wp_reset_query();

										/*
										 * Link Pages is used in case you have posts that are set to break into
										 * multiple pages. You can remove this if you don't plan on doing that.
										 *
										 * Also, breaking content up into multiple pages is a horrible experience,
										 * so don't do it. While there are SOME edge cases where this is useful, it's
										 * mostly used for people to get more ad views. It's up to you but if you want
										 * to do it, you're wrong and I hate you. (Ok, I still love you but just not as much)
										 *
										 * http://gizmodo.com/5841121/google-wants-to-help-you-avoid-stupid-annoying-multiple-page-articles
										 *
										*/
									
									?>
								</section> <?php // end article section ?>

							



							</article>

							<?php endwhile; else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>

						<div id="sidebar1" class="sidebar m-all t-1of3 d-2of7 last-col cf" role="complementary">

						<?php get_template_part( 'generic-sidebar'); ?> 
				</div>
				</div><!-- end #inner-content -->
				</div><!-- end #content -->
				

		
			

<?php get_footer(); ?>
