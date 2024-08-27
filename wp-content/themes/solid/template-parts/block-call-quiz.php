
<?php
	$blockTitle = carbon_get_post_meta( get_the_ID(), ''.$args.'call_quiz_title'.carbon_lang_prefix() );
	$blockCallText = carbon_get_post_meta( get_the_ID(), ''.$args.'call_quiz_text'.carbon_lang_prefix() );
	$blockId = carbon_get_post_meta( get_the_ID(), ''.$args.'call_quiz_id'.carbon_lang_prefix() );
	$blockCallClick = carbon_get_post_meta( get_the_ID(), ''.$args.'call_quiz_call_btn'.carbon_lang_prefix() );
	$btnText = carbon_get_post_meta( get_the_ID(), ''.$args.'call_quiz_btn_text'.carbon_lang_prefix() );
	$btnLink = carbon_get_post_meta( get_the_ID(), ''.$args.'call_quiz_btn_link'.carbon_lang_prefix() );
	$blockImage = carbon_get_post_meta( get_the_ID(), ''.$args.'call_quiz_block_image'.carbon_lang_prefix() );
	$blockBgColor = carbon_get_post_meta( get_the_ID(), ''.$args.'call_quiz_background'.carbon_lang_prefix() );

?>
<!-- Call quiz -->
<section class="call-quiz animate-target indent-top indent-bottom"
	<?php if( $blockId ):?>
		id="<?php echo $blockId;?>"
	<?php endif;?>
  style="background-color: <?php echo $blockBgColor;?>"
>
	<div class="container">
		<div class="row">
      <div class="pic-wrapper first-up col-lg-4 col-md-5 col-sm-8 col-10">
        <img class="lazy" data-src="<?php echo $blockImage;?>" alt="">
      </div>
      <div class="content second-up col-lg-7 offset-lg-1 col-md-7 col-12">
        <svg xmlns="http://www.w3.org/2000/svg" width="132" height="53" viewBox="0 0 132 53" fill="none">
          <path d="M13.4967 30.866C12.5723 32.1915 11.1902 33.2118 9.50317 33.6639C5.71925 34.6778 1.8343 32.4488 0.825887 28.6854C-0.182522 24.922 2.06747 21.0492 5.85139 20.0353C9.63532 19.0214 13.5203 21.2503 14.5287 25.0137C14.7726 25.9239 14.8259 26.8405 14.713 27.7215L44.6436 41.1958C45.5671 39.9201 46.9212 38.9404 48.5646 38.5001C50.242 38.0506 51.9392 38.2384 53.3969 38.9146L73.1892 10.9429C72.9423 10.4797 72.744 9.98144 72.6024 9.45294C71.594 5.6895 73.844 1.81671 77.6279 0.802811C81.4118 -0.211088 85.2968 2.01785 86.3052 5.78129C86.517 6.5719 86.5851 7.36734 86.5253 8.14009L117.859 22.2713C118.75 20.5941 120.313 19.2751 122.299 18.7431C126.083 17.7292 129.968 19.9581 130.976 23.7216C131.984 27.485 129.734 31.3578 125.95 32.3717C122.166 33.3856 118.282 31.1567 117.273 27.3932C117.112 26.7916 117.034 26.1871 117.032 25.592L85.4594 11.3526C84.5396 12.8144 83.084 13.9479 81.2797 14.4314C79.2278 14.9812 77.1461 14.5775 75.5096 13.4925L56.0314 41.0203C56.5776 41.7316 56.9955 42.5593 57.2419 43.4786C58.2503 47.242 56.0003 51.1148 52.2164 52.1287C48.4324 53.1426 44.5475 50.9136 43.5391 47.1502C43.2835 46.1962 43.2372 45.2352 43.3722 44.3156L13.4967 30.866Z" fill="#2B2D60"/>
        </svg>
        <div class="inner text-center">
          <div class="control-panel">
            <span class="circle"></span>
          </div>
	        <?php if( $blockTitle ):?>
            <h2 class="block-title-mini"><?php echo $blockTitle;?></h2>
	        <?php endif;?>
	        <?php if( $blockCallText ):?>
            <p class="call-text"><?php echo $blockCallText;?></p>
	        <?php endif;?>
	        <?php if( $btnLink ):?>
            <a href="<?php echo $btnLink;?>" class="button"><?php echo $btnText;?></a>
	        <?php endif;?>

        </div>
      </div>
		</div>
	</div>
</section>