<?php include_once 'include/header.php'; ?>
    <main class="inner">
        <h2>베스트셀러</h2>
        <ul id="best">
            <?php
                $result = mysql();
                while($row = mysqli_fetch_array($result)){
                    $imgsrc = explode("../", $row['imgsrc']);
                    echo "<li><a href='book_view.php?no={$row['no']}'><img src='{$imgsrc[1]}' width='200'></a></li>";
                }
            ?>
        </ul>
        <p id="register" class="btnStyle"><a href="book_register.php">책 등록하기</a></p>
    </main>
<?php include_once 'include/footer.php'; ?>