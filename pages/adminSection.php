<?php
    require_once '../system/system.php';

    session_start();

    $erros = array();

    if(isset($_POST['btn-delete'])):
        if (!empty($_POST['user_id'])):
            $id = mysqli_real_escape_string($connect, $_POST['user_id']);
    
            $sql = "DELETE FROM users WHERE id = '$id'";
    
            if(mysqli_query($connect, $sql)):
                $_SESSION['mensagem'] = "Deletado com Sucesso!";
            else:
                $_SESSION['mensagem'] = "Erro ao deletar: " . mysqli_error($connect);
            endif;
            
        else:
            $_SESSION['mensagem'] = "ID do usuário não especificado.";
        endif;
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
            <h1>Users</h1>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>ID: </th>
                            <th>Name: </th>
                            <th>Email: </th>
                            <th>Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM users";
                        $resultado = mysqli_query($connect, $sql);
                        while($dados = mysqli_fetch_array($resultado)):
                        ?>
                        <tr method="POST">
                            <th><?php echo $dados['id']?></th>
                            <th><?php echo $dados['name']?></th>
                            <th><?php echo $dados['email']?></th>
                            <th><?php echo $dados['password']?></th>
                            <th>
                                <form action="" method="POST">
                                    <a href="../pages/edit.php?id=<?php echo $dados['id']; ?>" class="edit-link">O</a>
                                </form>
                            </th>
                            <th>
                                <form action="" method="POST">
                                    <button class="delete" name="btn-delete">X</button>
                                    <input type="hidden" name="user_id" value="<?php echo $dados['id']; ?>">
                                </form>
                            </th>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            
                <?php
                if(!empty($erros)):
                    foreach($erros as $erro):
                        echo $erro;
                    endforeach;
                endif;
            ?>
            </div>
        </main>
    </section>

    <script src="../system/log.js"></script>
</body>
</html>