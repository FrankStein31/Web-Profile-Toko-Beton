<?php
require_once '../includes/init.php';
requireLogin();

$pageTitle = 'Kelola Konten About';
$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if ($action === 'add') {
            $data = [
                'section_name' => sanitizeInput($_POST['section_name']),
                'title' => sanitizeInput($_POST['title']),
                'subtitle' => sanitizeInput($_POST['subtitle']),
                'content' => $_POST['content'], // Rich content - don't over-sanitize
                'display_order' => (int)$_POST['display_order'],
                'status' => $_POST['status'] ?? 'aktif'
            ];
            
            // Check if section name already exists
            if ($aboutModel->sectionExists($data['section_name'])) {
                throw new Exception('Section name sudah digunakan. Gunakan nama yang berbeda.');
            }
            
            // Handle image upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $data['image'] = uploadImage($_FILES['image'], UPLOAD_PATH . 'about/');
            }
            
            $aboutModel->create($data);
            setFlashMessage('success', 'Konten About berhasil ditambahkan');
            redirect('about.php');
            
        } elseif ($action === 'edit' && $id) {
            $aboutContent = $aboutModel->getById($id);
            if (!$aboutContent) {
                throw new Exception('Konten tidak ditemukan');
            }
            
            $data = [
                'section_name' => sanitizeInput($_POST['section_name']),
                'title' => sanitizeInput($_POST['title']),
                'subtitle' => sanitizeInput($_POST['subtitle']),
                'content' => $_POST['content'],
                'display_order' => (int)$_POST['display_order'],
                'status' => $_POST['status'] ?? 'aktif',
                'image' => $aboutContent['image'] // Keep existing image
            ];
            
            // Check if section name already exists (exclude current)
            if ($aboutModel->sectionExists($data['section_name'], $id)) {
                throw new Exception('Section name sudah digunakan. Gunakan nama yang berbeda.');
            }
            
            // Handle new image upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                // Delete old image
                if ($aboutContent['image']) {
                    deleteFile(UPLOAD_PATH . 'about/' . $aboutContent['image']);
                }
                $data['image'] = uploadImage($_FILES['image'], UPLOAD_PATH . 'about/');
            }
            
            $aboutModel->update($id, $data);
            setFlashMessage('success', 'Konten About berhasil diupdate');
            redirect('about.php');
        }
    } catch (Exception $e) {
        setFlashMessage('error', $e->getMessage());
    }
}

// Handle delete
if ($action === 'delete' && $id) {
    try {
        $aboutContent = $aboutModel->getById($id);
        if ($aboutContent) {
            // Delete image file
            if ($aboutContent['image']) {
                deleteFile(UPLOAD_PATH . 'about/' . $aboutContent['image']);
            }
            $aboutModel->delete($id);
            setFlashMessage('success', 'Konten About berhasil dihapus');
        }
    } catch (Exception $e) {
        setFlashMessage('error', $e->getMessage());
    }
    redirect('about.php');
}

// Handle status toggle
if ($action === 'toggle_status' && $id) {
    try {
        $aboutContent = $aboutModel->getById($id);
        if ($aboutContent) {
            $newStatus = $aboutContent['status'] === 'aktif' ? 'nonaktif' : 'aktif';
            $aboutModel->updateStatus($id, $newStatus);
            setFlashMessage('success', 'Status konten berhasil diubah');
        }
    } catch (Exception $e) {
        setFlashMessage('error', $e->getMessage());
    }
    redirect('about.php');
}

// Get data for display
try {
    if ($action === 'list') {
        $aboutContents = $aboutModel->getAll();
        $stats = $aboutModel->getStats();
    } elseif ($action === 'edit' && $id) {
        $aboutContent = $aboutModel->getById($id);
        if (!$aboutContent) {
            setFlashMessage('error', 'Konten tidak ditemukan');
            redirect('about.php');
        }
    }
} catch (Exception $e) {
    $error = $e->getMessage();
}

include 'includes/header.php';
?>

<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="h3 mb-1">
                <?php if ($action === 'add'): ?>
                    Tambah Konten About
                <?php elseif ($action === 'edit'): ?>
                    Edit Konten About
                <?php else: ?>
                    Kelola Konten About
                <?php endif; ?>
            </h2>
            <p class="text-muted mb-0">Kelola konten halaman About perusahaan</p>
        </div>
        <?php if ($action === 'list'): ?>
            <a href="about.php?action=add" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Konten
            </a>
        <?php else: ?>
            <a href="about.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        <?php endif; ?>
    </div>
</div>

<?php displayFlashMessage(); ?>

<?php if (isset($error)): ?>
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-triangle"></i> Error: <?= $error ?>
    </div>
<?php endif; ?>

