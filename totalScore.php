<?php

session_start();
$conn = mysqli_connect('localhost', 'root', '123456', 'game_training');

$sql = "SELECT * FROM memory_game ORDER BY `point` desc ";
$result = mysqli_query($conn, $sql);
$i = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body class="bg-dark">
    <div class="container" style="margin-top: 200px;">
        <table class="table table-striped table-dark">
            <tr>
                <td>อันดับ</td>
                <td>ชื่อ</td>
                <td>คะแนน</td>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { $i++ ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['point'] ?></td>
                </tr>
            <?php } ?>
        </table>
        <a class="btn btn-danger" href="/memory">Play Again</a>
    </div>
</body>

</html>