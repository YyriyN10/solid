<?php
/**
 * solid_constructor functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package solid_constructor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function solid_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on solid_constructor, use a find and replace
		* to change 'solid' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'solid', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'solid' ),
			'menu-2' => esc_html__( 'Footer', 'solid' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'solid_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'solid_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function solid_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'solid_content_width', 640 );
}
add_action( 'after_setup_theme', 'solid_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function solid_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'solid' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'solid' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'solid_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/scripts-styles.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Custom Post Types
 */
require get_template_directory() . '/inc/custom-post-types.php';

/**
 * Carbon Fields
 */
require get_template_directory() . '/inc/carbon-fields.php';

add_action( 'after_setup_theme', 'carbon_load' );
function carbon_load() {
	require_once( 'vendor/autoload.php' );
	\Carbon_Fields\Carbon_Fields::boot();
}

function carbon_lang_prefix() {
	$prefixLang = '';
	if ( ! defined( 'ICL_LANGUAGE_CODE' ) ) {
		return $prefixLang;
	}
	$prefixLang = '_' . ICL_LANGUAGE_CODE;
	return $prefixLang;
}

/**
 * Variables
 */
define( 'SITE_URL', get_site_url() );
define( 'SITE_LOCALE', get_locale() );
define( 'THEME_PATH', get_template_directory_uri() );

/**
 * Poly translations
 */

require get_template_directory() . '/inc/poly-translations.php';

	/**
	 * Init theme Ajax
	 */

	add_action( 'wp_enqueue_scripts', 'myajax_data', 99 );
	function myajax_data(){

		wp_localize_script('solid-script-main', 'myajax',
			array(
				'url' => admin_url('admin-ajax.php')
			)
		);

	}

/**
 * Form Integration
 */

/*add_action('admin_post_nopriv_form_integration', 'form_integration_callback');
add_action('admin_post_form_integration', 'form_integration_callback');*/
	use Telegram\Bot\Api;

	add_action('wp_ajax_form_integration_test', 'form_integration_callback_test');
	add_action('wp_ajax_nopriv_form_integration_test', 'form_integration_callback_test');

	function form_integration_callback_test(){
		require_once('vendor/autoload.php');

		function clearData($data) {
			return addslashes(strip_tags(trim($data)));
		}

		$login = '380996212409';
		$password = 'c7f4b616f56db01c3587a2f128e7d365';

		$name = clearData($_POST['name']);
		$phone = clearData($_POST['phone']);
		$email = clearData($_POST['email']);
		$pageName = clearData($_POST['page-name']);
		$currentLang = clearData($_POST['form-lang']);
		$pageUrl = clearData($_POST['page-url']);
		$homeUrl = clearData($_POST['home-url']);

		$crmPhone = clearData($_POST['crm-phone']);

		$utmSource = clearData($_POST['utm_source']);
		$utmMedium = clearData($_POST['utm_medium']);
		$utmCampaign = clearData($_POST['utm_campaign']);
		$utmTerm = clearData($_POST['utm_term']);
		$utmContent = clearData($_POST['utm_content']);

		$date = new DateTime();
		$data = $date->getTimestamp();
		$rand = rand(0, 9);
		$data = $data - 1000000000;
		$orderCode = $data . "-" . $rand;

		$orderManagerId = 16;

		$clientPhone = preg_replace('![^0-9]+!', '', $phone);

		$hardName = $pageName.' '.$name.' '.date("Y-m-d H:i:s");

		$curlSession = curl_init();
		curl_setopt($curlSession, CURLOPT_URL, "https://solidenglishschool.1b.app/api/orders/add/?login={$login}&password={$password}&ordercode={$orderCode}&clientphone={$clientPhone}&clientemail={$email}&clientnamefirst={$name}&ordername={$pageName}&workflowid=2&statusid=5&utm_source={$utmSource}&utm_medium={$utmMedium}&utm_campaign={$utmCampaign}&utm_content={$utmContent}&utm_term={$utmTerm}&utm_referrer={$pageUrl}&customorder_tnazva={$hardName}&order_managerid={$orderManagerId}&source=smmstudio");
		curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
		curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

		$jsonData = json_decode(curl_exec($curlSession));
		curl_close($curlSession);

		$openBoxResult = json_encode($jsonData);

		/*$openBoxResult = 'Test';*/

		$telegram = new Api('5851533305:AAEHXeCJ48NKCE2FJsFzmRgfxEJye5GqbkI');

		$telegramTargetChatId = '-1002026512374';

		$response = $telegram->sendMessage([
			'chat_id' => $telegramTargetChatId,
			'text'    => 'Заявка з '.$pageName."\r\n"."\r\n".'Данные клиента'."\r\n"."\r\n".'Імʼя клієнту: '.$name."\r\n".'Телефон клієнту: '.$phone."\r\n".'Пошта клієнту: '.$email."\r\n"."\r\n".'Аналітика'."\r\n"."\r\n".'utmSource: '.$utmSource."\r\n".'utmMedium: '.$utmMedium."\r\n".'utmCampaign: '.$utmCampaign."\r\n".'utmTerm: '. $utmTerm."\r\n".'utmContent: '.$utmContent."\r\n".'Звіт з доставки до Onebox api:: '.$openBoxResult."\r\n".'Замовлення зі сторінки: '.$pageUrl.''
		]);

		$_POST = array();

		exit;
	}


