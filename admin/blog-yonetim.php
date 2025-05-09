<?php
require_once 'includes/config.php';

// Oturum kontrolü
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Silme işlemi
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM blog_posts WHERE id = ?";
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $id);
        if(mysqli_stmt_execute($stmt)){
            header("location: blog-yonetim.php?success=1");
            exit();
        }
        mysqli_stmt_close($stmt);
    }
}

// Blog yazılarını getir
$sql = "SELECT * FROM blog_posts ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<?php include 'admin-header.php'; ?>
<?php include 'sidebar.php'; ?>
<main class="container-fluid">
    <div class="row">
        <div class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Blog Yazıları</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="blog-ekle.php" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Yeni Blog Yazısı
                    </a>
                </div>
            </div>

            <?php if(isset($_GET['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                İşlem başarıyla tamamlandı!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif; ?>

            <div class="row">
                <?php if(mysqli_num_rows($result) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card blog-card h-100">
                                <?php if($row['image_url']): ?>
                                    <img src="<?php echo htmlspecialchars($row['image_url']); ?>" class="card-img-top" alt="Blog Görseli" style="height: 200px; object-fit: cover;">
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
                                    <p class="card-text text-muted">
                                        <small>
                                            <i class="far fa-calendar-alt"></i> 
                                            <?php echo date('d.m.Y', strtotime($row['created_at'])); ?>
                                        </small>
                                    </p>
                                    <div class="action-buttons">
                                        <a href="blog-duzenle.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i> Düzenle
                                        </a>
                                        <a href="javascript:void(0);" onclick="deleteBlog(<?php echo $row['id']; ?>)" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Sil
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="alert alert-info" role="alert">
                                Henüz blog yazısı bulunmamaktadır.
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function deleteBlog(id) {
            if(confirm('Bu blog yazısını silmek istediğinizden emin misiniz?')) {
                window.location.href = 'blog-yonetim.php?delete=' + id;
            }
        }
    </script>
</body>
</html> 