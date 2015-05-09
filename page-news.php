<?php
/**
 * Template Name: page-news
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

			<?php //while ( have_posts() ) : the_post(); ?>

				<?php //get_template_part( 'content', 'page' ); ?>

			<?php //endwhile; // end of the loop. ?>

			<?php
				$args = array( 'posts_per_page' => 10, 'orderby' => 'date_time' ); //order by recent date
				$postslist = get_posts( $args );
				foreach ( $postslist as $post ) :
  				setup_postdata( $post ); ?> 
  			<div id="news-section">
					<?php echo get_edit_post_link('edit','<p>','</p>'); ?> 
				
					<div id="news-head">
						<div id="news-title"><?php the_title(); ?></div>
						<div id="news-date"> Posted: <?php the_time('F j, Y')?> at <?php the_time('g:i a'); ?></div>
						<div id="edit-link"><?php edit_post_link( $link, $before, $after, $id ); ?></div>
					<!--<br />!-->
					</div>

					<div id="news-content">   
						<?//php the_excerpt(); ?>
						<?php the_content(); ?>
					</div> 
				
			
				<?php
				endforeach; 
					wp_reset_postdata();


				?>
			</div>
		</main><!-- #main -->

	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
		$('#news-section').velocity("transition.bounceUpIn", 1000);
		$('#news-content').velocity("transition.bounceUpIn", 1000);
		})
	</script>

	</div><!-- #primary -->

<?php /* get_sidebar(); */?>
<?php get_footer(); ?>
