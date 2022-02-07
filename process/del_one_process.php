<?php
    session_start();
    // cart에 담은 상품의 세션 종료
    unset($_SESSION["{$_POST['title']}"]);
?>
<script>
    alert('상품이 장바구니에서 삭제되었습니다.');
    history.back();
</script>