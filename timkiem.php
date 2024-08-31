<?php
include_once __DIR__ . '/dbconnect.php'; //Thêm dòng này để bao gồm tệp dbconnect.php

$truyen_ten = isset($_GET['truyen_ten']) ? urldecode($_GET['truyen_ten']) : '';

// Thực hiện truy vấn tìm kiếm dựa trên $truyen_ten
$query = "SELECT truyen_id, truyen_ma, truyen_ten, truyen_hinhdaidien, truyen_loai
	FROM truyen
	WHERE truyen_ten LIKE '%$truyen_ten%'";
$result = mysqli_query($conn, $query);

$data = array(); // Khởi tạo mảng để lưu kết quả tìm kiếm

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row; // Thêm kết quả tìm kiếm vào mảng $data
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm</title>
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
                <h4 style="font-family: 'Prompt', sans-serif;">Kết quả tìm kiếm</h4>
                <p>Tìm kiếm: <?= $truyen_ten ?></p>
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
                                        <a href="/freetruyen/chitiettruyen.php?truyen_id=<?= $truyen['truyen_id'] ?>&truyen_loai=1" class="btn btn-warning">Tiểu Thuyết</a>
                                    <?php } else if ($truyen['truyen_loai'] == 2) { ?>
                                        <a href="/freetruyen/chitiettruyen.php?truyen_id=<?= $truyen['truyen_id'] ?>&truyen_loai=2" class="btn btn-warning">Truyện Tranh</a>
                                    <?php } ?>
                                </div>
                                <a href="/freetruyen/chitiettruyen.php?truyen_id=<?= $truyen['truyen_id'] ?>">
                                    <img src="/freetruyen/assets/uploads/<?= $truyen['truyen_loai'] == 1 ? 'tieuthuyet' : 'truyen-tranh' ?>/<?= $truyen['truyen_hinhdaidien'] ?>" alt="<?= $truyen['truyen_ten'] ?>" style="width: 200px; height: 200px;">
                                </a>
                                <div class="card-body">
                                    <h5 style="font-family: 'Prompt', sans-serif;" class="card-title"><?= $truyen['truyen_ten'] ?></h5>
                                    <a href="/freetruyen/chitiettruyen.php?truyen_id=<?= $truyen['truyen_id'] ?>" class="btn btn-primary">Đọc Truyện</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <p>Không có kết quả tìm kiếm</p>
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
