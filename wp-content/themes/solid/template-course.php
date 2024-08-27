<?php

	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	/**
	 * Template part for displaying page content in page.php
	 *
	 * Template name: Template Course Page
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package solid
	 *
	 */

	get_header('courses');

	$formArgs = array();

	$productId = carbon_get_post_meta( get_the_ID(), 'integration_course_id'.carbon_lang_prefix() );
	$formArgs['product'] = $productId;


	?>

  <!-- Course main screen -->
<?php

	$mainFormType = carbon_get_post_meta( get_the_ID(), 'main_form_type'.carbon_lang_prefix() );
	$mainCourseType = carbon_get_post_meta( get_the_ID(), 'main_course_type'.carbon_lang_prefix() );
	$mainCourseName = carbon_get_post_meta( get_the_ID(), 'main_course_name'.carbon_lang_prefix() );
	$mainCall = carbon_get_post_meta( get_the_ID(), 'main_call'.carbon_lang_prefix() );
	$mainFormCall = carbon_get_post_meta( get_the_ID(), 'main_form_title'.carbon_lang_prefix() );
	$mainBtnText = carbon_get_post_meta( get_the_ID(), 'main_form_submit_text'.carbon_lang_prefix() );
	$mainTeamSlider = carbon_get_post_meta( get_the_ID(), 'main_team_slider'.carbon_lang_prefix() );
	$mainBgColor = carbon_get_post_meta( get_the_ID(), 'main_background'.carbon_lang_prefix() );
