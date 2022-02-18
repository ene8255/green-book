<?php include_once 'include/header.php'; ?>
    <?php
        // 특정 회원의 정보 가져오기
        $sqlstr = "select * from member where no={$_POST['no']}";
        $result = mysql($sqlstr);
        $row = mysqli_fetch_array($result);
    ?>
        <main>
            <h2>비밀번호 변경</h2>
            <form action="process/pw_edit_process.php" method="post" id="editForm">
                <input type="hidden" name="no" value="<?=$row['no']?>">
                <table id="join">
                    <tr>
                        <th>이름</th>
                        <td>
                            <input type="text" name="userName" id="userName" value="<?=$row['name']?>" disabled>
                        </td>
                    </tr>
                    <tr>
                        <th>아이디</th>
                        <td>
                            <input type="text" name="userId" id="userId" value="<?=$row['id']?>" disabled>
                        </td>
                    </tr>
                    <tr>
                        <th>비밀번호</th>
                        <td>
                            <input type="text" name="userPw" id="userPw" placeholder="비밀번호는 8자리 이상으로 입력해주세요" value="<?=$row['pw']?>" required>
                        </td>
                    </tr>
                    <tr>
                        <th>비밀번호확인</th>
                        <td>
                            <input type="password" name="userPwch" id="userPwch" placeholder="비밀번호와 일치하게 입력해주세요" value="<?=$row['pw']?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="button" id="editButton" class="btnStyle">변경하기</button>
                            <button type="reset" class="btnStyle">취소</button>
                        </td>
                    </tr>
                </table>
            </form>
        </main>
        <footer>
            <div class="inner">
                <address>copyright (c) all rights reserved.</address>
                <h1>Green Book</h1>
            </div>
        </footer>
    </div>
    <script>
        // 변수 정의
        const editForm = document.querySelector('#editForm');
        const editBtn = document.querySelector('#editButton');
        const pw = document.querySelector('#userPw');
        const pwch = document.querySelector('#userPwch');
        const id = document.querySelector('#userId');
        const name = document.querySelector('#userName');
    
        // 변경하기 버튼을 클릭하면 이벤트가 실행됨
        editBtn.addEventListener('click',function(){
            // 모든 input에 value가 있는지 확인
            if(pw.value !== "" && pwch.value !== "") {
                // 비밀번호가 8자리 이상인지 확인
                if(pw.value.length >= 8){
                    // 비밀번호와 비밀번호확인의 값이 같은지 확인
                    if(pw.value == pwch.value){
                        editForm.submit();
                    }else {
                        alert('비밀번호와 비밀번호확인이 일치하지 않습니다.');
                        return false;
                    }
                }else {
                    alert('비밀번호는 8자리 이상이어야 합니다.');
                    return false;
                }
            }else {
                alert('모든 입력칸을 채워주세요!');
                return false;
            }
        })
    </script>
</body>
</html>
