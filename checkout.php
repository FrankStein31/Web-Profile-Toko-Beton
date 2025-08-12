<?php
require_once 'includes/init.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Checkout - Turen Indah Bangunan">

	<!-- title -->
	<title>Check Out | Turen Indah Bangunan</title>

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
								<li><a href="contact.php">Contact</a></li>
								<li class="current-list-item"><a href="shop.php">Shop</a>
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
						<p>Turen Indah Bangunan</p>
						<h1>Check Out Produk</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- check out section -->
	<div class="checkout-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="checkout-accordion-wrap">
						<div class="accordion" id="accordionExample">
						  <div class="card single-accordion">
						    <div class="card-header" id="headingOne">
						      <h5 class="mb-0">
						        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						          Informasi Billing
						        </button>
						      </h5>
						    </div>

						    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
						      <div class="card-body">
						        <div class="billing-address-form">
						        	<form action="#" method="POST">
						        		<p><input type="text" name="nama" placeholder="Nama Lengkap" required></p>
						        		<p><input type="email" name="email" placeholder="Email" required></p>
						        		<p><input type="text" name="alamat" placeholder="Alamat Lengkap" required></p>
						        		<p><input type="text" name="kota" placeholder="Kota" required></p>
						        		<p><input type="text" name="kode_pos" placeholder="Kode Pos" required></p>
						        		<p><input type="tel" name="telepon" placeholder="Nomor Telepon" required></p>
						        		<p><textarea name="catatan" placeholder="Catatan Tambahan (opsional)" rows="3"></textarea></p>
						        	</form>
						        </div>
						      </div>
						    </div>
						  </div>
						  
						  <div class="card single-accordion">
						    <div class="card-header" id="headingTwo">
						      <h5 class="mb-0">
						        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						          Metode Pengiriman
						        </button>
						      </h5>
						    </div>
						    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
						      <div class="card-body">
						        <div class="shipping-address-form">
						        	<p>
						        		<input type="radio" id="standard" name="shipping" value="standard" checked>
						        		<label for="standard">Pengiriman Standard (3-5 hari) - Rp 50.000</label>
						        	</p>
						        	<p>
						        		<input type="radio" id="express" name="shipping" value="express">
						        		<label for="express">Pengiriman Express (1-2 hari) - Rp 100.000</label>
						        	</p>
						        	<p>
						        		<input type="radio" id="pickup" name="shipping" value="pickup">
						        		<label for="pickup">Ambil di Toko - Gratis</label>
						        	</p>
						        </div>
						      </div>
						    </div>
						  </div>
						  
						  <div class="card single-accordion">
						    <div class="card-header" id="headingThree">
						      <h5 class="mb-0">
						        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
						          Metode Pembayaran
						        </button>
						      </h5>
						    </div>
						    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
						      <div class="card-body">
						        <div class="payment-method">
						        	<p>
						        		<input type="radio" id="bank_transfer" name="payment" value="bank_transfer" checked>
						        		<label for="bank_transfer">Transfer Bank</label>
						        	</p>
						        	<p>
						        		<input type="radio" id="cod" name="payment" value="cod">
						        		<label for="cod">Bayar di Tempat (COD)</label>
						        	</p>
						        	<p>
						        		<input type="radio" id="ewallet" name="payment" value="ewallet">
						        		<label for="ewallet">E-Wallet (OVO, DANA, GoPay)</label>
						        	</p>
						        </div>
						      </div>
						    </div>
						  </div>
						</div>

					</div>
				</div>

				<div class="col-lg-4">
					<div class="order-details-wrap">
						<table class="order-details">
							<thead>
								<tr>
									<th>Pesanan Anda</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody class="order-details-body" id="checkout-items">
								<!-- Items will be loaded here -->
							</tbody>
							<tbody class="checkout-details">
								<tr>
									<td>Subtotal</td>
									<td id="checkout-subtotal">Rp 0</td>
								</tr>
								<tr>
									<td>Ongkir</td>
									<td id="checkout-shipping">Rp 50.000</td>
								</tr>
								<tr>
									<td>Total</td>
									<td id="checkout-total">Rp 0</td>
								</tr>
							</tbody>
						</table>
						
						<div class="text-center mt-3">
							<p class="mb-3">Untuk pemesanan dan konfirmasi, silakan hubungi kami melalui WhatsApp:</p>
							<a href="#" id="whatsapp-order" class="boxed-btn" target="_blank">
								<i class="fab fa-whatsapp"></i> Pesan via WhatsApp
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end check out section -->

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

<script>
document.addEventListener('DOMContentLoaded', function () {
	const cart = JSON.parse(localStorage.getItem('cart')) || [];
	const checkoutItemsContainer = document.getElementById('checkout-items');
	
	let subtotal = 0;
	
	if (cart.length > 0) {
		cart.forEach(item => {
			const itemTotal = item.price * item.quantity;
			subtotal += itemTotal;
			
			const row = document.createElement('tr');
			row.innerHTML = `
				<td>${item.name} x ${item.quantity}</td>
				<td>Rp ${itemTotal.toLocaleString('id-ID')}</td>
			`;
			checkoutItemsContainer.appendChild(row);
		});
	} else {
		checkoutItemsContainer.innerHTML = '<tr><td colspan="2">Keranjang kosong</td></tr>';
	}
	
	// Update totals
	const shipping = 50000;
	const total = subtotal + shipping;
	
	document.getElementById('checkout-subtotal').textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
	document.getElementById('checkout-shipping').textContent = `Rp ${shipping.toLocaleString('id-ID')}`;
	document.getElementById('checkout-total').textContent = `Rp ${total.toLocaleString('id-ID')}`;
	
	// Setup WhatsApp order link
	const whatsappBtn = document.getElementById('whatsapp-order');
	whatsappBtn.addEventListener('click', function(e) {
		e.preventDefault();
		
		// Get form data
		const nama = document.querySelector('input[name="nama"]').value || '';
		const email = document.querySelector('input[name="email"]').value || '';
		const alamat = document.querySelector('input[name="alamat"]').value || '';
		const telepon = document.querySelector('input[name="telepon"]').value || '';
		
		// Build cart summary
		let cartSummary = '';
		cart.forEach(item => {
			cartSummary += `- ${item.name} x ${item.quantity} = Rp ${(item.price * item.quantity).toLocaleString('id-ID')}%0A`;
		});
		
		const message = `Halo, saya ingin memesan:%0A%0A` +
			`*DETAIL PESANAN:*%0A${cartSummary}%0A` +
			`*TOTAL:* Rp ${total.toLocaleString('id-ID')}%0A%0A` +
			`*DATA PEMBELI:*%0A` +
			`Nama: ${nama}%0A` +
			`Email: ${email}%0A` +
			`Alamat: ${alamat}%0A` +
			`Telepon: ${telepon}%0A%0A` +
			`Mohon informasi lebih lanjut untuk proses pemesanan. Terima kasih!`;
		
		const whatsappUrl = `https://api.whatsapp.com/send/?phone=6281252462983&text=${message}`;
		window.open(whatsappUrl, '_blank');
	});
});
</script>
	
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
