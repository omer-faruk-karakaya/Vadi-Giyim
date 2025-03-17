<?php
session_start(); // Oturumu başlat

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ShoppingSystem";

// Veritabanına bağlan
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
    
    // Kullanıcıya ait sepeti çek
    $sql = "SELECT * FROM Cart WHERE UserID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Sonuçları yazdır
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Product ID: " . $row['ProductID'] . " - Quantity: " . $row['Quantity'] . "<br>";
        }
    } else {
        echo $_SESSION['id'];
        echo "Sepetiniz boş.";
    }
    
    $stmt->close();
} else {
    echo "Oturum bulunamadı. Lütfen giriş yapın.";
}

$conn->close();
?>
