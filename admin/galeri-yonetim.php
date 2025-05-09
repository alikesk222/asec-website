<?php
// Galeri Yönetim Paneli - Ekle, Sil, Düzenle
require_once '../db.php';
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$msg = '';
// Silme işlemi
if(isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $pdo->prepare("DELETE FROM galeri WHERE id = ?");
    $stmt->execute([$id]);
    $msg = 'Fotoğraf silindi!';
}
// Ekleme işlemi
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ekle'])) {
    $baslik = $_POST['baslik'];
    $aciklama = $_POST['aciklama'];
    $kategori = $_POST['kategori'];
    $tarih = $_POST['tarih'];
    $dosya_yolu = '';
    if(isset($_FILES['dosya']) && $_FILES['dosya']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['dosya']['name'], PATHINFO_EXTENSION);
        $newName = uniqid('galeri_', true).'.'.$ext;
        $targetDir = '../images/gallery/';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $target = $targetDir . $newName;
        if(move_uploaded_file($_FILES['dosya']['tmp_name'], $target)) {
            $dosya_yolu = 'images/gallery/'.$newName;
        }
    }
    if($dosya_yolu) {
        $stmt = $pdo->prepare("INSERT INTO galeri (baslik, aciklama, kategori, tarih, dosya_yolu) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$baslik, $aciklama, $kategori, $tarih, $dosya_yolu]);
        $msg = 'Fotoğraf eklendi!';
    } else {
        $msg = 'Fotoğraf yüklenemedi!';
    }
}
// Listele
$galeri = $pdo->query("SELECT * FROM galeri ORDER BY tarih DESC")->fetchAll();
?>
<?php include 'admin-header.php'; ?>
<?php include 'sidebar.php'; ?>
<main class="container-fluid">
    <div class="row">
        <div class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <h2>Galeri Yönetimi</h2>

<?php if($msg): ?><div class="msg"><?= $msg ?></div><?php endif; ?>
        <form method="post" enctype="multipart/form-data" class="galeri-form">
            <h4>Yeni Fotoğraf Ekle</h4>
            <input type="text" name="baslik" placeholder="Başlık" required>
            <input type="text" name="aciklama" placeholder="Açıklama">
            <select name="kategori">
                <option value="events">Etkinlik</option>
                <option value="workshops">Atölye</option>
                <option value="teams">Takım</option>
                <option value="other">Diğer</option>
            </select>
            <input type="date" name="tarih" required>
            <input type="file" name="dosya" accept="image/*" required>
            <button type="submit" name="ekle">Ekle</button>
        </form>

        <table class="galeri-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fotoğraf</th>
                    <th>Başlık</th>
                    <th>Açıklama</th>
                    <th>Kategori</th>
                    <th>Tarih</th>
                    <th>İşlem</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($galeri as $item): ?>
                <tr>
                    <td><?= $item['id'] ?></td>
                    <td><img src="../<?= htmlspecialchars($item['dosya_yolu']) ?>" class="galeri-table-img" style="max-width:120px;max-height:90px;width:100%;height:90px;object-fit:cover;display:block;margin:0 auto;border-radius:8px;border:1.5px solid #e3e6f3;background:#fff;box-shadow:0 2px 8px 0 rgba(60,72,100,0.07);" alt=""></td>
                    <td><?= htmlspecialchars($item['baslik']) ?></td>
                    <td><?= htmlspecialchars($item['aciklama']) ?></td>
                    <td><?= htmlspecialchars($item['kategori']) ?></td>
                    <td><?= htmlspecialchars($item['tarih']) ?></td>
                    <td class="action-btns">
                        <a href="galeri-duzenle.php?id=<?= $item['id'] ?>" class="btn btn-warning btn-sm">Düzenle</a>
                        <a href="?delete=<?= $item['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>
</main>
