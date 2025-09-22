<?php
require_once '../includes/init.php';
requireLogin();

$pageTitle = 'Kelola Konten Footer';
$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if ($action === 'edit' && $id) {
            $footerContent = $footerModel->getById($id);
            if (!$footerContent) {
                throw new Exception('Konten tidak ditemukan');
            }
            
            $data = [
                'section_name' => sanitizeInput($_POST['section_name']),
                'title' => sanitizeInput($_POST['title']),
                'content' => $_POST['content'] ?? null,
                'display_order' => (int)$_POST['display_order'],
                'status' => $_POST['status'] ?? 'aktif'
            ];
            
            // Handle links for sections that need them
            if (in_array($data['section_name'], ['get_in_touch', 'pages', 'social_media'])) {
                $links = [];
                if (isset($_POST['links']) && is_array($_POST['links'])) {
                    foreach ($_POST['links'] as $link) {
                        if (!empty($link['text']) || !empty($link['url'])) {
                            $linkData = [
                                'text' => sanitizeInput($link['text'] ?? ''),
                                'url' => sanitizeInput($link['url'] ?? '')
                            ];
                            if (!empty($link['type'])) {
                                $linkData['type'] = sanitizeInput($link['type']);
                            }
                            $links[] = $linkData;
                        }
                    }
                }
                $data['links'] = $footerModel->encodeLinks($links);
            }
            
            // Check if section name already exists (excluding current record)
            if ($footerModel->sectionExists($data['section_name'], $id)) {
                throw new Exception('Section name sudah digunakan. Gunakan nama yang berbeda.');
            }
            
            $footerModel->update($id, $data);
            setFlashMessage('success', 'Konten Footer berhasil diperbarui');
            redirect('footer.php');
            
        } elseif ($action === 'toggle_status' && $id) {
            $footerContent = $footerModel->getById($id);
            if (!$footerContent) {
                throw new Exception('Konten tidak ditemukan');
            }
            
            $newStatus = $footerContent['status'] === 'aktif' ? 'nonaktif' : 'aktif';
            $footerModel->updateStatus($id, $newStatus);
            
            setFlashMessage('success', 'Status berhasil diubah');
            redirect('footer.php');
        }
        
    } catch (Exception $e) {
        setFlashMessage('error', $e->getMessage());
    }
}





// Get data for forms
if ($action === 'edit' && $id) {
    $footerContent = $footerModel->getById($id);
    if (!$footerContent) {
        setFlashMessage('error', 'Konten tidak ditemukan');
        redirect('footer.php');
    }
}

// Get all footer content for list
$footerContents = $footerModel->getAll();
$stats = $footerModel->getStats();

