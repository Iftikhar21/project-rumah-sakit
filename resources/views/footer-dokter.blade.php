{{-- Footer Component --}}
<footer class="medical-footer">
    <div class="footer-content">
        <div class="container-fluid px-4">
            {{-- Main Footer Content --}}
            <div class="row g-4">
                {{-- Brand Section --}}
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand">
                        <div class="brand-logo">
                            <i class="bx bx-plus-medical"></i>
                            <span class="brand-name">RS Sehat Sejahtera</span>
                        </div>
                        <p class="brand-description">
                            Sistem informasi klinik terpercaya yang memberikan pelayanan kesehatan terbaik 
                            untuk pasien dan keluarga Anda.
                        </p>
                        <div class="contact-info">
                            <div class="contact-item">
                                <i class="bx bx-phone"></i>
                                <span>+62 21 1234 5678</span>
                            </div>
                            <div class="contact-item">
                                <i class="bx bx-envelope"></i>
                                <span>info@RS Sehat Sejahtera.com</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div class="col-lg-2 col-md-6">
                    <div class="footer-section">
                        <h5 class="footer-title">Layanan</h5>
                        <ul class="footer-links">
                            <li><a href="#"><i class="bx bx-chevron-right"></i>Konsultasi Online</a></li>
                            <li><a href="#"><i class="bx bx-chevron-right"></i>Pemeriksaan Umum</a></li>
                            <li><a href="#"><i class="bx bx-chevron-right"></i>Laboratorium</a></li>
                            <li><a href="#"><i class="bx bx-chevron-right"></i>Radiologi</a></li>
                            <li><a href="#"><i class="bx bx-chevron-right"></i>Farmasi</a></li>
                        </ul>
                    </div>
                </div>

                {{-- Patient Info --}}
                <div class="col-lg-2 col-md-6">
                    <div class="footer-section">
                        <h5 class="footer-title">Informasi</h5>
                        <ul class="footer-links">
                            <li><a href="#"><i class="bx bx-chevron-right"></i>Profil Dokter</a></li>
                            <li><a href="#"><i class="bx bx-chevron-right"></i>Jadwal Praktek</a></li>
                            <li><a href="#"><i class="bx bx-chevron-right"></i>Cara Pendaftaran</a></li>
                            <li><a href="#"><i class="bx bx-chevron-right"></i>Syarat & Ketentuan</a></li>
                            <li><a href="#"><i class="bx bx-chevron-right"></i>FAQ</a></li>
                        </ul>
                    </div>
                </div>

                {{-- Support --}}
                <div class="col-lg-2 col-md-6">
                    <div class="footer-section">
                        <h5 class="footer-title">Bantuan</h5>
                        <ul class="footer-links">
                            <li><a href="#"><i class="bx bx-chevron-right"></i>Pusat Bantuan</a></li>
                            <li><a href="#"><i class="bx bx-chevron-right"></i>Hubungi Kami</a></li>
                            <li><a href="#"><i class="bx bx-chevron-right"></i>Panduan Pengguna</a></li>
                            <li><a href="#"><i class="bx bx-chevron-right"></i>Kebijakan Privasi</a></li>
                            <li><a href="#"><i class="bx bx-chevron-right"></i>Keamanan Data</a></li>
                        </ul>
                    </div>
                </div>

                {{-- Newsletter & Social --}}
                <div class="col-lg-2 col-md-12">
                    <div class="footer-section">
                        <h5 class="footer-title">Tetap Terhubung</h5>
                        <p class="newsletter-text">
                            Dapatkan tips kesehatan dan informasi terbaru dari kami.
                        </p>
                        
                        {{-- Newsletter Form --}}
                        <form class="newsletter-form" action="#" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="email" class="form-control" placeholder="Email Anda" required>
                                <button class="btn btn-subscribe" type="submit">
                                    <i class="bx bx-send"></i>
                                </button>
                            </div>
                        </form>

                        {{-- Social Media --}}
                        <div class="social-links">
                            <a href="#" class="social-link" title="Facebook">
                                <i class="bx bxl-facebook"></i>
                            </a>
                            <a href="#" class="social-link" title="Instagram">
                                <i class="bx bxl-instagram"></i>
                            </a>
                            <a href="#" class="social-link" title="Twitter">
                                <i class="bx bxl-twitter"></i>
                            </a>
                            <a href="#" class="social-link" title="LinkedIn">
                                <i class="bx bxl-linkedin"></i>
                            </a>
                            <a href="#" class="social-link" title="WhatsApp">
                                <i class="bx bxl-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer Bottom --}}
    <div class="footer-bottom">
        <div class="container-fluid px-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="copyright">
                        <p>&copy; {{ date('Y') }} RS Sehat Sejahtera Clinic. Semua hak dilindungi.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="footer-bottom-links">
                        <a href="#">Kebijakan Privasi</a>
                        <span class="separator">•</span>
                        <a href="#">Syarat Layanan</a>
                        <span class="separator">•</span>
                        <a href="#">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Back to Top Button --}}
    <button class="back-to-top" id="backToTop" title="Kembali ke Atas">
        <i class="bx bx-chevron-up"></i>
    </button>
