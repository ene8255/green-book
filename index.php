<?php include_once 'include/header.php'; ?>
<?php
    function showMainBooks($str="select * from bestseller") {
        $result = mysql($str);
        // 가져온 데이터 갯수만큼 li 요소 생성
        while($row = mysqli_fetch_array($result)) {
            // imgsrc 데이터는 가공하여 사용함 (이미지를 업로드 할때 앞에 붙여진 ../ 제거)
            $imgsrc = explode("../", $row['imgsrc']);
            echo "<li>
                    <a href='book_view.php?no={$row['no']}'>
                        <img src='{$imgsrc[1]}' alt='책 표지' width='200' height='300'>
                    </a>
                  </li>";
        }
    }
?>
    <main class="inner">
        <h2>베스트셀러</h2>
        <div id="sortBook">
            <span>분야</span>
            <form action="" method="post">
                <select name="Genre">
                    <option value="">전체보기</option>
                    <?php
                        $result = mysql();
                        $genre = array();
                        while($row = mysqli_fetch_array($result)) {
                            $genre[] = $row['genre'];
                        }
                        $uniGenre = array_unique($genre);
                        foreach($uniGenre as $g) {
                            echo "<option value={$g}>$g</option>";
                        }
                    ?>
                </select>
                <button type="submit" name="gSubmit">선택</button>
            </form>
        </div>
        <ul id="best">
            <?php
                if(isset($_POST['gSubmit'])) {
                    if(!empty($_POST['Genre'])) {
                        $selected = $_POST['Genre'];
                        $sqlstr = "select * from bestseller where genre = '{$selected}'";
                        showMainBooks($sqlstr);
                    }else {
                        showMainBooks();
                    }
                }else {
                    showMainBooks();
                }
            ?>
        </ul>
        <p id="register" class="btnStyle">
            <a href="book_register.php">책 등록하기</a>
        </p>
    </main>
<?php include_once 'include/footer.php'; ?>