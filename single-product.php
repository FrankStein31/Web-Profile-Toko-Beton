<?php
require_once 'includes/init.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: shop.php');
    exit();
}

try {
    $produk = $produkModel->getById($id);
    if (!$produk || $produk['status'] !== 'aktif') {
        header('Location: shop.php');
        exit();
    }
    
    // Get related products from same category
    $relatedProducts = $produkModel->getByKategori($produk['id_kategori'], 'aktif');
    // Remove current product from related
    $relatedProducts = array_filter($relatedProducts, function($p) use ($id) {
        return $p['id'] != $id;
    });
    $relatedProducts = array_slice($relatedProducts, 0, 3);
    
} catch (Exception $e) {
    header('Location: shop.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?= htmlspecialchars($produk['deskripsi']) ?> - Turen Indah Bangunan">

	<!-- title -->
	<title><?= htmlspecialchars($produk['nama_produk']) ?> - Turen Indah Bangunan</title>

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
		.product-details {
			background: white;
			border-radius: 15px;
			box-shadow: 0 10px 30px rgba(0,0,0,0.1);
			overflow: hidden;
			margin-bottom: 50px;
		}
		
		.product-image-section {
			padding: 30px;
			background: #f8f9fa;
		}
		
		.product-main-image {
			width: 100%;
			height: 400px;
			object-fit: cover;
			border-radius: 10px;
			box-shadow: 0 5px 15px rgba(0,0,0,0.1);
		}
		
		.product-info-section {
			padding: 40px;
		}
		
		.product-category {
			color: #F28123;
			font-weight: 600;
			text-transform: uppercase;
			letter-spacing: 1px;
			margin-bottom: 10px;
		}
		
		.product-title {
			font-size: 28px;
			font-weight: 700;
			color: #2c3e50;
			margin-bottom: 20px;
			line-height: 1.3;
		}
		
		.product-price {
			font-size: 32px;
			font-weight: 700;
			color: #27ae60;
			margin-bottom: 20px;
		}
		
		.product-description {
			color: #666;
			line-height: 1.8;
			margin-bottom: 20px;
		}
		
		.product-meta {
			border-top: 1px solid #eee;
			padding-top: 20px;
			margin-top: 30px;
		}
		
		.meta-item {
			display: flex;
			justify-content: space-between;
			margin-bottom: 10px;
			padding: 10px 0;
			border-bottom: 1px solid #f5f5f5;
		}
		
		.meta-label {
			font-weight: 600;
			color: #333;
		}
		
		.meta-value {
			color: #666;
		}
		
		.stock-status {
			padding: 8px 16px;
			border-radius: 20px;
			font-weight: 600;
			font-size: 14px;
		}
		
		.stock-available {
			background: #d4edda;
			color: #155724;
		}
		
		.stock-low {
			background: #fff3cd;
			color: #856404;
		}
		
		.stock-out {
			background: #f8d7da;
			color: #721c24;
		}
		
		.contact-buttons {
			margin-top: 30px;
		}
		
		.contact-btn {
			display: inline-block;
			padding: 12px 30px;
			margin: 5px;
			border-radius: 25px;
			text-decoration: none;
			font-weight: 600;
			text-align: center;
			transition: all 0.3s ease;
		}
		
		.btn-whatsapp {
			background: #25D366;
			color: white;
		}
		
		.btn-whatsapp:hover {
			background: #128C7E;
			color: white;
		}
		
		.btn-call {
			background: #007bff;
			color: white;
		}
		
		.btn-call:hover {
			background: #0056b3;
			color: white;
		}
		
		.related-products {
			margin-top: 80px;
		}
		
		.related-item {
			background: white;
			border-radius: 10px;
			box-shadow: 0 5px 15px rgba(0,0,0,0.1);
			transition: all 0.3s ease;
			margin-bottom: 30px;
		}
		
		.related-item:hover {
			transform: translateY(-5px);
			box-shadow: 0 10px 25px rgba(0,0,0,0.15);
		}
		
		.related-image {
			height: 200px;
			overflow: hidden;
			border-radius: 10px 10px 0 0;
		}
		
		.related-image img {
			width: 100%;
			height: 100%;
			object-fit: cover;
		}
		
		.related-info {
			padding: 20px;
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
							<a href="<?= BASE_URL ?>admin/login.php">
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

	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p><?= htmlspecialchars($produk['nama_kategori']) ?></p>
						<h1><?= htmlspecialchars($produk['nama_produk']) ?></h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- single product -->
	<div class="single-product-section mt-150 mb-150">
		<div class="container">
			
			<!-- Breadcrumb -->
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-custom">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item"><a href="shop.php">Produk</a></li>
					<li class="breadcrumb-item"><a href="shop.php?kategori=<?= $produk['id_kategori'] ?>"><?= htmlspecialchars($produk['nama_kategori']) ?></a></li>
					<li class="breadcrumb-item active"><?= htmlspecialchars($produk['nama_produk']) ?></li>
				</ol>
			</nav>

			<div class="product-details">
				<div class="row">
					<div class="col-md-6">
						<div class="product-image-section">
							<?php if ($produk['gambar_utama']): ?>
								<img src="<?= PRODUK_IMG_URL . $produk['gambar_utama'] ?>" 
								     alt="<?= htmlspecialchars($produk['nama_produk']) ?>"
								     class="product-main-image">
							<?php else: ?>
								<img src="assets/img/products/default-product.jpg" 
								     alt="<?= htmlspecialchars($produk['nama_produk']) ?>"
								     class="product-main-image">
							<?php endif; ?>
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="product-info-section">
							<div class="product-category"><?= htmlspecialchars($produk['nama_kategori']) ?></div>
							<h1 class="product-title"><?= htmlspecialchars($produk['nama_produk']) ?></h1>
							
							<?php if ($produk['harga'] > 0): ?>
								<div class="product-price">
									<?= formatRupiah($produk['harga']) ?>
									<small style="font-size: 16px; color: #666;">/ <?= $produk['satuan'] ?></small>
								</div>
							<?php else: ?>
								<div class="product-price text-info">Hubungi Kami untuk Harga</div>
							<?php endif; ?>
							
							<?php if ($produk['deskripsi']): ?>
								<div class="product-description">
									<p><?= nl2br(htmlspecialchars($produk['deskripsi'])) ?></p>
								</div>
							<?php endif; ?>
							
							<?php if ($produk['deskripsi_tambahan']): ?>
								<div class="product-description">
									<h5>Informasi Tambahan:</h5>
									<p><?= nl2br(htmlspecialchars($produk['deskripsi_tambahan'])) ?></p>
								</div>
							<?php endif; ?>
							
							<div class="product-meta">
								<div class="meta-item">
									<span class="meta-label">Kategori:</span>
									<span class="meta-value"><?= htmlspecialchars($produk['nama_kategori']) ?></span>
								</div>
								
								<div class="meta-item">
									<span class="meta-label">Satuan:</span>
									<span class="meta-value"><?= ucfirst($produk['satuan']) ?></span>
								</div>
								
								<div class="meta-item">
									<span class="meta-label">Ketersediaan:</span>
									<span class="meta-value">
										<?php if ($produk['stok'] > 10): ?>
											<span class="stock-status stock-available">
												<i class="fas fa-check"></i> Tersedia (<?= $produk['stok'] ?> <?= $produk['satuan'] ?>)
											</span>
										<?php elseif ($produk['stok'] > 0): ?>
											<span class="stock-status stock-low">
												<i class="fas fa-exclamation-triangle"></i> Stok Terbatas (<?= $produk['stok'] ?> <?= $produk['satuan'] ?>)
											</span>
										<?php else: ?>
											<span class="stock-status stock-out">
												<i class="fas fa-times"></i> Stok Habis
											</span>
										<?php endif; ?>
									</span>
								</div>
								
								<?php if ($produk['tags']): ?>
									<div class="meta-item">
										<span class="meta-label">Tags:</span>
										<span class="meta-value">
											<?php 
											$tags = explode(',', $produk['tags']);
											foreach ($tags as $tag): 
											?>
												<span class="badge bg-secondary me-1"><?= trim(htmlspecialchars($tag)) ?></span>
											<?php endforeach; ?>
										</span>
									</div>
								<?php endif; ?>
							</div>
							
							<div class="contact-buttons">
								<h5 class="mb-3">Tertarik dengan produk ini?</h5>
								<div class="d-flex flex-wrap gap-2">
									<a href="https://api.whatsapp.com/send/?phone=6281252462983&text=Halo%2C%20saya%20tertarik%20dengan%20produk%20<?= urlencode($produk['nama_produk']) ?>%20yang%20ada%20di%20website%20Turen%20Indah%20Bangunan.%20Bisakah%20saya%20mendapat%20informasi%20lebih%20lanjut%3F" 
									   class="contact-btn btn-whatsapp" target="_blank">
										<i class="fab fa-whatsapp"></i> Chat WhatsApp
									</a>
									<a href="tel:+6281252462983" class="contact-btn btn-call">
										<i class="fas fa-phone"></i> Telepon Langsung
									</a>
									<a href="contact.html" class="contact-btn btn-outline-primary">
										<i class="fas fa-envelope"></i> Kontak Kami
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Related Products -->
			<?php if (!empty($relatedProducts)): ?>
				<div class="related-products">
					<div class="row">
						<div class="col-12">
							<h3 class="text-center mb-5">Produk Sejenis</h3>
						</div>
					</div>
					
					<div class="row">
						<?php foreach ($relatedProducts as $related): ?>
							<div class="col-lg-4 col-md-6">
								<div class="related-item">
									<div class="related-image">
										<?php if ($related['gambar_utama']): ?>
											<img src="<?= PRODUK_IMG_URL . $related['gambar_utama'] ?>" 
											     alt="<?= htmlspecialchars($related['nama_produk']) ?>">
										<?php else: ?>
											<img src="assets/img/products/default-product.jpg" 
											     alt="<?= htmlspecialchars($related['nama_produk']) ?>">
										<?php endif; ?>
									</div>
									
									<div class="related-info">
										<h5><?= htmlspecialchars($related['nama_produk']) ?></h5>
										<?php if ($related['harga'] > 0): ?>
											<div class="text-success fw-bold mb-2">
												<?= formatRupiah($related['harga']) ?> / <?= $related['satuan'] ?>
											</div>
										<?php else: ?>
											<div class="text-info fw-bold mb-2">Hubungi Kami</div>
										<?php endif; ?>
										
										<p class="text-muted small">
											<?= htmlspecialchars(substr($related['deskripsi'], 0, 80)) ?>
											<?= strlen($related['deskripsi']) > 80 ? '...' : '' ?>
										</p>
										
										<a href="single-product.php?id=<?= $related['id'] ?>" class="btn btn-primary btn-sm">
											<i class="fas fa-eye"></i> Lihat Detail
										</a>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<!-- end single product -->

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
