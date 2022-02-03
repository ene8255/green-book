<?php
    session_start();
    $conn = mysqli_connect('localhost', 'root', '1234', 'green_book');
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