<?php
require_once 'includes/init.php';

// Get latest news from database
try {
    $latestNews = $beritaModel->getRecent(3);
} catch (Exception $e) {
    $latestNews = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>Turen Indah Bangunan</title>

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
.product-item{background:#fff;border-radius:10px;box-shadow:0 5px 15px rgba(0,0,0,0.1);transition:all .3s ease;margin-bottom:30px}
.product-item:hover{transform:translateY(-5px);box-shadow:0 10px 25px rgba(0,0,0,0.15)}
.product-image{position:relative;overflow:hidden;border-radius:10px 10px 0 0;height:250px}
.product-image img{width:100%;height:100%;object-fit:cover;transition:transform .3s ease}
.product-item:hover .product-image img{transform:scale(1.05)}
.product-badge{position:absolute;top:15px;left:15px;background:#F28123;color:#fff;padding:5px 10px;border-radius:15px;font-size:12px;font-weight:600}
.product-info{padding:20px}
.product-title{font-size:18px;font-weight:600;margin-bottom:10px;color:#2c3e50}
.product-category{color:#F28123;font-size:14px;margin-bottom:10px;text-transform:uppercase;letter-spacing:.5px}
.product-price{font-size:20px;font-weight:700;color:#27ae60;margin-bottom:10px}
.product-description{color:#666;font-size:14px;line-height:1.5;margin-bottom:15px}
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
								<li><a href="about.php">About</a></li>

								<li><a href="news.php">News</a>
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

	<!-- home page slider -->
	<div class="homepage-slider">
		<!-- single home slider -->
		<div class="single-homepage-slider homepage-bg-1">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-lg-7 offset-lg-1 offset-xl-0">
						<div class="hero-text">
							<div class="hero-text-tablecell">
								<p class="subtitle">Fresh & Organic</p>
								<h1>Delicious Seasonal Fruits</h1>
								<div class="hero-btns">
									<a href="shop.php" class="boxed-btn">Lihat Produk</a>
									<a href="contact.php" class="bordered-btn">Contact Us</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- single home slider -->
		<div class="single-homepage-slider homepage-bg-2">
			<div class="container">
				<div class="row">
					<div class="col-lg-10 offset-lg-1 text-center">
						<div class="hero-text">
							<div class="hero-text-tablecell">
								<p class="subtitle">Fresh Everyday</p>
								<h1>100% Organic Collection</h1>
								<div class="hero-btns">
									<a href="shop.php" class="boxed-btn">Visit Shop</a>
									<a href="contact.php" class="bordered-btn">Contact Us</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- single home slider -->
		<div class="single-homepage-slider homepage-bg-3">
			<div class="container">
				<div class="row">
					<div class="col-lg-10 offset-lg-1 text-right">
						<div class="hero-text">
							<div class="hero-text-tablecell">
								<p class="subtitle">Mega Sale Going On!</p>
								<h1>Get December Discount</h1>
								<div class="hero-btns">
									<a href="shop.php" class="boxed-btn">Visit Shop</a>
									<a href="contact.php" class="bordered-btn">Contact Us</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end home page slider -->

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
                    <h3><span class="orange-text">Produk</span> Kami</h3>
                    <p>Produk unggulan siap memenuhi kebutuhan konstruksi Anda</p>
                </div>
            </div>
        </div>

        <?php 
        // Ambil produk aktif terbaru kalau belum ada variabel
        if (!isset($produkModel)) { require_once 'includes/init.php'; }
        try { $featured = $produkModel->getFeatured(8); } catch (Exception $e) { $featured = []; }
        ?>

        <?php if (!empty($featured)): ?>
            <div class="row">
                <?php foreach ($featured as $produk): ?>
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
                    <p class="text-muted">Produk sedang dalam proses update.</p>
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
                                    <strong>30%</strong> <br> off per kg
                                </span>
                            </div>
                        </div>
                    	<img src="assets/img/a.jpg" alt="">
                    </div>
                </div>
                <!--Content Column-->
                <div class="content-column col-lg-6">
					<h3><span class="orange-text">Deal</span> of the month</h3>
                    <h4>Hikan Strwaberry</h4>
                    <div class="text">Quisquam minus maiores repudiandae nobis, minima saepe id, fugit ullam similique! Beatae, minima quisquam molestias facere ea. Perspiciatis unde omnis iste natus error sit voluptatem accusant</div>
                    <!--Countdown Timer-->
                    <div class="time-counter"><div class="time-countdown clearfix" data-countdown="2020/2/01"><div class="counter-column"><div class="inner"><span class="count">00</span>Days</div></div> <div class="counter-column"><div class="inner"><span class="count">00</span>Hours</div></div>  <div class="counter-column"><div class="inner"><span class="count">00</span>Mins</div></div>  <div class="counter-column"><div class="inner"><span class="count">00</span>Secs</div></div></div></div>
                	<a href="cart.php" class="cart-btn mt-3"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
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
								<h3>Saira Hakim <span>Local shop owner</span></h3>
								<p class="testimonial-body">
									" Sed ut perspiciatis unde omnis iste natus error veritatis et  quasi architecto beatae vitae dict eaque ipsa quae ab illo inventore Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium "
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
								<h3>David Niph <span>Local shop owner</span></h3>
								<p class="testimonial-body">
									" Sed ut perspiciatis unde omnis iste natus error veritatis et  quasi architecto beatae vitae dict eaque ipsa quae ab illo inventore Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium "
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
								<h3>Jacob Sikim <span>Local shop owner</span></h3>
								<p class="testimonial-body">
									" Sed ut perspiciatis unde omnis iste natus error veritatis et  quasi architecto beatae vitae dict eaque ipsa quae ab illo inventore Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium "
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
						<a href="https://www.youtube.com/watch?v=DBLlFWYcIGQ" class="video-play-btn popup-youtube"><i class="fas fa-play"></i></a>
					</div>
				</div>
				<div class="col-lg-6 col-md-12">
					<div class="abt-text">
						<p class="top-sub">Sejak Tahun 1999</p>
						<h2>Kami Adalah <span class="orange-text">Turen Indah Bangunan</span></h2>
						<p>Sebagai perusahaan yang bergerak di bidang material bangunan dan beton, kami telah melayani ribuan proyek konstruksi di wilayah Malang dan sekitarnya dengan komitmen tinggi terhadap kualitas dan kepuasan pelanggan.</p>
						<p>Dengan pengalaman puluhan tahun, kami memahami kebutuhan konstruksi modern dan menyediakan solusi material terbaik untuk setiap jenis proyek.</p>
						<a href="about.php" class="boxed-btn mt-4">Selengkapnya</a>
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
				<?php if (!empty($latestNews)): ?>
					<?php foreach ($latestNews as $index => $news): ?>
						<div class="col-lg-4 col-md-6">
							<div class="single-latest-news">
								<a href="single-news.php?slug=<?= $news['slug'] ?>">
									<div class="latest-news-bg" style="background-image: url('<?= $news['gambar'] ? BERITA_IMG_URL . $news['gambar'] : 'assets/img/latest-news/news-bg-' . (($index % 3) + 1) . '.jpg' ?>'); background-size: cover; background-position: center; height: 300px; border-radius: 10px;"></div>
								</a>
								<div class="news-text-box">
									<h3><a href="single-news.php?slug=<?= $news['slug'] ?>"><?= htmlspecialchars($news['judul']) ?></a></h3>
									<p class="blog-meta">
										<span class="author"><i class="fas fa-user"></i> Admin</span>
										<span class="date"><i class="fas fa-calendar"></i> <?= $news['tanggal_format'] ?></span>
									</p>
									<p class="excerpt"><?= htmlspecialchars(substr($news['deskripsi'], 0, 120)) ?><?= strlen($news['deskripsi']) > 120 ? '...' : '' ?></p>
									<a href="single-news.php?slug=<?= $news['slug'] ?>" class="read-more-btn">baca selengkapnya <i class="fas fa-angle-right"></i></a>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<!-- Fallback content when no news available -->
					<div class="col-lg-4 col-md-6">
						<div class="single-latest-news">
							<a href="news.php"><div class="latest-news-bg news-bg-1"></div></a>
							<div class="news-text-box">
								<h3><a href="news.php">Tips Memilih Beton Ready Mix yang Berkualitas</a></h3>
								<p class="blog-meta">
									<span class="author"><i class="fas fa-user"></i> Admin</span>
									<span class="date"><i class="fas fa-calendar"></i> 15 Agustus, 2025</span>
								</p>
								<p class="excerpt">Panduan lengkap memilih beton ready mix yang sesuai dengan kebutuhan proyek konstruksi Anda.</p>
								<a href="news.php" class="read-more-btn">baca selengkapnya <i class="fas fa-angle-right"></i></a>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="single-latest-news">
							<a href="news.php"><div class="latest-news-bg news-bg-2"></div></a>
							<div class="news-text-box">
								<h3><a href="news.php">Inovasi Terbaru dalam Industri Beton Precast</a></h3>
								<p class="blog-meta">
									<span class="author"><i class="fas fa-user"></i> Admin</span>
									<span class="date"><i class="fas fa-calendar"></i> 10 Agustus, 2025</span>
								</p>
								<p class="excerpt">Mengenal teknologi terbaru dalam produksi beton precast yang lebih efisien dan berkualitas.</p>
								<a href="news.php" class="read-more-btn">baca selengkapnya <i class="fas fa-angle-right"></i></a>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 offset-md-3 offset-lg-0">
						<div class="single-latest-news">
							<a href="news.php"><div class="latest-news-bg news-bg-3"></div></a>
							<div class="news-text-box">
								<h3><a href="news.php">Standar Kualitas Beton SNI untuk Konstruksi</a></h3>
								<p class="blog-meta">
									<span class="author"><i class="fas fa-user"></i> Admin</span>
									<span class="date"><i class="fas fa-calendar"></i> 5 Agustus, 2025</span>
								</p>
								<p class="excerpt">Memahami standar kualitas beton menurut SNI dan pentingnya dalam konstruksi bangunan.</p>
								<a href="news.php" class="read-more-btn">baca selengkapnya <i class="fas fa-angle-right"></i></a>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<div class="row">
				<div class="col-lg-12 text-center">
					<a href="news.php" class="boxed-btn">Berita Lainnya</a>
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