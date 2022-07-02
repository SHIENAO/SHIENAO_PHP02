<?php
//最初にSESSIONを開始！！ココ大事！！
session_start();

//POST値 POSTからもってくる値(login.php)
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];


//1.  DB接続します
include("funcs.php");
$pdo = db_conn();

//2. データ登録SQL作成
//* PasswordがHash化→条件はlidのみ！！2分目参照
//select * table => tableから情報を持ってきてくださいね。＋条件:id とPWが両方一致するユーザー(bind変数)
// $stmt = $pdo->prepare("select * from gs_user_table where lid = :lid and lpw =:lpw"); 
$stmt = $pdo->prepare("select * from gs_user_table where lid = :lid"); 
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
// $stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()



//5.該当１レコードがあればSESSIONに値を代入
//入力したPasswordと暗号化されたPasswordを比較！[戻り値：true,false]
//hash化する場合には以下を活かす
$pw = password_verify($lpw, $val["lpw"]);
 //もしidがカラじゃない場合
// if($val["id"] != ""){ 
if($pw){ 
  //Login成功時
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["kanri_flg"] = $val['kanri_flg'];
  $_SESSION["name"]      = $val['name'];
  //Login成功時（リダイレクト）
  redirect("kadai_select.php");
}else{
  //Login失敗時(Logoutを経由：リダイレクト)
  redirect("login.php");
}

exit();


