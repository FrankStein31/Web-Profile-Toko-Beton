<?php
require_once 'includes/init.php';

// Get categories and products
try {
    $kategoris = $kategoriModel->getByStatus('aktif');
    $produks = $produkModel->getByStatus('aktif');
    
    // Filter by category if specified
    $kategori_filter = $_GET['kategori'] ?? null;
    if ($kategori_filter) {
        $produks = $produkModel->getByKategori($kategori_filter, 'aktif');
        $kategori_aktif = $kategoriModel->getById($kategori_filter);
    }
    
    // Search functionality
    $search = $_GET['search'] ?? null;
    if ($search) {
        $produks = $produkModel->search($search);
    }
    
} catch (Exception $e) {
    $error = $e->getMessage();
    $kategoris = [];
    $produks = [];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Toko Beton Terlengkap di Malang - Turen Indah Bangunan">

	<!-- title -->
	<title>Produk Beton - Turen Indah Bangunan</title>

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
		.product-item {
			background: white;
			border-radius: 10px;
			box-shadow: 0 5px 15px rgba(0,0,0,0.1);
			transition: all 0.3s ease;
			margin-bottom: 30px;
		}
		
		.product-item:hover {
			transform: translateY(-5px);
			box-shadow: 0 10px 25px rgba(0,0,0,0.15);
		}
		
		.product-image {
			position: relative;
			overflow: hidden;
			border-radius: 10px 10px 0 0;
			height: 250px;
		}
		
		.product-image img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			transition: transform 0.3s ease;
		}
		
		.product-item:hover .product-image img {
			transform: scale(1.05);
		}
		
		.product-badge {
			position: absolute;
			top: 15px;
			left: 15px;
			background: #F28123;
			color: white;
			padding: 5px 10px;
			border-radius: 15px;
			font-size: 12px;
			font-weight: 600;
		}
		
		.product-info {
			padding: 20px;
		}
		
		.product-title {
			font-size: 18px;
			font-weight: 600;
			margin-bottom: 10px;
			color: #2c3e50;
		}
		
		.product-category {
			color: #F28123;
			font-size: 14px;
			margin-bottom: 10px;
			text-transform: uppercase;
			letter-spacing: 0.5px;
		}
		
		.product-price {
			font-size: 20px;
			font-weight: 700;
			color: #27ae60;
			margin-bottom: 10px;
		}
		
		.product-description {
			color: #666;
			font-size: 14px;
			line-height: 1.5;
			margin-bottom: 15px;
		}
		
		.filter-section {
			background: white;
			padding: 20px;
			border-radius: 10px;
			box-shadow: 0 2px 10px rgba(0,0,0,0.1);
			margin-bottom: 30px;
		}
		
		.category-filter {
			display: flex;
			flex-wrap: wrap;
			gap: 10px;
			margin-top: 15px;
		}
		
		.category-btn {
			padding: 8px 20px;
			border: 2px solid #F28123;
			background: transparent;
			color: #F28123;
			border-radius: 25px;
			text-decoration: none;
			transition: all 0.3s ease;
			font-weight: 500;
		}
		
		.category-btn:hover,
		.category-btn.active {
			background: #F28123;
			color: white;
		}
		
		.search-section {
			margin-bottom: 20px;
		}
		
		.search-form {
			display: flex;
			gap: 10px;
		}
		
		.search-form input {
			flex: 1;
			padding: 12px 20px;
			border: 2px solid #e1e1e1;
			border-radius: 25px;
			outline: none;
		}
		
		.search-form input:focus {
			border-color: #F28123;
		}
		
		.search-form button {
			padding: 12px 25px;
			background: #F28123;
			color: white;
			border: none;
			border-radius: 25px;
			cursor: pointer;
		}
		
		.no-products {
			text-align: center;
			padding: 60px 20px;
			color: #666;
		}
		
		.no-products i {
			font-size: 64px;
			color: #ddd;
			margin-bottom: 20px;
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
							<a href="index.html">
								<img src="assets/img/logo1.png" alt="Logo" style="max-height: 70px; height: auto; width: auto;">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li><a href="index.html">Home</a>
									<ul class="sub-menu">
										<li><a href="index.html">Static Home</a></li>
										<li><a href="index_2.html">Slider Home</a></li>
									</ul>
								</li>
								<li><a href="about.html">About</a></li>
								<li><a href="news.html">News</a>
									<ul class="sub-menu">
										<li><a href="news.html">News</a></li>
										<li><a href="single-news.html">Single News</a></li>
									</ul>
								</li>
								<li><a href="contact.html">Contact</a></li>
								<li class="current-list-item"><a href="shop.php">Shop</a>
									<ul class="sub-menu">
										<li><a href="shop.php">Shop</a></li>
										<li><a href="checkout.html">Check Out</a></li>
										<li><a href="single-product.php">Single Product</a></li>
										<li><a href="cart.html">Cart</a></li>
									</ul>
								</li>
								<li>
									<div class="header-icons">
										<a class="shopping-cart" href="cart.html"><i class="fas fa-shopping-cart"></i></a>
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
							<form action="shop.php" method="GET">
								<input type="text" name="search" placeholder="Cari produk..." value="<?= htmlspecialchars($search ?? '') ?>">
								<button type="submit">Search <i class="fas fa-search"></i></button>
							</form>
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
						<p>Produk Berkualitas Tinggi</p>
						<h1>Produk Beton & Bangunan</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- products -->
	<div class="product-section mt-150 mb-150">
		<div class="container">
			
			<!-- Filter Section -->
			<div class="filter-section">
				<div class="row">
					<div class="col-md-6">
						<h4>Filter Kategori</h4>
						<div class="category-filter">
							<a href="shop.php" class="category-btn <?= !$kategori_filter ? 'active' : '' ?>">
								Semua Produk
							</a>
							<?php foreach ($kategoris as $kat): ?>
								<a href="shop.php?kategori=<?= $kat['id'] ?>" 
								   class="category-btn <?= $kategori_filter == $kat['id'] ? 'active' : '' ?>">
									<?= htmlspecialchars($kat['nama_kategori']) ?>
								</a>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="col-md-6">
						<h4>Cari Produk</h4>
						<div class="search-section">
							<form action="shop.php" method="GET" class="search-form">
								<?php if ($kategori_filter): ?>
									<input type="hidden" name="kategori" value="<?= $kategori_filter ?>">
								<?php endif; ?>
								<input type="text" name="search" placeholder="Cari produk..." 
								       value="<?= htmlspecialchars($search ?? '') ?>">
								<button type="submit">
									<i class="fas fa-search"></i> Cari
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>

			<?php if (isset($error)): ?>
				<div class="alert alert-danger">
					<i class="fas fa-exclamation-triangle"></i> Error: <?= $error ?>
				</div>
			<?php endif; ?>

			<?php if (isset($kategori_aktif)): ?>
				<div class="row mb-4">
					<div class="col-12">
						<div class="alert alert-info">
							<h5><i class="fas fa-filter"></i> Filter: <?= htmlspecialchars($kategori_aktif['nama_kategori']) ?></h5>
							<p class="mb-0"><?= htmlspecialchars($kategori_aktif['deskripsi']) ?></p>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<?php if ($search): ?>
				<div class="row mb-4">
					<div class="col-12">
						<div class="alert alert-warning">
							<h5><i class="fas fa-search"></i> Hasil pencarian untuk: "<?= htmlspecialchars($search) ?>"</h5>
							<p class="mb-0">Ditemukan <?= count($produks) ?> produk</p>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<div class="row">
				<?php if (!empty($produks)): ?>
					<?php foreach ($produks as $produk): ?>
						<div class="col-lg-4 col-md-6">
							<div class="product-item">
								<div class="product-image">
									<?php if ($produk['gambar_utama']): ?>
										<img src="<?= BASE_URL . PRODUK_IMG_PATH . $produk['gambar_utama'] ?>" 
										     alt="<?= htmlspecialchars($produk['nama_produk']) ?>">
									<?php else: ?>
										<img src="assets/img/products/default-product.jpg" 
										     alt="<?= htmlspecialchars($produk['nama_produk']) ?>">
									<?php endif; ?>
									
									<div class="product-badge"><?= htmlspecialchars($produk['nama_kategori']) ?></div>
								</div>
								
								<div class="product-info">
									<div class="product-category"><?= htmlspecialchars($produk['nama_kategori']) ?></div>
									<h3 class="product-title"><?= htmlspecialchars($produk['nama_produk']) ?></h3>
									
									<?php if ($produk['harga'] > 0): ?>
										<div class="product-price">
											<?= formatRupiah($produk['harga']) ?>
											<small>/ <?= $produk['satuan'] ?></small>
										</div>
									<?php else: ?>
										<div class="product-price text-info">Hubungi Kami</div>
									<?php endif; ?>
									
									<?php if ($produk['deskripsi']): ?>
										<p class="product-description">
											<?= htmlspecialchars(substr($produk['deskripsi'], 0, 100)) ?>
											<?= strlen($produk['deskripsi']) > 100 ? '...' : '' ?>
										</p>
									<?php endif; ?>
									
									<div class="d-flex justify-content-between align-items-center">
										<a href="single-product.php?id=<?= $produk['id'] ?>" class="btn btn-primary">
											<i class="fas fa-eye"></i> Detail
										</a>
										<div class="text-end">
											<small class="text-muted">
												Stok: <?= $produk['stok'] ?> <?= $produk['satuan'] ?>
											</small>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<div class="col-12">
						<div class="no-products">
							<i class="fas fa-search"></i>
							<h3>Produk Tidak Ditemukan</h3>
							<p>Maaf, tidak ada produk yang sesuai dengan kriteria pencarian Anda.</p>
							<a href="shop.php" class="btn btn-primary">
								<i class="fas fa-arrow-left"></i> Lihat Semua Produk
							</a>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<!-- end products -->

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
							<li><a href="index.html">Home</a></li>
							<li><a href="about.html">About</a></li>
							<li><a href="shop.php">Shop</a></li>
							<li><a href="news.html">News</a></li>
							<li><a href="contact.html">Contact</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box subscribe">
						<h2 class="widget-title">Subscribe</h2>
						<p>Subscribe to our mailing list to get the latest updates.</p>
						<form action="index.html">
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
