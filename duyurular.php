<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duyurular - ASEC Kulübü</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/duyurular.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <div class="announcements-container">
            <h2 class="page-title">Duyurular</h2>
            <?php
            require_once 'db.php';
            $duyurular = $pdo->query('SELECT * FROM duyurular ORDER BY tarih DESC')->fetchAll();
            ?>
            <div class="announcements-grid">
                <?php foreach($duyurular as $duyuru): ?>
                    <div class="announcement-card<?= $duyuru['kategori']=='Önemli' ? ' important' : '' ?><?= $duyuru['kategori']=='Workshop' ? ' workshop' : '' ?><?= $duyuru['kategori']=='Etkinlik' ? ' event' : '' ?>">
                        <div class="announcement-header">
                            <span class="badge"><?= htmlspecialchars($duyuru['kategori']) ?></span>
                            <span class="date"><i class="far fa-calendar-alt"></i> <?= date('d M Y', strtotime($duyuru['tarih'])) ?></span>
                        </div>
                        <h3><?= htmlspecialchars($duyuru['baslik']) ?></h3>
                        <p><?= htmlspecialchars($duyuru['icerik']) ?></p>
                        <?php if(!empty($duyuru['link'])): ?>
                            <a href="<?= htmlspecialchars($duyuru['link']) ?>" class="read-more" target="_blank">Detayları Gör <i class="fas fa-arrow-right"></i></a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
    <?php include 'footer.php'; ?>
    <script src="javascript/script.js"></script>
</body>
</html>
