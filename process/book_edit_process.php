<?php
    // 1. POST 방식으로 받은 데이터를 변수로 정의
    $no = $_POST['no'];
    $title = $_POST['title'];
    $writer = $_POST['writer'];
    $publisher = $_POST['publisher'];
    $pub_date = $_POST['pub_date'];
    $genre = $_POST['genre'];
    $price = $_POST['price'];
    $desc = $_POST['desc'];

    // 2. desc 파일 내용 변경
    $descFile = "../desc/{$title}";
    // 책 이름이 수정 되었다면 변경된 이름으로 파일 이름 수정하기
    if($title !== $_POST['originalTitle']) {
        rename('../desc/'.$_POST['originalTitle'], $descFile);
    }
    file_put_contents($descFile, $desc);
    
    // 3. 이미지 파일 처리
    $tempFile = $_FILES['imgFile']['tmp_name'];
    $resFile = "../images/{$_FILES['imgFile']['name']}";

    // 4. mysql 연결
    include '../config/rds.php';
    // $conn = mysqli_connect($host, $user, $pw, $db);
    $conn = mysqli_connect(getenv("RDS_HOST"), getenv("RDS_USER"), getenv("RDS_PW"), getenv("RDS_DB"));

    // 5. 원래 이미지를 사용하는지 안 하는지 확인
    if($_POST['originalCk'] === "on" || !$tempFile) {
        // 원래 imgsrc 데이터 가져오기
        $imgsrc = $_POST['originalImg'];

        // 쿼리문 정의 (특정 데이터 수정)
        $sqlstr = "update bestseller
                   set title='{$title}', writer='{$writer}', publisher='{$publisher}', pub_date='{$pub_date}', 
                   price={$price}, description='{$descFile}', imgsrc='{$imgsrc}', genre='{$genre}'
                   where no={$no}";
    }else {
        // 임시 저장된 이미지 파일을 새로 저장할 위치로 이동시킴
        $imgUpload = move_uploaded_file($tempFile, $resFile);

        // 쿼리문 정의 (특정 데이터 수정)
        $sqlstr = "update bestseller
                   set title='{$title}', writer='{$writer}', publisher='{$publisher}', pub_date='{$pub_date}', 
                   price={$price}, description='{$descFile}', imgsrc='{$resFile}', genre='{$genre}'
                   where no={$no}";
    }

    // 6. 쿼리문 수행 & 결과 확인
    $result = mysqli_query($conn, $sqlstr);

    if($result) {
?>
    <script>
        alert('수정이 완료되었습니다.');
        location.href = "../book_view.php?no=<?=$no?>";
    </script>
<?php
    }else {
        echo "오류가 발생하였습니다. 관리자에게 문의하세요.";
    }
?>