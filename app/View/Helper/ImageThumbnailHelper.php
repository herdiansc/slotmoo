<?php
/**
 * Thumbnail helper for CakePHP.
 *
 * @author  Martin Bean <martin@martinbean.co.uk>
 * @version 1.0
 */

App::uses('AppHelper', 'View/Helper');

/**
 * The thumbnail helper class.
 */
class ImageThumbnailHelper extends AppHelper {
    /**
     * Helpers used within this helper.
     */
    public $helpers = array('Html');
    
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

        list($width, $height) = getimagesize($path.$filename);

        if($width != $height) {
            if($width > $height) {
                $this->width = ($width/$height) * $this->width;  
            }else if($height > $width) {
                $this->height = ($height/$width) * $this->height;
            }
        }
        
        $filename_exploded = explode('.',$filename);
#        debug(explode('.',$filename));die();
        
        if (!is_file($path . $this->width . 'x' . $this->height.'_'.$filename) || !$options['cache']) {
            $canvas = imagecreatetruecolor($this->width, $this->height);
            $image = $this->imagecreatefromfile($path.$filename);
            imagecopyresampled($canvas, $image, 0, 0, 0, 0, $this->width, $this->height, $width, $height);
#            imagejpeg($canvas, $path . $this->width . 'x' . $this->height . '_' . $filename, 100);
            imagejpeg($canvas, $path . $filename_exploded[0].'_'.$this->width . 'x' . $this->height.'.'.$filename_exploded[1], 100);
        }
#        debug($this->width . 'x' . $this->height);
        return $this->Html->image(
            $options['cdn'].$options['folder'].'/'. $filename_exploded[0].'_'.$this->width . 'x' . $this->height.'.'.$filename_exploded[1],
            $imgOptions
        );
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
