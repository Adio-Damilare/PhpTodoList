<?php
require_once("connect.php");
$input_value=$_SESSION["input_value"];
        if(isset($_POST["add"])){
            $todo=$_POST["todo"];
            if(empty($todo)){
                $_SESSION["message"]="Todo cannot be empty";
                $_SESSION["status"]=false;
                header("location:index.php");
            }else if(!empty($_SESSION["input_index"])){
                $value=$_SESSION["input_index"];
                $queryUpdate="UPDATE todo_tb SET todo_name=? WHERE todo_id=?";
                $stmt=$Connect->prepare($queryUpdate);
                $stmt->bind_param("si",$todo,$value);
                $res=$stmt->execute();
                if($res){
                    $_SESSION["message"]="Successfuly edited ";
                    $_SESSION["status"]=true;
                }else{
                    $_SESSION["message"]="Failed to edited ";
                    $_SESSION["status"]=false;

                }
                header("location:index.php");

            }
            else{
                $sql="INSERT INTO `todo_tb`(todo_name) VALUES(?)";
                // $respone=mysqli_query($Connect,$sql);
                 // $respone=mysqli_query($Connect,$sql);

                 $stmt=$Connect->prepare($sql);
                 $stmt->bind_param("s",$todo);
                 $respone=$stmt->execute();
                if($respone){
                    $_SESSION["message"]="successfully added";
                    $_SESSION["status"]=true;
                    echo "done";
                    echo $respone;
                }else{
                    $_SESSION["message"]="Failed to added";
                    echo $respone;
                    echo "Error";
                    $_SESSION["status"]=false;
                }
                header("location:index.php");
            }
            $_SESSION["input_index"]='';
            $_SESSION["input_value"]='';

        }
?>