<?php if ($action === 'list'): ?>
    <!-- Statistics Cards -->
    <?php if (isset($stats)): ?>
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stats-card primary">
                    <div class="d-flex align-items-center">
                        <div class="icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="ms-3">
                            <div class="text-muted small">Total Konten</div>
                            <div class="h4 mb-0"><?= $stats['total'] ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card success">
                    <div class="d-flex align-items-center">
                        <div class="icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="ms-3">
                            <div class="text-muted small">Konten Aktif</div>
                            <div class="h4 mb-0"><?= $stats['aktif'] ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card warning">
                    <div class="d-flex align-items-center">
                        <div class="icon">
                            <i class="fas fa-eye-slash"></i>
                        </div>
                        <div class="ms-3">
                            <div class="text-muted small">Konten Nonaktif</div>
                            <div class="h4 mb-0"><?= $stats['nonaktif'] ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Content List -->
    <div class="table-container">
        <?php if (!empty($aboutContents)): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Section</th>
                            <th>Judul</th>
                            <th>Subtitle</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Terakhir Update</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($aboutContents as $content): ?>
                            <tr>
                                <td>
                                    <span class="badge bg-info"><?= htmlspecialchars($content['section_name']) ?></span>
                                </td>
                                <td>
                                    <div class="fw-medium"><?= htmlspecialchars($content['title']) ?></div>
                                </td>
                                <td class="text-muted">
                                    <?= htmlspecialchars(substr($content['subtitle'] ?? '', 0, 50)) ?>
                                    <?= strlen($content['subtitle'] ?? '') > 50 ? '...' : '' ?>
                                </td>
                                <td>
                                    <span class="badge bg-secondary"><?= $content['display_order'] ?></span>
                                </td>
                                <td>
                                    <span class="badge <?= $content['status'] === 'aktif' ? 'bg-success' : 'bg-secondary' ?>">
                                        <?= ucfirst($content['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted"><?= formatTanggal($content['updated_at']) ?></small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="about.php?action=edit&id=<?= $content['id'] ?>" 
                                           class="btn btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="about.php?action=toggle_status&id=<?= $content['id'] ?>" 
                                           class="btn btn-outline-warning" 
                                           title="Toggle Status"
                                           onclick="return confirm('Ubah status konten ini?')">
                                            <i class="fas fa-eye<?= $content['status'] === 'aktif' ? '-slash' : '' ?>"></i>
                                        </a>
                                        <a href="about.php?action=delete&id=<?= $content['id'] ?>" 
                                           class="btn btn-outline-danger" 
                                           title="Hapus"
                                           onclick="return confirm('Yakin ingin menghapus konten ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                <h5 class="text-muted mb-3">Belum ada konten About</h5>
                <p class="text-muted mb-4">Mulai dengan menambahkan konten untuk halaman About perusahaan.</p>
                <a href="about.php?action=add" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Konten Pertama
                </a>
            </div>
        <?php endif; ?>
    </div>

<?php elseif ($action === 'add' || $action === 'edit'): ?>
    <!-- Add/Edit Form -->
    <div class="form-container">
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="section_name" class="form-label">Section Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="section_name" name="section_name" 
                               value="<?= htmlspecialchars($aboutContent['section_name'] ?? '') ?>" required>
                        <div class="form-text">Nama unik untuk section (gunakan underscore untuk spasi)</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" 
                               value="<?= htmlspecialchars($aboutContent['title'] ?? '') ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="subtitle" class="form-label">Subtitle</label>
                        <input type="text" class="form-control" id="subtitle" name="subtitle" 
                               value="<?= htmlspecialchars($aboutContent['subtitle'] ?? '') ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="content" class="form-label">Konten <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="content" name="content" rows="10" required><?= htmlspecialchars($aboutContent['content'] ?? '') ?></textarea>
                        <div class="form-text">Gunakan HTML untuk formatting (h4, p, ul, li, div, dll.)</div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="display_order" class="form-label">Urutan Tampil</label>
                        <input type="number" class="form-control" id="display_order" name="display_order" 
                               value="<?= $aboutContent['display_order'] ?? 0 ?>" min="0">
                        <div class="form-text">Urutan tampil di halaman (0 = paling atas)</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="aktif" <?= ($aboutContent['status'] ?? 'aktif') === 'aktif' ? 'selected' : '' ?>>Aktif</option>
                            <option value="nonaktif" <?= ($aboutContent['status'] ?? '') === 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar (Opsional)</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        
                        <?php if (!empty($aboutContent['image'])): ?>
                            <div class="mt-2">
                                <img src="<?= BASE_URL ?>assets/img/uploads/about/<?= $aboutContent['image'] ?>" 
                                     alt="Current image" class="img-thumbnail" style="max-width: 200px;">
                                <div class="form-text">Gambar saat ini</div>
                            </div>
                        <?php endif; ?>
                        <div class="form-text">Format: JPG, PNG, GIF. Maksimal 5MB</div>
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="about.php" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> <?= $action === 'edit' ? 'Update' : 'Simpan' ?>
                </button>
            </div>
        </form>
    </div>
<?php endif; ?>

<script>
// Auto-generate section name from title
document.getElementById('title').addEventListener('input', function() {
    if (<?= $action === 'add' ? 'true' : 'false' ?>) {
        const title = this.value;
        const sectionName = title.toLowerCase()
            .replace(/[^a-z0-9\s]/g, '')
            .replace(/\s+/g, '_')
            .replace(/_+/g, '_')
            .replace(/^_|_$/g, '');
        document.getElementById('section_name').value = sectionName;
    }
});
</script>

<?php include 'includes/footer.php'; ?>