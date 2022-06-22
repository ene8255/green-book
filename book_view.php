<?php include_once 'include/header.php'; ?>
    <?php
        // get 방식으로 전달받은 특정 no의 데이터만 가져옴
        $sqlstr = "select * from bestseller where no={$_GET['no']}";
        $result = mysql($sqlstr);
        $row = mysqli_fetch_array($result);
        // imgsrc 데이터는 가공하여 사용함
        // $imgsrc = explode("../", $row['imgsrc']);
    ?>
    <main>
        <section id="view_top" class="inner">
            <p>
                <img src="<?=$row['imgsrc']?>" width="300">
            </p>
            <h2><?=$row['title']?></h2>
        </section>
        <section id="view_middle" class="inner">
            <ul>
                <li>
                    <span>작가</span><?=$row['writer']?>
                </li>
                <li>
                    <span>출판사</span><?=$row['publisher']?>
                </li>
                <li>
                    <span>출판일</span><?=$row['pub_date']?>
                </li>
            </ul>
            <div>
                <div>
                    <?php
                        // price 데이터는 가공하여 사용함
                        // number_format 함수를 이용하여 천단위 마다 ,를 넣어줌
                        $price = number_format($row['price']);
                        // 로그인이 되어 있는 상태라면 표시할 가격 데이터 (10% 할인된 가격)
                        $userPrice = number_format($row['price'] * 0.9);

                        // 로그인 되어 있는 경우와 아닌 경우를 구분하여 가격 표시
                        if(isset($_SESSION['username'])){
                            echo "<p class='price'>
                                    <span>정가</span>{$price}원 
                                  </p>";
                            echo "<p>
                                    <span>회원가</span >
                                    <span class='userPrice'>{$userPrice}원</span>
                                  </p>";
                        }else{
                            echo "<p>
                                    <span>정가</span>{$price}원
                                  </p>";
                        }
                    ?>
                </div>
                <form action="process/add_cart_process.php" method="post">
                    <!-- 장바구니 담기 버튼을 클릭하면 숨겨진 input을 통해 title 데이터를 post 방식으로 전달해줌 -->
                    <input type="hidden" name="title" value="<?=$row['title']?>">
                    <button type="submit" class="btnStyle">장바구니 담기</button>
                </form>
            </div>
        </section>
        <section id="view_bottom">
            <div class="inner">
                <a href="book_view.php?no=<?=$row['no']?>" class="cur">책소개</a>
                <a href="book_review.php?no=<?=$row['no']?>">책리뷰</a>
            </div>
        </section>
        <section id="view_content" class="inner">
            <h3>책 소개</h3>
            <p class="cont">
                <!-- desc 폴더의 파일 중에서 이름이 title과 같은 파일의 내용을 가져옴 -->
                <?php
                    $contents = file_get_contents('desc/'.$row['title']);
                    // 가져온 텍스트 데이터 개행문자 처리 (줄바꿈)
                    echo nl2br($contents);
                ?>
            </p>
        </section>
        <?php
            // 관리자 계정으로 로그인 되어 있으면 수정하기와 삭제하기 버튼 보여주기
            if(isset($_SESSION['admin'])) {
                $no = $row['no'];
                echo "<section id='adminBtns' class='inner'>
                        <a href='book_edit.php?no={$no}'>수정하기</a>
                        <form action='process/book_del_process.php' method='post'>
                            <input type='hidden' name='imgsrc' value='{$row['imgsrc']}'>
                            <button type='submit'>삭제하기</button>
                        </form>
                      </section>";
            }
        ?>
    </main>
<?php include_once 'include/footer.php'; ?>