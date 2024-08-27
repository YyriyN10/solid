<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package solid_constructor
 */

get_header();
?>



	<section class="error-404 not-found">
    <div class="container">
      <div class="row">
        <div class="content col-12 text-center">
          <div class="pic-wrapper">
            <img src="<?php echo THEME_PATH;?>/assets/img/pic-404.png" alt="">
          </div>
          <h2>Oops!</h2>
          <p><?php echo esc_html( pll__( 'Сторінка, на яку ви намагаєтесь перейти, не існує.' ) ); ?></p>
          <a href="<?php echo get_home_url('/');?>" class="button"><?php echo esc_html( pll__( 'Повернутись на головну' ) ); ?></a>
        </div>
      </div>
    </div>

	</section><!-- .error-404 -->



<?php
get_footer();
