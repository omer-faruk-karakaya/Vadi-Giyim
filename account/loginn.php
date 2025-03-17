<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="login.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js" defer></script>
    <script src="login.js" defer></script>
</head>
<body>
    <div class="back"><a href="mainPage.php">Anasayfaya dön</a></div>
    <div class="container">
        <div class="login-container">
            <form action="login.php" method="post">
                <div class="header">
                    <h1>Giriş Yap</h1>
                </div>

                <!-- Kullanıcı adı alanı -->
                <div class="username-area">
                    <div class="icon">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <input type="text" name="userName" placeholder="Kullanıcı adı" id="userName" required />
                </div>
                <br /><br />
                <div class="email-area">
                    <div class="icon">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <input type="email" placeholder="Email" id="email" name="email" required />
                </div>
                <!-- Şifre alanı -->
                <div class="password-area">
                    <div class="icon">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <input type="password" name="password" placeholder="Şifre" id="passWord" required />
                </div>
                <br />

                <!-- Beni hatırla alanı -->
                <div class="remember-me-area">
                    <label for="remember-me-checkbox">Şifremi hatırla</label>
                    <input type="checkbox" class="remember-me-checkbox" />
                </div>
                <br />

                <!-- Giriş butonu -->
                <div class="button-area">
                    <button type="submit" id="btton">
                        <p>Giriş Yap</p>
                    </button>
                </div>

                <!-- Şifremi unuttum bağlantısı -->
                <div class="forgot-password-area">
                    <div class="forgot-password-div">
                        <a href="#">Şifremi unuttum</a>
                    </div>
                </div>

                <!-- Kayıt ol alanı -->
                <div class="sign-up-area">
                    <div class="sign-up-div">
                        <p>Hesabınız yok mu?</p>
                        <a href="registerr.php">Kayıt olun</a>
                    </div>
                </div>

                <!-- PHP hata mesajı alanı -->
                <div class="php-error-message">
                    <?php
                    if (isset($_GET['error'])) {
                        if ($_GET['error'] == 'password') {
                            echo "<p style='color: red;'>Şifre hatalı!</p>";
                        } elseif ($_GET['error'] == 'username') {
                            echo "<p style='color: red;'>Kullanıcı adı bulunamadı!</p>";
                        }
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
