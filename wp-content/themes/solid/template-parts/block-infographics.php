
<?php
	$infographicList = carbon_get_post_meta( get_the_ID(), ''.$args.'infographics_items_list'.carbon_lang_prefix() );
	$blockSubtitle = carbon_get_post_meta( get_the_ID(), ''.$args.'infographics_list_title'.carbon_lang_prefix() );
	$blockId = carbon_get_post_meta( get_the_ID(), ''.$args.'infographics_id'.carbon_lang_prefix() );
	$blockInfoList = carbon_get_post_meta( get_the_ID(), ''.$args.'infographics_list'.carbon_lang_prefix() );
	$blockImage = carbon_get_post_meta( get_the_ID(), ''.$args.'infographics_image'.carbon_lang_prefix() );
	$blockPosition = carbon_get_post_meta( get_the_ID(), ''.$args.'infographics_position'.carbon_lang_prefix() );
	$blockMenName = carbon_get_post_meta( get_the_ID(), ''.$args.'infographics_person_name'.carbon_lang_prefix() );
	$blockBgColor = carbon_get_post_meta( get_the_ID(), ''.$args.'infographics_background'.carbon_lang_prefix() );


?>
<!-- Infographics -->
<section class="infographics indent-top indent-bottom"
	<?php if( $blockId ):?>
		id="<?php echo $blockId;?>"
	<?php endif;?>
  style="background-color: <?php echo $blockBgColor;?>"
>
	<div class="container">
    <div class="row">
      <h2 class="block-title col-12 text-center"><?php echo $blockSubtitle;?></h2>
    </div>
    <div class="row">
	    <?php if( $infographicList ):?>
      <div class="infographic-wrapper col-12">
        <div class="infographic-slider" id="infographic-slider">
	        <?php foreach( $infographicList as $item ):?>
            <div class="item">
              <p class="name" data-number="<?php echo $item['infographics_item_text'];?>">
                <?php /*echo $item['infographics_item_text'];*/?>
                <span class="odometer"></span>
                <?php if( $item['infographics_item_symbol'] ):?>
                  <span class="text-symbol"><?php echo $item['infographics_item_symbol'];?></span>
                <?php endif;?>
              </p>
              <p class="description"><?php echo $item['infographics_item_description'];?></p>
            </div>
	        <?php endforeach;?>
        </div>
        <?php
          if ( count($infographicList) >= 4):
        ?>
          <a href="#" class="control prev">
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
              <g opacity="0.5">
                <path d="M14.6697 0L16 1.325V5.2L9.67484 11.5L16 17.8V21.675L14.6697 23L5 13.3687V9.63125L14.6697 0Z" fill="#262961"/>
              </g>
            </svg></a>
          <a href="#" class="control next">
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
              <path d="M8.33029 0L7 1.325V5.2L13.3252 11.5L7 17.8V21.675L8.33029 23L18 13.3687V9.63125L8.33029 0Z" fill="#262961"/>
            </svg>
          </a>
        <?php endif;?>
      </div>
	    <?php endif;?>
    </div>
    <div class="row">
      <div class="content col-xl-10 offset-xl-1 offset-0 col-lg-12">
	      <?php if( $blockInfoList ):?>
          <ul class="assertion-list">
			      <?php foreach( $blockInfoList as $item ):?>
              <li>
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                  <path d="M8.75456 16.1109C8.63234 16.1109 8.51776 16.0917 8.41081 16.0532C8.30387 16.0147 8.20456 15.9499 8.1129 15.8589L4.17123 11.9172C4.00318 11.7491 3.92281 11.5313 3.93015 11.2636C3.93748 10.9959 4.02548 10.7784 4.19415 10.6109C4.3622 10.4429 4.57609 10.3589 4.83581 10.3589C5.09554 10.3589 5.30943 10.4429 5.47748 10.6109L8.75456 13.888L16.5233 6.11927C16.6914 5.95122 16.9092 5.86719 17.1769 5.86719C17.4446 5.86719 17.6621 5.95122 17.8296 6.11927C17.9976 6.28733 18.0816 6.50519 18.0816 6.77285C18.0816 7.04052 17.9976 7.25808 17.8296 7.42552L9.39623 15.8589C9.30456 15.9505 9.20526 16.0156 9.09831 16.0541C8.99137 16.0926 8.87679 16.1116 8.75456 16.1109Z" fill="#F4259A"/>
                </svg>
                <?php echo $item['list_item'];?>
              </li>
			      <?php endforeach;?>
          </ul>
	      <?php endif;?>
        <?php if( $blockImage ):?>
          <div class="image-card">
            <img class="lazy" data-src="<?php echo $blockImage;?>" alt="">
            <div class="card-name">
              <p class="position"><?php echo $blockPosition;?></p>
              <p class="name"><?php echo $blockMenName;?></p>
            </div>
          </div>
        <?php endif;?>
      </div>
    </div>
	</div>
</section>