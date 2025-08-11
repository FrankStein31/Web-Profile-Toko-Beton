<?php
require_once '../includes/init.php';
requireLogin();

$pageTitle = 'Dashboard';

// Get statistics
try {
    $totalKategori = $kategoriModel->getAll();
    $totalProduk = $produkModel->getAll();
    $produkAktif = $produkModel->getByStatus('aktif');
    $produkStokRendah = $db->query("SELECT COUNT(*) as count FROM produk WHERE stok <= 5 AND status = 'aktif'")->fetch();
    
    $stats = [
        'total_kategori' => count($totalKategori),
        'total_produk' => count($totalProduk),
        'produk_aktif' => count($produkAktif),
        'stok_rendah' => $produkStokRendah['count']
    ];
    
    // Get latest products
    $latestProduk = $produkModel->getLatest(5);
    
} catch (Exception $e) {
    $error = $e->getMessage();
}

include 'includes/header.php';
?>

<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="h3 mb-1">Dashboard</h2>
            <p class="text-muted mb-0">Selamat datang di dashboard admin Turen Indah Bangunan</p>
        </div>
        <div class="text-end">
            <small class="text-muted">Terakhir update: <?= date('d/m/Y H:i') ?></small>
        </div>
    </div>
</div>

<?php if (isset($error)): ?>
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-triangle"></i> Error: <?= $error ?>
    </div>
<?php endif; ?>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card primary">
            <div class="d-flex align-items-center">
                <div class="icon">
                    <i class="fas fa-tags"></i>
                </div>
                <div class="ms-3">
                    <div class="text-muted small">Total Kategori</div>
                    <div class="h4 mb-0"><?= $stats['total_kategori'] ?></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card success">
            <div class="d-flex align-items-center">
                <div class="icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="ms-3">
                    <div class="text-muted small">Total Produk</div>
                    <div class="h4 mb-0"><?= $stats['total_produk'] ?></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card warning">
            <div class="d-flex align-items-center">
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="ms-3">
                    <div class="text-muted small">Produk Aktif</div>
                    <div class="h4 mb-0"><?= $stats['produk_aktif'] ?></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card danger">
            <div class="d-flex align-items-center">
                <div class="icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="ms-3">
                    <div class="text-muted small">Stok Rendah</div>
                    <div class="h4 mb-0"><?= $stats['stok_rendah'] ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Latest Products -->
    <div class="col-lg-8 mb-4">
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Produk Terbaru</h5>
                <a href="produk.php" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Produk
                </a>
            </div>
            
            <?php if (!empty($latestProduk)): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($latestProduk as $produk): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <?php if ($produk['gambar_utama']): ?>
                                                <img src="<?= BASE_URL . PRODUK_IMG_PATH . $produk['gambar_utama'] ?>" 
                                                     alt="<?= htmlspecialchars($produk['nama_produk']) ?>"
                                                     class="rounded me-2" width="40" height="40" style="object-fit: cover;">
                                            <?php else: ?>
                                                <div class="bg-light rounded me-2 d-flex align-items-center justify-content-center" 
                                                     style="width: 40px; height: 40px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            <?php endif; ?>
                                            <div>
                                                <div class="fw-medium"><?= htmlspecialchars($produk['nama_produk']) ?></div>
                                                <small class="text-muted"><?= formatTanggal($produk['created_at']) ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info"><?= htmlspecialchars($produk['nama_kategori']) ?></span>
                                    </td>
                                    <td><?= formatRupiah($produk['harga']) ?></td>
                                    <td>
                                        <span class="badge <?= $produk['stok'] <= 5 ? 'bg-danger' : 'bg-success' ?>">
                                            <?= $produk['stok'] ?> <?= $produk['satuan'] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge <?= $produk['status'] == 'aktif' ? 'bg-success' : 'bg-secondary' ?>">
                                            <?= ucfirst($produk['status']) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-4">
                    <i class="fas fa-boxes fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Belum ada produk</p>
                    <a href="produk.php" class="btn btn-primary">Tambah Produk Pertama</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="col-lg-4 mb-4">
        <div class="form-container">
            <h5 class="mb-3">Quick Actions</h5>
            
            <div class="d-grid gap-2">
                <a href="kategori.php?action=add" class="btn btn-outline-primary">
                    <i class="fas fa-plus"></i> Tambah Kategori
                </a>
                <a href="produk.php?action=add" class="btn btn-outline-success">
                    <i class="fas fa-plus"></i> Tambah Produk
                </a>
                <a href="<?= BASE_URL ?>" class="btn btn-outline-info" target="_blank">
                    <i class="fas fa-external-link-alt"></i> Lihat Website
                </a>
            </div>
            
            <hr class="my-4">
            
            <h6 class="mb-3">Informasi Sistem</h6>
            <div class="small text-muted">
                <div class="d-flex justify-content-between mb-2">
                    <span>PHP Version:</span>
                    <span><?= PHP_VERSION ?></span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Database:</span>
                    <span>MySQL</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Last Login:</span>
                    <span><?= date('d/m/Y H:i') ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
