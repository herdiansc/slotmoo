<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Errors
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>

<div class="center-box-inner-container">
        <div class="boxes boxes-dynamic width-95">
            <div class="box-title">
                <h1 style="margin:10px;padding:10px;color:red"><?php echo $name; ?></h1>
                <p class="form-desc" style="padding:0px 20px;font-size:11pt;"><?php echo 'Halaman <strong>'.$url.'</strong> yang anda cari tidak ditemukan.' ?></p>               
                <div class="input submit" style="margin-bottom:20px;margin-top:40px;">
                </div>    
            </div>
        </div>
</div>

<?php
if (Configure::read('debug') > 0):
	echo $this->element('exception_stack_trace');
endif;
?>
