<?php
//1. POSTデータ取得
$id = $_GET["id"];

//2. DB接続します
include("funcs.php");  //funcs.phpを読み込む（関数群）
sschk();

$pdo = db_conn();      //DB接続関数

//３．データ削除SQL作成
$sql = "delete from gs_bm_table where id=:id";
//whereを入れないとすべてのデータを削除することになる
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id',$id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ削除処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("kadai_select.php");
}

?>

git rm --cached<kadai_delete.php>