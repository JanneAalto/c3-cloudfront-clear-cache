<?php
/*
 * Plugin Name: C3 Cloudfront Cache Controller
 * Version: 1.0.0
 * Plugin URI:https://github.com/JanneAalto/C3-Cloudfront-Clear-Cache
 * Description: Cloudfront cache management based on C3 Cloudfront Cache Controller by AMIMOTO and WP Offload S3 Lite by Delicious Brains
 * Author: Janne Aalto
 * Author URI: https://frantic.com/
 * Text Domain: c3-cloudfront-clear-cache
 */

$GLOBALS['aws_meta']['c3-cloudfront-clear-cache']['version'] = '1.0.0';
$GLOBALS['aws_meta']['amazon-web-services']['supported_addon_versions']['c3-cloudfront-clear-cache'] = '1.0.0';
$aws_plugin_version_required = '1.0.1';

//function add_c3_cloudfront_clear_cache($addons) {
//
//    $addons = $addons + [
//            'c3-cloudfront-clear-cache' => [
//                'title' => __('C3 Cloudfront Cache Controller', 'amazon-web-services'),
//                'url' => 'https://github.com/JanneAalto/C3-Cloudfront-Clear-Cache',
//                'install' => true,
//            ]
//        ];
//
//    return $addons;
//}
//
//add_action('aws_addons', 'add_c3_cloudfront_clear_cache', 1, 1);

require_once dirname(__FILE__) . '/classes/wp-aws-compatibility-check.php';
global $c3cf_compat_check;
$c3cf_compat_check = new WP_AWS_Compatibility_Check(
    'C3 Cloudfront Cache Controller',
    'c3-cloudfront-clear-cache',
    __FILE__,
    'Amazon Web Services',
    'amazon-web-services',
    $aws_plugin_version_required
);

function c3cf_require_files(){
    $abspath = dirname(__FILE__);

    require_once $abspath . '/classes/c3-cloudfront-clear-cache.php';

}


function c3cf_init( $aws ){
    global $c3cf_compat_check;

    if (method_exists('WP_AWS_Compatibility_Check', 'is_plugin_active') && $c3cf_compat_check->is_plugin_active('amazon-s3-and-cloudfront-pro/amazon-s3-and-cloudfront-pro.php')) {
        // Don't load if pro plugin installed
        return;
    }


    if (!$c3cf_compat_check->is_compatible()) {
        return;
    }

    c3cf_require_files();
    global $c3cf;
    $c3cf = new C3_CloudFront_Clear_Cache( __FILE__, $aws );
}

add_action('aws_init', 'c3cf_init');
