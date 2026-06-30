<?php

session_start();

if(isset($_SESSION["usuario"])){

    header("Location: /rebanho/dashboard.php");
    exit();

}

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <title>AgroMind</title>

    <link rel="stylesheet" href="/rebanho/app/css/login.css">

</head>

<body>

<div class="container">

    <div class="left">

        <h1>🐄</h1>

        <h2>AgroMind</h2>

        <p>

            Gerencie seu rebanho de forma simples e eficiente.

        </p>

    </div>

    <div class="right">

        <div class="login-box">

            <h2>Login</h2>

            <form method="POST" action="/rebanho/login.php">

                <label>E-mail</label>

                <input
                    type="email"
                    name="email"
                    placeholder="Digite seu e-mail"
                    required>


                <label>Senha</label>

                <input
                    type="password"
                    name="senha"
                    placeholder="Digite sua senha"
                    required>

                <button type="submit">

                    Entrar

                </button>

            </form>

            <?php if(isset($_GET["erro"])){ ?>

                <p style="color:red; text-align:center; margin-top:20px;">

                    Usuário ou senha inválidos.

                </p>

            <?php } ?>

        </div>

    </div>

</div>

</body>

</html>