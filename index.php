<?php include_once 'include/header.php'; ?>
    <main class="inner">
        <h2>베스트셀러</h2>
        <ul id="best">
            <?php
                $result = mysql();
                // db의 베스트셀러 테이블 행의 갯수만큼 li 요소 생성
                while($row = mysqli_fetch_array($result)){
                    // imgsrc 데이터는 가공하여 사용함 (이미지를 업로드 할때 앞에 붙여진 ../ 제거)
                    $imgsrc = explode("../", $row['imgsrc']);
                    echo "<li>
                            <a href='book_view.php?no={$row['no']}'>
                                <img src='{$imgsrc[1]}' alt='책 표지' width='200' height='300'>
                            </a>
                          </li>";
                }
            ?>
        </ul>
        <p id="register" class="btnStyle">
            <a href="book_register.php">책 등록하기</a>
        </p>
    </main>
<?php include_once 'include/footer.php'; ?>