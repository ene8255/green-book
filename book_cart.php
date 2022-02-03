<?php include_once 'include/header.php'; ?>
    <main class="inner">
        <h2>장바구니</h2>
        <table id="cart">
            <tr>
                <th width="60%">상품정보</th>
                <th width="20%">가격</th>
                <th width="60%">삭제</th>
            </tr>
            <?php
                $count = 0;
                $result = mysql();
                while($row = mysqli_fetch_array($result)){
                    if(isset($_SESSION["{$row['title']}"])){
                        $imgsrc = explode("../", $row['imgsrc']);
                        $userPrice = $row['price']*0.9;
                        echo "<tr>";
                        echo "<td class='info'><img src='{$imgsrc[1]}' width='50'><span>{$row['title']}</span></td>";
                        if(isset($_SESSION['username'])){
                            echo "<td><span class='price'>{$row['price']}원</span><br>
                                  <span class='userPrice'>{$userPrice}원</span></td>";
                        }else{
                            echo "<td>{$row['price']}원</td>";
                        }
                        echo "<td>
                              <form action='process/del_cart_process.php' method='post'>
                                <input type='hidden' name='title' value='{$row['title']}'>
                                <input type='submit' value='X'>
                              </form>
                              </td>";
                        echo "</tr>";
                        $count++;
                    }
                }
                if($count == 0){
                    echo "<tr><td colspan='3'>장바구니에 담긴 상품이 없습니다.</td></tr>";
                }
            ?>
        </table>
    </main>
<?php include_once 'include/footer.php'; ?>
