<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách truyện</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            grid-gap: 20px;
        }

        .card {
            width: 100%;
        }

        @media (max-width: 768px) {
            .grid-container {
                grid-template-columns: 1fr;
            }
        }

        @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@500&display=swap');

        .marquee-container {
            width: 100%;
            overflow: hidden;
        }

        .marquee {
            display: inline-block;
            white-space: nowrap;
            animation: marquee 10s linear infinite;
        }

        @keyframes marquee {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        @keyframes rainbow {
            0% {
                color: red;
            }

            14% {
                color: orange;
            }

            28% {
                color: yellow;
            }

            42% {
                color: green;
            }

            57% {
                color: blue;
            }

            71% {
                color: indigo;
            }

            85% {
                color: violet;
            }

            100% {
                color: red;
            }
        }

        .rainbow-text {
            animation: rainbow 5s linear infinite;
        }
    </style>
</head>

<body>
    <?php
    include_once __DIR__ . '/./frontend/header.php';
    ?>

    <?php
    include_once __DIR__ . '/./frontend/sidebar.php';
    ?>

    <?php
    //1. Mở kết nối
    include_once __DIR__ . '/dbconnect.php';
    //2. Chuẩn bị câu lệnh
    $sql = "SELECT * FROM truyen WHERE truyen_loai=1";
    //3. Thực thi câu lệnh
    $result = mysqli_query($conn, $sql);
    //4. Bóc tách dữ liệu thành mảng ARRAY
    $data = [];
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $data[] = $row;
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4 style="font-family: 'Prompt', sans-serif;" class="rainbow-text"><i class="fa fa-book" aria-hidden="true"></i>Truyện Hay</h4>
            </div>
            <div class="col-12">
                <?php include_once __DIR__ . '/truyenhay.php'; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <h4 style="font-family: 'Prompt', sans-serif;"><i class="fa fa-cloud-upload" aria-hidden="true"></i>Danh Sách Tiểu Thuyết</h4>
                <div class="grid-container">
                    <?php foreach ($data as $truyen) : ?>
                        <div class="card">
                            <?php if ($truyen['truyen_loai'] == 1) { ?>
                                <a href="chitiettruyen.php?truyen_id=<?= $truyen['truyen_id'] ?>">
                                    <img src="./assets/uploads/tieuthuyet/<?= $truyen['truyen_hinhdaidien'] ?>" style="width: 100%; height: 300px;" />
                                </a>
                            <?php } else if ($truyen['truyen_loai'] == 2) { ?>
                                <a href="chitiettruyen.php?truyen_id=<?= $truyen['truyen_id'] ?>">
                                    <img src="./assets/uploads/truyen-tranh/<?= $truyen['truyen_hinhdaidien'] ?>" style="width: 100%; height: 300px;" />
                                </a>
                            <?php } ?>
                            <div class="card-body">
                                <h5 style="font-family: 'Prompt', sans-serif;" class="card-title"> <?= $truyen['truyen_ten'] ?></h5>
                                <?php if ($truyen['truyen_loai'] == 1) {
                                    // Hiển thị chương số cho truyện loại 1 (tiểu thuyết)
                                    $sql = "SELECT chuong_so FROM chuong WHERE truyen_id = {$truyen['truyen_id']}";
                                    $result = mysqli_query($conn, $sql);
                                    $so_chuong = mysqli_num_rows($result);
                                    echo "<p>Chương: $so_chuong</p>";
                                } ?>
                               <a href="chitiettruyen.php?truyen_id=<?= $truyen['truyen_id'] ?>&danhmuc_id=<?= $danhmuc_id ?>" class="btn btn-primary">Đọc Truyện</a>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="col-12">
                    <h4 style="font-family: 'Prompt', sans-serif; color: #f7262c;" class="rainbow-text"><i class="fa fa-star" aria-hidden="true"></i>Truyện Top</h4>
                </div>
                <?php include_once __DIR__ . '/./frontend/sidebartl2.php'; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="alert alert-warning" role="alert">
                    <div class="marquee-container">
                        <div class="marquee">
                            Website được tạo bởi Admin Quang các bạn ủng hộ tớ nhé!!!<i class="fa fa-heart" aria-hidden="true"></i>
                            <button onclick="showToast()">Click</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showToast() {
            Toastify({
                text: "Chúc Bạn Đọc Truyện Vui Vẻ",
                duration: 3000,
                gravity: "bottom",
                position: "right",
                backgroundColor: "orange",
                className: "toastify-custom-class"
            }).showToast();
        }
    </script>
</body>

</html>