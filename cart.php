<?php
require_once 'includes/init.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Keranjang Belanja - Turen Indah Bangunan</title>
	<link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/all.min.css">
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<link rel="stylesheet" href="assets/css/animate.css">
	<link rel="stylesheet" href="assets/css/meanmenu.min.css">
	<link rel="stylesheet" href="assets/css/main.css">
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
						<h1>Keranjang Belanja</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

<!-- Cart Section -->
<div class="cart-section mt-150 mb-150">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-12">
				<div class="cart-table-wrap">
					<table class="cart-table">
						<thead class="cart-table-head">
							<tr class="table-head-row">
								<th class="product-remove"></th>
								<th class="product-image">Gambar Produk</th>
								<th class="product-name">Nama</th>
								<th class="product-price">Harga</th>
								<th class="product-quantity">Jumlah</th>
								<th class="product-total">Total</th>
							</tr>
						</thead>
						<tbody id="cart-items">
							<!-- Items will be injected here -->
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="total-section">
					<table class="total-table">
						<thead class="total-table-head">
							<tr class="table-total-row">
								<th>Total</th>
								<th>Harga</th>
							</tr>
						</thead>
						<tbody>
							<tr class="total-data">
								<td><strong>Subtotal:</strong></td>
								<td id="subtotal">Rp 0</td>
							</tr>
							<tr class="total-data">
								<td><strong>Ongkir:</strong></td>
								<td id="shipping">Rp 50.000</td>
							</tr>
							<tr class="total-data">
								<td><strong>Total:</strong></td>
								<td id="total">Rp 0</td>
							</tr>
						</tbody>
					</table>
					<div class="cart-buttons">
						<a href="shop.php" class="boxed-btn">Lanjut Belanja</a>
						<a href="checkout.php" class="boxed-btn black">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Cart Section -->

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
	const cartItemsContainer = document.getElementById('cart-items');
	let cart = JSON.parse(localStorage.getItem('cart')) || [];

	if (cart.length === 0) {
		cartItemsContainer.innerHTML = '<tr><td colspan="6" class="text-center">Keranjang kosong.</td></tr>';
		return;
	}

	let subtotal = 0;

	cart.forEach((item, index) => {
		const itemTotal = item.price * item.quantity;
		subtotal += itemTotal;
		const row = document.createElement('tr');
		row.className = 'table-body-row';
		row.innerHTML = `
			<td class="product-remove"><a href="#" class="remove-item" data-index="${index}"><i class="far fa-window-close"></i></a></td>
			<td class="product-image"><img src="${item.image}" alt="${item.name}"></td>
			<td class="product-name">${item.name}</td>
			<td class="product-price">Rp ${item.price.toLocaleString('id-ID')}</td>
			<td class="product-quantity"><input type="number" value="${item.quantity}" min="1" class="quantity-input" data-index="${index}"></td>
			<td class="product-total">Rp ${itemTotal.toLocaleString('id-ID')}</td>
		`;
		cartItemsContainer.appendChild(row);
	});

	const shipping = subtotal > 0 ? 50000 : 0;
	document.getElementById('subtotal').textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
	document.getElementById('shipping').textContent = `Rp ${shipping.toLocaleString('id-ID')}`;
	document.getElementById('total').textContent = `Rp ${(subtotal + shipping).toLocaleString('id-ID')}`;

	// Hapus item
	document.querySelectorAll('.remove-item').forEach(btn => {
		btn.addEventListener('click', function (e) {
			e.preventDefault();
			const index = this.getAttribute('data-index');
			cart.splice(index, 1);
			localStorage.setItem('cart', JSON.stringify(cart));
			location.reload();
		});
	});

	// Ubah jumlah
	document.querySelectorAll('.quantity-input').forEach(input => {
		input.addEventListener('change', function () {
			const index = this.getAttribute('data-index');
			const newQty = parseInt(this.value);
			if (newQty < 1) return;
			cart[index].quantity = newQty;
			localStorage.setItem('cart', JSON.stringify(cart));
			location.reload();
		});
	});
});
</script>

<!-- Scripts -->
<script src="assets/js/jquery-1.11.3.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/jquery.meanmenu.min.js"></script>
<script src="assets/js/sticker.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
