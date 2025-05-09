<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri - ASEC Kulübü</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/galeri.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <section class="gallery-header">
            <div class="container">
                <h2>Galeri</h2>
                <p>ASEC Kulübü etkinliklerinden kareler ve özel anlar</p>
            </div>
        </section>
        <section class="gallery-filters">
            <div class="container">
                <div class="filter-buttons">
                    <button class="filter-btn active" data-filter="all">Tümü</button>
                    <button class="filter-btn" data-filter="events">Etkinlikler</button>
                    <button class="filter-btn" data-filter="workshops">Atölyeler</button>
                    <button class="filter-btn" data-filter="teams">Takım Çalışmaları</button>
                </div>
            </div>
        </section>
        <section class="gallery-grid">
            <div class="container">
                <div class="gallery-items">
                    <?php
                    require_once 'db.php';
                    $galeri = $pdo->query("SELECT * FROM galeri ORDER BY tarih DESC")->fetchAll();
                    foreach($galeri as $item): ?>
                        <div class="gallery-item" data-category="<?= htmlspecialchars($item['kategori']) ?>">
                            <img src="<?= htmlspecialchars($item['dosya_yolu']) ?>" alt="<?= htmlspecialchars($item['baslik']) ?>">
                            <div class="gallery-item-info">
                                <h3><?= htmlspecialchars($item['baslik']) ?></h3>
                                <p><?= date('F Y', strtotime($item['tarih'])) ?></p>
                                <a href="<?= htmlspecialchars($item['dosya_yolu']) ?>" class="lightbox-trigger">
                                    <i class="fas fa-expand"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>
    <?php include 'footer.php'; ?>
    
    <!-- Lightbox -->
    <div class="lightbox">
        <div class="lightbox-content">
            <img src="" alt="">
            <span class="lightbox-close"><i class="fas fa-times"></i></span>
        </div>
    </div>
    
    <script src="javascript/script.js"></script>
    <script>
        // Galeri filtreleme işlevi
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const galleryItems = document.querySelectorAll('.gallery-item');
            
            // Filtre butonları için olay dinleyicileri
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Aktif sınıfı kaldır
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    // Tıklanan butona aktif sınıfı ekle
                    this.classList.add('active');
                    
                    const filterValue = this.getAttribute('data-filter');
                    
                    // Galeri öğelerini filtrele
                    galleryItems.forEach(item => {
                        if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });
            
            // Lightbox işlevselliği
            const lightbox = document.querySelector('.lightbox');
            const lightboxImg = lightbox.querySelector('img');
            const lightboxClose = lightbox.querySelector('.lightbox-close');
            const lightboxTriggers = document.querySelectorAll('.lightbox-trigger');
            
            // Lightbox açma
            lightboxTriggers.forEach(trigger => {
                trigger.addEventListener('click', function(e) {
                    e.preventDefault();
                    const imgSrc = this.getAttribute('href');
                    lightboxImg.setAttribute('src', imgSrc);
                    lightbox.classList.add('active');
                });
            });
            
            // Lightbox kapatma
            lightboxClose.addEventListener('click', function() {
                lightbox.classList.remove('active');
            });
            
            // Lightbox dışına tıklayarak kapatma
            lightbox.addEventListener('click', function(e) {
                if (e.target === this) {
                    lightbox.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>
