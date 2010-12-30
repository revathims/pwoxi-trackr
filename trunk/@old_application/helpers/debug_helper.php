<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
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
  * debug output
  *
  * Generates output for given array or variable in Firebug Console.
  *
  * @access	public
  * @param	mixed	the data variable or array
  * @return	mixed
  */

function debug ($data) {
    echo "<script>\r\n//<![CDATA[\r\nif(!console){var console={log:function(){}}}";
    $output    =    explode("\n", print_r($data, true));
    foreach ($output as $line) {
        if (trim($line)) {
            $line    =    addslashes($line);
            echo "console.log(\"{$line}\");";
        }
    }
    echo "\r\n//]]>\r\n</script>";
} 

?>