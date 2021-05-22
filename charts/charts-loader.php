<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

class NT_Dispatch_Status_Charts
{
    private static $_instance = null;
    public static function instance(){
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()

    public function __construct(){

        require_once( 'one-page-chart-template.php' );
        new NT_Dispatch_Status_Chart_Template();

        /**
         * @todo add other charts like the pattern above here
         */

    } // End __construct
}
NT_Dispatch_Status_Charts::instance();