</footer>

<style>
/* Footer Styles - Monochrome Theme */
.medical-footer {
    background: linear-gradient(135deg, #111827 0%, #1f2937 50%, #374151 100%);
    color: #e5e7eb;
    margin-top: 5rem;
    position: relative;
    overflow: hidden;
}

.medical-footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="a" cx="50%" cy="50%"><stop offset="0%" stop-color="%23ffffff" stop-opacity="0.03"/><stop offset="100%" stop-color="%23ffffff" stop-opacity="0"/></radialGradient></defs><circle cx="200" cy="200" r="150" fill="url(%23a)"/><circle cx="800" cy="400" r="200" fill="url(%23a)"/><circle cx="400" cy="800" r="100" fill="url(%23a)"/></svg>');
    opacity: 0.5;
}

.footer-content {
    position: relative;
    z-index: 2;
    padding: 4rem 0 2rem;
}

/* Brand Section */
.footer-brand .brand-logo {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
}

.footer-brand .brand-logo i {
    font-size: 2.5rem;
    color: #d1d5db;
    background: rgba(255, 255, 255, 0.05);
    padding: 0.75rem;
    border-radius: 1rem;
    backdrop-filter: blur(10px);
}

.footer-brand .brand-name {
    font-size: 1.75rem;
    font-weight: 700;
    color: #f9fafb;
}

.footer-brand .brand-description {
    font-size: 0.95rem;
    line-height: 1.6;
    color: #9ca3af;
    margin-bottom: 1.5rem;
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 0.9rem;
}

.contact-item i {
    font-size: 1.125rem;
    color: #6b7280;
    width: 20px;
}

/* Footer Sections */
.footer-section .footer-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: #f3f4f6;
    margin-bottom: 1.5rem;
    position: relative;
}

.footer-section .footer-title::after {
    content: '';
    position: absolute;
    bottom: -0.5rem;
    left: 0;
    width: 30px;
    height: 2px;
    background: #6b7280;
    border-radius: 1px;
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 0.75rem;
}

.footer-links a {
    color: #9ca3af;
    text-decoration: none;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    padding: 0.25rem 0;
}

.footer-links a:hover {
    color: #e5e7eb;
    transform: translateX(5px);
}

.footer-links a i {
    font-size: 0.75rem;
    transition: transform 0.3s ease;
}

.footer-links a:hover i {
    transform: translateX(3px);
}

/* Newsletter Section */
.newsletter-text {
    font-size: 0.9rem;
    color: #9ca3af;
    margin-bottom: 1.5rem;
    line-height: 1.5;
}

.newsletter-form {
    margin-bottom: 2rem;
}

