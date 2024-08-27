<?php
	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	/**
	 * Template part for displaying page content in page.php
	 *
	 * Template name: Template Privacy
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package solid
	 *
	 */

	get_header();
?>
	<section class="privacy-wrapper">
    <div class="container">
      <div class="row">
        <div class="content col-12">
          <?php the_content();?>
        </div>
      </div>
    </div>
  </section>
<?php get_footer();