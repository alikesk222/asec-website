document.addEventListener('DOMContentLoaded', function() {
    createBinarySpiral();
});

function createBinarySpiral() {
    const spiralContainer = document.querySelector('.binary-spiral');
    if (!spiralContainer) return;
    
    // Spiral parametreleri
    const totalBits = 120;
    const spiralRect = spiralContainer.getBoundingClientRect();
    const spiralWidth = spiralContainer.offsetWidth;
    const spiralHeight = spiralContainer.offsetHeight;
    const centerX = spiralWidth / 2;
    const centerY = spiralHeight / 2;
    const circleRadius = Math.min(spiralWidth, spiralHeight) / 2 - 2; // En dış kenara daha yakın

    // Her bit için bir span oluştur (tam çember)
    for (let i = 0; i < totalBits; i++) {
        const bit = document.createElement('span');
        const value = Math.random() > 0.5 ? '1' : '0';
        bit.className = 'binary-bit';
        bit.textContent = value;
        bit.setAttribute('data-bit', value);

        // Tam çemberde eşit aralıklarla yerleştir
        const angle = (2 * Math.PI * i) / totalBits;
        const x = centerX + circleRadius * Math.cos(angle);
        const y = centerY + circleRadius * Math.sin(angle);
        bit.style.left = (x - spiralContainer.offsetLeft) + 'px';
        bit.style.top = (y - spiralContainer.offsetTop) + 'px';
        bit.style.transform = 'translate(-50%, -50%)';

        // Animasyon gecikmesi sabit
        bit.style.animationDelay = `0s`;
        
        // Sabit ve büyük font
        bit.style.fontSize = `1.6rem`;
        bit.style.letterSpacing = '0.12em';
        bit.style.opacity = 1;
        bit.style.color = '';
        
        spiralContainer.appendChild(bit);
    }
    
    // Bitleri periyodik olarak değiştir
    setInterval(() => {
        const bits = document.querySelectorAll('.binary-bit');
        bits.forEach(bit => {
            if (Math.random() > 0.8) { // %20 olasılıkla değiştir
                bit.textContent = Math.random() > 0.5 ? '1' : '0';
                
                // Parıldama efekti
                bit.classList.add('glow');
                setTimeout(() => {
                    bit.classList.remove('glow');
                }, 500);
            }
        });
    }, 1000);
}
