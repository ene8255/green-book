<?php
    // POST 방식으로 title 데이터 받기
    $title = $_POST['title'];

    // 세션 시작
    session_start();
 
    // 세션이 이미 존재하는지 확인
    if(isset($_SESSION["{$title}"])){
?>
    <script>
        alert("상품이 이미 장바구니에 담겨있습니다!");
        history.back();
    </script>
<?php
    }else{ 
        // 받아온 title 데이터의 이름으로 세션 생성
        $_SESSION["{$title}"] = $title;

        // 세션이 생성되었는지 아닌지에 따라 다른 메세지 보여주기
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
    }
?>