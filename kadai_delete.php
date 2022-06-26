<?php
//1. POSTデータ取得
$id = $_GET["id"];

//2. DB接続します
include("funcs.php");  //funcs.phpを読み込む（関数群）
try {
    //Password:MAMP='root',XAMPP=''
    //xamppの設定だと、パスワードは不要。
    $pdo = new PDO('mysql:dbname=shienao_gs_db_books;charset=utf8;host=mysql57.shienao.sakura.ne.jp','shienao','mocha0428');
    // $pdo = new PDO('mysql:dbname=gs_db_books;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DBConnection Error:'.$e->getMessage());
    //errorがあったらメッセージがでるように。
  }
//   $pdo = db_conn();      //DB接続関数

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
