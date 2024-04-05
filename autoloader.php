<?php
/**
 * Autoloading classes
 */
spl_autoload_register( function ( $class ) {
    $path = plugin_dir_path(__DIR__) . strtolower( str_replace( "\\" , "/" , $class ) ) . '.php';
    if ( ! file_exists( $path ) ) {
        // var_dump($path);
        return false;
    } else {
        // var_dump( $path );
        require_once $path;
    }
});

