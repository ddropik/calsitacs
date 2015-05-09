<?php
/**
 * Template Name: Home Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package CALSboilerplate_underscores
 */

get_header(); ?>

<?php ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		
			<div class="row homeSubFeatures">
				<div class="span-33">
					<div class="icon"><img src="<?php echo get_template_directory_uri(); ?>/dist/images/hosting.svg" alt=" "></div>
					<h3>Web Hosting</h3>
					<p>Here is a short blurb about all the services that CALS IT is providing to the departments, centers, and other groups within the College</p>
				</div>

				<div class="span-33">
					<div class="icon"><img src="<?php echo get_template_directory_uri(); ?>/dist/images/security.svg" alt=" "></div>
					<h3>IT Security</h3>
					<p>CALS IT is committed to improving the information security position of the college and all of its departments and units.</p>
				</div>

				<div class="span-33">
					<div class="icon"><img src="<?php echo get_template_directory_uri(); ?>/dist/images/notebook.svg" alt=" "></div>
					<h3>Equipment</h3>
					<p>CALS is running an installation of Axiope's eCAT v4.0.4 software. It's currently being tested and used in a production environment in conjunction with Prof. Jean-Michel Ane of the Agronomy Department.</p>
				</div>
			</div>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php //get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						//comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php //get_sidebar(); 
//logit($wp_query,'$wp_query: ');
//logit($translation_array,'$translation_array: ');
//logit($commonSearchArray,'$commonSearchArray: ');
//logit($commonSearchArray2,'$commonSearchArray2: ');

?>
<?php get_footer(); ?>
