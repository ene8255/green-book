<?php
    session_start();
    unset($_SESSION["{$_POST['title']}"]);
?>
<script>
    alert('상품이 장바구니에서 삭제되었습니다.');
    history.back();
</script>