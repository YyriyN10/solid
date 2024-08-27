<?php
	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	/**
	 * Template part for displaying page content in page.php
	 *
	 * Template name: Template Thx Page
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package solid
	 *
	 */

	get_header();

	$btnText = carbon_get_post_meta( get_the_ID(), 'solid_thx_btn_text'.carbon_lang_prefix());
	$btnLink = carbon_get_post_meta( get_the_ID(), 'solid_thx_btn_link'.carbon_lang_prefix());
	$addFb = carbon_get_post_meta( get_the_ID(), 'solid_thx_social_fb'.carbon_lang_prefix());
	$addInst = carbon_get_post_meta( get_the_ID(), 'solid_thx_social_inst'.carbon_lang_prefix());
	$addInlink = carbon_get_post_meta( get_the_ID(), 'solid_thx_social_inlink'.carbon_lang_prefix());
	$addYou = carbon_get_post_meta( get_the_ID(), 'solid_thx_social_you'.carbon_lang_prefix());
	$addTik = carbon_get_post_meta( get_the_ID(), 'solid_thx_social_tik'.carbon_lang_prefix());
	$callText = carbon_get_post_meta( get_the_ID(), 'solid_thx_call_text'.carbon_lang_prefix());

	$fbLink = carbon_get_theme_option('fb_link');
	$instLink = carbon_get_theme_option('inst_link');
	$inLink = carbon_get_theme_option('in_link');
	$youLink = carbon_get_theme_option('you_link');
	$tikLink = carbon_get_theme_option('tik_tok_link');

	?>

	<section class="thx-wrapper">
		<div class="container">
			<div class="content col-12">
				<div class="thx-window text-center">
          <svg class="control-emulation" xmlns="http://www.w3.org/2000/svg" width="72" height="24" viewBox="0 0 72 24" fill="none">
            <rect x="45.4297" y="5.28418" width="24.0883" height="14.2676" rx="2.08818" stroke="#40439D" stroke-width="3.00431"/>
            <path d="M22.2344 1.8457L1.85202 22.2278" stroke="#262961" stroke-width="3.00431" stroke-linecap="round"/>
            <path d="M1.85156 1.8457L22.2337 22.2281" stroke="#262961" stroke-width="3.00431" stroke-linecap="round"/>
          </svg>
					<?php the_content();?>
          <?php if( $btnText && $btnLink):?>
            <a href="<?php echo $btnLink;?>" class="button"><?php echo $btnText;?></a>
          <?php else:?>
            <a href="<?php echo get_home_url('/');?>" class="button"><?php echo esc_html( pll__( 'Повернутись на головну' ) ); ?></a>
          <?php endif;?>
          <?php if( $addFb == 'yes' || $addInst == 'yes' || $addInlink == 'yes' || $addYou == 'yes' || $addTik == 'yes' ):?>
            <div class="soc-list">
              <?php if ( $fbLink && $addFb == 'yes' ):?>
              <a href="<?php echo $fbLink;?>" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="31" viewBox="0 0 30 31" fill="none">
                  <g clip-path="url(#clip0_380_3978)">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15 0.421875C6.71573 0.421875 0 7.1376 0 15.4219C0 23.7062 6.71573 30.4219 15 30.4219C23.2843 30.4219 30 23.7062 30 15.4219C30 7.1376 23.2843 0.421875 15 0.421875ZM16.5635 16.0808V24.2416H13.1869V16.0811H11.5V13.2689H13.1869V11.5804C13.1869 9.28612 14.1395 7.92187 16.8457 7.92187H19.0988V10.7345H17.6905C16.637 10.7345 16.5673 11.1275 16.5673 11.861L16.5635 13.2685H19.1147L18.8162 16.0808H16.5635Z" fill="#262961"/>
                  </g>
                  <defs>
                    <clipPath id="clip0_380_3978">
                      <rect width="30" height="31" fill="white"/>
                    </clipPath>
                  </defs>
                </svg>
              </a>
	            <?php endif;?>
	            <?php if ( $instLink && $addInst == 'yes' ):?>
                <a href="<?php echo $instLink;?>" target="_blank">
                  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="31" viewBox="0 0 30 31" fill="none">
                    <g clip-path="url(#clip0_380_3980)">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M15 0.421875C6.71573 0.421875 0 7.1376 0 15.4219C0 23.7062 6.71573 30.4219 15 30.4219C23.2843 30.4219 30 23.7062 30 15.4219C30 7.1376 23.2843 0.421875 15 0.421875ZM11.7021 7.47025C12.5554 7.43142 12.8281 7.42192 15.0008 7.42192H14.9983C17.1716 7.42192 17.4433 7.43142 18.2966 7.47025C19.1483 7.50925 19.73 7.64409 20.24 7.84192C20.7666 8.04609 21.2116 8.31943 21.6567 8.76443C22.1017 9.20911 22.375 9.65544 22.58 10.1817C22.7767 10.6903 22.9117 11.2717 22.9517 12.1234C22.99 12.9767 23 13.2494 23 15.4221C23 17.5947 22.99 17.8667 22.9517 18.7201C22.9117 19.5714 22.7767 20.1529 22.58 20.6618C22.375 21.1878 22.1017 21.6341 21.6567 22.0788C21.2121 22.5238 20.7665 22.7978 20.2405 23.0021C19.7315 23.2 19.1495 23.3348 18.2978 23.3738C17.4444 23.4126 17.1726 23.4221 14.9998 23.4221C12.8272 23.4221 12.5547 23.4126 11.7014 23.3738C10.8499 23.3348 10.2684 23.2 9.75937 23.0021C9.23353 22.7978 8.78719 22.5238 8.34268 22.0788C7.89785 21.6341 7.62451 21.1878 7.42001 20.6616C7.22234 20.1529 7.0875 19.5716 7.04834 18.7199C7.00967 17.8666 7 17.5947 7 15.4221C7 13.2494 7.01 12.9765 7.04817 12.1232C7.0865 11.2718 7.22151 10.6903 7.41984 10.1815C7.62484 9.65544 7.89818 9.20911 8.34318 8.76443C8.78785 8.3196 9.23419 8.04626 9.76036 7.84192C10.269 7.64409 10.8504 7.50925 11.7021 7.47025Z" fill="#262961"/>
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M14.2782 8.86137C14.4176 8.86116 14.5675 8.86122 14.7292 8.8613L14.9959 8.86137C17.1319 8.86137 17.3851 8.86904 18.2286 8.90737C19.0086 8.94304 19.4319 9.07338 19.7139 9.18288C20.0873 9.32788 20.3534 9.50121 20.6333 9.78122C20.9133 10.0612 21.0866 10.3279 21.2319 10.7012C21.3414 10.9829 21.472 11.4062 21.5075 12.1862C21.5458 13.0296 21.5541 13.2829 21.5541 15.4179C21.5541 17.553 21.5458 17.8063 21.5075 18.6496C21.4718 19.4296 21.3414 19.853 21.2319 20.1346C21.0869 20.508 20.9133 20.7738 20.6333 21.0537C20.3533 21.3337 20.0874 21.507 19.7139 21.652C19.4323 21.762 19.0086 21.892 18.2286 21.9277C17.3852 21.966 17.1319 21.9743 14.9959 21.9743C12.8597 21.9743 12.6065 21.966 11.7632 21.9277C10.9832 21.8917 10.5598 21.7613 10.2777 21.6518C9.90435 21.5068 9.63768 21.3335 9.35768 21.0535C9.07768 20.7735 8.90434 20.5075 8.75901 20.134C8.64951 19.8523 8.519 19.429 8.4835 18.649C8.44517 17.8056 8.4375 17.5523 8.4375 15.4159C8.4375 13.2796 8.44517 13.0276 8.4835 12.1842C8.51917 11.4042 8.64951 10.9809 8.75901 10.6989C8.90401 10.3255 9.07768 10.0589 9.35768 9.77888C9.63768 9.49888 9.90435 9.32554 10.2777 9.18021C10.5597 9.07021 10.9832 8.94021 11.7632 8.90437C12.5012 8.87104 12.7872 8.86105 14.2782 8.85938V8.86137ZM19.2663 10.1897C18.7363 10.1897 18.3062 10.6192 18.3062 11.1494C18.3062 11.6794 18.7363 12.1094 19.2663 12.1094C19.7963 12.1094 20.2263 11.6794 20.2263 11.1494C20.2263 10.6194 19.7963 10.1897 19.2663 10.1897ZM10.8875 15.4197C10.8875 13.1509 12.7269 11.3114 14.9957 11.3114C17.2646 11.3114 19.1036 13.1509 19.1036 15.4197C19.1036 17.6886 17.2647 19.5273 14.9959 19.5273C12.727 19.5273 10.8875 17.6886 10.8875 15.4197Z" fill="#262961"/>
                      <path d="M15.0026 12.7539C16.4753 12.7539 17.6693 13.9478 17.6693 15.4206C17.6693 16.8933 16.4753 18.0873 15.0026 18.0873C13.5298 18.0873 12.3359 16.8933 12.3359 15.4206C12.3359 13.9478 13.5298 12.7539 15.0026 12.7539Z" fill="#262961"/>
                    </g>
                    <defs>
                      <clipPath id="clip0_380_3980">
                        <rect width="30" height="31" fill="white"/>
                      </clipPath>
                    </defs>
                  </svg>
                </a>
	            <?php endif;?>
	            <?php if ( $inLink && $addInlink == 'yes' ):?>
                <a href="<?php echo $inLink;?>" target="_blank">
                  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="31" viewBox="0 0 30 31" fill="none">
                    <g clip-path="url(#clip0_380_3984)">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M15 0.421875C6.71573 0.421875 0 7.1376 0 15.4219C0 23.7062 6.71573 30.4219 15 30.4219C23.2843 30.4219 30 23.7062 30 15.4219C30 7.1376 23.2843 0.421875 15 0.421875ZM7.20101 12.8455H10.6003V23.0591H7.20101V12.8455ZM10.8242 9.68606C10.8022 8.68462 10.086 7.92187 8.92315 7.92187C7.76026 7.92187 7 8.68462 7 9.68606C7 10.6668 7.73779 11.4515 8.87902 11.4515H8.90075C10.086 11.4515 10.8242 10.6668 10.8242 9.68606ZM18.9457 12.6057C21.1826 12.6057 22.8596 14.0658 22.8596 17.203L22.8595 23.0591H19.4603V17.5949C19.4603 16.2224 18.9684 15.2858 17.7378 15.2858C16.7987 15.2858 16.2393 15.9172 15.9936 16.527C15.9037 16.7456 15.8817 17.0501 15.8817 17.3553V23.0594H12.4819C12.4819 23.0594 12.5267 13.8042 12.4819 12.8458H15.8817V14.2925C16.3328 13.5971 17.1409 12.6057 18.9457 12.6057Z" fill="#262961"/>
                    </g>
                    <defs>
                      <clipPath id="clip0_380_3984">
                        <rect width="30" height="31" fill="white"/>
                      </clipPath>
                    </defs>
                  </svg>
                </a>
	            <?php endif;?>
	            <?php if ( $youLink && $addYou == 'yes' ):?>
                <a href="<?php echo $youLink;?>" target="_blank">
                  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="31" viewBox="0 0 30 31" fill="none">
                    <g clip-path="url(#clip0_380_3988)">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M15 0.421875C6.71573 0.421875 0 7.1376 0 15.4219C0 23.7062 6.71573 30.4219 15 30.4219C23.2843 30.4219 30 23.7062 30 15.4219C30 7.1376 23.2843 0.421875 15 0.421875ZM21.251 10.2653C21.9395 10.4542 22.4816 11.0109 22.6656 11.7177C23 12.9989 23 15.672 23 15.672C23 15.672 23 18.345 22.6656 19.6262C22.4816 20.3331 21.9395 20.8897 21.251 21.0787C20.0034 21.422 15 21.422 15 21.422C15 21.422 9.99664 21.422 8.74891 21.0787C8.06046 20.8897 7.51828 20.3331 7.33428 19.6262C7 18.345 7 15.672 7 15.672C7 15.672 7 12.9989 7.33428 11.7177C7.51828 11.0109 8.06046 10.4542 8.74891 10.2653C9.99664 9.92192 15 9.92192 15 9.92192C15 9.92192 20.0034 9.92192 21.251 10.2653Z" fill="#262961"/>
                      <path d="M13.5 18.418V13.418L17.5 15.9181L13.5 18.418Z" fill="#262961"/>
                    </g>
                    <defs>
                      <clipPath id="clip0_380_3988">
                        <rect width="30" height="31" fill="white"/>
                      </clipPath>
                    </defs>
                  </svg>
                </a>
	            <?php endif;?>
	            <?php if ( $tikLink && $addTik == 'yes'):?>
                <a href="<?php echo $tikLink;?>" target="_blank">
                  <svg width="30" height="31" viewBox="0 0 30 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_715_1742)">
                      <path d="M0 15.4219C0 7.1376 6.71573 0.421875 15 0.421875C23.2843 0.421875 30 7.1376 30 15.4219C30 23.7062 23.2843 30.4219 15 30.4219C6.71573 30.4219 0 23.7062 0 15.4219Z" fill="#262961"/>
                      <path d="M19.2158 9.335C18.5892 8.61965 18.2439 7.70098 18.2442 6.75H15.4117V18.1167C15.3898 18.7318 15.1301 19.3144 14.6873 19.7419C14.2444 20.1693 13.653 20.4082 13.0375 20.4083C11.7358 20.4083 10.6542 19.345 10.6542 18.025C10.6542 16.4483 12.1758 15.2658 13.7433 15.7517V12.855C10.5808 12.4333 7.8125 14.89 7.8125 18.025C7.8125 21.0775 10.3425 23.25 13.0283 23.25C15.9067 23.25 18.2442 20.9125 18.2442 18.025V12.2592C19.3927 13.084 20.7718 13.5266 22.1858 13.5242V10.6917C22.1858 10.6917 20.4625 10.7742 19.2158 9.335Z" fill="#F8F8F8"/>
                    </g>
                    <defs>
                      <clipPath id="clip0_715_1742">
                        <rect width="30" height="31" fill="white"/>
                      </clipPath>
                    </defs>
                  </svg>

                </a>
	            <?php endif;?>
            </div>
          <?php endif;?>
          <?php if( $callText ):?>
            <p class="call-text"><?php echo $callText;?></p>
          <?php endif;?>



				</div>
				<div class="pic-wrapper">
					<img src="<?php echo THEME_PATH;?>/assets/img/thx-pic.png" alt="">
				</div>
			</div>
		</div>
	</section>
<?php get_footer();
