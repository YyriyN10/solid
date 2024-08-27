<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package solid_constructor
 */

?>
</main>
	<footer class="site-footer">
    <div class="container">
      <div class="row">
        <div class="content col-12">
          <p class="copy">© Copyright <?php echo date('Y');?> school.solid</p>
          <p class="dev"><?php echo esc_html( pll__( 'Розроблено в' ) ); ?> <a href="https://smmstudio.com/" target="_blank">SMMSTUDIO</a></p>
	        <?php
		        wp_nav_menu(
			        array(
				        'theme_location' => 'menu-2',
				        'menu_id'        => 'footer-menu',
				        'container' => false,
				        'menu_class' => 'footer-menu'
			        )
		        );
	        ?>
        </div>
      </div>
    </div>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php
	get_template_part('template-parts/popup');
?>

<?php wp_footer(); ?>

</body>
</html>
