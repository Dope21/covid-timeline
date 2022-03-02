<?php 
    unset($_SESSION['id']);
    unset($_SESSION['firstname']);
    unset($_SESSION['lastname']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link
      rel="stylesheet"
      href="https://unpkg.com/swiper/swiper-bundle.min.css"
    />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/main.css">
    <title>Login</title>
</head>
<body>
    <main class="login__container">
        <div class="login">
            <h1 class="login__title">Embedded and website system for covid 19</h1>
            <p class="login__subtitle"><span>ระบบตรวจคน เข้า-ออก</span>และเช็คไทมไลน์ผ่านเว็บไซต์โดยใช้บัตรประชาชน</p>

            <form action="login__check.php" method="POST" class="login__input">
                <p class="login__input-info">กรุณากรอกข้อมูลของท่าน</p>
                <div class="login__input-wrapper">
                    <input type="text" class="login__input-box" placeholder="้ชื่อ" name="firstname">
                </div>
                <div class="login__input-wrapper">
                    <input type="text" class="login__input-box" placeholder="นามสกุล" name="lastname">    
                </div>
                <div class="login__input-wrapper">
                    <input type="text" class="login__input-box" placeholder="้เลขบัตรประชาชน" name="id">
                </div>
                <input type="submit" class="login__button" value="ยืนยัน">
            </form>
        </div>
        <div class="slide">
        <div class="swiper mySwiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide"><img src="./photoshop/slide-theme-2.png" alt="" class=""></div>
        <div class="swiper-slide"><img src="./photoshop/image-silde-2.JPG" alt="" class=""></div>
        <div class="swiper-slide"><img src="./photoshop/image-silde-3.JPG" alt="" class=""></div>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-pagination"></div>
    </div>
        </div>
    </main>
</body>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="./javascript/login.js"></script>
    
</html>