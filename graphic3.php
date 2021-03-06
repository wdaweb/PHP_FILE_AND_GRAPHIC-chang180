<?php
include_once "base.php";

if ($_FILES['pic']['error'] == 0) {
    switch ($_FILES['pic']['type']) {
        case "image/jpeg";
            $sub = '.jpg';
            break;
        case "image/png";
            $sub = '.png';
            break;
        case "image/gif";
            $sub = '.gif';
            break;
    }

    //$sub=explode('.',$_FILES['pic']['name']);
    //$sub[1];->副檔名

    $name = 'mack' . date("Ymdhis") . $sub;
    move_uploaded_file($_FILES['pic']['tmp_name'], "imgs/" . $name);

    $data = [
        'filename' => $name,
        'type' => $_FILES['pic']['type'],
        'note' => $_POST['note'],
        'album' => $_POST['album'],
        'path' => 'imgs/' . $name

    ];

    save('file_info', $data);

    $thumb_path = "thumb/" . $name;
    $source_path = "imgs/" . $name;

    $img_info = getimagesize($source_path);

    // var_dump($img_info);

    $rate = .2;
    $border = 5; //白邊的寬度

    if ($img_info[0] > $img_info[1]) {
        // 寬大於高
        $src_x = ($img_info[0] - $img_info[1]) / 2;
        $src_y = 0;
        $img_w = $img_info[1] * $rate;
        $img_h = $img_info[1] * $rate;
        $src_w = $img_info[1];
        $src_h = $img_info[1];
    } else if ($img_info[0] < $img_info[1]) {
        // 寬小於高
        $src_x = 0;
        $src_y = ($img_info[1] - $img_info[0]) / 2;
        $img_w = $img_info[0] * $rate;
        $img_h = $img_info[0] * $rate;
        $src_w = $img_info[0];
        $src_h = $img_info[0];
    } else {
        // 長寬相等時，啥都不幹
        $src_x = $img_info[0];
        $src_y = $img_info[0];
        $img_w = $img_info[0] * $rate;
        $img_h = $img_info[0] * $rate;
        $src_w = $img_info[0];
        $src_h = $img_info[0];
    }

    // $img_w = $img_info[0] * $rate;
    // $img_h = $img_info[1] * $rate;

    $thumb_img = imagecreatetruecolor($img_w, $img_h);

    $white = imagecolorallocate($thumb_img, 255, 255, 255);
    // imagefill無法設定結束點
    imagefill($thumb_img, 0, 0, $white);

    // var_dump($thumb_img);

    switch ($img_info['mime']) {
        case "image/jpeg";
            $source_img = imagecreatefromjpeg($source_path);
            break;
        case "image/png";
            $source_img = imagecreatefrompng($source_path);
            break;
        case "image/gif";
            $source_img = imagecreatefromgif($source_path);
            break;
    }

    imagecopyresampled($thumb_img, $source_img, $border, $border, $src_x, $src_y, $img_w-(2*$border), $img_h-(2*$border), $src_w, $src_h);
    switch ($img_info['mime']) {
        case "image/jpeg";
            imagejpeg($thumb_img, $thumb_path);
            break;
        case "image/png";
            imagepng($thumb_img, $thumb_path);
            break;
        case "image/gif";
            imagegif($thumb_img, $thumb_path);
            break;
    }


    header("location:image.php");
}
