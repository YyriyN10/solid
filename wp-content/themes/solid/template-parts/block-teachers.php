
<?php
	$blockTitle = carbon_get_post_meta( get_the_ID(), ''.$args.'teachers_title'.carbon_lang_prefix() );
	$blockText = carbon_get_post_meta( get_the_ID(), ''.$args.'teachers_text'.carbon_lang_prefix() );
	$blockId = carbon_get_post_meta( get_the_ID(), ''.$args.'teachers_id'.carbon_lang_prefix() );
	$blockSlogan = carbon_get_post_meta( get_the_ID(), ''.$args.'teachers_slogan'.carbon_lang_prefix() );
	$blockBgColor = carbon_get_post_meta( get_the_ID(), ''.$args.'teachers_background'.carbon_lang_prefix() );
	$blockTeacherList = carbon_get_post_meta( get_the_ID(), ''.$args.'teachers_list'.carbon_lang_prefix() );

?>
<!-- Courses info -->
<section class="teachers animate-target indent-top indent-bottom"
	<?php if( $blockId ):?>
		id="<?php echo $blockId;?>"
	<?php endif;?>
  style="background-color: <?php echo $blockBgColor;?>"
>
	<div class="container">
		<div class="row">
			<h2 class="block-title first-up text-center col-12"><?php echo $blockTitle;?></h2>
			<?php if( $blockText ):?>
				<p class="block-text second-up text-center col-xl-10 offset-xl-1 offset-0 col-12"><?php echo $blockText;?></p>
			<?php endif;?>
		</div>
		<div class="row third-up">
			<div class="teachers-slider-wrapper col-12" >
        <a href="#" class="control prev">
          <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
            <g opacity="0.5">
              <path d="M14.6697 0L16 1.325V5.2L9.67484 11.5L16 17.8V21.675L14.6697 23L5 13.3687V9.63125L14.6697 0Z" fill="#262961"/>
            </g>
          </svg>
        </a>
        <a href="#" class="control next">
          <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
            <path d="M8.33029 0L7 1.325V5.2L13.3252 11.5L7 17.8V21.675L8.33029 23L18 13.3687V9.63125L8.33029 0Z" fill="#262961"/>
          </svg>
        </a>
        <div class="teacher-previews-slider">
	        <?php

            $teacherAddList = [];

            foreach ( $blockTeacherList as $itemTest ){

	            array_push($teacherAddList, $itemTest['id']);

            }


		        $teachersArgs = array(
			        'posts_per_page' => -1,
			        'orderby' 	 => 'date',
			        'post_type'  => 'teachers',
			        'post_status'    => 'publish',
              'post__in' => $teacherAddList
		        );

		        $teachersList = new WP_Query( $teachersArgs );

		        if ( $teachersList->have_posts() ) :

			        while ( $teachersList->have_posts() ) : $teachersList->the_post();
				        ?>
                <div class="slide <?php if( $blockBgColor == '#FEFEFE' ):?>
                color-1
                <?php elseif ($blockBgColor == '#F1FBFD'):?>
                color-2
                <?php endif;?>">
                  <div class="avatar-wrapper">
	                  <?php the_post_thumbnail() ;?>
                  </div>
                  <div class="info">
                    <h3 class="name"><?php the_title();?></h3>
                    <p class="position"><?php echo carbon_get_post_meta( get_the_ID(),'solid_teachers_post'.carbon_lang_prefix());?></p>
                  </div>
                </div>
			        <?php endwhile;?>
		        <?php endif; ?>
	        <?php wp_reset_postdata(); ?>
        </div>
        <div class="teachers-slider">
	        <?php
		        $teachersArgs = array(
			        'posts_per_page' => -1,
			        'orderby' 	 => 'date',
			        'post_type'  => 'teachers',
			        'post_status'    => 'publish'
		        );

		        $teachersList = new WP_Query( $teachersArgs );

		        if ( $teachersList->have_posts() ) :

			        while ( $teachersList->have_posts() ) : $teachersList->the_post();

		            $videoId = carbon_get_post_meta( get_the_ID(),'solid_teachers_video_id'.carbon_lang_prefix());
		            $videoFile = carbon_get_post_meta( get_the_ID(),'solid_teachers_video_file'.carbon_lang_prefix());
		            $descriptionList = carbon_get_post_meta( get_the_ID(),'solid_teachers_description_list'.carbon_lang_prefix());
				        ?>
                <div class="slide">
                  <div class="photo-wrapper">
	                  <?php the_post_thumbnail() ;?>
                    <?php if( $videoId != '' || !empty($videoFile)):?>
                      <a href="#" class="play-btn" data-videourl="<?php echo $videoFile;?>"  data-vidioid="<?php echo $videoId;?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="31" viewBox="0 0 26 31" fill="none">
                          <path d="M25 13.7679C26.3333 14.5378 26.3333 16.4622 25 17.232L3.25 29.7894C1.91666 30.5592 0.249999 29.597 0.249999 28.0574L0.25 2.94263C0.25 1.40303 1.91667 0.44078 3.25 1.21058L25 13.7679Z" fill="white"/>
                        </svg>
                      </a>
                    <?php endif;?>
                  </div>

                  <div class="description-list">
                    <?php if( $descriptionList ): $itemNumber = 0; $listCount = count($descriptionList);?>
                      <dl>
                        <?php foreach( $descriptionList as $item ): $itemNumber = $itemNumber + 1;?>
                          <?php if( $itemNumber == 3 ):?>
                            <button class="toggle-content">
			                        <?php echo esc_html( pll__( 'детальніше' ) ); ?>
                              <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                                <path d="M17.5 9.60468L16.8087 9L14.787 9L11.5 11.8751L8.21304 9L6.1913 9L5.5 9.60468L10.525 14L12.475 14L17.5 9.60468Z" fill="#40439D"/>
                              </svg>
                            </button>
                            <div class="more-wrapper">

                            <dt><?php echo $item['description_name'];?></dt>
                            <dd><?php echo $item['description_text'];?></dd>
                          <?php else:?>
                            <dt><?php echo $item['description_name'];?></dt>
                            <dd><?php echo $item['description_text'];?></dd>
                          <?php endif;?>
                          <?php if( $listCount > 3 && $itemNumber == $listCount ):?>
                            </div>
                          <?php endif;?>

                        <?php endforeach;?>
                      </dl>
                    <?php endif;?>
                    <blockquote>
                      <?php echo $blockSlogan;?>
                      <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64" fill="none">
                        <path d="M64 32C64 49.6722 49.6722 64 32 64C14.3278 64 0 49.6722 0 32C0 14.3278 14.3278 0 32 0C49.6722 0 64 14.3278 64 32Z" fill="#40439D"/>
                        <path d="M30.4728 11.3828L13.0625 18.9978V28.3539L30.4728 35.9689V26.8325L23.1859 23.6758L30.4728 20.5192V11.3828Z" fill="#3AFFDC"/>
                        <path d="M33.5469 52.6173L50.9572 45.0023V35.6463L33.5469 28.0312V37.1677L40.8338 40.3243L33.5469 43.4809V52.6173Z" fill="#3AFFDC"/>
                      </svg>
                    </blockquote>
                  </div>
                </div>

			        <?php endwhile;?>
		        <?php endif; ?>
	        <?php wp_reset_postdata(); ?>
        </div>
			</div>
		</div>
	</div>
</section>