<?php
session_start(); // Bắt đầu session

// Kiểm tra xác thực đăng nhập
if (!isset($_SESSION['user_id'])) {
    // Redirect hoặc xử lý khi chưa đăng nhập
    exit;
}

// Đường dẫn đến tệp dbconnect.php
include_once __DIR__ . '/dbconnect.php';

// Lấy user_id từ session
$userID = $_SESSION['user_id'];

// Truy vấn lấy thông tin người dùng
$query = "SELECT username, email, password, avatar FROM `user` WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $userID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Lấy thông tin người dùng từ kết quả truy vấn
    $row = $result->fetch_assoc();
    $username = $row['username'];
    $email = $row['email'];
    $password = $row['password'];
    $avatarFileName = $row['avatar'];
    $avatarUrl = 'assets/' . $avatarFileName;
} else {
    // Xử lý khi không tìm thấy người dùng
}

// Đóng kết nối
$stmt->close();
$conn->close();

// Các đoạn mã HTML và PHP khác...
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin</title>
    <link rel="stylesheet" href="assets/vendors/font-awesome-4.7.0/css/font-awesome.min.css" type="text/css">
    <!-- Link tới tệp CSS của Bootstrap 5.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <style>
        /* ... CSS khác ... */

        .account-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .account-container .avatar-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .account-container .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <!-- Header và các phần khác của trang -->

    <div class="text-center">
        <h1>Chỉnh sửa thông tin</h1>
    </div>

    <div class="account-container">
        <div class="avatar-container">
            <?php if (isset($avatarUrl) && !empty($avatarUrl)) : ?>
                <img src="<?php echo $avatarUrl; ?>" alt="Avatar" class="avatar">
            <?php else : ?>
                <img src="assets/uploads/avatar/avatarmd.jpg" alt="Default Avatar" class="avatar">
            <?php endif; ?>
        </div>

        <form action="update-profile.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="avatar" class="form-label">Thay đổi Avatar</label>
                <input type="file" class="form-control" id="avatar" name="avatar">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="text-center">
            <button type="submit" class="btn btn-primary">Lưu thông tin</button>
            </div>

        </form>
    </div>

    <!-- Các phần khác của trang -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Các tệp JavaScript khác -->
    <!-- Tệp JavaScript của Bootstrap 5.2 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
