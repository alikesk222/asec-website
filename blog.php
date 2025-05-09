<?php
require_once 'admin/includes/config.php';

// Blog yazılarını çek
$sql = "SELECT * FROM blog_posts ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - ASEC Kulübü</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/blog.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <div class="blog-container">
            <h2 class="page-title">Blog Yazılarımız</h2>
            <div class="blog-grid">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $image_url = !empty($row['image_url']) ? $row['image_url'] : 'fotograflar/default-blog.jpg';
                        ?>
                        <article class="blog-card">
                            <div class="blog-image">
                                <img src="admin/<?php echo !empty($row['image_url']) ? htmlspecialchars($row['image_url']) : 'fotograflar/default-blog.jpg'; ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                            </div>
                            <div class="category"><?php echo htmlspecialchars(!empty($row['category']) ? $row['category'] : 'Genel'); ?></div>
                            <div class="blog-content">
                                <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                                <p class="blog-excerpt"><?php echo htmlspecialchars(substr(strip_tags($row['content']), 0, 150)) . '...'; ?></p>
                                <div class="blog-meta">
                                    <span class="date"><i class="far fa-calendar"></i> <?php echo date('d M Y', strtotime($row['created_at'])); ?></span>
                                    <span class="author"><i class="far fa-user"></i> <?php echo htmlspecialchars($row['author']); ?></span>
                                </div>
                                <a href="blog-detay.php?id=<?php echo $row['id']; ?>" class="read-more">Devamını Oku <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </article>
                        <?php
                    }
                } else {
                    ?>
                    <div class="no-posts">
                        <i class="fas fa-newspaper"></i>
                        <h3>Henüz Blog Yazısı Bulunmuyor</h3>
                        <p>Yakında yeni blog yazıları eklenecektir. Lütfen daha sonra tekrar ziyaret edin.</p>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
    <script src="javascript/script.js"></script>
</body>
</html>