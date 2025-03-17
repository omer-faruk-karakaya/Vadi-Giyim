<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ShoppingSystem";

// Veritabanı bağlantısını oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı hatası kontrolü
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri al
    $userName = $_POST["userName"];
    $email = $_POST["email"];
    $userPassword = $_POST["password"];

    // Kullanıcı adı ve e-posta ile sorgu yap
    $sql = "SELECT UserID, UserName, Email, PasswordHash FROM Users WHERE UserName = ? OR Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $userName, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Kullanıcı bulundu
        $row = $result->fetch_assoc();
        if (password_verify($userPassword, $row['PasswordHash'])) {
            // Şifre doğrulandı
            $_SESSION['id'] = $row['UserID'];
            $_SESSION['userName'] = $row['UserName'];
            $_SESSION['email'] = $row['Email'];
            header("Location: mainPage.php"); // Başarıyla giriş yaptı
            exit();
        } else {
            // Şifre yanlış
            header("Location: loginn.php?error=password");
            exit();
        }
    } else {
        // Kullanıcı adı veya e-posta bulunamadı
        header("Location: loginn.php?error=username");
        exit();
    }

    $stmt->close();
    
    $conn->close();
}
?>
