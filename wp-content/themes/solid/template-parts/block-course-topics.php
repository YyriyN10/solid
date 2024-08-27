
<?php
	$blockTitle = carbon_get_post_meta( get_the_ID(), ''.$args.'course_topics_title'.carbon_lang_prefix() );
	$blockList = carbon_get_post_meta( get_the_ID(), ''.$args.'course_topics_list'.carbon_lang_prefix() );
	$blockId = carbon_get_post_meta( get_the_ID(), ''.$args.'course_topics_id'.carbon_lang_prefix() );
	$blockBgColor = carbon_get_post_meta( get_the_ID(), ''.$args.'course_topics_background'.carbon_lang_prefix() );

	$i = 0;

?>
<!-- Course topics -->
<section class="course-topics animate-target indent-top indent-bottom bg-soft-orange"
	<?php if( $blockId ):?>
		id="<?php echo $blockId;?>"
	<?php endif;?>
  style="background-color: <?php echo $blockBgColor;?>"
>
	<div class="container">
    <div class="row first-up">
      <h2 class="block-title-mini col-xl-9 col-lg-10 col-12"><?php echo $blockTitle;?></h2>
    </div>
		<?php if( $blockList ):?>
      <div class="row topic-list second-up">
				<?php foreach( $blockList as $item ): $i = $i + 1;?>
          <div class="item col-lg-3 col-md-4">
            <div class="inner">
	            <?php if( $i < 10 ):?>
                <span class="number">0<?php echo $i;?> </span>
	            <?php else:?>
                <span class="number"><?php echo $i;?> </span>
	            <?php endif;?>
              <span class="name"><?php echo $item['list_item'];?></span>
            </div>
          </div>
				<?php endforeach;?>
      </div>
		<?php endif;?>
	</div>
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
</section>