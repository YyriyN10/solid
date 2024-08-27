
<?php
	$blockTitle = carbon_get_post_meta( get_the_ID(), ''.$args.'reviews_title'.carbon_lang_prefix() );
	$blockText = carbon_get_post_meta( get_the_ID(), ''.$args.'reviews_text'.carbon_lang_prefix() );
	$blockId = carbon_get_post_meta( get_the_ID(), ''.$args.'reviews_id'.carbon_lang_prefix() );
	$blockMiniText = carbon_get_post_meta( get_the_ID(), ''.$args.'reviews_pre_rev_text'.carbon_lang_prefix() );
	$blockBgColor = carbon_get_post_meta( get_the_ID(), ''.$args.'reviews_background'.carbon_lang_prefix() );



?>
<!-- Reviews -->
<section class="reviews animate-target indent-top indent-bottom"
	<?php if( $blockId ):?>
		id="<?php echo $blockId;?>"
	<?php endif;?>
  style="background-color: <?php echo $blockBgColor;?>"
>
	<div class="container">
		<div class="row">
			<h2 class="block-title-mini first-up col-xl-4 col-lg-5"><?php echo $blockTitle;?></h2>
      <p class="double-border second-up mobile-double-border"><span><?php echo $blockMiniText;?></span></p>
			<?php if( $blockText ):?>
				<p class="call-text second-up col-xl-5 offset-xl-2 col-lg-6 offset-lg-1"><?php echo $blockText;?></p>
			<?php endif;?>
		</div>
		<div class="row third-up">
      <div class="reviews-slider col-lg-9" id="reviews-slider">
				<?php
					$reviewsArgs = array(
						'posts_per_page' => -1,
						'orderby' 	 => 'date',
						'post_type'  => 'reviews',
						'post_status'    => 'publish'
					);

					$reviewsList = new WP_Query( $reviewsArgs );

					if ( $reviewsList->have_posts() ) :

						while ( $reviewsList->have_posts() ) : $reviewsList->the_post();
							$videoId = carbon_get_post_meta( get_the_ID(),'solid_reviews_video_id'.carbon_lang_prefix());
							$videoFile = carbon_get_post_meta( get_the_ID(),'solid_reviews_video_file'.carbon_lang_prefix());
							$postDate = get_the_date();
							?>
              <div class="slide">
                <div class="text-wrapper">
                  <p class="double-border"><span><?php echo $blockMiniText;?></span></p>
                  <p class="rev-text"><?php echo carbon_get_post_meta( get_the_ID(),'solid_reviews_text'.carbon_lang_prefix());?></p>
                  <p class="name"><?php the_title();?></p>
                  <p class="rev-data"><?php echo $postDate;?></p>
                </div>
                <div class="pic-wrapper">
	                <?php the_post_thumbnail() ;?>
                  <div class="mob-info">
                    <p class="name"><?php the_title();?></p>
                    <p class="rev-data"><?php echo $postDate;?></p>
                  </div>
	                <?php if( $videoId != '' || !empty($videoFile)):?>
                    <a href="#" class="play-btn" data-videourl="<?php echo $videoFile;?>"  data-vidioid="<?php echo $videoId;?>">
                      <svg xmlns="http://www.w3.org/2000/svg" width="26" height="31" viewBox="0 0 26 31" fill="none">
                        <path d="M25 13.7679C26.3333 14.5378 26.3333 16.4622 25 17.232L3.25 29.7894C1.91666 30.5592 0.249999 29.597 0.249999 28.0574L0.25 2.94263C0.25 1.40303 1.91667 0.44078 3.25 1.21058L25 13.7679Z" fill="white"/>
                      </svg>
                    </a>
	                <?php endif;?>
                </div>
              </div>

						<?php endwhile;?>
					<?php endif; ?>
				<?php wp_reset_postdata(); ?>
      </div>

      <div class="reviews-prev-slider-wrapper col-lg-3 ">
        <a href="#" class="control prev">
          <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
            <g opacity="0.5">
              <path d="M14.6697 0L16 1.325V5.2L9.67484 11.5L16 17.8V21.675L14.6697 23L5 13.3687V9.63125L14.6697 0Z" fill="#ffffff"/>
            </g>
          </svg>
        </a>
        <div class="reviews-prev-slider" id="reviews-prev-slider">
		      <?php
			      $reviewsArgs = array(
				      'posts_per_page' => -1,
				      'orderby' 	 => 'date',
				      'post_type'  => 'reviews',
				      'post_status'    => 'publish'
			      );

			      $i = 0;

			      $reviewsList = new WP_Query( $reviewsArgs );

			      if ( $reviewsList->have_posts() ) :

				      while ( $reviewsList->have_posts() ) : $reviewsList->the_post();
					      $i = $i + 1;
					      ?>
                <div class="slide <?php if( $blockBgColor == '#00C3EB' ):?>
                color-1
                <?php elseif ($blockBgColor == '#40439D'):?>
                color-2
                <?php elseif ($blockBgColor == '#FFB28B'):?>
                color-3
              <?php endif;?>">
                  <p class="number">
							      <?php if( $i < 10 ):?>
                      0<?php echo $i;?>
							      <?php else:?>
								      <?php echo $i;?>
							      <?php endif;?>
                  </p>
                  <div class="avatar">
							      <?php the_post_thumbnail() ;?>
                  </div>
                  <div class="info">
                    <p class="name"><?php the_title();?></p>
                    <p class="date"><?php the_date();?></p>
                  </div>
                </div>

				      <?php endwhile;?>
			      <?php endif; ?>
		      <?php wp_reset_postdata(); ?>
        </div>
        <a href="#" class="control next">
          <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
            <path d="M8.33029 0L7 1.325V5.2L13.3252 11.5L7 17.8V21.675L8.33029 23L18 13.3687V9.63125L8.33029 0Z" fill="#ffffff"/>
          </svg>
        </a>
      </div>


		</div>
	</div>
</section>