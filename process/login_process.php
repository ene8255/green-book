<?php
    // 다른 파일에서 데이터베이스 정보 가져오기
    include '../config/rds.php';
    // mysql 연결
    $conn = mysqli_connect($host, $user, $pw, $db);
    // 쿼리문 정의 (member 테이블에서 해당 id와 pw를 가진 계정 정보 가져오기)
    $sqlstr =  "select * from member
                where id='{$_POST['userId']}' and pw='{$_POST['userPw']}'";
    // 쿼리문 수행
    $result = mysqli_query($conn, $sqlstr);
    $row = mysqli_fetch_array($result);

    // 수행 결과가 성공인지 실패인지 구분
    if($row){
        // 다른 파일에서 관리자 계정 정보 가져오기
        include '../config/admin.php';

        // 아이디와 패스워드가 관리자 정보와 일치 하는지 아닌지 확인
        if($row['id'] === $admin_id && $row['pw'] === $admin_pw) {
            session_start();
            // 일치하면 관리자 세션 생성
            $_SESSION['admin'] = $row['name'];
        }
        else {
            session_start();
            // 일치하지 않으면 username 세션 생성
            $_SESSION['username'] = $row['name'];
        }
        
        // session_start();
        // 세션이 실행되면 로그인 되었다는 확인창 띄우고 index 페이지로 이동
        if(isset($_SESSION['username']) || isset($_SESSION['admin'])){
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