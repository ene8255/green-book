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
                <a href="book_view.php?no=<?=$row['no']?>">책소개</a>
                <a href="book_review.php?no=<?=$row['no']?>" class="cur">책리뷰</a>
            </div>
        </section>
        <section id="view_content" class="inner">
            <div>
                <h3>리뷰 쓰기</h3>
                <form action="process/review_write.php" method="post">
                    <input type="hidden" name="title" value="<?=$row['title']?>">
                    <table id="writeReview">
                        <?php
                            if(isset($_SESSION['username'])){
                                echo "<tr>";
                                echo "<td class='txtCntr'>별점</td>";
                                echo "<td><input type='text' name='star' id='star'> / 5</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td class='txtCntr'>감상평</td>";
                                echo "<td><textarea name='comment' cols='80' rows='3'></textarea></td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td colspan='2' class='txtCntr'>
                                      <button type='submit'>작성하기</button>
                                      <button type='reset'>취소</button>
                                      </td>";
                                echo "</tr>";

                            }else{
                                echo "<tr><td>로그인 하시면 리뷰를 작성할 수 있습니다!</td></tr>";
                            }
                        ?>
                    </table>
                </form>
            </div>
            <div>
            <h3>책 리뷰</h3>
                <ul class="cont">
                    <?php
                        $sqlstr2 = "select * from review where title='{$row['title']}'";
                        $result2 = mysql($sqlstr2);
                        while($row2 = mysqli_fetch_array($result2)){
                            echo "<li>{$row2['id']} ";
                            echo "<span class='reviewDate'>{$row2['date']}</span>";
                            for($i=0; $i<$row2['star']; $i++){
                                echo "⭐️";
                            }
                            echo "<br>";
                            echo "<br>";
                            echo "{$row2['comment']}</li>";
                        }
                    ?>
                </ul>
            </div>
        </section>
    </main>
<?php include_once 'include/footer.php'; ?>
