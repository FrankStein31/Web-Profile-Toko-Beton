<?php
// includes/footer.php
// Dynamic footer component

// Initialize FooterModel if not already initialized
if (!isset($footerModel)) {
    require_once __DIR__ . '/../models/FooterModel.php';
    $footerModel = new FooterModel($database);
}

// Get all active footer content
$aboutUsContent = $footerModel->getAboutUsContent();
$getInTouchLinks = $footerModel->getGetInTouchLinks();
$pagesLinks = $footerModel->getPagesLinks();
$subscribeContent = $footerModel->getSubscribeContent();
$copyrightContent = $footerModel->getCopyrightContent();
$socialMediaLinks = $footerModel->getSocialMediaLinks();
?>

<!-- footer -->
<div class="footer-area">
    <div class="container">
        <div class="row">
            <!-- About Us Section -->
            <div class="col-lg-3 col-md-6">
                <div class="footer-box about-widget">
                    <h2 class="widget-title"><?= $aboutUsContent ? htmlspecialchars($aboutUsContent['title']) : 'About us' ?></h2>
                    <p><?= $aboutUsContent ? htmlspecialchars($aboutUsContent['content']) : 'Turen Indah Bangunan adalah toko beton terlengkap di Malang yang menyediakan berbagai produk beton berkualitas tinggi untuk kebutuhan konstruksi Anda.' ?></p>
                </div>
            </div>

            <!-- Get in Touch Section -->
            <div class="col-lg-3 col-md-6">
                <div class="footer-box get-in-touch">
                    <h2 class="widget-title">Get in Touch</h2>
                    <ul>
                        <?php if (!empty($getInTouchLinks)): ?>
                            <?php foreach ($getInTouchLinks as $link): ?>
                                <li>
                                    <a href="<?= htmlspecialchars($link['url'] ?? '#') ?>" 
                                       <?= (strpos($link['url'] ?? '', 'http') === 0) ? 'target="_blank"' : '' ?>>
                                        <?= htmlspecialchars($link['text'] ?? '') ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- Default fallback links -->
                            <li><a href="https://www.instagram.com/turenindah.bangunan/" target="_blank">@turenindah.bangunan</a></li>
                            <li><a href="mailto:info@turenindahbangunan.com">info@turenindahbangunan.com</a></li>
                            <li><a href="https://api.whatsapp.com/send/?phone=6281252462983" target="_blank">+62 812-5246-2983</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <!-- Pages Section -->
            <div class="col-lg-3 col-md-6">
                <div class="footer-box pages">
                    <h2 class="widget-title">Pages</h2>
                    <ul>
                        <?php if (!empty($pagesLinks)): ?>
                            <?php foreach ($pagesLinks as $link): ?>
                                <li>
                                    <a href="<?= htmlspecialchars($link['url'] ?? '#') ?>">
                                        <?= htmlspecialchars($link['text'] ?? '') ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- Default fallback pages -->
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about.php">About</a></li>
                            <li><a href="shop.php">Shop</a></li>
                            <li><a href="news.php">News</a></li>
                            <li><a href="contact.php">Contact</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <!-- Subscribe Section -->
            <div class="col-lg-3 col-md-6">
                <div class="footer-box subscribe">
                    <h2 class="widget-title"><?= $subscribeContent ? htmlspecialchars($subscribeContent['title']) : 'Subscribe' ?></h2>
                    <p><?= $subscribeContent ? htmlspecialchars($subscribeContent['content']) : 'Subscribe to our mailing list to get the latest updates.' ?></p>
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
                <p>
                    <?php if ($copyrightContent): ?>
                        <?= $copyrightContent['content'] ?>
                    <?php else: ?>
                        &copy; 2025 - Turen Indah Bangunan. <a href="#">Semua hak cipta dilindungi.</a> | Toko Bangunan Terlengkap di Malang.<br>
                        Distributed By - <a href="#">Thelord</a>
                    <?php endif; ?>
                </p>
            </div>
            <div class="col-lg-6 text-right col-md-12">
                <div class="social-icons">
                    <ul>
                        <?php if (!empty($socialMediaLinks)): ?>
                            <?php foreach ($socialMediaLinks as $link): ?>
                                <?php 
                                // Determine icon based on type
                                $iconClass = 'fab fa-' . strtolower($link['type'] ?? 'link');
                                if ($link['type'] === 'facebook') $iconClass = 'fab fa-facebook-f';
                                elseif ($link['type'] === 'twitter') $iconClass = 'fab fa-twitter';
                                elseif ($link['type'] === 'instagram') $iconClass = 'fab fa-instagram';
                                elseif ($link['type'] === 'linkedin') $iconClass = 'fab fa-linkedin';
                                elseif ($link['type'] === 'dribbble') $iconClass = 'fab fa-dribbble';
                                ?>
                                <li>
                                    <a href="<?= htmlspecialchars($link['url'] ?? '#') ?>" 
                                       <?= (strpos($link['url'] ?? '', 'http') === 0) ? 'target="_blank"' : '' ?>>
                                        <i class="<?= $iconClass ?>"></i>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- Default fallback social media -->
                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com/turenindah.bangunan/" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end copyright -->