<!DOCTYPE html>
<html>
    <head>
        <title>Facebook</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo BASE_URL; ?>assets/css/estilos.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css"/>
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div id="navbar">
                    <ul class="nav navbar-nav navbar-left">
                        <li><a class="navbar-brand" href="<?php echo BASE_URL; ?>">Facebook</a></li>
                        <li>
                            <form method="GET" action="<?php echo BASE_URL; ?>busca" class="navbar-form navbar-left navbar-input-group">
                                <div class="form-group">
                                    <input type="text" name="q" placeholder="Buscar..." class="form-control"/>
                                </div>
                                <button type="submit" class="btn btn-default">Buscar</button>
                            </form>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <?php echo $viewData['nome']; ?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo BASE_URL; ?>perfil">Editar Perfil</a></li>
                                <li><a href="<?php echo BASE_URL; ?>login/sair">Sair</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <?php $this->loadViewInTemplate($viewName, $viewData); ?> 
        </div>

        <script src="<?php echo BASE_URL; ?>assets/js/jquery.js" type="text/javascript"></script>
        <script src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo BASE_URL; ?>assets/js/script.js" type="text/javascript"></script>
    </body>
</html>