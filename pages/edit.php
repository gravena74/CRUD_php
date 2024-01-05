<?php
    require_once '../system/system.php';

    session_start();

    if(isset($_GET['id'])):
        $id = mysqli_escape_string($connect, $_GET['id']);
        
        $sql = "SELECT * FROM users WHERE id = '$id';";
        $resultado = mysqli_query($connect, $sql);
        $dados = mysqli_fetch_array($resultado);
        
    endif;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/styleAdmin.css">
    <title>Document</title>
</head>
<body>
    <section>
        <nav>
            <ul>
                <a href=""><li>Home</li></a>
                <a href=""><li>About</li></a>
                <a href=""><li>Shop</li></a>
                <a href=""><li>Contact</li></a>
            </ul>

            <ul>
                <a href=""><li>Update</li></a>
                <a href=""><li>Users</li></a>
            </ul>
        </nav>

        <main>
            <form action="../pages/update.php" method="POST">
                <h1>Update</h1>
                <p>Please update your details</p>
                <input type="hidden" name="id" value="<?php echo $dados['id'];?>">
                <input type="text" name="name" placeholder="Username: " value="<?php echo $dados['name']; ?>">
                <input type="text" name="email" placeholder="Email: " value="<?php echo $dados['email']; ?>">
                <input type="text" name="password" placeholder="Password: " value="<?php echo $dados['password']; ?>">
                <button name="btn-update">Update</button>
                
                <?php
                    if(!empty($erros)):
                        foreach($erros as $erro):
                            echo $erro;
                        endforeach;
                    endif;
                ?>
            </form>
        </main>
    </section>
</body>
</html>