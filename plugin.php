<?php
/*
Plugin Name: UA Parser
Plugin URI: http://yourls.org
Description: Get browser and OS statistics from every clicks
Version: 1.0
Author: Leo Colombaro
Author URI: http://yourls.org
*/

// Load libraries (i.e. UAParser)
require_once __DIR__ . '/vendor/autoload.php';

// Use UA Parser
use UAParser\Parser;

$requested = json_decode(
                utf8_encode(
                    file_get_contents( __DIR__ . '/config.json' )
             ));

/**
 * Get Browser and OS
 *
 * Use UAParser to get Browser and OS name/versions of the given UA.
 *
 * @param string $ua The given UA
 * @return array
 * @link http://3v4l.org/n4Q9u
 */
function yp_uaparser( $ua ){
    $parser = Parser::create();
    $result = $parser->parse( $ua );

    $return = array();
    foreach ( $requested as $object => $values ) {
        $return[$object] = array_intersect_key( (array) $result->$object, array_flip( $values ) );
    }
    
    return $return;
}
