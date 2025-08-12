<?php
require_once '../includes/init.php';
requireLogin();

$pageTitle = 'Kelola Berita';
$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $data = [
            'judul' => sanitizeInput($_POST['judul']),
            'deskripsi' => sanitizeInput($_POST['deskripsi']),
            'konten' => $_POST['konten'],
            'tags' => sanitizeInput($_POST['tags']),
            'link_website' => sanitizeInput($_POST['link_website']),
            'status' => $_POST['status'],
            'tanggal_publikasi' => $_POST['tanggal_publikasi']
        ];
        
        // Generate slug
        if ($action === 'add') {
            $data['slug'] = $beritaModel->generateSlug($data['judul']);
        } else {
            $data['slug'] = $beritaModel->generateSlug($data['judul'], $id);
        }
        
        // Handle image upload
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $data['gambar'] = uploadImage($_FILES['gambar'], BERITA_IMG_PATH);
            if (!$data['gambar']) {
                throw new Exception('Gagal upload gambar');
            }
        } else {
            if ($action === 'edit') {
                $existing = $beritaModel->getById($id);
                $data['gambar'] = $existing['gambar'];
            } else {
                $data['gambar'] = null;
            }
        }
        
        if ($action === 'add') {
            if ($beritaModel->create($data)) {
                setFlashMessage('success', "Berita berhasil ditambahkan!");
                redirect('berita.php');
            } else {
                throw new Exception('Gagal menambahkan berita');
            }
        } elseif ($action === 'edit') {
            // Delete old image if new one uploaded
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
                $existing = $beritaModel->getById($id);
                if ($existing['gambar']) {
                    deleteFile(BERITA_IMG_PATH . $existing['gambar']);
                }
            }
            
            if ($beritaModel->update($id, $data)) {
                setFlashMessage('success', "Berita berhasil diperbarui!");
                redirect('berita.php');
            } else {
                throw new Exception('Gagal memperbarui berita');
            }
        }
        
    } catch (Exception $e) {
        setFlashMessage('error', $e->getMessage());
    }
}

// Handle delete
if ($action === 'delete' && $id) {
    try {
        $berita = $beritaModel->getById($id);
        if ($berita) {
            // Delete image file
            if ($berita['gambar']) {
                deleteFile(BERITA_IMG_PATH . $berita['gambar']);
            }
            
            if ($beritaModel->delete($id)) {
                setFlashMessage('success', "Berita berhasil dihapus!");
            } else {
                throw new Exception('Gagal menghapus berita');
            }
        }
        redirect('berita.php');
    } catch (Exception $e) {
        setFlashMessage('error', $e->getMessage());
        redirect('berita.php');
    }
}

// Get data for edit form
if ($action === 'edit' && $id) {
    $berita = $beritaModel->getById($id);
    if (!$berita) {
        setFlashMessage('error', "Berita tidak ditemukan");
        redirect('berita.php');
    }
}

// Get all berita for listing
if ($action === 'list') {
    $allBerita = $beritaModel->getAll();
}

include 'includes/header.php';
?>
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="h3 mb-1">Kelola Berita</h2>
            <p class="text-muted mb-0">Kelola dan publikasikan berita website</p>
        </div>
        <?php if ($action === 'list'): ?>
            <a href="?action=add" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Berita
            </a>
        <?php endif; ?>
    </div>
</div>

