<?php include_once '../include/mem_header.php'; ?>
        <main>
            <h2>로그인</h2>
            <table id="login">
                <form action="../process/login_process.php" id="loginForm" method="post">
                    <tr>
                        <th>아이디</th>
                        <td>
                            <input type="text" name="userId" id="userId" required>
                        </td>
                        <td rowspan="2">
                            <button id="loginBtn" class="btnStyle">로그인</button>
                        </td>
                    </tr>
                    <tr>
                        <th>비밀번호</th>
                        <td>
                            <input type="password" name="userPw" id="userPw" required>
                        </td>
                    </tr>
                </form>
            </table>
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
        const loginForm = document.querySelector('#loginForm');
        const loginBtn = document.querySelector('#loginBtn');
        const userid = document.querySelector('#userId');
        const userpw = document.querySelector('#userPw');

        // 로그인 버튼 클릭시 이벤트 실행
        loginBtn.addEventListener('click', function(){
            // 비밀번호의 길이가 8 자리 이상일때만 form이 submit 됨
            if(userpw.value.length >= 8){
                loginForm.submit();
            }else{
                alert("비밀번호는 8자리 이상이어야 합니다.");
                return false;
            }
        });
    </script>
</body>
</html>