<?php include_once 'include/header.php'; ?>
        <main class="inner">
            <h2>책 등록하기</h2>
            <form action="process/book_register_process.php" method="post" enctype="multipart/form-data">
                <table class="bookForm">
                    <tr>
                        <th>책 제목</th>
                        <td><input type="text" name="title" required></td>
                    </tr>
                    <tr>
                        <th>작가</th>
                        <td><input type="text" name="writer" required></td>
                    </tr>
                    <tr>
                        <th>출판사</th>
                        <td><input type="text" name="publisher" required></td>
                    </tr>
                    <tr>
                        <th>출판일</th>
                        <td>
                            <input type="text" name="pub_date" placeholder="yyyy-mm-dd 형식으로 입력" required>
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
                                        echo "<option value={$g}>{$g}</option>";
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>가격</th>
                        <td>
                            <input type="text" name="price" placeholder="숫자만 입력" required>
                        </td>
                    </tr>
                    <tr>
                        <th>책 설명</th>
                        <td>
                            <textarea name="desc" id="desc" cols="40" rows="10" required></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>사진</th>
                        <td><input type="file" name="imgFile" accept="image/*" required></td>
                    </tr>
                </table>
                <ul class="formBtns">
                    <li><button type="submit" class="btnStyle">등록하기</button></li>
                    <li><button type="reset" class="btnStyle">취소</button></li>
                </ul>
            </form>
        </main>
<?php include_once 'include/footer.php'; ?>
