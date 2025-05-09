<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etkinlikler - ASEC Kulübü</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/etkinlikler.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <div class="events-container">
            <h2 class="page-title">Etkinliklerimiz</h2>
            <?php
            require_once 'db.php';
            $today = date('Y-m-d');
            $stmt = $pdo->prepare("SELECT * FROM etkinlikler ORDER BY tarih DESC");
            $stmt->execute();
            $etkinlikler = $stmt->fetchAll();
            ?>
            <!-- Yaklaşan Etkinlikler -->
            <section class="events-section">
                <h3 class="section-title">Yaklaşan Etkinlikler</h3>
                <div class="events-grid">
                <?php foreach ($etkinlikler as $etkinlik):
                    if ($etkinlik['tarih'] >= $today): ?>
                    <div class="event-card upcoming">
                        <div class="event-date">
                            <?php $t = strtotime($etkinlik['tarih']); ?>
                            <span class="day"><?= date('d', $t) ?></span>
                            <span class="month"><?= strftime('%B', $t) ?></span>
                        </div>
                        <div class="event-details">
                            <h4><?= htmlspecialchars($etkinlik['baslik']) ?></h4>
                            <p class="event-description"><?= htmlspecialchars($etkinlik['aciklama']) ?></p>
                            <div class="event-info">
                                <span><i class="fas fa-clock"></i> <?= htmlspecialchars($etkinlik['saat']) ?></span>
                                <span><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($etkinlik['yer']) ?></span>
                            </div>
                            <div style="margin-top: 8px; display: flex; gap: 8px;">
                                <a href="etkinlik-detay.php?id=<?= $etkinlik['id'] ?>" class="btn btn-sm btn-info" style="background:#eee;border-radius:4px;padding:5px 12px;font-size:14px;">Detay</a>
<a href="#" class="btn btn-sm btn-info detay-modal-btn" data-id="<?= $etkinlik['id'] ?>" style="background:#e3e6f3;border-radius:4px;padding:5px 12px;font-size:14px;">Hızlı Detay</a>
                                <?php if (!empty($etkinlik['kayit_link'])): ?>
                                    <a href="<?= htmlspecialchars($etkinlik['kayit_link']) ?>" class="register-btn" target="_blank">Kayıt Ol</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; endforeach; ?>
                </div>
            </section>
            <!-- Geçmiş Etkinlikler -->
            <section class="events-section past-events">
                <h3 class="section-title">Geçmiş Etkinlikler</h3>
                <div class="events-grid">
                <?php foreach ($etkinlikler as $etkinlik):
                    if ($etkinlik['tarih'] < $today): ?>
                    <div class="event-card past">
                        <div class="event-date">
                            <?php $t = strtotime($etkinlik['tarih']); ?>
                            <span class="day"><?= date('d', $t) ?></span>
                            <span class="month"><?= strftime('%B', $t) ?></span>
                        </div>
                        <div class="event-details">
                            <h4><?= htmlspecialchars($etkinlik['baslik']) ?></h4>
                            <p class="event-description"><?= htmlspecialchars($etkinlik['aciklama']) ?></p>
                            <div class="event-info">
                                <span><i class="fas fa-clock"></i> <?= htmlspecialchars($etkinlik['saat']) ?></span>
                                <span><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($etkinlik['yer']) ?></span>
                            </div>
                            <div style="margin-top: 8px; display: flex; gap: 8px;">
                                <a href="etkinlik-detay.php?id=<?= $etkinlik['id'] ?>" class="btn btn-sm btn-info" style="background:#eee;border-radius:4px;padding:5px 12px;font-size:14px;">Detay</a>
<a href="#" class="btn btn-sm btn-info detay-modal-btn" data-id="<?= $etkinlik['id'] ?>" style="background:#e3e6f3;border-radius:4px;padding:5px 12px;font-size:14px;">Hızlı Detay</a>
                            </div>
                        </div>
                    </div>
                <?php endif; endforeach; ?>
                </div>
            </section>
            </section>
        </div>
    </main>
    <?php include 'footer.php'; ?>
    <script src="javascript/script.js"></script>
</body>
</html>
