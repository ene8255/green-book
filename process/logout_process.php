<?php
    // 세션 삭제하기
    session_start();
    unset($_SESSION['username']);
?>
<script>
    alert('로그아웃 되셨습니다.');
    history.back();
</script>