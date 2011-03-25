<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		Rick Ellis
 * @copyright	Copyright (c) 2006, pMachine, Inc.
 * @license		http://www.codeignitor.com/user_guide/license.html 
 * @link		http://www.codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * Code Igniter FireBug Debug Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Arfeen | www.pwoxi.com
 */
// ------------------------------------------------------------------------

/**
 * create_label output
 *
 * Generates labels out of string.
 *
 * @access	public
 * @param	mixed	the data variable or array
 * @return	mixed
 */
function create_label($data) {
    $data = strtoupper($data);
    $data = explode(" ", $data);
    $output = NULL;
    if (count($data) == 1) {
        $output = $data['0'];
    } else {
        foreach ($data as $index) {
            $str = substr($index, 0, 1);
            $output .= $str;
        }
    }
    if (strlen($output) >= 10) {
        $output = substr($output, 0, 9);
    }
    return $output;
}


/**
 * label_colors output
 *
 * Generates random colors for labels.
 *
 * @access	public
 * @return	mixed
 */
function label_colors() {
    $colors = array("labellightblue", "labelblue", "labelolive", "labelgreen", "labelbrown", "labelviolet", "labelturk", "labelred", "labelorange", "labellime", "labeldarkblue", "labelleaf", "labelyellow", "labelautumn", "labelfrost", "labelpurple", "labelblack");
    $rand_keys = array_rand($colors);
    $color = $colors[$rand_keys];
    return $color;
}

?>