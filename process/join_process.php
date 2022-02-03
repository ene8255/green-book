<?php 
    $conn = mysqli_connect('localhost','root','1234','green_book');
    // $hashedPassword = password_hash($_POST['userPw'], PASSWORD_DEFAULT);
    // echo $hashedPassword;
    $sqlstr = "insert into member(id, pw, date, name)
               values('{$_POST['userId']}','{$_POST['userPw']}',NOW(),'{$_POST['userName']}')";
    $result = mysqli_query($conn, $sqlstr);
    if($result){
?>
    <script>
        alert('회원가입을 완료했습니다.');
        //자바스크립트 페이지이동
        location.href = "../index.php";
    </script>
<?php
    }else {
        echo "회원가입에 문제가 생겼습니다. 관리자에게 문의해 주세요";
        echo mysqli_error($conn);
    }
?>