<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hakkımızda - ASEC Kulübü</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/hakkimizda.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <section class="about-header">
            <h2>Hakkımızda</h2>
            <p>
                ASEC Kulübü, Ankara Yıldırım Beyazıt Üniversitesi Yazılım Mühendisliği öğrencileri tarafından kurulan, yazılım mühendisliği, siber güvenlik ve teknoloji alanında gelişmeyi amaçlayan bir topluluktur.
            </p>
        </section>
        
        <section class="about-hero">
            <div class="hero-content">
                <div class="hero-text">
                    <h2 class="animate-fade-in">Hakkımızda</h2>
                    <p class="animate-slide-up">ASEC Kulübü, Ankara Yıldırım Beyazıt Üniversitesi Yazılım Mühendisliği öğrencileri tarafından kurulan, yazılım mühendisliği, siber güvenlik ve teknoloji alanında gelişmeyi amaçlayan bir topluluktur.</p>
                    <div class="hero-stats animate-scale-up">
                        <div class="stat-item">
                            <span class="stat-number">100+</span>
                            <span class="stat-label">Üye</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">15+</span>
                            <span class="stat-label">Etkinlik</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">5+</span>
                            <span class="stat-label">Proje</span>
                        </div>
                    </div>
                </div>
                <div class="hero-image animate-fade-in">
                    <img src="images/hero-image.png" alt="ASEC Kulübü Üyeleri">
                </div>
            </div>
        </section>
        
        <section class="vision-mission-section">
            <div class="container">
                <div class="section-header animate-fade-in">
                    <h2>Vizyonumuz & Misyonumuz</h2>
                    <div class="divider"></div>
                </div>
                <div class="vision-mission-grid">
                    <div class="vision-card animate-slide-up">
                        <div class="icon-container">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h3>Vizyonumuz</h3>
                        <p>Teknoloji dünyasında öncü, yenilikçi ve etik değerlere bağlı bireyler yetiştirerek, ülkemizin dijital geleceğine katkıda bulunmak.</p>
                    </div>
                    <div class="mission-card animate-slide-up">
                        <div class="icon-container">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h3>Misyonumuz</h3>
                        <p>Öğrencilere pratik deneyim, güncel teknoloji eğitimleri ve networking fırsatları sunarak, teknoloji alanında yetkin profesyoneller olmalarını sağlamak.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="values-section">
            <div class="container">
                <div class="section-header animate-fade-in">
                    <h2>Değerlerimiz</h2>
                    <div class="divider"></div>
                </div>
                <div class="values-grid">
                    <div class="value-card animate-scale-up">
                        <div class="icon-container">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h4>Yenilikçilik</h4>
                        <p>Sürekli öğrenme ve gelişime açık olmak</p>
                    </div>
                    <div class="value-card animate-scale-up">
                        <div class="icon-container">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h4>İşbirliği</h4>
                        <p>Takım çalışması ve bilgi paylaşımı</p>
                    </div>
                    <div class="value-card animate-scale-up">
                        <div class="icon-container">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4>Etik Değerler</h4>
                        <p>Güvenilirlik ve sorumluluk bilinci</p>
                    </div>
                    <div class="value-card animate-scale-up">
                        <div class="icon-container">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>Topluluk</h4>
                        <p>Birlikte öğrenme ve gelişme kültürü</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include 'footer.php'; ?>
    <script src="javascript/script.js"></script>
</body>
</html>
