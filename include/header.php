<?php
    // mysql 연결 & 쿼리 수행
    // default 쿼리문은 "select * from bestseller"로 정함
    function mysql($sql="select * from bestseller"){
        // 다른 파일에서 데이터베이스 정보 가져오기
        include 'config/rds.php';
        // mysql 연결하기
        $conn = mysqli_connect($host, $user, $pw, $db);
        // 쿼리 수행한 결과를 리턴하기
        $result = mysqli_query($conn, $sql);
        return $result;
    }
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/style.css">
    <title>Green Book</title>
</head>
<body>
    <div id="wrap">
        <header>
            <div class="inner">
                <h1><a href="index.php">Green Book</a></h1>
                <div id="headerBtns">
                    <?php
                        // 로그인 되어 있을때와 안 되어 있을때 구분
                        session_start();
                        if(isset($_SESSION['username'])){
                            echo "<span>{$_SESSION['username']}님 안녕하세요 :) </span>";
                            echo "<button onclick='location.href=\"process/logout_process.php\"' id='logout'> 로그아웃</button>";
                            echo "<a href='book_cart.php'>
                                    <i class='material-icons'>shopping_cart</i>
                                  </a>";
                        }else{
                            echo "<button onclick='location.href=\"member/join.php\"'> 회원가입 </button>";
                            echo "<button onclick='location.href=\"member/login.php\"'> 로그인 </button>";
                            echo "<a href='book_cart.php'>
                                    <i class='material-icons'>shopping_cart</i>
                                  </a>";
                        }
                    ?>
                </div>
            </div>
        </header>