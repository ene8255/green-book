<?php
    $title = $_POST['title'];
    session_start();
    $_SESSION["{$title}"] = $title;
    if(isset($_SESSION["{$title}"])){
?>
    <script>
        alert("상품을 장바구니에 담았습니다.");
        history.back();
    </script>
<?php
    }else{
?>
    <script>
        alert("오류가 생겼습니다. 관리자에게 문의하세요.");
    </script>
<?php
    }
?>