

const intro = gsap.timeline();
intro.to(".draftIntro",{
    y:-750,
    delay:1,
    display:"none"

})
intro.pause();
// Geçerli URL'yi al
const url = new URL(window.location.href);

// "product_id" parametresini al
const productId = url.searchParams.get("product_id");
let counter = { value:1}
// Eğer product_id "1" ise bir işlem yap, değilse başka bir işlem yap
if (productId === "1") {
    intro.resume();
    // Burada işlemini yap
} else {
    gsap.set(".draftIntro",{display:"none"});
}

document.querySelectorAll('.photo1, .photo2, .photo3').forEach(photo => {
    photo.addEventListener('click', function () {
        const clickedImageSrc = this.querySelector('img').getAttribute('src'); // Tıklanan div içindeki img'in kaynağını al
        const fullImage = document.querySelector('.fullimage img'); // fullimage içindeki img'i seç

        // GSAP Timeline ile animasyon oluştur
        const tl = gsap.timeline();
        tl.to(fullImage, {
            x: -200, // Soldan kaydır
            opacity: 0,
            duration: 0.5,
            onComplete: function () {
                // Kaynak değiştir
                fullImage.setAttribute('src', clickedImageSrc);
            }
        })
            .fromTo(fullImage,
                { x: 200, opacity: 0 }, // Yeni görsel sağdan başlasın
                { x: 0, opacity: 1, duration: 0.5 } // Ortaya kayarak görünsün
            );
    });
});







// GSAP ayarları
gsap.set(".cursorTrigger", { xPercent: -50, yPercent: -50 });

let xPos = 0, yPos = 0; // Cursor'un hedef pozisyonu
let x = 0, y = 0;       // Animasyonlu pozisyon

let xSetter = gsap.quickSetter(".cursorTrigger", "x", "px"); // x pozisyonu için
let ySetter = gsap.quickSetter(".cursorTrigger", "y", "px"); // y pozisyonu için

// Mouse hareketlerini dinle
window.addEventListener("mousemove", e => {
    xPos = e.x; // Mouse'un anlık x pozisyonu
    yPos = e.y; // Mouse'un anlık y pozisyonu
});

// Mouse üzerine gelince display: block yap
window.addEventListener("mouseover", () => {
    document.querySelector(".cursorTrigger").style.display = "block";
});

// Her frame'de pozisyonları güncelle
gsap.ticker.add(() => {
    // Hedef pozisyona doğru yumuşak geçiş (lerp fonksiyonu)
    x += (xPos - x) * 0.07; // Geçişi yavaşlat
    y += (yPos - y) * 0.07;

    xSetter(x); // Güncel x pozisyonunu ayarla
    ySetter(y); // Güncel y pozisyonunu ayarla
});





document.getElementById("clickable-image").addEventListener("click", function () {
    
    window.location.href = "./../cart/test.php"; // Gidilecek URL
});




if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
