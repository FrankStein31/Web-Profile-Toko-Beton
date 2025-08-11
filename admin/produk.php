<?php
require_once '../includes/init.php';
requireLogin();

$pageTitle = 'Kelola Produk';
$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if ($action === 'add') {
            $data = [
                'id_kategori' => $_POST['id_kategori'],
                'nama_produk' => sanitizeInput($_POST['nama_produk']),
                'deskripsi' => sanitizeInput($_POST['deskripsi']),
                'deskripsi_tambahan' => sanitizeInput($_POST['deskripsi_tambahan']),
                'tags' => sanitizeInput($_POST['tags']),
                'harga' => str_replace(['.', ','], '', $_POST['harga']) ?: 0,
                'stok' => $_POST['stok'] ?: 0,
                'satuan' => sanitizeInput($_POST['satuan']),
                'status' => $_POST['status'] ?? 'aktif'
            ];
            
            // Handle main image upload
            if (isset($_FILES['gambar_utama']) && $_FILES['gambar_utama']['error'] === UPLOAD_ERR_OK) {
                $data['gambar_utama'] = uploadImage($_FILES['gambar_utama'], PRODUK_IMG_PATH);
            }
            
            $produkModel->create($data);
            setFlashMessage('success', 'Produk berhasil ditambahkan');
            redirect(ADMIN_URL . 'produk.php');
            
        } elseif ($action === 'edit' && $id) {
            $produk = $produkModel->getById($id);
            if (!$produk) {
                throw new Exception('Produk tidak ditemukan');
            }
            
            $data = [
                'id_kategori' => $_POST['id_kategori'],
                'nama_produk' => sanitizeInput($_POST['nama_produk']),
                'deskripsi' => sanitizeInput($_POST['deskripsi']),
                'deskripsi_tambahan' => sanitizeInput($_POST['deskripsi_tambahan']),
                'tags' => sanitizeInput($_POST['tags']),
                'harga' => str_replace(['.', ','], '', $_POST['harga']) ?: 0,
                'stok' => $_POST['stok'] ?: 0,
                'satuan' => sanitizeInput($_POST['satuan']),
                'status' => $_POST['status'] ?? 'aktif',
                'gambar_utama' => $produk['gambar_utama'], // Keep existing image
                'galeri_gambar' => $produk['galeri_gambar']
            ];
            
            // Handle new main image upload
            if (isset($_FILES['gambar_utama']) && $_FILES['gambar_utama']['error'] === UPLOAD_ERR_OK) {
                // Delete old image
                if ($produk['gambar_utama']) {
                    deleteFile(PRODUK_IMG_PATH . $produk['gambar_utama']);
                }
                $data['gambar_utama'] = uploadImage($_FILES['gambar_utama'], PRODUK_IMG_PATH);
            }
            
            $produkModel->update($id, $data);
            setFlashMessage('success', 'Produk berhasil diupdate');
            redirect(ADMIN_URL . 'produk.php');
        }
    } catch (Exception $e) {
        setFlashMessage('error', $e->getMessage());
    }
}

// Handle delete
if ($action === 'delete' && $id) {
    try {
        $produk = $produkModel->getById($id);
        if ($produk) {
            // Delete image files
            if ($produk['gambar_utama']) {
                deleteFile(PRODUK_IMG_PATH . $produk['gambar_utama']);
            }
            $produkModel->delete($id);
            setFlashMessage('success', 'Produk berhasil dihapus');
        }
    } catch (Exception $e) {
        setFlashMessage('error', $e->getMessage());
    }
    redirect(ADMIN_URL . 'produk.php');
}

// Handle status toggle
if ($action === 'toggle_status' && $id) {
    try {
        $produk = $produkModel->getById($id);
        if ($produk) {
            $newStatus = $produk['status'] === 'aktif' ? 'nonaktif' : 'aktif';
            $produkModel->updateStatus($id, $newStatus);
            setFlashMessage('success', 'Status produk berhasil diubah');
        }
    } catch (Exception $e) {
        setFlashMessage('error', $e->getMessage());
    }
    redirect(ADMIN_URL . 'produk.php');
}

