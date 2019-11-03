<div class="postItem">
    <b>De:</b><?php echo $nome . " às " . date('H:i:s \e\m d/m/Y ', strtotime($data_criacao)) . "<br/>"; ?>
    <?php if ($tipo) {
        ?>
        <img src="<?php echo BASE_URL; ?>assets/images/posts/<?php echo $url; ?>" width="100%" />
        <?php
    }
    echo "<div class='postItem_Texto'>";
    echo $texto;
    echo "</div>";
    ?>
    <br/>
    <div class="postItem_Botoes">
        <button class="btn btn-info btn-sm" onclick="curtir(this,'<?php echo BASE_URL;?>')" data-id="<?php echo $id ?>" 
                data-likes="<?php echo $likes; ?>" data-liked="<?php echo $liked; ?>">
            (<?php echo $likes; ?>)<?php echo ($liked) ? " Descurtir" : " Curtir"; ?>
        </button>
        <button class="btn btn-success btn-sm" onclick="displayComentario(this);">
            Comentar
        </button><br/><br/>
        <div class="postItem_Comentario">
            <input type="texto" class="postItem_Text form-control" />
            <button class="btn btn-default" data-id="<?php echo $id ?>" onclick="comentar(this,'<?php echo BASE_URL;?>');">Enviar</button>
        </div>
        <br/>
    </div>

    <?php if(count($comentarios)){?>
    <button class="btn btn-default" onclick="displayComentarios(this);">Ver Comentários (<?php echo count($comentarios);?>) <span class="caret"></span></button>
    <div class="postItem_Comentarios">
        <?php foreach ($comentarios as $c) {
            ?>
        <b> Comentário de: </b><?php echo $c['nome']." às ".date("H:i \\e\m d/m/Y", strtotime($c['data_criacao']));?><br/>
        <div class="comentario">
            <?php echo $c['texto'];?>
        </div>
        <hr/>
            <?php
        }
        ?>
    </div>
    <?php }?>
</div>