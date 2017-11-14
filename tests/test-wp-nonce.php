<?php



/**
 * Sample test case.
 */
class WpNonceTest extends WP_UnitTestCase {


	function test_nonce_class_exists() {
	    //to make sure class loaded correctly
        $this->assertTrue(class_exists('\Inpsyde\WPNonce'), "WPNonce class is not exists or Run 'composer dump-autoload'.");
    }


    function test_get_field_method_exists() {
        //to make sure class loaded correctly
        $wpNonce = new \Inpsyde\WPNonce();
        $this->assertTrue(
            method_exists($wpNonce, 'getField'),
            'Class does not have method createField'
        );
    }


    function test_get_url_method_exists() {
        //to make sure class loaded correctly
        $wpNonce = new \Inpsyde\WPNonce();
        $this->assertTrue(
            method_exists($wpNonce, 'getUrl'),
            'Class does not have method createUrl'
        );
    }

    function test_tick_method_exists() {
        //to make sure class loaded correctly
        $wpNonce = new \Inpsyde\WPNonce();
        $this->assertTrue(
            method_exists($wpNonce, 'tick'),
            'Class does not have method tick'
        );
    }


    function test_create_method_exists() {
        //to make sure class loaded correctly
        $wpNonce = new \Inpsyde\WPNonce();
        $this->assertTrue(
            method_exists($wpNonce, 'create'),
            'Class does not have method create'
        );
    }


    function test_verify_field_nonce() {
        //to make sure class loaded correctly
        $wpNonce = new \Inpsyde\WPNonce();
        $field = $wpNonce->getField('wp_nonce_test', 'wp_nonce_test', false, false);
        $xmlField = simplexml_load_string($field);
        $nonce = (string) $xmlField->attributes()['value'];
        $this->assertContains($wpNonce->verify($nonce, 'wp_nonce_test'), [1,2]);
    }

    function test_verify_url_nonce() {
        //to make sure class loaded correctly
        $wpNonce = new \Inpsyde\WPNonce();
        $url = $wpNonce->getUrl('http://wp.app/');
        $urlArr = explode('?', $url);
        parse_str($urlArr[1], $parsedQueryStr);
        $this->assertContains($wpNonce->verify($parsedQueryStr['_wpnonce']), [1,2]);
    }
}
