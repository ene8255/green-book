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
        <h2>책 수정하기</h2>
        <form action="process/book_edit_process.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="no" value="<?=$row['no']?>">
            <table class="bookForm inner">
                <tr>
                    <th>책 제목</th>
                    <td>
                        <input type="hidden" name="originalTitle" value="<?=$row['title']?>">
                        <input type="text" name="title" value="<?=$row['title']?>" required>
                    </td>
                </tr>
                <tr>
                    <th>작가</th>
                    <td><input type="text" name="writer" value="<?=$row['writer']?>" required></td>
                </tr>
                <tr>
                    <th>출판사</th>
                    <td><input type="text" name="publisher" value="<?=$row['publisher']?>" required></td>
                </tr>
                <tr>
                    <th>출판일</th>
                    <td>
                        <input type="text" name="pub_date" placeholder="yyyy-mm-dd 형식으로 입력" value="<?=$row['pub_date']?>" required>
                    </td>
                </tr>
                <tr>
                    <th>책 분야</th>
                    <td>
                        <select name="genre" required>
                            <option value="">선택하기</option>
                            <?php
                                $genres = ['소설', '시/에세이', '경제/경영', '자기계발', '인문', '역사/문화', '종교', '정치/사회', '예술/대중문화', '과학', '기술/공학', '컴퓨터/IT', '어린이', '청소년', '외국어', '가정/육아', '건강', '여행', '요리', '취미'];
                                foreach($genres as $g) {
                                    if($g === $row['genre']) {
                                        echo "<option value={$g} selected>{$g}</option>";
                                    }else {
                                        echo "<option value={$g}>{$g}</option>";
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>가격</th>
                    <td>
                        <input type="text" name="price" placeholder="숫자만 입력" value="<?=$row['price']?>" required>
                    </td>
                </tr>
                <tr>
                    <th>책 설명</th>
                    <td>
                        <textarea name="desc" id="desc" cols="40" rows="10" required
                        ><?php
                                $contents = file_get_contents('desc/'.$row['title']);
                                echo $contents;
                        ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th>사진</th>
                    <td>
                        <input type="file" name="imgFile" accept="image/*">
                        <p id="originalCk">
                            <input type="checkbox" name="originalCk"> 원래 이미지 사용하기
                            <input type="hidden" name="originalImg" value="<?=$row['imgsrc']?>">
                        </p>
                    </td>
                </tr>
            </table>
            <ul class="formBtns">
                <li><button type="submit" class="btnStyle">수정하기</button></li>
                <li><button type="reset" class="btnStyle">원래대로</button></li>
            </ul>
        </form>
    </main>
<?php include_once 'include/footer.php'; ?>