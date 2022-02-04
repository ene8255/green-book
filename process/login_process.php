<?php
    // 다른 파일에서 데이터베이스 정보 가져오기
    include '../config/rds.php';
    $conn = mysqli_connect($host, $user, $pw, $db);
    $sqlstr =  "select * from member
                where id='{$_POST['userId']}' and pw='{$_POST['userPw']}'";
    $result = mysqli_query($conn, $sqlstr);
    $row = mysqli_fetch_array($result);
    if($row){
        // 세션 생성하기
        session_start();
        $_SESSION['username'] = $row['name'];
        if(isset($_SESSION['username'])){
?>
        <script>
            alert('로그인 되었습니다.');
            location.href = "../index.php";
        </script>
<?php
        }
    }else{
?>
        <script>
            alert('아이디와 비밀번호가 맞지 않습니다.');
            location.href = "../member/login.php";
        </script>
<?php
    }
?>