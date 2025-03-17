<?php
// Oturum başlat
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="mainPage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"
        integrity="sha512-7eHRwcbYkK4d9g/6tD/mhkf++eoTHwpNM9woBxtPUBWm67zeAfFC+HrdoE2GanKeocly/VxeLvIqwvCdk7qScg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="mainPage.js" defer></script>
</head>

<body>
    <div class="mainPageIntro">
        <h1>VADİ GİYİM</h1>
    </div>
    <div class="container">
        <div class="inner-div">
            <div class="flex-div">
                <div class="left-blur-div">
                    <div class="logo">
                        <img src="images/mainIcon.png">
                    </div>
                    <div class="vadi">
                        VADİ
                    </div>
                    <div class="text">
                        <p>Vadi giyim, modern tasarımlarıyla her tarza hitap eden kaliteli ve şık giyim ürünleri sunan
                            bir moda markasıdır. Müşteri memnuniyetini ön planda tutarak, modayı herkes için
                            ulaşılabilir kılmayı hedefliyoruz.</p>
                    </div>

                   
                </div>
                <div class="giyim">
                    GİYİM
                </div>
                <div class="navbar">
                    <div class="navDiv">
                        <div class="icon"><i class="fa-solid fa-shirt"></i></div>
                        <a href="./../draft/draft.php">Ürünler</a> 
                    </div>
                    <div class="navDiv">
                        <div class="icon"><i class="fa-solid fa-cart-shopping"></i></div>
                        <a href="./../cart/test.php">Sepetim</a>
                    </div>
                    <div class="navDiv">
                        <div class="icon"><i class="fa-solid fa-user"></i></div>
                        <?php
                        if (isset($_SESSION['userName'])) {
                            // Giriş yapmış kullanıcı için "Hesabım" bağlantısı
                            echo '<a href="account.php">Hesabım</a>';
                        } else {
                            // Giriş yapmamış kullanıcı için "Kayıt Ol" bağlantısı
                            echo '<a href="registerr.php">Kayıt Ol</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>