<?php include_once 'include/header.php'; ?>
        <main class="inner">
            <h2>책 등록하기</h2>
            <form action="process/book_register_process.php" method="post" enctype="multipart/form-data">
                <table id="reg">
                    <tr>
                        <th>책 제목</th>
                        <td><input type="text" name="title"></td>
                    </tr>
                    <tr>
                        <th>작가</th>
                        <td><input type="text" name="writer"></td>
                    </tr>
                    <tr>
                        <th>출판사</th>
                        <td><input type="text" name="publisher"></td>
                    </tr>
                    <tr>
                        <th>출판일</th>
                        <td>
                            <input type="text" name="pub_date" placeholder="yyyy-mm-dd 형식으로 입력">
                        </td>
                    </tr>
                    <tr>
                        <th>가격</th>
                        <td>
                            <input type="text" name="price" placeholder="숫자만 입력">
                        </td>
                    </tr>
                    <tr>
                        <th>책 설명</th>
                        <td>
                            <textarea name="desc" id="desc" cols="50" rows="10"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>사진</th>
                        <td><input type="file" name="imgFile"></td>
                    </tr>
                </table>
                <ul id="regBtns">
                    <li><button type="submit" class="btnStyle">등록하기</button></li>
                    <li><button type="reset" class="btnStyle">취소</button></li>
                </ul>
            </form>
        </main>
<?php include_once 'include/footer.php'; ?>
