<?php
    $no = $_POST['no'];

    // mysql 연결
    include '../config/rds.php';
    // 개발
    // $conn = mysqli_connect($host, $user, $pw, $db);
    // 배포
    $conn = mysqli_connect(getenv("RDS_HOST"), getenv("RDS_USER"), getenv("RDS_PW"), getenv("RDS_DB"));

    $sqlstr = "delete from review where no={$no}";

    $result = mysqli_query($conn, $sqlstr);

    // 수행 결과가 성공적인지 아닌지 확인
    if($result) {
?>
    <script>
        alert("삭제되었습니다.");
        location.href = "../mypage.php";
    </script>
<?php
    }else {
        echo "오류가 발생하였습니다. 관리자에게 문의하세요.";
    }
?>