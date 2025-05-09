<?php
// Veritabanı bağlantısı
$host = 'localhost';
$db = 'db_asec';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Veritabanı bağlantı hatası: ' . $e->getMessage());
}

// Form gönderildiyse
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    
    if ($name && $email && $subject && $message) {
        $stmt = $pdo->prepare('INSERT INTO mesajlar (ad, email, konu, mesaj, ip, tarih) VALUES (?, ?, ?, ?, ?, NOW())');
        $stmt->execute([$name, $email, $subject, $message, $ip]);
        $success = true;
    } else {
        $error = 'Lütfen tüm alanları doldurun.';
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İletişim - ASEC Kulübü</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/iletisim.css">
</head>
<body class="iletisim-page">
    <?php include 'header.php'; ?>

    <main>
        <div class="page-header">
            <h1>İletişime Geçin</h1>
            <p>Aşağıdaki formu doldurarak veya iletişim bilgilerimizden bize ulaşabilirsiniz.</p>
        </div>
        <section class="contact-container">
            <!-- Sol: Bilgi ve Sosyal Medya -->
            <div class="contact-info">
                <div>
                    <h2>İletişim Bilgileri</h2>
                    <div class="contact-details">
                        <div class="contact-item"><i class="fas fa-map-marker-alt"></i> Üniversite Mahallesi, Kampüs Caddesi No:1</div>
                        <div class="contact-item"><i class="fas fa-phone"></i> +90 555 123 4567</div>
                        <div class="contact-item"><i class="fas fa-envelope"></i> info@aseckulubu.com</div>
                    </div>
                </div>
                <div class="social-media">
                    <h3>Sosyal Medyada Biz</h3>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-discord"></i></a>
                    </div>
                    <div class="whatsapp-group">
                        <div class="whatsapp-card">
                            <div class="wa-card-header">
                                <i class="fab fa-whatsapp"></i>
                                <span>WhatsApp Grubumuza Katıl!</span>
                            </div>
                            <div class="wa-card-body">Kulüp duyuruları, etkinlikler ve iletişim için topluluğumuza hemen katıl!</div>
                            <a href="https://chat.whatsapp.com/YOUR-GROUP-LINK" target="_blank" class="wa-join-btn">
                                <i class="fab fa-whatsapp"></i> Gruba Hemen Katıl
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sağ: Form -->
            <div class="contact-form">
                <h3>Bize Ulaşın</h3>
                <?php if (!empty($success)) { echo '<div class="alert-success">Mesajınız başarıyla gönderildi!</div>'; } ?>
                <?php if (!empty($error)) { echo '<div class="alert-error">'.$error.'</div>'; } ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="name">Adınız:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-posta:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Konu:</label>
                        <input type="text" id="subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Mesajınız:</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="cta-button">Gönder</button>
                </form>
            </div>
        </section>
    </main>
    <?php include 'footer.php'; ?>
    <script src="javascript/script.js"></script>
</body>
</html>
