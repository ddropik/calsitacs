<?php
/**
 * Template Name: page-help
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package CALSboilerplate_underscores
 */

get_header(); ?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main"> 
 		<ul class="tabs">
            <li class="current" form-data="form-1">ACS Support Request Form</li>
            <li form-data="form-2">CALSNET Services Form</li>
        </ul>
        	<div id="borderTop"></div>
            <div id="form-1" class="tab-content current">
                <!--<h2>ACS Support Request Form</h2>!-->

                <?php
				// /the query 
				//$the_query = new WP_Query( 'page_id=209');
				$the_query = new WP_Query( 'page_id=316'); ?>

				<?php if ( $the_query->have_posts() ) : ?>

				<!-- the loop -->
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<h2><?php the_title(); ?></h2>
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
		<div id="form-2" class="tab-content">
			 <!--<h2>CALSNET Service Form</h2>!-->
		<?php 
				// the query
				//$the_query = new WP_Query( 'page_id=209');
				$the_query = new WP_Query( 'page_id=303'); ?>
				
				<?php if ( $the_query->have_posts() ) : ?>

				<!-- the loop -->
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<h2><?php the_title(); ?></h2>
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
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>