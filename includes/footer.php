    </div> <!-- Close container -->

    <!-- Footer Section -->
    <footer class="footer bg-dark text-light mt-5">
        <!-- Main Footer -->
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand mb-3">
                        <h4 class="text-warning fw-bold">
                            </i>DemografiKu
                        </h4>
                    </div>
                    <p class="footer-description mb-4">
                        Platform cerdas untuk analisis data kependudukan yang akurat dan real-time.
                        Transformasi data menjadi wawasan strategis untuk perencanaan wilayah yang lebih baik.
                    </p>
                    <div class="footer-contact">
                        <div class="contact-item d-flex align-items-center mb-2">
                            <i class="fas fa-map-marker-alt me-3 text-warning"></i>
                            <span>Jl. Pasir Merah No. 123, Planet Mars</span>
                        </div>
                        <div class="contact-item d-flex align-items-center mb-2">
                            <i class="fas fa-phone me-3 text-warning"></i>
                            <span>+602 29 9999 9999</span>
                        </div>
                        <div class="contact-item d-flex align-items-center mb-2">
                            <i class="fas fa-envelope me-3 text-warning"></i>
                            <span>info@demografiku.mrs</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6">
                    <h5 class="footer-title mb-4">Menu Cepat</h5>
                    <ul class="footer-links list-unstyled">
                        <li class="mb-2">
                            <a href="index.php" class="footer-link">
                                <i class="fas fa-home me-2"></i>Dashboard
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="index.php?page=list" class="footer-link">
                                <i class="fas fa-users me-2"></i>Data Penduduk
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="index.php?page=wilayah" class="footer-link">
                                <i class="fas fa-map me-2"></i>Data Wilayah
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Features -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="footer-title mb-4">Fitur Utama</h5>
                    <ul class="footer-links list-unstyled">
                        <li class="mb-2">
                            <span class="footer-feature">
                                <i class="fas fa-check-circle me-2 text-success"></i>
                                Real-time Analytics
                            </span>
                        </li>
                        <li class="mb-2">
                            <span class="footer-feature">
                                <i class="fas fa-check-circle me-2 text-success"></i>
                                Data Visualization
                            </span>
                        </li>
                        <li class="mb-2">
                            <span class="footer-feature">
                                <i class="fas fa-check-circle me-2 text-success"></i>
                                Predictive Analysis
                            </span>
                        </li>
                        <li class="mb-2">
                            <span class="footer-feature">
                                <i class="fas fa-check-circle me-2 text-success"></i>
                                Multi-level Hierarchy
                            </span>
                        </li>
                        <li class="mb-2">
                            <span class="footer-feature">
                                <i class="fas fa-check-circle me-2 text-success"></i>
                                Automated Reporting
                            </span>
                        </li>
                    </ul>
                </div>

                <!-- Newsletter & Social -->
                <div class="col-lg-3 col-md-6">
                    <div class="social-links">
                        <h6 class="mb-3">Follow Kami:</h6>
                        <div class="d-flex gap-3">
                            <a href="#" class="social-link">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-link">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="social-link">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="social-link">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="social-link">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div class="footer-bottom bg-darker py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0 text-center text-md-start">
                            &copy; 2025 <span class="text-warning">DemografiKu</span>. All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll to Top Button -->
        <button onclick="scrollToTop()" id="footerBackToTop" class="footer-back-to-top">
            <i class="fas fa-arrow-up"></i>
        </button>
    </footer>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

    <script>
        // Footer specific JavaScript
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Show/hide back to top button
        window.addEventListener('scroll', function() {
            const backToTop = document.getElementById('footerBackToTop');
            if (window.scrollY > 300) {
                backToTop.style.display = 'flex';
            } else {
                backToTop.style.display = 'none';
            }
        });

        // Newsletter form submission
        document.querySelector('.newsletter-form')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;

            // Simulate newsletter subscription
            const button = this.querySelector('button');
            const originalText = button.innerHTML;

            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            button.disabled = true;

            setTimeout(() => {
                alert('Terima kasih! Anda telah berlangganan newsletter kami.');
                this.reset();
                button.innerHTML = originalText;
                button.disabled = false;
            }, 1500);
        });

        // Smooth scrolling for footer links
        document.querySelectorAll('.footer-link').forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href && href.startsWith('#')) {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });

        // Animation on scroll for footer elements
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe footer sections for animation
        document.addEventListener('DOMContentLoaded', function() {
            const footerSections = document.querySelectorAll('.footer > .container > .row > div');
            footerSections.forEach(section => {
                section.style.opacity = '0';
                section.style.transform = 'translateY(20px)';
                section.style.transition = 'all 0.6s ease';
                observer.observe(section);
            });
        });
    </script>

    <style>
        .footer {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            position: relative;
            overflow: hidden;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="rgba(255,255,255,0.02)" points="0,1000 1000,0 1000,1000"/></svg>');
            pointer-events: none;
        }

        .footer>.container {
            position: relative;
            z-index: 1;
        }

        .footer-brand h4 {
            font-size: 1.8rem;
        }

        .footer-description {
            line-height: 1.6;
            color: #bdc3c7;
        }

        .footer-title {
            color: #ecf0f1;
            font-weight: 600;
            font-size: 1.1rem;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: #f39c12;
        }

        .footer-links {
            margin: 0;
            padding: 0;
        }

        .footer-link {
            color: #bdc3c7;
            text-decoration: none;
            transition: all 0.3s ease;
            display: block;
            padding: 5px 0;
        }

        .footer-link:hover {
            color: #f39c12;
            transform: translateX(5px);
        }

        .footer-feature {
            color: #bdc3c7;
            display: block;
            padding: 5px 0;
        }

        .contact-item {
            color: #bdc3c7;
        }

        .contact-item i {
            width: 20px;
            text-align: center;
        }

        /* Newsletter Form */
        .newsletter-form .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 25px 0 0 25px;
            padding: 10px 20px;
        }

        .newsletter-form .form-control::placeholder {
            color: #bdc3c7;
        }

        .newsletter-form .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: #f39c12;
            box-shadow: 0 0 0 0.2rem rgba(243, 156, 18, 0.25);
            color: white;
        }

        .newsletter-form .btn {
            border-radius: 0 25px 25px 0;
            border: 1px solid #f39c12;
        }

        /* Social Links */
        .social-links h6 {
            color: #ecf0f1;
            font-weight: 600;
        }

        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: #bdc3c7;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .social-link:hover {
            background: #f39c12;
            color: #2c3e50;
            transform: translateY(-3px);
            border-color: #f39c12;
        }

        /* Footer Bottom */
        .footer-bottom {
            background: rgba(0, 0, 0, 0.3);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer-bottom-links {
            font-size: 0.9rem;
        }

        .footer-bottom-link {
            color: #bdc3c7;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-bottom-link:hover {
            color: #f39c12;
        }

        /* Back to Top Button */
        .footer-back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #f39c12, #e67e22);
            border: none;
            color: white;
            display: none;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .footer-back-to-top:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
            background: linear-gradient(135deg, #e67e22, #d35400);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .footer {
                text-align: center;
            }

            .footer-title::after {
                left: 50%;
                transform: translateX(-50%);
            }

            .footer-links {
                display: inline-block;
                text-align: left;
            }

            .contact-item {
                justify-content: center;
            }

            .social-links .d-flex {
                justify-content: center;
            }

            .footer-bottom-links {
                margin-top: 10px;
            }

            .footer-back-to-top {
                bottom: 20px;
                right: 20px;
                width: 45px;
                height: 45px;
            }
        }

        @media (max-width: 576px) {
            .footer {
                padding: 30px 0;
            }

            .footer-brand h4 {
                font-size: 1.5rem;
            }

            .footer-bottom-links {
                display: flex;
                flex-direction: column;
                gap: 5px;
            }

            .footer-bottom-link {
                margin: 0 !important;
            }
        }

        /* Animation for footer elements */
        .footer>.container>.row>div {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease;
        }

        /* Print Styles */
        @media print {
            .footer {
                display: none;
            }
        }
    </style>
    </body>

    </html>