<?php include_once 'include/header.php'; ?>
    <?php
        // 로그인 되어 있는 상태라면 member 테이블에서 회원 정보 가져오기
        // 로그인이 되어 있지 않은 상태라면 마이페이지 접근 불가
        session_start();
        if(isset($_SESSION['username']) || isset($_SESSION['admin'])){
            $name = $_SESSION['username'] ?? $_SESSION['admin'];
            $sqlstr = "select * from member where name='{$name}'";
            $result = mysql($sqlstr);
            $row = mysqli_fetch_array($result);
        }else {
    ?>
        <script>
            alert('마이페이지에 접속하려면 로그인이 필요합니다!');
            location.href = "index.php";
        </script>
    <?php
        }
    ?>
    <main id="mypage">
        <h2>마이페이지</h2>
        <div id="accountInfo" class="inner">
            <h3>계정 정보</h3>
            <table>
                <thead>
                    <tr>
                        <th>이름</th>
                        <th>아이디</th>
                        <th>가입날짜</th>
                        <th>비밀번호 변경</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?=$row['name']?></td>
                        <td><?=$row['id']?></td>
                        <td>
                            <?php
                                $date = explode(" ", $row['date']);
                                echo $date[0];
                            ?>
                        </td>
                        <td>
                            <form action="pw_edit.php" method="post">
                                <input type="hidden" name="no" value="<?=$row['no']?>">
                                <button type="submit">변경하기</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="userReview" class="inner">
            <h3>작성한 리뷰</h3>
            <ul>
                <?php
                    // 작성한 리뷰가 있다면 리스트를 보여주고, 없다면 없다고 나타냄
                    $count = 0;
                    $sqlstr2 = "select * from review where id='{$row['id']}'";
                    $result2 = mysql($sqlstr2);
                    while($row2 = mysqli_fetch_array($result2)) {
                        echo "<li>";
                        echo "<strong>{$row2['title']} </strong>";
                        echo "<div class='right'>
                                <span class='reviewDate'>{$row2['date']}</span>
                                <form action='process/review_del_process.php' method='post' class='reviewDel'>
                                    <input type='hidden' name='no' value='{$row2['no']}'>
                                    <button type='submit'>삭제</button>
                                </form>
                              </div>";
                        for($i=0; $i<$row2['star']; $i++){
                            echo "⭐️";
                        }
                        echo "<br>";
                        echo "<br>";
                        echo "{$row2['comment']}";
                        echo "</li>";
                        $count++;
                    }
                    if($count == 0){
                        echo "<li>아직 작성하신 리뷰가 없습니다.</li>";
                    }
                ?>
            </ul>
        </div>
    </main>
<?php include_once 'include/footer.php'; ?>
