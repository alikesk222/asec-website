<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASEC Kulübü - Siber Güvenlik ve Yazılım Topluluğu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <section class="hero">
            <div class="hero-container">
                <div class="binary-spiral-container">
                    <div class="binary-spiral"></div>
                </div>
                
                <div class="animated-asec-container">
                    <div class="animated-asec">
                        <span class="letter" data-text="A">A</span>
                        <span class="letter" data-text="S">S</span>
                        <span class="letter" data-text="E">E</span>
                        <span class="letter" data-text="C">C</span>
                    </div>
                </div>
                
                <div class="hero-content">
                    <h2>Geleceğin Teknolojisini Şekillendiriyoruz</h2>
                    <p>ASEC Kulübü ile siber güvenlik ve yazılım dünyasında yerinizi alın!</p>
                    <div class="cta-buttons">
                        <a href="register" class="btn-primary">Hemen Katıl</a>
                        <a href="hakkimizda" class="btn-secondary">Daha Fazla Bilgi</a>
                    </div>
                </div>
            </div>
        </section>
        <!--neler sunuyoruz kısmı-->
        <section class="features">
            <h2>Neler Sunuyoruz?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-shield-alt"></i>
                    <h3>Siber Güvenlik Eğitimleri</h3>
                    <p>Uzman eğitmenlerle siber güvenlik alanında kendinizi geliştirin. Eğitimlerimizde teorik bilgiler ve pratik uygulamalar ile güvenlik uzmanlığı yolunda ilerleyin.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-code"></i>
                    <h3>Yazılım Geliştirme</h3>
                    <p>Modern programlama dilleri ve frameworks ile projeler geliştirin. Ekip çalışması ve güncel teknolojiler ile gerçek dünya projelerinde deneyim kazanın.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-users"></i>
                    <h3>Networking</h3>
                    <p>Sektör profesyonelleri ile tanışın ve deneyim paylaşın. Kariyer fırsatları yakalayin ve teknoloji dünyasında güçlü bir network oluşturun.</p>
                </div>
            </div>
        </section>
        
        <!--yaklaşan etkinlikler-->
        <section class="upcoming-events">
            <h2>Yaklaşan Etkinlikler</h2>
            <div class="events-slider">
                <div class="event-card">
                    <div class="event-date">15 Mayıs</div>
                    <h3>Web Güvenliği Workshop</h3>
                    <p>OWASP Top 10 ve güvenli web uygulamaları geliştirme. Güncel güvenlik açıkları ve bunlara karşı alınabilecek önlemler hakkında detaylı bir eğitim.</p>
                    <a href="etkinlikler" class="event-button">Detaylar</a>
                </div>
                <div class="event-card">
                    <div class="event-date">20 Mayıs</div>
                    <h3>Python ile Veri Analizi</h3>
                    <p>Temel python ve veri analizi teknikleri. Pandas, NumPy ve Matplotlib kütüphaneleri ile veri işleme ve görselleştirme üzerine uygulamalı workshop.</p>
                    <a href="etkinlikler" class="event-button">Detaylar</a>
                </div>
                <div class="event-card">
                    <div class="event-date">5 Haziran</div>
                    <h3>Yapay Zeka Semineri</h3>
                    <p>Güncel yapay zeka teknolojileri ve uygulamaları. Machine Learning, Deep Learning ve AI uygulamalarının günlük hayatımıza etkileri.</p>
                    <a href="etkinlikler" class="event-button">Detaylar</a>
                </div>
            </div>
        </section>
    </main>
    <?php include 'footer.php'; ?>
    <script src="javascript/matrix-animation.js"></script>
    <script src="javascript/script.js"></script>
    <script src="javascript/binary-spiral.js"></script>
</body>
</html>
