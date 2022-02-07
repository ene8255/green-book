<?php
    session_start();

    // 다른 파일에서 데이터베이스 정보 가져오기
    include '../config/rds.php';
    // mysql 연결
    $conn = mysqli_connect($host, $user, $pw, $db);

    // 1. member 테이블에서 로그인된 계정의 데이터 가져오기
    // 쿼리문 정의
    $sqlstr1 =  "select * from member
                where name='{$_SESSION['username']}'";
    // 쿼리문 수행
    $result1 = mysqli_query($conn, $sqlstr1);
    $row = mysqli_fetch_array($result1);
    // 가져온 id 데이터 가공
    $id = $row['id'];
    $id[2] = '*';
    $id[3] = '*';
    
    // 2. review 테이블에 리뷰 데이터 추가
    // 쿼리문 정의
    $sqlstr2 =  "insert into review(title, date, star, comment, id)
                values('{$_POST['title']}', now(), '{$_POST['star']}', '{$_POST['comment']}', '{$id}')";
    // 쿼리문 수행
    $result2 = mysqli_query($conn, $sqlstr2);

    // 쿼리문을 수행한 결과가 성공했을 때와 실패했을 때 
    if($result2){
?>
    <script>
        alert('리뷰 작성 완료');
        history.back();
    </script>
<?php
    }else{
        echo "오류가 발생하였습니다.";
    }
?>