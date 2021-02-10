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
        <h1>Cadastrar</h1>
        <form method="POST">
            <input type="text" name="nome" placeholder="Nome completo" maxlength="30">
            <input type="text" name="telefone" placeholder="Telefone" maxlength="30">
            <input type="email" name="email" placeholder="Usuário" maxlength="40">
            <input type="password" name="senha" placeholder="Senha" maxlength="15">
            <input type="password" name="confSenha" placeholder="Confirmar senha" maxlength="15">
            <input type="submit" name="" value="Cadastrar">
            <div class="sub">
                <p>Tem uma conta?</p>
                <a href="index.php">Conecte-se</a>
            </div>
        </form>
    </div>
    </span>
    <?php
    // verificar se clicou
    
    if(isset($_POST['nome'])){
        $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        $confirmarSenha = addslashes($_POST['confSenha']);

        // verificar se não esta preenchido
        if (!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha)) {
            $u -> conectar(db_name,host_name,host_user,host_pwd);
            if ($u -> msgErro == "") {
                if ($senha == $confirmarSenha) {
                    if ($u -> cadastrar($nome, $telefone, $email, $senha)) {
                        echo "<span class='sucesso'>Cadastrado com sucesso!Acesse para Entrar</span>";
                    }else {
                        echo "<span class='erro'>EMAIL ja cadastrado</span>";
                    }
                }else {
                    echo "<span class='erro'>Senha e confirmar senha não conrrespondem</span>";
                }
            }else {
                echo "ERRO: ".$u->msgErro;
            }
        }else {
            echo "<span class='erro'>Preencha todo os campos!</span>";
        }
    }
    ?>
</body>
</html>