<?php
session_start();
include_once __DIR__ . '/dbconnect.php';

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['user_id'])) {
    header('Location: /freetruyen/login.php');
    exit();
}

// Lấy user_id của người dùng hiện tại
$user_id = $_SESSION['user_id'];

// Xử lý logic đổi mật khẩu khi có dữ liệu được gửi lên form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['password'];

    // Mã hóa mật khẩu mới
    $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Thực hiện câu truy vấn cập nhật mật khẩu
    $query = "UPDATE user SET password = '$newHashedPassword' WHERE user_id = $user_id";
    mysqli_query($conn, $query);

    // Chuyển hướng người dùng về trang chủ hoặc trang thông tin tài khoản
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi Mật Khẩu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('/freetruyen/backend/taikhoan/imgmk.jpg');
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            margin-top: 100px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1 class="text-center">Đổi Mật Khẩu</h1>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật Khẩu Mới</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Đổi Mật Khẩu</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
