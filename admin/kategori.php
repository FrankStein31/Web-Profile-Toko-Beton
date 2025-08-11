<?php
require_once '../includes/init.php';
requireLogin();

$pageTitle = 'Kelola Kategori';
$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if ($action === 'add') {
            $data = [
                'nama_kategori' => sanitizeInput($_POST['nama_kategori']),
                'deskripsi' => sanitizeInput($_POST['deskripsi']),
                'status' => $_POST['status'] ?? 'aktif'
            ];
            
            // Handle image upload
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
                $data['gambar'] = uploadImage($_FILES['gambar'], KATEGORI_IMG_PATH);
            }
            
            $kategoriModel->create($data);
            setFlashMessage('success', 'Kategori berhasil ditambahkan');
            redirect(ADMIN_URL . 'kategori.php');
            
        } elseif ($action === 'edit' && $id) {
            $kategori = $kategoriModel->getById($id);
            if (!$kategori) {
                throw new Exception('Kategori tidak ditemukan');
            }
            
            $data = [
                'nama_kategori' => sanitizeInput($_POST['nama_kategori']),
                'deskripsi' => sanitizeInput($_POST['deskripsi']),
                'status' => $_POST['status'] ?? 'aktif',
                'gambar' => $kategori['gambar'] // Keep existing image
            ];
            
            // Handle new image upload
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
                // Delete old image
                if ($kategori['gambar']) {
                    deleteFile(KATEGORI_IMG_PATH . $kategori['gambar']);
                }
                $data['gambar'] = uploadImage($_FILES['gambar'], KATEGORI_IMG_PATH);
            }
            
            $kategoriModel->update($id, $data);
            setFlashMessage('success', 'Kategori berhasil diupdate');
            redirect(ADMIN_URL . 'kategori.php');
        }
    } catch (Exception $e) {
        setFlashMessage('error', $e->getMessage());
    }
}

// Handle delete
if ($action === 'delete' && $id) {
    try {
        $kategori = $kategoriModel->getById($id);
        if ($kategori) {
            // Delete image file
            if ($kategori['gambar']) {
                deleteFile(KATEGORI_IMG_PATH . $kategori['gambar']);
            }
            $kategoriModel->delete($id);
            setFlashMessage('success', 'Kategori berhasil dihapus');
        }
    } catch (Exception $e) {
        setFlashMessage('error', $e->getMessage());
    }
    redirect(ADMIN_URL . 'kategori.php');
}

// Handle status toggle
if ($action === 'toggle_status' && $id) {
    try {
        $kategori = $kategoriModel->getById($id);
        if ($kategori) {
            $newStatus = $kategori['status'] === 'aktif' ? 'nonaktif' : 'aktif';
            $kategoriModel->updateStatus($id, $newStatus);
            setFlashMessage('success', 'Status kategori berhasil diubah');
        }
    } catch (Exception $e) {
        setFlashMessage('error', $e->getMessage());
    }
    redirect(ADMIN_URL . 'kategori.php');
}

// Get data for forms
if ($action === 'edit' && $id) {
    $kategori = $kategoriModel->getById($id);
    if (!$kategori) {
        setFlashMessage('error', 'Kategori tidak ditemukan');
        redirect(ADMIN_URL . 'kategori.php');
    }
}

// Get all categories for list
if ($action === 'list') {
    $kategoris = $kategoriModel->getAll();
}

include 'includes/header.php';
?>

<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="h3 mb-1">
                <?php if ($action === 'add'): ?>
                    Tambah Kategori
                <?php elseif ($action === 'edit'): ?>
                    Edit Kategori
                <?php else: ?>
                    Kelola Kategori
                <?php endif; ?>
            </h2>
            <p class="text-muted mb-0">
                <?php if ($action === 'list'): ?>
                    Kelola kategori produk beton
                <?php else: ?>
                    <a href="kategori.php" class="text-decoration-none">← Kembali ke daftar kategori</a>
                <?php endif; ?>
            </p>
        </div>
        <?php if ($action === 'list'): ?>
            <a href="kategori.php?action=add" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Kategori
            </a>
        <?php endif; ?>
    </div>
