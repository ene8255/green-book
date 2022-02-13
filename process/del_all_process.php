<?php
    session_start();

    // 다른 파일에서 데이터베이스 정보 가져오기
    include '../config/rds.php';
    // mysql 연결하기
    // $conn = mysqli_connect($host, $user, $pw, $db);
    $conn = mysqli_connect(getenv("RDS_HOST"), getenv("RDS_USER"), getenv("RDS_PW"), getenv("RDS_DB"));

    // 쿼리문 정의
    $sql = "select * from bestseller";
    // 쿼리 수행한 결과 리턴
    $result = mysqli_query($conn, $sql);

    // 각 title의 이름으로 title session이 열려 있는지 확인 -> 열려 있다면 세션 종료
    while($row = mysqli_fetch_array($result)) {
        if(isset($_SESSION["{$row['title']}"])) {
            unset($_SESSION["{$row['title']}"]);
        }
    }
?>
<script>
    alert('모두 삭제되었습니다.');
    history.back();
</script>