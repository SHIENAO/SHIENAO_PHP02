<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Favorite Books Database</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="kadai_select.php">Favorites</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="kadai_insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>お気に入りの本ブックマーク</legend>
     <label>タイトル：<input type="text" name="booksname"></label><br>
     <label>URL：<input type="text" name="booksurl"></label><br>
     <label>感想：<textArea name="bookscomment" rows="4" cols="40"></textArea></label><br>
        <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
