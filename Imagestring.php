<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imagestring {

    public function __construct() {
		$this->CI =& get_instance();
    }
	  
	  // function to turn an image file to a string
	  function image2string($file_name) {
	  
	  //load the native CI Image_lib
		$this->CI->load->library('image_lib');
		
		//change the 'upload' to your own image storage folder's name
		//and place it on root folder (beside application and system)
		$image_lib['source_image'] = getcwd().'/uploads/'.$file_name;
		
    //let the maintain_ratio TRUE if you don't want the image get stretched
		$image_lib['maintain_ratio'] = TRUE;
		
		//set the width or height of the image to you likings
		if ($upload_data['image_width'] > $upload_data['image_height']) {
		
		  //for landscape
			$image_lib['width'] = 400;
			$image_lib['height'] = 300;
		} else {
		
		  //for portrait
			$image_lib['width'] = 300;
			$image_lib['height'] = 400;
		}
		$this->CI->image_lib->initialize($image_lib);
		$this->CI->image_lib->resize();

    //load file helper so we can read the images contents
		$this->CI->load->helper('file');
		
		//set the function to return the image string
		return read_file(base_url().'uploads/'.$upload_data['file_name']);
		
    //in case you no longer need the image file, just delete it with unlink
		unlink(getcwd().'/uploads/'.$upload_data['file_name']);
		
	}
	
	//function to turn an image string back to an <img src="the image">
	function string2image($string) {
		$converted = imagecreatefromstring($string);
		ob_start();
		imagepng($converted);
		$contents =  ob_get_contents();
		ob_end_clean();
		return "<img src='data:image/png;base64,".base64_encode($contents)."' />";
		imagedestroy($converted);
	}
}
