<?php
require_once 'includes/init.php';

// Get about content from database
try {
    $aboutContents = $aboutModel->getActiveContent();
    
    // Organize content by section for easier access
    $sections = [];
    foreach ($aboutContents as $content) {
        $sections[$content['section_name']] = $content;
    }
} catch (Exception $e) {
    $aboutContents = [];
    $sections = [];
    error_log("Error loading about content: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Tentang Turen Indah Bangunan - Toko Beton Terlengkap di Malang">

	<!-- title -->
	<title>Tentang Kami | Turen Indah Bangunan</title>

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

	<style>
		/* Custom About Page Styles */
		.about-section {
			padding: 60px 0;
		}
		
		.about-section:nth-child(even) {
			background-color: #f8f9fa;
		}
		
		.about-content {
			text-align: left;
			line-height: 1.8;
		}
		
		.about-content h4 {
			color: #2c3e50;
			margin-top: 2rem;
			margin-bottom: 1rem;
			font-weight: 600;
		}
		
		.about-content h5 {
			color: #F28123;
			margin-bottom: 0.75rem;
			font-weight: 600;
		}
		
		.about-content p {
			margin-bottom: 1.5rem;
			color: #666;
			font-size: 16px;
		}
		
		.about-content ul {
			padding-left: 1.5rem;
			margin-bottom: 1.5rem;
		}
		
		.about-content li {
			margin-bottom: 0.5rem;
			color: #666;
			line-height: 1.6;
		}
		
		.about-image img {
			transition: transform 0.3s ease;
			border-radius: 15px;
			box-shadow: 0 10px 30px rgba(0,0,0,0.1);
		}
		
		.about-image img:hover {
			transform: translateY(-5px);
		}
		
		.feature-item {
			padding: 1.5rem;
			background: white;
			border-radius: 10px;
			box-shadow: 0 5px 15px rgba(0,0,0,0.1);
			transition: all 0.3s ease;
			height: 100%;
		}
		
		.feature-item:hover {
			transform: translateY(-5px);
			box-shadow: 0 10px 25px rgba(0,0,0,0.15);
		}
		
		.feature-item h5 {
			margin-bottom: 1rem;
		}
		
		.feature-item i {
			margin-right: 0.5rem;
		}
		
		/* Responsive adjustments */
		@media (max-width: 768px) {
			.about-content {
				text-align: center;
				margin-bottom: 2rem;
			}
			
			.about-image {
				margin-bottom: 2rem;
			}
		}
	</style>

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
								<li class="current-list-item"><a href="about.php">About</a></li>
								<li><a href="news.php">News</a>
									<ul class="sub-menu">
										<li><a href="news.php">News</a></li>
										<li><a href="404.php">Single News</a></li>
									</ul>
								</li>
								<li><a href="contact.php">Contact</a></li>
								<li><a href="shop.php">Shop</a>
									<ul class="sub-menu">
										<li><a href="shop.php">Shop</a></li>
										<li><a href="checkout.php">Check Out</a></li>
										<li><a href="404.php">Single Product</a></li>
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
						<p>Toko Beton Terlengkap di Malang</p>
						<h1>Tentang Kami</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- Dynamic About Content from Database -->
	<?php if (!empty($aboutContents)): ?>
		<?php foreach ($aboutContents as $index => $content): ?>
			<section class="about-section <?= $index % 2 == 0 ? '' : 'bg-light' ?>">
				<div class="container">
					<div class="row align-items-center">
						<!-- Content Section -->
						<div class="col-lg-<?= !empty($content['image']) ? '8' : '12' ?> <?= $index % 2 == 1 && !empty($content['image']) ? 'order-lg-2' : '' ?>">
							<div class="featured-text">
								<?php if (!empty($content['subtitle'])): ?>
									<p class="top-sub text-center"><?= htmlspecialchars($content['subtitle']) ?></p>
								<?php endif; ?>
								
								<?php if (!empty($content['title'])): ?>
									<h2 class="pb-3 text-center"><?= htmlspecialchars($content['title']) ?></h2>
								<?php endif; ?>
								
								<?php if (!empty($content['content'])): ?>
									<div class="about-content">
										<?= $content['content'] ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
						
						<!-- Image Section (only if image exists) -->
						<?php if (!empty($content['image'])): ?>
							<div class="col-lg-4 <?= $index % 2 == 1 ? 'order-lg-1' : '' ?>">
								<div class="about-image text-center">
									<img src="<?= BASE_URL ?>assets/img/uploads/about/<?= $content['image'] ?>" 
									     alt="<?= htmlspecialchars($content['title']) ?>" 
									     class="img-fluid"
									     style="max-height: 400px; object-fit: cover; width: 100%;">
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</section>
		<?php endforeach; ?>
	<?php else: ?>
		<!-- Fallback content if no database content -->
		<section class="about-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="text-center mb-5">
							<p class="top-sub">Sejak Tahun 1999</p>
							<h2 class="pb-3">Mengapa <span class="orange-text">Turen Indah Bangunan</span></h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-md-6 mb-4">
						<div class="feature-item">
							<h5><i class="fas fa-certificate text-primary"></i> Kualitas Terjamin</h5>
							<p>Produk beton berkualitas tinggi sesuai standar SNI dengan sertifikat mutu terpercaya.</p>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 mb-4">
						<div class="feature-item">
							<h5><i class="fas fa-shipping-fast text-primary"></i> Pengiriman Cepat</h5>
							<p>Layanan pengiriman tepat waktu ke seluruh wilayah Malang dan sekitarnya.</p>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 mb-4">
						<div class="feature-item">
							<h5><i class="fas fa-users text-primary"></i> Tim Berpengalaman</h5>
							<p>Didukung tim profesional berpengalaman puluhan tahun di bidang konstruksi.</p>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 mb-4">
						<div class="feature-item">
							<h5><i class="fas fa-handshake text-primary"></i> Pelayanan Terbaik</h5>
							<p>Konsultasi gratis dan pelayanan prima untuk setiap kebutuhan proyek Anda.</p>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>
	<!-- End Dynamic About Content -->




	<!-- shop banner -->
	<section class="shop-banner">
    	<div class="container">
        	<h3>Promo Akhir Tahun! <br> dengan <span class="orange-text">Diskon Besar...</span></h3>
            <div class="sale-percent"><span>Diskon! <br> Hingga</span>25% <span>off</span></div>
            <a href="shop.php" class="cart-btn btn-lg">Belanja Sekarang</a>
        </div>
    </section>
	<!-- end shop banner -->


	<!-- testimonail-section -->
	<div class="testimonail-section mt-80 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="testimonial-sliders">
						<div class="single-testimonial-slider">
							<div class="client-avater">
								<img src="assets/img/avaters/avatar1.png" alt="">
							</div>
							<div class="client-meta">
								<h3>Sari Dewi<span>Kontraktor</span></h3>
								<p class="testimonial-body">
									"Kualitas beton dari Turen Indah Bangunan sangat memuaskan. Pengiriman selalu tepat waktu dan sesuai spesifikasi proyek. Sangat recommended untuk kebutuhan konstruksi."
								</p>
								<div class="last-icon">
									<i class="fas fa-quote-right"></i>
								</div>
							</div>
						</div>
						<div class="single-testimonial-slider">
							<div class="client-avater">
								<img src="assets/img/avaters/avatar2.png" alt="">
							</div>
							<div class="client-meta">
								<h3>Budi Santoso <span>Developer</span></h3>
								<p class="testimonial-body">
									"Pelayanan yang sangat profesional dan produk berkualitas tinggi. Tim Turen Indah Bangunan selalu siap membantu dan memberikan solusi terbaik untuk proyek kami."
								</p>
								<div class="last-icon">
									<i class="fas fa-quote-right"></i>
								</div>
							</div>
						</div>
						<div class="single-testimonial-slider">
							<div class="client-avater">
								<img src="assets/img/avaters/avatar3.png" alt="">
							</div>
							<div class="client-meta">
								<h3>Ahmad Rizki <span>Arsitek</span></h3>
								<p class="testimonial-body">
									"Harga kompetitif dengan kualitas yang tidak diragukan lagi. Turen Indah Bangunan adalah partner terpercaya untuk semua kebutuhan material konstruksi."
								</p>
								<div class="last-icon">
									<i class="fas fa-quote-right"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end testimonail-section -->

	<!-- logo carousel -->
		<div class="logo-carousel-section">
		<div class="container">
			<div class="row">
			<div class="col-lg-12">
				<div class="logo-carousel-inner">

				<div class="single-logo-item">
					<a href="http://perumahandimalang.com" target="_blank" rel="noopener"
					aria-label="Turen Indah Property">
					<img src="assets/img/company-logos/18.png" alt="Turen Indah Property">
					</a>
				</div>

				<div class="single-logo-item">
					<a href="https://oceangardenresto.com/" target="_blank" rel="noopener"
					aria-label="Ocean Garden">
					<img src="assets/img/company-logos/16.png" alt="Ocean Garden">
					</a>
				</div>

				<div class="single-logo-item">
					<a href="https://www.turenindahbangunan.com/" target="_blank" rel="noopener"
					aria-label="TiB">
					<img src="assets/img/company-logos/17.png" alt="TiB">
					</a>
				</div>

				<div class="single-logo-item">
					<a href="https://monogram.example.com" target="_blank" rel="noopener"
					aria-label="Monogram M">
					<img src="assets/img/company-logos/15.png" alt="Beton">
					</a>
				</div>

				</div>
			</div>
			</div>
		</div>
		</div>
	<!-- end logo carousel -->

<?php include 'includes/footer.php'; ?>
	
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
