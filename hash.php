<?php
//password_hashを使うとpasswordを難読化できる
$pw = password_hash("test3", PASSWORD_DEFAULT);
echo $pw;
//password_verifyを使うと、難読化されたパスワードが、元のパスワードと正しいかを検証できる(システム管理者側にパスワードが知られないまま)
// var_dump(password_verify("test1", $pw));
?>