<h1>Busca</h1>
<?php if (count($resultado)) { ?>
    <?php foreach ($resultado as $r) {
        ?>
        <div class="sugestaoItem">
            <b><?php echo $r['nome']; ?></b>
            <?php if (!$r['amigo']) { ?>
                <button class="btn btn-primary pull-right" onclick="addAmigo(<?php echo $r['id']; ?>, this, '<?php echo BASE_URL;?>');">+</button>
            <?php } ?>
        </div>
        <?php
    }
}
?>