include 'includes/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0"><?= $pageTitle ?></h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Footer</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <?php if ($action === 'list'): ?>
        <!-- List View -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-8">
                                <h5 class="card-title mb-0">Kelola Konten Footer</h5>
                                <p class="text-muted mb-0">Edit konten untuk setiap section footer</p>
                            </div>
                            <div class="col-sm-4 text-end">
                                <div class="d-flex gap-2 align-items-center justify-content-end">
                                    <div class="text-muted">
                                        <small><i class="fas fa-info-circle me-1"></i> Klik Edit untuk mengubah konten</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Stats -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="stats-card primary">
                                    <div class="d-flex align-items-center">
                                        <div class="icon">
                                            <i class="fas fa-th-large"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h4 class="mb-0 fw-bold"><?= $stats['total'] ?></h4>
                                            <p class="text-muted mb-0 small">Total Sections</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stats-card success">
                                    <div class="d-flex align-items-center">
                                        <div class="icon">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h4 class="mb-0 fw-bold"><?= $stats['aktif'] ?></h4>
                                            <p class="text-muted mb-0 small">Aktif</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stats-card warning">
                                    <div class="d-flex align-items-center">
                                        <div class="icon">
                                            <i class="fas fa-pause-circle"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h4 class="mb-0 fw-bold"><?= $stats['nonaktif'] ?></h4>
                                            <p class="text-muted mb-0 small">Non-Aktif</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Content Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="15%">Section</th>
                                        <th width="20%">Title</th>
                                        <th width="30%">Content/Links</th>
                                        <th width="10%">Order</th>
                                        <th width="10%">Status</th>
                                        <th width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($footerContents)): ?>
                                        <tr>
                                            <td colspan="7" class="text-center">Belum ada konten footer</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($footerContents as $index => $content): ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td>
                                                    <span class="badge bg-info"><?= ucfirst(str_replace('_', ' ', $content['section_name'])) ?></span>
                                                </td>
                                                <td><?= htmlspecialchars($content['title']) ?></td>
                                                <td>
                                                    <?php if ($content['content']): ?>
                                                        <div class="text-truncate" style="max-width: 200px;" title="<?= htmlspecialchars($content['content']) ?>">
                                                            <?= htmlspecialchars(substr($content['content'], 0, 100)) ?><?= strlen($content['content']) > 100 ? '...' : '' ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if ($content['links']): ?>
                                                        <?php $links = $footerModel->parseLinks($content['links']); ?>
                                                        <div class="mt-1">
                                                            <small class="text-muted"><?= count($links) ?> link(s)</small>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary"><?= $content['display_order'] ?></span>
                                                </td>
                                                <td>
                                                    <a href="footer.php?action=toggle_status&id=<?= $content['id'] ?>" 
                                                       class="badge bg-<?= $content['status'] === 'aktif' ? 'success' : 'warning' ?> text-decoration-none"
                                                       onclick="return confirm('Yakin ingin mengubah status?')">
                                                        <?= ucfirst($content['status']) ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <a href="footer.php?action=edit&id=<?= $content['id'] ?>" 
                                                           class="btn btn-sm btn-outline-primary" title="Edit">
                                                            <i class="fas fa-edit"></i>
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
                </div>
            </div>
        </div>

    <?php elseif ($action === 'edit'): ?>
        <?php
        // Get footer content for editing
        if (!$id) {
            setFlashMessage('error', 'ID tidak ditemukan');
            redirect('footer.php');
        }
        
        $footerContent = $footerModel->getById($id);
        if (!$footerContent) {
            setFlashMessage('error', 'Konten Footer tidak ditemukan');
            redirect('footer.php');
        }
        ?>
        <!-- Edit Form -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-8">
                                <h5 class="card-title mb-0">Edit Konten Footer - <?= ucwords(str_replace('_', ' ', $footerContent['section_name'])) ?></h5>
                                <p class="text-muted mb-0">Edit konten untuk section footer yang sudah ada</p>
                            </div>
                            <div class="col-sm-4 text-end">
                                <a href="footer.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>
                            </div>
                        </div>

                        <form method="POST" class="needs-validation" novalidate>
                            <input type="hidden" name="section_name" value="<?= $footerContent['section_name'] ?>">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Section Name</label>
                                        <input type="text" class="form-control" readonly 
                                               value="<?= ucwords(str_replace('_', ' ', $footerContent['section_name'])) ?>">
                                        <div class="form-text">Section name tidak dapat diubah</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title" name="title" 
                                               value="<?= htmlspecialchars($footerContent['title']) ?>" 
                                               required maxlength="255">
                                        <div class="invalid-feedback">
                                            Judul harus diisi.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Content Field (for sections that need text content) -->
                            <div class="mb-3" id="content_field">
                                <label for="content" class="form-label">Konten</label>
                                <textarea class="form-control" id="content" name="content" rows="4" 
                                          placeholder="Masukkan konten untuk section ini..."><?= $action === 'edit' ? htmlspecialchars($footerContent['content'] ?? '') : '' ?></textarea>
                                <div class="form-text">Konten teks untuk section ini (opsional untuk beberapa section).</div>
                            </div>

                            <!-- Links Field (for sections that need links) -->
                            <div class="mb-3" id="links_field" style="display: none;">
                                <label class="form-label">Links</label>
                                <div id="links_container">
                                    <?php if ($action === 'edit' && $footerContent['links']): ?>
                                        <?php $links = $footerModel->parseLinks($footerContent['links']); ?>
                                        <?php foreach ($links as $index => $link): ?>
                                            <div class="link_item mb-2 p-3 border rounded">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control" name="links[<?= $index ?>][type]" 
                                                               placeholder="Type (optional)" value="<?= htmlspecialchars($link['type'] ?? '') ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="links[<?= $index ?>][text]" 
                                                               placeholder="Text" value="<?= htmlspecialchars($link['text'] ?? '') ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="url" class="form-control" name="links[<?= $index ?>][url]" 
                                                               placeholder="URL" value="<?= htmlspecialchars($link['url'] ?? '') ?>">
                                                    </div>
                                                    <div class="col-md-1">
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="removeLink(this)">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addLink()">
                                    <i class="fas fa-plus me-1"></i> Tambah Link
                                </button>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="display_order" class="form-label">Urutan Tampil</label>
                                        <input type="number" class="form-control" id="display_order" name="display_order" 
                                               value="<?= $action === 'edit' ? $footerContent['display_order'] : '0' ?>" 
                                               min="0" max="999">
                                        <div class="form-text">Angka yang lebih kecil akan ditampilkan lebih dulu.</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" id="status" name="status">
                                            <option value="aktif" <?= ($action === 'edit' && $footerContent['status'] === 'aktif') ? 'selected' : '' ?>>Aktif</option>
                                            <option value="nonaktif" <?= ($action === 'edit' && $footerContent['status'] === 'nonaktif') ? 'selected' : '' ?>>Non-Aktif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> <?= $action === 'add' ? 'Tambah' : 'Update' ?> Footer
                                </button>
                                <a href="footer.php" class="btn btn-secondary ms-2">
                                    <i class="fas fa-times me-1"></i> Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
