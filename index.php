<?php
require_once 'classes/usuarios.php';

$u = new usuarios;

    define('host_name', 'localhost');
    define('host_user', 'root');
    define('host_pwd', "");
    define('db_name', 'projetoLogin');
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/estilo.css">
</head>
<body>
    <div id="corpo">
        <h1>Entrar</h1>
        <form method="POST">
            <input type="email" name="email" placeholder="Usuário">
            <input type="password" name="senha" placeholder="Senha">
            <input type="submit" value="ACESSAR">
            <div class="sub">
                <p>Ainda não é inscrito? </p>
                <a href="cadastrar.php">Cadastre-se</a>
            </div>
        </form>
    </div>
    
    <?php
    // verificar se clicou
    
    if(isset($_POST['email'])){
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);

        // verificar se não esta preenchido
        if (!empty($email) && !empty($senha)) {
            $u->conectar(db_name,host_name,host_user,host_pwd);
            if ($u -> msgErro == "") {
                if ($u->logar($email, $senha)) {
                    header("location: areaprivada.php");
                }else {
                    echo "<span class='erro'>Email ou Senha estão incorretos</span>";
                }
            }else {
                echo "ERRO: ".$u->msgErro;
            }
            
        }else {
            echo "<span class='erro'>Preencha todos os campos!</span>";
        }
    }
    ?>
</body>
</html>