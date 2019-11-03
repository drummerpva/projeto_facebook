<!DOCTYPE html>
<html>
    <head>
        <title>Facebook - Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css"/>
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div id="navbar">
                    <ul class="nav navbar-nav navbar-left">
                        <li><a class="navbar-brand" href="<?php echo BASE_URL; ?>">Facebook</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?php echo BASE_URL; ?>login/entrar">Login</a></li>
                        <li><a href="<?php echo BASE_URL; ?>login/cadastrar">Cadastrar</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container" >
            <h1>Entrar</h1>
            <?php if (!empty($erro)) {
                ?>
            <div class="alert alert-danger">
                <?php echo $erro;?>
            </div>
                <?php
            }
            ?>
            <form method="POST" style="max-width: 300px;">
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" class="form-control" name="email" id="email" required/>
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" class="form-control" name="senha" id="senha" required/>
                </div>
                <button type="submit" class="btn btn-default">Entrar</button>
            </form>





















        </div>


    </body>
</html>
