<?php include_once 'include/header.php'; ?>
    <main>
        <h2>장바구니</h2>
        <table id="cart" class="inner">
            <tr>
                <th width="60%">상품정보</th>
                <th width="20%">가격</th>
                <th width="60%">삭제</th>
            </tr>
            <?php
                $count = 0;
                $total = 0;
                $result = mysql();
                // 장바구니에 담긴 상품 표시
                while($row = mysqli_fetch_array($result)){
                    // 장바구니에 담긴 상품만 표시하기
                    if(isset($_SESSION["{$row['title']}"])){
                        // imgsrc 데이터는 가공하여 사용함 (이미지를 업로드 할때 앞에 붙여진 ../ 제거)
                        // $imgsrc = explode("../", $row['imgsrc']);
                        // 가격 데이터는 number_format 함수를 이용하여 천단위 마다 ,를 넣어줌
                        $price = number_format($row['price']);
                        // 로그인 되어 있는 경우에 표시할 가격
                        $userPrice = number_format($row['price'] * 0.9);
                        echo "<tr>";
                        echo "<td class='info'>
                                <img src='{$row['imgsrc']}' width='50'>
                                <span>{$row['title']}</span>
                              </td>";
                        // 로그인 되어 있는 경우와 아닌 경우 구분하기
                        if(isset($_SESSION['username'])){
                            echo "<td>
                                    <span class='price'>{$price}원</span>
                                    <br>
                                    <span class='userPrice'>{$userPrice}원</span>
                                  </td>";
                            $total += $row['price'] * 0.9;
                        }else{
                            echo "<td>{$price}원</td>";
                            $total += (int) $row['price'];
                        }
                        echo "<td>
                                <form id='deleteOne' action='process/del_one_process.php' method='post'>
                                    <input type='hidden' name='title' value='{$row['title']}'>
                                    <button type='submit'><i class='material-icons'>delete</i></button>
                                </form>
                              </td>";
                        echo "</tr>";
                        $count++;
                    }
                }
                // count가 0이면 장바구니에 담긴 상품이 없다고 표시하고 아니면 총합과 모두 삭제 버튼 표시
                if($count == 0){
                    echo "<tr>
                            <td colspan='3'>장바구니에 담긴 상품이 없습니다.</td>
                          </tr>";
                }else {
                    $totalPrice = number_format($total);
                    echo "<tr id='deleteAll'>
                            <th>총합 : </th>
                            <td>
                                <strong>{$totalPrice}원</strong>
                            </td>
                            <td>
                                <form id='deleteAll' action='process/del_all_process.php' method='post'>
                                    <button type='submit'>모두 삭제</button>
                                </form>
                            </td>
                          </tr>";
                }
            ?>
        </table>
    </main>
<?php include_once 'include/footer.php'; ?>