add_action('wp_ajax_form_integration', 'form_integration_callback');
add_action('wp_ajax_nopriv_form_integration', 'form_integration_callback');


function form_integration_callback(){
	require_once('vendor/autoload.php');

	function clearData($data) {
		return addslashes(strip_tags(trim($data)));
	}

	$login = '380996212409';
	$password = 'c7f4b616f56db01c3587a2f128e7d365';

	$name = clearData($_POST['name']);
	$phone = clearData($_POST['phone']);
	$email = clearData($_POST['email']);
	$pageName = clearData($_POST['page-name']);
	$currentLang = clearData($_POST['form-lang']);
	$pageUrl = clearData($_POST['page-url']);
	$homeUrl = clearData($_POST['home-url']);

	$utmSource = clearData($_POST['utm_source']);
	$utmMedium = clearData($_POST['utm_medium']);
	$utmCampaign = clearData($_POST['utm_campaign']);
	$utmTerm = clearData($_POST['utm_term']);
	$utmContent = clearData($_POST['utm_content']);

	/*echo 'phone '.$phone;*/

	$date = new DateTime();
	$data = $date->getTimestamp();
	$rand = rand(0, 9);
	$data = $data - 1000000000;
	$orderCode = $data . "-" . $rand;

	$orderManagerId = 16;

	$clientPhone = preg_replace('![^0-9]+!', '', $phone);

	$hardName = $pageName.' '.$name.' '.date("Y-m-d H:i:s");

	/*$sendToCrm = fopen("https://solidenglishschool.1b.app/api/orders/add/?login={$login}&password={$password}&ordercode={$orderCode}&clientphone={$clientPhone}&clientemail={$email}&clientnamefirst={$name}&ordername={$pageName}&workflowid=2&statusid=5&utm_source={$utmSource}&utm_medium={$utmMedium}&utm_campaign={$utmCampaign}&utm_content={$utmContent}&utm_term={$utmTerm}&utm_referrer={$pageUrl}&customorder_tnazva={$hardName}&order_managerid={$orderManagerId}&source=smmstudio","r",false);

	$openBoxResult = stream_get_contents($sendToCrm);

	print_r(stream_get_contents($sendToCrm));*/

	$curlSession = curl_init();
	curl_setopt($curlSession, CURLOPT_URL, "https://solidenglishschool.1b.app/api/orders/add/?login={$login}&password={$password}&ordercode={$orderCode}&clientphone={$clientPhone}&clientemail={$email}&clientnamefirst={$name}&ordername={$pageName}&workflowid=2&statusid=5&utm_source={$utmSource}&utm_medium={$utmMedium}&utm_campaign={$utmCampaign}&utm_content={$utmContent}&utm_term={$utmTerm}&utm_referrer={$pageUrl}&customorder_tnazva={$hardName}&order_managerid={$orderManagerId}&source=smmstudio");
	curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
	curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

	$jsonData = json_decode(curl_exec($curlSession));
	curl_close($curlSession);

	$openBoxResult = json_encode($jsonData);

	/*echo $sendToCrm;*/

	$telegram = new Api('5851533305:AAEHXeCJ48NKCE2FJsFzmRgfxEJye5GqbkI');

	$telegramTargetChatId = '-893257518';

	$response = $telegram->sendMessage([
		'chat_id' => $telegramTargetChatId,
		'text'    => 'Заявка з '.$pageName."\r\n"."\r\n".'Данные клиента'."\r\n"."\r\n".'Імʼя клієнту: '.$name."\r\n".'Телефон клієнту: '.$phone."\r\n".'Пошта клієнту: '.$email."\r\n"."\r\n".'Аналітика'."\r\n"."\r\n".'utmSource: '.$utmSource."\r\n".'utmMedium: '.$utmMedium."\r\n".'utmCampaign: '.$utmCampaign."\r\n".'utmTerm: '. $utmTerm."\r\n".'utmContent: '.$utmContent."\r\n".'Звіт з доставки до Onebox api:: '.$openBoxResult."\r\n".'Замовлення зі сторінки: '.$pageUrl.''
	]);

	$_POST = array();

	exit;
}

	/**
	 * Редирект на головну із site.com/wp-admin
	 */
	add_action( 'init', function () {
		if ( is_admin() && ! current_user_can( 'administrator' ) &&
		     ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
			wp_redirect( home_url() );
			exit;
		}
	});

	/**
	 * Редирект на головну із site.com/wp-login.php
	 */
	add_action( 'init', function () {
		$page_viewed = basename( $_SERVER['REQUEST_URI'] );
		if ( $page_viewed == "wp-login.php" ) {
			wp_redirect( home_url() );
			exit;
		}
	});

	/**
	 * Редирект на головну після виходу із системи
	 */
	add_action( 'wp_logout', function () {
		$login_page  = home_url( 'wp-admin' );
		wp_redirect( $login_page . "?loggedout=true" );
		exit;
	});

	add_filter( 'login_headertext', 'true_change_login_logo_text' );

	function true_change_login_logo_text( $text ) {
		return 'SOLID';
	}

	add_action( 'login_head', 'true_no_login_logo' );

	function true_no_login_logo() {
		echo '<style>
		#login h1 a {
	    background-image: none;
	    text-indent: 0;
	    height: auto;
	    width: auto;
	    color: #262961;
	    font-size: 34px;
		}
		
		#login form{
			border-radius: 4px;
			border: 2px solid #262961;
			background-color: #e2fffa;
			color: #262961;
		}
		
		#login form input{
			background-color: rgba(0,0,0,0);
			border: 1px solid #262961;
			color: #262961;
			font-size: 14px;
			padding-left: 20px;
		}
		
		#login form input::-webkit-input-placeholder {
        color: #5B6583;
      }
      #login form input:-moz-placeholder {
        color: #5B6583;
      }
      #login form input::-moz-placeholder {
        color: #5B6583;
      }
      #login form input:-ms-input-placeholder {
        color: #5B6583;
      }
		
		#login form input:focus{
			border: 1px solid #262961;
			box-shadow: none !important;
			outline: none;
		}
		
		#login form p.submit{
			width: 100%;
			display: flex;
			padding-top: 20px;
			justify-content: center;
		}
		
		#login form p.submit .button{
			display: inline-block;
			padding: 	5px 30px;
			background-color: #3AFFDC;
			font-size: 18px;
			border: 1px solid #262961;
			transition: all 0.5s;
			
			&:hover{
				border: 1px solid rgba(255,255,255,0.7);
			}	
		}
		
		#login #nav,
		#login #nav a,
		#backtoblog a{
			color: #262961;
		}
		
		.login #backtoblog a{
			color: #262961;
		}
		
		.login{
			background-color: #f1fbfd;
		}
		
		.language-switcher{
			display: none;
		}
		</style>';
	}

	add_filter( 'login_headerurl', 'true_login_link_to_website' );

	function true_login_link_to_website( $url ) {
		return site_url();
	}
