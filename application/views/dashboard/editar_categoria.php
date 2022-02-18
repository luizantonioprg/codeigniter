<?php
  foreach($categoria as $item):
      $id_categoria = $item->id;
      $titulo_categoria = $item->titulo;
  endforeach;


?>

<h2 style='color:white'>Edite essa categoria</h2>
        <?php
                  if(isset($categoria_atualizada)):
                    echo "<h4 style='color:#C2C249;max-width:85%;margin:0 auto'>$categoria_atualizada</h4>";
                  endif;

                  if(isset($_POST['gerenciar_categoria'])):
                    echo validation_errors("<h4 style='color:white;max-width:85%;margin:0 auto;'>","</h4>");
                  endif;

                  if(isset($titulo_existe)):
                    echo "<h4 style='color:red;max-width:85%;margin:0 auto;'>$titulo_existe</h4>";
                  endif;

if(isset($categoria_atualizada_mesmo_titulo)){
echo "<h4 style='color:#C2C249;max-width:85%;margin:0 auto;'>$categoria_atualizada_mesmo_titulo</h4>";
}
       ?>
       
<form method="post" action="<?php echo base_url(); ?>user/editar_categoria">
            <input type='hidden' name='id_categoria' value='<?php echo $id_categoria  ?>'></input>
              <input name='titulo_categoria' class='inputy' value='<?php echo $titulo_categoria; ?>'></input>
              <button type='submit' name='gerenciar_categoria'>EDITAR</button> 
</form>