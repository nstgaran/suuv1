<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  exit;
}

include_once __DIR__ . '/dbconnect.php';

$userID = $_SESSION['user_id'];

$query = "SELECT avatar FROM `user` WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $userID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $existingAvatar = $row['avatar'];
} else {
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['username']) && isset($_POST['email'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];

    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
      $avatarFile = $_FILES['avatar'];
      $avatarFileName = $avatarFile['name'];
      $avatarFilePath = 'uploads/avatar/' . $avatarFileName;

      if ($existingAvatar !== 'avatarmd.jpg') {
        $existingAvatarPath = 'freetruyen/assets/uploads/avatar/' . $existingAvatar;
        if (file_exists($existingAvatarPath)) {
          unlink($existingAvatarPath);
        }
      }

      $uploadDirectory = 'assets/uploads/avatar/';

      if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
      }

      $avatarFileExtension = pathinfo($avatarFileName, PATHINFO_EXTENSION);
      $avatarNewFileName = uniqid() . '.' . $avatarFileExtension;
      $avatarFilePath = $uploadDirectory . $avatarNewFileName;

      move_uploaded_file($avatarFile['tmp_name'], $avatarFilePath);

      $avatarDbPath = 'uploads/avatar/' . $avatarNewFileName;

      $updateQuery = "UPDATE `user` SET username = ?, email = ?, avatar = ? WHERE user_id = ?";
      $updateStmt = $conn->prepare($updateQuery);
      $updateStmt->bind_param('sssi', $username, $email, $avatarDbPath, $userID);
      $updateStmt->execute();
      $updateStmt->close();
    } else {
      $updateQuery = "UPDATE `user` SET username = ?, email = ? WHERE user_id = ?";
      $updateStmt = $conn->prepare($updateQuery);
      $updateStmt->bind_param('ssi', $username, $email, $userID);
      $updateStmt->execute();
      $updateStmt->close();
    }
  }

  header('Location: account.php');
  exit;
}

$stmt->close();
$conn->close();
