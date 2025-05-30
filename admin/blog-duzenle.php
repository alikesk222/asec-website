<?php
require_once 'includes/config.php';

// Oturum kontrolü
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// ID kontrolü
if(!isset($_GET["id"]) || empty(trim($_GET["id"]))){
    header("location: blog-yonetim.php");
    exit;
}

$id = trim($_GET["id"]);
$title = $content = $image_url = $category = $author = "";
$title_err = $content_err = $image_err = "";

// Blog yazısını getir
$sql = "SELECT * FROM blog_posts WHERE id = ?";
if($stmt = mysqli_prepare($conn, $sql)){
    mysqli_stmt_bind_param($stmt, "i", $id);
    if(mysqli_stmt_execute($stmt)){
        $result = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);
            $title = $row['title'];
            $content = $row['content'];
            $image_url = $row['image_url'];
            $category = !empty($row['category']) ? $row['category'] : 'Genel';
            $author = !empty($row['author']) ? $row['author'] : $_SESSION["username"];
        } else {
            header("location: blog-yonetim.php");
            exit();
        }
    } else {
        echo "Bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.";
    }
    mysqli_stmt_close($stmt);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Başlık kontrolü
    if(empty(trim($_POST["title"]))){
        $title_err = "Lütfen başlık giriniz.";
    } else {
        $title = trim($_POST["title"]);
    }
    
    // Kategori kontrolü
    $category = !empty($_POST["category"]) ? trim($_POST["category"]) : "Genel";
    
    // Yazar kontrolü
    $author = !empty($_POST["author"]) ? trim($_POST["author"]) : $_SESSION["username"];
    
    // İçerik kontrolü
    if(empty(trim($_POST["content"]))){
        $content_err = "Lütfen içerik giriniz.";
    } else {
        $content = trim($_POST["content"]);
    }
    
    // Resim yükleme işlemi
    if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["image"]["name"];
        $filetype = $_FILES["image"]["type"];
        $filesize = $_FILES["image"]["size"];
    
        // Dosya uzantısını doğrula
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) {
            $image_err = "Lütfen JPG, JPEG, PNG ya da GIF formatında bir dosya yükleyin.";
        }
    
        // Dosya boyutunu kontrol et (5MB max)
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) {
            $image_err = "Dosya boyutu çok büyük. Maksimum 5MB olmalıdır.";
        }
    
        // Tüm kontroller tamamsa dosyayı yükle
        if(empty($image_err)) {
            $target_dir = "uploads/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $target_file = $target_dir . time() . "_" . basename($filename);
            
            if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image_url = "uploads/" . time() . "_" . basename($filename);
            } else {
                $image_err = "Dosya yüklenirken bir hata oluştu.";
            }
        }
    } elseif(!empty($_POST["image_url"])) {
        $image_url = trim($_POST["image_url"]);
    }
    
    // Hata yoksa güncelle
    if(empty($title_err) && empty($content_err)){
        $sql = "UPDATE blog_posts SET title=?, category=?, author=?, content=?, image_url=? WHERE id=?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "sssssi", $title, $category, $author, $content, $image_url, $id);
            
            if(mysqli_stmt_execute($stmt)){
                header("location: blog-yonetim.php?success=1");
                exit();
            } else{
                echo "Bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.";
            }

            mysqli_stmt_close($stmt);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Yazısını Düzenle - ASEC Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            background-color: #343a40;
        }
        
        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto;
        }
        
        .sidebar .nav-link {
            font-weight: 500;
            color: #fff;
            padding: 1rem;
        }
        
        .sidebar .nav-link:hover {
            color: #007bff;
            background-color: rgba(255,255,255,0.1);
        }
        
        .sidebar .nav-link.active {
            color: #007bff;
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
        }
        
        main {
            padding-top: 48px;
        }
        
        .navbar-brand {
            padding-top: .75rem;
            padding-bottom: .75rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">ASEC Admin</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="logout.php">Çıkış Yap</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">
                                <i class="fas fa-home"></i>
                                Ana Sayfa
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="blog-yonetim.php">
                                <i class="fas fa-blog"></i>
                                Blog
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="uyeler-yonetim.php">
                                <i class="fas fa-users"></i>
                                Üyeler
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="etkinlikler-yonetim.php">
                                <i class="fas fa-calendar-alt"></i>
                                Etkinlikler
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="duyurular-yonetim.php">
                                <i class="fas fa-bullhorn"></i>
                                Duyurular
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Blog Yazısını Düzenle</h1>
                </div>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $id; ?>" method="post" class="blog-form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Başlık</label>
                        <input type="text" name="title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $title; ?>">
                        <span class="invalid-feedback"><?php echo $title_err; ?></span>
                    </div>
                    
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="category" class="form-control">
                            <option value="Genel" <?php echo ($category == "Genel") ? "selected" : ""; ?>>Genel</option>
                            <option value="Teknoloji" <?php echo ($category == "Teknoloji") ? "selected" : ""; ?>>Teknoloji</option>
                            <option value="Yazılım" <?php echo ($category == "Yazılım") ? "selected" : ""; ?>>Yazılım</option>
                            <option value="Robotik" <?php echo ($category == "Robotik") ? "selected" : ""; ?>>Robotik</option>
                            <option value="Yapay Zeka" <?php echo ($category == "Yapay Zeka") ? "selected" : ""; ?>>Yapay Zeka</option>
                            <option value="Etkinlik" <?php echo ($category == "Etkinlik") ? "selected" : ""; ?>>Etkinlik</option>
                            <option value="Duyuru" <?php echo ($category == "Duyuru") ? "selected" : ""; ?>>Duyuru</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Yazar</label>
                        <input type="text" name="author" class="form-control" value="<?php echo $author; ?>" placeholder="Varsayılan: Giriş yapan kullanıcı">
                    </div>
                    
                    <div class="form-group">
                        <label>Görsel</label>
                        <?php if(!empty($image_url)): ?>
                            <div class="mb-2">
                                <img src="../<?php echo htmlspecialchars($image_url); ?>" alt="Mevcut görsel" style="max-width: 200px;">
                            </div>
                        <?php endif; ?>
                        <input type="file" name="image" class="form-control-file">
                        <small class="form-text text-muted">Yeni bir görsel yüklemek için seçin (JPG, JPEG, PNG veya GIF, max. 5MB)</small>
                        <input type="hidden" name="image_url" value="<?php echo htmlspecialchars($image_url); ?>">
                        <?php if(!empty($image_err)): ?>
                            <span class="text-danger"><?php echo $image_err; ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label>İçerik</label>
                        <textarea name="content" id="summernote" class="form-control <?php echo (!empty($content_err)) ? 'is-invalid' : ''; ?>"><?php echo $content; ?></textarea>
                        <span class="invalid-feedback"><?php echo $content_err; ?></span>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Güncelle
                        </button>
                        <a href="blog-yonetim.php" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Geri
                        </a>
                    </div>
                </form>
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                lang: 'tr-TR'
            });
        });
    </script>
</body>
</html> 