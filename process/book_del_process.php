<?php
    // POST로 전송된 imgsrc 데이터 변수로 정의
    $imgsrc = $_POST['imgsrc'];

    // mysql 연결
    include '../config/rds.php';
    // 개발
    // $conn = mysqli_connect($host, $user, $pw, $db);
    // 배포
    $conn = mysqli_connect(getenv("RDS_HOST"), getenv("RDS_USER"), getenv("RDS_PW"), getenv("RDS_DB"));

    // sql 쿼리문 정의 (받아온 imgsrc 데이터와 일치하는 행 제거)
    $sqlstr = "delete from bestseller where imgsrc = '{$imgsrc}'";

    // 쿼리문 수행
    $result = mysqli_query($conn, $sqlstr);

    // 수행 결과가 성공적인지 아닌지 확인
    if($result) {
        // 성공하면 imgsrc 경로의 이미지 파일 제거
        // unlink($imgsrc);
?>
    <script>
        alert("삭제되었습니다.");
        location.href = "../index.php";
    </script>
<?php
    }else {
        echo "오류가 발생하였습니다. 관리자에게 문의하세요.";
    }
?>