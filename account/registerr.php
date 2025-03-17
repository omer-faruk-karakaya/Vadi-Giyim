<?php
session_start();
if (isset($_SESSION['error'])) {
    $message = "Bu bir log mesajıdır!";
    echo "<script>console.log('" . addslashes($message) . "');</script>";
} else {
    $message = "yok!";
    echo "<script>console.log('" . addslashes($message) . "');</script>";
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="account.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js" defer></script>
    <script src="account.js" defer></script>
</head>

<body>
    <div class="back"><a href="mainPage.php">Anasayfaya dön</a></div>
    <div class="container">

        <div class="login-container">
            <form action="register.php" method="post">
                <div class="header">
                    <h1>Kayıt ol</h1>
                </div>
                <div class="username-area">
                    <div class="icon">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <input type="text" placeholder="Kullanıcı adı" id="userName" name="userName" required />
                </div>
                <br /><br />
                <div class="email-area">
                    <div class="icon">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <input type="email" placeholder="Email" id="email" name="email" required />
                </div>
                <br />
                <div class="password-area">
                    <div class="icon">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <input type="password" placeholder="Şifre" id="passWord" name="password" required />
                </div>
                <br />
                <div class="remember-me-area">
                    <label for="remember-me-checkbox">Şifremi hatırla</label>
                    <input type="checkbox" class="remember-me-checkbox" />
                </div>
                <br />
                <div class="button-area">
                    <button type="submit" id="btton">
                        <p>Kayıt ol</p>
                    </button>
                </div>
                <div class="forgot-password-area">
                    <div class="forgot-password-div">
                        <a href="#">Şifremi unuttum</a>
                    </div>
                </div>
                <div class="sign-up-area">
                    <div class="sign-up-div">
                        <p>Zaten hesabınız var mı?</p>
                        <a href="loginn.php">Giriş yapın</a>
                    </div>
                </div>
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="success-message">
                        <p><?php echo $_SESSION['success']; ?></p>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>
                <!--
                <div class="error-message">
                    <p>deneme</p>
                </div>
                -->
                <?php
                
                
                if (isset($_SESSION['error'])) { ?>
                    <div class="error-message" style=display:block;>
                        <p><?php echo $_SESSION['error']; ?></p>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                    
                <?php }
                session_abort();
                ?>

            </form>
        </div>
    </div>
</body>

</html>