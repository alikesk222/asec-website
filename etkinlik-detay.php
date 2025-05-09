<?php
// Etkinlik Detay Sayfası
require_once 'db.php';
$id = intval($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT * FROM etkinlikler WHERE id=?');
$stmt->execute([$id]);
$etkinlik = $stmt->fetch();
if (!$etkinlik) die('Etkinlik bulunamadı!');
$fotolar = $pdo->prepare('SELECT * FROM etkinlik_fotolar WHERE etkinlik_id=?');
$fotolar->execute([$id]);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($etkinlik['baslik']) ?> - ASEC Kulübü</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/etkinlik-detay.css">
</head>
<body>
    <?php include 'header.php'; ?>
    
    <main>
    <div class="event-detail-container">
        <div class="event-detail-card">
            <div class="event-header">
                <h1><?= htmlspecialchars($etkinlik['baslik']) ?></h1>
                <?php 
                $bugun = date('Y-m-d');
                if($etkinlik['tarih'] >= $bugun): 
                ?>
                <span class="event-status upcoming">Yaklaşan Etkinlik</span>
                <?php else: ?>
                <span class="event-status past">Geçmiş Etkinlik</span>
                <?php endif; ?>
            </div>
            
            <div class="event-content">
                <div class="event-info-grid">
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <div class="info-text">
                            <div class="info-label">Tarih</div>
                            <div class="info-value"><?= htmlspecialchars($etkinlik['tarih']) ?></div>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="info-text">
                            <div class="info-label">Saat</div>
                            <div class="info-value"><?= htmlspecialchars($etkinlik['saat']) ?></div>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="info-text">
                            <div class="info-label">Yer</div>
                            <div class="info-value"><?= htmlspecialchars($etkinlik['yer']) ?></div>
                        </div>
                    </div>
                </div>
                
                <div class="event-description">
                    <h2>Etkinlik Açıklaması</h2>
                    <p><?= nl2br(htmlspecialchars($etkinlik['aciklama'])) ?></p>
                </div>
                
                <?php if (!empty($etkinlik['kayit_link'])): ?>
                    <a href="<?= htmlspecialchars($etkinlik['kayit_link']) ?>" target="_blank" class="register-btn">
                        <i class="fas fa-user-plus"></i> Etkinliğe Kayıt Ol
                    </a>
                <?php endif; ?>
                
                <div class="gallery-section">
                    <h2>Fotoğraf Galerisi</h2>
                    <div class="gallery-grid">
                        <?php if($fotolar->rowCount() > 0): ?>
                            <?php foreach($fotolar as $foto): ?>
                                <div class="gallery-item">
                                    <img src="<?= htmlspecialchars($foto['dosya_yolu']) ?>" alt="Etkinlik Fotoğrafı">
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="no-photos">
                                <i class="fas fa-images"></i>
                                <p>Henüz fotoğraf eklenmemiş.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <a href="etkinlikler.php" class="back-to-events">
                    <i class="fas fa-arrow-left"></i> Tüm Etkinliklere Dön
                </a>
            </div>
        </div>
    </div>
    </main>
    
    <?php include 'footer.php'; ?>
    <script src="javascript/script.js"></script>
</body>
</html>
