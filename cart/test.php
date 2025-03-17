<?php
$showInfo3 = '';  // info1'i göster
$showInfo4 = '';
class ShoppingCart
{
    private $conn;
    public $userID;

    public function __construct($servername, $username, $password, $dbname)
    {
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Veritabanına bağlanılamadı: " . $this->conn->connect_error);
        }

        session_start();

        if (isset($_SESSION['id'])) {
            $this->userID = $_SESSION['id'];
        } else {
            $message = "Lütfen hesabınıza giriş yapınız!";

            // JavaScript ile alert ve yönlendirme
            echo "<script type='text/javascript'>
                    alert('$message');
                    window.location.href = './../account/registerr.php';
                </script>";
            exit; // Kodun devamını durdur
        }
    }

    public function removeProduct($productID)
    {
        $sql = "DELETE FROM cart WHERE UserID = ? AND ProductID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $this->userID, $productID);

        if ($stmt->execute()) {
            //sen normal bir şekilde yaz htmlini
            //echo "Ürün başarıyla sepetten çıkarıldı.<br>";
        } else {
            echo "Ürün çıkarılırken bir hata oluştu.<br>";
        }

        $stmt->close();
    }

    public function clearCart()
    {
        $sql = "DELETE FROM cart WHERE UserID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $this->userID);

        if ($stmt->execute()) {
            //echo "Sepet başarıyla temizlendi.<br>";
        } else {
            echo "Sepet temizlenirken bir hata oluştu.<br>";
        }

        $stmt->close();
    }

    public function getCartItems()
    {
        $sql = "SELECT cart.ProductID, products.ProductName, products.Price, products.Description, cart.Quantity
                FROM cart
                INNER JOIN products ON cart.ProductID = products.ProductID
                WHERE cart.UserID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $this->userID);
        $stmt->execute();
        $result = $stmt->get_result();

        $stmt->close();

        return $result;
    }

    public function closeConnection()
    {
        $this->conn->close();
    }
}

$cart = new ShoppingCart("localhost", "root", "", "shoppingsystem");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'remove_product' && isset($_POST['product_id'])) {
            $cart->removeProduct($_POST['product_id']);
        } elseif ($_POST['action'] === 'clear_cart') {
            $cart->clearCart();
        }
    }
}

$cartItems = $cart->getCartItems();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cart.css">
    <title>Cart</title>
    <script src="./cart.js" defer></script>
</head>

<body>
    
    <div class="cartBg">
    <div class="arkaplan"></div>
        <div class="container">
            <div class="return">
                <a href="./../account/mainPage.php">Anasayfa</a>
            </div>
            <?php
            $cartItems = $cart->getCartItems();
            $userID = $cart->userID;
            $user = $_SESSION["userName"]

                ?>
            <div class="hg">
                <h1>Hoş geldin <?php echo htmlspecialchars($user); ?></h1>
            </div>
            
            <div class="yazi1">
                <span>çıkarıldı.</span>

            </div>
            <div class="yazi2">
                temizlendi.
            </div>
            <h2>Sepetiniz</h2>
            <table>
                <thead>
                    <tr>
                        <th>Ürün ID</th>
                        <th>Ürün Adı</th>
                        <th>Fiyat</th>
                        <th>Açıklama</th>
                        <th>Adet</th>
                        <th>İşlem</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($cartItems->num_rows > 0) {
                        while ($row = $cartItems->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td data-label='Ürün ID'>" . htmlspecialchars($row['ProductID']) . "</td>";
                            echo "<td data-label='Ürün Adı'>" . htmlspecialchars($row['ProductName']) . "</td>";
                            echo "<td data-label='Fiyat'>" . htmlspecialchars($row['Price']) . " TL</td>";
                            echo "<td data-label='Açıklama'>" . htmlspecialchars($row['Description']) . "</td>";
                            echo "<td data-label='Adet'>" . htmlspecialchars($row['Quantity']) . "</td>";
                            echo "<td data-label='İşlem'>
                <form method='POST'>
                    <input type='hidden' name='product_id' value='" . htmlspecialchars($row['ProductID']) . "'>
                    <input type='hidden' name='action' value='remove_product'>
                    <button type='submit'>Ürünü Sil</button>
                </form>
            </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Sepetiniz boş.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <form method="POST">
                <input type="hidden" name="action" value="clear_cart">
                <button class="clear-cart" type="submit">Tüm Sepeti Temizle</button>
            </form>
        </div>

    </div>
    <div class="info3 <?php echo $showInfo3; ?>">
        <span>Ürün başarıyla sepetten çıkarıldı.<br></span>
    </div>
    <div class="info4 <?php echo $showInfo4; ?>">
        <span>Ürün sepete eklendi!</span>
    </div>
</body>

</html>

<?php
$cart->closeConnection();
?>