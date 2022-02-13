<?php 
    // 다른 파일에서 데이터베이스 정보 가져오기
    include '../config/rds.php';
    // mysql 연결
    // $conn = mysqli_connect($host, $user, $pw, $db);
    $conn = mysqli_connect(getenv("RDS_HOST"), getenv("RDS_USER"), getenv("RDS_PW"), getenv("RDS_DB"));
    // $hashedPassword = password_hash($_POST['userPw'], PASSWORD_DEFAULT);
    // echo $hashedPassword;

    // 쿼리문 정의 (member 테이블에 새로운 계정 정보 추가)
    $sqlstr = "insert into member(id, pw, date, name)
               values('{$_POST['userId']}','{$_POST['userPw']}',NOW(),'{$_POST['userName']}')";
    
    // 쿼리문 수행
    $result = mysqli_query($conn, $sqlstr);
    // 수행 결과가 성공인지 실패인지 구분
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