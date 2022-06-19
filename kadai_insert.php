
<?php
//以下はデータベース作成時のテンプレート！//

//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ

$booksname = $_POST['booksname'];
$booksurl = $_POST['booksurl'];
$bookscomment = $_POST['bookscomment'];


//2. DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  //xamppの設定だと、パスワードは不要。
  //IDパスワード入っているので、GIT HUBにアップロード不要。
  $pdo = new PDO('mysql:dbname=shienao_gs_db_books;charset=utf8;host=mysql57.shienao.sakura.ne.jp','shienao','mocha0428');
 // $pdo = new PDO('mysql:dbname=gs_db_books;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DBConnection Error:'.$e->getMessage());
  //errorがあったらメッセージがでるように。
}


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
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: kadai_index.php");
  exit();
  //そこまでしか実行しなくてよいですよ、の意味.
  

}
?>
