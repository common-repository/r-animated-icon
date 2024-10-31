<?php
/*
* Plugin Name: R Animated Icon
* Plugin URI:  
* Description: Animated icon using the Lottie Animation SVG files
* Version:  1.0.0
* Author: mascotdevelopers
* Author URI: https://www.mascotdevelopers.com/ 
* Text Domain: r_animate
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) 
{
  exit;
}
if ( ! defined( 'R_ANIMATED_ICON_VERSION' ) ) 
{
    define( 'R_ANIMATED_ICON_VERSION', '10.0.7' );
}
if ( ! defined( 'R_ANIMATED_ICON_MODULE_PARENT_DIR' ) ) 
{
	define( 'R_ANIMATED_ICON_MODULE_PARENT_DIR',  plugin_dir_path( __FILE__ ).'modules' );
}
if ( ! defined( 'R_ANIMATED_ICON_URL' ) ) 
{
	define( 'R_ANIMATED_ICON_URL',  plugins_url('/', __FILE__ ));
}
if ( ! defined( 'R_ANIMATED_ICON_PLUGIN_JS_URI' ) ) 
{
	define( 'R_ANIMATED_ICON_PLUGIN_JS_URI', plugins_url( 'assets/js/',__FILE__ ) );
}
if ( ! defined( 'R_ANIMATED_ICON_PLUGIN_CSS_URI' ) ) 
{
	define( 'R_ANIMATED_ICON_PLUGIN_CSS_URI', plugins_url( 'assets/css/',__FILE__ ) );
}

// R_ANIMATED_ICON_MODULE_PARENT_DIR.'/vc/_r_vc_animated_icon.php';
// require_once
class R_Animate
{
	protected $module_parent_dir;
	function __construct()
	{
		$this->module_parent_dir=R_ANIMATED_ICON_MODULE_PARENT_DIR;
		add_action( 'init', array($this,'r_animate_init' ));
		add_action( 'init', array($this,'r_animate_pro_elementor_init' ));
		
		add_action( 'admin_enqueue_scripts', array( $this, 'r_animate_admin_script_styles' ) );
		add_filter('upload_mimes', array($this,'r_animate_addtional_mime_types'));
		add_action('wp_enqueue_scripts',array($this,'r_animate_base_style_script'));
	}//end of function
	function r_animate_init()
	{
		$module_dirs =  glob($this->module_parent_dir . '/*' , GLOB_ONLYDIR);
		foreach($module_dirs as $module)
		{
			$module_name=str_replace(array(' ','-'),'_', basename($module));
			$module_dir_path=$module.'/';
			$file_name='_r_'.$module_name.'_animated_icon.php';
			$file_path=$module_dir_path.$file_name;
			if(file_exists($file_path)) //check if file is present in the module
			{
				$d=array(
	                'id' => 'Element ID',
	                'element_name' => 'Element Name',
	                'icon_class' => 'Icon Class',
	                'builder_class' => 'Builder Class', // page builder class mentioned in the main php file for checking
	                'type' => 'Type'
	            );
	            $headers=get_file_data($file_path,$d);
	            if($headers['type']!="pro")
	            {
		            if(class_exists($headers['builder_class']) || $headers['builder_class']=="default") //check if that page builder is installed or not
		            {
						require_once($file_path);		            	
		            }
		        }
			}
		}
	}//end of function
	function r_animate_addtional_mime_types($mimes) 
	{
		$mimes['json'] = 'application/json'; 
		$mimes['svg'] = 'image/svg+xml'; 
		return $mimes; 
	}//end of function
	function r_animate_base_style_script()
	{
		wp_enqueue_script( 'bodymovin-js', R_ANIMATED_ICON_PLUGIN_JS_URI . '/vendor/bodymovin.js', array(), R_ANIMATED_ICON_VERSION, true );
	}//end of fucntion
	function r_animate_admin_script_styles()
	{
		wp_enqueue_style( 'r-animate-admin-style',R_ANIMATED_ICON_PLUGIN_CSS_URI.'r_animate_admin.css',array(),_R_PLUG_VERSION );
	}//end of function
	function r_animate_pro_elementor_init() 
	{
		if(class_exists('R_Animated_Icon_Elementor_Builder'))
		{
			R_Animated_Icon_Elementor_Builder::get_instance();			
		}
	}//end of function


}//end of class
new R_Animate();
define( 'ALLOW_UNFILTERED_UPLOADS', true );



