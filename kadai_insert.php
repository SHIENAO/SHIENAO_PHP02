
<?php
//以下はデータベース作成時のテンプレート！//

//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ

$booksname = $_POST['booksname'];
$booksurl = $_POST['booksurl'];
$bookscomment = $_POST['bookscomment'];


//2. DB接続します


$pdo = db_conn();      //DB接続関数

//３．データ登録SQL作成

$stmt = $pdo->prepare("INSERT INTO gs_bm_table(booksname, booksurl, bookscomment, datatime) VALUES(:booksname, :booksurl, :bookscomment, sysdate())");
$stmt->bindValue(':booksname', $booksname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT) コロン＝バインドバリュー　：置き換えたいもの、置き換えたいデータ
$stmt->bindValue(':booksurl', $booksurl, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookscomment', $bookscomment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();
 //SQLの実行

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  if($status==false)
    sql_error($stmt);
}else{
  //５．index.phpへリダイレクト
  header("Location: kadai_index.php");
  exit();
  //そこまでしか実行しなくてよいですよ、の意味.


}
?>

git rm --cached<kadai_insert.php>