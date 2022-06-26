<?php

$id = $_GET["id"]; //GET通信でidをとってくる

//////////////////////////////////////////////
//select.phpの[PHPコードだけ！]をマルっとコピー
//※SQLとデータ取得の箇所を修正します。
//require_once('funcs.php');
include("funcs.php");

//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  //xamppの設定だと、パスワードは不要。
    $pdo = new PDO('mysql:dbname=shienao_gs_db_books;charset=utf8;host=mysql57.shienao.sakura.ne.jp','shienao','mocha0428');
//   $pdo = new PDO('mysql:dbname=gs_db_books;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DBConnection Error:'.$e->getMessage());
  //errorがあったらメッセージがでるように。
}

//２．データ取得SQL作成

//$stmt = $pdo->prepare("select * from gs_bm_table");
$stmt   = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id"); //SQLをセット
$stmt->bindValue(':id',   $id,    PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
    if($status==false){
        sql_error($stmt);
    }else{
        redirect("kadai_select.php");
    }

}else{
    $row = $stmt->fetch();
    // var_dump($row);
    //1つのデーターを取り出して$rowに格納

//元の記載
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  
  //while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
    // $view .= "<p>";
    // $view .=$res["booksname"].", ".$res["booksurl"].", ".$res["bookscomment"];
    // //
    // $view .="</p>";
  //}

}
// resの中身を配列に格納して、HTML側で呼び出したい
//$res = array(["booksname"],["booksurl"],["bookscomment"]);

?>
git rm --cached<kadai_detail.php>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="kadai_select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="kadai_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>お気に入り登録</legend>
     <label>本の名前：<input type="text" name="booksname" value="<?=$row["booksname"]?>"></label><br>
     <label>URL：<input type="text" name="booksurl" value="<?=$row["booksurl"]?>"></label><br>
     <label><textArea name="bookscomment" rows="4" cols="40"><?=$row["bookscomment"]?></textArea></label><br>
     <!-- idを隠して送信 -->
     <input type="hidden" name="id" value="<?=$row["id"]?>">
     <!-- idを隠して送信 -->
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
