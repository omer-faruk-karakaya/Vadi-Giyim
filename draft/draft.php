<?php
session_start();
$userID = $_SESSION['id'] ?? 0;
$showInfo1 = '';  // info1'i göster
$showInfo2 = ''; // info2'yi göster
// 1) DATABASE BAĞLANTISI (PDO)
$dsn = "mysql:host=localhost;dbname=ShoppingSystem;charset=utf8mb4";
$db_user = "root";
$db_pass = "";

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// 2) ADD TO CART MANTIĞI
if (isset($_POST["test"])) {
    // Kullanıcı ID’sini session’dan alın (örnek)
    $userID = $_SESSION['id'] ?? 0;

    // Kullanıcı giriş yapmamışsa, kayıt olma sayfasına yönlendirin
    if ($userID == 0) {
        $message = "Lütfen önce kayıt olun";
        echo "<script type='text/javascript'>
        alert('$message');
        window.location.href = './../account/registerr.php';
        </script>";
        exit;
    }

    // Formdaki hidden input'tan ürün ID'sini alın
    $productID = isset($_POST['product_id']) ? (int) $_POST['product_id'] : 0;

    // Cart tablosunda bu kullanıcı + ürün var mı?
    $sql_check = "SELECT Quantity FROM cart WHERE UserID = :userID AND ProductID = :productID";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute([
        ':userID' => $userID,
        ':productID' => $productID
    ]);
    $row = $stmt_check->fetch();

    if ($row) {
        // Ürün daha önce eklenmiş, qty 1 artır
        $newQuantity = $row['Quantity'] + 1;
        $sql_update = "UPDATE cart SET Quantity = :qty WHERE UserID = :userID AND ProductID = :productID";
        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->execute([
            ':qty' => $newQuantity,
            ':userID' => $userID,
            ':productID' => $productID
        ]);
        $showInfo1 = 'visible';
    } else {
        // Ürün yeni ekleniyor
        $sql_insert = "INSERT INTO cart (UserID, ProductID, Quantity) VALUES (:userID, :productID, 1)";
        $stmt_insert = $pdo->prepare($sql_insert);
        if ($userID != 0 && $productID != 0) {
            $stmt_insert->execute([
                ':userID' => $userID,
                ':productID' => $productID
            ]);
            $showInfo2 = 'visible';
        }
    }
}

// 3) GÖRÜNTÜLENECEK ÜRÜNÜ ALMA (PRODUCT VIEWER)
$product_id = isset($_GET['product_id']) && is_numeric($_GET['product_id']) ? (int) $_GET['product_id'] : 1;

// Ürün bilgilerini çek
$stmt = $pdo->prepare("SELECT * FROM Products WHERE ProductID = :product_id");
$stmt->execute(['product_id' => $product_id]);
$product = $stmt->fetch();

// Önceki/sonraki ürünün varlığını kontrol et
$prev_stmt = $pdo->prepare("SELECT COUNT(*) FROM Products WHERE ProductID = :pid");
$prev_stmt->execute(['pid' => $product_id - 1]);
$has_prev = $prev_stmt->fetchColumn() > 0;

$next_stmt = $pdo->prepare("SELECT COUNT(*) FROM Products WHERE ProductID = :pid");
$next_stmt->execute(['pid' => $product_id + 1]);
$has_next = $next_stmt->fetchColumn() > 0;

// Ürün bilgileri değişkenlere aktar
if ($product) {
    $productID = $product['ProductID'];
    $productName = $product['ProductName'];
    $description = $product['Description'];
    $price = $product['Price'];
    $stock = $product['Stock'];
    $image1 = $product['Image1'];
    $image2 = $product['Image2'];
    $image3 = $product['Image3'];
    $mainPage = "./../account/mainpage.php";
} else {
    $error = "Ürün bulunamadı!";
}
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vadi Giyim - Ürünler</title>
    <style>
        @import url(./draft.css);
    </style>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <link defer rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"
        integrity="sha512-7eHRwcbYkK4d9g/6tD/mhkf++eoTHwpNM9woBxtPUBWm67zeAfFC+HrdoE2GanKeocly/VxeLvIqwvCdk7qScg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/CSSRulePlugin.min.js"
        integrity="sha512-IxxYrSNXnt/RJlxNX40+7BQL88FLqvdpVpuV9AuvpNH/NFP0L8xA8WLxWTXx6PYExB5R/ktQisp6tIrnLn8xvw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script defer src="./draft.js"></script>
