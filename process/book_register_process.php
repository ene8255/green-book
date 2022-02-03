<?php
    $title = $_POST['title'];
    $writer = $_POST['writer'];
    $publisher = $_POST['publisher'];
    $pub_date = $_POST['pub_date'];
    $price = $_POST['price'];
    $desc = $_POST['desc'];

    $fileTypeArr = explode("/", $_FILES['imgFile']['type']);
    $fileType = $fileTypeArr[0];
    $fileExt = $fileTypeArr[1];

    if($title!="" && $writer!="" && $publisher!="" && $pub_date!="" && $price!="" && $desc!=""){
        if($fileType == "image"){
            if($fileExt == "jpeg" || $fileExt == "jpg" || $fileExt == "png" || $fileExt == "gif"){
                $tempFile = $_FILES['imgFile']['tmp_name'];
                $resFile = "../images/{$_FILES['imgFile']['name']}";
                $imgUpload = move_uploaded_file($tempFile, $resFile);

                $descFile = "../desc/{$title}";
                file_put_contents($descFile, $desc);

                $conn = mysqli_connect('localhost', 'root', '1234', 'green_book');
                $sqlstr =  "insert into bestseller(title, writer, publisher, pub_date, price, description, imgsrc)
                            values('{$title}', '{$writer}', '{$publisher}', '{$pub_date}', '{$price}', '{$descFile}', '{$resFile}')";
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
    }else{
?>
    <script>
        alert("모든 칸에 내용을 적어주세요!");
        history.back();
    </script>
<?php
    }
?>
    
