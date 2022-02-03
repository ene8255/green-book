<?php include_once 'include/header.php'; ?>
    <?php
        $sqlstr =  "select * from bestseller where no={$_GET['no']}";
        $result = mysql($sqlstr);
        $row = mysqli_fetch_array($result);
        $imgsrc = explode("../", $row['imgsrc']);
    ?>
    <main>
        <section id="view_top" class="inner">
            <p><img src="<?=$imgsrc[1]?>" width="300"></p>
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
                        $userPrice = $row['price']*0.9;
                        if(isset($_SESSION['username'])){
                            echo "<p class='price'><span>정가</span>{$row['price']}원</p>";
                            echo "<p><span>회원가</span ><span class='userPrice'>{$userPrice}원</span></p>";
                        }else{
                            echo "<p><span>정가</span>{$row['price']}원</p>";
                        }
                    ?>
                </div>
                <form action="process/add_cart_process.php" method="post">
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
            <p class="cont"><?=file_get_contents('desc/'.$row['title'])?></p>
        </section>
    </main>
<?php include_once 'include/footer.php'; ?>
