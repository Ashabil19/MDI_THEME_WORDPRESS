<footer id="footer">
        <div class="container-footer-logo">
            <div class="footer-logo-content">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/footer-icon/Logo-MDI.svg" alt="">

                <!-- <form class="email-input-footer">
                    <input type="text" class="email-input1" placeholder="Enter your email address"></input>
                    <input type="text" class="email-input2" placeholder="Enter Your Message"></input>
                </form> -->
            </div>
        </div>
        <div class="footer-content-container">
            <div class="footer-content">
                <h3>Metal Detector Indonesia</h3>
                <p>Selamat Datang di Metal Detector Indonesia – Solusi Terbaik dan Aman untuk Deteksi Logam Anda!
                    Apakah Anda seorang petualang yang mencari harta karun tersembunyi, seorang arkeolog yang ingin menemukan artefak bersejarah, atau sekadar hobiis yang penasaran dengan apa yang tersembunyi di bawah tanah? Di Metal Detector Indonesia, kami menyediakan berbagai alat metal detector berkualitas tinggi yang dirancang khusus untuk memenuhi kebutuhan deteksi logam Anda dengan aman dan efektif.    
                </p>
            </div>
            <div class="footer-company">
                <h3>Company</h3>
                <div class="company-content">
                    <a href="<?php echo site_url('/article'); ?>">Home</a>
                    <a href="<?php echo site_url('/about'); ?>">About</a>
                    <a href="<?php echo site_url('/article'); ?>">Article</a>
                    <a href="<?php echo site_url('/productnext'); ?>">Product</a>
                </div>
            </div>
            <div class="footer-help">
                <h3>Help</h3>
                <div class="help-content">
                    <a href="<?php echo site_url('#contact-us'); ?>">Cusomer Support</a>
                    <a href="#">Delivery Details</a>
                    <a href="#">Terms & Conditions</a>
                    <a href="#">Privacy Policy</a>
                </div>
            </div>    
            <div class="footer-faq">
                <h3>Faq</h3>
                <div class="faq-content">
                    <a href="#">Account</a>
                    <a href="#">Manage Deliveries</a>
                    <a href="#">Orders</a>
                    <a href="#">Payments</a>
                </div>
            </div>    
            <div class="footer-contact">
                <h3>Contact</h3>
                <div class="contact-content">
                    <div class="number-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/footer-icon/fax-icon.png" alt="">
                        <a href="https://wa.me/6285215560669">6285215560669 (Mr. Almas)</a>
                    </div>
                    <div class="number-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/footer-icon/wa-icon.png" alt="">
                        <a href="https://wa.me/6281295957914">6281295957914 (Mr. Parmin)</a>
                    </div>
                    <div class="number-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/footer-icon/wa-icon.png" alt="">
                        <a href="https://wa.me/6281944014959">6281944014959 (Mr. Arya)</a>
                    </div>
                </div>
            </div>
        </div>    
        <div class="footer-break" >
            <div class="footer-social-media">
                <h4>Our Social Media</h4>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/footer-icon/1.svg" alt="">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/footer-icon/2.svg" alt="">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/footer-icon/3.svg" alt="">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/footer-icon/4.svg" alt="">
            </div>
            <div class="email-footer-break">
                <h4>Email</h4>
                <div class="email-footer-content">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/footer-icon/mail-icon.svg" alt="">
                    <span>sales@metaldetectorindonesia.com</span>
                </div>
                <div class="email-footer-content" >
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/footer-icon/mail-icon.svg" alt="">
                    <span>marketing.xray@taharica.com</span>
                </div>
            </div>
            <div class="address-footer-break">
                <h4>Adress</h4>
                <div>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/footer-icon/address-icon.svg" alt="">
                <span>Jl. Radin Inten II No. 62 <br> Duren Sawit - Jakarta 13440</span>
            </div>
            </div>
        </div>
        </footer>
<?php wp_footer(); ?>

<!-- Pastikan script.js diletakkan setelah wp_footer -->
<script src="<?php echo get_template_directory_uri(); ?>/js/scripts.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/product-page.js"></script>


<!-- link CDN js AOS  -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>


</body>
</html>
