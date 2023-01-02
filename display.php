<?php
require_once("connect.php");
$query = "SELECT * FROM todo_tb  ";
// $stmt = mysqli_query($Connect, $query);
// $all_todos = mysqli_fetch_all($stmt);
$stmt=$Connect->prepare($query);
$stmt->execute();
$all_todos=mysqli_fetch_all(mysqli_stmt_get_result($stmt));
// echo date('D, d M Y H:i:s');

$index = 0;
if (isset($_POST["delete"])) {
    $value = $_POST["value"];
    $sql = "DELETE FROM todo_tb WHERE todo_id=?";
    $stmt1 = $Connect->prepare($sql);
    $stmt1->bind_param("i", $value);
    $response = $stmt1->execute();
    if ($response) {
        $_SESSION["message"] = "successfully deleted";
        $_SESSION["status"] = true;
        header("location:index.php");
    } else {
        $_SESSION["message"] = "Failed to delete";
        $_SESSION["status"] = false;
        header("location:index.php");
    }
}
if (isset($_POST["edit"])) {
    $value = $_POST["value"];
    $value1 = $_POST["value1"];
    $input_value= $all_todos[$value1][1];
    $_SESSION["input_value"]= $input_value;
    $_SESSION["input_index"]= $value;
    header("location:index.php");
}

 function get_Index($value):int{
    return $value-=1;
 }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>

<body>

    <table class="table">
        <thead>
            <tr>
                <th>S/N</th>
                <th>todo</th>
                <th>date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($all_todos as $item) : ?>
                <tr>
                    <td><?= $index+=1 ?></td>
                    <td><?= $item[1] ?></td>
                    <td><?= $item[2] ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="value" value="<?= $item[0] ?>" />
                            <input type="hidden" name="value1" value="<?=get_Index($index)?>" />
                            <button class="btn btn-info" name="edit">Edit</button>
                        </form>
                        <form method="POST">
                            <input type="hidden" name="value" value="<?= $item[0] ?>" />
                            <button class="btn btn-danger" name="delete">Delete</button>
                        </form>
                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>
    </table>
</body>

</html>