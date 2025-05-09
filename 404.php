<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sayfa Bulunamadı - ASEC Kulübü</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <style>
        .error-container {
            min-height: 70vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            text-align: center;
            background: linear-gradient(135deg, rgba(27, 31, 59, 0.05) 0%, rgba(106, 13, 173, 0.05) 100%);
        }
        
        .error-code {
            font-size: 8rem;
            font-weight: 700;
            color: #1B1F3B;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #1B1F3B, #6A0DAD);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            color: transparent;
        }
        
        .error-title {
            font-size: 2rem;
            font-weight: 600;
            color: #1B1F3B;
            margin-bottom: 1.5rem;
        }
        
        .error-message {
            font-size: 1.1rem;
            color: #555;
            max-width: 600px;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        
        .error-icon {
            font-size: 5rem;
            color: #6A0DAD;
            margin-bottom: 2rem;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.1);
                opacity: 0.8;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        .btn-home {
            display: inline-block;
            background-color: #6A0DAD;
            color: #fff;
            padding: 0.8rem 1.5rem;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            margin-top: 1rem;
        }
        
        .btn-home:hover {
            background-color: #4B0082;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(106, 13, 173, 0.3);
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    
    <main>
        <div class="error-container">
            <i class="fas fa-search error-icon"></i>
            <div class="error-code">404</div>
            <h1 class="error-title">Sayfa Bulunamadı</h1>
            <p class="error-message">
                Aradığınız sayfa mevcut değil veya taşınmış olabilir. Lütfen URL'yi kontrol edin veya ana sayfaya dönün.
            </p>
            <a href="/" class="btn-home">
                <i class="fas fa-home"></i> Ana Sayfaya Dön
            </a>
        </div>
    </main>
    
    <?php include 'footer.php'; ?>
</body>
</html>
