document.addEventListener('DOMContentLoaded', function() {
    // Matrix animasyonu için canvas oluştur
    const canvas = document.createElement('canvas');
    canvas.id = 'matrix-canvas';
    canvas.classList.add('matrix-canvas');
    
    // Canvas'ı auth-page veya hero bölümüne ekle
    const authPage = document.querySelector('.auth-page');
    const heroSection = document.querySelector('.hero');
    
    let container = null;
    
    if (authPage) {
        container = authPage;
    } else if (heroSection) {
        container = heroSection;
    }
    
    if (container) {
        // Canvas'ı container'a ekle
        container.appendChild(canvas);
        
        // Canvas'ı tam ekran yap
        canvas.width = container.offsetWidth;
        canvas.height = container.offsetHeight;
        
        // Pencere boyutu değiştiğinde canvas'ı yeniden boyutlandır
        window.addEventListener('resize', function() {
            canvas.width = container.offsetWidth;
            canvas.height = container.offsetHeight;
        });
        
        // Matrix animasyonunu başlat
        const ctx = canvas.getContext('2d');
        
        // Binary karakterler (0 ve 1)
        const binary = "01";
        
        // Font boyutu
        const fontSize = 14;
        
        // Sütun sayısı
        const columns = Math.floor(canvas.width / fontSize);
        
        // Her sütunun Y pozisyonu
        const drops = [];
        for (let i = 0; i < columns; i++) {
            drops[i] = Math.floor(Math.random() * -canvas.height);
        }
        
        // Karakterlerin çizimi
        function draw() {
            // Yarı saydam siyah arka plan (iz efekti için)
            ctx.fillStyle = 'rgba(27, 31, 59, 0.05)';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            
            // Karakterlerin rengi ve fontu
            ctx.fillStyle = 'rgba(147, 112, 219, 0.8)'; // Menekşe rengi
            ctx.font = fontSize + 'px monospace';
            
            // Her sütun için
            for (let i = 0; i < drops.length; i++) {
                // Rastgele bir binary karakter seç
                const text = binary.charAt(Math.floor(Math.random() * binary.length));
                
                // Karakteri çiz
                ctx.fillText(text, i * fontSize, drops[i] * fontSize);
                
                // Karakterin Y pozisyonunu güncelle
                drops[i]++;
                
                // Karakterin ekranın altına ulaştığında veya rastgele bir şekilde
                // yeniden başlamasını sağla
                if (drops[i] * fontSize > canvas.height && Math.random() > 0.975) {
                    drops[i] = Math.floor(Math.random() * -20);
                }
            }
        }
        
        // Animasyonu başlat
        setInterval(draw, 50);
    }
});
