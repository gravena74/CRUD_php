<?php
    require_once '../system/system.php';

    session_start();

    if(isset($_POST['btn-entrar'])):
        $erros = array();
        $email = mysqli_escape_string($connect, $_POST['email']);
        $password = mysqli_escape_string($connect, $_POST['password']);

        if(empty($email) or empty($password)):
            $erros[] = "<p class='erro'> O campo login/senha precisa ser preenchido </p>";
        
        else:
            $password = md5($password);
            $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password';";
            $result = mysqli_query($connect, $sql);
            if(mysqli_num_rows($result) > 0):
                if(mysqli_num_rows($result) == 1):
                    $dados = mysqli_fetch_array($result);
                    if($dados['id'] == '1'):
                        $_SESSION['logado'] = true;
                        $_SESSION['id_usuario'] = $dados['id'];
                        header('Location: ../pages/adminSection.php');
                    else:
                        $_SESSION['logado'] = true;
                        $_SESSION['id_usuario'] = $dados['id'];
                        header('Location: ../pages/userSection.php');
                    endif;
                else:
                    $erros[] = "<p class='erro'> Usuário e senha não conferem </p>";
                endif;
            else:
                $erros[] = "<p class='erro'> Usuário inexistente </p>";
            
            endif;
        endif;
    endif;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css">
    <title>Log In</title>
</head>
<body>
    <section class="section1">
        <img src="../imgs/pngwing.com (1).png" alt="">
    </section>
    <section class="section2">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <h1>Welcome back!</h1>
            <p>Please enter your details</p>
            <input type="text" name="email" placeholder="Email: ">
            <input type="text" name="password" placeholder="Password: ">
            <button name="btn-entrar">Log In</button>
            
            <?php
                if(!empty($erros)):
                    foreach($erros as $erro):
                        echo $erro;
                    endforeach;
                endif;
            ?>
            <a href="../pages/signup.php">Don't have an account? Sign Up</a>
        </form>
    </section>
</body>
</html>