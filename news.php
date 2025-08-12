<?php
require_once 'includes/init.php';

$page = $_GET['page'] ?? 1;
$limit = 6;
$offset = ($page - 1) * $limit;
$search = $_GET['search'] ?? '';

try {
    if ($search) {
        $allBerita = $beritaModel->search($search);
    } else {
        $allBerita = $beritaModel->getAll('aktif');
    }
    
    // Pagination
    $totalBerita = count($allBerita);
    $totalPages = ceil($totalBerita / $limit);
    $beritaPaginated = array_slice($allBerita, $offset, $limit);
    
    // Get recent berita for sidebar
    $recentBerita = $beritaModel->getRecent(5);
    
} catch (Exception $e) {
    $error = "Terjadi kesalahan dalam memuat berita";
    $allBerita = [];
    $beritaPaginated = [];
    $recentBerita = [];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Berita terbaru seputar dunia konstruksi dan beton - Turen Indah Bangunan">

	<!-- title -->
	<title>Berita - Turen Indah Bangunan</title>

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
		.news-card {
			background: white;
			border-radius: 15px;
			box-shadow: 0 5px 15px rgba(0,0,0,0.1);
			transition: all 0.3s ease;
			overflow: hidden;
			margin-bottom: 30px;
		}
		
		.news-card:hover {
			transform: translateY(-5px);
			box-shadow: 0 10px 25px rgba(0,0,0,0.15);
		}
		
		.news-image {
			height: 250px;
			overflow: hidden;
		}
		
		.news-image img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			transition: transform 0.3s ease;
		}
		
		.news-card:hover .news-image img {
			transform: scale(1.05);
		}
		
		.news-content {
			padding: 25px;
		}
		
		.news-title {
			font-size: 20px;
			font-weight: 600;
			margin-bottom: 10px;
			line-height: 1.4;
		}
		
		.news-title a {
			color: #2c3e50;
			text-decoration: none;
		}
		
		.news-title a:hover {
			color: #F28123;
		}
		
		.news-meta {
			color: #666;
			font-size: 14px;
			margin-bottom: 15px;
		}
		
		.news-description {
			color: #666;
			line-height: 1.6;
			margin-bottom: 20px;
		}
		
		.news-tags {
			margin-bottom: 15px;
		}
		
		.news-tag {
			display: inline-block;
			background: #f8f9fa;
			color: #666;
			padding: 5px 10px;
			border-radius: 15px;
			font-size: 12px;
			margin-right: 5px;
			margin-bottom: 5px;
		}
		
		.read-more-btn {
			background: #F28123;
			color: white;
			padding: 10px 20px;
			border-radius: 25px;
			text-decoration: none;
			font-weight: 600;
			transition: all 0.3s ease;
		}
		
		.read-more-btn:hover {
			background: #e67e22;
			color: white;
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
		
		.recent-news-item {
			display: flex;
			margin-bottom: 15px;
			padding-bottom: 15px;
			border-bottom: 1px solid #eee;
		}
		
		.recent-news-item:last-child {
			border-bottom: none;
			margin-bottom: 0;
			padding-bottom: 0;
		}
		
		.recent-news-image {
			width: 80px;
			height: 60px;
			border-radius: 5px;
			overflow: hidden;
			margin-right: 15px;
		}
		
		.recent-news-image img {
			width: 100%;
			height: 100%;
			object-fit: cover;
		}
		
		.recent-news-content h6 {
			font-size: 14px;
			line-height: 1.4;
			margin-bottom: 5px;
		}
		
		.recent-news-content a {
			color: #2c3e50;
			text-decoration: none;
		}
		
		.recent-news-content a:hover {
			color: #F28123;
		}
		
		.recent-news-date {
			font-size: 12px;
			color: #666;
		}
		
		.search-box {
			position: relative;
			margin-bottom: 20px;
		}
		
		.search-input {
			width: 100%;
			padding: 12px 45px 12px 15px;
			border: 2px solid #eee;
			border-radius: 25px;
			outline: none;
		}
		
		.search-input:focus {
			border-color: #F28123;
		}
		
		.search-btn {
			position: absolute;
			right: 5px;
			top: 50%;
			transform: translateY(-50%);
			background: #F28123;
			border: none;
			padding: 8px 12px;
			border-radius: 20px;
			color: white;
		}
		
		.pagination-custom {
			display: flex;
			justify-content: center;
			margin-top: 50px;
		}
		
		.pagination-custom .page-link {
			color: #666;
			border: 1px solid #ddd;
			margin: 0 2px;
			border-radius: 5px;
		}
		
		.pagination-custom .page-link:hover {
			background: #F28123;
			border-color: #F28123;
			color: white;
		}
		
		.pagination-custom .page-item.active .page-link {
			background: #F28123;
			border-color: #F28123;
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
						<p>Informasi Terkini</p>
						<h1>Berita & Artikel</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- news section -->
	<div class="mt-150 mb-150">
		<div class="container">
			<?php if (isset($error)): ?>
				<div class="alert alert-danger">
					<?= $error ?>
				</div>
			<?php endif; ?>

			<div class="row">
				<div class="col-lg-8">
					<!-- Search Results Info -->
					<?php if ($search): ?>
						<div class="mb-4">
							<h4>Hasil pencarian untuk: "<?= htmlspecialchars($search) ?>"</h4>
							<p class="text-muted"><?= count($allBerita) ?> berita ditemukan</p>
						</div>
					<?php endif; ?>

					<!-- News Grid -->
					<div class="row">
						<?php if (empty($beritaPaginated)): ?>
							<div class="col-12">
								<div class="text-center py-5">
									<i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
									<h4>Belum Ada Berita</h4>
									<p class="text-muted">Berita akan segera tersedia. Silakan kunjungi lagi nanti.</p>
								</div>
							</div>
						<?php else: ?>
							<?php foreach ($beritaPaginated as $news): ?>
								<div class="col-lg-6 col-md-6">
									<div class="news-card">
										<div class="news-image">
											<?php if ($news['gambar']): ?>
												<img src="<?= BERITA_IMG_URL . $news['gambar'] ?>" 
												     alt="<?= htmlspecialchars($news['judul']) ?>">
											<?php else: ?>
												<div class="d-flex align-items-center justify-content-center h-100 bg-light">
													<i class="fas fa-newspaper fa-3x text-muted"></i>
												</div>
											<?php endif; ?>
										</div>
										
										<div class="news-content">
											<div class="news-meta">
												<i class="fas fa-calendar"></i> <?= $news['tanggal_format'] ?>
											</div>
											
											<h3 class="news-title">
												<a href="single-news.php?slug=<?= $news['slug'] ?>">
													<?= htmlspecialchars($news['judul']) ?>
												</a>
											</h3>
											
											<p class="news-description">
												<?= htmlspecialchars(substr($news['deskripsi'], 0, 120)) ?>
												<?= strlen($news['deskripsi']) > 120 ? '...' : '' ?>
											</p>
											
											<?php if ($news['tags']): ?>
												<div class="news-tags">
													<?php 
													$tags = explode(',', $news['tags']);
													foreach (array_slice($tags, 0, 3) as $tag): 
													?>
														<span class="news-tag"><?= trim(htmlspecialchars($tag)) ?></span>
													<?php endforeach; ?>
												</div>
											<?php endif; ?>
											
											<a href="single-news.php?slug=<?= $news['slug'] ?>" class="read-more-btn">
												Baca Selengkapnya <i class="fas fa-arrow-right"></i>
											</a>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>

					<!-- Pagination -->
					<?php if ($totalPages > 1): ?>
						<nav class="pagination-custom">
							<ul class="pagination">
								<?php if ($page > 1): ?>
									<li class="page-item">
										<a class="page-link" href="?page=<?= $page - 1 ?><?= $search ? '&search=' . urlencode($search) : '' ?>">
											<i class="fas fa-chevron-left"></i>
										</a>
									</li>
								<?php endif; ?>

								<?php for ($i = 1; $i <= $totalPages; $i++): ?>
									<li class="page-item <?= $i == $page ? 'active' : '' ?>">
										<a class="page-link" href="?page=<?= $i ?><?= $search ? '&search=' . urlencode($search) : '' ?>">
											<?= $i ?>
										</a>
									</li>
								<?php endfor; ?>

								<?php if ($page < $totalPages): ?>
									<li class="page-item">
										<a class="page-link" href="?page=<?= $page + 1 ?><?= $search ? '&search=' . urlencode($search) : '' ?>">
											<i class="fas fa-chevron-right"></i>
										</a>
									</li>
								<?php endif; ?>
							</ul>
						</nav>
					<?php endif; ?>
				</div>

				<!-- Sidebar -->
				<div class="col-lg-4">
					<!-- Search Widget -->
					<div class="sidebar-widget">
						<h3 class="widget-title">Cari Berita</h3>
						<form method="GET" action="news.php">
							<div class="search-box">
								<input type="text" name="search" class="search-input" 
								       placeholder="Cari berita..." value="<?= htmlspecialchars($search) ?>">
								<button type="submit" class="search-btn">
									<i class="fas fa-search"></i>
								</button>
							</div>
						</form>
					</div>

					<!-- Recent News Widget -->
					<?php if (!empty($recentBerita)): ?>
						<div class="sidebar-widget">
							<h3 class="widget-title">Berita Terbaru</h3>
							<?php foreach ($recentBerita as $recent): ?>
								<div class="recent-news-item">
									<div class="recent-news-image">
										<?php if ($recent['gambar']): ?>
											<img src="<?= BERITA_IMG_URL . $recent['gambar'] ?>" 
											     alt="<?= htmlspecialchars($recent['judul']) ?>">
										<?php else: ?>
											<div class="d-flex align-items-center justify-content-center h-100 bg-light">
												<i class="fas fa-newspaper text-muted"></i>
											</div>
										<?php endif; ?>
									</div>
									<div class="recent-news-content">
										<h6>
											<a href="single-news.php?slug=<?= $recent['slug'] ?>">
												<?= htmlspecialchars($recent['judul']) ?>
											</a>
										</h6>
										<div class="recent-news-date"><?= $recent['tanggal_format'] ?></div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<!-- Categories Widget -->
					<div class="sidebar-widget">
						<h3 class="widget-title">Navigasi</h3>
						<ul class="list-unstyled">
							<li class="mb-2"><a href="index.php" class="text-decoration-none"><i class="fas fa-home"></i> Beranda</a></li>
							<li class="mb-2"><a href="about.php" class="text-decoration-none"><i class="fas fa-info-circle"></i> Tentang Kami</a></li>
							<li class="mb-2"><a href="shop.php" class="text-decoration-none"><i class="fas fa-store"></i> Produk</a></li>
							<li class="mb-2"><a href="contact.php" class="text-decoration-none"><i class="fas fa-envelope"></i> Kontak</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end news section -->

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
	<script src="assets/js/sticker.js"></script>
	<!-- sticker js -->
	<script src="assets/js/sticker.js"></script>
	<!-- main js -->
	<script src="assets/js/main.js"></script>
	
</body>
</html>
