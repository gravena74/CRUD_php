<?php
    session_start();

    require_once '../system/system.php';

    if(isset($_POST['btn-update'])):
        $erros = array();

        $id = mysqli_escape_string($connect, $_POST['id']);

        $name = mysqli_escape_string($connect, $_POST['name']);
        $email = mysqli_escape_string($connect, $_POST['email']);
        $password = mysqli_escape_string($connect, $_POST['password']);

        if(empty($name) or empty($email) or empty($password)):
            header('Location: ../pages/adminSection.php?Erro_ao_atualizar');
        
        else:
            $sql = "UPDATE users SET name = '$name', email = '$email', password = '$password' WHERE id = '$id'";

            if(mysqli_query($connect, $sql)):
                $_SESSION['mensagem'] = "Atualizado com sucesso!";
                header('Location: ../pages/adminSection.php?Atualizado_com_Sucesso');
    
            else:
                $_SESSION['mensagem'] = "Erro ao Atualizar";
                header('Location: ../pages/adminSection.php');
            
            endif;
        
        endif;
        
    endif;

    
?>