?>
  <section class="course-main-screen" style="background-color: <?php echo $mainBgColor;?>">
    <div class="container">
      <div class="row">
        <div class="text-content col-lg-5 col-md-8">
          <!--<p class="course-type double-border"><span><?php /*echo $mainCourseType;*/?></span></p>-->
          <p class="course-type double-border">
            <span class="inner">
              <?php echo $mainCourseType;?>
            </span>

          </p>
          <h1 class="course-name"><?php echo $mainCourseName;?></h1>
	        <?php if( $mainCall ):?>
            <p class="main-call"><?php echo $mainCall;?></p>
	        <?php endif;?>
          <div class="mobile-team-slider">
		        <?php if( $mainTeamSlider ): $j = 0;?>
            <div class="team-slider owl-carousel">
		        <?php foreach( $mainTeamSlider as $item ):?>
              <div class="slide item">
                <img src="<?php echo $item['team_men_photo'];?>" alt="">
                <div class="info">
                  <p class="position"><?php echo $item['team_men_position'];?></p>
                  <p class="name"><?php echo $item['team_men_name'];?></p>
                </div>
              </div>
		        <?php endforeach;?>
          </div>
          <div class="team-slider-navigation-wrapper">
            <a href="#" class="control prev">
              <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                <g opacity="0.5">
                  <path d="M14.6697 0L16 1.325V5.2L9.67484 11.5L16 17.8V21.675L14.6697 23L5 13.3687V9.63125L14.6697 0Z" fill="#262961"/>
                </g>
              </svg>
            </a>
            <div class="team-slider-navigation" id="team-slider-navigation">
			        <?php foreach( $mainTeamSlider as $item ): $j = $j + 1;?>
                <p class="slide-number">
					        <?php if( $j < 10  ):?>
                    0<?php echo $j;?>
					        <?php else:?>
						        <?php echo $j;?>
					        <?php endif;?>
                </p>
			        <?php endforeach;?>
            </div>
            <a href="#" class="control next">
              <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                <path d="M8.33029 0L7 1.325V5.2L13.3252 11.5L7 17.8V21.675L8.33029 23L18 13.3687V9.63125L8.33029 0Z" fill="#262961"/>
              </svg>
            </a>
          </div>
        <?php endif;?>
        </div>
	        <?php if( $mainFormType == 'popup_form' ):?>
            <a href="#" class="button go-modal" data-toggle="modal" data-target="#formModal"><?php echo $mainBtnText;?></a>
	        <?php endif;?>
	        <?php if( $mainFormType == 'open_form' ):?>
            <div class="form-wrapper">
			        <?php if( $mainFormCall ):?>
                <p class="form-call"><?php echo $mainFormCall;?></p>
			        <?php endif;?>

			        <?php

				        $mainFormArgs = $formArgs;
				        $mainFormArgs['btn'] = $mainBtnText;

				        get_template_part('template-parts/form', '', $mainFormArgs);

			        ?>
            </div>
	        <?php endif;?>
        </div>
        <div class="team-slider-wrapper col-lg-7 col-md-4">
          <?php if( $mainTeamSlider ): $i = 0;?>
            <div class="team-slider" style="background-color: <?php echo $mainBgColor;?>">
	              <?php foreach( $mainTeamSlider as $item ):?>
                  <div class="slide">
                    <div class="inner">
                      <img src="<?php echo $item['team_men_photo'];?>" alt="">
                      <div class="info">
                        <p class="position"><?php echo $item['team_men_position'];?></p>
                        <p class="name"><?php echo $item['team_men_name'];?></p>
                      </div>
                    </div>

                  </div>
	              <?php endforeach;?>

            </div>
            <!--<div class="prev-slide">
		          <?php /*foreach( $mainTeamSlider as $item ):*/?>
                <div class="slide">
                  <img src="<?php /*echo $item['team_men_photo'];*/?>" alt="">
                  <div class="info">
                    <p class="position"><?php /*echo $item['team_men_position'];*/?></p>
                    <p class="name"><?php /*echo $item['team_men_name'];*/?></p>
                  </div>
                </div>
		          <?php /*endforeach;*/?>
            </div>-->
            <div class="team-slider-navigation-wrapper">
              <a href="#" class="control prev">
                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                  <g opacity="0.5">
                    <path d="M14.6697 0L16 1.325V5.2L9.67484 11.5L16 17.8V21.675L14.6697 23L5 13.3687V9.63125L14.6697 0Z" fill="#262961"/>
                  </g>
                </svg>
              </a>
              <div class="team-slider-navigation" id="team-slider-navigation">
                <?php foreach( $mainTeamSlider as $item ): $i = $i + 1;?>
                  <p class="slide-number">
                    <?php if( $i < 10  ):?>
                      0<?php echo $i;?>
                    <?php else:?>
	                    <?php echo $i;?>
                    <?php endif;?>
                  </p>
                <?php endforeach;?>
              </div>
              <a href="#" class="control next">
                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                  <path d="M8.33029 0L7 1.325V5.2L13.3252 11.5L7 17.8V21.675L8.33029 23L18 13.3687V9.63125L8.33029 0Z" fill="#262961"/>
                </svg>
              </a>
            </div>
          <?php endif;?>
        </div>
      </div>
    </div>
  </section>