let linkIndex = <?= ($action === 'edit' && $footerContent['links']) ? count($footerModel->parseLinks($footerContent['links'])) : 0 ?>;

function toggleFields() {
    // Get section name from hidden input
    const sectionNameInput = document.querySelector('input[name="section_name"]');
    if (!sectionNameInput) return;
    
    const sectionName = sectionNameInput.value;
    const contentField = document.getElementById('content_field');
    const linksField = document.getElementById('links_field');
    
    // Sections that need content
    const contentSections = ['about_us', 'subscribe', 'copyright'];
    // Sections that need links
    const linkSections = ['get_in_touch', 'pages', 'social_media'];
    
    if (contentSections.includes(sectionName)) {
        contentField.style.display = 'block';
        linksField.style.display = 'none';
    } else if (linkSections.includes(sectionName)) {
        contentField.style.display = 'none';
        linksField.style.display = 'block';
    } else {
        contentField.style.display = 'block';
        linksField.style.display = 'none';
    }
}

function addLink() {
    const container = document.getElementById('links_container');
    const linkItem = document.createElement('div');
    linkItem.className = 'link_item mb-2 p-3 border rounded';
    linkItem.innerHTML = `
        <div class="row">
            <div class="col-md-3">
                <input type="text" class="form-control" name="links[${linkIndex}][type]" placeholder="Type (optional)">
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="links[${linkIndex}][text]" placeholder="Text">
            </div>
            <div class="col-md-4">
                <input type="url" class="form-control" name="links[${linkIndex}][url]" placeholder="URL">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger btn-sm" onclick="removeLink(this)">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    `;
    container.appendChild(linkItem);
    linkIndex++;
}

function removeLink(button) {
    button.closest('.link_item').remove();
}

// Initialize field visibility on page load
document.addEventListener('DOMContentLoaded', function() {
    toggleFields();
    
    // Bootstrap form validation
    const forms = document.querySelectorAll('.needs-validation');
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
});
</script>

<?php include 'includes/footer.php'; ?>