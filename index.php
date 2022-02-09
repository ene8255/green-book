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
    <!-- carousel slider -->
    <section id="slider" class="inner">
        <div id="slide-group-view">
            <div id="slide-group">
                <img src="banners/banner1.png" alt="2022 베스트셀러" class="slide-img">
                <img src="banners/banner2.png" alt="로그인하고 책리뷰 작성" class="slide-img">
                <img src="banners/banner3.png" alt="회원가입하면 10% 할인" class="slide-img">
            </div>
        </div>
        <ul id="nav">
            <li id="prev">
                <i class='material-icons'>arrow_back_ios</i>
            </li>
            <li id="next">
                <i class='material-icons'>arrow_forward_ios</i>
            </li>
        </ul>
    </section>
    <!-- carousel slider // -->
    <main class="inner">
        <h2>베스트셀러</h2>
        <div id="sortBook">
            <span>분야</span>
            <form action="" method="post">
                <select name="Genre">
                    <option value="">전체보기</option>
                    <?php
                        $result = mysql();
                        // genre라는 배열을 생성하여 genre 데이터만 담기
                        $genre = array();
                        while($row = mysqli_fetch_array($result)) {
                            $genre[] = $row['genre'];
                        }
                        // genre 배열에서 중복 제거
                        $uniGenre = array_unique($genre);
                        // genre 배열의 값의 갯수만큼 select의 option 요소 생성
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
                // 위의 form이 submit 되었는지 아닌지 확인
                if(isset($_POST['gSubmit'])) {
                    // Genre값이 비어 있는지 아닌지 확인
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
        <?php
            // 관리자 계정으로 로그인 되어 있는 경우에만 책 등록하기 버튼 표시
            if(isset($_SESSION['admin'])) {
                echo '<p id="register" class="btnStyle">
                        <a href="book_register.php">책 등록하기</a>
                      </p>';
            }
        ?>
    </main>
<?php include_once 'include/footer.php'; ?>