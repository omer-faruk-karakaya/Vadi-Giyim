<?php
// Oturum başlat
session_start();

// Eğer kullanıcı giriş yapmamışsa, kayıt olma sayfasına yönlendir
if (!isset($_SESSION['userName'])) {
    header("Location: registerr.php");  // Kayıt sayfasına yönlendir
    exit();
}

// Kullanıcı bilgilerini session'dan al
$userName = $_SESSION['userName'];
$email = $_SESSION['email'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hesap Bilgileri</title>
    <link rel="stylesheet" href="accountInfo.css">
</head>
<body>
    <div class="back">
    <div class="turnBack">
                <a href="mainPage.php">Geri dön</a>
            </div>
    <div class="container">
        <div class="account">
            
        <span>Hesap Bilgileri</span>
        </div>
        
        
        
        <div class="account-info">
            <div class="text">
                <div class="username">
                <p><strong>Kullanıcı Adı:</strong> <?php echo htmlspecialchars($userName); ?></p>
                </div>
                <div class="email">
                <p><strong>E-posta:</strong> <?php echo htmlspecialchars($email); ?></p>
                </div>
                <div class="logout">
                <a href="logout.php">Çıkış Yap</a>
                </div>
            </div>
           
        </div>
    
           
       
    </div>
    </div>
   
</body>
</html>