<?php
	$block_1 = carbon_get_post_meta( get_the_ID(), 'solid_block_1_question'.carbon_lang_prefix() );
	$block_2 = carbon_get_post_meta( get_the_ID(), 'solid_block_2_question'.carbon_lang_prefix() );
	$block_3 = carbon_get_post_meta( get_the_ID(), 'solid_block_3_question'.carbon_lang_prefix() );
	$block_4 = carbon_get_post_meta( get_the_ID(), 'solid_block_4_question'.carbon_lang_prefix() );
	$block_5 = carbon_get_post_meta( get_the_ID(), 'solid_block_5_question'.carbon_lang_prefix() );
	$block_6 = carbon_get_post_meta( get_the_ID(), 'solid_block_6_question'.carbon_lang_prefix() );
	$block_7 = carbon_get_post_meta( get_the_ID(), 'solid_block_7_question'.carbon_lang_prefix() );
	$block_8 = carbon_get_post_meta( get_the_ID(), 'solid_block_8_question'.carbon_lang_prefix() );
	$block_9 = carbon_get_post_meta( get_the_ID(), 'solid_block_9_question'.carbon_lang_prefix() );
	$block_10 = carbon_get_post_meta( get_the_ID(), 'solid_block_10_question'.carbon_lang_prefix() );
	$block_11 = carbon_get_post_meta( get_the_ID(), 'solid_block_11_question'.carbon_lang_prefix() );
	$block_12 = carbon_get_post_meta( get_the_ID(), 'solid_block_12_question'.carbon_lang_prefix() );

	if ( $block_1 == 'course_info' ){

		$prefix = 'solid_block_1_';
		get_template_part('template-parts/block', 'course-info', $prefix);

		/*$formArgs['btn'] = 'send';

		get_template_part('template-parts/form', '', $formArgs);*/

	}elseif ( $block_1 == 'teachers' ){

		$prefix = 'solid_block_1_';
		get_template_part('template-parts/block', 'teachers', $prefix);

	}elseif ( $block_1 == 'free_class' ){

		$prefix = 'solid_block_1_';
		get_template_part('template-parts/block', 'free-class', $prefix);

	}elseif ( $block_1 == 'infographics' ){

		$prefix = 'solid_block_1_';
		get_template_part('template-parts/block', 'infographics', $prefix);

	}elseif ( $block_1 == 'course_topics' ){

		$prefix = 'solid_block_1_';
		get_template_part('template-parts/block', 'course-topics', $prefix);

	}elseif ( $block_1 == 'call' ){

		$prefix = 'solid_block_1_';
		get_template_part('template-parts/block', 'call-quiz', $prefix);

	}elseif ( $block_1 == 'reviews' ){

		$prefix = 'solid_block_1_';
		get_template_part('template-parts/block', 'reviews', $prefix);
	}elseif ( $block_1 == 'contacts' ){

		$prefix = 'solid_block_1_';
		get_template_part('template-parts/block', 'contacts', $prefix);
	}


	if ( $block_2 == 'course_info' ){

		$prefix = 'solid_block_2_';
		get_template_part('template-parts/block', 'course-info', $prefix);

		/*$formArgs['btn'] = 'send';

		get_template_part('template-parts/form', '', $formArgs);*/

	}elseif ( $block_2 == 'teachers' ){

		$prefix = 'solid_block_2_';
		get_template_part('template-parts/block', 'teachers', $prefix);

	}elseif ( $block_2 == 'free_class' ){

		$prefix = 'solid_block_2_';
		get_template_part('template-parts/block', 'free-class', $prefix);

	}elseif ( $block_2 == 'infographics' ){

		$prefix = 'solid_block_2_';
		get_template_part('template-parts/block', 'infographics', $prefix);

	}elseif ( $block_2 == 'course_topics' ){

		$prefix = 'solid_block_2_';
		get_template_part('template-parts/block', 'course-topics', $prefix);

	}elseif ( $block_2 == 'call' ){

		$prefix = 'solid_block_2_';
		get_template_part('template-parts/block', 'call-quiz', $prefix);

	}elseif ( $block_2 == 'reviews' ){

		$prefix = 'solid_block_2_';
		get_template_part('template-parts/block', 'reviews', $prefix);
	}
  elseif ( $block_2 == 'contacts' ){

		$prefix = 'solid_block_2_';
		get_template_part('template-parts/block', 'contacts', $prefix);
	}

	//

	if ( $block_3 == 'course_info' ){

		$prefix = 'solid_block_3_';
		get_template_part('template-parts/block', 'course-info', $prefix);

		/*$formArgs['btn'] = 'send';

		get_template_part('template-parts/form', '', $formArgs);*/

	}elseif ( $block_3 == 'teachers' ){

		$prefix = 'solid_block_3_';
		get_template_part('template-parts/block', 'teachers', $prefix);

	}elseif ( $block_3 == 'free_class' ){

		$prefix = 'solid_block_3_';
		get_template_part('template-parts/block', 'free-class', $prefix);

	}elseif ( $block_3 == 'infographics' ){

		$prefix = 'solid_block_3_';
		get_template_part('template-parts/block', 'infographics', $prefix);

	}elseif ( $block_3 == 'course_topics' ){

		$prefix = 'solid_block_3_';
		get_template_part('template-parts/block', 'course-topics', $prefix);

	}elseif ( $block_3 == 'call' ){

		$prefix = 'solid_block_3_';
		get_template_part('template-parts/block', 'call-quiz', $prefix);

	}elseif ( $block_3 == 'reviews' ){

		$prefix = 'solid_block_3_';
		get_template_part('template-parts/block', 'reviews', $prefix);
	}
  elseif ( $block_3 == 'contacts' ){

		$prefix = 'solid_block_3_';
		get_template_part('template-parts/block', 'contacts', $prefix);
	}

	//
	if ( $block_4 == 'course_info' ){

		$prefix = 'solid_block_4_';
		get_template_part('template-parts/block', 'course-info', $prefix);

		/*$formArgs['btn'] = 'send';

		get_template_part('template-parts/form', '', $formArgs);*/

	}elseif ( $block_4 == 'teachers' ){

		$prefix = 'solid_block_4_';
		get_template_part('template-parts/block', 'teachers', $prefix);

	}elseif ( $block_4 == 'free_class' ){

		$prefix = 'solid_block_4_';
		get_template_part('template-parts/block', 'free-class', $prefix);

	}elseif ( $block_4 == 'infographics' ){

		$prefix = 'solid_block_4_';
		get_template_part('template-parts/block', 'infographics', $prefix);

	}elseif ( $block_4 == 'course_topics' ){

		$prefix = 'solid_block_4_';
		get_template_part('template-parts/block', 'course-topics', $prefix);

	}elseif ( $block_4 == 'call' ){

		$prefix = 'solid_block_4_';
		get_template_part('template-parts/block', 'call-quiz', $prefix);

	}elseif ( $block_4 == 'reviews' ){

		$prefix = 'solid_block_4_';
		get_template_part('template-parts/block', 'reviews', $prefix);
	}elseif ( $block_4 == 'contacts' ){

		$prefix = 'solid_block_4_';
		get_template_part('template-parts/block', 'contacts', $prefix);
	}

	//

	if ( $block_5 == 'course_info' ){

		$prefix = 'solid_block_5_';
		get_template_part('template-parts/block', 'course-info', $prefix);

	}elseif ( $block_5 == 'teachers' ){

		$prefix = 'solid_block_5_';
		get_template_part('template-parts/block', 'teachers', $prefix);

	}elseif ( $block_5 == 'free_class' ){

		$prefix = 'solid_block_5_';
		get_template_part('template-parts/block', 'free-class', $prefix);

	}elseif ( $block_5 == 'infographics' ){

		$prefix = 'solid_block_5_';
		get_template_part('template-parts/block', 'infographics', $prefix);

	}elseif ( $block_5 == 'course_topics' ){

		$prefix = 'solid_block_5_';
		get_template_part('template-parts/block', 'course-topics', $prefix);

	}elseif ( $block_5 == 'call' ){

		$prefix = 'solid_block_5_';
		get_template_part('template-parts/block', 'call-quiz', $prefix);

	}elseif ( $block_5 == 'reviews' ){

		$prefix = 'solid_block_5_';
		get_template_part('template-parts/block', 'reviews', $prefix);
	}elseif ( $block_5 == 'contacts' ){

		$prefix = 'solid_block_5_';
		get_template_part('template-parts/block', 'contacts', $prefix);
	}

	//

	if ( $block_6 == 'course_info' ){

		$prefix = 'solid_block_6_';
		get_template_part('template-parts/block', 'course-info', $prefix);

	}elseif ( $block_6 == 'teachers' ){

		$prefix = 'solid_block_6_';
		get_template_part('template-parts/block', 'teachers', $prefix);

	}elseif ( $block_6 == 'free_class' ){

		$prefix = 'solid_block_6_';
		get_template_part('template-parts/block', 'free-class', $prefix);

	}elseif ( $block_6 == 'infographics' ){

		$prefix = 'solid_block_6_';
		get_template_part('template-parts/block', 'infographics', $prefix);

	}elseif ( $block_6 == 'course_topics' ){

		$prefix = 'solid_block_6_';
		get_template_part('template-parts/block', 'course-topics', $prefix);

	}elseif ( $block_6 == 'call' ){

		$prefix = 'solid_block_6_';
		get_template_part('template-parts/block', 'call-quiz', $prefix);

	}elseif ( $block_6 == 'reviews' ){

		$prefix = 'solid_block_6_';
		get_template_part('template-parts/block', 'reviews', $prefix);
	}elseif ( $block_6 == 'contacts' ){

		$prefix = 'solid_block_6_';
		get_template_part('template-parts/block', 'contacts', $prefix);
	}

	//

	if ( $block_7 == 'course_info' ){

		$prefix = 'solid_block_7_';
		get_template_part('template-parts/block', 'course-info', $prefix);

	}elseif ( $block_7 == 'teachers' ){

		$prefix = 'solid_block_7_';
		get_template_part('template-parts/block', 'teachers', $prefix);

	}elseif ( $block_7 == 'free_class' ){

		$prefix = 'solid_block_7_';
		get_template_part('template-parts/block', 'free-class', $prefix);

	}elseif ( $block_7 == 'infographics' ){

		$prefix = 'solid_block_7_';
		get_template_part('template-parts/block', 'infographics', $prefix);

	}elseif ( $block_7 == 'course_topics' ){

		$prefix = 'solid_block_7_';
		get_template_part('template-parts/block', 'course-topics', $prefix);

	}elseif ( $block_7 == 'call' ){

		$prefix = 'solid_block_7_';
		get_template_part('template-parts/block', 'call-quiz', $prefix);

	}elseif ( $block_7 == 'reviews' ){

		$prefix = 'solid_block_7_';
		get_template_part('template-parts/block', 'reviews', $prefix);
	}elseif ( $block_7 == 'contacts' ){

		$prefix = 'solid_block_7_';
		get_template_part('template-parts/block', 'contacts', $prefix);
	}

	//

	if ( $block_8 == 'course_info' ){

		$prefix = 'solid_block_8_';
		get_template_part('template-parts/block', 'course-info', $prefix);

	}elseif ( $block_8 == 'teachers' ){

		$prefix = 'solid_block_8_';
		get_template_part('template-parts/block', 'teachers', $prefix);

	}elseif ( $block_8 == 'free_class' ){

		$prefix = 'solid_block_8_';
		get_template_part('template-parts/block', 'free-class', $prefix);

	}elseif ( $block_8 == 'infographics' ){

		$prefix = 'solid_block_8_';
		get_template_part('template-parts/block', 'infographics', $prefix);

	}elseif ( $block_8 == 'course_topics' ){

		$prefix = 'solid_block_8_';
		get_template_part('template-parts/block', 'course-topics', $prefix);

	}elseif ( $block_8 == 'call' ){

		$prefix = 'solid_block_8_';
		get_template_part('template-parts/block', 'call-quiz', $prefix);

	}elseif ( $block_8 == 'reviews' ){

		$prefix = 'solid_block_8_';
		get_template_part('template-parts/block', 'reviews', $prefix);
	}elseif ( $block_8 == 'contacts' ){

		$prefix = 'solid_block_8_';
		get_template_part('template-parts/block', 'contacts', $prefix);
	}

	//

	if ( $block_9 == 'course_info' ){

		$prefix = 'solid_block_9_';
		get_template_part('template-parts/block', 'course-info', $prefix);

	}elseif ( $block_9 == 'teachers' ){

		$prefix = 'solid_block_9_';
		get_template_part('template-parts/block', 'teachers', $prefix);

	}elseif ( $block_9 == 'free_class' ){

		$prefix = 'solid_block_9_';
		get_template_part('template-parts/block', 'free-class', $prefix);

	}elseif ( $block_9 == 'infographics' ){

		$prefix = 'solid_block_9_';
		get_template_part('template-parts/block', 'infographics', $prefix);

	}elseif ( $block_9 == 'course_topics' ){

		$prefix = 'solid_block_9_';
		get_template_part('template-parts/block', 'course-topics', $prefix);

	}elseif ( $block_9 == 'call' ){

		$prefix = 'solid_block_9_';
		get_template_part('template-parts/block', 'call-quiz', $prefix);

	}elseif ( $block_9 == 'reviews' ){

		$prefix = 'solid_block_9_';
		get_template_part('template-parts/block', 'reviews', $prefix);
	}elseif ( $block_9 == 'contacts' ){

		$prefix = 'solid_block_9_';
		get_template_part('template-parts/block', 'contacts', $prefix);
	}

	//

	if ( $block_10 == 'course_info' ){

		$prefix = 'solid_block_10_';
		get_template_part('template-parts/block', 'course-info', $prefix);

	}elseif ( $block_10 == 'teachers' ){

		$prefix = 'solid_block_10_';
		get_template_part('template-parts/block', 'teachers', $prefix);

	}elseif ( $block_10 == 'free_class' ){

		$prefix = 'solid_block_10_';
		get_template_part('template-parts/block', 'free-class', $prefix);

	}elseif ( $block_10 == 'infographics' ){

		$prefix = 'solid_block_10_';
		get_template_part('template-parts/block', 'infographics', $prefix);

	}elseif ( $block_10 == 'course_topics' ){

		$prefix = 'solid_block_10_';
		get_template_part('template-parts/block', 'course-topics', $prefix);

	}elseif ( $block_10 == 'call' ){

		$prefix = 'solid_block_10_';
		get_template_part('template-parts/block', 'call-quiz', $prefix);

	}elseif ( $block_10 == 'reviews' ){

		$prefix = 'solid_block_10_';
		get_template_part('template-parts/block', 'reviews', $prefix);
	}elseif ( $block_10 == 'contacts' ){

		$prefix = 'solid_block_10_';
		get_template_part('template-parts/block', 'contacts', $prefix);
	}

	//

	if ( $block_11 == 'course_info' ){

		$prefix = 'solid_block_11_';
		get_template_part('template-parts/block', 'course-info', $prefix);

	}elseif ( $block_11 == 'teachers' ){

		$prefix = 'solid_block_11_';
		get_template_part('template-parts/block', 'teachers', $prefix);

	}elseif ( $block_11 == 'free_class' ){

		$prefix = 'solid_block_11_';
		get_template_part('template-parts/block', 'free-class', $prefix);

	}elseif ( $block_11 == 'infographics' ){

		$prefix = 'solid_block_11_';
		get_template_part('template-parts/block', 'infographics', $prefix);

	}elseif ( $block_11 == 'course_topics' ){

		$prefix = 'solid_block_11_';
		get_template_part('template-parts/block', 'course-topics', $prefix);

	}elseif ( $block_11 == 'call' ){

		$prefix = 'solid_block_11_';
		get_template_part('template-parts/block', 'call-quiz', $prefix);

	}elseif ( $block_11 == 'reviews' ){

		$prefix = 'solid_block_11_';
		get_template_part('template-parts/block', 'reviews', $prefix);
	}elseif ( $block_11 == 'contacts' ){

		$prefix = 'solid_block_11_';
		get_template_part('template-parts/block', 'contacts', $prefix);
	}

	//

	if ( $block_12 == 'course_info' ){

		$prefix = 'solid_block_12_';
		get_template_part('template-parts/block', 'course-info', $prefix);

	}elseif ( $block_12 == 'teachers' ){

		$prefix = 'solid_block_12_';
		get_template_part('template-parts/block', 'teachers', $prefix);

	}elseif ( $block_12 == 'free_class' ){

		$prefix = 'solid_block_12_';
		get_template_part('template-parts/block', 'free-class', $prefix);

	}elseif ( $block_12 == 'infographics' ){

		$prefix = 'solid_block_12_';
		get_template_part('template-parts/block', 'infographics', $prefix);

	}elseif ( $block_12 == 'course_topics' ){

		$prefix = 'solid_block_12_';
		get_template_part('template-parts/block', 'course-topics', $prefix);

	}elseif ( $block_12 == 'call' ){

		$prefix = 'solid_block_12_';
		get_template_part('template-parts/block', 'call-quiz', $prefix);

	}elseif ( $block_12 == 'reviews' ){

		$prefix = 'solid_block_12_';
		get_template_part('template-parts/block', 'reviews', $prefix);
	}elseif ( $block_12 == 'contacts' ){

		$prefix = 'solid_block_12_';
		get_template_part('template-parts/block', 'contacts', $prefix);
	}





?>
<?php get_footer();
