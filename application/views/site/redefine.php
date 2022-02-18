<div class="containerRedefine">
  <form  method="post" action="<?php echo base_url(); ?>reset/redefinir">
    <h3>Quase lá.. escolha uma senha bem forte e anote para não esquecer !</h3>
      <input value="<?php 
        if(isset($reset) &&  $reset !== 'TRUE'):
          echo set_value('senderSenha'); 
        else:
          echo '';
        endif;
          ?>" name="senderSenha" type="password" class="form-control" placeholder="senha">

      <input value="<?php 
          if(isset($reset) && $reset !== 'TRUE'):
            echo set_value('senderConfirmarSenha'); 
          else:
            echo '';
          endif;
          ?>" name="senderConfirmarSenha" type="password" class="form-control" placeholder="confirmar senha">

          <!--HIDDEN -->
          <input type="hidden" value="<?php
          if(isset($_GET['token'])):
            echo $_GET['token'];
          else:
            if(isset($token)):
              echo $token;
            endif;
          endif;
          ?>" name="senderToken"></input>
        <input type="hidden" value="<?php 
        if(isset($_GET['email'])):
          echo $_GET['email'];
        else:
          if(isset($email)):
            echo $email;
          endif;
        endif;
          ?>" name="senderEmail"></input>
    <button type="submit">REDEFINIR SENHA</button>
  </form>


















  
  <?php echo validation_errors("<h4 class='erro'>","</h4>")?>
  <?php
      if(isset($senha_redefinida)):
          echo "<h3 style='color:#C2C249'>$senha_redefinida</h3>";
      endif;
 
      if(isset($email_enviado)){
        echo "<h3 style='color:#C2C249'>".$email_enviado."</h3>";
      }
      
      if(isset($link_expirado)){
        echo "<h3 style='color:red'>".$link_expirado."</h3>";
      }

      if(isset($credenciais_invalidas)){
        echo "<h3 style='color:red'>".$credenciais_invalidas."</h3>";
      }


?>

</div>