
<?php
	$blockTitle = carbon_get_post_meta( get_the_ID(), ''.$args.'free_class_title'.carbon_lang_prefix() );
	$blockText = carbon_get_post_meta( get_the_ID(), ''.$args.'free_class_text'.carbon_lang_prefix() );
	$blockId = carbon_get_post_meta( get_the_ID(), ''.$args.'free_class_id'.carbon_lang_prefix() );
	$blockInfoList = carbon_get_post_meta( get_the_ID(), ''.$args.'free_class_info_blocks'.carbon_lang_prefix() );
	$formBtnText = carbon_get_post_meta( get_the_ID(), ''.$args.'free_class_form_btn'.carbon_lang_prefix() );
	$blockBgColor = carbon_get_post_meta( get_the_ID(), ''.$args.'free_class_background'.carbon_lang_prefix() );

?>
<!-- Free class -->
<section class="free-class animate-target indent-top indent-bottom"
	<?php if( $blockId ):?>
		id="<?php echo $blockId;?>"
	<?php endif;?>
  style="background-color: <?php echo $blockBgColor;?>"
>
	<div class="container">
		<div class="row first-up">
			<h2 class="block-title-mini text-center col-12"><?php echo $blockTitle;?></h2>
		</div>
		<?php if( $blockInfoList ): $i = 0;?>
			<div class="row free-class-slider">
				<?php foreach( $blockInfoList as $infoItem ): $i = $i + 1;?>
					<div class="info col-md-6 <?php if( $i == '1' ):?>
					  second-up
					  <?php elseif ( $i == '2' ):?>
					  third-up
					  <?php elseif ( $i == '3' ):?>
					  fourth-up
					  <?php elseif ( $i == '4' ):?>
					  fifth-up
					<?php endif;?>">
            <div class="inner">
              <h3 class="name"><?php echo $infoItem['info_name'];?></h3>
	            <?php if( $infoItem['info_items'] ):?>
                <ul>
			            <?php foreach( $infoItem['info_items'] as $itemText ):?>
                    <li><?php echo $itemText['item_name'];?></li>
			            <?php endforeach;?>
                </ul>
	            <?php endif;?>
            </div>
					</div>
				<?php endforeach;?>
			</div>
		<?php endif;?>
		<?php if( $blockText ):?>
      <div class="row">
        <p class="block-text col-12"><?php echo $blockText;?></p>
      </div>
		<?php endif;?>
		<?php if( $formBtnText  ):?>
			<div class="row">
				<div class="form-wrapper col-12">
					<?php
						$productId = carbon_get_post_meta( get_the_ID(), 'integration_course_id'.carbon_lang_prefix() );
						$formArgs['product'] = $productId;
						$formArgs['btn'] = $formBtnText;

						get_template_part('template-parts/form', '', $formArgs);

					?>
				</div>
			</div>
		<?php endif;?>
	</div>
</section>