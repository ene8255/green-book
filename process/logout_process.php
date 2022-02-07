<?php
    session_start();
    // 세션 삭제하기
    unset($_SESSION['username']);
    unset($_SESSION['admin']);
?>
<script>
    // 세션 삭제 후 로그아웃 확인창 띄우고, 이전 페이지로 이동
    alert('로그아웃 되셨습니다.');
    history.back();
</script>