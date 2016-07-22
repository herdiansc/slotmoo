<?php
/**
 * Thumbnail helper for CakePHP.
 *
 * @author  Martin Bean <martin@martinbean.co.uk>
 * @version 1.0
 */

#App::uses('AppHelper', 'View/Helper');

/**
 * The thumbnail helper class.
 */
class ResizeImage {
    /**
     * Helpers used within this helper.
     */
#    public $helpers = array('Html');
    
    /**
     * Path to source images.
     *
     * @var string
     */
    private $files_dir = 'files/';
    
    /**
     * Path for saved thumbnail images.
     *
     * @var string
     */
    private $thumbs_dir = 'thumbs/';
    
    /**
     * Width of thumbnail image.
     *
     * @var integer
     */
    private $width;
    
    /**
     * Height of thumbnail image.
     *
     * @var integer
     */
    private $height;
    
    /**
     * Renders a thumbnail image.
     *
     * @param  string $filename
     * @param  array  $options
     * @param  array  $imgOptions
     * @return string
     */
    public function render($filename, $options = array(), $imgOptions = array()) {
        $this->width = isset($options['width']) ? intval($options['width']) : 100;
        $this->height = isset($options['height']) ? intval($options['height']) : 75;
        
        $path = WWW_ROOT.$options['folder'].DS;

        list($width, $height) = getimagesize($filename);

        if($width != $height) {
            if($width > $height) {
                $this->width = ($width/$height) * $this->width;  
            }else if($height > $width) {
                $this->height = ($height/$width) * $this->height;
            }
        }
        
        $filename_exploded = explode('.',$filename);
        
        $canvas = imagecreatetruecolor($this->width, $this->height);
        $image = $this->imagecreatefromfile($filename);
#        imagecopyresampled($canvas, $image, 0, 0, 0, 0, $this->width, $this->height, $width, $height);
        imagecopyresampled($canvas, $image, 0, 0, $newImage['crop']['x'], $newImage['crop']['y'], $newImage['newWidth'], 191, 90, $newImage['crop']['height']);
        imagejpeg($canvas, $path . $options['new_filename'], 100);
    }
    
    function imagecreatefromfile($path, $user_functions = false) {
        $info = @getimagesize($path);
        
        if(!$info) {
            return false;
        }
        
        $functions = array(
            IMAGETYPE_GIF => 'imagecreatefromgif',
            IMAGETYPE_JPEG => 'imagecreatefromjpeg',
            IMAGETYPE_PNG => 'imagecreatefrompng',
            IMAGETYPE_WBMP => 'imagecreatefromwbmp',
            IMAGETYPE_XBM => 'imagecreatefromwxbm',
        );
        
        if($user_functions) {
            $functions[IMAGETYPE_BMP] = 'imagecreatefrombmp';
        }
        
        if(!$functions[$info[2]]) {
            return false;
        }
        
        if(!function_exists($functions[$info[2]])) {
            return false;
        }
        
        return $functions[$info[2]]($path);
    }
}
