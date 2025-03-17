<?php
// Oturumu sonlandır
session_start();
session_unset();
session_destroy();

// Çıkış yaptıktan sonra ana sayfaya yönlendir
header("Location: mainPage.php");
exit();
?>
