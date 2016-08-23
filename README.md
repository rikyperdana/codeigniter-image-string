# CodeIgniter Image String Converter
This Codeigniter Library purpose is to turn an image file passed to it to a string of the image

Installation -
- Download the Imagestring.php from this repo
- Copy it to libraries folder
- Call it on the controller with $this->load->library('imagestring');

How to use -
- To turn an image file to a string, use $this->imagestring->image2string($file_name);
- To turn an image string back to an image, use $this->imagestring->string2image($string);
