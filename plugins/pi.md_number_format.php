<?php
/* ============================================================================
pi.md_number_format.php
Format raw number as currency or just with commas.
            
INFO --------------------------------------------------------------------------
Developed by: Ryan Masuga, masugadesign.com
Created:   Nov 01 2007
Last Mod:  Mar 09 2009

CHANGELOG & OTHER INFO --------------------------------------------------------
See README.textile
=============================================================================== */

$plugin_info = array(
						'pi_name'			=> 'MD Number Format',
						'pi_version'			=> '1.0.3',
						'pi_author'			=> 'Ryan Masuga',
						'pi_author_url'		=> 'http://www.masugadesign.com/',
						'pi_description'		=> 'Formats a number with commas, or as currency.',
						'pi_usage'			=> Md_number_format::usage()
					);

class Md_number_format {

var $number = "";
var $currency = "";
var $decimal = "";
var $return_data ="";
var $formatted ="";
	
	function md_number_format () 
	{
			global $TMPL;
			
			$number = $TMPL->fetch_param('number');
			$currency = $TMPL->fetch_param('currency'); //OPTIONAL - defaults to no
			
			$decimalx = "";
			$decimal = $TMPL->fetch_param('decimal'); //OPTIONAL - defaults to 0
			
			if ($currency == ""){$currency = "n";}
			
			if ($decimal == ""){
				$decimalx = "0";
			} else {
				$period = strchr($number,".");
				if ($period == FALSE) {
					$decimalx == "0";
				} else {
					$decimalx = $decimal;
				}
			}
			
			$formatted = number_format($number,$decimalx);
			
			if ($currency == "y") {
				$this->return_data = "\$".$formatted;
			} else {
				$this->return_data = $formatted;
			}
	}
    
// ----------------------------------------
//  Plugin Usage
// ----------------------------------------

// This function describes how the plugin is used.
//  Make sure and use output buffering

function usage()
{
ob_start(); 
?>
Place the following tag in any of your templates:

{exp:md_number_format number="7362524"}
result: 7,362,524
{exp:md_number_format number="7362524" currency="y"}
result: $7,362,524
{exp:md_number_format number="7362524.27" currency="y"}
result: $7,362,524
{exp:md_number_format number="7362524.27" currency="y" decimal="2"}
result: $7,362,524.27
{exp:md_number_format number="7362524" currency="y" decimal="2"}
result: $7,362,524

PARAMETERS: 
The tag has two parameters:

1. number [REQUIRED]
2. currency: Will add dollar sign [OPTIONAL]
2. decimal: Will set the decimal the number supplied [OPTIONAL, defaults to 0]

<?php
$buffer = ob_get_contents();
ob_end_clean(); 
return $buffer;
}
// END
}
?>