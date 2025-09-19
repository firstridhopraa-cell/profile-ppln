document.addEventListener('DOMContentLoaded', () => {

    function initializeRevealAnimation() {
        const revealElements = document.querySelectorAll('.reveal');
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => { if (entry.isIntersecting) { entry.target.classList.add('active'); observer.unobserve(entry.target); } });
        }, { threshold: 0.15 });
        revealElements.forEach(el => { revealObserver.observe(el); });
    }

    async function loadDynamicContent() {
        try {
            const response = await fetch('http://localhost/ppln/api.php');
            const data = await response.json();

            if (data.profil) {
                const profil = data.profil;
                // Helper function to set text content
                const setText = (id, value) => { const el = document.getElementById(id); if (el) el.innerText = value; };
                const setHTML = (id, value) => { const el = document.getElementById(id); if (el) el.innerHTML = value; };

                // Hero Section
                setText('hero-judul-1', profil.hero_judul1);
                setText('hero-deskripsi-1', profil.hero_deskripsi1);
                setHTML('hero-tombol-1', `${profil.hero_tombol1} <i class="fas fa-arrow-right"></i>`);
                document.getElementById('hero-slide-1').style.backgroundImage = `url(uploads/${profil.hero_gambar1})`;
                
                setText('hero-judul-2', profil.hero_judul2);
                setText('hero-deskripsi-2', profil.hero_deskripsi2);
                setHTML('hero-tombol-2', `${profil.hero_tombol2} <i class="fas fa-cogs"></i>`);
                document.getElementById('hero-slide-2').style.backgroundImage = `url(uploads/${profil.hero_gambar2})`;

                // Section Titles
                setText('tentang-judul', profil.tentang_judul);
                setText('tentang-subjudul', profil.tentang_subjudul);
                setText('layanan-judul', profil.layanan_judul);
                setText('layanan-subjudul', profil.layanan_subjudul);
                setText('proyek-judul', profil.proyek_judul);
                setText('proyek-subjudul', profil.proyek_subjudul);
                setText('kontak-judul', profil.kontak_judul);
                setText('kontak-subjudul', profil.kontak_subjudul);
                
                // About Us Section
                setHTML('corporate-vision', `<strong>Visi:</strong> ${profil.visi}`);
                setHTML('corporate-mission', `<strong>Misi:</strong> ${profil.misi}`);
                setHTML('tugas-pokok', profil.tugas_pokok);
                setHTML('nilai-akhlak', profil.nilai_akhlak);

                // Services Section
                setText('layanan-judul-1', profil.layanan_judul_1);
                setText('layanan-deskripsi-1', profil.layanan_deskripsi_1);
                setText('layanan-judul-2', profil.layanan_judul_2);
                setText('layanan-deskripsi-2', profil.layanan_deskripsi_2);
                setText('layanan-judul-3', profil.layanan_judul_3);
                setText('layanan-deskripsi-3', profil.layanan_deskripsi_3);
                setText('layanan-judul-4', profil.layanan_judul_4);
                setText('layanan-deskripsi-4', profil.layanan_deskripsi_4);

                // Contact & Footer Section
                setHTML('kontak-alamat', `<i class="fas fa-map-marker-alt"></i> <strong>Kantor UPT Tanjung Karang:</strong> ${profil.kontak_alamat}`);
                setHTML('kontak-telepon', `<i class="fas fa-phone-alt"></i> <strong>Telepon Kantor:</strong> ${profil.kontak_telepon}`);
                setHTML('kontak-center', `<i class="fas fa-headset"></i> <strong>Contact Center :</strong> ${profil.kontak_center}`);
                setHTML('kontak-email', `<i class="fas fa-envelope"></i> <strong>Email Resmi:</strong> ${profil.kontak_email}`);
                document.getElementById('link-instagram').href = profil.link_instagram;
                document.getElementById('link-youtube').href = profil.link_youtube;
                setText('footer-deskripsi', profil.footer_deskripsi);
                setText('footer-copyright', profil.footer_copyright);
                setText('footer-alamat', profil.kontak_alamat);
                setText('footer-kontak', `Contact Center: ${profil.kontak_center}`);
            }

            if (data.proyek) {
                const projectsContainer = document.getElementById('projects-container');
                projectsContainer.innerHTML = '';
                data.proyek.forEach(proyek => {
                    const projectItemHTML = `<div class="project-item reveal"><img src="uploads/${proyek.gambar}" alt="${proyek.judul}"><div class="project-info"><h3>${proyek.judul}</h3><p>${proyek.deskripsi}</p></div></div>`;
                    projectsContainer.innerHTML += projectItemHTML;
                });
                initializeRevealAnimation();
            }
        } catch (error) {
            console.error('Gagal memuat konten dinamis:', error);
        }
    }

    loadDynamicContent();

    // --- KODE LAMA ANDA (SEMUA FUNGSI LAINNYA) ---
    const preloader = document.getElementById('preloader');
    if (preloader) { window.addEventListener('load', () => { preloader.style.opacity = '0'; setTimeout(() => { preloader.style.display = 'none'; }, 500); }); }
    document.querySelectorAll('a[href^="#"]').forEach(anchor => { anchor.addEventListener('click', function (e) { e.preventDefault(); const targetId = this.getAttribute('href'); const targetElement = document.querySelector(targetId); if (targetElement) { const headerOffset = document.querySelector('.main-header').offsetHeight; const elementPosition = targetElement.getBoundingClientRect().top + window.pageYOffset; const offsetPosition = elementPosition - headerOffset - 20; window.scrollTo({ top: offsetPosition, behavior: 'smooth' }); if (window.innerWidth <= 992) { document.querySelector('.nav-links').classList.remove('active'); document.querySelector('.hamburger').classList.remove('active'); } } }); });
    const backToTopBtn = document.getElementById('backToTopBtn');
    window.addEventListener('scroll', () => { if (window.pageYOffset > 300) { backToTopBtn.style.display = 'block'; } else { backToTopBtn.style.display = 'none'; } });
    backToTopBtn.addEventListener('click', () => { window.scrollTo({ top: 0, behavior: 'smooth' }); });
    const sections = document.querySelectorAll('main section'); const navLinks = document.querySelectorAll('.nav-links a'); const setActiveNav = () => { let current = 'hero'; sections.forEach(section => { const sectionTop = section.offsetTop - document.querySelector('.main-header').offsetHeight - 50; if (pageYOffset >= sectionTop) { current = section.getAttribute('id'); } }); navLinks.forEach(link => { link.classList.remove('active'); if (link.getAttribute('href').includes(current)) { link.classList.add('active'); } }); }; window.addEventListener('scroll', setActiveNav); setActiveNav();
    const hamburger = document.querySelector('.hamburger'); const mobileNavLinks = document.querySelector('.nav-links'); hamburger.addEventListener('click', () => { mobileNavLinks.classList.toggle('active'); hamburger.classList.toggle('active'); });
    const carouselItems = document.querySelectorAll('.carousel-item'); const carouselDots = document.querySelectorAll('.carousel-nav .dot'); let currentSlide = 0; function showSlide(index) { if (carouselItems.length === 0) return; carouselItems.forEach((item, i) => { item.classList.remove('active'); if(carouselDots[i]) carouselDots[i].classList.remove('active'); if (i === index) { item.classList.add('active'); if(carouselDots[i]) carouselDots[i].classList.add('active'); } }); } function nextSlide() { if (carouselItems.length === 0) return; currentSlide = (currentSlide + 1) % carouselItems.length; showSlide(currentSlide); } if (carouselDots.length > 0) { carouselDots.forEach(dot => { dot.addEventListener('click', function() { currentSlide = parseInt(this.dataset.slide); showSlide(currentSlide); }); }); setInterval(nextSlide, 7000); }
    function setupCarousel(containerSelector, prevBtnSelector, nextBtnSelector) { const container = document.querySelector(containerSelector); const prevBtn = document.querySelector(prevBtnSelector); const nextBtn = document.querySelector(nextBtnSelector); if (!container || !prevBtn || !nextBtn) return; const scrollAmount = container.clientWidth; nextBtn.addEventListener('click', () => { container.scrollBy({ left: scrollAmount, behavior: 'smooth' }); }); prevBtn.addEventListener('click', () => { container.scrollBy({ left: -scrollAmount, behavior: 'smooth' }); }); } setupCarousel('.projects-carousel', '.projects-carousel + .carousel-controls .carousel-prev', '.projects-carousel + .carousel-controls .carousel-next');
    const contactForm = document.getElementById('contactForm'); if (contactForm) { contactForm.addEventListener('submit', function (e) { e.preventDefault(); alert('Pesan Anda berhasil dikirim! (Ini adalah simulasi)'); contactForm.reset(); }); }
    initializeRevealAnimation();
});