.newsletter-form .input-group {
    display: flex;
    border-radius: 0.75rem;
    overflow: hidden;
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.newsletter-form .form-control {
    background: transparent;
    border: none;
    color: #e5e7eb;
    padding: 0.875rem 1rem;
    font-size: 0.9rem;
    flex: 1;
}

.newsletter-form .form-control::placeholder {
    color: #9ca3af;
}

.newsletter-form .form-control:focus {
    background: transparent;
    border: none;
    color: #f3f4f6;
    box-shadow: none;
    outline: none;
}

.newsletter-form .btn-subscribe {
    background: #374151;
    border: none;
    color: #e5e7eb;
    padding: 0.875rem 1.25rem;
    transition: all 0.3s ease;
}

.newsletter-form .btn-subscribe:hover {
    background: #4b5563;
    color: #f9fafb;
    transform: translateY(-1px);
}

/* Social Links */
.social-links {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.social-link {
    width: 45px;
    height: 45px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #9ca3af;
    font-size: 1.25rem;
    text-decoration: none;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.social-link:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #f3f4f6;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

/* Footer Features */
.footer-features {
    padding: 2rem 0;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    margin: 2rem 0;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.03);
    border-radius: 1rem;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.05);
    transition: all 0.3s ease;
    height: 100%;
}

.feature-item:hover {
    background: rgba(255, 255, 255, 0.05);
    transform: translateY(-2px);
}

.feature-icon {
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.08);
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: #d1d5db;
    flex-shrink: 0;
}

.feature-content h6 {
    font-size: 0.95rem;
    font-weight: 600;
    color: #f3f4f6;
    margin-bottom: 0.25rem;
}

.feature-content p {
    font-size: 0.8rem;
    color: #9ca3af;
    margin: 0;
    line-height: 1.4;
}

/* Footer Bottom */
.footer-bottom {
    background: rgba(0, 0, 0, 0.2);
    padding: 1.5rem 0;
    backdrop-filter: blur(10px);
    position: relative;
    z-index: 2;
}

.copyright p {
    margin: 0;
    font-size: 0.875rem;
    color: #9ca3af;
}

.footer-bottom-links {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.footer-bottom-links a {
    color: #9ca3af;
    text-decoration: none;
    font-size: 0.875rem;
    transition: color 0.3s ease;
}

.footer-bottom-links a:hover {
    color: #e5e7eb;
}

.footer-bottom-links .separator {
    color: #6b7280;
    font-size: 0.875rem;
}

/* Back to Top Button */
.back-to-top {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    width: 50px;
    height: 50px;
    background: #374151;
    border: none;
    border-radius: 50%;
    color: #e5e7eb;
    font-size: 1.5rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    z-index: 1000;
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px);
}

.back-to-top.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.back-to-top:hover {
    background: #4b5563;
    color: #f9fafb;
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
}

/* Responsive Design */
@media (max-width: 768px) {
    .footer-content {
        padding: 3rem 0 1.5rem;
    }
    
    .footer-brand .brand-logo {
        justify-content: center;
        text-align: center;
    }
    
    .footer-section {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .social-links {
        justify-content: center;
    }
    
    .feature-item {
        flex-direction: column;
        text-align: center;
        padding: 1.5rem 1rem;
    }
    
    .feature-content {
        text-align: center;
    }
    
    .footer-bottom-links {
        justify-content: center;
        margin-top: 1rem;
    }
    
    .back-to-top {
        bottom: 1rem;
        right: 1rem;
        width: 45px;
        height: 45px;
        font-size: 1.25rem;
    }
}

@media (max-width: 480px) {
    .contact-info {
        align-items: center;
    }
    
    .newsletter-form .input-group {
        flex-direction: column;
    }
    
    .newsletter-form .btn-subscribe {
        border-radius: 0 0 0.75rem 0.75rem;
    }
    
    .footer-features {
        padding: 1.5rem 0;
    }
    
    .social-links {
        gap: 0.75rem;
    }
    
    .social-link {
        width: 40px;
        height: 40px;
        font-size: 1.125rem;
    }
}

/* Animation for scroll reveal */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in-footer {
    animation: fadeInUp 0.8s ease forwards;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Back to Top Button
    const backToTopBtn = document.getElementById('backToTop');
    
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopBtn.classList.add('show');
        } else {
            backToTopBtn.classList.remove('show');
        }
    });
    
    backToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // Newsletter Form
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            
            if (email) {
                // Show success message (you can customize this)
                alert('Terima kasih! Anda telah berhasil berlangganan newsletter kami.');
                this.querySelector('input[type="email"]').value = '';
            }
        });
    }
    
    // Smooth scroll for footer links
    document.querySelectorAll('.footer-links a[href^="#"]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Add animation to footer sections on scroll
    const footerSections = document.querySelectorAll('.footer-section, .footer-brand');
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in-footer');
            }
        });
    }, observerOptions);
    
    footerSections.forEach(section => {
        observer.observe(section);
    });
});
</script>