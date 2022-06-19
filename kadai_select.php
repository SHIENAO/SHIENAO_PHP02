<?php

require_once('funcs.php');

//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  //xamppの設定だと、パスワードは不要。
  $pdo = new PDO('mysql:dbname=gs_db_books;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DBConnection Error:'.$e->getMessage());
  //errorがあったらメッセージがでるように。
}

//２．データ取得SQL作成

$stmt = $pdo->prepare("select * from gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= "<p>";
    $view .=$res["booksname"].", ".$res["booksurl"].", ".$res["bookscomment"];
    //
    $view .="</p>";
  }

}
// resの中身を配列に格納して、HTML側で呼び出したい
//$res = array(["booksname"],["booksurl"],["bookscomment"]);

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>お気に入り本　ブックマーク</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="kadai_index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?php echo $view;?></div>
    

</div>
<!-- Main[End] -->

</body>
</html>
