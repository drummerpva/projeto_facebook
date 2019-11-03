<div class="row">
    <div class="col-sm-8">
        <div class="postArea">
            <form method="POST" enctype="multipart/form-data">
                <h4>O que você esta pensando?</h4>
                <textarea name="post" class="form-control"></textarea><br/>
                <input type="file" name="foto"/><br/>
                <input type="submit" value="Enviar" class="btn btn-info" />
            </form>
        </div>
        <div class="feed">
            <?php
            foreach ($feed as $f) {
                $this->loadView('postItem', $f);
            }
            ?>
        </div>

    </div>
    <div class="col-sm-4">
        <div class="widget">
            <?php if (count($requisicoes)) { ?>
                <h4>Requisições de amizade</h4>
                <?php foreach ($requisicoes as $r) {
                    ?>
                    <div class="sugestaoItem">
                        <b><?php echo $r['nome']; ?></b>
                        <button class="btn btn-danger pull-right" style=" margin-left:3px;"onclick="recAmigo(<?php echo $r['usuario_de']; ?>, this);">Recusar</button>
                        <button class="btn btn-success pull-right" onclick="accAmigo(<?php echo $r['usuario_de']; ?>, this);">Aceitar</button>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <div class="widget">
            <h4>Total de Amigos</h4>
            <?php
            echo $totalAmigos . " amigo" . (($totalAmigos == 1) ? "" : "s");
            ?>
        </div>
        <div class="widget">
            <?php if (count($sugestoes)) { ?>

                <h4>Sugestões de amigos</h4>
                <?php foreach ($sugestoes as $s) {
                    ?>
                    <div class="sugestaoItem">
                        <b><?php echo $s['nome']; ?></b>
                        <button class="btn btn-primary pull-right" onclick="addAmigo(<?php echo $s['id']; ?>, this);">+</button>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <div class="widget">

            <h4>Grupos</h4>
            <form method="POST">
                <div class="input-group">
                    <input type="text" class="form-control" name="grupo" placeholder="Nome do Grupo"/>
                    <span class="input-group-btn">
                        <input type="submit" class="btn btn-default" value="Criar"/>
                    </span>
                </div>
            </form><br/>
            <?php foreach ($grupos as $g) {
                ?> 
                <a  class="btn btn-link form-control" href="<?php echo "./grupos/abrir/{$g['id']}" ?>"><?php echo $g['titulo']; ?></a>
                <?php
            }
            ?>
        </div>
    </div>
</div>