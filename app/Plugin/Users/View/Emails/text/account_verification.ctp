Hi <?php echo $user[$model]['username'] ?>,

Kami dari tim SlotMoo.Com mengucapkan terimakasih atas pendaftaran yang anda lakukan di SlotMoo.Com.

Pendaftaran anda telah berhasil, namun untuk login dan menggunakan akun anda di SlotMoo.Com anda harus mengaktifkan akun anda terlebih dahulu, mengaktifkan akun anda sangat mudah, caranya adalah cukup dengan mengakses tautan di bawah ini

<?php
echo Router::url(array('admin' => false, 'plugin' => 'users', 'controller' => 'users', 'action' => 'verify', 'email', $user[$model]['email_token']), true);
?>

CATATAN:
- Tautan diatas berlaku selama 24 jam dari saat pendaftaran.


Terimakasih.


Tim SlotMoo.Com 