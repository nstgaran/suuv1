
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách truyện</title>
    <link rel="stylesheet" href="frontend/styles.php">

    <style>
        body {
            font-family: 'Prompt', sans-serif;
        }

        .float-right {
            float: right;
        }

        .tab {
            overflow: hidden;
            margin-bottom: 20px;
        }

        .tab button {
            background-color: #f47a00;
            color: white;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 10px 20px;
            transition: 0.3s;
            font-size: 16px;
            border-radius: 4px 4px 0 0;
        }

        .tab button:hover {
            background-color: #e37000;
        }

        .tab button.active {
            background-color: #ccc;
        }

        .tabcontent {
            display: none;
            padding: 20px;
            border: 1px solid #ddd;
        }

        .btn-group {
            display: flex;
        }

        .btn-group button {
            flex: 1;
            margin-right: 10px;
        }

        .btn-group button:last-child {
            margin-right: 0;
        }

        .btn h6 a {
            color: white;
            text-decoration: none;
        }

        .rating {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .star {
            font-size: 24px;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        .star img {
            width: 24px;
            height: 24px;
        }

        .star.active img {
            content: url(star.png);
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0;
            font-size: 14px;
        }

        .breadcrumb .breadcrumb-item a {
            color: #f47a00;
            text-decoration: none;
        }

        .breadcrumb .breadcrumb-item a:hover {
            text-decoration: underline;
        }

        .breadcrumb .breadcrumb-item.active {
            color: #666;
        }

        .row-one {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        .row-one img {
            width: 280px;
            height: 300px;
            object-fit: cover;
            border-radius: 4px;
        }

        .row-one h3 {
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
            text-align: center;
        }

        .row-one ul {
            list-style-type: none;
            padding-left: 0;
            text-align: center;
        }

        .row-one .btn-group {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }


        .row-one h5 {
            margin: 0;
            font-weight: normal;
            color: #555;
        }


        .row-one ul li {
            margin-bottom: 10px;
        }

        .row-one .btn {
            background-color: #f47a00;
            color: white;
            border: none;
            outline: none;
            padding: 10px 20px;
            cursor: pointer;
            transition: 0.3s;
            border-radius: 4px;
            text-decoration: none;
        }

        .row-one .btn:hover {
            background-color: #e37000;
        }


        @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@500&family=Quicksand:wght@500&display=swap');
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
    //1. mở kết nối
    include_once __DIR__ . '/dbconnect.php';
    //2 chuẩn bị câu lệnh
    $truyen_id  = $_GET['truyen_id'];
    $sql = "SELECT * FROM truyen WHERE truyen_id = $truyen_id";
    //3 thực thi câu lệnh
    $result = mysqli_query($conn, $sql);

    //4 bóc tách dữ liệu thành mảng ARRAY
    $data = [];
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $data = array(
            'truyen_id' => $row['truyen_id'],
            'truyen_ma' => $row['truyen_ma'],
            'truyen_ten' => $row['truyen_ten'],
            'truyen_hinhdaidien' => $row['truyen_hinhdaidien'],
            'truyen_theloai' => $row['truyen_theloai'],
            'truyen_tacgia' => $row['truyen_tacgia'],
            'truyen_mota_ngan' => $row['truyen_mota_ngan'],
            'truyen_ngaydang' => $row['truyen_ngaydang'],
            'truyen_loai' => $row['truyen_loai'],
        );
    }



    ///////////////////////Chương////////////////////

    //2 chuẩn bị câu lệnh
    $sqldsc = "SELECT * FROM chuong WHERE truyen_id = $truyen_id";
    //3 thực thi câu lệnh
    $resultdsc = mysqli_query($conn, $sqldsc);
    //4 bóc tách dữ liệu thành mảng ARRAY
    $datadsc = [];
    while ($row = mysqli_fetch_array($resultdsc, MYSQLI_ASSOC)) {
        $datadsc[] = array(
            'chuong_id' => $row['chuong_id'],
            'chuong_so' => $row['chuong_so'],
            'chuong_ten' => $row['chuong_ten'],
            'truyen_id' => $row['truyen_id'],
        );
    }

    ?>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="Breadcrumb">
        <ol class="breadcrumb alert alert-warning">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                <a href="chitiettruyen.php?truyen_id=<?php echo $data['truyen_id']; ?>" itemprop="item">
                    <span itemprop="name"><?php echo $data['truyen_ten']; ?></span>
                </a>
                <meta itemprop="position" content="2">
            </li>
        </ol>
    </nav>



    <div class="row">
        <div class="row-one col-2">
            <?php if ($data['truyen_loai'] == 1) { ?>
                <img src="./assets/uploads/tieuthuyet/<?= $data['truyen_hinhdaidien'] ?>" style="width: 280px; height: 380px;" />
            <?php } else if ($data['truyen_loai'] == 2) { ?>
                <img src="./assets/uploads/truyen-tranh/<?= $data['truyen_hinhdaidien'] ?>" style="width: 280px; height: 380px;" />
            <?php } ?>
        </div>
        <div class="row-one col-10 float-right">
            <h3 style="font-family: 'Quicksand', sans-serif;"><?= $data['truyen_ten'] ?></h3>
            <h6 style="font-family: 'Quicksand', sans-serif;"><i class="fa fa-dashcube" aria-hidden="true"></i>Ngày Đăng: <?= $data['truyen_ngaydang'] ?></h6>
            <br />
            <ul>
                <li>
                    <h5 style="font-family: 'Quicksand', sans-serif;"><i class="fa fa-user" aria-hidden="true"></i>Tác Giả: <?= $data['truyen_tacgia'] ?></h5>
                </li>
                <br /> 
                <li>
                    <h5 style="font-family: 'Quicksand', sans-serif;"><i class="fa fa-bars" aria-hidden="true"></i></i>Thể Loại: <br /><?= $data['truyen_theloai'] ?></h5>
                </li>
                <br />
                <br />
                <li>
                    <ul>
                        <?php
                        include_once __DIR__ . '/dbconnect.php';

                        // Chuẩn bị câu lệnh truy vấn danh mục theo truyen_id
                        $sqlDanhMuc = "SELECT dm.danhmuc_id, dm.danhmuc_ten
                        FROM danhmuc dm
                        INNER JOIN truyen t ON dm.danhmuc_id = t.danhmuc_id
                        WHERE t.truyen_id = $truyen_id";
         

                        // Thực thi câu lệnh truy vấn danh mục
                        $resultDanhMuc = mysqli_query($conn, $sqlDanhMuc);

                        // Kiểm tra xem có kết quả trả về hay không
                        if (mysqli_num_rows($resultDanhMuc) > 0) {
                            echo "<li><h5 style=\"font-family: 'Quicksand', sans-serif;\"><i class=\"fa fa-bars\" aria-hidden=\"true\"></i>Danh Mục:</h5><ul>";

                            // Lặp qua các danh mục và hiển thị tên danh mục
                            while ($row = mysqli_fetch_assoc($resultDanhMuc)) {
                                $danhmuc_ten = $row['danhmuc_ten'];
                                $danhmuc_id = $row['danhmuc_id'];
                                echo "<li><a href=\"timdanhmuc.php?danhmuc_id=$danhmuc_id\">$danhmuc_ten</a></li>";
                            }

                            echo "</ul></li>";
                        }
                        ?>

                    </ul>
                </li>
                <br />
            </ul>
            <div class="row">
                <div class="col-12">
                    <div class="btn-group" role="group">
                        <button class="btn btn-primary read-btn">
                            <h6 style="font-family: 'Quicksand', sans-serif;">
                                <a href="chitietchuong.php?truyen_id=<?= $datadsc[0]['truyen_id'] ?>&chuong_id=<?= $datadsc[0]['chuong_id'] ?>">
                                    <i class="fa fa-book" aria-hidden="true"></i> Đọc truyện
                                </a>
                            </h6>
                        </button>
                        <button class="btn btn-danger latest-btn">
                            <h6 style="font-family: 'Quicksand', sans-serif;">
                                <a href="chitietchuong.php?truyen_id=<?= $datadsc[count($datadsc) - 1]['truyen_id'] ?>&chuong_id=<?= $datadsc[count($datadsc) - 1]['chuong_id'] ?>">
                                    <i class="fa fa-book" aria-hidden="true"></i> Đọc mới nhất
                                </a>
                            </h6>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <br />

    <div class="tab" style="border: 1px solid black;">
        <button id="thongtinBtn" class="tablinks" onclick="openTab(event, 'thongtin')"><i class="fa fa-info-circle" aria-hidden="true"></i>Giới Thiệu Nội Dung</button>
        <button id="danhsachBtn" class="tablinks" onclick="openTab(event, 'danhsach')"><i class="fa fa-database" aria-hidden="true"></i>Danh sách chương truyện</button>
        <button id="danhgiaBtn" class="tablinks" onclick="openTab(event, 'danhgia')"><i class="fa fa-star-half-o" aria-hidden="true"></i>Đánh Giá</button>
    </div>

    <div id="thongtin" class="tabcontent">
        <?= $data['truyen_mota_ngan'] ?>
    </div>

    <div id="danhsach" class="tabcontent">
        <ul>
            <?php foreach ($datadsc as $chuong) : ?>
                <li>
                    <a href="chitietchuong.php?truyen_id=<?= $chuong['truyen_id'] ?>&chuong_id=<?= $chuong['chuong_id'] ?>"> Chương <?php echo $chuong['chuong_so']; ?>: <?php echo $chuong['chuong_ten']; ?> </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div id="danhgia" class="tabcontent">
        <div class="rating">
            <span class="star" onclick="setRating(1)"><img src="star-black.png" alt="Star" id="star1"></span>
            <span class="star" onclick="setRating(2)"><img src="star-black.png" alt="Star" id="star2"></span>
            <span class="star" onclick="setRating(3)"><img src="star-black.png" alt="Star" id="star3"></span>
            <span class="star" onclick="setRating(4)"><img src="star-black.png" alt="Star" id="star4"></span>
            <span class="star" onclick="setRating(5)"><img src="star-black.png" alt="Star" id="star5"></span>
        </div>
        <p id="rating-text"></p>

    </div>

</body>

<script>
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;

        // Ẩn tất cả các tabcontent
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Xóa lớp 'active' khỏi tất cả các tablinks
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Hiển thị tabcontent được chọn và thêm lớp 'active' vào tablink
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Tự động kích hoạt tab "Thông Tin Truyện"
    document.addEventListener('DOMContentLoaded', function() {
        var thongtinBtn = document.getElementById('thongtinBtn');
        thongtinBtn.click();
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Khôi phục đánh giá từ localStorage nếu có
        const savedRating = localStorage.getItem('rating');
        if (savedRating) {
            setRating(parseInt(savedRating));
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Khôi phục đánh giá từ localStorage nếu có
        const savedRating = localStorage.getItem('rating');
        if (savedRating) {
            setRating(parseInt(savedRating));
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Khôi phục đánh giá từ localStorage nếu có
        const savedRating = localStorage.getItem('rating');
        if (savedRating) {
            setRating(parseInt(savedRating));
        }
    });

    let currentRating = 0;

    function setRating(rating) {
        const ratingText = document.getElementById('rating-text');
        ratingText.textContent = getRatingText(rating);

        // Lưu giá trị đánh giá vào localStorage
        localStorage.setItem('rating', rating);

        // Đặt màu cho các ngôi sao
        for (let i = 1; i <= 5; i++) {
            const star = document.getElementById(`star${i}`);
            if (i <= rating) {
                star.classList.add('active');
            } else {
                star.classList.remove('active');
            }
        }

        currentRating = rating;
    }

    function getRatingText(rating) {
        switch (rating) {
            case 1:
                return 'Cực Tệ';
            case 2:
                return 'Tệ';
            case 3:
                return 'Tạm ổn';
            case 4:
                return 'Hay';
            case 5:
                return 'Siêu Phẩm';
            default:
                return '';
        }
    }

    // Bỏ chọn đánh giá khi di chuột ra khỏi phần rating
    const ratingContainer = document.querySelector('.rating');
    ratingContainer.addEventListener('mouseout', function() {
        if (currentRating === 0) {
            const ratingText = document.getElementById('rating-text');
            ratingText.textContent = '';
        }
    });
</script>

</html>