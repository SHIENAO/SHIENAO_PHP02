<?php
//1. POSTデータ取得
$booksname   = $_POST["booksname"];
$booksurl  = $_POST["booksurl"];
$bookscomment = $_POST["bookscomment"];
$id    = $_POST["id"];   //idを取得

//2. DB接続します
include("funcs.php");  //funcs.phpを読み込む（関数群）

  
$pdo = db_conn();      //DB接続関数


//３．データ登録SQL作成
$sql = "UPDATE gs_bm_table SET booksname=:booksname, booksurl=:booksurl, bookscomment=:bookscomment WHERE id=:id";//更新処理
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':booksname',  $booksname,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':booksurl', $booksurl,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookscomment',$bookscomment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id,  PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("kadai_select.php");
}
?>

git rm --cached<kadai_update.php>