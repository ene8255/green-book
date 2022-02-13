<?php
    // POST 방식으로 받은 데이터를 변수로 정의
    $title = $_POST['title'];
    $writer = $_POST['writer'];
    $publisher = $_POST['publisher'];
    $pub_date = $_POST['pub_date'];
    $genre = $_POST['genre'];
    $price = $_POST['price'];
    $desc = $_POST['desc'];

    // 이미지 파일의 type 정보 가져와서 가공하기
    $fileTypeArr = explode("/", $_FILES['imgFile']['type']);
    $fileType = $fileTypeArr[0];
    $fileExt = $fileTypeArr[1];

    // filetype이 image인지 아닌지 확인
    if($fileType == "image"){
        // file 확장자가 특정한 형식인지 확인
        if($fileExt == "jpeg" || $fileExt == "jpg" || $fileExt == "png" || $fileExt == "gif"){
            // 1. 이미지 파일
            // 임시 저장된 파일의 이름 
            $tempFile = $_FILES['imgFile']['tmp_name'];
            // 새로 저장할 위치와 이름 지정
            $resFile = "../images/{$_FILES['imgFile']['name']}";
            // 임시 저장된 파일을 새로 저장할 위치로 이동시킴
            $imgUpload = move_uploaded_file($tempFile, $resFile);

            // 2. desc 파일
            // 책 설명 데이터는 desc 폴더에 새 파일 생성후 넣어줌
            $descFile = "../desc/{$title}";
            file_put_contents($descFile, $desc);

            // 3. mysql 연결 & 쿼리 수행
            // 다른 파일에서 데이터베이스 정보 가져오기
            include '../config/rds.php';
            // mysql 연결
            // $conn = mysqli_connect($host, $user, $pw, $db);
            $conn = mysqli_connect(getenv("RDS_HOST"), getenv("RDS_USER"), getenv("RDS_PW"), getenv("RDS_DB"));
            // 쿼리문 정의 (bestseller 테이블에 데이터 추가)
            $sqlstr =  "insert into bestseller(title, writer, publisher, pub_date, price, description, imgsrc, genre)
                        values('{$title}', '{$writer}', '{$publisher}', '{$pub_date}', '{$price}', '{$descFile}', '{$resFile}', '{$genre}')";
            // 쿼리문 수행
            $result = mysqli_query($conn, $sqlstr);
            
            // 4. index 페이지로 이동
            header("Location: ../index.php");
        }
    }else{
?>
        <script>
            alert('jpeg, jpg, png, gif 파일만 업로드 가능합니다.');
            history.back();
        </script>
<?php          
    }
?>
    
