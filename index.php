<?php
require_once 'includes/init.php';

// Get featured products from database
try {
    $featuredProducts = $produkModel->getFeatured(8);
} catch (Exception $e) {
    $featuredProducts = [];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Turen Indah Bangunan - Toko Beton Terlengkap di Malang">

	<!-- title -->
	<title>Turen Indah Bangunan - Toko Beton Terlengkap di Malang</title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="assets/img/image1-min.png">
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
    .product-image { position: relative; overflow: hidden; border-radius: 10px 10px 0 0; height: 250px; }
    .product-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease; }
    .product-item:hover .product-image img { transform: scale(1.05); }
    .product-badge { position: absolute; top: 15px; left: 15px; background: #F28123; color: #fff; padding: 5px 10px; border-radius: 15px; font-size: 12px; font-weight: 600; }
    .product-info { padding: 20px; }
    .product-title { font-size: 18px; font-weight: 600; margin-bottom: 10px; color: #2c3e50; }
    .product-category { color: #F28123; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px; }
    .product-price { font-size: 20px; font-weight: 700; color: #27ae60; margin-bottom: 10px; }
    .product-description { color: #666; font-size: 14px; line-height: 1.5; margin-bottom: 15px; }
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
								<li class="current-list-item"><a href="index.php">Home</a>
									<ul class="sub-menu">
										<li><a href="index.php">Static Home</a></li>
										<li><a href="index2.php">Slider Home</a></li>
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
								<li><a href="shop.php">Shop</a>
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
								<input type="text" name="search" placeholder="Cari produk beton...">
								<button type="submit">Search <i class="fas fa-search"></i></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end search area -->

	<!-- hero area -->
	<div class="hero-area hero-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 offset-lg-2 text-center">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<p class="subtitle">TUREN INDAH BANGUNAN</p>
							<h1>MULAI KONSTRUKSI ANDA DENGAN BETON BERKUALITAS</h1>
							<h3>Industri Material Bangunan dan Beton berkualitas tinggi dan terpercaya siap untuk berbagai kebutuhan konstruksi</h3>
							<div class="hero-btns">
								<a href="shop.php" class="boxed-btn">Lihat Produk</a>
								<a href="contact.html" class="bordered-btn">Hubungi Kami</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end hero area -->

	<!-- features list section -->
	<div class="list-section pt-80 pb-80">
		<div class="container">

			<div class="row">
				<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
					<div class="list-box d-flex align-items-center">
						<div class="list-icon">
							<i class="fas fa-shipping-fast"></i>
						</div>
						<div class="content">
							<h3>Pengiriman Tepat Waktu</h3>
							<p>Kami memastikan pengiriman beton dan material bangunan sesuai jadwal proyek Anda.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
					<div class="list-box d-flex align-items-center">
						<div class="list-icon">
							<i class="fas fa-phone-volume"></i>
						</div>
						<div class="content">
							<h3>Layanan Pelanggan</h3>
							<p>Hubungi kami Senin–Sabtu, pukul 08.00–16.00 WIB untuk konsultasi dan pemesanan.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="list-box d-flex justify-content-start align-items-center">
						<div class="list-icon">
							<i class="fas fa-sync"></i>
						</div>
						<div class="content">
							<h3>Garansi Kualitas</h3>
							<p>Produk beton dan material bangunan sesuai standar mutu dan spesifikasi proyek.</p>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- end features list section -->

	<!-- product section -->
<div class="product-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">    
                    <h3><span class="orange-text">Produk</span> Beton Kami</h3> 
                    <p>Berbagai pilihan produk beton dan material bangunan berkualitas tinggi, siap memenuhi kebutuhan konstruksi Anda</p>
                </div>
            </div>
        </div>

        <?php if (!empty($featuredProducts)): ?>
            <div class="row">
                <?php foreach ($featuredProducts as $produk): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="product-item">
                            <div class="product-image">
                                <a href="single-product.php?id=<?= $produk['id'] ?>">
                                    <?php if ($produk['gambar_utama']): ?>
                                        <img src="<?= PRODUK_IMG_URL . $produk['gambar_utama'] ?>" alt="<?= htmlspecialchars($produk['nama_produk']) ?>">
                                    <?php else: ?>
                                        <img src="assets/img/products/default-product.jpg" alt="<?= htmlspecialchars($produk['nama_produk']) ?>">
                                    <?php endif; ?>
                                </a>
                                <?php if (!empty($produk['nama_kategori'])): ?>
                                    <div class="product-badge"><?= htmlspecialchars($produk['nama_kategori']) ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="product-info">
                                <div class="product-category"><?= htmlspecialchars($produk['nama_kategori'] ?? '') ?></div>
                                <h3 class="product-title"><?= htmlspecialchars($produk['nama_produk']) ?></h3>
                                <?php if ((int)$produk['harga'] > 0): ?>
                                    <div class="product-price">
                                        <?= formatRupiah($produk['harga']) ?>
                                        <small>/ <?= htmlspecialchars($produk['satuan']) ?></small>
                                    </div>
                                <?php else: ?>
                                    <div class="product-price text-info">Hubungi Kami</div>
                                <?php endif; ?>
                                <?php if (!empty($produk['deskripsi'])): ?>
                                    <p class="product-description">
                                        <?= htmlspecialchars(substr($produk['deskripsi'], 0, 100)) ?><?= strlen($produk['deskripsi']) > 100 ? '...' : '' ?>
                                    </p>
                                <?php endif; ?>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="single-product.php?id=<?= $produk['id'] ?>" class="btn btn-primary">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    <div class="text-end">
                                        <small class="text-muted">Stok: <?= (int)$produk['stok'] ?> <?= htmlspecialchars($produk['satuan']) ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <a href="shop.php" class="boxed-btn">Lihat Semua Produk</a>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-muted">Produk sedang dalam proses update. Silakan hubungi kami untuk informasi lebih lanjut.</p>
                    <a href="contact.html" class="boxed-btn">Hubungi Kami</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

	<!-- end product section -->

	<!-- cart banner section -->
	<section class="cart-banner pt-100 pb-100">
    	<div class="container">
        	<div class="row clearfix">
            	<!--Image Column-->
            	<div class="image-column col-lg-6">
                	<div class="image">
                    	<div class="price-box">
                        	<div class="inner-price">
                                <span class="price">
                                    <strong>30%</strong> <br> diskon
                                </span>
                            </div>
                        </div>
                    	<img src="assets/img/hero-bg-4.jpg" alt="">
                    </div>
                </div>
                <!--Content Column-->
                <div class="content-column col-lg-6">
					<h3><span class="orange-text">Promo</span> Bulan Ini</h3>
                    <h4>Beton Ready Mix Berkualitas</h4>
                    <div class="text">Dapatkan diskon spesial untuk pemesanan beton ready mix dalam jumlah besar. Kualitas terjamin sesuai standar SNI, siap kirim ke lokasi proyek Anda.</div>
                    <!--Countdown Timer-->
                    <div class="time-counter"><div class="time-countdown clearfix" data-countdown="2025/12/31"><div class="counter-column"><div class="inner"><span class="count">00</span>Days</div></div> <div class="counter-column"><div class="inner"><span class="count">00</span>Hours</div></div>  <div class="counter-column"><div class="inner"><span class="count">00</span>Mins</div></div>  <div class="counter-column"><div class="inner"><span class="count">00</span>Secs</div></div></div></div></div>
                	<a href="https://api.whatsapp.com/send/?phone=6281252462983&text=Halo%2C%20saya%20tertarik%20dengan%20promo%20beton%20ready%20mix%20dari%20Turen%20Indah%20Bangunan" class="cart-btn mt-3" target="_blank">
                        <i class="fab fa-whatsapp"></i> Hubungi Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- end cart banner section -->

	<!-- testimonail-section -->
	<div class="testimonail-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="testimonial-sliders">
						<div class="single-testimonial-slider">
							<div class="client-avater">
								<img src="assets/img/avaters/avatar1.png" alt="">
							</div>
							<div class="client-meta">
								<h3>Budi Santoso <span>Kontraktor</span></h3>
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
								<h3>Sari Dewi <span>Developer</span></h3>
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
	
	<!-- advertisement section -->
	<div class="abt-section mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<div class="abt-bg">
						<a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="video-play-btn popup-youtube"><i class="fas fa-play"></i></a>
					</div>
				</div>
				<div class="col-lg-6 col-md-12">
					<div class="abt-text">
						<p class="top-sub">Sejak Tahun 1999</p>
						<h2>Kami Adalah <span class="orange-text">Turen Indah Bangunan</span></h2>
						<p>Sebagai perusahaan yang bergerak di bidang material bangunan dan beton, kami telah melayani ribuan proyek konstruksi di wilayah Malang dan sekitarnya dengan komitmen tinggi terhadap kualitas dan kepuasan pelanggan.</p>
						<p>Dengan pengalaman puluhan tahun, kami memahami kebutuhan konstruksi modern dan menyediakan solusi material terbaik untuk setiap jenis proyek.</p>
						<a href="about.html" class="boxed-btn mt-4">Selengkapnya</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end advertisement section -->
	
	<!-- shop banner -->
	<section class="shop-banner">
    	<div class="container">
        	<h3>Promo Akhir Tahun! <br> dengan <span class="orange-text">Diskon Besar...</span></h3>
            <div class="sale-percent"><span>Diskon! <br> Hingga</span>25% <span>off</span></div>
            <a href="shop.php" class="cart-btn btn-lg">Belanja Sekarang</a>
        </div>
    </section>
	<!-- end shop banner -->

	<!-- latest news -->
	<div class="latest-news pt-150 pb-150">
		<div class="container">

			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">	
						<h3><span class="orange-text">Berita</span> Terbaru</h3>
						<p>Informasi terkini seputar konstruksi, tips bangunan, dan update produk dari Turen Indah Bangunan</p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-4 col-md-6">
					<div class="single-latest-news">
						<a href="single-news.html"><div class="latest-news-bg news-bg-1"></div></a>
						<div class="news-text-box">
							<h3><a href="single-news.html">Tips Memilih Beton Ready Mix yang Berkualitas</a></h3>
							<p class="blog-meta">
								<span class="author"><i class="fas fa-user"></i> Admin</span>
								<span class="date"><i class="fas fa-calendar"></i> 15 Agustus, 2025</span>
							</p>
							<p class="excerpt">Panduan lengkap memilih beton ready mix yang sesuai dengan kebutuhan proyek konstruksi Anda.</p>
							<a href="single-news.html" class="read-more-btn">baca selengkapnya <i class="fas fa-angle-right"></i></a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="single-latest-news">
						<a href="single-news.html"><div class="latest-news-bg news-bg-2"></div></a>
						<div class="news-text-box">
							<h3><a href="single-news.html">Inovasi Terbaru dalam Industri Beton Precast</a></h3>
							<p class="blog-meta">
								<span class="author"><i class="fas fa-user"></i> Admin</span>
								<span class="date"><i class="fas fa-calendar"></i> 10 Agustus, 2025</span>
							</p>
							<p class="excerpt">Mengenal teknologi terbaru dalam produksi beton precast yang lebih efisien dan berkualitas.</p>
							<a href="single-news.html" class="read-more-btn">baca selengkapnya <i class="fas fa-angle-right"></i></a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 offset-md-3 offset-lg-0">
					<div class="single-latest-news">
						<a href="single-news.html"><div class="latest-news-bg news-bg-3"></div></a>
						<div class="news-text-box">
							<h3><a href="single-news.html">Standar Kualitas Beton SNI untuk Konstruksi</a></h3>
							<p class="blog-meta">
								<span class="author"><i class="fas fa-user"></i> Admin</span>
								<span class="date"><i class="fas fa-calendar"></i> 5 Agustus, 2025</span>
							</p>
							<p class="excerpt">Memahami standar kualitas beton menurut SNI dan pentingnya dalam konstruksi bangunan.</p>
							<a href="single-news.html" class="read-more-btn">baca selengkapnya <i class="fas fa-angle-right"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 text-center">
					<a href="news.html" class="boxed-btn">Berita Lainnya</a>
				</div>
			</div>
		</div>
	</div>
	<!-- end latest news -->

	<!-- logo carousel -->
	<div class="logo-carousel-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="logo-carousel-inner">
						<div class="single-logo-item">
							<img src="assets/img/company-logos/1.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/2.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/3.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/4.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/5.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end logo carousel -->

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
