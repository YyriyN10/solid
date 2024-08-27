
<?php
	$blockTitle = carbon_get_post_meta( get_the_ID(), ''.$args.'course_info_title'.carbon_lang_prefix() );
	$infoList = carbon_get_post_meta( get_the_ID(), ''.$args.'course_info_about'.carbon_lang_prefix() );
	$infoLictHlight = carbon_get_post_meta( get_the_ID(), ''.$args.'course_info_about_hlight'.carbon_lang_prefix());
	$blockId = carbon_get_post_meta( get_the_ID(), ''.$args.'course_info_id'.carbon_lang_prefix() );
	$blockSubtitle = carbon_get_post_meta( get_the_ID(), ''.$args.'course_info_sub_title'.carbon_lang_prefix() );
	$blockAdvancedList = carbon_get_post_meta( get_the_ID(), ''.$args.'course_info_advantages'.carbon_lang_prefix() );
	$blockBgColor = carbon_get_post_meta( get_the_ID(), ''.$args.'course_info_background'.carbon_lang_prefix() );
?>
	<!-- Courses info -->
	<section class="courses-info"
      <?php if( $blockId ):?>
        id="<?php echo $blockId;?>"
	    <?php endif;?>
  >
		<?php if( $infoList ):?>
      <div class="white-part animate-target">
        <div class="container">
          <div class="row first-up">
            <h2 class="block-title col-12 text-center"><?php echo $blockTitle;?></h2>
          </div>
          <div class="row">
            <div class="content col-12 second-up">
              <div class="inner">
                <svg class="info-cirkle" width="656" height="422" viewBox="0 0 656 422" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g opacity="0.25" filter="url(#filter0_f_380_3824)">
                    <circle cx="348" cy="205" r="186" fill="#40439D"/>
                  </g>
                  <defs>
                    <filter id="filter0_f_380_3824" x="0" y="-143" width="696" height="696" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                      <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                      <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
                      <feGaussianBlur stdDeviation="81" result="effect1_foregroundBlur_380_3824"/>
                    </filter>
                  </defs>
                </svg>

                <div class="mono-list">
	                <?php foreach( $infoList as $infoItem):?>
                    <div class="item">
                      <div class="icon-wrapper">
                        <img src="<?php echo $infoItem['icon'];?>" alt="" class="svg-pic">
                      </div>
                      <dl class="item-info">
                        <dt><?php echo $infoItem['info_name'];?></dt>
                        <dd><?php echo $infoItem['info_value'];?></dd>
                      </dl>
                    </div>
	                <?php endforeach;?>
                </div>
                <?php if( $infoLictHlight ):?>
                  <div class="color-list">
                    <?php foreach( $infoLictHlight as $infoHl ):?>
                      <div class="item">
                        <div class="icon-wrapper">
                          <img src="<?php echo $infoHl['icon'];?>" alt="" class="svg-pic">
                        </div>
                        <dl class="item-info">
                          <dt><?php echo $infoHl['info_name'];?></dt>
                          <dd><?php echo $infoHl['info_value'];?></dd>
                        </dl>
                      </div>
                    <?php endforeach;?>
                  </div>
                <?php endif;?>
                <a href="#" class="control prev">
                  <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                    <g opacity="0.5">
                      <path d="M14.6697 0L16 1.325V5.2L9.67484 11.5L16 17.8V21.675L14.6697 23L5 13.3687V9.63125L14.6697 0Z" fill="#FFFDC6"/>
                    </g>
                  </svg>
                </a>
                <a href="#" class="control next">
                  <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                    <path d="M8.33029 0L7 1.325V5.2L13.3252 11.5L7 17.8V21.675L8.33029 23L18 13.3687V9.63125L8.33029 0Z" fill="#FFFDC6"/>
                  </svg>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endif;?>
		<?php if( $blockAdvancedList ):?>
    <div class="color-part animate-target" style="background-color: <?php echo $blockBgColor;?>">
      <div class="container">
        <?php if( $blockTitle && empty($infoList)):?>
          <div class="row first-up">
            <h2 class="block-title col-12 text-center"><?php echo $blockTitle;?></h2>
          </div>
        <?php endif;?>
	      <?php if( $blockSubtitle ):?>
          <div class="row first-up">
            <div class="block-title-mini text-center col-12"><?php echo $blockSubtitle;?></div>
          </div>
	      <?php endif;?>
        <div class="row advanced-slider second-up">
		      <?php foreach( $blockAdvancedList as $advancedItem ):?>
            <div class="advanced col-lg-3 col-md-6 col-sm-6 col-6">
              <div class="inner">
                <div class="card-title">
                  <div class="icon-wrapper">
                    <img src="<?php echo $advancedItem['advantage_icon'];?>" alt="" class="svg-pic">
                  </div>
                  <h3 class="name"><?php echo $advancedItem['advantage_name'];?></h3>
                </div>
                <p class="description"><?php echo $advancedItem['advantage_description'];?></p>
              </div>
            </div>
		      <?php endforeach;?>
        </div>
      </div>
      <a href="#" class="control prev">
        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
          <g opacity="0.5">
            <path d="M14.6697 0L16 1.325V5.2L9.67484 11.5L16 17.8V21.675L14.6697 23L5 13.3687V9.63125L14.6697 0Z" fill="#FFFDC6"/>
          </g>
        </svg>
      </a>
      <a href="#" class="control next">
        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
          <path d="M8.33029 0L7 1.325V5.2L13.3252 11.5L7 17.8V21.675L8.33029 23L18 13.3687V9.63125L8.33029 0Z" fill="#FFFDC6"/>
        </svg>
      </a>
    </div>
		<?php endif;?>
	</section>