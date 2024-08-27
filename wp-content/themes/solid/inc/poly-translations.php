<?php

	add_action('init', 'solid_polylang_strings' );

	function solid_polylang_strings() {

		if( ! function_exists( 'pll_register_string' ) ) {
			return;
		}

		pll_register_string(
			'solid_placeholder_name',
			'Повне і’мя',
			'Переклади',
			false
		);

		pll_register_string(
			'solid_placeholder_phone',
			'Мобільний телефон',
			'Переклади',
			false
		);

		pll_register_string(
			'solid_placeholder_email',
			'Електронна пошта',
			'Переклади',
			false
		);

		pll_register_string(
			'solid_btn_more_teacher_info',
			'детальніше',
			'Переклади',
			false
		);

		pll_register_string(
			'solid_text_dev_in',
			'Розроблено в',
			'Переклади',
			false
		);

		pll_register_string(
			'solid_404_text',
			'Сторінка, на яку ви намагаєтесь перейти, не існує.',
			'Переклади',
			false
		);

		pll_register_string(
			'solid_btn_go_home',
			'Повернутись на головну',
			'Переклади',
			false
		);


	}