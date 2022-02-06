<?php
    $title = $_POST['title'];
    $writer = $_POST['writer'];
    $publisher = $_POST['publisher'];
    $pub_date = $_POST['pub_date'];
    $genre = $_POST['genre'];
    $price = $_POST['price'];
    $desc = $_POST['desc'];

    $fileTypeArr = explode("/", $_FILES['imgFile']['type']);
    $fileType = $fileTypeArr[0];
    $fileExt = $fileTypeArr[1];

    if($fileType == "image"){
        if($fileExt == "jpeg" || $fileExt == "jpg" || $fileExt == "png" || $fileExt == "gif"){
            $tempFile = $_FILES['imgFile']['tmp_name'];
            $resFile = "../images/{$_FILES['imgFile']['name']}";
            $imgUpload = move_uploaded_file($tempFile, $resFile);

            $descFile = "../desc/{$title}";
            file_put_contents($descFile, $desc);

            // 다른 파일에서 데이터베이스 정보 가져오기
            include '../config/rds.php';
            $conn = mysqli_connect($host, $user, $pw, $db);
            $sqlstr =  "insert into bestseller(title, writer, publisher, pub_date, price, description, imgsrc, genre)
                        values('{$title}', '{$writer}', '{$publisher}', '{$pub_date}', '{$price}', '{$descFile}', '{$resFile}', '{$genre}')";
            $result = mysqli_query($conn, $sqlstr);
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
    
