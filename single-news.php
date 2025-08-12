<?php
require_once 'includes/init.php';

$slug = $_GET['slug'] ?? null;

if (!$slug) {
    header('Location: news.php');
    exit();
}

try {
    $berita = $beritaModel->getBySlug($slug);
    if (!$berita) {
        header('Location: news.php');
        exit();
    }
    
    // Get related news (recent news excluding current)
    $relatedNews = $beritaModel->getRecent(4, $berita['id']);
    
} catch (Exception $e) {
    header('Location: news.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?= htmlspecialchars($berita['deskripsi']) ?> - Turen Indah Bangunan">
	<meta name="keywords" content="<?= htmlspecialchars($berita['tags']) ?>">

	<!-- title -->
	<title><?= htmlspecialchars($berita['judul']) ?> - Turen Indah Bangunan</title>

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
		.article-content {
			background: white;
			border-radius: 15px;
			box-shadow: 0 10px 30px rgba(0,0,0,0.1);
			overflow: hidden;
			margin-bottom: 50px;
		}
		
		.article-image {
			width: 100%;
			height: 400px;
			object-fit: cover;
		}
		
		.article-body {
			padding: 40px;
		}
		
		.article-meta {
			display: flex;
			align-items: center;
			margin-bottom: 20px;
			padding-bottom: 20px;
			border-bottom: 2px solid #f8f9fa;
		}
		
		.meta-item {
			margin-right: 25px;
			color: #666;
			font-size: 14px;
		}
		
		.meta-item i {
			color: #F28123;
			margin-right: 8px;
		}
		
		.article-title {
			font-size: 32px;
			font-weight: 700;
			color: #2c3e50;
			margin-bottom: 20px;
			line-height: 1.3;
		}
		
		.article-description {
			font-size: 18px;
			color: #7f8c8d;
			font-style: italic;
			margin-bottom: 30px;
			padding: 20px;
			background: #f8f9fa;
			border-left: 4px solid #F28123;
			border-radius: 5px;
		}
		
		.article-text {
			color: #333;
			line-height: 1.8;
			font-size: 16px;
		}
		
		.article-text h1,
		.article-text h2,
		.article-text h3,
		.article-text h4,
		.article-text h5,
		.article-text h6 {
			color: #2c3e50;
			margin-top: 30px;
			margin-bottom: 15px;
		}
		
		.article-text p {
			margin-bottom: 20px;
		}
		
		.article-text img {
			max-width: 100%;
			height: auto;
			border-radius: 10px;
			margin: 20px 0;
		}
		
		.article-tags {
			margin-top: 30px;
			padding-top: 30px;
			border-top: 1px solid #eee;
		}
		
		.article-tag {
			display: inline-block;
			background: #F28123;
			color: white;
			padding: 8px 15px;
			border-radius: 20px;
			font-size: 14px;
			margin-right: 10px;
			margin-bottom: 10px;
			text-decoration: none;
			transition: all 0.3s ease;
		}
		
		.article-tag:hover {
			background: #e67e22;
			color: white;
		}
		
		.article-link {
			margin-top: 30px;
			padding: 20px;
			background: #e8f4ff;
			border-radius: 10px;
			border-left: 4px solid #007bff;
		}
		
		.article-link h5 {
			color: #007bff;
			margin-bottom: 10px;
		}
		
		.external-link {
			color: #007bff;
			text-decoration: none;
			font-weight: 600;
		}
		
		.external-link:hover {
			text-decoration: underline;
		}
		
		.breadcrumb-custom {
			background: transparent;
			padding: 0;
			margin-bottom: 30px;
		}
		
		.breadcrumb-custom a {
			color: #F28123;
			text-decoration: none;
		}
		
		.breadcrumb-custom .active {
			color: #666;
		}
		
		.sidebar-widget {
			background: white;
			border-radius: 10px;
			box-shadow: 0 5px 15px rgba(0,0,0,0.1);
			padding: 25px;
			margin-bottom: 30px;
		}
		
		.widget-title {
			font-size: 18px;
			font-weight: 600;
			margin-bottom: 20px;
			color: #2c3e50;
			border-bottom: 2px solid #F28123;
			padding-bottom: 10px;
		}
		
		.related-news-item {
			display: flex;
			margin-bottom: 20px;
			padding-bottom: 20px;
			border-bottom: 1px solid #eee;
		}
		
		.related-news-item:last-child {
			border-bottom: none;
			margin-bottom: 0;
			padding-bottom: 0;
		}
		
		.related-news-image {
			width: 80px;
			height: 60px;
			border-radius: 5px;
			overflow: hidden;
			margin-right: 15px;
		}
		
		.related-news-image img {
			width: 100%;
			height: 100%;
			object-fit: cover;
		}
		
		.related-news-content h6 {
			font-size: 14px;
			line-height: 1.4;
			margin-bottom: 5px;
		}
		
		.related-news-content a {
			color: #2c3e50;
			text-decoration: none;
		}
		
		.related-news-content a:hover {
			color: #F28123;
		}
		
		.related-news-date {
			font-size: 12px;
			color: #666;
		}
		
		.social-share {
			margin-top: 30px;
			padding-top: 30px;
			border-top: 1px solid #eee;
		}
		
		.share-btn {
			display: inline-block;
			padding: 10px 15px;
			margin-right: 10px;
			margin-bottom: 10px;
			border-radius: 5px;
			color: white;
			text-decoration: none;
			font-weight: 600;
			transition: all 0.3s ease;
		}
		
		.share-facebook { background: #3b5998; }
		.share-twitter { background: #1da1f2; }
		.share-whatsapp { background: #25d366; }
		.share-linkedin { background: #0077b5; }
		
		.share-btn:hover {
			transform: translateY(-2px);
			color: white;
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
										<li><a href="index_2.php">Slider Home</a></li>
									</ul>
								</li>
								<li><a href="about.php">About</a></li>
								<li class="current-list-item"><a href="news.php">News</a>
									<ul class="sub-menu">
										<li><a href="news.php">News</a></li>
										<li><a href="single-news.php">Single News</a></li>
									</ul>
								</li>
								<li><a href="contact.php">Contact</a></li>
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

	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Berita & Artikel</p>
						<h1><?= htmlspecialchars($berita['judul']) ?></h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- single news -->
	<div class="mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<!-- Breadcrumb -->
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb breadcrumb-custom">
							<li class="breadcrumb-item"><a href="index.php">Home</a></li>
							<li class="breadcrumb-item"><a href="news.php">Berita</a></li>
							<li class="breadcrumb-item active"><?= htmlspecialchars($berita['judul']) ?></li>
						</ol>
					</nav>

					<div class="article-content">
						<?php if ($berita['gambar']): ?>
							<img src="<?= BERITA_IMG_URL . $berita['gambar'] ?>" 
							     alt="<?= htmlspecialchars($berita['judul']) ?>"
							     class="article-image">
						<?php endif; ?>
						
						<div class="article-body">
							<div class="article-meta">
								<div class="meta-item">
									<i class="fas fa-calendar"></i>
									<?= $berita['tanggal_format'] ?>
								</div>
								<div class="meta-item">
									<i class="fas fa-clock"></i>
									<?= date('H:i', strtotime($berita['tanggal_publikasi'])) ?> WIB
								</div>
							</div>
							
							<h1 class="article-title"><?= htmlspecialchars($berita['judul']) ?></h1>
							
							<?php if ($berita['deskripsi']): ?>
								<div class="article-description">
									<?= htmlspecialchars($berita['deskripsi']) ?>
								</div>
							<?php endif; ?>
							
							<div class="article-text">
								<?= $berita['konten'] ?>
							</div>
							
							<?php if ($berita['link_website']): ?>
								<div class="article-link">
									<h5><i class="fas fa-external-link-alt"></i> Baca Juga</h5>
									<a href="<?= htmlspecialchars($berita['link_website']) ?>" 
									   target="_blank" class="external-link">
										<?= htmlspecialchars($berita['link_website']) ?>
										<i class="fas fa-external-link-alt"></i>
									</a>
								</div>
							<?php endif; ?>
							
							<?php if ($berita['tags']): ?>
								<div class="article-tags">
									<h5>Tags:</h5>
									<?php 
									$tags = explode(',', $berita['tags']);
									foreach ($tags as $tag): 
									?>
										<a href="news.php?search=<?= urlencode(trim($tag)) ?>" class="article-tag">
											<?= trim(htmlspecialchars($tag)) ?>
										</a>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
							
							<!-- Social Share -->
							<div class="social-share">
								<h5>Bagikan Artikel:</h5>
								<a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(BASE_URL . 'single-news.php?slug=' . $berita['slug']) ?>" 
								   target="_blank" class="share-btn share-facebook">
									<i class="fab fa-facebook-f"></i> Facebook
								</a>
								<a href="https://twitter.com/intent/tweet?url=<?= urlencode(BASE_URL . 'single-news.php?slug=' . $berita['slug']) ?>&text=<?= urlencode($berita['judul']) ?>" 
								   target="_blank" class="share-btn share-twitter">
									<i class="fab fa-twitter"></i> Twitter
								</a>
								<a href="https://api.whatsapp.com/send?text=<?= urlencode($berita['judul'] . ' - ' . BASE_URL . 'single-news.php?slug=' . $berita['slug']) ?>" 
								   target="_blank" class="share-btn share-whatsapp">
									<i class="fab fa-whatsapp"></i> WhatsApp
								</a>
								<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode(BASE_URL . 'single-news.php?slug=' . $berita['slug']) ?>" 
								   target="_blank" class="share-btn share-linkedin">
									<i class="fab fa-linkedin"></i> LinkedIn
								</a>
							</div>
						</div>
					</div>
				</div>

				<!-- Sidebar -->
				<div class="col-lg-4">
					<!-- Related News Widget -->
					<?php if (!empty($relatedNews)): ?>
						<div class="sidebar-widget">
							<h3 class="widget-title">Berita Terkait</h3>
							<?php foreach ($relatedNews as $related): ?>
								<div class="related-news-item">
									<div class="related-news-image">
										<?php if ($related['gambar']): ?>
											<img src="<?= BERITA_IMG_URL . $related['gambar'] ?>" 
											     alt="<?= htmlspecialchars($related['judul']) ?>">
										<?php else: ?>
											<div class="d-flex align-items-center justify-content-center h-100 bg-light">
												<i class="fas fa-newspaper text-muted"></i>
											</div>
										<?php endif; ?>
									</div>
									<div class="related-news-content">
										<h6>
											<a href="single-news.php?slug=<?= $related['slug'] ?>">
												<?= htmlspecialchars($related['judul']) ?>
											</a>
										</h6>
										<div class="related-news-date"><?= $related['tanggal_format'] ?></div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<!-- Navigation Widget -->
					<div class="sidebar-widget">
						<h3 class="widget-title">Navigasi</h3>
						<ul class="list-unstyled">
							<li class="mb-2">
								<a href="news.php" class="text-decoration-none">
									<i class="fas fa-arrow-left"></i> Kembali ke Daftar Berita
								</a>
							</li>
							<li class="mb-2">
								<a href="index.php" class="text-decoration-none">
									<i class="fas fa-home"></i> Beranda
								</a>
							</li>
							<li class="mb-2">
								<a href="shop.php" class="text-decoration-none">
									<i class="fas fa-store"></i> Produk Kami
								</a>
							</li>
							<li class="mb-2">
								<a href="contact.php" class="text-decoration-none">
									<i class="fas fa-envelope"></i> Kontak
								</a>
							</li>
						</ul>
					</div>

					<!-- Contact Widget -->
					<div class="sidebar-widget">
						<h3 class="widget-title">Hubungi Kami</h3>
						<p class="mb-3">Butuh informasi lebih lanjut? Hubungi kami sekarang!</p>
						<div class="d-grid gap-2">
							<a href="https://api.whatsapp.com/send/?phone=6281252462983" 
							   target="_blank" class="btn btn-success">
								<i class="fab fa-whatsapp"></i> Chat WhatsApp
							</a>
							<a href="tel:+6281252462983" class="btn btn-primary">
								<i class="fas fa-phone"></i> Telepon
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end single news -->

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
						<form action="index.php">
							<input type="email" placeholder="Email">
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
