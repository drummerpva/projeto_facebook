<h1><?php echo $info['titulo']; ?> (<?php echo $membros; ?> Membro<?php echo ($membros == 1) ? "" : "s"; ?>)</h1>
<?php if ($isMembro) {
    ?>
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


    <?php
} else {
    ?>
    <h3>Você não é membro desse grupo</h3>
    <a href="<?php echo BASE_URL; ?>grupos/entrar/<?php echo $idGrupo; ?>" class="btn btn-default">Entrar no grupo</a>
    <?php
}
?>