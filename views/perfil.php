<h1>Editar Perfil</h1>
<form method="POST" style="max-width: 300px;">
    <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" class="form-control" name="nome" id="nome" value="<?php echo $info['nome'] ?? "";?>" required/>
    </div>
    <div class="form-group">
        <label for="email">E-mail:</label>
        <input type="email" class="form-control" name="email" id="email" value="<?php echo $info['email'] ?? "";?>" disabled/>
    </div>
    <div class="form-group">
        <label for="bio">Sobre:</label>
        <textarea class="form-control" name="bio" id="bio" required><?php echo $info['bio'] ?? "";?> </textarea>
    </div>
    <b>Sexo:</b><br/>
    <?php switch($info['sexo']){
        case '0': echo "Masculino";break;
        case '1': echo "Feminino";break;
    }?>
    <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" class="form-control" name="senha" id="senha"/>
    </div>
    <button type="submit" class="btn btn-default">Alterar</button>
</form>