</div>

<?php if ($action === 'list'): ?>
    <!-- List Categories -->
    <div class="table-container">
        <?php if (!empty($kategoris)): ?>
            <div class="table-responsive">
                <table class="table table-hover data-table">
                    <thead class="table-light">
                        <tr>
                            <th width="80">ID</th>
                            <th width="100">Gambar</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th width="120">Jumlah Produk</th>
                            <th width="100">Status</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($kategoris as $kat): ?>
                            <tr>
                                <td><?= $kat['id'] ?></td>
                                <td>
                                    <?php if ($kat['gambar']): ?>
                                        <img src="<?= BASE_URL . KATEGORI_IMG_PATH . $kat['gambar'] ?>" 
                                             alt="<?= htmlspecialchars($kat['nama_kategori']) ?>"
                                             class="rounded" width="60" height="60" style="object-fit: cover;">
                                    <?php else: ?>
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                             style="width: 60px; height: 60px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="fw-medium"><?= htmlspecialchars($kat['nama_kategori']) ?></div>
                                    <small class="text-muted">Dibuat: <?= formatTanggal($kat['created_at']) ?></small>
                                </td>
                                <td>
                                    <?php if ($kat['deskripsi']): ?>
                                        <?= htmlspecialchars(substr($kat['deskripsi'], 0, 100)) ?>
                                        <?= strlen($kat['deskripsi']) > 100 ? '...' : '' ?>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge bg-info">
                                        <?= $kategoriModel->getProductCount($kat['id']) ?> produk
                                    </span>
                                </td>
                                <td>
                                    <span class="badge <?= $kat['status'] === 'aktif' ? 'bg-success' : 'bg-secondary' ?>">
                                        <?= ucfirst($kat['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="kategori.php?action=edit&id=<?= $kat['id'] ?>" 
                                           class="btn btn-warning btn-action" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="kategori.php?action=toggle_status&id=<?= $kat['id'] ?>" 
                                           class="btn btn-info btn-action" 
                                           title="<?= $kat['status'] === 'aktif' ? 'Nonaktifkan' : 'Aktifkan' ?>">
                                            <i class="fas fa-<?= $kat['status'] === 'aktif' ? 'eye-slash' : 'eye' ?>"></i>
                                        </a>
                                        <button class="btn btn-danger btn-action" 
                                                onclick="confirmDelete('kategori.php?action=delete&id=<?= $kat['id'] ?>', '<?= htmlspecialchars($kat['nama_kategori']) ?>')"
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
                <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                <h5>Belum Ada Kategori</h5>
                <p class="text-muted">Tambah kategori pertama untuk memulai</p>
                <a href="kategori.php?action=add" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Kategori Pertama
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
                    <div class="mb-3">
                        <label for="nama_kategori" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" 
                               value="<?= htmlspecialchars($kategori['nama_kategori'] ?? '') ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" 
                                  placeholder="Deskripsi kategori..."><?= htmlspecialchars($kategori['deskripsi'] ?? '') ?></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="aktif" <?= ($kategori['status'] ?? 'aktif') === 'aktif' ? 'selected' : '' ?>>Aktif</option>
                            <option value="nonaktif" <?= ($kategori['status'] ?? '') === 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar Kategori</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" 
                               accept="image/*" onchange="previewImage(this)">
                        <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 5MB</small>
                    </div>
                    
                    <div class="image-preview" <?= !isset($kategori['gambar']) ? 'style="display: none;"' : '' ?>>
                        <img src="<?= isset($kategori['gambar']) ? BASE_URL . KATEGORI_IMG_PATH . $kategori['gambar'] : '#' ?>" 
                             alt="Preview" class="img-fluid rounded border" style="max-height: 200px;">
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> 
                            <?= $action === 'add' ? 'Tambah' : 'Update' ?> Kategori
                        </button>
                        <a href="kategori.php" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
