<?php
    session_start();
    // 다른 파일에서 데이터베이스 정보 가져오기
    include '../config/rds.php';
    $conn = mysqli_connect($host, $user, $pw, $db);
    $sqlstr1 =  "select * from member
                where name='{$_SESSION['username']}'";
    $result1 = mysqli_query($conn, $sqlstr1);
    $row = mysqli_fetch_array($result1);
    $id = $row['id'];
    $id[2] = '*';
    $id[3] = '*';
    
    $sqlstr2 =  "insert into review(title, date, star, comment, id)
                values('{$_POST['title']}', now(), '{$_POST['star']}', '{$_POST['comment']}', '{$id}')";
    $result2 = mysqli_query($conn, $sqlstr2);
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