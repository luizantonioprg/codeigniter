<?php
 if(!isset($_SESSION['loggedin'])){
   redirect('/');
 }

?>
<?php
if(isset($atualizado)):
  echo "<h4 style='color:#C2C249'>$atualizado</h4>";
endif;
if(isset($titulo_invalido)):
  echo "<h4 style='color:red'>$titulo_invalido</h4>";
endif;
if(isset($imagem_grande)):
  echo "<h4 style='color:red'>$imagem_grande</h4>";

endif;
?>
<div class="dash_welcome">
  
  <div>
  <input type='hidden' id='id_usuario' value='<?php echo $_SESSION['loggedin']['id']?>'></input>
    <h3><span id="bem_vindo">Bem-vindo(a),admin </span><span id="usuario_nome"><?php echo $_SESSION['loggedin']['nome']?></span></h3>
  </div>
  <div>
    <h3>💰<span id="usuario_credito"><?php echo $_SESSION['loggedin']['credito']?></span></h3>
  </div>
</div>
<?php 
 echo validation_errors("<h4 style='color:red;max-width:30%;margin:0 auto;text-align:center'>","</h4>");

?>
<h3 style='color:white;'>EDITAR ESTACIONAMENTO </h3>
<form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>user/atualizar_estacionamento">
<?php 

foreach($estacionamento as $item): 
  $categoriaAtual=$item->tituloc;
    ?>
  <input name='titulo_velho' placeholder='titulo' type='hidden'value='<?php echo $item->titulo ?>'></input>
  <input name='titulo' placeholder='titulo' value='<?php if(isset($_POST['titulo'])):echo set_value('titulo');else:echo $item->titulo; endif;?>'></input><br>
  <input name='numero_vagas' value='<?php if(isset($_POST['numero_vagas'])):echo set_value('numero_vagas');else:echo $item->numero_vagas;endif;?>'></input><br>
  <input name='cep' placeholder='cep' name="cep" type="text" id="cep" size="10" maxlength="9"
                onblur="pesquisacep(this.value);" value='<?php if(isset($_POST['cep'])):echo set_value('cep');else:echo $item->cep;endif; ?>' /></label><br />
      
          <input name='rua' placeholder='rua' name="rua" type="text" id="rua" size="60" value='<?php if(isset($_POST['rua'])):echo set_value('rua');else:echo $item->rua; endif; ?>'/><br />
      
          <input name='bairro' value='<?php if(isset($_POST['bairro'])):echo set_value('bairro');else: echo $item->bairro;endif; ?>' placeholder='bairro' name="bairro" type="text" id="bairro" size="40" /></label><br />
        
          <input name='cidade' value='<?php if(isset($_POST['cidade'])):echo set_value('cidade');else:echo $item->cidade;endif; ?>' placeholder='cidade' name="cidade" type="text" id="cidade" size="40" /></label><br />
        
          <input name='uf' value='<?php if(isset($_POST['uf'])):echo set_value('uf');else:echo  $item->uf; endif;?>' placeholder='uf' name="uf" type="text" id="uf" size="2" /></label><br />
        
        <img id="output" src="<?php echo base_url().'uploads/'.$item->imagem?>"><br>
        <input name='datas' id="mdp-demo" name='datas' value='<?php if(isset($_POST['datas'])):echo set_value('datas');else: echo $item->datas;endif;?>'></input><br>
        <label style='color:white'>Imagem max 300x300</label><br>
        <input accept="image/*" onchange="loadFile(event)" placeholder="" class="form-control-file" type='file' name='userfile' style='color:white;text-align:left' />
        <textarea name='descricao' size=20 class="form-control"  id="editor" name="descricao2"><?php if(isset($_POST['descricao'])):echo set_value('descricao');else:echo $item->descricao;endif;?></textarea>
        <!-- <h5 style='color:white;'>CATEGORIA:<?php echo  $categoriaAtual;?></h5> -->
        


<?php endforeach; ?>

<select name='categoria'>
<?php foreach($categorias as $item2):?>
  
  <option value='<?php echo $item2->id?>' 
    <?php 
    if(isset($_POST['categoria']) && $item2->id==$_POST['categoria']){
      echo "selected";
    }else{
      if($item2->titulo == $categoriaAtual)
      {echo "selected";} 
    }

    ?>>
  
  
  <?php echo $item2->titulo?></option>

<?php endforeach; ?>
</select><BR>
<button>GUARDA</button>
</form>












<?php
if(isset($_SESSION)):
  ?>
  <div class="logout">
  <a title="SAIR" href='<?php echo base_url(); ?>user/logout' class="text-white">SAIR</a>
       
  </div>
<?php
  endif;
?>
<script src="<?php echo base_url(); ?>assets/js/sorttable.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/dasha/viacep.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dasha/ckeditor.js"></script>
 <script src="<?php echo base_url(); ?>assets/js/dasha/ckeditorCallClassicMethod.js"></script>
 <script src="<?php echo base_url(); ?>assets/js/dasha/jquery-ui.min.js" type="text/javascript"></script>
 <script src="<?php echo base_url(); ?>assets/js/dasha/jquery-ui.multidatepicker.js" type="text/javascript"></script>
 <script src="<?php echo base_url(); ?>assets/js/datepicker-pt-BR.js"></script> 
 <script>
 $('#mdp-demo').multiDatesPicker({
	dateFormat: "dd/m/y", 
  
});</script>
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>