<?php if ($action === 'list'): ?>
    <!-- Berita List -->
    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Daftar Berita</h5>
        </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Gambar</th>
                                            <th>Judul</th>
                                            <th>Deskripsi</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($allBerita)): ?>
                                            <tr>
                                                <td colspan="7" class="text-center">Tidak ada berita</td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($allBerita as $news): ?>
                                                <tr>
                                                    <td><?= $news['id'] ?></td>
                                                    <td>
                                                        <?php if ($news['gambar']): ?>
                                                            <img src="<?= BERITA_IMG_URL . $news['gambar'] ?>" 
                                                                 alt="<?= htmlspecialchars($news['judul']) ?>"
                                                                 style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                                                        <?php else: ?>
                                                            <div class="bg-light d-flex align-items-center justify-content-center" 
                                                                 style="width: 60px; height: 60px; border-radius: 5px;">
                                                                <i class="fas fa-image text-muted"></i>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <strong><?= htmlspecialchars($news['judul']) ?></strong>
                                                        <br><small class="text-muted"><?= htmlspecialchars($news['slug']) ?></small>
                                                    </td>
                                                    <td><?= htmlspecialchars(substr($news['deskripsi'], 0, 100)) ?><?= strlen($news['deskripsi']) > 100 ? '...' : '' ?></td>
                                                    <td>
                                                        <span class="badge <?= $news['status'] === 'aktif' ? 'bg-success' : 'bg-secondary' ?>">
                                                            <?= ucfirst($news['status']) ?>
                                                        </span>
                                                    </td>
                                                    <td><?= $news['tanggal_format'] ?></td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm">
                                                            <a href="?action=edit&id=<?= $news['id'] ?>" 
                                                               class="btn btn-warning" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="?action=delete&id=<?= $news['id'] ?>" 
                                                               class="btn btn-danger" title="Hapus"
                                                               onclick="return confirm('Yakin ingin menghapus berita ini?')">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                            <a href="<?= BASE_URL ?>single-news.php?slug=<?= $news['slug'] ?>" 
                                                               class="btn btn-info" title="Lihat" target="_blank">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                    </div>

<?php elseif ($action === 'add' || $action === 'edit'): ?>
    <!-- Create/Edit Form -->
    <div class="form-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">
                <?= $action === 'add' ? 'Tambah' : 'Edit' ?> Berita
            </h5>
        </div>
                            <form method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label class="form-label">Judul Berita *</label>
                                            <input type="text" name="judul" class="form-control" 
                                                   value="<?= htmlspecialchars($berita['judul'] ?? '') ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Deskripsi Singkat *</label>
                                            <textarea name="deskripsi" class="form-control" rows="3" required><?= htmlspecialchars($berita['deskripsi'] ?? '') ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Konten Berita *</label>
                                            <textarea name="konten" id="konten" class="form-control" rows="10"><?= $berita['konten'] ?? '' ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Tags</label>
                                            <input type="text" name="tags" class="form-control" 
                                                   value="<?= htmlspecialchars($berita['tags'] ?? '') ?>"
                                                   placeholder="Pisahkan dengan koma (contoh: beton, konstruksi, tips)">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Link Website Eksternal</label>
                                            <input type="url" name="link_website" class="form-control" 
                                                   value="<?= htmlspecialchars($berita['link_website'] ?? '') ?>"
                                                   placeholder="https://example.com">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Gambar Berita</label>
                                            <input type="file" name="gambar" class="form-control" accept="image/*">
                                            <?php if (isset($berita['gambar']) && $berita['gambar']): ?>
                                                <div class="mt-2">
                                                    <img src="<?= BERITA_IMG_URL . $berita['gambar'] ?>" 
                                                         alt="Current image" class="img-thumbnail" style="max-width: 200px;">
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Status *</label>
                                            <select name="status" class="form-control" required>
                                                <option value="aktif" <?= ($berita['status'] ?? '') === 'aktif' ? 'selected' : '' ?>>Aktif</option>
                                                <option value="nonaktif" <?= ($berita['status'] ?? '') === 'nonaktif' ? 'selected' : '' ?>>Non-aktif</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Tanggal Publikasi *</label>
                                            <input type="datetime-local" name="tanggal_publikasi" class="form-control" 
                                                   value="<?= isset($berita['tanggal_publikasi']) ? date('Y-m-d\TH:i', strtotime($berita['tanggal_publikasi'])) : date('Y-m-d\TH:i') ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> 
                                        <?= $action === 'add' ? 'Simpan' : 'Update' ?>
                                    </button>
                                    <a href="?action=list" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                </div>
                            </form>
                    </div>
                <?php endif; ?>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    // Initialize CKEditor
    CKEDITOR.replace('konten', {
            height: 300,
            toolbar: [
                { name: 'document', items: ['Source'] },
                { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
                { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll'] },
                '/',
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
                { name: 'links', items: ['Link', 'Unlink', 'Anchor'] },
                { name: 'insert', items: ['Image', 'Table', 'HorizontalRule'] },
                '/',
                { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
                { name: 'colors', items: ['TextColor', 'BGColor'] }
            ]
        });
    </script>

<?php include 'includes/footer.php'; ?>
