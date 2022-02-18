<div class="containerRecupera">
  <form  method="post" action="<?php echo base_url(); ?>reset/email">
    <h3>Calma.. acontece ! Insira seu e-mail que enviaremos um link para você redefinir sua senha.</h3>
    <input type="text" name="email" value='<?php echo set_value('email'); ?>'></input><br>
    <button type="submit">ENVIAR LINK DE REDEFINIÇÃO</button>
  </form>
  <?php echo validation_errors("<h4 class='erro' style='color:red'>","</h4>")?>
  <?php
    if(isset($email_enviado)):
        echo "<h3 style='color:#C2C249'>$email_enviado</h3>";
    endif;
    if(isset($email_inexistente)){
 	echo "<h3 style='color:red'>$email_inexistente</h3>";
    }
  ?>
</div>