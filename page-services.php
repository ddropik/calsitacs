<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package CALSboilerplate_underscores
 */

get_header(); ?>
	<!--SERVICES!-->
	<div class="layout">	
			<div class="service">
				<div class="serviceIcon">
					<img src="<?php echo get_template_directory_uri(); ?>/img/service.svg" alt=" ">
				</div>
			<div class="serviceContent">
			<div class="titleBox">Services</div>
			  <?php
				// /the query 
				//$the_query = new WP_Query( 'page_id=209');
				$the_query = new WP_Query( 'page_id=375'); ?>

				<?php if ( $the_query->have_posts() ) : ?>

				<!-- the loop -->
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<div class="formContent"><?php the_content(); ?></div>

								<?php // This code adds an edit link for wp-users to edit content
									edit_post_link( $link, $before, $after, $id ); ?> 


					<?php endwhile; ?>
				<!-- end of the loop -->

				<!-- pagination here -->

				<?php wp_reset_postdata(); ?>

					<?php else : ?>
						<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				<?php endif; 

		?>	

			</div>
		</div>
	</div>
<!--<div class="layoutBottom"></div>-->
<img src="<?php echo get_template_directory_uri(); ?>/img/serviceBottomLayOut.svg" alt=" " style="width:100%; margin-bottom:-1em;">
	<!--EQUIPMENT!-->
	<div class="layout2 hidden">
			<div class="service2">
					<div class="serviceContent">
						<div class="titleBox">Equipment</div> 
						<!--'page_id=368'-->
						 <?php
				// /the query 
				//$the_query = new WP_Query( 'page_id=209');
				$the_query = new WP_Query( 'page_id=368'); ?>

				<?php if ( $the_query->have_posts() ) : ?>

				<!-- the loop -->
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<div class="formContent"><?php the_content(); ?></div>

								<?php // This code adds an edit link for wp-users to edit content
									edit_post_link( $link, $before, $after, $id ); ?> 


					<?php endwhile; ?>
				<!-- end of the loop -->

				<!-- pagination here -->

				<?php wp_reset_postdata(); ?>

					<?php else : ?>
						<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				<?php endif; 

		?>	

					</div>
						<div class="serviceIcon">
							<img src="<?php echo get_template_directory_uri(); ?>/img/equipment.svg" alt=" ">
						</div>	
			</div>
	</div>
	<!--IT SECURITY!-->
<img src="<?php echo get_template_directory_uri(); ?>/img/itSecurityTopLayOut.svg" alt=" " style="background-color: #5E889E;">
	<div class="layout3 hidden">	
			<div class="service">
				<div class="serviceIcon">
					<img src="<?php echo get_template_directory_uri(); ?>/img/itSecurity.svg" alt=" ">
				</div>
			<div class="serviceContent">	
				<div class="titleBox">IT Security</div>
						 <?php
				// /the query 
				//$the_query = new WP_Query( 'page_id=209');
				$the_query = new WP_Query( 'page_id=372'); ?>

				<?php if ( $the_query->have_posts() ) : ?>

				<!-- the loop -->
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<div class="formContent"><?php the_content(); ?></div>

								<?php // This code adds an edit link for wp-users to edit content
									edit_post_link( $link, $before, $after, $id ); ?> 


					<?php endwhile; ?>
				<!-- end of the loop -->

				<!-- pagination here -->

				<?php wp_reset_postdata(); ?>

					<?php else : ?>
						<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				<?php endif; 

		?>	

			</div>
		</div>
	</div>
	<!-- <div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php //while ( have_posts() ) : the_post(); ?>

				<?php// get_template_part( 'content', 'page' ); ?>

			<?php// endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php /* get_sidebar(); */?>

<!--Velocity Animation Test-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script>
	 	$(document).ready(function(){
	 	$('.layout .serviceIcon').velocity({opacity:0},{delay:10});
	 	$('.layout .serviceContent').velocity({opacity:0});
		//$('.layout .titleBox').velocity("transition.expandIn", 600);
	 	$('.layout .serviceContent').fadeIn().velocity("transition.shrinkIn", 300);
	 	$('.layout .serviceIcon').fadeIn().velocity("transition.shrinkIn", 400);

		})
	</script>
<!--Scroll Animation Triggers-->
        <script type="text/javascript">
                
                var lay2 = $('div.layout2'),
                    lay2Offset = lay2.offset().top/4,
                    doc= $(document);
                
                doc.on('scroll', function() {
                    if ( doc.scrollTop() > lay2Offset && lay2.hasClass('hidden') )
                    { 
                    	lay2.removeClass('hidden'); 
                		$('.layout2 .serviceIcon').velocity({opacity:0},{delay:300});
						$('.layout2 .serviceContent').velocity({opacity:0});
						//$('.layout2 .titleBox').velocity("transition.expandIn", 600);
						$('.layout2 .serviceContent').fadeIn().velocity("transition.slideLeftBigIn", 500);
						$('.layout2 .serviceIcon').fadeIn().velocity("transition.slideRightBigIn", 500);
					}
                });
                 
                  var lay3 = $('div.layout3'),
                    lay3Offset = lay3.offset().top/1.6;
                
                doc.on('scroll', function() {
                    if ( doc.scrollTop() > lay3Offset && lay3.hasClass('hidden') )
                    { 
                    	lay3.removeClass('hidden'); 
                		$('.layout3 .serviceIcon').velocity({opacity:0},{delay:400});
						$('.layout3 .serviceContent').velocity({opacity:0});
						//$('.layout3 .titleBox').velocity("transition.expandIn", 600);
						$('.layout3 .serviceContent').fadeIn().velocity("transition.slideRightBigIn", 500);
						$('.layout3 .serviceIcon').fadeIn().velocity("transition.slideLeftBigIn", 500);
					}
                });

            
         </script>

<?php get_footer(); ?>