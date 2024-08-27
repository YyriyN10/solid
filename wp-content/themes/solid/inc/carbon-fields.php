<?php

	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	use Carbon_Fields\Container;
	use Carbon_Fields\Field;


	/**
	 * Options Page
	 */

	add_action( 'carbon_fields_register_fields', 'solid_theme_options' );

	function solid_theme_options() {
		Container::make( 'theme_options', 'Опції сайту')
		         ->set_icon( 'dashicons-admin-generic' )
		         ->add_fields( array(
			         Field::make( 'text', 'custom_logo_link', 'Посилання на перехід на сторонній ресурс ' )
				            ->set_attribute('placeholder', __( 'https://solid.com.ua/' ))
		                ->set_attribute('type', 'url'),
			         Field::make( 'text', 'fb_link', 'Посилання на Сторінку Facebook ' )
			              ->set_attribute('placeholder', __( 'https://www.facebook.com/solid.com.ua' ))
			              ->set_attribute('type', 'url'),
			         Field::make( 'text', 'inst_link', 'Посилання на Сторінку Instagram ' )
			              ->set_attribute('placeholder', __( 'https://www.instagram.com/solid.com.ua/' ))
			              ->set_attribute('type', 'url'),
			         Field::make( 'text', 'in_link', 'Посилання на Сторінку Linkedin ' )
			              ->set_attribute('placeholder', __( 'https://www.linkedin.com/company/solid-english-school' ))
			              ->set_attribute('type', 'url'),
			         Field::make( 'text', 'tg_ch_link', 'Посилання на Telegram канал' )
			              ->set_attribute('placeholder', __( 'https://t.me/solid_english_school' ))
			              ->set_attribute('type', 'url'),
			         Field::make( 'text', 'tg_bot_link', 'Посилання на Telegram бот' )
			              ->set_attribute('placeholder', __( 'https://t.me/SolidEnglishSchool_bot' ))
			              ->set_attribute('type', 'url'),
			         Field::make( 'text', 'you_link', 'Посилання на Сторінку Youtube ' )
			              ->set_attribute('placeholder', __( 'https://www.youtube.com/channel/UCRCrEs8GTkKWmlAAQXNi-rQ' ))
			              ->set_attribute('type', 'url'),
			         Field::make( 'text', 'contact_phone', 'Контактний телефон ' )
			              ->set_attribute('placeholder', '+380673334179'),
			         Field::make( 'text', 'contact_email', 'Контактний email' )
			              ->set_attribute('placeholder', 'study@solid.com.ua')
				            ->set_attribute('type', 'email'),
			         Field::make( 'text', 'tik_tok_link', 'Посилання на Сторінку TikTok ' )
			              ->set_attribute('placeholder', __( 'https://www.tiktok.com/' ))
			              ->set_attribute('type', 'url'),

			         Field::make( 'association', 'teachers_list', __( 'Перелік вчителів на курсі' ) )
			              ->set_types( array(
				              array(
					              'type'      => 'post',
					              'post_type' => 'teachers',
				              )
			              ) ),
		         ) );
	}

	//Custom thx page
	add_action('carbon_fields_register_fields', 'custom_course_thx_page');

	function custom_course_thx_page(){
		Container::make( 'post_meta', 'Кастомна сторінка подяки' )
		         ->where( function( $homeFields ) {
			         $homeFields->where( 'post_type', '=', 'page' );
			         $homeFields->where( 'post_template', '=', 'template-course.php' );
		         } )
		         ->add_fields( array(
			         Field::make( 'text', 'solid_course_custom_thx_link'.carbon_lang_prefix(), 'Посилання на сторінку подяки ' )
			              ->set_attribute('placeholder', __( 'https://solid.com.ua/thx' ))
			              ->set_attribute('type', 'url'),
		         ));
	}


	/**
	 * Custom Course Page Menu
	 */

	add_action('carbon_fields_register_fields', 'custom_course_menu');

	function custom_course_menu(){
		Container::make( 'post_meta', 'Меню навігації по сторінці курсу' )
		         ->where( function( $homeFields ) {
			         $homeFields->where( 'post_type', '=', 'page' );
			         $homeFields->where( 'post_template', '=', 'template-course.php' );
		         } )

		         ->add_fields( array(

			         Field::make( 'complex', 'custom_course_menu_list'.carbon_lang_prefix(), 'Перелік пунктів меню' )

			              ->add_fields( array(
				              Field::make( 'text', 'menu_anchor_id', 'Ярлик блоку'  )
				                   ->set_attribute( 'placeholder', __( '#block-id' ) )
				                   ->set_help_text( 'Сюди треба додати вміст поля "Ідентифікатор блоку" з того блоку на який вказуватиме пункт навігації. Перед ідентифікатором слід поставити знак # як у прикладі'),
				              Field::make( 'text', 'menu_item_text', 'Назва пункту меню'  )
				                   ->set_attribute( 'placeholder', __( 'Відгуки' ) ),

			              ) ),

		         ));
	}



	/**
	 * Course Page
	 */

	add_action( 'carbon_fields_register_fields', 'course_page_fields' );

	function course_page_fields(){

		Container::make( 'post_meta', 'Головний екран' )
		         ->where( function( $homeFields ) {
			         $homeFields->where( 'post_type', '=', 'page' );
			         $homeFields->where( 'post_template', '=', 'template-course.php' );
		         } )

		         ->add_fields( array(
			         Field::make( 'radio', 'main_form_type'.carbon_lang_prefix(), __('Оберіть тип першого екрану') )
			              ->set_options( array(
				              'open_form' => __('Відкрита форма'),
				              'popup_form' => __('Форма у спливаючему вікні'),

			              ) ),

			         Field::make( 'color', 'main_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#f1fbfd', '#FEFEFE', '#fefefb' ) ),
			         Field::make( 'text', 'main_course_type'.carbon_lang_prefix(), 'Тип курсу'  )
			              ->set_attribute( 'placeholder', __( 'online course' ) ),

			         Field::make( 'text', 'main_course_name'.carbon_lang_prefix(), 'Назва курсу'  )
				            ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt &lt;/span&gt')
			              ->set_attribute( 'placeholder', __( '"IT STARTER"' ) ),


			         Field::make( 'textarea', 'main_call'.carbon_lang_prefix(), 'Текст заклику'  )
				            ->set_attribute( 'placeholder', __( 'Твоя кар`єрна підтримка у світі ІТ.  Розберись у технічній англійській та підвищуй  свою конкурентоспроможність.' ) )
				            ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
				            ->set_rows( 4 ),
			         Field::make( 'textarea', 'main_form_title'.carbon_lang_prefix(), 'Заголовок форми'  )
				            ->set_attribute( 'placeholder', __( 'Поглиблюй розуміння ІТ термінів та освоюй англійську документацію. Відчуй себе впевнено 
на англомовних зустрічах' ) )
										->set_rows( 4 ),
			         Field::make( 'text', 'main_form_submit_text'.carbon_lang_prefix(), 'Текст кнопки у формі'  )
				            ->set_attribute( 'placeholder', __( 'Замовити консультацію' ) ),

			         Field::make( 'complex', 'main_team_slider'.carbon_lang_prefix(), 'Перелік робітників' )

			              ->add_fields( array(
				              Field::make( 'text', 'team_men_position', 'Посада'  )
				                   ->set_attribute( 'placeholder', __( 'CEO Solid Es' ) ),
				              Field::make( 'text', 'team_men_name', 'Імʼя'  )
				                   ->set_attribute( 'placeholder', __( 'Анастасія Машталяр' ) ),
				              Field::make( 'image', 'team_men_photo', 'Зображення працівника' )
				                   ->set_value_type( 'url' ),
			              ) ),

		         ));

		//Block 1

		Container::make( 'post_meta', 'Блок № 1' )
		         ->where( function( $homeFields ) {
			         $homeFields->where( 'post_type', '=', 'page' );
			         $homeFields->where( 'post_template', '=', 'template-course.php' );
		         } )

		         ->add_fields( array(
			         Field::make( 'radio', 'solid_block_1_question'.carbon_lang_prefix(), __('Оберіть який блок відображати') )
			              ->set_options( array(
				              'course_info' => __('Блок "Інформація про курс"'),
				              'teachers' => __('Блок "Вчителі"'),
				              'free_class' => __('Блок "Пробне заняття"'),
				              'infographics' => __('Блок "Інфографіка"'),
				              'course_topics' => __('Блок "Теми курсу"'),
				              'call' => __('Блок "Призов до дії"'),
				              'reviews' => __('Блок "Відгуки"'),
											'contacts' => __('Блок "Контакти"'),
				              'off' => __('Вимкнути'),

			              ) ),

			         /**
			          * Блок "Інформація про курс"
			          */
			         Field::make( 'text', 'solid_block_1_course_info_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
				         ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_1_course_info_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F1FBFD', '#F4FEFC', '#FEF3ED' ) )
						        ->set_conditional_logic( array(
							        'relation' => 'AND',
							        array(
								        'field' => 'solid_block_1_question'.carbon_lang_prefix(),
								        'value' => 'course_info',
								        'compare' => '=',
							        )
						        ) ),
			         Field::make( 'text', 'solid_block_1_course_info_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
				            ->set_attribute( 'placeholder', __( 'Курс англійської IT STARTER' ) )
				            ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt &lt;/span&gt')
				            ->set_conditional_logic( array(
					            'relation' => 'AND',
					            array(
						            'field' => 'solid_block_1_question'.carbon_lang_prefix(),
						            'value' => 'course_info',
						            'compare' => '=',
					            )
				            ) ),
			         Field::make( 'complex', 'solid_block_1_course_info_about'.carbon_lang_prefix(), 'Перелік інформаціїних блоків про курс (Звичайні)' )
						        ->set_conditional_logic( array(
							        'relation' => 'AND',
							        array(
								        'field' => 'solid_block_1_question'.carbon_lang_prefix(),
								        'value' => 'course_info',
								        'compare' => '=',
							        )
						        ) )
			              ->add_fields( array(
				              Field::make( 'image', 'icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Кількість занятть у курсі' ) ),
				              Field::make( 'text', 'info_value', 'Значення'  )
				                   ->set_attribute( 'placeholder', __( '24' ) ),
			              ) ),
			         Field::make( 'complex', 'solid_block_1_course_info_about_hlight'.carbon_lang_prefix(), 'Перелік інформаціїних блоків про курс (Виділені)' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Кількість занятть у курсі' ) ),
				              Field::make( 'text', 'info_value', 'Значення'  )
				                   ->set_attribute( 'placeholder', __( '24' ) ),
			              ) ),
			         Field::make( 'text', 'solid_block_1_course_info_sub_title'.carbon_lang_prefix(), 'Підзаголовок блоку'  )
				            ->set_attribute( 'placeholder', __( 'Зміцни навички та отримай переваги разом з Solid' ) )
				            ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt &lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_1_course_info_advantages'.carbon_lang_prefix(), 'Перелік переваг' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
				            ->add_fields( array(
					            Field::make( 'image', 'advantage_icon', 'Іконка блоку' )
					                 ->set_value_type( 'url' ),
					            Field::make( 'text', 'advantage_name', 'Назва'  )
						               ->set_attribute( 'placeholder', __( '24 онлайн заняття' ) ),
					            Field::make( 'textarea', 'advantage_description', 'Оптс'  )
						               ->set_attribute( 'placeholder', __( 'На уроках ти будеш вивчати IT лексику та граматику на реальних прикладах комунікації в IT' ) )
					                 ->set_rows( 4 ),

				            ) ),
			         /**
			          * Блок "Вчителі"
			          */
			         Field::make( 'text', 'solid_block_1_teachers_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_1_teachers_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#FEFEFE', '#F1FBFD' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),

			         Field::make( 'text', 'solid_block_1_teachers_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
				            ->set_attribute( 'placeholder', __( 'Наша методологія та професійні вчителі: ключ до успішного вивчення англійської' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_1_teachers_text'.carbon_lang_prefix(), 'Текст блоку'  )
				             ->set_attribute( 'placeholder', __( 'Тіччери з досвідом та міжнародними сертифікатами CELTA, TESOL, TKT, IELTS, CAE привносять унікальність у наш підхід до навчання. Вони не тільки жили за кордоном та спілкувалися з носіями мови, а й постійно вдосконалюють свої навички на тренінгах, семінарах та конференціях.' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
				            ->set_conditional_logic( array(
					            'relation' => 'AND',
					            array(
						            'field' => 'solid_block_1_question'.carbon_lang_prefix(),
						            'value' => 'teachers',
						            'compare' => '=',
					            )
				            ) ),
			         Field::make( 'text', 'solid_block_1_teachers_slogan'.carbon_lang_prefix(), 'Слоган'  )
				            ->set_attribute( 'placeholder', __( 'Для нас навчання англійської - це не просто робота, а стиль життя та пристрасть, яку ми з ентузіазмом передаємо нашим студентам.' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),

			         Field::make( 'association', 'solid_block_1_teachers_list'.carbon_lang_prefix(), __( 'Перелік вчителів на курсі' ) )
					         ->set_conditional_logic( array(
						         'relation' => 'AND',
						         array(
							         'field' => 'solid_block_1_question'.carbon_lang_prefix(),
							         'value' => 'teachers',
							         'compare' => '=',
						         )
					         ) )
			              ->set_types( array(
				              array(
					              'type'      => 'post',
					              'post_type' => 'teachers',
				              )
			              ) ),

			         /**
			          * Блок "Пробне заняття"
			          */
			         Field::make( 'text', 'solid_block_1_free_class_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_1_free_class_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_1_free_class_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
				            ->set_attribute( 'placeholder', __( 'Спробуй безкоштовне пробне заняття із курсу IT Starter. Отримай унікальну можливість випробувати наше пробне заняття з курсу IT Starter.' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_1_free_class_text'.carbon_lang_prefix(), 'Текст блоку'  )
				            ->set_attribute( 'placeholder', __( 'Поглибь свої знання в області ІТ та оціни якість нашого навчання.
Розпочни свій шлях до успішної ІТ кар`єри з англомовними проектами вже сьогодні' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_1_free_class_info_blocks'.carbon_lang_prefix(), 'Перелік блоків з інформацією' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'info_name', 'Назва'  )
					                 ->set_attribute( 'placeholder', __( 'Цей курс підійде тобі, якщо ти' ) ),
				              Field::make( 'complex', 'info_items', 'Перелік інформації' )
				                   ->add_fields( array(
					                   Field::make( 'text', 'item_name', 'Текст'  )
						                   ->set_attribute( 'placeholder', __( 'Тільки починаєш кар`єру IT' ) ),
				                   ) )
			              ) ),
				       Field::make( 'text', 'solid_block_1_free_class_form_btn'.carbon_lang_prefix(), 'Текст кнопки у формі'  )
					         ->set_attribute( 'placeholder', __( 'Пробне заняття' ) )
				              ->set_conditional_logic( array(
					              'relation' => 'AND',
					              array(
						              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
						              'value' => 'free_class',
						              'compare' => '=',
					              )
				              ) ),

			         /**
			          * Блок "Інфографіка"
			          */
			         Field::make( 'text', 'solid_block_1_infographics_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_1_infographics_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_1_infographics_list_title'.carbon_lang_prefix(), 'Назва переліку'  )
			              ->set_attribute( 'placeholder', __( 'Переваги навчання у Solid ES' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_1_infographics_items_list'.carbon_lang_prefix(), 'Перелік інфографіки' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'infographics_item_text', 'Значення'  )
					                 ->set_attribute('type', 'number')
				                   ->set_attribute( 'placeholder', __( '5' ) ),
				              Field::make( 'text', 'infographics_item_symbol', 'Додатковий символ'  )
				                   ->set_attribute( 'placeholder', __( '+' ) ),
				              Field::make( 'text', 'infographics_item_description', 'Опис'  )
				                   ->set_attribute( 'placeholder', __( 'років досвіду' ) ),
			              ) ),

			         Field::make( 'complex', 'solid_block_1_infographics_list'.carbon_lang_prefix(), 'Перелік' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'list_item', 'Текст'  )
				                   ->set_attribute( 'placeholder', __( 'Профільна технічна англійська' ) ),
			              ) ),

			         Field::make( 'image', 'solid_block_1_infographics_image'.carbon_lang_prefix(), 'Зображення' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_value_type( 'url' ),

			         Field::make( 'text', 'solid_block_1_infographics_position'.carbon_lang_prefix(), 'Посада'  )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_attribute( 'placeholder', __( 'CEO Solid Es' ) ),

			         Field::make( 'text', 'solid_block_1_infographics_person_name'.carbon_lang_prefix(), 'Іʼмя'  )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_attribute( 'placeholder', __( 'Анастасія Машталяр' ) ),

			         /**
			          * Блок "Теми курсу"
			          */
			         Field::make( 'text', 'solid_block_1_course_topics_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_1_course_topics_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEF3ED', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_1_course_topics_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
				            ->set_attribute( 'placeholder', __( '24 теми уроків курсу "IT Starter" зосереджені на спеціалізованій тематиці ІТ' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_1_course_topics_list'.carbon_lang_prefix(), 'Перелік' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'list_item', 'Текст'  )
					                 ->set_attribute( 'placeholder', __( 'Problem-solving' ) ),
			              ) ),

			         /**
			          * Блок "Призов пройти опитування"
			          */
			         Field::make( 'text', 'solid_block_1_call_quiz_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_1_call_quiz_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_1_call_quiz_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
				            ->set_attribute( 'placeholder', __( 'Не можеш визначитись з програмою навчання? ' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_1_call_quiz_text'.carbon_lang_prefix(), 'Текст блоку'  )
				            ->set_attribute( 'placeholder', __( 'Пройди безкоштовне тестування рівня англійської мови та отримай індивідуальні рекомендації щодо найкращого курсу' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         /*Field::make( 'text', 'solid_block_1_call_quiz_call_btn'.carbon_lang_prefix(), 'Текст заклику натиснути кнопку'  )
				            ->set_attribute( 'placeholder', __( 'Пройти онлайн тестування
та отримати індивідуальні рекомендації' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),*/
			         Field::make( 'text', 'solid_block_1_call_quiz_btn_text'.carbon_lang_prefix(), 'Текст кнопки'  )
				            ->set_attribute( 'placeholder', __( 'Пройти тест' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_1_call_quiz_btn_link'.carbon_lang_prefix(), 'Посилання у кнопку'  )
				            ->set_attribute( 'placeholder', __( 'https://solid.com.ua/' ) )
				            ->set_attribute( 'type', 'url' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'image', 'solid_block_1_call_quiz_block_image'.carbon_lang_prefix(), 'Зображення' )
			              ->set_value_type( 'url' )
						        ->set_conditional_logic( array(
							        'relation' => 'AND',
							        array(
								        'field' => 'solid_block_1_question'.carbon_lang_prefix(),
								        'value' => 'call',
								        'compare' => '=',
							        )
						        ) ),
			         /**
			          * Блок "Відгуки"
			          */
			         Field::make( 'text', 'solid_block_1_reviews_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_1_reviews_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#00C3EB', '#40439D', '#FFB28B' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_1_reviews_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Відгуки про Курси англійської для IT' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt&lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_1_reviews_pre_rev_text'.carbon_lang_prefix(), 'Текст'  )
			              ->set_attribute( 'placeholder', __( 'Думки наших студентів:' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_1_reviews_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Дізнайся, як наші програми допомогли їм покращити рівень англійської, отримати нові можливості та розширити свої професійні горизонти.' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         /**
			          * Блок "Контакти"
			          */
			         Field::make( 'text', 'solid_block_1_contacts_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_1_contacts_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_1_contacts_form_title'.carbon_lang_prefix(), 'Заголовок форми'  )
			              ->set_attribute( 'placeholder', __( 'Залишились питання, залишайте заявку на безкоштовну консультацію' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_1_contacts_form_btn_text'.carbon_lang_prefix(), 'Текст кнопки у формі'  )
			              ->set_attribute( 'placeholder', __( 'Замовити консультацію' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_1_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),

		         ));

		//Block 2

		Container::make( 'post_meta', 'Блок № 2' )
		         ->where( function( $homeFields ) {
			         $homeFields->where( 'post_type', '=', 'page' );
			         $homeFields->where( 'post_template', '=', 'template-course.php' );
		         } )

		         ->add_fields( array(
			         Field::make( 'radio', 'solid_block_2_question'.carbon_lang_prefix(), __('Оберіть який блок відображати') )
			              ->set_options( array(
				              'course_info' => __('Блок "Інформація про курс"'),
				              'teachers' => __('Блок "Вчителі"'),
				              'free_class' => __('Блок "Пробне заняття"'),
				              'infographics' => __('Блок "Інфографіка"'),
				              'course_topics' => __('Блок "Теми курс"'),
				              'call' => __('Блок "Призив до дії"'),
				              'reviews' => __('Блок "Відгуки"'),
				              'contacts' => __('Блок "Контакти"'),
				              'off' => __('Вимкнути'),

			              ) ),
			         /**
			          * Блок "Інформація про курс"
			          */
			         Field::make( 'text', 'solid_block_2_course_info_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_2_course_info_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F1FBFD', '#F4FEFC', '#FEF3ED' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_2_course_info_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Курс англійської IT STARTER' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt &lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_2_course_info_about'.carbon_lang_prefix(), 'Перелік інформаціїних блоків про курс (Звичайні)' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Кількість занятть у курсі' ) ),
				              Field::make( 'text', 'info_value', 'Значення'  )
				                   ->set_attribute( 'placeholder', __( '24' ) ),
			              ) ),
			         Field::make( 'complex', 'solid_block_2_course_info_about_hlight'.carbon_lang_prefix(), 'Перелік інформаціїних блоків про курс (Виділені)' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Кількість занятть у курсі' ) ),
				              Field::make( 'text', 'info_value', 'Значення'  )
				                   ->set_attribute( 'placeholder', __( '24' ) ),
			              ) ),
			         Field::make( 'text', 'solid_block_2_course_info_sub_title'.carbon_lang_prefix(), 'Підзаголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Зміцни навички та отримай переваги разом з Solid' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt &lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_2_course_info_advantages'.carbon_lang_prefix(), 'Перелік переваг' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'advantage_icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'advantage_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( '24 онлайн заняття' ) ),
				              Field::make( 'textarea', 'advantage_description', 'Оптс'  )
				                   ->set_attribute( 'placeholder', __( 'На уроках ти будеш вивчати IT лексику та граматику на реальних прикладах комунікації в IT' ) )
				                   ->set_rows( 4 ),

			              ) ),
			         /**
			          * Блок "Вчителі"
			          */
			         Field::make( 'text', 'solid_block_2_teachers_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_2_teachers_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#FEFEFE', '#F1FBFD' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),

			         Field::make( 'text', 'solid_block_2_teachers_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Наша методологія та професійні вчителі: ключ до успішного вивчення англійської' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_2_teachers_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Тіччери з досвідом та міжнародними сертифікатами CELTA, TESOL, TKT, IELTS, CAE привносять унікальність у наш підхід до навчання. Вони не тільки жили за кордоном та спілкувалися з носіями мови, а й постійно вдосконалюють свої навички на тренінгах, семінарах та конференціях.' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_2_teachers_slogan'.carbon_lang_prefix(), 'Слоган'  )
			              ->set_attribute( 'placeholder', __( 'Для нас навчання англійської - це не просто робота, а стиль життя та пристрасть, яку ми з ентузіазмом передаємо нашим студентам.' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),

			         Field::make( 'association', 'solid_block_2_teachers_list'.carbon_lang_prefix(), __( 'Перелік вчителів на курсі' ) )
						         ->set_types( array(
							         array(
								         'type'      => 'post',
								         'post_type' => 'teachers',
							         )
						         ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),


			         /**
			          * Блок "Пробне заняття"
			          */
			         Field::make( 'text', 'solid_block_2_free_class_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_2_free_class_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_2_free_class_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Спробуй безкоштовне пробне заняття із курсу IT Starter. Отримай унікальну можливість випробувати наше пробне заняття з курсу IT Starter.' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_2_free_class_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Поглибь свої знання в області ІТ та оціни якість нашого навчання.
Розпочни свій шлях до успішної ІТ кар`єри з англомовними проектами вже сьогодні' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_2_free_class_info_blocks'.carbon_lang_prefix(), 'Перелік блоків з інформацією' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Цей курс підійде тобі, якщо ти' ) ),
				              Field::make( 'complex', 'info_items', 'Перелік інформації' )
				                   ->add_fields( array(
					                   Field::make( 'text', 'item_name', 'Текст'  )
					                        ->set_attribute( 'placeholder', __( 'Тільки починаєш кар`єру IT' ) ),
				                   ) )
			              ) ),
			         Field::make( 'text', 'solid_block_2_free_class_form_btn'.carbon_lang_prefix(), 'Текст кнопки у формі'  )
			              ->set_attribute( 'placeholder', __( 'Пробне заняття' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),

			         /**
			          * Блок "Інфографіка"
			          */
			         Field::make( 'text', 'solid_block_2_infographics_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_2_infographics_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_2_infographics_list_title'.carbon_lang_prefix(), 'Назва переліку'  )
			              ->set_attribute( 'placeholder', __( 'Переваги навчання у Solid ES' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_2_infographics_items_list'.carbon_lang_prefix(), 'Перелік інфографіки' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'infographics_item_text', 'Значення'  )
				                   ->set_attribute('type', 'number')
				                   ->set_attribute( 'placeholder', __( '5' ) ),
				              Field::make( 'text', 'infographics_item_symbol', 'Додатковий символ'  )
				                   ->set_attribute( 'placeholder', __( '+' ) ),
				              Field::make( 'text', 'infographics_item_description', 'Опис'  )
				                   ->set_attribute( 'placeholder', __( 'років досвіду' ) ),
			              ) ),

			         Field::make( 'complex', 'solid_block_2_infographics_list'.carbon_lang_prefix(), 'Перелік' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'list_item', 'Текст'  )
				                   ->set_attribute( 'placeholder', __( 'Профільна технічна англійська' ) ),
			              ) ),

			         Field::make( 'image', 'solid_block_2_infographics_image'.carbon_lang_prefix(), 'Зображення' )
						        ->set_conditional_logic( array(
							        'relation' => 'AND',
							        array(
								        'field' => 'solid_block_2_question'.carbon_lang_prefix(),
								        'value' => 'infographics',
								        'compare' => '=',
							        )
						        ) )
			              ->set_value_type( 'url' ),

			         Field::make( 'text', 'solid_block_2_infographics_position'.carbon_lang_prefix(), 'Посада'  )
						         ->set_conditional_logic( array(
							         'relation' => 'AND',
							         array(
								         'field' => 'solid_block_2_question'.carbon_lang_prefix(),
								         'value' => 'infographics',
								         'compare' => '=',
							         )
						         ) )
			              ->set_attribute( 'placeholder', __( 'CEO Solid Es' ) ),

			         Field::make( 'text', 'solid_block_2_infographics_person_name'.carbon_lang_prefix(), 'Іʼмя'  )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_attribute( 'placeholder', __( 'Анастасія Машталяр' ) ),

			         /**
			          * Блок "Теми курсу"
			          */
			         Field::make( 'text', 'solid_block_2_course_topics_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_2_course_topics_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEF3ED', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_2_course_topics_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( '24 теми уроків курсу "IT Starter" зосереджені на спеціалізованій тематиці ІТ' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_2_course_topics_list'.carbon_lang_prefix(), 'Перелік' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'list_item', 'Текст'  )
				                   ->set_attribute( 'placeholder', __( 'Problem-solving' ) ),
			              ) ),

			         /**
			          * Блок "Призов пройти опитування"
			          */
			         Field::make( 'text', 'solid_block_2_call_quiz_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_2_call_quiz_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_2_call_quiz_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Не можеш визначитись з програмою навчання? ' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_2_call_quiz_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Пройди безкоштовне тестування рівня англійської мови та отримай індивідуальні рекомендації щодо найкращого курсу' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			        /* Field::make( 'text', 'solid_block_2_call_quiz_call_btn'.carbon_lang_prefix(), 'Текст заклику натиснути кнопку'  )
			              ->set_attribute( 'placeholder', __( 'Пройти онлайн тестування
та отримати індивідуальні рекомендації' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),*/
			         Field::make( 'text', 'solid_block_2_call_quiz_btn_text'.carbon_lang_prefix(), 'Текст кнопки'  )
			              ->set_attribute( 'placeholder', __( 'Пройти тест' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_2_call_quiz_btn_link'.carbon_lang_prefix(), 'Посилання у кнопку'  )
			              ->set_attribute( 'placeholder', __( 'https://solid.com.ua/' ) )
			              ->set_attribute( 'type', 'url' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'image', 'solid_block_2_call_quiz_block_image'.carbon_lang_prefix(), 'Зображення' )
			              ->set_value_type( 'url' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         /**
			          * Блок "Відгуки"
			          */
			         Field::make( 'text', 'solid_block_2_reviews_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_2_reviews_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#00C3EB', '#40439D', '#FFB28B' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_2_reviews_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Відгуки про Курси англійської для IT' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt&lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_2_reviews_pre_rev_text'.carbon_lang_prefix(), 'Текст'  )
			              ->set_attribute( 'placeholder', __( 'Думки наших студентів:' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_2_reviews_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Дізнайся, як наші програми допомогли їм покращити рівень англійської, отримати нові можливості та розширити свої професійні горизонти.' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         /**
			          * Блок "Контакти"
			          */
			         Field::make( 'text', 'solid_block_2_contacts_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_2_contacts_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_2_contacts_form_title'.carbon_lang_prefix(), 'Заголовок форми'  )
			              ->set_attribute( 'placeholder', __( 'Залишились питання, залишайте заявку на безкоштовну консультацію' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_2_contacts_form_btn_text'.carbon_lang_prefix(), 'Текст кнопки у формі'  )
			              ->set_attribute( 'placeholder', __( 'Замовити консультацію' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_2_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),

		         ));
		//Block 3
		Container::make( 'post_meta', 'Блок № 3' )
		         ->where( function( $homeFields ) {
			         $homeFields->where( 'post_type', '=', 'page' );
			         $homeFields->where( 'post_template', '=', 'template-course.php' );
		         } )

		         ->add_fields( array(
			         Field::make( 'radio', 'solid_block_3_question'.carbon_lang_prefix(), __('Оберіть який блок відображати') )
			              ->set_options( array(
				              'course_info' => __('Блок "Інформація про курс"'),
				              'teachers' => __('Блок "Вчителі"'),
				              'free_class' => __('Блок "Пробне заняття"'),
				              'infographics' => __('Блок "Інфографіка"'),
				              'course_topics' => __('Блок "Теми курс"'),
				              'call' => __('Блок "Призив до дії"'),
				              'reviews' => __('Блок "Відгуки"'),
				              'contacts' => __('Блок "Контакти"'),
				              'off' => __('Вимкнути'),

			              ) ),
			         /**
			          * Блок "Інформація про курс"
			          */
			         Field::make( 'text', 'solid_block_3_course_info_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_3_course_info_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F1FBFD', '#F4FEFC', '#FEF3ED' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_3_course_info_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Курс англійської IT STARTER' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt &lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_3_course_info_about'.carbon_lang_prefix(), 'Перелік інформаціїних блоків про курс (Звичайні)' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Кількість занятть у курсі' ) ),
				              Field::make( 'text', 'info_value', 'Значення'  )
				                   ->set_attribute( 'placeholder', __( '24' ) ),
			              ) ),
			         Field::make( 'complex', 'solid_block_3_course_info_about_hlight'.carbon_lang_prefix(), 'Перелік інформаціїних блоків про курс (Виділені)' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Кількість занятть у курсі' ) ),
				              Field::make( 'text', 'info_value', 'Значення'  )
				                   ->set_attribute( 'placeholder', __( '24' ) ),
			              ) ),
			         Field::make( 'text', 'solid_block_3_course_info_sub_title'.carbon_lang_prefix(), 'Підзаголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Зміцни навички та отримай переваги разом з Solid' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt &lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_3_course_info_advantages'.carbon_lang_prefix(), 'Перелік переваг' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'advantage_icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'advantage_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( '24 онлайн заняття' ) ),
				              Field::make( 'textarea', 'advantage_description', 'Оптс'  )
				                   ->set_attribute( 'placeholder', __( 'На уроках ти будеш вивчати IT лексику та граматику на реальних прикладах комунікації в IT' ) )
				                   ->set_rows( 4 ),

			              ) ),
			         /**
			          * Блок "Вчителі"
			          */
			         Field::make( 'text', 'solid_block_3_teachers_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_3_teachers_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#FEFEFE', '#F1FBFD' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),

			         Field::make( 'text', 'solid_block_3_teachers_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Наша методологія та професійні вчителі: ключ до успішного вивчення англійської' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_3_teachers_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Тіччери з досвідом та міжнародними сертифікатами CELTA, TESOL, TKT, IELTS, CAE привносять унікальність у наш підхід до навчання. Вони не тільки жили за кордоном та спілкувалися з носіями мови, а й постійно вдосконалюють свої навички на тренінгах, семінарах та конференціях.' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_3_teachers_slogan'.carbon_lang_prefix(), 'Слоган'  )
			              ->set_attribute( 'placeholder', __( 'Для нас навчання англійської - це не просто робота, а стиль життя та пристрасть, яку ми з ентузіазмом передаємо нашим студентам.' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),

			         Field::make( 'association', 'solid_block_3_teachers_list'.carbon_lang_prefix(), __( 'Перелік вчителів на курсі' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) )
			              ->set_types( array(
				              array(
					              'type'      => 'post',
					              'post_type' => 'teachers',
				              )
			              ) ),

			         /**
			          * Блок "Пробне заняття"
			          */
			         Field::make( 'text', 'solid_block_3_free_class_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_3_free_class_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_3_free_class_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Спробуй безкоштовне пробне заняття із курсу IT Starter. Отримай унікальну можливість випробувати наше пробне заняття з курсу IT Starter.' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_3_free_class_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Поглибь свої знання в області ІТ та оціни якість нашого навчання.
Розпочни свій шлях до успішної ІТ кар`єри з англомовними проектами вже сьогодні' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_3_free_class_info_blocks'.carbon_lang_prefix(), 'Перелік блоків з інформацією' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Цей курс підійде тобі, якщо ти' ) ),
				              Field::make( 'complex', 'info_items', 'Перелік інформації' )
				                   ->add_fields( array(
					                   Field::make( 'text', 'item_name', 'Текст'  )
					                        ->set_attribute( 'placeholder', __( 'Тільки починаєш кар`єру IT' ) ),
				                   ) )
			              ) ),
			         Field::make( 'text', 'solid_block_3_free_class_form_btn'.carbon_lang_prefix(), 'Текст кнопки у формі'  )
			              ->set_attribute( 'placeholder', __( 'Пробне заняття' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),

			         /**
			          * Блок "Інфографіка"
			          */
			         Field::make( 'text', 'solid_block_3_infographics_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_3_infographics_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_3_infographics_list_title'.carbon_lang_prefix(), 'Назва переліку'  )
			              ->set_attribute( 'placeholder', __( 'Переваги навчання у Solid ES' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_3_infographics_items_list'.carbon_lang_prefix(), 'Перелік інфографіки' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'infographics_item_text', 'Значення'  )
				                   ->set_attribute('type', 'number')
				                   ->set_attribute( 'placeholder', __( '5' ) ),
				              Field::make( 'text', 'infographics_item_symbol', 'Додатковий символ'  )
				                   ->set_attribute( 'placeholder', __( '+' ) ),
				              Field::make( 'text', 'infographics_item_description', 'Опис'  )
				                   ->set_attribute( 'placeholder', __( 'років досвіду' ) ),
			              ) ),

			         Field::make( 'complex', 'solid_block_3_infographics_list'.carbon_lang_prefix(), 'Перелік' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'list_item', 'Текст'  )
				                   ->set_attribute( 'placeholder', __( 'Профільна технічна англійська' ) ),
			              ) ),

			         Field::make( 'image', 'solid_block_3_infographics_image'.carbon_lang_prefix(), 'Зображення' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_value_type( 'url' ),

			         Field::make( 'text', 'solid_block_3_infographics_position'.carbon_lang_prefix(), 'Посада'  )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_attribute( 'placeholder', __( 'CEO Solid Es' ) ),

			         Field::make( 'text', 'solid_block_3_infographics_person_name'.carbon_lang_prefix(), 'Іʼмя'  )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_attribute( 'placeholder', __( 'Анастасія Машталяр' ) ),

			         /**
			          * Блок "Теми курсу"
			          */
			         Field::make( 'text', 'solid_block_3_course_topics_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_3_course_topics_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEF3ED', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_3_course_topics_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( '24 теми уроків курсу "IT Starter" зосереджені на спеціалізованій тематиці ІТ' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_3_course_topics_list'.carbon_lang_prefix(), 'Перелік' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'list_item', 'Текст'  )
				                   ->set_attribute( 'placeholder', __( 'Problem-solving' ) ),
			              ) ),

			         /**
			          * Блок "Призов пройти опитування"
			          */
			         Field::make( 'text', 'solid_block_3_call_quiz_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_3_call_quiz_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_3_call_quiz_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Не можеш визначитись з програмою навчання? ' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_3_call_quiz_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Пройди безкоштовне тестування рівня англійської мови та отримай індивідуальні рекомендації щодо найкращого курсу' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         /*Field::make( 'text', 'solid_block_3_call_quiz_call_btn'.carbon_lang_prefix(), 'Текст заклику натиснути кнопку'  )
			              ->set_attribute( 'placeholder', __( 'Пройти онлайн тестування
та отримати індивідуальні рекомендації' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),*/
			         Field::make( 'text', 'solid_block_3_call_quiz_btn_text'.carbon_lang_prefix(), 'Текст кнопки'  )
			              ->set_attribute( 'placeholder', __( 'Пройти тест' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_3_call_quiz_btn_link'.carbon_lang_prefix(), 'Посилання у кнопку'  )
			              ->set_attribute( 'placeholder', __( 'https://solid.com.ua/' ) )
			              ->set_attribute( 'type', 'url' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'image', 'solid_block_3_call_quiz_block_image'.carbon_lang_prefix(), 'Зображення' )
			              ->set_value_type( 'url' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         /**
			          * Блок "Відгуки"
			          */
			         Field::make( 'text', 'solid_block_3_reviews_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_3_reviews_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#00C3EB', '#40439D', '#FFB28B' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_3_reviews_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Відгуки про Курси англійської для IT' ) )
				            ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt&lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_3_reviews_pre_rev_text'.carbon_lang_prefix(), 'Текст'  )
			              ->set_attribute( 'placeholder', __( 'Думки наших студентів:' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_3_reviews_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Дізнайся, як наші програми допомогли їм покращити рівень англійської, отримати нові можливості та розширити свої професійні горизонти.' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         /**
			          * Блок "Контакти"
			          */
			         Field::make( 'text', 'solid_block_3_contacts_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_3_contacts_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_3_contacts_form_title'.carbon_lang_prefix(), 'Заголовок форми'  )
			              ->set_attribute( 'placeholder', __( 'Залишились питання, залишайте заявку на безкоштовну консультацію' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_3_contacts_form_btn_text'.carbon_lang_prefix(), 'Текст кнопки у формі'  )
			              ->set_attribute( 'placeholder', __( 'Замовити консультацію' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_3_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),

		         ));
//Block 4

		Container::make( 'post_meta', 'Блок № 4' )
		         ->where( function( $homeFields ) {
			         $homeFields->where( 'post_type', '=', 'page' );
			         $homeFields->where( 'post_template', '=', 'template-course.php' );
		         } )

		         ->add_fields( array(
			         Field::make( 'radio', 'solid_block_4_question'.carbon_lang_prefix(), __('Оберіть який блок відображати') )
			              ->set_options( array(
				              'course_info' => __('Блок "Інформація про курс"'),
				              'teachers' => __('Блок "Вчителі"'),
				              'free_class' => __('Блок "Пробне заняття"'),
				              'infographics' => __('Блок "Інфографіка"'),
				              'course_topics' => __('Блок "Теми курс"'),
				              'call' => __('Блок "Призив до дії"'),
				              'reviews' => __('Блок "Відгуки"'),
				              'contacts' => __('Блок "Контакти"'),
				              'off' => __('Вимкнути'),

			              ) ),
			         /**
			          * Блок "Інформація про курс"
			          */
			         Field::make( 'text', 'solid_block_4_course_info_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_4_course_info_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F1FBFD', '#F4FEFC', '#FEF3ED' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_4_course_info_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Курс англійської IT STARTER' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt &lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_4_course_info_about'.carbon_lang_prefix(), 'Перелік інформаціїних блоків про курс (Звичайні)' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Кількість занятть у курсі' ) ),
				              Field::make( 'text', 'info_value', 'Значення'  )
				                   ->set_attribute( 'placeholder', __( '24' ) ),
			              ) ),
			         Field::make( 'complex', 'solid_block_4_course_info_about_hlight'.carbon_lang_prefix(), 'Перелік інформаціїних блоків про курс (Виділені)' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Кількість занятть у курсі' ) ),
				              Field::make( 'text', 'info_value', 'Значення'  )
				                   ->set_attribute( 'placeholder', __( '24' ) ),
			              ) ),
			         Field::make( 'text', 'solid_block_4_course_info_sub_title'.carbon_lang_prefix(), 'Підзаголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Зміцни навички та отримай переваги разом з Solid' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt &lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_4_course_info_advantages'.carbon_lang_prefix(), 'Перелік переваг' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'advantage_icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'advantage_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( '24 онлайн заняття' ) ),
				              Field::make( 'textarea', 'advantage_description', 'Оптс'  )
				                   ->set_attribute( 'placeholder', __( 'На уроках ти будеш вивчати IT лексику та граматику на реальних прикладах комунікації в IT' ) )
				                   ->set_rows( 4 ),

			              ) ),
			         /**
			          * Блок "Вчителі"
			          */
			         Field::make( 'text', 'solid_block_4_teachers_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_4_teachers_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#FEFEFE', '#F1FBFD' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),

			         Field::make( 'text', 'solid_block_4_teachers_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Наша методологія та професійні вчителі: ключ до успішного вивчення англійської' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_4_teachers_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Тіччери з досвідом та міжнародними сертифікатами CELTA, TESOL, TKT, IELTS, CAE привносять унікальність у наш підхід до навчання. Вони не тільки жили за кордоном та спілкувалися з носіями мови, а й постійно вдосконалюють свої навички на тренінгах, семінарах та конференціях.' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_4_teachers_slogan'.carbon_lang_prefix(), 'Слоган'  )
			              ->set_attribute( 'placeholder', __( 'Для нас навчання англійської - це не просто робота, а стиль життя та пристрасть, яку ми з ентузіазмом передаємо нашим студентам.' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),

			         Field::make( 'association', 'solid_block_4_teachers_list'.carbon_lang_prefix(), __( 'Перелік вчителів на курсі' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) )
			              ->set_types( array(
				              array(
					              'type'      => 'post',
					              'post_type' => 'teachers',
				              )
			              ) ),

			         /**
			          * Блок "Пробне заняття"
			          */
			         Field::make( 'text', 'solid_block_4_free_class_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_4_free_class_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_4_free_class_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Спробуй безкоштовне пробне заняття із курсу IT Starter. Отримай унікальну можливість випробувати наше пробне заняття з курсу IT Starter.' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_4_free_class_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Поглибь свої знання в області ІТ та оціни якість нашого навчання.
Розпочни свій шлях до успішної ІТ кар`єри з англомовними проектами вже сьогодні' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_4_free_class_info_blocks'.carbon_lang_prefix(), 'Перелік блоків з інформацією' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Цей курс підійде тобі, якщо ти' ) ),
				              Field::make( 'complex', 'info_items', 'Перелік інформації' )
				                   ->add_fields( array(
					                   Field::make( 'text', 'item_name', 'Текст'  )
					                        ->set_attribute( 'placeholder', __( 'Тільки починаєш кар`єру IT' ) ),
				                   ) )
			              ) ),
			         Field::make( 'text', 'solid_block_4_free_class_form_btn'.carbon_lang_prefix(), 'Текст кнопки у формі'  )
			              ->set_attribute( 'placeholder', __( 'Пробне заняття' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),

			         /**
			          * Блок "Інфографіка"
			          */
			         Field::make( 'text', 'solid_block_4_infographics_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_4_infographics_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_4_infographics_list_title'.carbon_lang_prefix(), 'Назва переліку'  )
			              ->set_attribute( 'placeholder', __( 'Переваги навчання у Solid ES' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_4_infographics_items_list'.carbon_lang_prefix(), 'Перелік інфографіки' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'infographics_item_text', 'Значення'  )
				                   ->set_attribute('type', 'number')
				                   ->set_attribute( 'placeholder', __( '5' ) ),
				              Field::make( 'text', 'infographics_item_symbol', 'Додатковий символ'  )
				                   ->set_attribute( 'placeholder', __( '+' ) ),
				              Field::make( 'text', 'infographics_item_description', 'Опис'  )
				                   ->set_attribute( 'placeholder', __( 'років досвіду' ) ),
			              ) ),

			         Field::make( 'complex', 'solid_block_4_infographics_list'.carbon_lang_prefix(), 'Перелік' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'list_item', 'Текст'  )
				                   ->set_attribute( 'placeholder', __( 'Профільна технічна англійська' ) ),
			              ) ),

			         Field::make( 'image', 'solid_block_4_infographics_image'.carbon_lang_prefix(), 'Зображення' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_value_type( 'url' ),

			         Field::make( 'text', 'solid_block_4_infographics_position'.carbon_lang_prefix(), 'Посада'  )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_attribute( 'placeholder', __( 'CEO Solid Es' ) ),

			         Field::make( 'text', 'solid_block_4_infographics_person_name'.carbon_lang_prefix(), 'Іʼмя'  )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_attribute( 'placeholder', __( 'Анастасія Машталяр' ) ),

			         /**
			          * Блок "Теми курсу"
			          */
			         Field::make( 'text', 'solid_block_4_course_topics_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_4_course_topics_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEF3ED', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_4_course_topics_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( '24 теми уроків курсу "IT Starter" зосереджені на спеціалізованій тематиці ІТ' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_4_course_topics_list'.carbon_lang_prefix(), 'Перелік' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'list_item', 'Текст'  )
				                   ->set_attribute( 'placeholder', __( 'Problem-solving' ) ),
			              ) ),

			         /**
			          * Блок "Призов пройти опитування"
			          */
			         Field::make( 'text', 'solid_block_4_call_quiz_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_4_call_quiz_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_4_call_quiz_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Не можеш визначитись з програмою навчання? ' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_4_call_quiz_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Пройди безкоштовне тестування рівня англійської мови та отримай індивідуальні рекомендації щодо найкращого курсу' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         /*Field::make( 'text', 'solid_block_4_call_quiz_call_btn'.carbon_lang_prefix(), 'Текст заклику натиснути кнопку'  )
			              ->set_attribute( 'placeholder', __( 'Пройти онлайн тестування
та отримати індивідуальні рекомендації' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),*/
			         Field::make( 'text', 'solid_block_4_call_quiz_btn_text'.carbon_lang_prefix(), 'Текст кнопки'  )
			              ->set_attribute( 'placeholder', __( 'Пройти тест' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_4_call_quiz_btn_link'.carbon_lang_prefix(), 'Посилання у кнопку'  )
			              ->set_attribute( 'placeholder', __( 'https://solid.com.ua/' ) )
			              ->set_attribute( 'type', 'url' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'image', 'solid_block_4_call_quiz_block_image'.carbon_lang_prefix(), 'Зображення' )
			              ->set_value_type( 'url' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         /**
			          * Блок "Відгуки"
			          */
			         Field::make( 'text', 'solid_block_4_reviews_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_4_reviews_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#00C3EB', '#40439D', '#FFB28B' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_4_reviews_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Відгуки про Курси англійської для IT' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt&lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_4_reviews_pre_rev_text'.carbon_lang_prefix(), 'Текст'  )
			              ->set_attribute( 'placeholder', __( 'Думки наших студентів:' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_4_reviews_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Дізнайся, як наші програми допомогли їм покращити рівень англійської, отримати нові можливості та розширити свої професійні горизонти.' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         /**
			          * Блок "Контакти"
			          */
			         Field::make( 'text', 'solid_block_4_contacts_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_4_contacts_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_4_contacts_form_title'.carbon_lang_prefix(), 'Заголовок форми'  )
			              ->set_attribute( 'placeholder', __( 'Залишились питання, залишайте заявку на безкоштовну консультацію' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_4_contacts_form_btn_text'.carbon_lang_prefix(), 'Текст кнопки у формі'  )
			              ->set_attribute( 'placeholder', __( 'Замовити консультацію' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_4_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),

		         ));


//Block 5
		Container::make( 'post_meta', 'Блок № 5' )
		         ->where( function( $homeFields ) {
			         $homeFields->where( 'post_type', '=', 'page' );
			         $homeFields->where( 'post_template', '=', 'template-course.php' );
		         } )

		         ->add_fields( array(
			         Field::make( 'radio', 'solid_block_5_question'.carbon_lang_prefix(), __('Оберіть який блок відображати') )
			              ->set_options( array(
				              'course_info' => __('Блок "Інформація про курс"'),
				              'teachers' => __('Блок "Вчителі"'),
				              'free_class' => __('Блок "Пробне заняття"'),
				              'infographics' => __('Блок "Інфографіка"'),
				              'course_topics' => __('Блок "Теми курс"'),
				              'call' => __('Блок "Призив до дії"'),
				              'reviews' => __('Блок "Відгуки"'),
				              'contacts' => __('Блок "Контакти"'),
				              'off' => __('Вимкнути'),

			              ) ),
			         /**
			          * Блок "Інформація про курс"
			          */
			         Field::make( 'text', 'solid_block_5_course_info_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_5_course_info_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F1FBFD', '#F4FEFC', '#FEF3ED' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_5_course_info_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Курс англійської IT STARTER' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt &lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_5_course_info_about'.carbon_lang_prefix(), 'Перелік інформаціїних блоків про курс (Звичайні)' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Кількість занятть у курсі' ) ),
				              Field::make( 'text', 'info_value', 'Значення'  )
				                   ->set_attribute( 'placeholder', __( '24' ) ),
			              ) ),
			         Field::make( 'complex', 'solid_block_5_course_info_about_hlight'.carbon_lang_prefix(), 'Перелік інформаціїних блоків про курс (Виділені)' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Кількість занятть у курсі' ) ),
				              Field::make( 'text', 'info_value', 'Значення'  )
				                   ->set_attribute( 'placeholder', __( '24' ) ),
			              ) ),
			         Field::make( 'text', 'solid_block_5_course_info_sub_title'.carbon_lang_prefix(), 'Підзаголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Зміцни навички та отримай переваги разом з Solid' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt &lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_5_course_info_advantages'.carbon_lang_prefix(), 'Перелік переваг' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'advantage_icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'advantage_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( '24 онлайн заняття' ) ),
				              Field::make( 'textarea', 'advantage_description', 'Оптс'  )
				                   ->set_attribute( 'placeholder', __( 'На уроках ти будеш вивчати IT лексику та граматику на реальних прикладах комунікації в IT' ) )
				                   ->set_rows( 4 ),

			              ) ),
			         /**
			          * Блок "Вчителі"
			          */
			         Field::make( 'text', 'solid_block_5_teachers_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_5_teachers_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#FEFEFE', '#F1FBFD' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),

			         Field::make( 'text', 'solid_block_5_teachers_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Наша методологія та професійні вчителі: ключ до успішного вивчення англійської' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_5_teachers_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Тіччери з досвідом та міжнародними сертифікатами CELTA, TESOL, TKT, IELTS, CAE привносять унікальність у наш підхід до навчання. Вони не тільки жили за кордоном та спілкувалися з носіями мови, а й постійно вдосконалюють свої навички на тренінгах, семінарах та конференціях.' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_5_teachers_slogan'.carbon_lang_prefix(), 'Слоган'  )
			              ->set_attribute( 'placeholder', __( 'Для нас навчання англійської - це не просто робота, а стиль життя та пристрасть, яку ми з ентузіазмом передаємо нашим студентам.' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),

			         Field::make( 'association', 'solid_block_5_teachers_list'.carbon_lang_prefix(), __( 'Перелік вчителів на курсі' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) )
			              ->set_types( array(
				              array(
					              'type'      => 'post',
					              'post_type' => 'teachers',
				              )
			              ) ),

			         /**
			          * Блок "Пробне заняття"
			          */
			         Field::make( 'text', 'solid_block_5_free_class_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_5_free_class_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_5_free_class_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Спробуй безкоштовне пробне заняття із курсу IT Starter. Отримай унікальну можливість випробувати наше пробне заняття з курсу IT Starter.' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_5_free_class_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Поглибь свої знання в області ІТ та оціни якість нашого навчання.
Розпочни свій шлях до успішної ІТ кар`єри з англомовними проектами вже сьогодні' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_5_free_class_info_blocks'.carbon_lang_prefix(), 'Перелік блоків з інформацією' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Цей курс підійде тобі, якщо ти' ) ),
				              Field::make( 'complex', 'info_items', 'Перелік інформації' )
				                   ->add_fields( array(
					                   Field::make( 'text', 'item_name', 'Текст'  )
					                        ->set_attribute( 'placeholder', __( 'Тільки починаєш кар`єру IT' ) ),
				                   ) )
			              ) ),
			         Field::make( 'text', 'solid_block_5_free_class_form_btn'.carbon_lang_prefix(), 'Текст кнопки у формі'  )
			              ->set_attribute( 'placeholder', __( 'Пробне заняття' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),

			         /**
			          * Блок "Інфографіка"
			          */
			         Field::make( 'text', 'solid_block_5_infographics_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_5_infographics_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_5_infographics_list_title'.carbon_lang_prefix(), 'Назва переліку'  )
			              ->set_attribute( 'placeholder', __( 'Переваги навчання у Solid ES' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_5_infographics_items_list'.carbon_lang_prefix(), 'Перелік інфографіки' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'infographics_item_text', 'Значення'  )
				                   ->set_attribute('type', 'number')
				                   ->set_attribute( 'placeholder', __( '5' ) ),
				              Field::make( 'text', 'infographics_item_symbol', 'Додатковий символ'  )
				                   ->set_attribute( 'placeholder', __( '+' ) ),
				              Field::make( 'text', 'infographics_item_description', 'Опис'  )
				                   ->set_attribute( 'placeholder', __( 'років досвіду' ) ),
			              ) ),

			         Field::make( 'complex', 'solid_block_5_infographics_list'.carbon_lang_prefix(), 'Перелік' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'list_item', 'Текст'  )
				                   ->set_attribute( 'placeholder', __( 'Профільна технічна англійська' ) ),
			              ) ),

			         Field::make( 'image', 'solid_block_5_infographics_image'.carbon_lang_prefix(), 'Зображення' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_value_type( 'url' ),

			         Field::make( 'text', 'solid_block_5_infographics_position'.carbon_lang_prefix(), 'Посада'  )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_attribute( 'placeholder', __( 'CEO Solid Es' ) ),

			         Field::make( 'text', 'solid_block_5_infographics_person_name'.carbon_lang_prefix(), 'Іʼмя'  )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_attribute( 'placeholder', __( 'Анастасія Машталяр' ) ),

			         /**
			          * Блок "Теми курсу"
			          */
			         Field::make( 'text', 'solid_block_5_course_topics_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_5_course_topics_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEF3ED', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_5_course_topics_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( '24 теми уроків курсу "IT Starter" зосереджені на спеціалізованій тематиці ІТ' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_5_course_topics_list'.carbon_lang_prefix(), 'Перелік' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'list_item', 'Текст'  )
				                   ->set_attribute( 'placeholder', __( 'Problem-solving' ) ),
			              ) ),

			         /**
			          * Блок "Призов пройти опитування"
			          */
			         Field::make( 'text', 'solid_block_5_call_quiz_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_5_call_quiz_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_5_call_quiz_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Не можеш визначитись з програмою навчання? ' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_5_call_quiz_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Пройди безкоштовне тестування рівня англійської мови та отримай індивідуальні рекомендації щодо найкращого курсу' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         /*Field::make( 'text', 'solid_block_5_call_quiz_call_btn'.carbon_lang_prefix(), 'Текст заклику натиснути кнопку'  )
			              ->set_attribute( 'placeholder', __( 'Пройти онлайн тестування
та отримати індивідуальні рекомендації' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),*/
			         Field::make( 'text', 'solid_block_5_call_quiz_btn_text'.carbon_lang_prefix(), 'Текст кнопки'  )
			              ->set_attribute( 'placeholder', __( 'Пройти тест' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_5_call_quiz_btn_link'.carbon_lang_prefix(), 'Посилання у кнопку'  )
			              ->set_attribute( 'placeholder', __( 'https://solid.com.ua/' ) )
			              ->set_attribute( 'type', 'url' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'image', 'solid_block_5_call_quiz_block_image'.carbon_lang_prefix(), 'Зображення' )
			              ->set_value_type( 'url' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         /**
			          * Блок "Відгуки"
			          */
			         Field::make( 'text', 'solid_block_5_reviews_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_5_reviews_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#00C3EB', '#40439D', '#FFB28B' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_5_reviews_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Відгуки про Курси англійської для IT' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt&lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_5_reviews_pre_rev_text'.carbon_lang_prefix(), 'Текст'  )
			              ->set_attribute( 'placeholder', __( 'Думки наших студентів:' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_5_reviews_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Дізнайся, як наші програми допомогли їм покращити рівень англійської, отримати нові можливості та розширити свої професійні горизонти.' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         /**
			          * Блок "Контакти"
			          */
			         Field::make( 'text', 'solid_block_5_contacts_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_5_contacts_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_5_contacts_form_title'.carbon_lang_prefix(), 'Заголовок форми'  )
			              ->set_attribute( 'placeholder', __( 'Залишились питання, залишайте заявку на безкоштовну консультацію' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_5_contacts_form_btn_text'.carbon_lang_prefix(), 'Текст кнопки у формі'  )
			              ->set_attribute( 'placeholder', __( 'Замовити консультацію' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_5_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),

		         ));

		//Block 6
		Container::make( 'post_meta', 'Блок № 6' )
		         ->where( function( $homeFields ) {
			         $homeFields->where( 'post_type', '=', 'page' );
			         $homeFields->where( 'post_template', '=', 'template-course.php' );
		         } )

		         ->add_fields( array(
			         Field::make( 'radio', 'solid_block_6_question'.carbon_lang_prefix(), __('Оберіть який блок відображати') )
			              ->set_options( array(
				              'course_info' => __('Блок "Інформація про курс"'),
				              'teachers' => __('Блок "Вчителі"'),
				              'free_class' => __('Блок "Пробне заняття"'),
				              'infographics' => __('Блок "Інфографіка"'),
				              'course_topics' => __('Блок "Теми курс"'),
				              'call' => __('Блок "Призив до дії"'),
				              'reviews' => __('Блок "Відгуки"'),
				              'contacts' => __('Блок "Контакти"'),
				              'off' => __('Вимкнути'),

			              ) ),
			         /**
			          * Блок "Інформація про курс"
			          */
			         Field::make( 'text', 'solid_block_6_course_info_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_6_course_info_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F1FBFD', '#F4FEFC', '#FEF3ED' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_6_course_info_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Курс англійської IT STARTER' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt &lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_6_course_info_about'.carbon_lang_prefix(), 'Перелік інформаціїних блоків про курс (Звичайні)' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Кількість занятть у курсі' ) ),
				              Field::make( 'text', 'info_value', 'Значення'  )
				                   ->set_attribute( 'placeholder', __( '24' ) ),
			              ) ),
			         Field::make( 'complex', 'solid_block_6_course_info_about_hlight'.carbon_lang_prefix(), 'Перелік інформаціїних блоків про курс (Виділені)' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Кількість занятть у курсі' ) ),
				              Field::make( 'text', 'info_value', 'Значення'  )
				                   ->set_attribute( 'placeholder', __( '24' ) ),
			              ) ),
			         Field::make( 'text', 'solid_block_6_course_info_sub_title'.carbon_lang_prefix(), 'Підзаголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Зміцни навички та отримай переваги разом з Solid' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt &lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_6_course_info_advantages'.carbon_lang_prefix(), 'Перелік переваг' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'advantage_icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'advantage_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( '24 онлайн заняття' ) ),
				              Field::make( 'textarea', 'advantage_description', 'Оптс'  )
				                   ->set_attribute( 'placeholder', __( 'На уроках ти будеш вивчати IT лексику та граматику на реальних прикладах комунікації в IT' ) )
				                   ->set_rows( 4 ),

			              ) ),
			         /**
			          * Блок "Вчителі"
			          */
			         Field::make( 'text', 'solid_block_6_teachers_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_6_teachers_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#FEFEFE', '#F1FBFD' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),

			         Field::make( 'text', 'solid_block_6_teachers_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Наша методологія та професійні вчителі: ключ до успішного вивчення англійської' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_6_teachers_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Тіччери з досвідом та міжнародними сертифікатами CELTA, TESOL, TKT, IELTS, CAE привносять унікальність у наш підхід до навчання. Вони не тільки жили за кордоном та спілкувалися з носіями мови, а й постійно вдосконалюють свої навички на тренінгах, семінарах та конференціях.' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_6_teachers_slogan'.carbon_lang_prefix(), 'Слоган'  )
			              ->set_attribute( 'placeholder', __( 'Для нас навчання англійської - це не просто робота, а стиль життя та пристрасть, яку ми з ентузіазмом передаємо нашим студентам.' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),

			         Field::make( 'association', 'solid_block_6_teachers_list'.carbon_lang_prefix(), __( 'Перелік вчителів на курсі' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) )
			              ->set_types( array(
				              array(
					              'type'      => 'post',
					              'post_type' => 'teachers',
				              )
			              ) ),

			         /**
			          * Блок "Пробне заняття"
			          */
			         Field::make( 'text', 'solid_block_6_free_class_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_6_free_class_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_6_free_class_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Спробуй безкоштовне пробне заняття із курсу IT Starter. Отримай унікальну можливість випробувати наше пробне заняття з курсу IT Starter.' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_6_free_class_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Поглибь свої знання в області ІТ та оціни якість нашого навчання.
Розпочни свій шлях до успішної ІТ кар`єри з англомовними проектами вже сьогодні' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_6_free_class_info_blocks'.carbon_lang_prefix(), 'Перелік блоків з інформацією' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Цей курс підійде тобі, якщо ти' ) ),
				              Field::make( 'complex', 'info_items', 'Перелік інформації' )
				                   ->add_fields( array(
					                   Field::make( 'text', 'item_name', 'Текст'  )
					                        ->set_attribute( 'placeholder', __( 'Тільки починаєш кар`єру IT' ) ),
				                   ) )
			              ) ),
			         Field::make( 'text', 'solid_block_6_free_class_form_btn'.carbon_lang_prefix(), 'Текст кнопки у формі'  )
			              ->set_attribute( 'placeholder', __( 'Пробне заняття' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),

			         /**
			          * Блок "Інфографіка"
			          */
			         Field::make( 'text', 'solid_block_6_infographics_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_6_infographics_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_6_infographics_list_title'.carbon_lang_prefix(), 'Назва переліку'  )
			              ->set_attribute( 'placeholder', __( 'Переваги навчання у Solid ES' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_6_infographics_items_list'.carbon_lang_prefix(), 'Перелік інфографіки' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'infographics_item_text', 'Значення'  )
				                   ->set_attribute('type', 'number')
				                   ->set_attribute( 'placeholder', __( '5' ) ),
				              Field::make( 'text', 'infographics_item_symbol', 'Додатковий символ'  )
				                   ->set_attribute( 'placeholder', __( '+' ) ),
				              Field::make( 'text', 'infographics_item_description', 'Опис'  )
				                   ->set_attribute( 'placeholder', __( 'років досвіду' ) ),
			              ) ),

			         Field::make( 'complex', 'solid_block_6_infographics_list'.carbon_lang_prefix(), 'Перелік' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'list_item', 'Текст'  )
				                   ->set_attribute( 'placeholder', __( 'Профільна технічна англійська' ) ),
			              ) ),

			         Field::make( 'image', 'solid_block_6_infographics_image'.carbon_lang_prefix(), 'Зображення' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_value_type( 'url' ),

			         Field::make( 'text', 'solid_block_6_infographics_position'.carbon_lang_prefix(), 'Посада'  )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_attribute( 'placeholder', __( 'CEO Solid Es' ) ),

			         Field::make( 'text', 'solid_block_6_infographics_person_name'.carbon_lang_prefix(), 'Іʼмя'  )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_attribute( 'placeholder', __( 'Анастасія Машталяр' ) ),

			         /**
			          * Блок "Теми курсу"
			          */
			         Field::make( 'text', 'solid_block_6_course_topics_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_6_course_topics_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEF3ED', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_6_course_topics_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( '24 теми уроків курсу "IT Starter" зосереджені на спеціалізованій тематиці ІТ' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_6_course_topics_list'.carbon_lang_prefix(), 'Перелік' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'list_item', 'Текст'  )
				                   ->set_attribute( 'placeholder', __( 'Problem-solving' ) ),
			              ) ),

			         /**
			          * Блок "Призов пройти опитування"
			          */
			         Field::make( 'text', 'solid_block_6_call_quiz_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_6_call_quiz_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_6_call_quiz_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Не можеш визначитись з програмою навчання? ' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_6_call_quiz_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Пройди безкоштовне тестування рівня англійської мови та отримай індивідуальні рекомендації щодо найкращого курсу' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         /*Field::make( 'text', 'solid_block_6_call_quiz_call_btn'.carbon_lang_prefix(), 'Текст заклику натиснути кнопку'  )
			              ->set_attribute( 'placeholder', __( 'Пройти онлайн тестування
та отримати індивідуальні рекомендації' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),*/
			         Field::make( 'text', 'solid_block_6_call_quiz_btn_text'.carbon_lang_prefix(), 'Текст кнопки'  )
			              ->set_attribute( 'placeholder', __( 'Пройти тест' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_6_call_quiz_btn_link'.carbon_lang_prefix(), 'Посилання у кнопку'  )
			              ->set_attribute( 'placeholder', __( 'https://solid.com.ua/' ) )
			              ->set_attribute( 'type', 'url' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'image', 'solid_block_6_call_quiz_block_image'.carbon_lang_prefix(), 'Зображення' )
			              ->set_value_type( 'url' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         /**
			          * Блок "Відгуки"
			          */
			         Field::make( 'text', 'solid_block_6_reviews_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_6_reviews_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#00C3EB', '#40439D', '#FFB28B' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_6_reviews_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Відгуки про Курси англійської для IT' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt&lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_6_reviews_pre_rev_text'.carbon_lang_prefix(), 'Текст'  )
			              ->set_attribute( 'placeholder', __( 'Думки наших студентів:' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_6_reviews_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Дізнайся, як наші програми допомогли їм покращити рівень англійської, отримати нові можливості та розширити свої професійні горизонти.' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         /**
			          * Блок "Контакти"
			          */
			         Field::make( 'text', 'solid_block_6_contacts_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_6_contacts_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_6_contacts_form_title'.carbon_lang_prefix(), 'Заголовок форми'  )
			              ->set_attribute( 'placeholder', __( 'Залишились питання, залишайте заявку на безкоштовну консультацію' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_6_contacts_form_btn_text'.carbon_lang_prefix(), 'Текст кнопки у формі'  )
			              ->set_attribute( 'placeholder', __( 'Замовити консультацію' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_6_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),

		         ));
		//Block 7
		Container::make( 'post_meta', 'Блок № 7' )
		         ->where( function( $homeFields ) {
			         $homeFields->where( 'post_type', '=', 'page' );
			         $homeFields->where( 'post_template', '=', 'template-course.php' );
		         } )

		         ->add_fields( array(
			         Field::make( 'radio', 'solid_block_7_question'.carbon_lang_prefix(), __('Оберіть який блок відображати') )
			              ->set_options( array(
				              'course_info' => __('Блок "Інформація про курс"'),
				              'teachers' => __('Блок "Вчителі"'),
				              'free_class' => __('Блок "Пробне заняття"'),
				              'infographics' => __('Блок "Інфографіка"'),
				              'course_topics' => __('Блок "Теми курс"'),
				              'call' => __('Блок "Призив до дії"'),
				              'reviews' => __('Блок "Відгуки"'),
				              'contacts' => __('Блок "Контакти"'),
				              'off' => __('Вимкнути'),

			              ) ),
			         /**
			          * Блок "Інформація про курс"
			          */
			         Field::make( 'text', 'solid_block_7_course_info_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_7_course_info_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F1FBFD', '#F4FEFC', '#FEF3ED' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_7_course_info_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Курс англійської IT STARTER' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt &lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_7_course_info_about'.carbon_lang_prefix(), 'Перелік інформаціїних блоків про курс (Звичайні)' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Кількість занятть у курсі' ) ),
				              Field::make( 'text', 'info_value', 'Значення'  )
				                   ->set_attribute( 'placeholder', __( '24' ) ),
			              ) ),
			         Field::make( 'complex', 'solid_block_7_course_info_about_hlight'.carbon_lang_prefix(), 'Перелік інформаціїних блоків про курс (Виділені)' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Кількість занятть у курсі' ) ),
				              Field::make( 'text', 'info_value', 'Значення'  )
				                   ->set_attribute( 'placeholder', __( '24' ) ),
			              ) ),
			         Field::make( 'text', 'solid_block_7_course_info_sub_title'.carbon_lang_prefix(), 'Підзаголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Зміцни навички та отримай переваги разом з Solid' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt &lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_7_course_info_advantages'.carbon_lang_prefix(), 'Перелік переваг' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'advantage_icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'advantage_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( '24 онлайн заняття' ) ),
				              Field::make( 'textarea', 'advantage_description', 'Оптс'  )
				                   ->set_attribute( 'placeholder', __( 'На уроках ти будеш вивчати IT лексику та граматику на реальних прикладах комунікації в IT' ) )
				                   ->set_rows( 4 ),

			              ) ),
			         /**
			          * Блок "Вчителі"
			          */
			         Field::make( 'text', 'solid_block_7_teachers_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_7_teachers_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#FEFEFE', '#F1FBFD' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),

			         Field::make( 'text', 'solid_block_7_teachers_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Наша методологія та професійні вчителі: ключ до успішного вивчення англійської' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_7_teachers_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Тіччери з досвідом та міжнародними сертифікатами CELTA, TESOL, TKT, IELTS, CAE привносять унікальність у наш підхід до навчання. Вони не тільки жили за кордоном та спілкувалися з носіями мови, а й постійно вдосконалюють свої навички на тренінгах, семінарах та конференціях.' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_7_teachers_slogan'.carbon_lang_prefix(), 'Слоган'  )
			              ->set_attribute( 'placeholder', __( 'Для нас навчання англійської - це не просто робота, а стиль життя та пристрасть, яку ми з ентузіазмом передаємо нашим студентам.' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),

			         Field::make( 'association', 'solid_block_7_teachers_list'.carbon_lang_prefix(), __( 'Перелік вчителів на курсі' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) )
			              ->set_types( array(
				              array(
					              'type'      => 'post',
					              'post_type' => 'teachers',
				              )
			              ) ),

			         /**
			          * Блок "Пробне заняття"
			          */
			         Field::make( 'text', 'solid_block_7_free_class_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_7_free_class_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_7_free_class_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Спробуй безкоштовне пробне заняття із курсу IT Starter. Отримай унікальну можливість випробувати наше пробне заняття з курсу IT Starter.' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_7_free_class_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Поглибь свої знання в області ІТ та оціни якість нашого навчання.
Розпочни свій шлях до успішної ІТ кар`єри з англомовними проектами вже сьогодні' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_7_free_class_info_blocks'.carbon_lang_prefix(), 'Перелік блоків з інформацією' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Цей курс підійде тобі, якщо ти' ) ),
				              Field::make( 'complex', 'info_items', 'Перелік інформації' )
				                   ->add_fields( array(
					                   Field::make( 'text', 'item_name', 'Текст'  )
					                        ->set_attribute( 'placeholder', __( 'Тільки починаєш кар`єру IT' ) ),
				                   ) )
			              ) ),
			         Field::make( 'text', 'solid_block_7_free_class_form_btn'.carbon_lang_prefix(), 'Текст кнопки у формі'  )
			              ->set_attribute( 'placeholder', __( 'Пробне заняття' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),

			         /**
			          * Блок "Інфографіка"
			          */
			         Field::make( 'text', 'solid_block_7_infographics_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_7_infographics_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_7_infographics_list_title'.carbon_lang_prefix(), 'Назва переліку'  )
			              ->set_attribute( 'placeholder', __( 'Переваги навчання у Solid ES' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_7_infographics_items_list'.carbon_lang_prefix(), 'Перелік інфографіки' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'infographics_item_text', 'Значення'  )
				                   ->set_attribute('type', 'number')
				                   ->set_attribute( 'placeholder', __( '5' ) ),
				              Field::make( 'text', 'infographics_item_symbol', 'Додатковий символ'  )
				                   ->set_attribute( 'placeholder', __( '+' ) ),
				              Field::make( 'text', 'infographics_item_description', 'Опис'  )
				                   ->set_attribute( 'placeholder', __( 'років досвіду' ) ),
			              ) ),

			         Field::make( 'complex', 'solid_block_7_infographics_list'.carbon_lang_prefix(), 'Перелік' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'list_item', 'Текст'  )
				                   ->set_attribute( 'placeholder', __( 'Профільна технічна англійська' ) ),
			              ) ),

			         Field::make( 'image', 'solid_block_7_infographics_image'.carbon_lang_prefix(), 'Зображення' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_value_type( 'url' ),

			         Field::make( 'text', 'solid_block_7_infographics_position'.carbon_lang_prefix(), 'Посада'  )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_attribute( 'placeholder', __( 'CEO Solid Es' ) ),

			         Field::make( 'text', 'solid_block_7_infographics_person_name'.carbon_lang_prefix(), 'Іʼмя'  )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_attribute( 'placeholder', __( 'Анастасія Машталяр' ) ),

			         /**
			          * Блок "Теми курсу"
			          */
			         Field::make( 'text', 'solid_block_7_course_topics_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_7_course_topics_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEF3ED', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_7_course_topics_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( '24 теми уроків курсу "IT Starter" зосереджені на спеціалізованій тематиці ІТ' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_7_course_topics_list'.carbon_lang_prefix(), 'Перелік' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'list_item', 'Текст'  )
				                   ->set_attribute( 'placeholder', __( 'Problem-solving' ) ),
			              ) ),

			         /**
			          * Блок "Призов пройти опитування"
			          */
			         Field::make( 'text', 'solid_block_7_call_quiz_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_7_call_quiz_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_7_call_quiz_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Не можеш визначитись з програмою навчання? ' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_7_call_quiz_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Пройди безкоштовне тестування рівня англійської мови та отримай індивідуальні рекомендації щодо найкращого курсу' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         /*Field::make( 'text', 'solid_block_7_call_quiz_call_btn'.carbon_lang_prefix(), 'Текст заклику натиснути кнопку'  )
			              ->set_attribute( 'placeholder', __( 'Пройти онлайн тестування
та отримати індивідуальні рекомендації' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),*/
			         Field::make( 'text', 'solid_block_7_call_quiz_btn_text'.carbon_lang_prefix(), 'Текст кнопки'  )
			              ->set_attribute( 'placeholder', __( 'Пройти тест' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_7_call_quiz_btn_link'.carbon_lang_prefix(), 'Посилання у кнопку'  )
			              ->set_attribute( 'placeholder', __( 'https://solid.com.ua/' ) )
			              ->set_attribute( 'type', 'url' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'image', 'solid_block_7_call_quiz_block_image'.carbon_lang_prefix(), 'Зображення' )
			              ->set_value_type( 'url' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         /**
			          * Блок "Відгуки"
			          */
			         Field::make( 'text', 'solid_block_7_reviews_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_7_reviews_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#00C3EB', '#40439D', '#FFB28B' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_7_reviews_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Відгуки про Курси англійської для IT' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt&lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_7_reviews_pre_rev_text'.carbon_lang_prefix(), 'Текст'  )
			              ->set_attribute( 'placeholder', __( 'Думки наших студентів:' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_7_reviews_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Дізнайся, як наші програми допомогли їм покращити рівень англійської, отримати нові можливості та розширити свої професійні горизонти.' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         /**
			          * Блок "Контакти"
			          */
			         Field::make( 'text', 'solid_block_7_contacts_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_7_contacts_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_7_contacts_form_title'.carbon_lang_prefix(), 'Заголовок форми'  )
			              ->set_attribute( 'placeholder', __( 'Залишились питання, залишайте заявку на безкоштовну консультацію' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_7_contacts_form_btn_text'.carbon_lang_prefix(), 'Текст кнопки у формі'  )
			              ->set_attribute( 'placeholder', __( 'Замовити консультацію' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_7_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),

		         ));
		//Block 8
		Container::make( 'post_meta', 'Блок № 8' )
		         ->where( function( $homeFields ) {
			         $homeFields->where( 'post_type', '=', 'page' );
			         $homeFields->where( 'post_template', '=', 'template-course.php' );
		         } )

		         ->add_fields( array(
			         Field::make( 'radio', 'solid_block_8_question'.carbon_lang_prefix(), __('Оберіть який блок відображати') )
			              ->set_options( array(
				              'course_info' => __('Блок "Інформація про курс"'),
				              'teachers' => __('Блок "Вчителі"'),
				              'free_class' => __('Блок "Пробне заняття"'),
				              'infographics' => __('Блок "Інфографіка"'),
				              'course_topics' => __('Блок "Теми курс"'),
				              'call' => __('Блок "Призив до дії"'),
				              'reviews' => __('Блок "Відгуки"'),
				              'contacts' => __('Блок "Контакти"'),
				              'off' => __('Вимкнути'),

			              ) ),
			         /**
			          * Блок "Інформація про курс"
			          */
			         Field::make( 'text', 'solid_block_8_course_info_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_8_course_info_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F1FBFD', '#F4FEFC', '#FEF3ED' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_8_course_info_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Курс англійської IT STARTER' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt &lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_8_course_info_about'.carbon_lang_prefix(), 'Перелік інформаціїних блоків про курс (Звичайні)' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Кількість занятть у курсі' ) ),
				              Field::make( 'text', 'info_value', 'Значення'  )
				                   ->set_attribute( 'placeholder', __( '24' ) ),
			              ) ),
			         Field::make( 'complex', 'solid_block_8_course_info_about_hlight'.carbon_lang_prefix(), 'Перелік інформаціїних блоків про курс (Виділені)' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Кількість занятть у курсі' ) ),
				              Field::make( 'text', 'info_value', 'Значення'  )
				                   ->set_attribute( 'placeholder', __( '24' ) ),
			              ) ),
			         Field::make( 'text', 'solid_block_8_course_info_sub_title'.carbon_lang_prefix(), 'Підзаголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Зміцни навички та отримай переваги разом з Solid' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt &lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_8_course_info_advantages'.carbon_lang_prefix(), 'Перелік переваг' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'advantage_icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'advantage_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( '24 онлайн заняття' ) ),
				              Field::make( 'textarea', 'advantage_description', 'Оптс'  )
				                   ->set_attribute( 'placeholder', __( 'На уроках ти будеш вивчати IT лексику та граматику на реальних прикладах комунікації в IT' ) )
				                   ->set_rows( 4 ),

			              ) ),
			         /**
			          * Блок "Вчителі"
			          */
			         Field::make( 'text', 'solid_block_8_teachers_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_8_teachers_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#FEFEFE', '#F1FBFD' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),

			         Field::make( 'text', 'solid_block_8_teachers_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Наша методологія та професійні вчителі: ключ до успішного вивчення англійської' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_8_teachers_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Тіччери з досвідом та міжнародними сертифікатами CELTA, TESOL, TKT, IELTS, CAE привносять унікальність у наш підхід до навчання. Вони не тільки жили за кордоном та спілкувалися з носіями мови, а й постійно вдосконалюють свої навички на тренінгах, семінарах та конференціях.' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_8_teachers_slogan'.carbon_lang_prefix(), 'Слоган'  )
			              ->set_attribute( 'placeholder', __( 'Для нас навчання англійської - це не просто робота, а стиль життя та пристрасть, яку ми з ентузіазмом передаємо нашим студентам.' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),

			         Field::make( 'association', 'solid_block_8_teachers_list'.carbon_lang_prefix(), __( 'Перелік вчителів на курсі' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) )
			              ->set_types( array(
				              array(
					              'type'      => 'post',
					              'post_type' => 'teachers',
				              )
			              ) ),

			         /**
			          * Блок "Пробне заняття"
			          */
			         Field::make( 'text', 'solid_block_8_free_class_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_8_free_class_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_8_free_class_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Спробуй безкоштовне пробне заняття із курсу IT Starter. Отримай унікальну можливість випробувати наше пробне заняття з курсу IT Starter.' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_8_free_class_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Поглибь свої знання в області ІТ та оціни якість нашого навчання.
Розпочни свій шлях до успішної ІТ кар`єри з англомовними проектами вже сьогодні' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_8_free_class_info_blocks'.carbon_lang_prefix(), 'Перелік блоків з інформацією' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Цей курс підійде тобі, якщо ти' ) ),
				              Field::make( 'complex', 'info_items', 'Перелік інформації' )
				                   ->add_fields( array(
					                   Field::make( 'text', 'item_name', 'Текст'  )
					                        ->set_attribute( 'placeholder', __( 'Тільки починаєш кар`єру IT' ) ),
				                   ) )
			              ) ),
			         Field::make( 'text', 'solid_block_8_free_class_form_btn'.carbon_lang_prefix(), 'Текст кнопки у формі'  )
			              ->set_attribute( 'placeholder', __( 'Пробне заняття' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),

			         /**
			          * Блок "Інфографіка"
			          */
			         Field::make( 'text', 'solid_block_8_infographics_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_8_infographics_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_8_infographics_list_title'.carbon_lang_prefix(), 'Назва переліку'  )
			              ->set_attribute( 'placeholder', __( 'Переваги навчання у Solid ES' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_8_infographics_items_list'.carbon_lang_prefix(), 'Перелік інфографіки' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'infographics_item_text', 'Значення'  )
				                   ->set_attribute('type', 'number')
				                   ->set_attribute( 'placeholder', __( '5' ) ),
				              Field::make( 'text', 'infographics_item_symbol', 'Додатковий символ'  )
				                   ->set_attribute( 'placeholder', __( '+' ) ),
				              Field::make( 'text', 'infographics_item_description', 'Опис'  )
				                   ->set_attribute( 'placeholder', __( 'років досвіду' ) ),
			              ) ),

			         Field::make( 'complex', 'solid_block_8_infographics_list'.carbon_lang_prefix(), 'Перелік' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'list_item', 'Текст'  )
				                   ->set_attribute( 'placeholder', __( 'Профільна технічна англійська' ) ),
			              ) ),

			         Field::make( 'image', 'solid_block_8_infographics_image'.carbon_lang_prefix(), 'Зображення' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_value_type( 'url' ),

			         Field::make( 'text', 'solid_block_8_infographics_position'.carbon_lang_prefix(), 'Посада'  )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_attribute( 'placeholder', __( 'CEO Solid Es' ) ),

			         Field::make( 'text', 'solid_block_8_infographics_person_name'.carbon_lang_prefix(), 'Іʼмя'  )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_attribute( 'placeholder', __( 'Анастасія Машталяр' ) ),

			         /**
			          * Блок "Теми курсу"
			          */
			         Field::make( 'text', 'solid_block_8_course_topics_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_8_course_topics_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEF3ED', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_8_course_topics_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( '24 теми уроків курсу "IT Starter" зосереджені на спеціалізованій тематиці ІТ' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_8_course_topics_list'.carbon_lang_prefix(), 'Перелік' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'list_item', 'Текст'  )
				                   ->set_attribute( 'placeholder', __( 'Problem-solving' ) ),
			              ) ),

			         /**
			          * Блок "Призов пройти опитування"
			          */
			         Field::make( 'text', 'solid_block_8_call_quiz_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_8_call_quiz_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_8_call_quiz_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Не можеш визначитись з програмою навчання? ' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_8_call_quiz_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Пройди безкоштовне тестування рівня англійської мови та отримай індивідуальні рекомендації щодо найкращого курсу' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         /*Field::make( 'text', 'solid_block_8_call_quiz_call_btn'.carbon_lang_prefix(), 'Текст заклику натиснути кнопку'  )
			              ->set_attribute( 'placeholder', __( 'Пройти онлайн тестування
та отримати індивідуальні рекомендації' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),*/
			         Field::make( 'text', 'solid_block_8_call_quiz_btn_text'.carbon_lang_prefix(), 'Текст кнопки'  )
			              ->set_attribute( 'placeholder', __( 'Пройти тест' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_8_call_quiz_btn_link'.carbon_lang_prefix(), 'Посилання у кнопку'  )
			              ->set_attribute( 'placeholder', __( 'https://solid.com.ua/' ) )
			              ->set_attribute( 'type', 'url' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'image', 'solid_block_8_call_quiz_block_image'.carbon_lang_prefix(), 'Зображення' )
			              ->set_value_type( 'url' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         /**
			          * Блок "Відгуки"
			          */
			         Field::make( 'text', 'solid_block_8_reviews_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_8_reviews_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#00C3EB', '#40439D', '#FFB28B' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_8_reviews_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Відгуки про Курси англійської для IT' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt&lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_8_reviews_pre_rev_text'.carbon_lang_prefix(), 'Текст'  )
			              ->set_attribute( 'placeholder', __( 'Думки наших студентів:' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_8_reviews_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Дізнайся, як наші програми допомогли їм покращити рівень англійської, отримати нові можливості та розширити свої професійні горизонти.' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         /**
			          * Блок "Контакти"
			          */
			         Field::make( 'text', 'solid_block_8_contacts_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_8_contacts_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_8_contacts_form_title'.carbon_lang_prefix(), 'Заголовок форми'  )
			              ->set_attribute( 'placeholder', __( 'Залишились питання, залишайте заявку на безкоштовну консультацію' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_8_contacts_form_btn_text'.carbon_lang_prefix(), 'Текст кнопки у формі'  )
			              ->set_attribute( 'placeholder', __( 'Замовити консультацію' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_8_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),

		         ));
		//Block 9
		Container::make( 'post_meta', 'Блок № 9' )
		         ->where( function( $homeFields ) {
			         $homeFields->where( 'post_type', '=', 'page' );
			         $homeFields->where( 'post_template', '=', 'template-course.php' );
		         } )

		         ->add_fields( array(
			         Field::make( 'radio', 'solid_block_9_question'.carbon_lang_prefix(), __('Оберіть який блок відображати') )
			              ->set_options( array(
				              'course_info' => __('Блок "Інформація про курс"'),
				              'teachers' => __('Блок "Вчителі"'),
				              'free_class' => __('Блок "Пробне заняття"'),
				              'infographics' => __('Блок "Інфографіка"'),
				              'course_topics' => __('Блок "Теми курс"'),
				              'call' => __('Блок "Призив до дії"'),
				              'reviews' => __('Блок "Відгуки"'),
				              'contacts' => __('Блок "Контакти"'),
				              'off' => __('Вимкнути'),

			              ) ),
			         /**
			          * Блок "Інформація про курс"
			          */
			         Field::make( 'text', 'solid_block_9_course_info_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_9_course_info_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F1FBFD', '#F4FEFC', '#FEF3ED' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_9_course_info_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Курс англійської IT STARTER' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt &lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_9_course_info_about'.carbon_lang_prefix(), 'Перелік інформаціїних блоків про курс (Звичайні)' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Кількість занятть у курсі' ) ),
				              Field::make( 'text', 'info_value', 'Значення'  )
				                   ->set_attribute( 'placeholder', __( '24' ) ),
			              ) ),
			         Field::make( 'complex', 'solid_block_9_course_info_about_hlight'.carbon_lang_prefix(), 'Перелік інформаціїних блоків про курс (Виділені)' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Кількість занятть у курсі' ) ),
				              Field::make( 'text', 'info_value', 'Значення'  )
				                   ->set_attribute( 'placeholder', __( '24' ) ),
			              ) ),
			         Field::make( 'text', 'solid_block_9_course_info_sub_title'.carbon_lang_prefix(), 'Підзаголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Зміцни навички та отримай переваги разом з Solid' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt &lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_9_course_info_advantages'.carbon_lang_prefix(), 'Перелік переваг' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'advantage_icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'advantage_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( '24 онлайн заняття' ) ),
				              Field::make( 'textarea', 'advantage_description', 'Оптс'  )
				                   ->set_attribute( 'placeholder', __( 'На уроках ти будеш вивчати IT лексику та граматику на реальних прикладах комунікації в IT' ) )
				                   ->set_rows( 4 ),

			              ) ),
			         /**
			          * Блок "Вчителі"
			          */
			         Field::make( 'text', 'solid_block_9_teachers_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_9_teachers_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#FEFEFE', '#F1FBFD' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),

			         Field::make( 'text', 'solid_block_9_teachers_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Наша методологія та професійні вчителі: ключ до успішного вивчення англійської' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_9_teachers_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Тіччери з досвідом та міжнародними сертифікатами CELTA, TESOL, TKT, IELTS, CAE привносять унікальність у наш підхід до навчання. Вони не тільки жили за кордоном та спілкувалися з носіями мови, а й постійно вдосконалюють свої навички на тренінгах, семінарах та конференціях.' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_9_teachers_slogan'.carbon_lang_prefix(), 'Слоган'  )
			              ->set_attribute( 'placeholder', __( 'Для нас навчання англійської - це не просто робота, а стиль життя та пристрасть, яку ми з ентузіазмом передаємо нашим студентам.' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),

			         Field::make( 'association', 'solid_block_9_teachers_list'.carbon_lang_prefix(), __( 'Перелік вчителів на курсі' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) )
			              ->set_types( array(
				              array(
					              'type'      => 'post',
					              'post_type' => 'teachers',
				              )
			              ) ),

			         /**
			          * Блок "Пробне заняття"
			          */
			         Field::make( 'text', 'solid_block_9_free_class_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_9_free_class_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_9_free_class_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Спробуй безкоштовне пробне заняття із курсу IT Starter. Отримай унікальну можливість випробувати наше пробне заняття з курсу IT Starter.' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_9_free_class_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Поглибь свої знання в області ІТ та оціни якість нашого навчання.
Розпочни свій шлях до успішної ІТ кар`єри з англомовними проектами вже сьогодні' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_9_free_class_info_blocks'.carbon_lang_prefix(), 'Перелік блоків з інформацією' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Цей курс підійде тобі, якщо ти' ) ),
				              Field::make( 'complex', 'info_items', 'Перелік інформації' )
				                   ->add_fields( array(
					                   Field::make( 'text', 'item_name', 'Текст'  )
					                        ->set_attribute( 'placeholder', __( 'Тільки починаєш кар`єру IT' ) ),
				                   ) )
			              ) ),
			         Field::make( 'text', 'solid_block_9_free_class_form_btn'.carbon_lang_prefix(), 'Текст кнопки у формі'  )
			              ->set_attribute( 'placeholder', __( 'Пробне заняття' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),

			         /**
			          * Блок "Інфографіка"
			          */
			         Field::make( 'text', 'solid_block_9_infographics_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_9_infographics_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_9_infographics_list_title'.carbon_lang_prefix(), 'Назва переліку'  )
			              ->set_attribute( 'placeholder', __( 'Переваги навчання у Solid ES' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_9_infographics_items_list'.carbon_lang_prefix(), 'Перелік інфографіки' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'infographics_item_text', 'Значення'  )
				                   ->set_attribute('type', 'number')
				                   ->set_attribute( 'placeholder', __( '5' ) ),
				              Field::make( 'text', 'infographics_item_symbol', 'Додатковий символ'  )
				                   ->set_attribute( 'placeholder', __( '+' ) ),
				              Field::make( 'text', 'infographics_item_description', 'Опис'  )
				                   ->set_attribute( 'placeholder', __( 'років досвіду' ) ),
			              ) ),

			         Field::make( 'complex', 'solid_block_9_infographics_list'.carbon_lang_prefix(), 'Перелік' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'list_item', 'Текст'  )
				                   ->set_attribute( 'placeholder', __( 'Профільна технічна англійська' ) ),
			              ) ),

			         Field::make( 'image', 'solid_block_9_infographics_image'.carbon_lang_prefix(), 'Зображення' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_value_type( 'url' ),

			         Field::make( 'text', 'solid_block_9_infographics_position'.carbon_lang_prefix(), 'Посада'  )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_attribute( 'placeholder', __( 'CEO Solid Es' ) ),

			         Field::make( 'text', 'solid_block_9_infographics_person_name'.carbon_lang_prefix(), 'Іʼмя'  )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_attribute( 'placeholder', __( 'Анастасія Машталяр' ) ),

			         /**
			          * Блок "Теми курсу"
			          */
			         Field::make( 'text', 'solid_block_9_course_topics_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_9_course_topics_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEF3ED', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_9_course_topics_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( '24 теми уроків курсу "IT Starter" зосереджені на спеціалізованій тематиці ІТ' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_9_course_topics_list'.carbon_lang_prefix(), 'Перелік' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'list_item', 'Текст'  )
				                   ->set_attribute( 'placeholder', __( 'Problem-solving' ) ),
			              ) ),

			         /**
			          * Блок "Призов пройти опитування"
			          */
			         Field::make( 'text', 'solid_block_9_call_quiz_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_9_call_quiz_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_9_call_quiz_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Не можеш визначитись з програмою навчання? ' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_9_call_quiz_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Пройди безкоштовне тестування рівня англійської мови та отримай індивідуальні рекомендації щодо найкращого курсу' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         /*Field::make( 'text', 'solid_block_9_call_quiz_call_btn'.carbon_lang_prefix(), 'Текст заклику натиснути кнопку'  )
			              ->set_attribute( 'placeholder', __( 'Пройти онлайн тестування
та отримати індивідуальні рекомендації' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),*/
			         Field::make( 'text', 'solid_block_9_call_quiz_btn_text'.carbon_lang_prefix(), 'Текст кнопки'  )
			              ->set_attribute( 'placeholder', __( 'Пройти тест' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_9_call_quiz_btn_link'.carbon_lang_prefix(), 'Посилання у кнопку'  )
			              ->set_attribute( 'placeholder', __( 'https://solid.com.ua/' ) )
			              ->set_attribute( 'type', 'url' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'image', 'solid_block_9_call_quiz_block_image'.carbon_lang_prefix(), 'Зображення' )
			              ->set_value_type( 'url' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'ccall',
					              'compare' => '=',
				              )
			              ) ),
			         /**
			          * Блок "Відгуки"
			          */
			         Field::make( 'text', 'solid_block_9_reviews_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_9_reviews_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#00C3EB', '#40439D', '#FFB28B' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_9_reviews_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Відгуки про Курси англійської для IT' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt&lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_9_reviews_pre_rev_text'.carbon_lang_prefix(), 'Текст'  )
			              ->set_attribute( 'placeholder', __( 'Думки наших студентів:' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_9_reviews_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Дізнайся, як наші програми допомогли їм покращити рівень англійської, отримати нові можливості та розширити свої професійні горизонти.' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         /**
			          * Блок "Контакти"
			          */
			         Field::make( 'text', 'solid_block_9_contacts_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_9_contacts_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_9_contacts_form_title'.carbon_lang_prefix(), 'Заголовок форми'  )
			              ->set_attribute( 'placeholder', __( 'Залишились питання, залишайте заявку на безкоштовну консультацію' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_9_contacts_form_btn_text'.carbon_lang_prefix(), 'Текст кнопки у формі'  )
			              ->set_attribute( 'placeholder', __( 'Замовити консультацію' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_9_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),

		         ));
		//Block 10
		Container::make( 'post_meta', 'Блок № 10' )
		         ->where( function( $homeFields ) {
			         $homeFields->where( 'post_type', '=', 'page' );
			         $homeFields->where( 'post_template', '=', 'template-course.php' );
		         } )

		         ->add_fields( array(
			         Field::make( 'radio', 'solid_block_10_question'.carbon_lang_prefix(), __('Оберіть який блок відображати') )
			              ->set_options( array(
				              'course_info' => __('Блок "Інформація про курс"'),
				              'teachers' => __('Блок "Вчителі"'),
				              'free_class' => __('Блок "Пробне заняття"'),
				              'infographics' => __('Блок "Інфографіка"'),
				              'course_topics' => __('Блок "Теми курс"'),
				              'call' => __('Блок "Призив до дії"'),
				              'reviews' => __('Блок "Відгуки"'),
				              'contacts' => __('Блок "Контакти"'),
				              'off' => __('Вимкнути'),

			              ) ),
			         /**
			          * Блок "Інформація про курс"
			          */
			         Field::make( 'text', 'solid_block_10_course_info_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_10_course_info_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F1FBFD', '#F4FEFC', '#FEF3ED' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_10_course_info_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Курс англійської IT STARTER' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt &lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_10_course_info_about'.carbon_lang_prefix(), 'Перелік інформаціїних блоків про курс (Звичайні)' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Кількість занятть у курсі' ) ),
				              Field::make( 'text', 'info_value', 'Значення'  )
				                   ->set_attribute( 'placeholder', __( '24' ) ),
			              ) ),
			         Field::make( 'complex', 'solid_block_10_course_info_about_hlight'.carbon_lang_prefix(), 'Перелік інформаціїних блоків про курс (Виділені)' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Кількість занятть у курсі' ) ),
				              Field::make( 'text', 'info_value', 'Значення'  )
				                   ->set_attribute( 'placeholder', __( '24' ) ),
			              ) ),
			         Field::make( 'text', 'solid_block_10_course_info_sub_title'.carbon_lang_prefix(), 'Підзаголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Зміцни навички та отримай переваги разом з Solid' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt &lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_10_course_info_advantages'.carbon_lang_prefix(), 'Перелік переваг' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'advantage_icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'advantage_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( '24 онлайн заняття' ) ),
				              Field::make( 'textarea', 'advantage_description', 'Оптс'  )
				                   ->set_attribute( 'placeholder', __( 'На уроках ти будеш вивчати IT лексику та граматику на реальних прикладах комунікації в IT' ) )
				                   ->set_rows( 4 ),

			              ) ),
			         /**
			          * Блок "Вчителі"
			          */
			         Field::make( 'text', 'solid_block_10_teachers_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_10_teachers_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#FEFEFE', '#F1FBFD' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),

			         Field::make( 'text', 'solid_block_10_teachers_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Наша методологія та професійні вчителі: ключ до успішного вивчення англійської' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_10_teachers_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Тіччери з досвідом та міжнародними сертифікатами CELTA, TESOL, TKT, IELTS, CAE привносять унікальність у наш підхід до навчання. Вони не тільки жили за кордоном та спілкувалися з носіями мови, а й постійно вдосконалюють свої навички на тренінгах, семінарах та конференціях.' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_10_teachers_slogan'.carbon_lang_prefix(), 'Слоган'  )
			              ->set_attribute( 'placeholder', __( 'Для нас навчання англійської - це не просто робота, а стиль життя та пристрасть, яку ми з ентузіазмом передаємо нашим студентам.' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),

			         Field::make( 'association', 'solid_block_10_teachers_list'.carbon_lang_prefix(), __( 'Перелік вчителів на курсі' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) )
			              ->set_types( array(
				              array(
					              'type'      => 'post',
					              'post_type' => 'teachers',
				              )
			              ) ),

			         /**
			          * Блок "Пробне заняття"
			          */
			         Field::make( 'text', 'solid_block_10_free_class_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_10_free_class_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_10_free_class_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Спробуй безкоштовне пробне заняття із курсу IT Starter. Отримай унікальну можливість випробувати наше пробне заняття з курсу IT Starter.' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_10_free_class_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Поглибь свої знання в області ІТ та оціни якість нашого навчання.
Розпочни свій шлях до успішної ІТ кар`єри з англомовними проектами вже сьогодні' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_10_free_class_info_blocks'.carbon_lang_prefix(), 'Перелік блоків з інформацією' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Цей курс підійде тобі, якщо ти' ) ),
				              Field::make( 'complex', 'info_items', 'Перелік інформації' )
				                   ->add_fields( array(
					                   Field::make( 'text', 'item_name', 'Текст'  )
					                        ->set_attribute( 'placeholder', __( 'Тільки починаєш кар`єру IT' ) ),
				                   ) )
			              ) ),
			         Field::make( 'text', 'solid_block_10_free_class_form_btn'.carbon_lang_prefix(), 'Текст кнопки у формі'  )
			              ->set_attribute( 'placeholder', __( 'Пробне заняття' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),

			         /**
			          * Блок "Інфографіка"
			          */
			         Field::make( 'text', 'solid_block_10_infographics_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_10_infographics_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_10_infographics_list_title'.carbon_lang_prefix(), 'Назва переліку'  )
			              ->set_attribute( 'placeholder', __( 'Переваги навчання у Solid ES' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_10_infographics_items_list'.carbon_lang_prefix(), 'Перелік інфографіки' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'infographics_item_text', 'Значення'  )
				                   ->set_attribute('type', 'number')
				                   ->set_attribute( 'placeholder', __( '5' ) ),
				              Field::make( 'text', 'infographics_item_symbol', 'Додатковий символ'  )
				                   ->set_attribute( 'placeholder', __( '+' ) ),
				              Field::make( 'text', 'infographics_item_description', 'Опис'  )
				                   ->set_attribute( 'placeholder', __( 'років досвіду' ) ),
			              ) ),

			         Field::make( 'complex', 'solid_block_10_infographics_list'.carbon_lang_prefix(), 'Перелік' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'list_item', 'Текст'  )
				                   ->set_attribute( 'placeholder', __( 'Профільна технічна англійська' ) ),
			              ) ),

			         Field::make( 'image', 'solid_block_10_infographics_image'.carbon_lang_prefix(), 'Зображення' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_value_type( 'url' ),

			         Field::make( 'text', 'solid_block_10_infographics_position'.carbon_lang_prefix(), 'Посада'  )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_attribute( 'placeholder', __( 'CEO Solid Es' ) ),

			         Field::make( 'text', 'solid_block_10_infographics_person_name'.carbon_lang_prefix(), 'Іʼмя'  )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_attribute( 'placeholder', __( 'Анастасія Машталяр' ) ),

			         /**
			          * Блок "Теми курсу"
			          */
			         Field::make( 'text', 'solid_block_10_course_topics_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_10_course_topics_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEF3ED', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_10_course_topics_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( '24 теми уроків курсу "IT Starter" зосереджені на спеціалізованій тематиці ІТ' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_10_course_topics_list'.carbon_lang_prefix(), 'Перелік' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'list_item', 'Текст'  )
				                   ->set_attribute( 'placeholder', __( 'Problem-solving' ) ),
			              ) ),

			         /**
			          * Блок "Призов пройти опитування"
			          */
			         Field::make( 'text', 'solid_block_10_call_quiz_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_10_call_quiz_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_10_call_quiz_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Не можеш визначитись з програмою навчання? ' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_10_call_quiz_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Пройди безкоштовне тестування рівня англійської мови та отримай індивідуальні рекомендації щодо найкращого курсу' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         /*Field::make( 'text', 'solid_block_10_call_quiz_call_btn'.carbon_lang_prefix(), 'Текст заклику натиснути кнопку'  )
			              ->set_attribute( 'placeholder', __( 'Пройти онлайн тестування
та отримати індивідуальні рекомендації' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),*/
			         Field::make( 'text', 'solid_block_10_call_quiz_btn_text'.carbon_lang_prefix(), 'Текст кнопки'  )
			              ->set_attribute( 'placeholder', __( 'Пройти тест' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_10_call_quiz_btn_link'.carbon_lang_prefix(), 'Посилання у кнопку'  )
			              ->set_attribute( 'placeholder', __( 'https://solid.com.ua/' ) )
			              ->set_attribute( 'type', 'url' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'image', 'solid_block_10_call_quiz_block_image'.carbon_lang_prefix(), 'Зображення' )
			              ->set_value_type( 'url' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         /**
			          * Блок "Відгуки"
			          */
			         Field::make( 'text', 'solid_block_10_reviews_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_10_reviews_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#00C3EB', '#40439D', '#FFB28B' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_10_reviews_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Відгуки про Курси англійської для IT' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt&lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_10_reviews_pre_rev_text'.carbon_lang_prefix(), 'Текст'  )
			              ->set_attribute( 'placeholder', __( 'Думки наших студентів:' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_10_reviews_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Дізнайся, як наші програми допомогли їм покращити рівень англійської, отримати нові можливості та розширити свої професійні горизонти.' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         /**
			          * Блок "Контакти"
			          */
			         Field::make( 'text', 'solid_block_10_contacts_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_10_contacts_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_10_contacts_form_title'.carbon_lang_prefix(), 'Заголовок форми'  )
			              ->set_attribute( 'placeholder', __( 'Залишились питання, залишайте заявку на безкоштовну консультацію' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_10_contacts_form_btn_text'.carbon_lang_prefix(), 'Текст кнопки у формі'  )
			              ->set_attribute( 'placeholder', __( 'Замовити консультацію' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_10_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),

		         ));
		//Block 11
		Container::make( 'post_meta', 'Блок № 11' )
		         ->where( function( $homeFields ) {
			         $homeFields->where( 'post_type', '=', 'page' );
			         $homeFields->where( 'post_template', '=', 'template-course.php' );
		         } )

		         ->add_fields( array(
			         Field::make( 'radio', 'solid_block_11_question'.carbon_lang_prefix(), __('Оберіть який блок відображати') )
			              ->set_options( array(
				              'course_info' => __('Блок "Інформація про курс"'),
				              'teachers' => __('Блок "Вчителі"'),
				              'free_class' => __('Блок "Пробне заняття"'),
				              'infographics' => __('Блок "Інфографіка"'),
				              'course_topics' => __('Блок "Теми курс"'),
				              'call' => __('Блок "Призив до дії"'),
				              'reviews' => __('Блок "Відгуки"'),
				              'contacts' => __('Блок "Контакти"'),
				              'off' => __('Вимкнути'),

			              ) ),
			         /**
			          * Блок "Інформація про курс"
			          */
			         Field::make( 'text', 'solid_block_11_course_info_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_11_course_info_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F1FBFD', '#F4FEFC', '#FEF3ED' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_11_course_info_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Курс англійської IT STARTER' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt &lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_11_course_info_about'.carbon_lang_prefix(), 'Перелік інформаціїних блоків про курс (Звичайні)' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Кількість занятть у курсі' ) ),
				              Field::make( 'text', 'info_value', 'Значення'  )
				                   ->set_attribute( 'placeholder', __( '24' ) ),
			              ) ),
			         Field::make( 'complex', 'solid_block_11_course_info_about_hlight'.carbon_lang_prefix(), 'Перелік інформаціїних блоків про курс (Виділені)' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Кількість занятть у курсі' ) ),
				              Field::make( 'text', 'info_value', 'Значення'  )
				                   ->set_attribute( 'placeholder', __( '24' ) ),
			              ) ),
			         Field::make( 'text', 'solid_block_11_course_info_sub_title'.carbon_lang_prefix(), 'Підзаголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Зміцни навички та отримай переваги разом з Solid' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt &lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_11_course_info_advantages'.carbon_lang_prefix(), 'Перелік переваг' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'advantage_icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'advantage_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( '24 онлайн заняття' ) ),
				              Field::make( 'textarea', 'advantage_description', 'Оптс'  )
				                   ->set_attribute( 'placeholder', __( 'На уроках ти будеш вивчати IT лексику та граматику на реальних прикладах комунікації в IT' ) )
				                   ->set_rows( 4 ),

			              ) ),
			         /**
			          * Блок "Вчителі"
			          */
			         Field::make( 'text', 'solid_block_11_teachers_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_11_teachers_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#FEFEFE', '#F1FBFD' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),

			         Field::make( 'text', 'solid_block_11_teachers_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Наша методологія та професійні вчителі: ключ до успішного вивчення англійської' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_11_teachers_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Тіччери з досвідом та міжнародними сертифікатами CELTA, TESOL, TKT, IELTS, CAE привносять унікальність у наш підхід до навчання. Вони не тільки жили за кордоном та спілкувалися з носіями мови, а й постійно вдосконалюють свої навички на тренінгах, семінарах та конференціях.' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_11_teachers_slogan'.carbon_lang_prefix(), 'Слоган'  )
			              ->set_attribute( 'placeholder', __( 'Для нас навчання англійської - це не просто робота, а стиль життя та пристрасть, яку ми з ентузіазмом передаємо нашим студентам.' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),

			         Field::make( 'association', 'solid_block_11_teachers_list'.carbon_lang_prefix(), __( 'Перелік вчителів на курсі' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) )
			              ->set_types( array(
				              array(
					              'type'      => 'post',
					              'post_type' => 'teachers',
				              )
			              ) ),

			         /**
			          * Блок "Пробне заняття"
			          */
			         Field::make( 'text', 'solid_block_11_free_class_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_11_free_class_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_11_free_class_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Спробуй безкоштовне пробне заняття із курсу IT Starter. Отримай унікальну можливість випробувати наше пробне заняття з курсу IT Starter.' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_11_free_class_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Поглибь свої знання в області ІТ та оціни якість нашого навчання.
Розпочни свій шлях до успішної ІТ кар`єри з англомовними проектами вже сьогодні' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_11_free_class_info_blocks'.carbon_lang_prefix(), 'Перелік блоків з інформацією' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Цей курс підійде тобі, якщо ти' ) ),
				              Field::make( 'complex', 'info_items', 'Перелік інформації' )
				                   ->add_fields( array(
					                   Field::make( 'text', 'item_name', 'Текст'  )
					                        ->set_attribute( 'placeholder', __( 'Тільки починаєш кар`єру IT' ) ),
				                   ) )
			              ) ),
			         Field::make( 'text', 'solid_block_11_free_class_form_btn'.carbon_lang_prefix(), 'Текст кнопки у формі'  )
			              ->set_attribute( 'placeholder', __( 'Пробне заняття' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),

			         /**
			          * Блок "Інфографіка"
			          */
			         Field::make( 'text', 'solid_block_11_infographics_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_11_infographics_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_11_infographics_list_title'.carbon_lang_prefix(), 'Назва переліку'  )
			              ->set_attribute( 'placeholder', __( 'Переваги навчання у Solid ES' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_11_infographics_items_list'.carbon_lang_prefix(), 'Перелік інфографіки' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'infographics_item_text', 'Значення'  )
				                   ->set_attribute('type', 'number')
				                   ->set_attribute( 'placeholder', __( '5' ) ),
				              Field::make( 'text', 'infographics_item_symbol', 'Додатковий символ'  )
				                   ->set_attribute( 'placeholder', __( '+' ) ),
				              Field::make( 'text', 'infographics_item_description', 'Опис'  )
				                   ->set_attribute( 'placeholder', __( 'років досвіду' ) ),
			              ) ),

			         Field::make( 'complex', 'solid_block_11_infographics_list'.carbon_lang_prefix(), 'Перелік' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'list_item', 'Текст'  )
				                   ->set_attribute( 'placeholder', __( 'Профільна технічна англійська' ) ),
			              ) ),

			         Field::make( 'image', 'solid_block_11_infographics_image'.carbon_lang_prefix(), 'Зображення' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_value_type( 'url' ),

			         Field::make( 'text', 'solid_block_11_infographics_position'.carbon_lang_prefix(), 'Посада'  )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_attribute( 'placeholder', __( 'CEO Solid Es' ) ),

			         Field::make( 'text', 'solid_block_11_infographics_person_name'.carbon_lang_prefix(), 'Іʼмя'  )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_attribute( 'placeholder', __( 'Анастасія Машталяр' ) ),

			         /**
			          * Блок "Теми курсу"
			          */
			         Field::make( 'text', 'solid_block_11_course_topics_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_11_course_topics_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEF3ED', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_11_course_topics_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( '24 теми уроків курсу "IT Starter" зосереджені на спеціалізованій тематиці ІТ' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_11_course_topics_list'.carbon_lang_prefix(), 'Перелік' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'list_item', 'Текст'  )
				                   ->set_attribute( 'placeholder', __( 'Problem-solving' ) ),
			              ) ),

			         /**
			          * Блок "Призов пройти опитування"
			          */
			         Field::make( 'text', 'solid_block_11_call_quiz_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_11_call_quiz_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_11_call_quiz_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Не можеш визначитись з програмою навчання? ' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_11_call_quiz_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Пройди безкоштовне тестування рівня англійської мови та отримай індивідуальні рекомендації щодо найкращого курсу' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         /*Field::make( 'text', 'solid_block_11_call_quiz_call_btn'.carbon_lang_prefix(), 'Текст заклику натиснути кнопку'  )
			              ->set_attribute( 'placeholder', __( 'Пройти онлайн тестування
та отримати індивідуальні рекомендації' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),*/
			         Field::make( 'text', 'solid_block_11_call_quiz_btn_text'.carbon_lang_prefix(), 'Текст кнопки'  )
			              ->set_attribute( 'placeholder', __( 'Пройти тест' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_11_call_quiz_btn_link'.carbon_lang_prefix(), 'Посилання у кнопку'  )
			              ->set_attribute( 'placeholder', __( 'https://solid.com.ua/' ) )
			              ->set_attribute( 'type', 'url' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'image', 'solid_block_11_call_quiz_block_image'.carbon_lang_prefix(), 'Зображення' )
			              ->set_value_type( 'url' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         /**
			          * Блок "Відгуки"
			          */
			         Field::make( 'text', 'solid_block_11_reviews_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_11_reviews_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#00C3EB', '#40439D', '#FFB28B' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_11_reviews_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Відгуки про Курси англійської для IT' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt&lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_11_reviews_pre_rev_text'.carbon_lang_prefix(), 'Текст'  )
			              ->set_attribute( 'placeholder', __( 'Думки наших студентів:' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_11_reviews_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Дізнайся, як наші програми допомогли їм покращити рівень англійської, отримати нові можливості та розширити свої професійні горизонти.' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         /**
			          * Блок "Контакти"
			          */
			         Field::make( 'text', 'solid_block_11_contacts_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_11_contacts_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_11_contacts_form_title'.carbon_lang_prefix(), 'Заголовок форми'  )
			              ->set_attribute( 'placeholder', __( 'Залишились питання, залишайте заявку на безкоштовну консультацію' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_11_contacts_form_btn_text'.carbon_lang_prefix(), 'Текст кнопки у формі'  )
			              ->set_attribute( 'placeholder', __( 'Замовити консультацію' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_11_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),

		         ));
		//Block 12
		Container::make( 'post_meta', 'Блок № 12' )
		         ->where( function( $homeFields ) {
			         $homeFields->where( 'post_type', '=', 'page' );
			         $homeFields->where( 'post_template', '=', 'template-course.php' );
		         } )

		         ->add_fields( array(
			         Field::make( 'radio', 'solid_block_12_question'.carbon_lang_prefix(), __('Оберіть який блок відображати') )
			              ->set_options( array(
				              'course_info' => __('Блок "Інформація про курс"'),
				              'teachers' => __('Блок "Вчителі"'),
				              'free_class' => __('Блок "Пробне заняття"'),
				              'infographics' => __('Блок "Інфографіка"'),
				              'course_topics' => __('Блок "Теми курс"'),
				              'call' => __('Блок "Призив до дії"'),
				              'reviews' => __('Блок "Відгуки"'),
				              'contacts' => __('Блок "Контакти"'),
				              'off' => __('Вимкнути'),

			              ) ),
			         /**
			          * Блок "Інформація про курс"
			          */
			         Field::make( 'text', 'solid_block_12_course_info_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_12_course_info_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F1FBFD', '#F4FEFC', '#FEF3ED' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_12_course_info_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Курс англійської IT STARTER' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt &lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_12_course_info_about'.carbon_lang_prefix(), 'Перелік інформаціїних блоків про курс (Звичайні)' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Кількість занятть у курсі' ) ),
				              Field::make( 'text', 'info_value', 'Значення'  )
				                   ->set_attribute( 'placeholder', __( '24' ) ),
			              ) ),
			         Field::make( 'complex', 'solid_block_12_course_info_about_hlight'.carbon_lang_prefix(), 'Перелік інформаціїних блоків про курс (Виділені)' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Кількість занятть у курсі' ) ),
				              Field::make( 'text', 'info_value', 'Значення'  )
				                   ->set_attribute( 'placeholder', __( '24' ) ),
			              ) ),
			         Field::make( 'text', 'solid_block_12_course_info_sub_title'.carbon_lang_prefix(), 'Підзаголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Зміцни навички та отримай переваги разом з Solid' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt &lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_12_course_info_advantages'.carbon_lang_prefix(), 'Перелік переваг' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'course_info',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'image', 'advantage_icon', 'Іконка блоку' )
				                   ->set_value_type( 'url' ),
				              Field::make( 'text', 'advantage_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( '24 онлайн заняття' ) ),
				              Field::make( 'textarea', 'advantage_description', 'Оптс'  )
				                   ->set_attribute( 'placeholder', __( 'На уроках ти будеш вивчати IT лексику та граматику на реальних прикладах комунікації в IT' ) )
				                   ->set_rows( 4 ),

			              ) ),
			         /**
			          * Блок "Вчителі"
			          */
			         Field::make( 'text', 'solid_block_12_teachers_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_12_teachers_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#FEFEFE', '#F1FBFD' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),

			         Field::make( 'text', 'solid_block_12_teachers_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Наша методологія та професійні вчителі: ключ до успішного вивчення англійської' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_12_teachers_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Тіччери з досвідом та міжнародними сертифікатами CELTA, TESOL, TKT, IELTS, CAE привносять унікальність у наш підхід до навчання. Вони не тільки жили за кордоном та спілкувалися з носіями мови, а й постійно вдосконалюють свої навички на тренінгах, семінарах та конференціях.' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_12_teachers_slogan'.carbon_lang_prefix(), 'Слоган'  )
			              ->set_attribute( 'placeholder', __( 'Для нас навчання англійської - це не просто робота, а стиль життя та пристрасть, яку ми з ентузіазмом передаємо нашим студентам.' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) ),

			         Field::make( 'association', 'solid_block_12_teachers_list'.carbon_lang_prefix(), __( 'Перелік вчителів на курсі' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'teachers',
					              'compare' => '=',
				              )
			              ) )
			              ->set_types( array(
				              array(
					              'type'      => 'post',
					              'post_type' => 'teachers',
				              )
			              ) ),

			         /**
			          * Блок "Пробне заняття"
			          */
			         Field::make( 'text', 'solid_block_12_free_class_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_12_free_class_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_12_free_class_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Спробуй безкоштовне пробне заняття із курсу IT Starter. Отримай унікальну можливість випробувати наше пробне заняття з курсу IT Starter.' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_12_free_class_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Поглибь свої знання в області ІТ та оціни якість нашого навчання.
Розпочни свій шлях до успішної ІТ кар`єри з англомовними проектами вже сьогодні' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_12_free_class_info_blocks'.carbon_lang_prefix(), 'Перелік блоків з інформацією' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'info_name', 'Назва'  )
				                   ->set_attribute( 'placeholder', __( 'Цей курс підійде тобі, якщо ти' ) ),
				              Field::make( 'complex', 'info_items', 'Перелік інформації' )
				                   ->add_fields( array(
					                   Field::make( 'text', 'item_name', 'Текст'  )
					                        ->set_attribute( 'placeholder', __( 'Тільки починаєш кар`єру IT' ) ),
				                   ) )
			              ) ),
			         Field::make( 'text', 'solid_block_12_free_class_form_btn'.carbon_lang_prefix(), 'Текст кнопки у формі'  )
			              ->set_attribute( 'placeholder', __( 'Пробне заняття' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'free_class',
					              'compare' => '=',
				              )
			              ) ),

			         /**
			          * Блок "Інфографіка"
			          */
			         Field::make( 'text', 'solid_block_12_infographics_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_12_infographics_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_12_infographics_list_title'.carbon_lang_prefix(), 'Назва переліку'  )
			              ->set_attribute( 'placeholder', __( 'Переваги навчання у Solid ES' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_12_infographics_items_list'.carbon_lang_prefix(), 'Перелік інфографіки' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'infographics_item_text', 'Значення'  )
				                   ->set_attribute('type', 'number')
				                   ->set_attribute( 'placeholder', __( '5' ) ),
				              Field::make( 'text', 'infographics_item_symbol', 'Додатковий символ'  )
				                   ->set_attribute( 'placeholder', __( '+' ) ),
				              Field::make( 'text', 'infographics_item_description', 'Опис'  )
				                   ->set_attribute( 'placeholder', __( 'років досвіду' ) ),
			              ) ),

			         Field::make( 'complex', 'solid_block_12_infographics_list'.carbon_lang_prefix(), 'Перелік' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'list_item', 'Текст'  )
				                   ->set_attribute( 'placeholder', __( 'Профільна технічна англійська' ) ),
			              ) ),

			         Field::make( 'image', 'solid_block_12_infographics_image'.carbon_lang_prefix(), 'Зображення' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_value_type( 'url' ),

			         Field::make( 'text', 'solid_block_12_infographics_position'.carbon_lang_prefix(), 'Посада'  )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_attribute( 'placeholder', __( 'CEO Solid Es' ) ),

			         Field::make( 'text', 'solid_block_12_infographics_person_name'.carbon_lang_prefix(), 'Іʼмя'  )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'infographics',
					              'compare' => '=',
				              )
			              ) )
			              ->set_attribute( 'placeholder', __( 'Анастасія Машталяр' ) ),

			         /**
			          * Блок "Теми курсу"
			          */
			         Field::make( 'text', 'solid_block_12_course_topics_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_12_course_topics_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEF3ED', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_12_course_topics_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( '24 теми уроків курсу "IT Starter" зосереджені на спеціалізованій тематиці ІТ' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'complex', 'solid_block_12_course_topics_list'.carbon_lang_prefix(), 'Перелік' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'course_topics',
					              'compare' => '=',
				              )
			              ) )
			              ->add_fields( array(
				              Field::make( 'text', 'list_item', 'Текст'  )
				                   ->set_attribute( 'placeholder', __( 'Problem-solving' ) ),
			              ) ),

			         /**
			          * Блок "Призов пройти опитування"
			          */
			         Field::make( 'text', 'solid_block_12_call_quiz_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_12_call_quiz_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_12_call_quiz_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Не можеш визначитись з програмою навчання? ' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_12_call_quiz_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Пройди безкоштовне тестування рівня англійської мови та отримай індивідуальні рекомендації щодо найкращого курсу' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         /*Field::make( 'text', 'solid_block_12_call_quiz_call_btn'.carbon_lang_prefix(), 'Текст заклику натиснути кнопку'  )
			              ->set_attribute( 'placeholder', __( 'Пройти онлайн тестування
та отримати індивідуальні рекомендації' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),*/
			         Field::make( 'text', 'solid_block_12_call_quiz_btn_text'.carbon_lang_prefix(), 'Текст кнопки'  )
			              ->set_attribute( 'placeholder', __( 'Пройти тест' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_12_call_quiz_btn_link'.carbon_lang_prefix(), 'Посилання у кнопку'  )
			              ->set_attribute( 'placeholder', __( 'https://solid.com.ua/' ) )
			              ->set_attribute( 'type', 'url' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'image', 'solid_block_12_call_quiz_block_image'.carbon_lang_prefix(), 'Зображення' )
			              ->set_value_type( 'url' )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'call',
					              'compare' => '=',
				              )
			              ) ),
			         /**
			          * Блок "Відгуки"
			          */
			         Field::make( 'text', 'solid_block_12_reviews_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_12_reviews_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#00C3EB', '#40439D', '#FFB28B' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_12_reviews_title'.carbon_lang_prefix(), 'Заголовок блоку'  )
			              ->set_attribute( 'placeholder', __( 'Відгуки про Курси англійської для IT' ) )
			              ->set_help_text( 'Для виділення англійського слова фірмовим шрифтом, помістіть його між тегами &lt;span&gt&lt;/span&gt')
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_12_reviews_pre_rev_text'.carbon_lang_prefix(), 'Текст'  )
			              ->set_attribute( 'placeholder', __( 'Думки наших студентів:' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'textarea', 'solid_block_12_reviews_text'.carbon_lang_prefix(), 'Текст блоку'  )
			              ->set_attribute( 'placeholder', __( 'Дізнайся, як наші програми допомогли їм покращити рівень англійської, отримати нові можливості та розширити свої професійні горизонти.' ) )
			              ->set_help_text( 'Якщо потрібно зробити примусовий переніс строки, перед текстом який має починатися з наступної строки треба поставити тег &lt;/br&gt')
			              ->set_rows( 4 )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'reviews',
					              'compare' => '=',
				              )
			              ) ),
			         /**
			          * Блок "Контакти"
			          */
			         Field::make( 'text', 'solid_block_12_contacts_id'.carbon_lang_prefix(), 'Ідентифікатор блоку'  )
			              ->set_help_text( 'Потрібен для прив`язки блоку для міню навігації по сторінці та аналітики')
			              ->set_attribute( 'placeholder', __( 'block-id' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'color', 'solid_block_12_contacts_background'.carbon_lang_prefix(), 'Фоновий колір блоку' )
			              ->set_palette( array( '#F9F9F9', '#FEFEF6' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_12_contacts_form_title'.carbon_lang_prefix(), 'Заголовок форми'  )
			              ->set_attribute( 'placeholder', __( 'Залишились питання, залишайте заявку на безкоштовну консультацію' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),
			         Field::make( 'text', 'solid_block_12_contacts_form_btn_text'.carbon_lang_prefix(), 'Текст кнопки у формі'  )
			              ->set_attribute( 'placeholder', __( 'Замовити консультацію' ) )
			              ->set_conditional_logic( array(
				              'relation' => 'AND',
				              array(
					              'field' => 'solid_block_12_question'.carbon_lang_prefix(),
					              'value' => 'contacts',
					              'compare' => '=',
				              )
			              ) ),

		         ));


	}

	/**
	 * Сутність вчителі
	 */

	add_action( 'carbon_fields_register_fields', 'solid_teachers_post_meta' );

	function solid_teachers_post_meta(){
		Container::make( 'post_meta', __( 'Services fields' ) )
		         ->where( 'post_type', '=', 'teachers' )
		         ->add_fields( array(
			         Field::make( 'text', 'solid_teachers_video_id'.carbon_lang_prefix(), __( 'ID відео з Youtube' ) )
				            ->set_help_text('Приклад повного посилання на відео https://www.youtube.com/watch?v=hKXYUm_fvAs. Та частина яку треба додати у поле hKXYUm_fvAs')
			              ->set_attribute( 'placeholder', __('hKXYUm_fvAs')),
			         Field::make( 'file', 'solid_teachers_video_file'.carbon_lang_prefix(), __( 'Відео файл' ) )
				            ->set_type( 'video' )
			              ->set_value_type( 'url' ),
			         Field::make( 'text', 'solid_teachers_post'.carbon_lang_prefix(), __( 'Посада' ) )
			              ->set_attribute( 'placeholder', __('Тітчер англійської')),
			         Field::make( 'complex', 'solid_teachers_description_list'.carbon_lang_prefix(), 'Перелік досягнень' )
			              ->add_fields( array(
				              Field::make( 'text', 'description_name', 'Назва досягнення'  )
				                   ->set_attribute( 'placeholder', __( 'Досвід роботи: ' ) ),
				              Field::make( 'textarea', 'description_text', 'Опис досягнення'  )
				                   ->set_attribute( 'placeholder', __( 'Має міжнародний сертифікат TESOL (*дозволяє викладати англійську мову носіям інших мов по вcьому світі)' ) )
				                   ->set_rows( 4 ),

			              ) ),

		         ) );
	}

	/**
	 * Сутність відгуки
	 */

	add_action( 'carbon_fields_register_fields', 'solid_reviews_post_meta' );

	function solid_reviews_post_meta(){
		Container::make( 'post_meta', __( 'Services fields' ) )
		         ->where( 'post_type', '=', 'reviews' )
		         ->add_fields( array(
			         Field::make( 'text', 'solid_reviews_video_id'.carbon_lang_prefix(), __( 'ID відео з Youtube' ) )
			              ->set_help_text('Приклад повного посилання на відео https://www.youtube.com/watch?v=hKXYUm_fvAs. Та частина яку треба додати у поле hKXYUm_fvAs')
			              ->set_attribute( 'placeholder', __('hKXYUm_fvAs')),
			         Field::make( 'file', 'solid_reviews_video_file'.carbon_lang_prefix(), __( 'Відео файл' ) )
			              ->set_type( 'video' )
			              ->set_value_type( 'url' ),
			         Field::make( 'textarea', 'solid_reviews_text'.carbon_lang_prefix(), __( 'Текст відгуку' ) )
			              ->set_attribute( 'placeholder', __('Відгук клієнта'))
				            ->set_rows( 5 ),

		         ) );
	}


	/**
	 * Custom Thx Page
	 */

	add_action('carbon_fields_register_fields', 'custom_thx_page');

	function custom_thx_page(){
		Container::make( 'post_meta', 'Сторінка подяки' )
		         ->where( function( $homeFields ) {
			         $homeFields->where( 'post_type', '=', 'page' );
			         $homeFields->where( 'post_template', '=', 'template-thx.php' );
		         } )

		         ->add_fields( array(

			         Field::make( 'text', 'solid_thx_btn_text'.carbon_lang_prefix(), 'Текст у кнопці' )
			              ->set_attribute( 'placeholder', 'Телеграм канал' ),
			         Field::make( 'text', 'solid_thx_btn_link'.carbon_lang_prefix(), 'Посилання у кнопку' )
			              ->set_attribute( 'placeholder', 'https://www.facebook.com/' )
				            ->set_attribute('type', 'url'),

			         Field::make( 'radio', 'solid_thx_social_fb'.carbon_lang_prefix(), 'Виводити Facebook?')
			              ->set_options( array(
				              'no' => 'Ні',
				              'yes' => 'Так',

			              ) ),

			         Field::make( 'radio', 'solid_thx_social_inst'.carbon_lang_prefix(), 'Виводити Instagram?')
			              ->set_options( array(
				              'no' => 'Ні',
				              'yes' => 'Так',

			              ) ),

			         Field::make( 'radio', 'solid_thx_social_inlink'.carbon_lang_prefix(), 'Виводити Linkedin?')
			              ->set_options( array(
				              'no' => 'Ні',
				              'yes' => 'Так',

			              ) ),

			         Field::make( 'radio', 'solid_thx_social_you'.carbon_lang_prefix(), 'Виводити Youtube?')
			              ->set_options( array(
				              'no' => 'Ні',
				              'yes' => 'Так',

			              ) ),

			         Field::make( 'radio', 'solid_thx_social_tik'.carbon_lang_prefix(), 'Виводити Tik-Tok?')
			              ->set_options( array(
				              'no' => 'Ні',
				              'yes' => 'Так',

			              ) ),

			         Field::make( 'textarea', 'solid_thx_call_text'.carbon_lang_prefix(), 'Текст призову')
				            ->set_attribute( 'placeholder', 'підписуйся на наші соціальні мережі, тебе чекає багато цікавого' )
			              ->set_rows( 4 ),

		         ));
	}