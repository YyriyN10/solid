<?php
/**
 * WordPress User Page
 *
 * Handles authentication, registering, resetting passwords, forgot password,
 * and other user handling.
 *
 * @package WordPress
 */

/** Make sure that the WordPress bootstrap has run before continuing. */
require __DIR__ . '/wp-load.php';

// Redirect to HTTPS login if forced to use SSL.
if ( force_ssl_admin() && ! is_ssl() ) {
	if ( 0 === strpos( $_SERVER['REQUEST_URI'], 'http' ) ) {
		wp_safe_redirect( set_url_scheme( $_SERVER['REQUEST_URI'], 'https' ) );
		exit;
	} else {
		wp_safe_redirect( 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
		exit;
	}
}

/**
 * Output the login page header.
 *
 * @since 2.1.0
 *
 * @global string      $error         Login error message set by deprecated pluggable wp_login() function
 *                                    or plugins replacing it.
 * @global bool|string $interim_login Whether interim login modal is being displayed. String 'success'
 *                                    upon successful login.
 * @global string      $action        The action that brought the visitor to the login page.
 *
 * @param string   $title    Optional. WordPress login Page title to display in the `<title>` element.
 *                           Default 'Log In'.
 * @param string   $message  Optional. Message to display in header. Default empty.
 * @param WP_Error $wp_error Optional. The error to pass. Default is a WP_Error instance.
 */
function login_header( $title = 'Log In', $message = '', $wp_error = null ) {
global $error, $interim_login, $action;

// Don't index any of these forms.
add_filter( 'wp_robots', 'wp_robots_sensitive_page' );
add_action( 'login_head', 'wp_strict_cross_origin_referrer' );

add_action( 'login_head', 'wp_login_viewport_meta' );

if ( ! is_wp_error( $wp_error ) ) {
	$wp_error = new WP_Error();
}

// Shake it!
$shake_error_codes = array( 'empty_password', 'empty_email', 'invalid_email', 'invalidcombo', 'empty_username', 'invalid_username', 'incorrect_password', 'retrieve_password_email_failure' );
/**
 * Filters the error codes array for shaking the login form.
 *
 * @since 3.0.0
 *
 * @param string[] $shake_error_codes Error codes that shake the login form.
 */
$shake_error_codes = apply_filters( 'shake_error_codes', $shake_error_codes );

if ( $shake_error_codes && $wp_error->has_errors() && in_array( $wp_error->get_error_code(), $shake_error_codes, true ) ) {
	add_action( 'login_footer', 'wp_shake_js', 12 );
}

$login_title = get_bloginfo( 'name', 'display' );

/* translators: Login screen title. 1: Login screen name, 2: Network or site name. */
$login_title = sprintf( __( '%1$s &lsaquo; %2$s &#8212; WordPress' ), $title, $login_title );

if ( wp_is_recovery_mode() ) {
	/* translators: %s: Login screen title. */
	$login_title = sprintf( __( 'Recovery Mode &#8212; %s' ), $login_title );
}

/**
 * Filters the title tag content for login page.
 *
 * @since 4.9.0
 *
 * @param string $login_title The page title, with extra context added.
 * @param string $title       The original page title.
 */
$login_title = apply_filters( 'login_title', $login_title, $title );

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
	<title><?php echo $login_title; ?></title>
	<?php

		wp_enqueue_style( 'login' );

		/*
		 * Remove all stored post data on logging out.
		 * This could be added by add_action('login_head'...) like wp_shake_js(),
		 * but maybe better if it's not removable by plugins.
		 */
		if ( 'loggedout' === $wp_error->get_error_code() ) {
			?>
			<script>if("sessionStorage" in window){try{for(var key in sessionStorage){if(key.indexOf("wp-autosave-")!=-1){sessionStorage.removeItem(key)}}}catch(e){}};</script>
			<?php
		}

		/**
		 * Enqueue scripts and styles for the login page.
		 *
		 * @since 3.1.0
		 */
		do_action( 'login_enqueue_scripts' );

		/**
		 * Fires in the login page header after scripts are enqueued.
		 *
		 * @since 2.1.0
		 */
		do_action( 'login_head' );

		$login_header_url = __( 'https://wordpress.org/' );

		/**
		 * Filters link URL of the header logo above login form.
		 *
		 * @since 2.1.0
		 *
		 * @param string $login_header_url Login header logo URL.
		 */
		$login_header_url = apply_filters( 'login_headerurl', $login_header_url );

		$login_header_title = '';

		/**
		 * Filters the title attribute of the header logo above login form.
		 *
		 * @since 2.1.0
		 * @deprecated 5.2.0 Use {@see 'login_headertext'} instead.
		 *
		 * @param string $login_header_title Login header logo title attribute.
		 */
		$login_header_title = apply_filters_deprecated(
			'login_headertitle',
			array( $login_header_title ),
			'5.2.0',
			'login_headertext',
			__( 'Usage of the title attribute on the login logo is not recommended for accessibility reasons. Use the link text instead.' )
		);

		$login_header_text = empty( $login_header_title ) ? __( 'Powered by WordPress' ) : $login_header_title;

		/**
		 * Filters the link text of the header logo above the login form.
		 *
		 * @since 5.2.0
		 *
		 * @param string $login_header_text The login header logo link text.
		 */
		$login_header_text = apply_filters( 'login_headertext', $login_header_text );

		$classes = array( 'login-action-' . $action, 'wp-core-ui' );

		if ( is_rtl() ) {
			$classes[] = 'rtl';
		}

		if ( $interim_login ) {
			$classes[] = 'interim-login';

			?>
			<style type="text/css">html{background-color: transparent;}</style>
			<?php

			if ( 'success' === $interim_login ) {
				$classes[] = 'interim-login-success';
			}
		}

		$classes[] = ' locale-' . sanitize_html_class( strtolower( str_replace( '_', '-', get_locale() ) ) );

		/**
		 * Filters the login page body classes.
		 *
		 * @since 3.5.0
		 *
		 * @param string[] $classes An array of body classes.
		 * @param string   $action  The action that brought the visitor to the login page.
		 */
		$classes = apply_filters( 'login_body_class', $classes, $action );

	?>
</head>
<body class="login no-js <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
<script type="text/javascript">
  document.body.className = document.body.className.replace('no-js','js');
</script>
<?php
	/**
	 * Fires in the login page header after the body tag is opened.
	 *
	 * @since 4.6.0
	 */
	do_action( 'login_header' );

?>
<div id="login">
	<h1>
    <a href="<?php echo esc_url( $login_header_url ); ?>">
      <svg xmlns="http://www.w3.org/2000/svg" width="120" height="40" viewBox="0 0 120 40" fill="none">
        <path d="M53.237 26.1063C57.5607 26.1063 60.8805 23.6655 60.8805 20.0686C60.8805 16.6769 58.0759 15.0083 53.7522 14.5701C52.1569 14.3898 49.2993 14.107 49.2993 13.3116C49.2993 12.7725 50.7919 12.3872 52.9537 12.3872C55.4253 12.3872 57.0968 12.875 57.0968 13.5431H60.5707C60.5707 10.3316 57.4828 7.76172 53.1326 7.76172C49.0143 7.76172 45.7989 10.0736 45.7989 13.5944C45.7989 16.9349 48.7592 18.7589 52.6704 19.1442C54.3684 19.3245 57.4049 19.6585 57.4049 20.454C57.4049 21.0443 55.6804 21.4809 53.4672 21.4809C50.8681 21.4809 48.9895 20.8641 48.9895 20.0935H45.5156C45.5156 23.434 48.7327 26.1063 53.237 26.1063ZM71.4495 26.1063C76.8284 26.1063 80.9202 22.1507 80.9202 16.9349C80.9202 11.7191 76.8284 7.76337 71.4495 7.76337C66.044 7.76337 61.9788 11.7191 61.9788 16.9349C61.9788 22.1507 66.044 26.1063 71.4495 26.1063ZM71.4495 21.0973C68.0518 21.0973 65.4526 19.3245 65.4526 16.9349C65.4526 14.5452 68.0518 12.7725 71.4495 12.7725C74.8471 12.7725 77.4198 14.5452 77.4198 16.9349C77.4198 19.3245 74.8455 21.0973 71.4495 21.0973ZM86.203 20.8905V8.07096H82.8567V25.7988H94.8504V20.8922H86.203V20.8905ZM96.6047 25.7988H99.951V8.07096H96.6047V25.7988ZM109.841 8.07096H102.713V25.7988H109.841C115.066 25.7988 119.003 21.9969 119.003 16.9349C119.003 11.8728 115.066 8.07096 109.841 8.07096ZM109.712 20.8905H106.057V12.9775H109.712C113.031 12.9775 115.503 14.6726 115.503 16.9332C115.503 19.1938 113.033 20.8905 109.712 20.8905Z" fill="#262961"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M40.0695 20C40.0695 31.0451 31.0991 40 20.0348 40C8.97042 40 0 31.0451 0 20C0 8.95485 8.97042 0 20.0348 0C31.0991 0 40.0695 8.95485 40.0695 20ZM19.0722 7.11328L8.17188 11.8727V17.7202L19.0722 22.4796V16.7693L14.51 14.7964L19.0722 12.8236V7.11328ZM31.9003 28.1264L21 32.8858V27.1756L25.5622 25.2027L21 23.2298V17.5195L31.9003 22.2789V28.1264Z" fill="#262961"/>
        <path d="M49.0441 35.3394H45.9844V30.8827H49.0441V31.5706H46.7679V32.7266H48.9977V33.4145H46.7679V34.6515H49.0441V35.3394Z" fill="#262961"/>
        <path d="M52.7122 35.339H52.0099V33.3214C52.0099 32.8766 51.7928 32.6533 51.3605 32.6533C51.1915 32.6533 51.0325 32.6963 50.885 32.7807C50.7376 32.865 50.62 32.9676 50.5305 33.0883V35.3406H49.8281V32.1126H50.5305V32.5541C50.6515 32.4119 50.8121 32.2895 51.0126 32.187C51.213 32.0845 51.4317 32.0332 51.6686 32.0332C52.0115 32.0332 52.2716 32.1225 52.4488 32.3011C52.6244 32.4797 52.7139 32.736 52.7139 33.0701V35.339H52.7122Z" fill="#262961"/>
        <path d="M54.9327 36.6485C54.3844 36.6485 53.9338 36.4881 53.5809 36.1673L53.9089 35.6596C54.1508 35.9358 54.492 36.0747 54.9327 36.0747C55.201 36.0747 55.4263 36.0052 55.6119 35.8647C55.7974 35.7241 55.8902 35.5025 55.8902 35.1999V34.8129C55.6135 35.1701 55.2673 35.3471 54.8532 35.3471C54.4291 35.3471 54.0845 35.1999 53.8195 34.9055C53.5544 34.6112 53.4219 34.206 53.4219 33.69C53.4219 33.1774 53.5544 32.7739 53.8195 32.4779C54.0845 32.1819 54.4291 32.033 54.8532 32.033C55.2773 32.033 55.6235 32.2083 55.8902 32.5606V32.1124H56.5926V35.1734C56.5926 35.4496 56.5445 35.6894 56.4485 35.8911C56.3524 36.0945 56.2215 36.2467 56.0575 36.3525C55.8918 36.4567 55.7179 36.5328 55.5324 36.5791C55.3468 36.6254 55.148 36.6485 54.9327 36.6485ZM55.0602 34.7236C55.2209 34.7236 55.38 34.6806 55.5357 34.5963C55.6914 34.5119 55.8107 34.4094 55.8902 34.2887V33.0864C55.8107 32.9657 55.6914 32.8632 55.5357 32.7788C55.38 32.6945 55.2209 32.6515 55.0602 32.6515C54.7836 32.6515 54.5633 32.7458 54.3976 32.9359C54.2319 33.1261 54.1491 33.3758 54.1491 33.6884C54.1491 34.0009 54.2319 34.2506 54.3976 34.4408C54.5633 34.6293 54.7836 34.7236 55.0602 34.7236Z" fill="#262961"/>
        <path d="M58.2024 35.3396H57.5V30.8828H58.2024V35.3396Z" fill="#262961"/>
        <path d="M59.4669 31.7174C59.351 31.7174 59.2499 31.6745 59.1621 31.5901C59.0743 31.5058 59.0312 31.4032 59.0312 31.2825C59.0312 31.1618 59.0743 31.0593 59.1621 30.9749C59.2483 30.8906 59.351 30.8476 59.4669 30.8476C59.5879 30.8476 59.6906 30.8906 59.7751 30.9749C59.8595 31.0593 59.9026 31.1618 59.9026 31.2825C59.9026 31.4032 59.8595 31.5058 59.7751 31.5901C59.6906 31.6745 59.5879 31.7174 59.4669 31.7174ZM59.8214 35.3391H59.119V32.111H59.8214V35.3391Z" fill="#262961"/>
        <path d="M61.838 35.4176C61.2582 35.4176 60.796 35.2505 60.4531 34.9165L60.7745 34.4088C60.8954 34.5328 61.0578 34.6403 61.2632 34.7296C61.4686 34.8189 61.6707 34.8636 61.8728 34.8636C62.0782 34.8636 62.2356 34.8239 62.3449 34.7429C62.4543 34.6635 62.5089 34.5576 62.5089 34.4286C62.5089 34.3129 62.4427 34.2219 62.3085 34.1574C62.1743 34.0929 62.012 34.0417 61.8198 34.0036C61.6276 33.9656 61.4355 33.9193 61.2433 33.8631C61.0512 33.8069 60.8888 33.7076 60.7546 33.5654C60.6204 33.4232 60.5542 33.238 60.5542 33.0114C60.5542 32.7352 60.6685 32.5021 60.8954 32.3135C61.1224 32.125 61.4338 32.0291 61.8264 32.0291C62.3218 32.0291 62.7409 32.1813 63.0854 32.4839L62.7906 32.9783C62.6879 32.8626 62.552 32.7683 62.3814 32.6972C62.2124 32.6261 62.0285 32.5897 61.8331 32.5897C61.6508 32.5897 61.5034 32.6261 61.3941 32.7005C61.2847 32.7733 61.2301 32.8692 61.2301 32.985C61.2301 33.0743 61.2781 33.147 61.3742 33.2016C61.4703 33.2578 61.5912 33.2992 61.7353 33.3256C61.8811 33.3521 62.0368 33.3885 62.2074 33.4364C62.3764 33.4827 62.5338 33.5373 62.6796 33.6001C62.8254 33.663 62.9446 33.7639 63.0407 33.9044C63.1368 34.045 63.1848 34.2153 63.1848 34.4154C63.1848 34.7098 63.0672 34.9496 62.8303 35.1364C62.5918 35.325 62.2621 35.4176 61.838 35.4176Z" fill="#262961"/>
        <path d="M66.7814 35.3399H66.079V33.3091C66.079 33.0726 66.0227 32.9056 65.9083 32.8047C65.794 32.7038 65.6334 32.6542 65.423 32.6542C65.2573 32.6542 65.1016 32.6972 64.9542 32.7816C64.8067 32.8659 64.6858 32.9684 64.593 33.0892V35.3415H63.8906V30.8848H64.593V32.555C64.7139 32.4128 64.8746 32.2904 65.0784 32.1879C65.2822 32.0854 65.5008 32.0341 65.7377 32.0341C66.4335 32.0341 66.7814 32.3748 66.7814 33.0561V35.3399Z" fill="#262961"/>
        <path d="M70.2843 35.339H69.582V32.7261H69.0469V32.111H69.582V31.9307C69.582 31.5834 69.6747 31.3106 69.8603 31.1121C70.0458 30.9137 70.2943 30.8145 70.6074 30.8145C70.942 30.8145 71.2004 30.9087 71.3843 31.0956L71.1093 31.5305C71.0066 31.4362 70.8824 31.3899 70.7349 31.3899C70.5958 31.3899 70.4864 31.4362 70.4069 31.5272C70.3274 31.6182 70.286 31.7538 70.286 31.9307V32.111H70.942V32.7261H70.286V35.339H70.2843Z" fill="#262961"/>
        <path d="M72.9333 35.4179C72.433 35.4179 72.0322 35.2542 71.729 34.9267C71.4258 34.5993 71.2734 34.1974 71.2734 33.7212C71.2734 33.2449 71.4258 32.843 71.729 32.5189C72.0322 32.1931 72.4347 32.0311 72.9333 32.0311C73.4369 32.0311 73.8411 32.1931 74.1443 32.5189C74.4475 32.8447 74.5999 33.2449 74.5999 33.7212C74.5999 34.2024 74.4475 34.6059 74.1443 34.93C73.8428 35.2558 73.4386 35.4179 72.9333 35.4179ZM72.9333 34.7977C73.2232 34.7977 73.4518 34.6935 73.6192 34.4868C73.7865 34.2801 73.871 34.0254 73.871 33.7212C73.871 33.4235 73.7865 33.1705 73.6192 32.9621C73.4518 32.7554 73.2232 32.6512 72.9333 32.6512C72.6484 32.6512 72.4214 32.7554 72.2541 32.9621C72.0868 33.1688 72.0023 33.4218 72.0023 33.7212C72.0023 34.0238 72.0852 34.2785 72.2541 34.4868C72.4214 34.6935 72.6484 34.7977 72.9333 34.7977Z" fill="#262961"/>
        <path d="M76.0149 35.3377H75.3125V32.1097H76.0149V32.5843C76.1391 32.4239 76.2965 32.2933 76.4837 32.1907C76.6709 32.0882 76.8647 32.0369 77.0668 32.0369V32.7315C77.0039 32.7183 76.931 32.7116 76.8465 32.7116C76.6991 32.7116 76.5417 32.7546 76.3744 32.8423C76.2071 32.9299 76.0878 33.0292 76.0165 33.14V35.3377H76.0149Z" fill="#262961"/>
        <path d="M80.1586 35.3394H79.375V30.8827H80.1586V35.3394Z" fill="#262961"/>
        <path d="M82.9556 35.3394H82.1721V31.5706H80.8203V30.8827H84.3074V31.5706H82.9556V35.3394Z" fill="#262961"/>
        <path d="M90.4164 35.339H89.4986C89.4009 35.2547 89.2684 35.1257 89.1044 34.952C88.7333 35.2646 88.3158 35.42 87.852 35.42C87.4329 35.42 87.0883 35.3092 86.8183 35.0893C86.5482 34.8694 86.4141 34.5551 86.4141 34.15C86.4141 33.8374 86.5002 33.5828 86.6725 33.3843C86.8448 33.1859 87.0817 33.0073 87.3848 32.8469C87.1744 32.4731 87.0701 32.1473 87.0701 31.8712C87.0701 31.5685 87.1844 31.3172 87.4146 31.1154C87.6449 30.9137 87.9332 30.8145 88.281 30.8145C88.5974 30.8145 88.8608 30.8971 89.0712 31.0625C89.2816 31.2279 89.386 31.4495 89.386 31.7306C89.386 31.891 89.3562 32.0365 89.2982 32.1655C89.2402 32.2945 89.1491 32.4103 89.0265 32.5095C88.9039 32.6104 88.7896 32.6898 88.6852 32.751C88.5809 32.8121 88.4417 32.8832 88.2661 32.9676C88.3953 33.1462 88.5428 33.3281 88.7084 33.515C88.8741 33.7151 89.0215 33.8871 89.1507 34.0293C89.3479 33.7217 89.4937 33.4124 89.5931 33.0999L90.1696 33.3612C89.9592 33.8192 89.7521 34.188 89.5467 34.4642C89.7918 34.7271 90.0818 35.0182 90.4164 35.339ZM87.9398 34.8578C88.2081 34.8578 88.4649 34.7536 88.7101 34.5436C88.4285 34.2409 88.2463 34.0359 88.1618 33.9284C87.9746 33.7018 87.8089 33.4869 87.6664 33.2868C87.3318 33.505 87.1645 33.7729 87.1645 34.0888C87.1645 34.3253 87.2407 34.5122 87.3915 34.6494C87.5422 34.7883 87.7261 34.8578 87.9398 34.8578ZM87.7791 31.8844C87.7791 32.0762 87.8536 32.3011 87.9994 32.5591C88.2496 32.4434 88.4384 32.3259 88.5676 32.2052C88.6968 32.0845 88.7615 31.9373 88.7615 31.7637C88.7615 31.6297 88.7184 31.5255 88.6339 31.4495C88.5494 31.3734 88.4417 31.3354 88.3125 31.3354C88.1601 31.3354 88.0342 31.3866 87.9315 31.4892C87.8304 31.5917 87.7791 31.724 87.7791 31.8844Z" fill="#262961"/>
        <path d="M94.975 35.3396H92.7188V30.8828H94.9137C95.3113 30.8828 95.6227 30.9903 95.848 31.2069C96.0733 31.4236 96.186 31.6931 96.186 32.0189C96.186 32.2868 96.1114 32.5117 95.9623 32.6969C95.8133 32.8822 95.6294 32.9963 95.4107 33.0409C95.6509 33.0773 95.8563 33.1997 96.0236 33.4113C96.191 33.623 96.2754 33.8645 96.2754 34.1357C96.2754 34.4929 96.1611 34.7823 95.9309 35.0039C95.699 35.2288 95.3809 35.3396 94.975 35.3396ZM94.7547 32.7267C94.9518 32.7267 95.1059 32.6738 95.2169 32.5663C95.3279 32.4588 95.3842 32.3215 95.3842 32.1512C95.3842 31.9776 95.3279 31.837 95.2169 31.7295C95.1059 31.622 94.9518 31.5691 94.7547 31.5691H93.5023V32.725H94.7547V32.7267ZM94.7878 34.6516C95.0015 34.6516 95.1688 34.5971 95.2898 34.4879C95.4107 34.3788 95.4703 34.2266 95.4703 34.0298C95.4703 33.8562 95.4107 33.7107 95.2898 33.5916C95.1688 33.4742 95.0015 33.4146 94.7878 33.4146H93.5023V34.6516H94.7878Z" fill="#262961"/>
        <path d="M99.931 35.3391H99.2286V34.9108C98.9254 35.2498 98.5428 35.4185 98.0839 35.4185C97.3914 35.4185 97.0469 35.0778 97.0469 34.3965V32.111H97.7493V34.1418C97.7493 34.3783 97.8056 34.5453 97.9166 34.6462C98.0276 34.747 98.1883 34.7967 98.3986 34.7967C98.5676 34.7967 98.7266 34.757 98.8741 34.6759C99.0215 34.5966 99.1391 34.4957 99.2286 34.375V32.1094H99.931V35.3391Z" fill="#262961"/>
        <path d="M101.947 35.4178C101.368 35.4178 100.905 35.2507 100.562 34.9167L100.884 34.409C101.005 34.533 101.167 34.6405 101.373 34.7298C101.578 34.8191 101.78 34.8638 101.982 34.8638C102.188 34.8638 102.345 34.8241 102.454 34.743C102.564 34.6637 102.618 34.5578 102.618 34.4288C102.618 34.3131 102.552 34.2221 102.418 34.1576C102.284 34.0931 102.121 34.0419 101.929 34.0038C101.737 33.9658 101.545 33.9195 101.354 33.8633C101.162 33.807 101 33.7078 100.866 33.5656C100.731 33.4234 100.665 33.2382 100.665 33.0116C100.665 32.7354 100.78 32.5023 101.006 32.3137C101.233 32.1252 101.545 32.0293 101.937 32.0293C102.433 32.0293 102.852 32.1814 103.196 32.4841L102.902 32.9785C102.799 32.8628 102.663 32.7685 102.494 32.6974C102.325 32.6263 102.141 32.5899 101.946 32.5899C101.764 32.5899 101.616 32.6263 101.507 32.7007C101.397 32.7735 101.343 32.8694 101.343 32.9851C101.343 33.0744 101.391 33.1472 101.487 33.2018C101.583 33.258 101.704 33.2993 101.848 33.3258C101.994 33.3523 102.151 33.3886 102.32 33.4366C102.489 33.4846 102.646 33.5375 102.792 33.6003C102.938 33.6632 103.057 33.764 103.153 33.9046C103.249 34.0452 103.298 34.2155 103.298 34.4156C103.298 34.71 103.18 34.9498 102.943 35.1366C102.701 35.3251 102.371 35.4178 101.947 35.4178Z" fill="#262961"/>
        <path d="M104.342 31.7175C104.226 31.7175 104.125 31.6745 104.037 31.5902C103.949 31.5058 103.906 31.4033 103.906 31.2826C103.906 31.1619 103.949 31.0593 104.037 30.975C104.125 30.8907 104.226 30.8477 104.342 30.8477C104.463 30.8477 104.566 30.8907 104.65 30.975C104.735 31.0593 104.778 31.1619 104.778 31.2826C104.778 31.4033 104.735 31.5058 104.65 31.5902C104.566 31.6745 104.463 31.7175 104.342 31.7175ZM104.696 35.3391H103.994V32.1111H104.696V35.3391Z" fill="#262961"/>
        <path d="M108.493 35.3388H107.791V33.3213C107.791 32.8764 107.574 32.6532 107.142 32.6532C106.973 32.6532 106.814 32.6962 106.666 32.7805C106.519 32.8648 106.401 32.9674 106.312 33.0881V35.3404H105.609V32.1124H106.312V32.5539C106.433 32.4117 106.593 32.2893 106.794 32.1868C106.994 32.0843 107.213 32.033 107.45 32.033C107.793 32.033 108.053 32.1223 108.23 32.3009C108.406 32.4795 108.495 32.7358 108.495 33.0699V35.3388H108.493Z" fill="#262961"/>
        <path d="M110.896 35.4176C110.406 35.4176 110 35.2605 109.682 34.9463C109.362 34.6321 109.203 34.2236 109.203 33.7192C109.203 33.2479 109.359 32.8477 109.669 32.5203C109.978 32.1928 110.371 32.0291 110.843 32.0291C111.32 32.0291 111.706 32.1945 111.998 32.5236C112.289 32.8527 112.437 33.2744 112.437 33.787V33.954H109.94C109.967 34.2087 110.071 34.4204 110.255 34.5891C110.437 34.7577 110.677 34.8437 110.971 34.8437C111.136 34.8437 111.302 34.8123 111.469 34.7495C111.637 34.6866 111.776 34.6006 111.888 34.4882L112.21 34.9496C111.883 35.2621 111.446 35.4176 110.896 35.4176ZM111.754 33.4596C111.746 33.2363 111.663 33.0379 111.511 32.8642C111.357 32.6906 111.135 32.6029 110.845 32.6029C110.568 32.6029 110.351 32.6889 110.195 32.8609C110.04 33.0329 109.952 33.2314 109.934 33.4596H111.754Z" fill="#262961"/>
        <path d="M114.244 35.4178C113.664 35.4178 113.202 35.2507 112.859 34.9167L113.181 34.409C113.302 34.533 113.464 34.6405 113.669 34.7298C113.875 34.8191 114.077 34.8638 114.279 34.8638C114.484 34.8638 114.642 34.8241 114.751 34.743C114.861 34.6637 114.915 34.5578 114.915 34.4288C114.915 34.3131 114.849 34.2221 114.715 34.1576C114.581 34.0931 114.418 34.0419 114.226 34.0038C114.034 33.9658 113.842 33.9195 113.651 33.8633C113.459 33.807 113.297 33.7078 113.163 33.5656C113.028 33.4234 112.962 33.2382 112.962 33.0116C112.962 32.7354 113.076 32.5023 113.303 32.3137C113.53 32.1252 113.842 32.0293 114.234 32.0293C114.73 32.0293 115.149 32.1814 115.493 32.4841L115.198 32.9785C115.096 32.8628 114.96 32.7685 114.791 32.6974C114.622 32.6263 114.438 32.5899 114.243 32.5899C114.06 32.5899 113.913 32.6263 113.804 32.7007C113.694 32.7735 113.64 32.8694 113.64 32.9851C113.64 33.0744 113.688 33.1472 113.784 33.2018C113.88 33.258 114.001 33.2993 114.145 33.3258C114.291 33.3523 114.448 33.3886 114.617 33.4366C114.786 33.4846 114.943 33.5375 115.089 33.6003C115.235 33.6632 115.354 33.764 115.45 33.9046C115.546 34.0452 115.594 34.2155 115.594 34.4156C115.594 34.71 115.477 34.9498 115.24 35.1366C114.998 35.3251 114.668 35.4178 114.244 35.4178Z" fill="#262961"/>
        <path d="M117.401 35.4178C116.821 35.4178 116.359 35.2507 116.016 34.9167L116.337 34.409C116.458 34.533 116.62 34.6405 116.826 34.7298C117.031 34.8191 117.233 34.8638 117.435 34.8638C117.641 34.8638 117.798 34.8241 117.907 34.743C118.017 34.6637 118.071 34.5578 118.071 34.4288C118.071 34.3131 118.005 34.2221 117.871 34.1576C117.737 34.0931 117.574 34.0419 117.382 34.0038C117.19 33.9658 116.998 33.9195 116.807 33.8633C116.615 33.807 116.453 33.7078 116.319 33.5656C116.185 33.4234 116.118 33.2382 116.118 33.0116C116.118 32.7354 116.233 32.5023 116.46 32.3137C116.687 32.1252 116.998 32.0293 117.391 32.0293C117.886 32.0293 118.305 32.1814 118.65 32.4841L118.355 32.9785C118.252 32.8628 118.116 32.7685 117.947 32.6974C117.778 32.6263 117.594 32.5899 117.399 32.5899C117.217 32.5899 117.069 32.6263 116.96 32.7007C116.851 32.7735 116.796 32.8694 116.796 32.9851C116.796 33.0744 116.844 33.1472 116.94 33.2018C117.036 33.258 117.157 33.2993 117.301 33.3258C117.447 33.3523 117.604 33.3886 117.773 33.4366C117.942 33.4846 118.1 33.5375 118.245 33.6003C118.391 33.6632 118.51 33.764 118.607 33.9046C118.703 34.0452 118.751 34.2155 118.751 34.4156C118.751 34.71 118.633 34.9498 118.396 35.1366C118.154 35.3251 117.825 35.4178 117.401 35.4178Z" fill="#262961"/>
      </svg>
      <?php /*echo $login_header_text; */?>
    </a>
  </h1>
	<?php
		/**
		 * Filters the message to display above the login form.
		 *
		 * @since 2.1.0
		 *
		 * @param string $message Login message text.
		 */
		$message = apply_filters( 'login_message', $message );

		if ( ! empty( $message ) ) {
			echo $message . "\n";
		}

		// In case a plugin uses $error rather than the $wp_errors object.
		if ( ! empty( $error ) ) {
			$wp_error->add( 'error', $error );
			unset( $error );
		}

		if ( $wp_error->has_errors() ) {
			$errors   = '';
			$messages = '';

			foreach ( $wp_error->get_error_codes() as $code ) {
				$severity = $wp_error->get_error_data( $code );
				foreach ( $wp_error->get_error_messages( $code ) as $error_message ) {
					if ( 'message' === $severity ) {
						$messages .= '	' . $error_message . "<br />\n";
					} else {
						$errors .= '	' . $error_message . "<br />\n";
					}
				}
			}

			if ( ! empty( $errors ) ) {
				/**
				 * Filters the error messages displayed above the login form.
				 *
				 * @since 2.1.0
				 *
				 * @param string $errors Login error message.
				 */
				echo '<div id="login_error">' . apply_filters( 'login_errors', $errors ) . "</div>\n";
			}

			if ( ! empty( $messages ) ) {
				/**
				 * Filters instructional messages displayed above the login form.
				 *
				 * @since 2.5.0
				 *
				 * @param string $messages Login messages.
				 */
				echo '<p class="message" id="login-message">' . apply_filters( 'login_messages', $messages ) . "</p>\n";
			}
		}
		} // End of login_header().

		/**
		 * Outputs the footer for the login page.
		 *
		 * @since 3.1.0
		 *
		 * @global bool|string $interim_login Whether interim login modal is being displayed. String 'success'
		 *                                    upon successful login.
		 *
		 * @param string $input_id Which input to auto-focus.
		 */
		function login_footer( $input_id = '' ) {
		global $interim_login;

		// Don't allow interim logins to navigate away from the page.
		if ( ! $interim_login ) {
			?>
			<p id="backtoblog">
				<?php
					$html_link = sprintf(
						'<a href="%s">%s</a>',
						esc_url( home_url( '/' ) ),
						sprintf(
						/* translators: %s: Site title. */
							_x( '&larr; Go to %s', 'site' ),
							get_bloginfo( 'title', 'display' )
						)
					);
					/**
					 * Filter the "Go to site" link displayed in the login page footer.
					 *
					 * @since 5.7.0
					 *
					 * @param string $link HTML link to the home URL of the current site.
					 */
					echo apply_filters( 'login_site_html_link', $html_link );
				?>
			</p>
			<?php

			the_privacy_policy_link( '<div class="privacy-policy-page-link">', '</div>' );
		}

	?>
</div><?php // End of <div id="login">. ?>

<?php
	if (
		! $interim_login &&
		/**
		 * Filters the Languages select input activation on the login screen.
		 *
		 * @since 5.9.0
		 *
		 * @param bool Whether to display the Languages select input on the login screen.
		 */
		apply_filters( 'login_display_language_dropdown', true )
	) {
		$languages = get_available_languages();

		if ( ! empty( $languages ) ) {
			?>
			<div class="language-switcher">
				<form id="language-switcher" action="" method="get">

					<label for="language-switcher-locales">
						<span class="dashicons dashicons-translation" aria-hidden="true"></span>
						<span class="screen-reader-text">
							<?php
								/* translators: Hidden accessibility text. */
								_e( 'Language' );
							?>
						</span>
					</label>

					<?php
						$args = array(
							'id'                          => 'language-switcher-locales',
							'name'                        => 'wp_lang',
							'selected'                    => determine_locale(),
							'show_available_translations' => false,
							'explicit_option_en_us'       => true,
							'languages'                   => $languages,
						);

						/**
						 * Filters default arguments for the Languages select input on the login screen.
						 *
						 * The arguments get passed to the wp_dropdown_languages() function.
						 *
						 * @since 5.9.0
						 *
						 * @param array $args Arguments for the Languages select input on the login screen.
						 */
						wp_dropdown_languages( apply_filters( 'login_language_dropdown_args', $args ) );
					?>

					<?php if ( $interim_login ) { ?>
						<input type="hidden" name="interim-login" value="1" />
					<?php } ?>

					<?php if ( isset( $_GET['redirect_to'] ) && '' !== $_GET['redirect_to'] ) { ?>
						<input type="hidden" name="redirect_to" value="<?php echo sanitize_url( $_GET['redirect_to'] ); ?>" />
					<?php } ?>

					<?php if ( isset( $_GET['action'] ) && '' !== $_GET['action'] ) { ?>
						<input type="hidden" name="action" value="<?php echo esc_attr( $_GET['action'] ); ?>" />
					<?php } ?>

					<input type="submit" class="button" value="<?php esc_attr_e( 'Change' ); ?>">

				</form>
			</div>
		<?php } ?>
	<?php } ?>
<?php

	if ( ! empty( $input_id ) ) {
		?>
		<script type="text/javascript">
      try{document.getElementById('<?php echo $input_id; ?>').focus();}catch(e){}
      if(typeof wpOnload==='function')wpOnload();
		</script>
		<?php
	}

	/**
	 * Fires in the login page footer.
	 *
	 * @since 3.1.0
	 */
	do_action( 'login_footer' );

?>
<div class="clear"></div>
</body>
</html>
<?php
	}

	/**
	 * Outputs the JavaScript to handle the form shaking on the login page.
	 *
	 * @since 3.0.0
	 */
	function wp_shake_js() {
		?>
		<script type="text/javascript">
      document.querySelector('form').classList.add('shake');
		</script>
		<?php
	}

	/**
	 * Outputs the viewport meta tag for the login page.
	 *
	 * @since 3.7.0
	 */
	function wp_login_viewport_meta() {
		?>
		<meta name="viewport" content="width=device-width" />
		<?php
	}

	/*
	 * Main part.
	 *
	 * Check the request and redirect or display a form based on the current action.
	 */

	$action = isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : 'login';
	$errors = new WP_Error();

	if ( isset( $_GET['key'] ) ) {
		$action = 'resetpass';
	}

	if ( isset( $_GET['checkemail'] ) ) {
		$action = 'checkemail';
	}

	$default_actions = array(
		'confirm_admin_email',
		'postpass',
		'logout',
		'lostpassword',
		'retrievepassword',
		'resetpass',
		'rp',
		'register',
		'checkemail',
		'confirmaction',
		'login',
		WP_Recovery_Mode_Link_Service::LOGIN_ACTION_ENTERED,
	);

	// Validate action so as to default to the login screen.
	if ( ! in_array( $action, $default_actions, true ) && false === has_filter( 'login_form_' . $action ) ) {
		$action = 'login';
	}

	nocache_headers();

	header( 'Content-Type: ' . get_bloginfo( 'html_type' ) . '; charset=' . get_bloginfo( 'charset' ) );

	if ( defined( 'RELOCATE' ) && RELOCATE ) { // Move flag is set.
		if ( isset( $_SERVER['PATH_INFO'] ) && ( $_SERVER['PATH_INFO'] !== $_SERVER['PHP_SELF'] ) ) {
			$_SERVER['PHP_SELF'] = str_replace( $_SERVER['PATH_INFO'], '', $_SERVER['PHP_SELF'] );
		}

		$url = dirname( set_url_scheme( 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ) );

		if ( get_option( 'siteurl' ) !== $url ) {
			update_option( 'siteurl', $url );
		}
	}

	// Set a cookie now to see if they are supported by the browser.
	$secure = ( 'https' === parse_url( wp_login_url(), PHP_URL_SCHEME ) );
	setcookie( TEST_COOKIE, 'WP Cookie check', 0, COOKIEPATH, COOKIE_DOMAIN, $secure );

	if ( SITECOOKIEPATH !== COOKIEPATH ) {
		setcookie( TEST_COOKIE, 'WP Cookie check', 0, SITECOOKIEPATH, COOKIE_DOMAIN, $secure );
	}

	if ( isset( $_GET['wp_lang'] ) ) {
		setcookie( 'wp_lang', sanitize_text_field( $_GET['wp_lang'] ), 0, COOKIEPATH, COOKIE_DOMAIN, $secure );
	}

	/**
	 * Fires when the login form is initialized.
	 *
	 * @since 3.2.0
	 */
	do_action( 'login_init' );

	/**
	 * Fires before a specified login form action.
	 *
	 * The dynamic portion of the hook name, `$action`, refers to the action
	 * that brought the visitor to the login form.
	 *
	 * Possible hook names include:
	 *
	 *  - `login_form_checkemail`
	 *  - `login_form_confirm_admin_email`
	 *  - `login_form_confirmaction`
	 *  - `login_form_entered_recovery_mode`
	 *  - `login_form_login`
	 *  - `login_form_logout`
	 *  - `login_form_lostpassword`
	 *  - `login_form_postpass`
	 *  - `login_form_register`
	 *  - `login_form_resetpass`
	 *  - `login_form_retrievepassword`
	 *  - `login_form_rp`
	 *
	 * @since 2.8.0
	 */
	do_action( "login_form_{$action}" );

	$http_post     = ( 'POST' === $_SERVER['REQUEST_METHOD'] );
	$interim_login = isset( $_REQUEST['interim-login'] );

	/**
	 * Filters the separator used between login form navigation links.
	 *
	 * @since 4.9.0
	 *
	 * @param string $login_link_separator The separator used between login form navigation links.
	 */
	$login_link_separator = apply_filters( 'login_link_separator', ' | ' );

	switch ( $action ) {

		case 'confirm_admin_email':
			/*
			 * Note that `is_user_logged_in()` will return false immediately after logging in
			 * as the current user is not set, see wp-includes/pluggable.php.
			 * However this action runs on a redirect after logging in.
			 */
			if ( ! is_user_logged_in() ) {
				wp_safe_redirect( wp_login_url() );
				exit;
			}

			if ( ! empty( $_REQUEST['redirect_to'] ) ) {
				$redirect_to = $_REQUEST['redirect_to'];
			} else {
				$redirect_to = admin_url();
			}

			if ( current_user_can( 'manage_options' ) ) {
				$admin_email = get_option( 'admin_email' );
			} else {
				wp_safe_redirect( $redirect_to );
				exit;
			}

			/**
			 * Filters the interval for dismissing the admin email confirmation screen.
			 *
			 * If `0` (zero) is returned, the "Remind me later" link will not be displayed.
			 *
			 * @since 5.3.1
			 *
			 * @param int $interval Interval time (in seconds). Default is 3 days.
			 */
			$remind_interval = (int) apply_filters( 'admin_email_remind_interval', 3 * DAY_IN_SECONDS );

			if ( ! empty( $_GET['remind_me_later'] ) ) {
				if ( ! wp_verify_nonce( $_GET['remind_me_later'], 'remind_me_later_nonce' ) ) {
					wp_safe_redirect( wp_login_url() );
					exit;
				}

				if ( $remind_interval > 0 ) {
					update_option( 'admin_email_lifespan', time() + $remind_interval );
				}

				$redirect_to = add_query_arg( 'admin_email_remind_later', 1, $redirect_to );
				wp_safe_redirect( $redirect_to );
				exit;
			}

			if ( ! empty( $_POST['correct-admin-email'] ) ) {
				if ( ! check_admin_referer( 'confirm_admin_email', 'confirm_admin_email_nonce' ) ) {
					wp_safe_redirect( wp_login_url() );
					exit;
				}

				/**
				 * Filters the interval for redirecting the user to the admin email confirmation screen.
				 *
				 * If `0` (zero) is returned, the user will not be redirected.
				 *
				 * @since 5.3.0
				 *
				 * @param int $interval Interval time (in seconds). Default is 6 months.
				 */
				$admin_email_check_interval = (int) apply_filters( 'admin_email_check_interval', 6 * MONTH_IN_SECONDS );

				if ( $admin_email_check_interval > 0 ) {
					update_option( 'admin_email_lifespan', time() + $admin_email_check_interval );
				}

				wp_safe_redirect( $redirect_to );
				exit;
			}

			login_header( __( 'Confirm your administration email' ), '', $errors );

			/**
			 * Fires before the admin email confirm form.
			 *
			 * @since 5.3.0
			 *
			 * @param WP_Error $errors A `WP_Error` object containing any errors generated by using invalid
			 *                         credentials. Note that the error object may not contain any errors.
			 */
			do_action( 'admin_email_confirm', $errors );

			?>

			<form class="admin-email-confirm-form" name="admin-email-confirm-form" action="<?php echo esc_url( site_url( 'yu-admin-enter.php?action=confirm_admin_email', 'login_post' ) ); ?>" method="post">
				<?php
					/**
					 * Fires inside the admin-email-confirm-form form tags, before the hidden fields.
					 *
					 * @since 5.3.0
					 */
					do_action( 'admin_email_confirm_form' );

					wp_nonce_field( 'confirm_admin_email', 'confirm_admin_email_nonce' );

				?>
				<input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>" />

				<h1 class="admin-email__heading">
					<?php _e( 'Administration email verification' ); ?>
				</h1>
				<p class="admin-email__details">
					<?php _e( 'Please verify that the <strong>administration email</strong> for this website is still correct.' ); ?>
					<?php

						/* translators: URL to the WordPress help section about admin email. */
						$admin_email_help_url = __( 'https://wordpress.org/documentation/article/settings-general-screen/#email-address' );

						$accessibility_text = sprintf(
							'<span class="screen-reader-text"> %s</span>',
							/* translators: Hidden accessibility text. */
							__( '(opens in a new tab)' )
						);

						printf(
							'<a href="%s" rel="noopener" target="_blank">%s%s</a>',
							esc_url( $admin_email_help_url ),
							__( 'Why is this important?' ),
							$accessibility_text
						);

					?>
				</p>
				<p class="admin-email__details">
					<?php

						printf(
						/* translators: %s: Admin email address. */
							__( 'Current administration email: %s' ),
							'<strong>' . esc_html( $admin_email ) . '</strong>'
						);

					?>
				</p>
				<p class="admin-email__details">
					<?php _e( 'This email may be different from your personal email address.' ); ?>
				</p>

				<div class="admin-email__actions">
					<div class="admin-email__actions-primary">
						<?php

							$change_link = admin_url( 'options-general.php' );
							$change_link = add_query_arg( 'highlight', 'confirm_admin_email', $change_link );

						?>
						<a class="button button-large" href="<?php echo esc_url( $change_link ); ?>"><?php _e( 'Update' ); ?></a>
						<input type="submit" name="correct-admin-email" id="correct-admin-email" class="button button-primary button-large" value="<?php esc_attr_e( 'The email is correct' ); ?>" />
					</div>
					<?php if ( $remind_interval > 0 ) : ?>
						<div class="admin-email__actions-secondary">
							<?php

								$remind_me_link = wp_login_url( $redirect_to );
								$remind_me_link = add_query_arg(
									array(
										'action'          => 'confirm_admin_email',
										'remind_me_later' => wp_create_nonce( 'remind_me_later_nonce' ),
									),
									$remind_me_link
								);

							?>
							<a href="<?php echo esc_url( $remind_me_link ); ?>"><?php _e( 'Remind me later' ); ?></a>
						</div>
					<?php endif; ?>
				</div>
			</form>

			<?php

			login_footer();
			break;

		case 'postpass':
			if ( ! array_key_exists( 'post_password', $_POST ) ) {
				wp_safe_redirect( wp_get_referer() );
				exit;
			}

			require_once ABSPATH . WPINC . '/class-phpass.php';
			$hasher = new PasswordHash( 8, true );

			/**
			 * Filters the life span of the post password cookie.
			 *
			 * By default, the cookie expires 10 days from creation. To turn this
			 * into a session cookie, return 0.
			 *
			 * @since 3.7.0
			 *
			 * @param int $expires The expiry time, as passed to setcookie().
			 */
			$expire  = apply_filters( 'post_password_expires', time() + 10 * DAY_IN_SECONDS );
			$referer = wp_get_referer();

			if ( $referer ) {
				$secure = ( 'https' === parse_url( $referer, PHP_URL_SCHEME ) );
			} else {
				$secure = false;
			}

			setcookie( 'wp-postpass_' . COOKIEHASH, $hasher->HashPassword( wp_unslash( $_POST['post_password'] ) ), $expire, COOKIEPATH, COOKIE_DOMAIN, $secure );

			wp_safe_redirect( wp_get_referer() );
			exit;

		case 'logout':
			check_admin_referer( 'log-out' );

			$user = wp_get_current_user();

			wp_logout();

			if ( ! empty( $_REQUEST['redirect_to'] ) ) {
				$redirect_to           = $_REQUEST['redirect_to'];
				$requested_redirect_to = $redirect_to;
			} else {
				$redirect_to = add_query_arg(
					array(
						'loggedout' => 'true',
						'wp_lang'   => get_user_locale( $user ),
					),
					wp_login_url()
				);

				$requested_redirect_to = '';
			}

			/**
			 * Filters the log out redirect URL.
			 *
			 * @since 4.2.0
			 *
			 * @param string  $redirect_to           The redirect destination URL.
			 * @param string  $requested_redirect_to The requested redirect destination URL passed as a parameter.
			 * @param WP_User $user                  The WP_User object for the user that's logging out.
			 */
			$redirect_to = apply_filters( 'logout_redirect', $redirect_to, $requested_redirect_to, $user );

			wp_safe_redirect( $redirect_to );
			exit;

		case 'lostpassword':
		case 'retrievepassword':
			if ( $http_post ) {
				$errors = retrieve_password();

				if ( ! is_wp_error( $errors ) ) {
					$redirect_to = ! empty( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : 'yu-admin-enter.php?checkemail=confirm';
					wp_safe_redirect( $redirect_to );
					exit;
				}
			}

			if ( isset( $_GET['error'] ) ) {
				if ( 'invalidkey' === $_GET['error'] ) {
					$errors->add( 'invalidkey', __( '<strong>Error:</strong> Your password reset link appears to be invalid. Please request a new link below.' ) );
				} elseif ( 'expiredkey' === $_GET['error'] ) {
					$errors->add( 'expiredkey', __( '<strong>Error:</strong> Your password reset link has expired. Please request a new link below.' ) );
				}
			}

			$lostpassword_redirect = ! empty( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : '';
			/**
			 * Filters the URL redirected to after submitting the lostpassword/retrievepassword form.
			 *
			 * @since 3.0.0
			 *
			 * @param string $lostpassword_redirect The redirect destination URL.
			 */
			$redirect_to = apply_filters( 'lostpassword_redirect', $lostpassword_redirect );

			/**
			 * Fires before the lost password form.
			 *
			 * @since 1.5.1
			 * @since 5.1.0 Added the `$errors` parameter.
			 *
			 * @param WP_Error $errors A `WP_Error` object containing any errors generated by using invalid
			 *                         credentials. Note that the error object may not contain any errors.
			 */
			do_action( 'lost_password', $errors );

			login_header( __( 'Lost Password' ), '<p class="message">' . __( 'Please enter your username or email address. You will receive an email message with instructions on how to reset your password.' ) . '</p>', $errors );

			$user_login = '';

			if ( isset( $_POST['user_login'] ) && is_string( $_POST['user_login'] ) ) {
				$user_login = wp_unslash( $_POST['user_login'] );
			}

			?>

			<form name="lostpasswordform" id="lostpasswordform" action="<?php echo esc_url( network_site_url( 'yu-admin-enter.php?action=lostpassword', 'login_post' ) ); ?>" method="post">
				<p>
					<label for="user_login"><?php _e( 'Username or Email Address' ); ?></label>
					<input type="text" name="user_login" id="user_login" class="input" value="<?php echo esc_attr( $user_login ); ?>" size="20" autocapitalize="off" autocomplete="username" />
				</p>
				<?php

					/**
					 * Fires inside the lostpassword form tags, before the hidden fields.
					 *
					 * @since 2.1.0
					 */
					do_action( 'lostpassword_form' );

				?>
				<input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>" />
				<p class="submit">
					<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e( 'Get New Password' ); ?>" />
				</p>
			</form>

			<p id="nav">
				<a href="<?php echo esc_url( wp_login_url() ); ?>"><?php _e( 'Log in' ); ?></a>
				<?php

					if ( get_option( 'users_can_register' ) ) {
						$registration_url = sprintf( '<a href="%s">%s</a>', esc_url( wp_registration_url() ), __( 'Register' ) );

						echo esc_html( $login_link_separator );

						/** This filter is documented in wp-includes/general-template.php */
						echo apply_filters( 'register', $registration_url );
					}

				?>
			</p>
			<?php

			login_footer( 'user_login' );
			break;

		case 'resetpass':
		case 'rp':
			list( $rp_path ) = explode( '?', wp_unslash( $_SERVER['REQUEST_URI'] ) );
			$rp_cookie       = 'wp-resetpass-' . COOKIEHASH;

			if ( isset( $_GET['key'] ) && isset( $_GET['login'] ) ) {
				$value = sprintf( '%s:%s', wp_unslash( $_GET['login'] ), wp_unslash( $_GET['key'] ) );
				setcookie( $rp_cookie, $value, 0, $rp_path, COOKIE_DOMAIN, is_ssl(), true );

				wp_safe_redirect( remove_query_arg( array( 'key', 'login' ) ) );
				exit;
			}

			if ( isset( $_COOKIE[ $rp_cookie ] ) && 0 < strpos( $_COOKIE[ $rp_cookie ], ':' ) ) {
				list( $rp_login, $rp_key ) = explode( ':', wp_unslash( $_COOKIE[ $rp_cookie ] ), 2 );

				$user = check_password_reset_key( $rp_key, $rp_login );

				if ( isset( $_POST['pass1'] ) && ! hash_equals( $rp_key, $_POST['rp_key'] ) ) {
					$user = false;
				}
			} else {
				$user = false;
			}

			if ( ! $user || is_wp_error( $user ) ) {
				setcookie( $rp_cookie, ' ', time() - YEAR_IN_SECONDS, $rp_path, COOKIE_DOMAIN, is_ssl(), true );

				if ( $user && $user->get_error_code() === 'expired_key' ) {
					wp_redirect( site_url( 'yu-admin-enter.php?action=lostpassword&error=expiredkey' ) );
				} else {
					wp_redirect( site_url( 'yu-admin-enter.php?action=lostpassword&error=invalidkey' ) );
				}

				exit;
			}

			$errors = new WP_Error();

			// Check if password is one or all empty spaces.
			if ( ! empty( $_POST['pass1'] ) ) {
				$_POST['pass1'] = trim( $_POST['pass1'] );

				if ( empty( $_POST['pass1'] ) ) {
					$errors->add( 'password_reset_empty_space', __( 'The password cannot be a space or all spaces.' ) );
				}
			}

			// Check if password fields do not match.
			if ( ! empty( $_POST['pass1'] ) && trim( $_POST['pass2'] ) !== $_POST['pass1'] ) {
				$errors->add( 'password_reset_mismatch', __( '<strong>Error:</strong> The passwords do not match.' ) );
			}

			/**
			 * Fires before the password reset procedure is validated.
			 *
			 * @since 3.5.0
			 *
			 * @param WP_Error         $errors WP Error object.
			 * @param WP_User|WP_Error $user   WP_User object if the login and reset key match. WP_Error object otherwise.
			 */
			do_action( 'validate_password_reset', $errors, $user );

			if ( ( ! $errors->has_errors() ) && isset( $_POST['pass1'] ) && ! empty( $_POST['pass1'] ) ) {
				reset_password( $user, $_POST['pass1'] );
				setcookie( $rp_cookie, ' ', time() - YEAR_IN_SECONDS, $rp_path, COOKIE_DOMAIN, is_ssl(), true );
				login_header( __( 'Password Reset' ), '<p class="message reset-pass">' . __( 'Your password has been reset.' ) . ' <a href="' . esc_url( wp_login_url() ) . '">' . __( 'Log in' ) . '</a></p>' );
				login_footer();
				exit;
			}

			wp_enqueue_script( 'utils' );
			wp_enqueue_script( 'user-profile' );

			login_header( __( 'Reset Password' ), '<p class="message reset-pass">' . __( 'Enter your new password below or generate one.' ) . '</p>', $errors );

			?>
			<form name="resetpassform" id="resetpassform" action="<?php echo esc_url( network_site_url( 'yu-admin-enter.php?action=resetpass', 'login_post' ) ); ?>" method="post" autocomplete="off">
				<input type="hidden" id="user_login" value="<?php echo esc_attr( $rp_login ); ?>" autocomplete="off" />

				<div class="user-pass1-wrap">
					<p>
						<label for="pass1"><?php _e( 'New password' ); ?></label>
					</p>

					<div class="wp-pwd">
						<input type="password" name="pass1" id="pass1" class="input password-input" size="24" value="" autocomplete="new-password" spellcheck="false" data-reveal="1" data-pw="<?php echo esc_attr( wp_generate_password( 16 ) ); ?>" aria-describedby="pass-strength-result" />

						<button type="button" class="button button-secondary wp-hide-pw hide-if-no-js" data-toggle="0" aria-label="<?php esc_attr_e( 'Hide password' ); ?>">
							<span class="dashicons dashicons-hidden" aria-hidden="true"></span>
						</button>
						<div id="pass-strength-result" class="hide-if-no-js" aria-live="polite"><?php _e( 'Strength indicator' ); ?></div>
					</div>
					<div class="pw-weak">
						<input type="checkbox" name="pw_weak" id="pw-weak" class="pw-checkbox" />
						<label for="pw-weak"><?php _e( 'Confirm use of weak password' ); ?></label>
					</div>
				</div>

				<p class="user-pass2-wrap">
					<label for="pass2"><?php _e( 'Confirm new password' ); ?></label>
					<input type="password" name="pass2" id="pass2" class="input" size="20" value="" autocomplete="new-password" spellcheck="false" />
				</p>

				<p class="description indicator-hint"><?php echo wp_get_password_hint(); ?></p>
				<br class="clear" />

				<?php

					/**
					 * Fires following the 'Strength indicator' meter in the user password reset form.
					 *
					 * @since 3.9.0
					 *
					 * @param WP_User $user User object of the user whose password is being reset.
					 */
					do_action( 'resetpass_form', $user );

				?>
				<input type="hidden" name="rp_key" value="<?php echo esc_attr( $rp_key ); ?>" />
				<p class="submit reset-pass-submit">
					<button type="button" class="button wp-generate-pw hide-if-no-js skip-aria-expanded"><?php _e( 'Generate Password' ); ?></button>
					<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e( 'Save Password' ); ?>" />
				</p>
			</form>

			<p id="nav">
				<a href="<?php echo esc_url( wp_login_url() ); ?>"><?php _e( 'Log in' ); ?></a>
				<?php

					if ( get_option( 'users_can_register' ) ) {
						$registration_url = sprintf( '<a href="%s">%s</a>', esc_url( wp_registration_url() ), __( 'Register' ) );

						echo esc_html( $login_link_separator );

						/** This filter is documented in wp-includes/general-template.php */
						echo apply_filters( 'register', $registration_url );
					}

				?>
			</p>
			<?php

			login_footer( 'pass1' );
			break;

		case 'register':
			if ( is_multisite() ) {
				/**
				 * Filters the Multisite sign up URL.
				 *
				 * @since 3.0.0
				 *
				 * @param string $sign_up_url The sign up URL.
				 */
				wp_redirect( apply_filters( 'wp_signup_location', network_site_url( 'wp-signup.php' ) ) );
				exit;
			}

			if ( ! get_option( 'users_can_register' ) ) {
				wp_redirect( site_url( 'yu-admin-enter.php?registration=disabled' ) );
				exit;
			}

			$user_login = '';
			$user_email = '';

			if ( $http_post ) {
				if ( isset( $_POST['user_login'] ) && is_string( $_POST['user_login'] ) ) {
					$user_login = wp_unslash( $_POST['user_login'] );
				}

				if ( isset( $_POST['user_email'] ) && is_string( $_POST['user_email'] ) ) {
					$user_email = wp_unslash( $_POST['user_email'] );
				}

				$errors = register_new_user( $user_login, $user_email );

				if ( ! is_wp_error( $errors ) ) {
					$redirect_to = ! empty( $_POST['redirect_to'] ) ? $_POST['redirect_to'] : 'yu-admin-enter.php?checkemail=registered';
					wp_safe_redirect( $redirect_to );
					exit;
				}
			}

			$registration_redirect = ! empty( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : '';

			/**
			 * Filters the registration redirect URL.
			 *
			 * @since 3.0.0
			 * @since 5.9.0 Added the `$errors` parameter.
			 *
			 * @param string       $registration_redirect The redirect destination URL.
			 * @param int|WP_Error $errors                User id if registration was successful,
			 *                                            WP_Error object otherwise.
			 */
			$redirect_to = apply_filters( 'registration_redirect', $registration_redirect, $errors );

			login_header( __( 'Registration Form' ), '<p class="message register">' . __( 'Register For This Site' ) . '</p>', $errors );

			?>
			<form name="registerform" id="registerform" action="<?php echo esc_url( site_url( 'yu-admin-enter.php?action=register', 'login_post' ) ); ?>" method="post" novalidate="novalidate">
				<p>
					<label for="user_login"><?php _e( 'Username' ); ?></label>
					<input type="text" name="user_login" id="user_login" class="input" value="<?php echo esc_attr( wp_unslash( $user_login ) ); ?>" size="20" autocapitalize="off" autocomplete="username" />
				</p>
				<p>
					<label for="user_email"><?php _e( 'Email' ); ?></label>
					<input type="email" name="user_email" id="user_email" class="input" value="<?php echo esc_attr( wp_unslash( $user_email ) ); ?>" size="25" autocomplete="email" />
				</p>
				<?php

					/**
					 * Fires following the 'Email' field in the user registration form.
					 *
					 * @since 2.1.0
					 */
					do_action( 'register_form' );

				?>
				<p id="reg_passmail">
					<?php _e( 'Registration confirmation will be emailed to you.' ); ?>
				</p>
				<br class="clear" />
				<input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>" />
				<p class="submit">
					<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e( 'Register' ); ?>" />
				</p>
			</form>

			<p id="nav">
				<a href="<?php echo esc_url( wp_login_url() ); ?>"><?php _e( 'Log in' ); ?></a>
				<?php

					echo esc_html( $login_link_separator );

					$html_link = sprintf( '<a href="%s">%s</a>', esc_url( wp_lostpassword_url() ), __( 'Lost your password?' ) );

					/** This filter is documented in yu-admin-enter.php */
					echo apply_filters( 'lost_password_html_link', $html_link );

				?>
			</p>
			<?php

			login_footer( 'user_login' );
			break;

		case 'checkemail':
			$redirect_to = admin_url();
			$errors      = new WP_Error();

			if ( 'confirm' === $_GET['checkemail'] ) {
				$errors->add(
					'confirm',
					sprintf(
					/* translators: %s: Link to the login page. */
						__( 'Check your email for the confirmation link, then visit the <a href="%s">login page</a>.' ),
						wp_login_url()
					),
					'message'
				);
			} elseif ( 'registered' === $_GET['checkemail'] ) {
				$errors->add(
					'registered',
					sprintf(
					/* translators: %s: Link to the login page. */
						__( 'Registration complete. Please check your email, then visit the <a href="%s">login page</a>.' ),
						wp_login_url()
					),
					'message'
				);
			}

			/** This action is documented in yu-admin-enter.php */
			$errors = apply_filters( 'wp_login_errors', $errors, $redirect_to );

			login_header( __( 'Check your email' ), '', $errors );
			login_footer();
			break;

		case 'confirmaction':
			if ( ! isset( $_GET['request_id'] ) ) {
				wp_die( __( 'Missing request ID.' ) );
			}

			if ( ! isset( $_GET['confirm_key'] ) ) {
				wp_die( __( 'Missing confirm key.' ) );
			}

			$request_id = (int) $_GET['request_id'];
			$key        = sanitize_text_field( wp_unslash( $_GET['confirm_key'] ) );
			$result     = wp_validate_user_request_key( $request_id, $key );

			if ( is_wp_error( $result ) ) {
				wp_die( $result );
			}

			/**
			 * Fires an action hook when the account action has been confirmed by the user.
			 *
			 * Using this you can assume the user has agreed to perform the action by
			 * clicking on the link in the confirmation email.
			 *
			 * After firing this action hook the page will redirect to yu-admin-enter a callback
			 * redirects or exits first.
			 *
			 * @since 4.9.6
			 *
			 * @param int $request_id Request ID.
			 */
			do_action( 'user_request_action_confirmed', $request_id );

			$message = _wp_privacy_account_request_confirmed_message( $request_id );

			login_header( __( 'User action confirmed.' ), $message );
			login_footer();
			exit;

		case 'login':
		default:
			$secure_cookie   = '';
			$customize_login = isset( $_REQUEST['customize-login'] );

			if ( $customize_login ) {
				wp_enqueue_script( 'customize-base' );
			}

			// If the user wants SSL but the session is not SSL, force a secure cookie.
			if ( ! empty( $_POST['log'] ) && ! force_ssl_admin() ) {
				$user_name = sanitize_user( wp_unslash( $_POST['log'] ) );
				$user      = get_user_by( 'login', $user_name );

				if ( ! $user && strpos( $user_name, '@' ) ) {
					$user = get_user_by( 'email', $user_name );
				}

				if ( $user ) {
					if ( get_user_option( 'use_ssl', $user->ID ) ) {
						$secure_cookie = true;
						force_ssl_admin( true );
					}
				}
			}

			if ( isset( $_REQUEST['redirect_to'] ) ) {
				$redirect_to = $_REQUEST['redirect_to'];
				// Redirect to HTTPS if user wants SSL.
				if ( $secure_cookie && false !== strpos( $redirect_to, 'wp-admin' ) ) {
					$redirect_to = preg_replace( '|^http://|', 'https://', $redirect_to );
				}
			} else {
				$redirect_to = admin_url();
			}

			$reauth = empty( $_REQUEST['reauth'] ) ? false : true;

			$user = wp_signon( array(), $secure_cookie );

			if ( empty( $_COOKIE[ LOGGED_IN_COOKIE ] ) ) {
				if ( headers_sent() ) {
					$user = new WP_Error(
						'test_cookie',
						sprintf(
						/* translators: 1: Browser cookie documentation URL, 2: Support forums URL. */
							__( '<strong>Error:</strong> Cookies are blocked due to unexpected output. For help, please see <a href="%1$s">this documentation</a> or try the <a href="%2$s">support forums</a>.' ),
							__( 'https://wordpress.org/documentation/article/cookies/' ),
							__( 'https://wordpress.org/support/forums/' )
						)
					);
				} elseif ( isset( $_POST['testcookie'] ) && empty( $_COOKIE[ TEST_COOKIE ] ) ) {
					// If cookies are disabled, the user can't log in even with a valid username and password.
					$user = new WP_Error(
						'test_cookie',
						sprintf(
						/* translators: %s: Browser cookie documentation URL. */
							__( '<strong>Error:</strong> Cookies are blocked or not supported by your browser. You must <a href="%s">enable cookies</a> to use WordPress.' ),
							__( 'https://wordpress.org/documentation/article/cookies/#enable-cookies-in-your-browser' )
						)
					);
				}
			}

			$requested_redirect_to = isset( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : '';
			/**
			 * Filters the login redirect URL.
			 *
			 * @since 3.0.0
			 *
			 * @param string           $redirect_to           The redirect destination URL.
			 * @param string           $requested_redirect_to The requested redirect destination URL passed as a parameter.
			 * @param WP_User|WP_Error $user                  WP_User object if login was successful, WP_Error object otherwise.
			 */
			$redirect_to = apply_filters( 'login_redirect', $redirect_to, $requested_redirect_to, $user );

			if ( ! is_wp_error( $user ) && ! $reauth ) {
				if ( $interim_login ) {
					$message       = '<p class="message">' . __( 'You have logged in successfully.' ) . '</p>';
					$interim_login = 'success';
					login_header( '', $message );

					?>
					</div>
					<?php

					/** This action is documented in yu-admin-enter.php */
					do_action( 'login_footer' );

					if ( $customize_login ) {
						?>
						<script type="text/javascript">setTimeout( function(){ new wp.customize.Messenger({ url: '<?php echo wp_customize_url(); ?>', channel: 'login' }).send('login') }, 1000 );</script>
						<?php
					}

					?>
					</body></html>
					<?php

					exit;
				}

				// Check if it is time to add a redirect to the admin email confirmation screen.
				if ( is_a( $user, 'WP_User' ) && $user->exists() && $user->has_cap( 'manage_options' ) ) {
					$admin_email_lifespan = (int) get_option( 'admin_email_lifespan' );

					/*
					 * If `0` (or anything "falsey" as it is cast to int) is returned, the user will not be redirected
					 * to the admin email confirmation screen.
					 */
					/** This filter is documented in yu-admin-enter.php */
					$admin_email_check_interval = (int) apply_filters( 'admin_email_check_interval', 6 * MONTH_IN_SECONDS );

					if ( $admin_email_check_interval > 0 && time() > $admin_email_lifespan ) {
						$redirect_to = add_query_arg(
							array(
								'action'  => 'confirm_admin_email',
								'wp_lang' => get_user_locale( $user ),
							),
							wp_login_url( $redirect_to )
						);
					}
				}

				if ( ( empty( $redirect_to ) || 'wp-admin/' === $redirect_to || admin_url() === $redirect_to ) ) {
					// If the user doesn't belong to a blog, send them to user admin. If the user can't edit posts, send them to their profile.
					if ( is_multisite() && ! get_active_blog_for_user( $user->ID ) && ! is_super_admin( $user->ID ) ) {
						$redirect_to = user_admin_url();
					} elseif ( is_multisite() && ! $user->has_cap( 'read' ) ) {
						$redirect_to = get_dashboard_url( $user->ID );
					} elseif ( ! $user->has_cap( 'edit_posts' ) ) {
						$redirect_to = $user->has_cap( 'read' ) ? admin_url( 'profile.php' ) : home_url();
					}

					wp_redirect( $redirect_to );
					exit;
				}

				wp_safe_redirect( $redirect_to );
				exit;
			}

			$errors = $user;
			// Clear errors if loggedout is set.
			if ( ! empty( $_GET['loggedout'] ) || $reauth ) {
				$errors = new WP_Error();
			}

			if ( empty( $_POST ) && $errors->get_error_codes() === array( 'empty_username', 'empty_password' ) ) {
				$errors = new WP_Error( '', '' );
			}

			if ( $interim_login ) {
				if ( ! $errors->has_errors() ) {
					$errors->add( 'expired', __( 'Your session has expired. Please log in to continue where you left off.' ), 'message' );
				}
			} else {
				// Some parts of this script use the main login form to display a message.
				if ( isset( $_GET['loggedout'] ) && $_GET['loggedout'] ) {
					$errors->add( 'loggedout', __( 'You are now logged out.' ), 'message' );
				} elseif ( isset( $_GET['registration'] ) && 'disabled' === $_GET['registration'] ) {
					$errors->add( 'registerdisabled', __( '<strong>Error:</strong> User registration is currently not allowed.' ) );
				} elseif ( strpos( $redirect_to, 'about.php?updated' ) ) {
					$errors->add( 'updated', __( '<strong>You have successfully updated WordPress!</strong> Please log back in to see what&#8217;s new.' ), 'message' );
				} elseif ( WP_Recovery_Mode_Link_Service::LOGIN_ACTION_ENTERED === $action ) {
					$errors->add( 'enter_recovery_mode', __( 'Recovery Mode Initialized. Please log in to continue.' ), 'message' );
				} elseif ( isset( $_GET['redirect_to'] ) && false !== strpos( $_GET['redirect_to'], 'wp-admin/authorize-application.php' ) ) {
					$query_component = wp_parse_url( $_GET['redirect_to'], PHP_URL_QUERY );
					$query           = array();
					if ( $query_component ) {
						parse_str( $query_component, $query );
					}

					if ( ! empty( $query['app_name'] ) ) {
						/* translators: 1: Website name, 2: Application name. */
						$message = sprintf( 'Please log in to %1$s to authorize %2$s to connect to your account.', get_bloginfo( 'name', 'display' ), '<strong>' . esc_html( $query['app_name'] ) . '</strong>' );
					} else {
						/* translators: %s: Website name. */
						$message = sprintf( 'Please log in to %s to proceed with authorization.', get_bloginfo( 'name', 'display' ) );
					}

					$errors->add( 'authorize_application', $message, 'message' );
				}
			}

			/**
			 * Filters the login page errors.
			 *
			 * @since 3.6.0
			 *
			 * @param WP_Error $errors      WP Error object.
			 * @param string   $redirect_to Redirect destination URL.
			 */
			$errors = apply_filters( 'wp_login_errors', $errors, $redirect_to );

			// Clear any stale cookies.
			if ( $reauth ) {
				wp_clear_auth_cookie();
			}

			login_header( __( 'Log In' ), '', $errors );

			if ( isset( $_POST['log'] ) ) {
				$user_login = ( 'incorrect_password' === $errors->get_error_code() || 'empty_password' === $errors->get_error_code() ) ? esc_attr( wp_unslash( $_POST['log'] ) ) : '';
			}

			$rememberme = ! empty( $_POST['rememberme'] );

			$aria_describedby = '';
			$has_errors       = $errors->has_errors();

			if ( $has_errors ) {
				$aria_describedby = ' aria-describedby="login_error"';
			}

			if ( $has_errors && 'message' === $errors->get_error_data() ) {
				$aria_describedby = ' aria-describedby="login-message"';
			}

			wp_enqueue_script( 'user-profile' );
			?>

			<form name="loginform" id="loginform" action="<?php echo esc_url( site_url( 'yu-admin-enter.php', 'login_post' ) ); ?>" method="post">
				<p>
					<label for="user_login"><?php _e( 'Username or Email Address' ); ?></label>
					<input type="text" name="log" id="user_login"<?php echo $aria_describedby; ?> class="input" value="<?php echo esc_attr( $user_login ); ?>" size="20" autocapitalize="off" autocomplete="username" />
				</p>

				<div class="user-pass-wrap">
					<label for="user_pass"><?php _e( 'Password' ); ?></label>
					<div class="wp-pwd">
						<input type="password" name="pwd" id="user_pass"<?php echo $aria_describedby; ?> class="input password-input" value="" size="20" autocomplete="current-password" spellcheck="false" />
						<button type="button" class="button button-secondary wp-hide-pw hide-if-no-js" data-toggle="0" aria-label="<?php esc_attr_e( 'Show password' ); ?>">
							<span class="dashicons dashicons-visibility" aria-hidden="true"></span>
						</button>
					</div>
				</div>
				<?php

					/**
					 * Fires following the 'Password' field in the login form.
					 *
					 * @since 2.1.0
					 */
					do_action( 'login_form' );

				?>
				<p class="forgetmenot"><input name="rememberme" type="checkbox" id="rememberme" value="forever" <?php checked( $rememberme ); ?> /> <label for="rememberme"><?php esc_html_e( 'Remember Me' ); ?></label></p>
				<p class="submit">
					<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e( 'Log In' ); ?>" />
					<?php

						if ( $interim_login ) {
							?>
							<input type="hidden" name="interim-login" value="1" />
							<?php
						} else {
							?>
							<input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>" />
							<?php
						}

						if ( $customize_login ) {
							?>
							<input type="hidden" name="customize-login" value="1" />
							<?php
						}

					?>
					<input type="hidden" name="testcookie" value="1" />
				</p>
			</form>

			<?php

			if ( ! $interim_login ) {
				?>
				<p id="nav">
					<?php

						if ( get_option( 'users_can_register' ) ) {
							$registration_url = sprintf( '<a href="%s">%s</a>', esc_url( wp_registration_url() ), __( 'Register' ) );

							/** This filter is documented in wp-includes/general-template.php */
							echo apply_filters( 'register', $registration_url );

							echo esc_html( $login_link_separator );
						}

						$html_link = sprintf( '<a href="%s">%s</a>', esc_url( wp_lostpassword_url() ), __( 'Lost your password?' ) );

						/**
						 * Filters the link that allows the user to reset the lost password.
						 *
						 * @since 6.1.0
						 *
						 * @param string $html_link HTML link to the lost password form.
						 */
						echo apply_filters( 'lost_password_html_link', $html_link );

					?>
				</p>
				<?php
			}

			$login_script  = 'function wp_attempt_focus() {';
			$login_script .= 'setTimeout( function() {';
			$login_script .= 'try {';

			if ( $user_login ) {
				$login_script .= 'd = document.getElementById( "user_pass" ); d.value = "";';
			} else {
				$login_script .= 'd = document.getElementById( "user_login" );';

				if ( $errors->get_error_code() === 'invalid_username' ) {
					$login_script .= 'd.value = "";';
				}
			}

			$login_script .= 'd.focus(); d.select();';
			$login_script .= '} catch( er ) {}';
			$login_script .= '}, 200);';
			$login_script .= "}\n"; // End of wp_attempt_focus().

			/**
			 * Filters whether to print the call to `wp_attempt_focus()` on the login screen.
			 *
			 * @since 4.8.0
			 *
			 * @param bool $print Whether to print the function call. Default true.
			 */
			if ( apply_filters( 'enable_login_autofocus', true ) && ! $error ) {
				$login_script .= "wp_attempt_focus();\n";
			}

			// Run `wpOnload()` if defined.
			$login_script .= "if ( typeof wpOnload === 'function' ) { wpOnload() }";

			?>
			<script type="text/javascript">
				<?php echo $login_script; ?>
			</script>
			<?php

			if ( $interim_login ) {
				?>
				<script type="text/javascript">
          ( function() {
            try {
              var i, links = document.getElementsByTagName( 'a' );
              for ( i in links ) {
                if ( links[i].href ) {
                  links[i].target = '_blank';
                  links[i].rel = 'noopener';
                }
              }
            } catch( er ) {}
          }());
				</script>
				<?php
			}

			login_footer();
			break;
	} // End action switch.
