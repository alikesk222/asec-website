<?php
require_once 'admin/includes/config.php';

// Blog ID'sini al
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Blog yazısını çek
$sql = "SELECT * FROM blog_posts WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$blog = mysqli_fetch_assoc($result);

// Blog bulunamadıysa ana sayfaya yönlendir
if (!$blog) {
    header("Location: blog.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($blog['title']); ?> - ASEC Kulübü</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/blog-detay.css">
</head>
<body>
        <?php include 'header.php'; ?>

    <main>
        <div class="blog-detail">
            <div class="blog-detail-header">
                <?php if (!empty($blog['image_url'])): ?>
                    <img src="admin/<?php echo !empty($blog['image_url']) ? htmlspecialchars($blog['image_url']) : 'fotograflar/default-blog.jpg'; ?>" alt="<?php echo htmlspecialchars($blog['title']); ?>">
                <?php endif; ?>
                <div class="category"><?php echo htmlspecialchars(!empty($blog['category']) ? $blog['category'] : 'Genel'); ?></div>
            </div>
            
            <div class="blog-detail-content">
                <h1 class="blog-detail-title"><?php echo htmlspecialchars($blog['title']); ?></h1>
                
                <div class="blog-detail-meta">
                    <span><i class="far fa-calendar"></i> <?php echo date('d M Y', strtotime($blog['created_at'])); ?></span>
                    <span><i class="far fa-user"></i> <?php echo htmlspecialchars($blog['author']); ?></span>
                </div>

                <div class="blog-detail-text">
                    <?php 
                    // HTML stil etiketlerini temizle ve içeriği düzgün biçimlendir
                    $content = $blog['content'];
                    $content = preg_replace('/<p style="[^"]*">/', '<p>', $content);
                    $content = strip_tags($content, '<p><br><h1><h2><h3><h4><h5><h6><ul><ol><li><blockquote><strong><em><a><img>');
                    echo $content;
                    ?>
                </div>

                <a href="blog.php" class="back-to-blog"><i class="fas fa-arrow-left"></i> Blog Yazılarına Dön</a>
            </div>
        </div>
    </main>

        <?php include 'footer.php'; ?>

    <script src="javascript/script.js"></script>
</body>
</html> 