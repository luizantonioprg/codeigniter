<h1 style='color:white;'>Edite o usuário</h1>
<?php 
        if(isset($_POST['gerenciar_usuarios'])):
          echo validation_errors("<h4 style='color:red;max-width:350px;margin:0 auto;'>","</h4>");
        endif;

        if(isset($usuario_editado)):
          echo "<h4 style='color:#C2C249;max-width:30%;margin:0 auto;text-align:center'>$usuario_editado</h4>";
        endif;

        if(isset($email_invalido)):
          echo "<h4 style='color:red;max-width:30%;margin:0 auto;text-align:center'>$email_invalido</h4>";
        endif;
?>
      
<form method="post" action="<?php echo base_url(); ?>user/editar_usuario">
<?php foreach($usuario as $item): 
  $user_privilegio = $item->privilegio;
  
?>
              <input type='hidden' name='id_usuario' value='<?php echo $item->id; ?>'></input>
              <input name='nome' class='inputy' value='<?php echo $item->nome; ?>'></input>
              <input name='email' class='inputy' value='<?php echo $item->email; ?>'></input>
              <input name='senha' class='inputy'type='password' value='<?php echo $item->senha; ?>'></input>
              <select name='privilegio' class='inputy'>
                      <label placeholder='privilegio'>Privilégio</label>
                      
                      <option value='USUÁRIO' <?php if("USUÁRIO" == $user_privilegio){echo "selected";} ?>>USUÁRIO</option>
                      <option value='ADMIN' <?php if("ADMIN" == $user_privilegio){echo "selected";} ?>>ADMIN</option>
              </select>
              <button type='submit' name='gerenciar_usuarios'>EDITAR</button>
              <?php endforeach; ?>
        </form>