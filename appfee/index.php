<?php

/*
 * This is where URL mapping to backend code happens
 */

require_once( 'configuration.php' );

define( 'VERSION_NUMBER', '0.1.0.1' );

/** @var string Contains HTTP_HOST eliment from the $_SERVER array */
$request_host = $_SERVER['HTTP_HOST'];

/** @var string Contains REQUEST_URI eliment from the $_SERVER array */
$request_uri = $_SERVER['REQUEST_URI'];

/** @var string Contains BASE_URI constant without trailing slashes */
$base_uri = rtrim( BASE_URI, '/' );

// Check to make sure we are hosted out of the correct directory
if ( $base_uri !== substr( $request_uri, 0, strlen( $base_uri ) ) ) {
	$error_message = 'The BASE_URI constant does not match the requested ' .
		'URI. Please review the configuration.php file and set BASE_URI to ' .
		'the appropriate path'
	;
	throw new Exception( $error_message );
}

// Redirect to HTTPS
if ( ! isset( $_SERVER['HTTPS'] ) ) {
	$url = 'https://' . $request_host . $request_uri;
	header( 'HTTP/1.1 301 Moved Permanently' );
	header( 'Location: ' . $url );
	exit();
}

/** @var string Contains $request_uri minus $base_uri  */
$application_uri = substr( $request_uri, strlen( $base_uri ) );
switch ( $application_uri ) {
	case '/general-admissions':
		require_once( 'model/student-info-payment-model.php' );
		require_once( 'view/student-info-payment-view.php' );
		$model = new Student_Info_Payment_Model(
			'template/general-admissions-fee-to-cybersource-template.php',
			GLOBALS_PATH,
			GLOBALS_URL,
			DEFAULT_BILL_TO_ADDRESS_COUNTRY,
			DEFAULT_BILL_TO_ADDRESS_STATE,
			CURRENCY,
			CYBERSOURCE_ACCESS_KEY,
			CYBERSOURCE_LOCALE,
			CYBERSOURCE_PROFILE_ID,
			CYBERSOURCE_SECRET_KEY,
			CYBERSOURCE_FORM_POST_URL,
			'General Admissions Fee',
			'1',
			'34.00',
			DEFAULT_TRANSACTION_TYPE
		);
		$controler = NULL;
		$view = new Student_Info_Payment_View( $controler, $model );
		echo $view->get_output();
		break;

	default:
		require_once( 'model/default-model.php' );
		require_once( 'view/default-view.php' );
		$model = new Default_Model(
			'template/error-404-template.php',
			GLOBALS_PATH,
			GLOBALS_URL
		);
		$view = new Default_View( NULL, $model );
		header( 'HTTP/1.1 404 Not Found' );
		echo $view->get_output();
}
