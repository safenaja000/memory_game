<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '123456', 'game_training');

if (isset($_POST['name']) & $_POST['type'] == 'register') {
    $name = $_POST['name'];
    $sql = "INSERT INTO `memory_game`(`name`,`point`) VALUES ('$name',0)";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $_SESSION['name'] = $name;
        echo 'good';
    } else {
        echo "fail 2";
    }
} else {
    echo 'fail1';
}

if (isset($_POST['type']) & $_POST['type'] == 'update') {
    $name = $_POST['name'];
    $point = $_POST['point'];
    $sqlselect = "SELECT * FROM memory_game WHERE name = '$name'";
    $resultselect = mysqli_query($conn, $sqlselect);
    $rowcount = mysqli_num_rows($resultselect);
    if ($rowcount == 1) {
        $row = mysqli_fetch_assoc($resultselect);
        $oldPoint = $row['point'];
        if ($oldPoint < $point) {
            $sql = "UPDATE `memory_game` SET `point`= $point WHERE `name` = '$name'";
            $resultupdate = mysqli_query($conn,$sql);
        }
    }
}else{
    echo 'ไม่เข้า update';
}