</head>

<body>
    <div class="draftIntro">PRODUCTS</div>
    <div class="cursorTrigger"></div>

    <div class="container">
        <div class="navbar">
            <div class="nav nav-space"></div>
            <div class="nav nav-number">
                <span><?= htmlspecialchars($productID ?? '') ?></span>
            </div>
            <div class="nav nav-articles">
                <div class="nav-moonish"><a href="<?= htmlspecialchars($mainPage) ?>">Anasayfa</a></div>
                <div class="nav-new-in"><a href="./../cart/test.php">Sepetim</a></div>
                <div class="nav-hot-drops"><a href="./../account/account.php">Hesabım</a></div>
            </div>
            <div class="nav nav-right">
                
                <?php
                if (isset($_SESSION["userName"])) {
                    echo '<span class="kullanici">Hoş geldin ' . htmlspecialchars($_SESSION["userName"]) . '</span>';
                } else {
                    echo '<a href="./../account/registerr.php">Giriş yap</a> ';
                }
                ?>
            </div>
        </div>

        <div class="cont">
            <div class="leftFull">
                <div class="left-box">
                    <div class="products">
                        <div class="header">
                            <span><?= htmlspecialchars($productName ?? '') ?></span>
                        </div>
                        <div class="description">
                            <span><?= htmlspecialchars($description ?? '') ?></span>
                        </div>
                        <div class="stock">
                            <span class="stockfont">Stok:</span>
                            <span class="stock-quantity"><?= htmlspecialchars($stock ?? '') ?></span>
                        </div>
                        <div class="price">
                            <span class="price-font">Fiyat:</span>
                            <span class="cost-value"><?= htmlspecialchars($price ?? '') ?></span>
                        </div>

                        <!-- ADD TO CART FORM -->
                        <div class="cart">
                            <form method="post">
                                <input type="hidden" name="test" value="1">
                                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product_id) ?>">
                                <button class="cartButton" type="submit">Add to cart</button>
                            </form>
                        </div>
                        <div class="info1 <?php echo $showInfo1; ?>">
                                <span>Ürün miktarı güncellendi!</span>
                        </div>
                        <div class="info2 <?php echo $showInfo2; ?>">
                                <span>Ürün sepete eklendi!</span>
                        </div>
                        <div class="prev-and-next">
                            <div class="prev">
                                <a href="?product_id=<?= $product_id - 1 ?>">
                                    <button <?= !$has_prev ? 'disabled' : '' ?>>Önceki</button>
                                </a>
                            </div>
                            <div class="next">
                                <a href="?product_id=<?= $product_id + 1 ?>">
                                    <button <?= !$has_next ? 'disabled' : '' ?>>Sonraki</button>
                                </a>
                            </div>
                        </div>

                    </div> <!-- .products -->
                </div> <!-- .left-box -->
            </div> <!-- .leftFull -->

            <div class="middle-space"></div>

            <div class="right-full">
                <div class="big-photo">
                    <div class="fullimage">
                        <img src="<?= htmlspecialchars($image1 ?? '') ?>" alt="Product Image">
                    </div>
                    <div class="top-left">
                        <div class="photo1 photo">
                            <img src="<?= htmlspecialchars($image1 ?? '') ?>" alt="Product Image1">
                        </div>
                        <div class="photo2 photo">
                            <img src="<?= htmlspecialchars($image2 ?? '') ?>" alt="Product Image2">
                        </div>
                        <div class="photo3 photo">
                            <img src="<?= htmlspecialchars($image3 ?? '') ?>" alt="Product Image3">
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- .container -->

    </div> <!-- .content -->

</body>

</html>
