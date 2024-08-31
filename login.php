<?php
session_start();

include_once __DIR__ . '/dbconnect.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Kiểm tra thông tin đăng nhập
    $query = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // So sánh mật khẩu đã mã hóa từ cơ sở dữ liệu với mật khẩu người dùng nhập vào
        if (password_verify($password, $user['password'])) {
            // Lưu thông tin người dùng vào session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Chuyển hướng người dùng đến trang tương ứng
            if ($_SESSION['role'] === 'admin') {
                header('Location: http://localhost/admin');
            } else {
                // Lấy thông tin ảnh đại diện của người dùng và lưu vào session
                $user_id = $user['user_id'];
                $query = "SELECT avatar FROM user WHERE user_id = $user_id";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                $_SESSION['avatar'] = $row['avatar'];

                header('Location: http://localhost/');
            }
            exit;
        } else {
            echo "Email hoặc mật khẩu không chính xác!";
        }
    } else {
        echo "Email hoặc mật khẩu không chính xác!";
    }

    mysqli_close($conn);
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <title>Đăng Nhập</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');
    * {
      margin: 0;
      padding: 0;
      font-family: 'poppins', sans-serif;
    }

    section {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      width: 100%;

      background: url('imglogin.jpg') no-repeat;
      background-position: center;
      background-size: cover;
    }

    .form-box {
      position: relative;
      width: 400px;
      height: 450px;
      background: transparent;
      border: 2px solid rgba(255, 255, 255, 0.5);
      border-radius: 20px;
      backdrop-filter: blur(15px);
      display: flex;
      justify-content: center;
      align-items: center;
    }

    h2 {
      font-size: 2em;
      color: #fff;
      text-align: center;
    }

    .inputbox {
      position: relative;
      margin: 30px 0;
      width: 310px;
      border-bottom: 2px solid #fff;
    }

    .inputbox label {
      position: absolute;
      top: 50%;
      left: 5px;
      transform: translateY(-50%);
      color: #fff;
      font-size: 1em;
      pointer-events: none;
      transition: .5s;
    }

    input:focus~label,
    input:valid~label {
      top: -5px;
    }

    .inputbox input {
      width: 100%;
      height: 50px;
      background: transparent;
      border: none;
      outline: none;
      font-size: 1em;
      padding: 0 35px 0 5px;
      color: #fff;
    }

    .inputbox ion-icon {
      position: absolute;
      right: 8px;
      color: #fff;
      font-size: 1.2em;
      top: 20px;
    }

    .forget {
      margin: -15px 0 15px;
      font-size: .9em;
      color: #fff;
      display: flex;
      justify-content: space-between;
    }

    .forget label input {
      margin-right: 3px;
    }

    .forget label a {
      color: #fff;
      text-decoration: none;
    }

    .forget label a:hover {
      text-decoration: underline;
    }

    button {
      width: 100%;
      height: 40px;
      border-radius: 40px;
      background: #fff;
      border: none;
      outline: none;
      cursor: pointer;
      font-size: 1em;
      font-weight: 600;
    }

    .register {
      font-size: .9em;
      color: #fff;
      text-align: center;
      margin: 25px 0 10px;
    }

    .register p a {
      text-decoration: none;
      color: #fff;
      font-weight: 600;
    }

    .register p a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
<section>
    <div class="form-box">
      <div class="form-value">
        <form action="login.php" method="POST">
          <h2>Login</h2>
          <div class="inputbox">
            <ion-icon name="mail-outline"></ion-icon>
            <input type="email" name="email" required>
            <label for="email">Email</label>
          </div>
          <div class="inputbox">
            <ion-icon name="lock-closed-outline"></ion-icon>
            <input type="password" name="password" required>
            <label for="password">Password</label>
          </div>
          <div class="forget">
            <label for="remember"><input type="checkbox" name="remember" id="remember">Remember Me <a href="#">Forget Password</a></label>
          </div>
          <button type="submit" name="login">Log in</button>
          <div class="register">
            <p>Don't have an account? <a href="register.php">Register</a></p>
          </div>
        </form>
      </div>
    </div>
  </section>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
