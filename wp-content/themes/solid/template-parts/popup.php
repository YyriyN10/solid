<?php

	$productId = carbon_get_post_meta( get_the_ID(), 'integration_course_id'.carbon_lang_prefix() );
	$formArgs['product'] = $productId;
	$mainFormCall = carbon_get_post_meta( get_the_ID(), 'main_form_title'.carbon_lang_prefix() );
	?>

<!-- The Modal -->
<div class="modal form-modal" id="formModal">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title"><?php echo $mainFormCall;?></h4>
				<button type="button" class="close" data-dismiss="modal">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M18.3516 6L6.00116 17.9993" stroke="#262961" stroke-width="3.00431" stroke-linecap="round"/>
            <path d="M6 6.00055L18.3503 18" stroke="#262961" stroke-width="3.00431" stroke-linecap="round"/>
          </svg>
        </button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<?php
					$mainFormTitle = carbon_get_post_meta( get_the_ID(), 'main_form_title'.carbon_lang_prefix() );
					$mainFormCall = carbon_get_post_meta( get_the_ID(), 'main_form_call'.carbon_lang_prefix() );
					$mainBtnText = carbon_get_post_meta( get_the_ID(), 'main_form_submit_text'.carbon_lang_prefix() );

					$mainFormArgs = $formArgs;
					$mainFormArgs['btn'] = $mainBtnText;

					get_template_part('template-parts/form', '', $mainFormArgs);
				?>

			</div>

		</div>
	</div>
</div>

<!-- Video Modal -->
<div class="modal video-modal" id="videoModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M18.3516 6L6.00116 17.9993" stroke="white" stroke-width="3.00431" stroke-linecap="round"/>
            <path d="M6 6.00049L18.3503 17.9999" stroke="white" stroke-width="3.00431" stroke-linecap="round"/>
          </svg>
        </button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="video">

        </div>
      </div>


    </div>
  </div>
</div>