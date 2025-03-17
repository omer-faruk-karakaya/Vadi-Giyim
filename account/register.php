<?php
// Oturum başlat
session_abort();
session_start();

// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ShoppingSystem";

// Bağlantı oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı kontrolü
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri al
    $userName = $_POST["userName"];
    $email = $_POST["email"];
    $userPassword = $_POST["password"];

    // Şifreyi hashle
    $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

    // SQL sorgusu ile veritabanına kaydet
    $sql2 = "SELECT * FROM users WHERE Email = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("s", $email);
    $stmt2->execute();
    $result = $stmt2->get_result();
    $stmt2->close();


    $sql = "INSERT INTO Users (UserName, Email, PasswordHash) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $userName, $email, $hashedPassword);
    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Bu e-posta zaten kayıtlı."; // Hata mesajı
        header("Location: registerr.php"); // Hata sonrası tekrar kayıt sayfasına yönlendir
        exit();
    } else {
        // Kayıt işlemi
        if ($stmt->execute()) {
            // Kullanıcıyı oturum açarak yönlendir
            $_SESSION['userName'] = $userName; // Oturumu başlatıyoruz
            $_SESSION['email'] = $email; // Email de saklanabilir
            $_SESSION['success'] = "Kayıt başarılı! Lütfen giriş yapın."; // Başarılı mesajı
            // Başarılı kayıt sonrası login sayfasına yönlendir
            header("Location: loginn.php");
            exit();
        } else {
            $_SESSION['error'] = "Kayıt başarısız."; // Hata mesajı
            header("Location: registerr.php"); // Hata sonrası tekrar kayıt sayfasına yönlendir
            exit();
        }
    }

    $stmt->close();
    $conn->close();
}
?>