<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
  <div class = "container-fluid">
    <h5><b> Загрузите картинку и мы выведем её как баннер размером 200 х 100 </b></h5>
    <form action="script.php" method = "POST" enctype="multipart/form-data">
        <div class="form-group">
            <input type = "file" name = "picture">
            <br> <br>
            <input class="btn btn-primary btn-sm" type = "submit" value = "Отправить запрос">
        </div>
    </form>
  </div>
</body>
</html>

