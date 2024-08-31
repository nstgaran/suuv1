<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <meta charset="utf-8">
    <style>
        body {
            height: 100%;
        }

        .wrapper {
            min-height: 100%;
            position: relative;
        }

        .button-wrapper {
            position: fixed;
            top: 50%;
            transform: translateY(-50%);
            width: 80%;
            height: 80%;
            text-align: center;
        }

        body {
            background-image: url('/freetruyen/avt2.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }

        h1 {
            font-size: 36px;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }

        nav {
            background-color: #4CAF50;
            overflow: hidden;
        }

        nav a {
            color: white;
            display: block;
            float: left;
            font-size: 16px;
            padding: 14px 16px;
            text-align: center;
            text-decoration: none;
        }

        nav a:hover {
            background-color: #3e8e41;
        }

        .container {
            border: 2px solid #ccc;
            padding: 20px;
            max-width: 500px;
            margin: 0 auto;
        }

        p {
            margin: 20px 0;
        }

        .image-wrapper {
            position: relative;
            display: inline-block;
            height: calc(100vh - 140px);
            /* 140px = 80px (header) + 60px (footer) */
        }

        .image-wrapper {
            position: relative;
            display: inline-block;
            height: calc(100vh - 180px);
            /* Tăng height lên 40px */
            /* 180px = 100px (header) + 80px (footer) */
        }

        .button-wrapper {
            position: fixed;
            top: 50%;
            transform: translateY(-50%);
            width: 50%;
            text-align: center;
            z-index: 1;
            /* Thêm thuộc tính này để đảm bảo các nút button được đặt trên ảnh */
        }

        .left {
            left: 0;
        }

        .right {
            right: 0;
        }

        .button {
            display: inline-block;
            padding: 20px 40px;
            background-color: #ECECEC;
            color: #000000;
            font-size: 24px;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease-in-out;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            /* make sure the buttons are on top of the image */
        }

        .button img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.5;
        }

        .button:hover {
            background-color: #000000;
            color: #FFFFFF;
        }

        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        figcaption {
            text-align: center;
            font-weight: bold;
        }

        .center {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        figure {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<div class="snow-container"></div>

<body class="wrapper">
<h1 style="background: linear-gradient(to right, red, orange, yellow, green, blue, indigo, violet); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
    Chào mừng bạn đến với Thần Nông Truyện
</h1>
    <div class="button-wrapper left" style="margin: 0; padding: 0; height: 100vh;">
        <a href="danhsachmanga.php" class="button">
            <img src="https://miraihuman.com/storage/miraiuploads/TOP%2010%20B%E1%BB%98%20MANGA%20HAY%20NH%E1%BA%A4T%20M%E1%BB%8CI%20TH%E1%BB%9CI%20%C4%90%E1%BA%A0I/One%20Piece%20-%2010%20b%E1%BB%99%20Manga%20hay%20nh%E1%BA%A5t%20m%E1%BB%8Di%20th%E1%BB%9Di%20%C4%91%E1%BA%A1i.png" alt="Image description">
            Manga
        </a>
    </div>

    <div class="center">
        <figure>
            <img src="index.gif">;
            <figcaption style="color: red;">
                <h1>
                    Bạn muốn xem thể loại nào?
                </h1>
            </figcaption>
        </figure>
    </div>

    <div class="button-wrapper right" style="height: 100vh;">
        <a href="danhsachtieuthuyet.php" class="button">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRaV0VQF0G4fbVxYyf6YspBYM1RhdUj4OwKRw&usqp=CAU" alt="Image description">
            Tiểu thuyết
        </a>
    </div>




</body>

</html>