// Get data for forms
$kategoris = $kategoriModel->getByStatus('aktif');

if ($action === 'edit' && $id) {
    $produk = $produkModel->getById($id);
    if (!$produk) {
        setFlashMessage('error', 'Produk tidak ditemukan');
        redirect(ADMIN_URL . 'produk.php');
    }
}

// Get all products for list
if ($action === 'list') {
    $produks = $produkModel->getAll();
}

include 'includes/header.php';
?>

<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="h3 mb-1">
                <?php if ($action === 'add'): ?>
                    Tambah Produk
                <?php elseif ($action === 'edit'): ?>
                    Edit Produk
                <?php else: ?>
                    Kelola Produk
                <?php endif; ?>
            </h2>
            <p class="text-muted mb-0">
                <?php if ($action === 'list'): ?>
                    Kelola produk beton dan bahan bangunan
                <?php else: ?>
                    <a href="produk.php" class="text-decoration-none">← Kembali ke daftar produk</a>
                <?php endif; ?>
            </p>
        </div>
        <?php if ($action === 'list'): ?>
            <a href="produk.php?action=add" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Produk
            </a>
        <?php endif; ?>
    </div>
</div>

<?php if ($action === 'list'): ?>
    <!-- List Products -->
    <div class="table-container">
        <?php if (!empty($produks)): ?>
            <div class="table-responsive">
                <table class="table table-hover data-table">
                    <thead class="table-light">
                        <tr>
                            <th width="80">ID</th>
                            <th width="100">Gambar</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th width="100">Status</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produks as $prod): ?>
                            <tr>
                                <td><?= $prod['id'] ?></td>
                                <td>
                                    <?php if ($prod['gambar_utama']): ?>
                                        <img src="<?= BASE_URL . PRODUK_IMG_PATH . $prod['gambar_utama'] ?>" 
                                             alt="<?= htmlspecialchars($prod['nama_produk']) ?>"
                                             class="rounded" width="60" height="60" style="object-fit: cover;">
                                    <?php else: ?>
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                             style="width: 60px; height: 60px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="fw-medium"><?= htmlspecialchars($prod['nama_produk']) ?></div>
                                    <small class="text-muted">
                                        <?= htmlspecialchars(substr($prod['deskripsi'], 0, 50)) ?>
                                        <?= strlen($prod['deskripsi']) > 50 ? '...' : '' ?>
                                    </small>
                                </td>
                                <td>
                                    <span class="badge bg-info"><?= htmlspecialchars($prod['nama_kategori']) ?></span>
                                </td>
                                <td><?= formatRupiah($prod['harga']) ?></td>
                                <td>
                                    <span class="badge <?= $prod['stok'] <= 5 ? 'bg-danger' : ($prod['stok'] <= 10 ? 'bg-warning' : 'bg-success') ?>">
                                        <?= $prod['stok'] ?> <?= $prod['satuan'] ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge <?= $prod['status'] === 'aktif' ? 'bg-success' : 'bg-secondary' ?>">
                                        <?= ucfirst($prod['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="produk.php?action=edit&id=<?= $prod['id'] ?>" 
                                           class="btn btn-warning btn-action" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="produk.php?action=toggle_status&id=<?= $prod['id'] ?>" 
                                           class="btn btn-info btn-action" 
                                           title="<?= $prod['status'] === 'aktif' ? 'Nonaktifkan' : 'Aktifkan' ?>">
                                            <i class="fas fa-<?= $prod['status'] === 'aktif' ? 'eye-slash' : 'eye' ?>"></i>
                                        </a>
                                        <button class="btn btn-danger btn-action" 
                                                onclick="confirmDelete('produk.php?action=delete&id=<?= $prod['id'] ?>', '<?= htmlspecialchars($prod['nama_produk']) ?>')"
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="fas fa-boxes fa-3x text-muted mb-3"></i>
                <h5>Belum Ada Produk</h5>
                <p class="text-muted">Tambah produk pertama untuk memulai</p>
                <a href="produk.php?action=add" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Produk Pertama
                </a>
            </div>
        <?php endif; ?>
    </div>

<?php else: ?>
    <!-- Add/Edit Form -->
    <div class="form-container">
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="nama_produk" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_produk" name="nama_produk" 
                                       value="<?= htmlspecialchars($produk['nama_produk'] ?? '') ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="id_kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select class="form-select" id="id_kategori" name="id_kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($kategoris as $kat): ?>
                                        <option value="<?= $kat['id'] ?>" 
                                                <?= ($produk['id_kategori'] ?? '') == $kat['id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($kat['nama_kategori']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" 
                                  placeholder="Deskripsi produk..."><?= htmlspecialchars($produk['deskripsi'] ?? '') ?></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="deskripsi_tambahan" class="form-label">Deskripsi Tambahan</label>
                        <textarea class="form-control" id="deskripsi_tambahan" name="deskripsi_tambahan" rows="3" 
                                  placeholder="Informasi detail produk..."><?= htmlspecialchars($produk['deskripsi_tambahan'] ?? '') ?></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="text" class="form-control" id="harga" name="harga" 
                                       value="<?= isset($produk['harga']) ? number_format($produk['harga'], 0, ',', '.') : '' ?>"
                                       placeholder="0" oninput="formatRupiah(this)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="stok" class="form-label">Stok</label>
                                <input type="number" class="form-control" id="stok" name="stok" 
                                       value="<?= $produk['stok'] ?? '' ?>" min="0">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="satuan" class="form-label">Satuan</label>
                                <select class="form-select" id="satuan" name="satuan">
                                    <option value="pcs" <?= ($produk['satuan'] ?? 'pcs') === 'pcs' ? 'selected' : '' ?>>Pcs</option>
                                    <option value="m3" <?= ($produk['satuan'] ?? '') === 'm3' ? 'selected' : '' ?>>M³</option>
                                    <option value="m2" <?= ($produk['satuan'] ?? '') === 'm2' ? 'selected' : '' ?>>M²</option>
                                    <option value="kg" <?= ($produk['satuan'] ?? '') === 'kg' ? 'selected' : '' ?>>Kg</option>
                                    <option value="sak" <?= ($produk['satuan'] ?? '') === 'sak' ? 'selected' : '' ?>>Sak</option>
                                    <option value="unit" <?= ($produk['satuan'] ?? '') === 'unit' ? 'selected' : '' ?>>Unit</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="tags" class="form-label">Tags</label>
                        <input type="text" class="form-control" id="tags" name="tags" 
                               value="<?= htmlspecialchars($produk['tags'] ?? '') ?>"
                               placeholder="beton, ready mix, konstruksi (pisahkan dengan koma)">
                        <small class="form-text text-muted">Pisahkan tags dengan koma untuk pencarian yang lebih baik</small>
                    </div>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="aktif" <?= ($produk['status'] ?? 'aktif') === 'aktif' ? 'selected' : '' ?>>Aktif</option>
                            <option value="nonaktif" <?= ($produk['status'] ?? '') === 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="gambar_utama" class="form-label">Gambar Utama</label>
                        <input type="file" class="form-control" id="gambar_utama" name="gambar_utama" 
                               accept="image/*" onchange="previewImage(this)">
                        <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 5MB</small>
                    </div>
                    
                    <div class="image-preview" <?= !isset($produk['gambar_utama']) ? 'style="display: none;"' : '' ?>>
                        <img src="<?= isset($produk['gambar_utama']) ? BASE_URL . PRODUK_IMG_PATH . $produk['gambar_utama'] : '#' ?>" 
                             alt="Preview" class="img-fluid rounded border" style="max-height: 200px;">
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> 
                            <?= $action === 'add' ? 'Tambah' : 'Update' ?> Produk
                        </button>
                        <a href="produk.php" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
