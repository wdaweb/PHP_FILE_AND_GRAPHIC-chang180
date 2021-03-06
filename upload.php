<?php

/**
 * 1.建立表單
 * 2.建立處理檔案程式
 * 3.搬移檔案
 * 4.顯示檔案列表
 */
include_once "base.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>檔案上傳</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="form-group">
            <h1 class="header text-center">檔案上傳練習</h1>
            <!----建立你的表單及設定編碼----->
            <!-- 標籤屬性enctype="multipart/form-data"必須自己記住 -->
            <form class="form-group" action="catch_file.php" method="post" enctype="multipart/form-data"> 
                <input class="form-control-file" type="file" name="upload" id="img">
                <div class="input-group my-2">
                <label class="form-control col-3" for="note">檔案說明:</label>
                <input class="form-control col-9" type="text" name='note'>
                </div>
                <input class="btn btn-outline-success" type="submit" value="上傳">
            </form>
            <a href="index.php" class="btn btn-lg btn-outline-primary border-success rounded-pill m-2">回首頁</></a>
        </div>




        <!----建立一個連結來查看上傳後的圖檔---->

        <?php

        if (!empty($_GET['filename'])) {
            $name = $_GET['filename'];
        ?>
            <!-- 可避免標籤出現在網頁原始碼，以免目錄被看到 -->
            <img class="img-thumbnail rounded-lg shadow" src="imgs/<?= $name; ?>" alt="" style="width:200px;height:300px;">
        <?php
        } else {
            $name = "";
        }
        ?>
    <a class="btn btn-outline-primary mt-3" href="index.php">回首頁</a>
    </div>



</body>

</html>