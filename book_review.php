<?php include_once 'include/header.php'; ?>
    <?php
        // get 방식으로 전달받은 특정 no의 데이터만 가져옴
        $sqlstr =  "select * from bestseller where no={$_GET['no']}";
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
                            echo "<p class='price'><span>정가</span>{$price}원</p>";
                            echo "<p><span>회원가</span ><span class='userPrice'>{$userPrice}원</span></p>";
                        }else{
                            echo "<p><span>정가</span>{$price}원</p>";
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
                <a href="book_view.php?no=<?=$row['no']?>">책소개</a>
                <a href="book_review.php?no=<?=$row['no']?>" class="cur">책리뷰</a>
            </div>
        </section>
        <section id="view_content" class="inner">
            <div>
                <h3>리뷰 쓰기</h3>
                <form action="process/review_write_process.php" method="post">
                    <!-- 리뷰 작성하기 버튼을 클릭하면 숨겨진 input을 통해 title 데이터를 post 방식으로 전달해줌 -->
                    <input type="hidden" name="title" value="<?=$row['title']?>">
                    <table id="writeReview">
                        <?php
                            // 로그인 되어 있는 경우와 아닌 경우를 구분 (로그인 되어 있으면 리뷰 작성 가능)
                            if(isset($_SESSION['username'])){
                                echo "<tr>";
                                echo "<td class='txtCntr'>별점</td>";
                                echo "<td>
                                        <input type='text' name='star' id='star' placeholder='1~5' required> 
                                        / 5
                                      </td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td class='txtCntr'>감상평</td>";
                                echo "<td>
                                        <textarea name='comment' cols='80' rows='3'></textarea>
                                      </td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td colspan='2' class='txtCntr'>
                                      <button type='submit'>작성하기</button>
                                      <button type='reset'>취소</button>
                                      </td>";
                                echo "</tr>";
                            }else{
                                echo "<tr>
                                        <td>로그인 하시면 리뷰를 작성할 수 있습니다!</td>
                                      </tr>";
                            }
                        ?>
                    </table>
                </form>
            </div>
            <div>
            <h3>책 리뷰</h3>
                <ul class="cont">
                    <?php
                        // 변수 정의
                        $count = 0;
                        $sqlstr2 = "select * from review where title='{$row['title']}'";
                        $result2 = mysql($sqlstr2);
                        // 리뷰 결과값의 갯수만큼 li 요소 나타내기
                        while($row2 = mysqli_fetch_array($result2)){
                            // 가져온 id 데이터 가공
                            $id = $row2['id'];
                            $id[2] = '*';
                            $id[3] = '*';

                            echo "<li>{$id} ";
                            echo "<span class='reviewDate'>{$row2['date']}</span>";
                            for($i=0; $i<$row2['star']; $i++){
                                echo "⭐️";
                            }
                            echo "<br>";
                            echo "<br>";
                            echo "{$row2['comment']}</li>";
                            $count++;
                        }
                        // count가 0이라면 리뷰가 없다고 나타내기
                        if($count == 0){
                            echo "<li>아직 작성된 리뷰가 없습니다.</li>";
                        }
                    ?>
                </ul>
            </div>
        </section>
    </main>
<?php include_once 'include/footer.php'; ?>
