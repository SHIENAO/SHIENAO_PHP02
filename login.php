<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="css/main.css" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
<title>ログイン</title>
</head>
<body>

<header>
  <nav class="navbar navbar-default">LOGIN</nav>
</header>

<!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
<!--postでlogin_act.phpに情報をlid,lpwという名前で渡しに行く-->
<form name="form1" action="login_act.php" method="post">
ID:<input type="text" name="lid" />
<!-- type passwordにすることで布施も字にできる-->
PW:<input type="password" name="lpw" />
<input type="submit" value="LOGIN" />
</form>


</body>
</html>