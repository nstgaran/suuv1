<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách chương</title>
    <style>
        .chapter-dropdown {
            display: inline-block;
            position: relative;
        }

        .chapter-dropdown .dropdown-toggle {
            color: #fff;
            text-decoration: none;
        }

        .chapter-dropdown .dropdown-toggle i {
            margin-right: 5px;
        }

        .chapter-dropdown .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            display: none;
            z-index: 1000;
            min-width: 160px;
            padding: 5px 0;
            margin: 2px 0 0;
            font-size: 14px;
            text-align: left;
            list-style: none;
            background-color: #fff;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, .15);
            border-radius: 4px;
        }

        .chapter-dropdown .dropdown-menu li {
            padding: 0 10px;
        }

        .chapter-dropdown .dropdown-menu li a {
            display: block;
            padding: 3px 20px;
            clear: both;
            font-weight: 400;
            line-height: 1.42857143;
            color: #333;
            white-space: nowrap;
        }

        .chapter-dropdown .dropdown-menu li a:hover {
            background-color: #f5f5f5;
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
    $chuong_id = $_GET['chuong_id'];
    $sqldsc = "SELECT * FROM chuong WHERE chuong_id = $chuong_id";
    // Thực thi câu lệnh
    $resultdsc = mysqli_query($conn, $sqldsc);

    if ($resultdsc) {
        // Bóc tách dữ liệu thành mảng ARRAY
        $datadsc = [];
        while ($row = mysqli_fetch_array($resultdsc, MYSQLI_ASSOC)) {
            $datadsc = array(
                'chuong_id' => $row['chuong_id'],
                'chuong_so' => $row['chuong_so'],
                'chuong_ten' => $row['chuong_ten'],
                'chuong_noidung' => $row['chuong_noidung'],
                'truyen_id' => $row['truyen_id'],
            );
        }
    } else {
        // Truy vấn không thành công, xử lý lỗi
        echo "Lỗi truy vấn: " . mysqli_error($conn);
    }



    ///////////////////////Ảnh/////////////////////
    $sqlimg = "SELECT * FROM chuong_hinhanh WHERE chuong_id = $chuong_id";
    //3 thực thi câu lệnh
    $resultimg = mysqli_query($conn, $sqlimg);
    //4 bóc tách dữ liệu thành mảng ARRAY
    $dataimg = [];
    while ($row = mysqli_fetch_array($resultimg, MYSQLI_ASSOC)) {
        $dataimg[] = array(
            'chuong_id' => $row['chuong_id'],
            'chuong_hinhanh_tenhinh' => $row['chuong_hinhanh_tenhinh'],
        );
    }
    ?>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="Breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                <a href="danhsachtieuthuyet.php" itemprop="item">
                    <span itemprop="name">Danh sách truyện</span>
                </a>
                <meta itemprop="position" content="1">
            </li>
            <?php if (isset($_GET['truyen_id'])) { ?>
                <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                    <a href="chitiettruyen.php?truyen_id=<?php echo $data['truyen_id']; ?>" itemprop="item">
                        <span itemprop="name"><?php echo $data['truyen_ten']; ?></span>
                    </a>
                    <meta itemprop="position" content="2">
                </li>
            <?php } ?>
            <?php if (isset($_GET['chuong_id'])) { ?>
                <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                    <a href="chitietchuong.php?truyen_id=<?php echo $data['truyen_id']; ?>&chuong_id=<?php echo $datadsc['chuong_id']; ?>" itemprop="item">
                        <span itemprop="name"><?php echo $datadsc['chuong_ten']; ?></span>
                    </a>
                    <meta itemprop="position" content="3">
                </li>
            <?php } ?>
        </ol>
    </nav>


    <div class="container">
        <h1 class="text-center"><?= $data['truyen_ten'] ?></h1>
        <h6 class="text-center" style="color:brown">Chương <?= $datadsc['chuong_so'] ?>: <?= $datadsc['chuong_ten'] ?> </h6>
        <div class="navigation-buttons text-center">
            <?php if ($datadsc && is_array($datadsc) && count($datadsc) > 0) : ?>
                <?php
                $current_chuong_id = $datadsc['chuong_id'];

                // Lấy chương trước đó với chương_id lớn nhất nhỏ hơn chương hiện tại
                $previous_chapter_query = "SELECT * FROM chuong WHERE truyen_id = {$datadsc['truyen_id']} AND chuong_id < $current_chuong_id ORDER BY chuong_id DESC LIMIT 1";
                $previous_chapter_result = mysqli_query($conn, $previous_chapter_query);

                $previous_url = '';

                if ($previous_chapter_result && mysqli_num_rows($previous_chapter_result) > 0) {
                    $previous_chapter_info = mysqli_fetch_assoc($previous_chapter_result);
                    $previous_chapter_id = $previous_chapter_info['chuong_id'];
                    $previous_chapter_so = $previous_chapter_info['chuong_so'];
                    $previous_url = "chitietchuong.php?truyen_id={$datadsc['truyen_id']}&chuong_id={$previous_chapter_id}&chuong_so={$previous_chapter_so}";
                }
                ?>

                <?php if (!empty($previous_url)) : ?>
                    <a href="<?= $previous_url ?>" class="btn btn-primary">Chương Trước</a>
                <?php endif; ?>
            <?php endif; ?>

            <a href="/freetruyen/chitiettruyen.php?truyen_id=<?= $data['truyen_id'] ?>" class="btn btn-primary">⛺️</a>
            <?php if ($datadsc && is_array($datadsc) && count($datadsc) > 0) : ?>
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#chapterOffcanvas" aria-controls="chapterOffcanvas">📚</button>

                <div class="offcanvas offcanvas-start" tabindex="-1" id="chapterOffcanvas">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" style='color: #000000'>Danh sách chương</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="list-group">
                            <?php
                            // Lấy danh sách chương của truyện
                            $chapter_list_query = "SELECT * FROM chuong WHERE truyen_id = {$datadsc['truyen_id']}";
                            $chapter_list_result = mysqli_query($conn, $chapter_list_query);

                            while ($chapter = mysqli_fetch_assoc($chapter_list_result)) {
                                $selected = ($chapter['chuong_id'] == $datadsc['chuong_id']) ? 'active' : '';
                                $chapter_url = "chitietchuong.php?truyen_id={$datadsc['truyen_id']}&chuong_id={$chapter['chuong_id']}";
                                echo "<li class='list-group-item $selected'><a href='$chapter_url' style='color: #000000;'>Chương {$chapter['chuong_so']}: {$chapter['chuong_ten']}</a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>


            <?php if ($datadsc && is_array($datadsc) && count($datadsc) > 0) : ?>
                <?php
                $current_chuong_id = $datadsc['chuong_id'];

                // Lấy chương tiếp theo với chương_id lớn nhất nhỏ hơn chương hiện tại
                $next_chapter_query = "SELECT * FROM chuong WHERE truyen_id = {$datadsc['truyen_id']} AND chuong_id > $current_chuong_id ORDER BY chuong_id ASC LIMIT 1";
                $next_chapter_result = mysqli_query($conn, $next_chapter_query);

                $next_url = '';

                if ($next_chapter_result && mysqli_num_rows($next_chapter_result) > 0) {
                    $next_chapter_info = mysqli_fetch_assoc($next_chapter_result);
                    $next_chapter_id = $next_chapter_info['chuong_id'];
                    $next_chapter_so = $next_chapter_info['chuong_so'];
                    $next_url = "chitietchuong.php?truyen_id={$datadsc['truyen_id']}&chuong_id={$next_chapter_id}&chuong_so={$next_chapter_so}";
                }
                ?>

                <?php if (!empty($next_url)) : ?>
                    <a href="<?= $next_url ?>" class="btn btn-primary">Chương Sau</a>
                <?php endif; ?>
            <?php endif; ?>



        </div>

        <div class="row">
            <div class="col">
                <h3><?= $datadsc['chuong_noidung'] ?></h3>
                <?php foreach ($dataimg as $img) : ?>
                    <img style="width: 100%" src="./assets/uploads/<?= $img['chuong_hinhanh_tenhinh'] ?>" />
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".chapter-dropdown .dropdown-toggle").click(function(e) {
                e.preventDefault();
                $(this).siblings('.dropdown-menu').toggle();
            });

            $(document).click(function(e) {
                if (!$(e.target).is('.chapter-dropdown .dropdown-toggle, .chapter-dropdown .dropdown-toggle *')) {
                    $(".chapter-dropdown .dropdown-menu").hide();
                }
            });
        });
    </script>
</body>

</html>