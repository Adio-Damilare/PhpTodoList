<?php
// require_once("connect.php");
require_once("process.php");



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-5 col-md-8 col-sm-11  mx-auto">
                <?php
                $alert = "alert-danger text-center text-danger";
                if (isset($_SESSION["status"])) {
                    $alert = "alert-success text-center text-dark";
                }
                if (isset($_SESSION['message'])) {
                    $message = $_SESSION['message'];
                    echo "<div class='alert $alert'>
                    $message
                    </div>";
                }
                unset($_SESSION['message']);
                ?>
                <form action="process.php" method="POST" class="d-flex">
                    <input type="text" name="todo" value="<?= $input_value ?>" class="form-control" />
                    <button class="btn btn-md btn-success" name="add"><?php
                                                                        if ($_SESSION["input_index"]) {
                                                                            echo "Edit";
                                                                        } else {
                                                                            echo "Add";
                                                                        }
                                                                        ?></button>
                </form>
            </div>
        </div>
        <?php
        require_once("display.php");
        ?>

    </div>

</body>

</html>