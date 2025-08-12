<?php
require_once 'includes/init.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
    $name = sanitizeInput($_POST['name']);
    $email = sanitizeInput($_POST['email']);
    $phone = sanitizeInput($_POST['phone']);
    $subject = sanitizeInput($_POST['subject']);
    $message = sanitizeInput($_POST['message']);
    
    // Here you would typically send email or save to database
    // For now, we'll just set a success message
    $success_message = "Terima kasih! Pesan Anda telah terkirim. Kami akan segera menghubungi Anda.";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Hubungi Turen Indah Bangunan - Toko Beton Terlengkap di Malang">

	<!-- title -->
	<title>Hubungi Kami | Turen Indah Bangunan</title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="assets/css/all.min.css">
	<!-- bootstrap -->
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<!-- owl carousel -->
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<!-- magnific popup -->
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<!-- animate css -->
	<link rel="stylesheet" href="assets/css/animate.css">
	<!-- mean menu css -->
	<link rel="stylesheet" href="assets/css/meanmenu.min.css">
	<!-- main style -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- responsive -->
	<link rel="stylesheet" href="assets/css/responsive.css">

</head>
<body>
	
	<!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->
	
	<!-- header -->
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo">
							<a href="<?= BASE_URL ?>">
								<img src="assets/img/logo1.png" alt="Logo" style="max-height: 70px; height: auto; width: auto;">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li><a href="index.php">Home</a>
									<ul class="sub-menu">
										<li><a href="index.php">Static Home</a></li>
										<li><a href="index2.php">Slider Home</a></li>
									</ul>
								</li>
								<li><a href="about.php">About</a></li>
								<li><a href="news.php">News</a>
									<ul class="sub-menu">
										<li><a href="news.php">News</a></li>
										<li><a href="single-news.php">Single News</a></li>
									</ul>
								</li>
								<li class="current-list-item"><a href="contact.php">Contact</a></li>
								<li><a href="shop.php">Shop</a>
									<ul class="sub-menu">
										<li><a href="shop.php">Shop</a></li>
										<li><a href="checkout.php">Check Out</a></li>
										<li><a href="single-product.php">Single Product</a></li>
										<li><a href="cart.php">Cart</a></li>
									</ul>
								</li>
								<li>
									<div class="header-icons">
										<a class="shopping-cart" href="cart.php"><i class="fas fa-shopping-cart"></i></a>
										<a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a>
									</div>
								</li>
							</ul>
						</nav>
						<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->

	<!-- search area -->
	<div class="search-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<span class="close-btn"><i class="fas fa-window-close"></i></span>
					<div class="search-bar">
						<div class="search-bar-tablecell">
							<h3>Search For:</h3>
							<input type="text" placeholder="Keywords">
							<button type="submit">Search <i class="fas fa-search"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end search area -->

	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Hubungi Kami 24/7</p>
						<h1>Kontak Kami</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- contact form -->
	<div class="contact-from-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 mb-5 mb-lg-0">
					<div class="form-title">
						<h2>Ada pertanyaan untuk kami?</h2>
						<p>Kami siap membantu Anda dengan konsultasi gratis seputar kebutuhan material bangunan dan beton. Tim ahli kami akan memberikan solusi terbaik untuk proyek konstruksi Anda.</p>
					</div>
					
					<?php if (isset($success_message)): ?>
						<div class="alert alert-success">
							<?= $success_message ?>
						</div>
					<?php endif; ?>
					
					<div class="contact-form">
						<form method="POST" action="">
							<p>
								<input type="text" placeholder="Nama Lengkap" name="name" id="name" required>
								<input type="email" placeholder="Email" name="email" id="email" required>
							</p>
							<p>
								<input type="tel" placeholder="Nomor Telepon" name="phone" id="phone" required>
								<input type="text" placeholder="Subjek" name="subject" id="subject" required>
							</p>
							<p><textarea name="message" id="message" cols="30" rows="10" placeholder="Pesan Anda" required></textarea></p>
							<p><input type="submit" value="Kirim Pesan" class="boxed-btn"></p>
						</form>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="contact-form-wrap">
						<div class="contact-form-box">
							<h4><i class="fas fa-address-book"></i> Kontak</h4>
							<p>
								<strong>Telepon:</strong><br>
								<a href="tel:+6281252462983">+62 812-5246-2983</a>
							</p>
							<p>
								<strong>Email:</strong><br>
								<a href="mailto:info@turenindahbangunan.com">info@turenindahbangunan.com</a>
							</p>
							<p>
								<strong>Instagram:</strong><br>
								<a href="https://www.instagram.com/turenindah.bangunan/" target="_blank">@turenindah.bangunan</a>
							</p>
							<p>
								<strong>Alamat:</strong><br>
								Jl. Raya Turen, Malang<br>
								Jawa Timur, Indonesia
							</p>
							<p>
								<strong>Jam Operasional:</strong><br>
								Senin - Sabtu: 08:00 - 16:00 WIB<br>
								Minggu: Tutup
							</p>
						</div>
						
						<div class="contact-form-box mt-4">
							<h4><i class="fab fa-whatsapp"></i> WhatsApp</h4>
							<p>Untuk respon lebih cepat, hubungi kami langsung via WhatsApp:</p>
							<a href="https://api.whatsapp.com/send/?phone=6281252462983&text=Halo%2C%20saya%20ingin%20bertanya%20tentang%20produk%20Turen%20Indah%20Bangunan" 
							   class="boxed-btn" target="_blank">
								<i class="fab fa-whatsapp"></i> Chat WhatsApp
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end contact form -->

	<!-- find our location -->
	<div class="find-location blue-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<p> <i class="fas fa-map-marker-alt"></i> Temukan Lokasi Kami</p>
				</div>
			</div>
		</div>
	</div>
	<!-- end find our location -->

	<!-- google map section -->
	<div class="embed-responsive embed-responsive-21by9">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63214.60147039406!2d112.66073957832032!3d-8.124036199999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78be1234567890%3A0x1234567890abcdef!2sTuren%2C%20Malang%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1625123456789!5m2!1sid!2sid" 
		        width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" class="embed-responsive-item"></iframe>
	</div>
	<!-- end google map section -->

	<!-- footer -->
	<div class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="footer-box about-widget">
						<h2 class="widget-title">About us</h2>
						<p>Turen Indah Bangunan adalah toko beton terlengkap di Malang yang menyediakan berbagai produk beton berkualitas tinggi untuk kebutuhan konstruksi Anda.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box get-in-touch">
						<h2 class="widget-title">Get in Touch</h2>
						<ul>
							<li><a href="https://www.instagram.com/turenindah.bangunan/">@turenindah.bangunan</a></li>
							<li><a href="mailto:info@turenindahbangunan.com">info@turenindahbangunan.com</a></li>
							<li><a href="https://api.whatsapp.com/send/?phone=6281252462983">+62 812-5246-2983</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box pages">
						<h2 class="widget-title">Pages</h2>
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="about.php">About</a></li>
							<li><a href="shop.php">Shop</a></li>
							<li><a href="news.php">News</a></li>
							<li><a href="contact.php">Contact</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box subscribe">
						<h2 class="widget-title">Subscribe</h2>
						<p>Subscribe to our mailing list to get the latest updates.</p>
						<form action="index.php" method="POST">
							<input type="email" name="email" placeholder="Email" required>
							<button type="submit"><i class="fas fa-paper-plane"></i></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end footer -->
	 
	<!-- copyright -->
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<p>&copy; 2025 - Turen Indah Bangunan. <a href="#">Semua hak cipta dilindungi.</a> | Toko Bangunan Terlengkap di Malang.<br>
						Distributed By - <a href="#">Thelord</a>
					</p>
				</div>
				<div class="col-lg-6 text-right col-md-12">
					<div class="social-icons">
						<ul>
							<li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
							<li><a href="https://www.instagram.com/turenindah.bangunan/" target="_blank"><i class="fab fa-instagram"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end copyright -->
	
	<!-- jquery -->
	<script src="assets/js/jquery-1.11.3.min.js"></script>
	<!-- bootstrap -->
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- count down -->
	<script src="assets/js/jquery.countdown.js"></script>
	<!-- isotope -->
	<script src="assets/js/jquery.isotope-3.0.6.min.js"></script>
	<!-- waypoints -->
	<script src="assets/js/waypoints.js"></script>
	<!-- owl carousel -->
	<script src="assets/js/owl.carousel.min.js"></script>
	<!-- magnific popup -->
	<script src="assets/js/jquery.magnific-popup.min.js"></script>
	<!-- mean menu -->
	<script src="assets/js/jquery.meanmenu.min.js"></script>
	<!-- sticker js -->
	<script src="assets/js/sticker.js"></script>
	<!-- main js -->
	<script src="assets/js/main.js"></script>
	
</body>
</html>
