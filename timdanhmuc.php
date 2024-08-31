<?php
include_once __DIR__ . '/dbconnect.php';

$danhmuc_id = isset($_GET['danhmuc_id']) ? $_GET['danhmuc_id'] : '';

// Chuẩn bị câu lệnh truy vấn lấy truyện theo danh mục
$sqlTruyenDanhMuc = "SELECT truyen_id, truyen_ma, truyen_ten, truyen_hinhdaidien, truyen_loai
                    FROM truyen
                    WHERE danhmuc_id = $danhmuc_id";
$resultTruyenDanhMuc = mysqli_query($conn, $sqlTruyenDanhMuc);

$data = array(); // Khởi tạo mảng để lưu kết quả

if (mysqli_num_rows($resultTruyenDanhMuc) > 0) {
    while ($row = mysqli_fetch_assoc($resultTruyenDanhMuc)) {
        $data[] = $row; // Thêm kết quả vào mảng $data
    }
}
?>
<?php
//...
include_once __DIR__ . '/dbconnect.php';

$danhmuc_id = isset($_GET['danhmuc_id']) ? $_GET['danhmuc_id'] : '';
$danhmuc_id = mysqli_real_escape_string($conn, $danhmuc_id); 

// Lấy thông tin danh mục từ CSDL
$sqlDanhMuc = "SELECT danhmuc_id, danhmuc_ten FROM danhmuc WHERE danhmuc_id = $danhmuc_id";
$resultDanhMuc = mysqli_query($conn, $sqlDanhMuc);

// Kiểm tra và lấy tên danh mục
if (mysqli_num_rows($resultDanhMuc) > 0) {
    $danhmuc = mysqli_fetch_assoc($resultDanhMuc);
    $danhmuc_id = $danhmuc['danhmuc_id'];
    $danhmuc_ten = $danhmuc['danhmuc_ten'];
} else {
    // Xử lý khi không tìm thấy danh mục
    $danhmuc_id = 0;
    $danhmuc_ten = "Danh mục không tồn tại";
}

//...
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Truyện theo danh mục</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cherry+Bomb+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cherry+Bomb+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <style>
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            grid-gap: 20px;
        }

        .card-small {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .card-small img {
            width: 100%;
            height: auto;
        }

        .card-body {
            width: 100%;
            text-align: center;
        }

        .truyen-loai-buttons {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <?php include_once __DIR__ . '/frontend/header.php'; ?>
    <?php include_once __DIR__ . '/frontend/sidebar.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col-12">
            <h4 style="font-family: 'Prompt', sans-serif;">Truyện theo danh mục</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-9">
                <?php if (count($data) > 0) : ?>
                    <div class="grid-container">
                        <?php foreach ($data as $truyen) : ?>
                            <div class="card-small">
                                <div class="truyen-loai-buttons">
                                    <?php if ($truyen['truyen_loai'] == 1) { ?>
                                        <a href="chitiettruyen.php?truyen_id=<?= $truyen['truyen_id'] ?>&truyen_loai=1" class="btn btn-warning">Tiểu Thuyết</a>
                                    <?php } else if ($truyen['truyen_loai'] == 2) { ?>
                                        <a href="chitiettruyen.php?truyen_id=<?= $truyen['truyen_id'] ?>&truyen_loai=2" class="btn btn-warning">Truyện Tranh</a>
                                    <?php } ?>
                                </div>
                                <a href="chitiettruyen.php?truyen_id=<?= $truyen['truyen_id'] ?>">
                                    <img src="assets/uploads/<?= $truyen['truyen_loai'] == 1 ? 'tieuthuyet' : 'truyen-tranh' ?>/<?= $truyen['truyen_hinhdaidien'] ?>" alt="<?= $truyen['truyen_ten'] ?>" style="width: 200px; height: 200px;">
                                </a>
                                <div class="card-body">
                                    <h5 style="font-family: 'Prompt', sans-serif;" class="card-title"><?= $truyen['truyen_ten'] ?></h5>
                                    <a href="chitiettruyen.php?truyen_id=<?= $truyen['truyen_id'] ?>" class="btn btn-primary">Đọc Truyện</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <p>Không có truyện trong danh mục này</p>
                <?php endif; ?>
            </div>
            <div class="col-3">
                <?php include_once __DIR__ . '/frontend/sidebartl.php'; ?>
            </div>
        </div>
    </div>
    <?php include_once __DIR__ . '/frontend/footer.php'; ?>
</body>

</html>
