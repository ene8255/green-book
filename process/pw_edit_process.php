<?php
    $no = $_POST['no'];
    $userPw = $_POST['userPw'];

    // 다른 파일에서 데이터베이스 정보 가져오기
    include '../config/rds.php';
    
    // mysql 연결
    // 개발
    // $conn = mysqli_connect($host, $user, $pw, $db);
    // 배포
    $conn = mysqli_connect(getenv("RDS_HOST"), getenv("RDS_USER"), getenv("RDS_PW"), getenv("RDS_DB"));
    // $hashedPassword = password_hash($_POST['userPw'], PASSWORD_DEFAULT);
    // echo $hashedPassword;

    // 쿼리문 정의 (member 테이블 계정 정보 업데이트)
    $sqlstr = "update member
               set pw='{$userPw}' 
               where no={$no}";

    $result = mysqli_query($conn, $sqlstr);

    if($result) {
?>
    <script>
        alert('변경이 완료되었습니다.');
        location.href = "../mypage.php";
    </script>
<?php
    }else {
        echo "오류가 발생하였습니다. 관리자에게 문의하세요.";
    }
?>