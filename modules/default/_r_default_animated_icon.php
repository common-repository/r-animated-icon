<?php
  /*
    Element ID:r_default_animated_icon
    Element Name: Default Shortcode Animated Icon 
    Icon Class:r-default-animated-icon
    Builder Class:default
  */

/****[r_animated_icon_default_shortcode r_animated_icon_file="" r_animated_icon_extra_class=""]*/

if ( ! defined( 'R_ANIMATED_ICON_DEFAULT_TEMPLATE_DIR' ) ) 
{
	define( 'R_ANIMATED_ICON_DEFAULT_TEMPLATE_DIR', plugin_dir_path( __FILE__ ) . 'templates/' );
}

class R_Animated_Icon_Default_Shortcode
{
	function __construct()
	{
		add_shortcode("r_animated_icon_default_shortcode",array($this,"r_animated_icon_default_shortcode_callback"));
	}//end of function
	function r_animated_icon_default_shortcode_callback($atts)
	{
		extract( shortcode_atts( array(
            'r_animated_icon_file'=>'',
            'r_animated_icon_extra_class'=>'',
		), $atts,'r_animated_icon_default_shortcode'));
		$css_class=$r_animated_icon_extra_class;
		$output='';
		wp_enqueue_script( 'r-vc-animated-icon', R_ANIMATED_ICON_URL . '/modules/default/js/r-default-animated-icon.js', array('bodymovin-js'), R_ANIMATED_ICON_VERSION, true );
		require (R_ANIMATED_ICON_DEFAULT_TEMPLATE_DIR.'_r_default_animated_icon_template.php');
		return $output;
	}//end of function
}//end of class
new R_Animated_Icon_Default_Shortcode();