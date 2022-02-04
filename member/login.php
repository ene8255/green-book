<?php include_once '../include/mem_header.php'; ?>
        <main>
            <h2>로그인</h2>
            <table id="login">
                <form action="../process/login_process.php" id="loginForm" method="post">
                    <tr>
                        <th>아이디</th>
                        <td><input type="text" name="userId" id="userId"></td>
                        <td rowspan="2">
                            <button id="loginBtn" class="btnStyle">로그인</button>
                        </td>
                    </tr>
                    <tr>
                        <th>비밀번호</th>
                        <td><input type="password" name="userPw" id="userPw"></td>
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
        const loginForm = document.querySelector('#loginForm');
        const loginBtn = document.querySelector('#loginBtn');
        const userid = document.querySelector('#userId');
        const userpw = document.querySelector('#userPw');
        loginBtn.addEventListener('click', function(){
            if(userid.value != "" && userpw.value != ""){
                if(userpw.value.length == 8){
                    loginForm.submit();
                }else{
                    alert("비밀번호는 8자리로 입력해주세요.");
                    return false;
                }
            }else{
                alert("아이디와 비밀번호를 입력해주세요.");
                return false;
            }
        });
    </script>
</body>
</html>