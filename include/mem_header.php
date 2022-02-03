<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../css/mem_style.css">
    <title>Green Book</title>
</head>
<body>
    <div id="wrap">
        <header>
            <div class="inner">
                <h1><a href="../index.php">Green Book</a></h1>
                <div id="headerBtns">
                    <?php
                        session_start();
                        if(isset($_SESSION['username'])){
                            echo "{$_SESSION['username']}님 안녕하세요 :) ";
                            echo "<button onclick='location.href=\"../process/logout_process.php\"' id='logout'> 로그아웃</button>";
                            echo "<a href='../book_cart.php'><i class='material-icons'>shopping_cart</i></a>";
                        }else{
                            echo "<button onclick='location.href=\"join.php\"'> 회원가입 </button>";
                            echo "<button onclick='location.href=\"login.php\"'> 로그인 </button>";
                            echo "<a href='../book_cart.php'><i class='material-icons'>shopping_cart</i></a>";
                        }
                    ?>
                </div>
            </div>
        </header>