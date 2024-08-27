<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" class="site-form" method="post">
	<input type="hidden" name="action" value="form_integration">
	<div class="fields-wrapper">
		<div class="form-group">
			<input type="text" name="name" class="form-control" placeholder="<?php echo esc_html( pll__( 'Повне і’мя' ) ); ?>" required>

		</div>
		<div class="form-group">
			<input type="tel" name="phone" class="form-control" placeholder="<?php /*echo esc_html( pll__( 'Мобільний телефон' ) ); */?>" required>
		</div>
		<div class="form-group">
			<input type="email" name="email" class="form-control" placeholder="<?php echo esc_html( pll__( 'Електронна пошта' ) ); ?>" required>
		</div>
	</div>
  <?php
   $customThxLink = carbon_get_post_meta( get_the_ID(), 'solid_course_custom_thx_link'.carbon_lang_prefix() );
  ?>
	<button type="submit" class="button"><?php echo $args['btn'];?></button>
	<input type="hidden" name="form-lang" value="<?php echo get_bloginfo('language');?>">
	<input type="hidden" name="page-url" value="<?php echo get_page_link(''); ?>">
  <input type="hidden" name="home-url" value="<?php echo get_home_url(''); ?>">
	<input type="hidden" name="page-name" value="<?php the_title();?>">
  <input type="hidden" name="thx-link" value="<?php echo $customThxLink;?>">
  <input type="hidden" name="crm-phone" value="">
</form>
