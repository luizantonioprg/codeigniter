


<?php
 if(!isset($_SESSION['loggedin'])){
   redirect('/');
 }

?>
<div class="dash_welcome">
  <div>
  <input type='hidden' id='id_usuario' value='<?php echo $_SESSION['loggedin']['id']?>'></input>
    <h3><span id="bem_vindo">Bem-vindo(a),admin </span><span id="usuario_nome"></span></h3>
  </div>
  <div>
    <h3>💰<span id="usuario_credito"></span></h3>
  </div>
</div>
 <?php 
              if(isset($estacionamento_cadastrado)):
                echo "<h4 style='color:#C2C249;max-width:30%;margin:0 auto;text-align:center'>$estacionamento_cadastrado</h4>";
              endif;
              if(isset($imagem_nao_upload)):
                echo "<h4 style='color:red;max-width:30%;margin:0 auto;text-align:center'>";
                  foreach($imagem_nao_upload as $item):
                    echo $item;
                  endforeach;
                  echo"</h4>";
              endif;
            ?>
<div class="tab" >
  <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">RESERVAS</button>
  <button class="tablinks" onclick="openCity(event, 'Paris')" id="pagamentos">PAGAMENTOS</button>
  <button class="tablinks" onclick="openCity(event, 'Capivari')" id="criar">CADASTRAR USUÁRIOS</button>
  <button class="tablinks" onclick="openCity(event, 'Canelopolis')" id='criar_categoria'>CADASTRAR CATEGORIAS</button>
  <button class="tablinks" onclick="openCity(event, 'Ribeiro')" id="cadastrar_estacionamento">CADASTRAR ESTACIONAMENTO</button>
  <button class="tablinks" onclick="openCity(event, 'Blumenau')" id="planos2">PLANOS</button>
  <button class="tablinks" onclick="openCity(event, 'Floripa')" id="categorias">GERENCIAR CATEGORIAS</button>
  <button class="tablinks" onclick="openCity(event, 'Balmain')" id="gerenciar_usuarios">GERENCIAR USUÁRIOS</button>
  <button class="tablinks" onclick="openCity(event, 'Pullman')" id="gerenciar_estacionamentos">GERENCIAR ESTACIONAMENTOS</button>
  
</div>
<div id="London" class="tabcontent">
<div class="containerExcel">
    <a href="#" id="download" title="exportar" onClick="javascript:fnExcelReport();">
        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
    </a>
</div>
     <div id="box" class="box">

        <div name="search" id="pesquisar1">
            <input id="txt" type="text" class="input2" name="txt" placeholder="Digite e aperte enter">
            <i class="fas fa-search"></i>
        </div>

    </div>
    
  <div id="filtros">

        <div id="parameters">
        <div class="container_select">
                <label style="display:block;color:white;">Estacionamentos</label>
                <select id="select_estacionamento" class="select-selected" name="select_estacionamento">
                <option></option>
                  <?php
                      foreach($estacionamentos as $item):
                        echo "<option value='$item->titulo'>".$item->titulo."</option>";
                      endforeach;
                  ?>
                </select>
            </div>
            <div class="container_select">
                <label style="display:block;color:white;">Data</label>
                <input class="input-field select-selected" name="datepicker" type="text" id="datepicker">
            </div>


        </div>
    </div>
<table id="tabela" class="sortable" style='margin-left:8.2vw;'>
    <thead>
            <tr>
              <td>USUÁRIO 🡙</td>
              <td>ESTACIONAMENTO 🡙</td>
              <td>DIA 🡙</td>
              <td>MÊS 🡙</td>
            </tr>
          <thead>
          <div id="loader" class="loader"></div>
          <tbody>

          </tbody>
    </table>


</div>
<div id="Paris" class="tabcontent">
<div class="containerExcel">
    <a href="#" id="download2" title="exportar" onClick="javascript:fnExcelReport2();">
        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
    </a>
</div>
     <div id="box" class="box">

        <div name="search" id="pesquisar2">
            <input id="txt2" type="text" class="input2" name="txt" placeholder="Digite e aperte enter2">
            <i class="fas fa-search"></i>
        </div>

    </div>
    
  <div id="filtros2">

        <div id="parameters">
        <!-- <div class="container_select">
                <label style="display:block;color:white;">Estacionamentos</label>
                <select id="select_estacionamento2" class="select-selected-pagamentos" name="select_estacionamento2">
                <option></option>
                  <?php
                      foreach($estacionamentos as $item):
                        echo "<option value='$item->titulo'>".$item->titulo."</option>";
                      endforeach;
                  ?>
                </select>
            </div> -->
            <div class="container_select">
                <label style="display:block;color:white;">Data</label>
                <input class="input-field select-selected-pagamentos" name="datepicker" type="text" id="datepicker2">
            </div>


        </div>
    </div>
        <table id="tabelaP" class="sortable" style='margin-left:8.2vw;'>
                  <thead>
                    <tr>
                      <td>DIA 🡙</td>
                      <td>MÊS 🡙</td>
                      <td>PLANO 🡙</td>
                      <td>USUÁRIO 🡙</td>
                    </tr>
                  <thead>
                  <div id="loader2" class="loader"></div>
                  <tbody>

                  </tbody>
        </table>
</div>
<div id="Capivari" class="tabcontent">
    <div class="divFormCriar">
        <form method="post" action="<?php echo base_url(); ?>user/cadastrar_usuario">
        <h3 style='color:white;max-width:100%;margin:0 auto;margin-bottom:2vh;'>Cadastre usuários</h3>
            <input name='nome2' placeholder='NOME' class='inputy' value='<?php echo set_value('nome2'); ?>'></input>
            <input name='email2' placeholder='EMAIL' class='inputy' value='<?php echo set_value('email2'); ?>'></input>
            <input name='senha2' type='password' placeholder='SENHA' class='inputy' value='<?php echo set_value('senha2'); ?>'></input>
            <input name='confirmar_senha2' type='password' placeholder='CONFIRMAR SENHA' class='inputy' value='<?php echo set_value('confirmar_senha2'); ?>'></input>
            <select name='privilegio' class='inputy'>
                      <label placeholder='privilegio'>Privilégio</label>
                      <option value='USUÁRIO'>USUÁRIO</option>
                      <option value='ADMIN'>ADMIN</option>
            </select>
            <button type="submit" name='cadastrar_usuario_botao' class=''>CADASTRAR</button>
          

        </form>
 
    </div>

    <?php
    if(isset($_POST['cadastrar_usuario_botao'])):
         echo validation_errors("<h4 style='color:red;'>","</h4>");
    endif;
         
    ?>

</div>
<div id="Blumenau" class="tabcontent">
<h3 style='margin:0 auto;max-width:500px'>Altere descrição e quantidade de créditos de cada plano</h3>
      <div class='divDosPlanos'>
       
        <?php foreach($planos as $item): ?>
        <div class='quadrado'>
        <form method="post" action="<?php echo base_url(); ?>user/editar_planos">
              <input type='hidden' name='id_plano' value='<?php echo $item->id; ?>'></input>
              <input name='titulo' class='inputy' value='<?php echo $item->titulo; ?>' readonly></input>
              <textarea name='descricao' class='inputy'><?php echo $item->descrição; ?></textarea>
              <input name='rendimento' class='inputy' value='<?php echo $item->rendimento; ?>'></input>
              <button type='submit' name='editar_plano'>EDITAR</button>
              
        </form>
        
        </div>
        <?php endforeach; ?>

      </div>
      <?php 
        if(isset($_POST['editar_plano'])):
          echo validation_errors("<h4 style='color:red;max-width:350px;margin:0 auto;'>","</h4>");
        endif;
          ?>
      <?php 
        if(isset($plano_atualizado)):
          echo "<h4 style='color:#C2C249;max-width:350px;margin:0 auto;'>$plano_atualizado</h4>";
        endif;
      ?>
</div>
<!-- categorias -->
<div id="Floripa" class="tabcontent">
<h3 style='color:white;max-width:85%;margin:0 auto;'>Altere ou exclua categorias</h3>
      <?php
                  if(isset($categoria_atualizada)):
                    echo "<h4 style='color:white;max-width:85%;margin:0 auto'>$categoria_atualizada</h4>";
                  endif;
      ?>

      <?php 
        if(isset($_POST['gerenciar_categoria'])):
          echo validation_errors("<h4 style='color:white;max-width:85%;margin:0 auto;'>","</h4>");
        endif;
          ?>
      <?php 
        if(isset($categoria_deletada)):
          echo "<h4 style='color:white;max-width:85%;margin:0 auto;'>$categoria_deletada</h4>";
        endif;
        if(isset($titulo_existe)):
          echo "<h4 style='color:white;max-width:85%;margin:0 auto;'>$titulo_existe</h4>";
        endif;
      ?>



              <table id="tabelaNova1" class="sortable" style='margin-left:8.2vw;'>
                  <thead>
                    <tr>
                      <td>TITULO 🡙</td>
                      <td>AÇÕES 🡙</td>
                    </tr>
                  <thead>
                 
                  <tbody>
                      <?php foreach($categorias as $item):"" ?>
                      <?php echo "
                      <tr>".
                        "<td>".$item->titulo."</td>".
                        "<td>
                        <form method='post' action='".base_url()."user/deletar_categoria'>
                        <input type='hidden' name='id_categoria' value='$item->id'></input>
                        <button type='submit' name='gerenciar_categoria'>DELETAR</button>
                      </form>



                      <form method='post' action='".base_url()."user/editar_categoria_view'>
                      <input type='hidden' name='id_categoria' value='$item->id'></input>
                  
                      <button type='submit' name='gerenciar_categoria'>EDITAR</button>
                      
                      </form>
                        
                        
                        
                        </td>".
                      "</tr>"; ?>
                      
                      <?php endforeach; ?>
                  </tbody>
                </table>














      <!-- <div class='divDosPlanos'>
        <?php //foreach($categorias as $item): ?>
        <div class='quadrado'>
        <form method="post" action="<?php //echo base_url(); ?>user/editar_categoria">
              <input type='hidden' name='id_categoria' value='<?php //echo $item->id; ?>'></input>
              <input name='titulo_categoria' class='inputy' value='<?php //echo $item->titulo; ?>'></input>
              <button type='submit' name='gerenciar_categoria'>EDITAR</button>
              
        </form>
        <form method="post" action="<?php //echo base_url(); ?>user/deletar_categoria">
              <input type='hidden' name='id_categoria' value='<?php //echo $item->id; ?>'></input>

              <button type='submit' name='gerenciar_categoria'>DELETAR</button>
              
        </form>
        
        </div> -->
        <?php //endforeach; ?>
      </div>
</div>
<div id="Canelopolis" class="tabcontent">
<div class="divFormCriar">
        <form method="post" action="<?php echo base_url(); ?>user/cadastrar_categoria">
        <h3 style='color:white;max-width:100%;margin:0 auto;margin-bottom:2vh;'>Cadastre categorias</h3>
            <input name='titulo_categoria' placeholder='titulo' class='inputy' value='<?php echo set_value('nome'); ?>'></input>
            <button type="submit" class='' name='cadastrar_categoria'>CADASTRAR</button>
        </form>
 
    </div>

    <?php 
    if(isset($_POST['cadastrar_categoria'])):
        echo validation_errors("<h4 style='color:red;max-width:30%;margin:0 auto;text-align:center'>","</h4>");
    endif;
    ?>
    <?php 
              if(isset($categoria_cadastrada)):
                echo "<h4 style='color:#C2C249;max-width:30%;margin:0 auto;text-align:center'>$categoria_cadastrada</h4>";
              endif;
            ?>
</div>
<div id="Balmain" class="tabcontent">
<?php
              if(isset($usuario_cadastrado)):
                echo "<h4 style='color:#C2C249'>$usuario_cadastrado</h4>";
              endif;
            ?>
<h3 style='margin:0 auto;max-width:500px;color:white'>GERENCIAR USUÁRIOS</h3>
      <?php 
        if(isset($_POST['gerenciar_usuarios'])):
         // echo validation_errors("<h4 style='color:white;max-width:350px;margin:0 auto;'>","</h4>");
        endif;
       
     
              if(isset($usuario_editado)):
                //echo "<h4 style='color:white;max-width:30%;margin:0 auto;text-align:center'>$usuario_editado</h4>";
              endif;
              if(isset($usuario_deletado)):
                echo "<h4 style='color:#C2C249;max-width:30%;margin:0 auto;text-align:center;margin-top:5vh;'>$usuario_deletado</h4>";
              endif;
              if(isset($email_invalido)):
                //echo "<h4 style='color:white;max-width:30%;margin:0 auto;text-align:center'>$email_invalido</h4>";
              endif;
            ?>

      <div class=''>
      <table id="tabelaNova2" class="sortable" style='margin-left:8.2vw;'>
                  <thead>
                    <tr>
                      <td>NOME 🡙</td>
                      <td>EMAIL 🡙</td>
                      <td>PRIVILEGIO 🡙</td>
                      <td>AÇÕES 🡙</td>
                    </tr>
                  <thead>
                  <tbody>
                  <?php foreach($usuarios as $item): 
                      $user_privilegio = $item->privilegio;  
                  ?>

                    <?php 
                    echo 
                      "<tr>
                        <td>".$item->nome."</td>
                        <td>".$item->email."</td>
                        <td>".$item->privilegio."</td>
                        <td>
                        <form method='post' action='".base_url()."user/deletar_usuario'>
                        <input type='hidden' name='id_usuario' value='$item->id'></input>
                        <button type='submit' name='gerenciar_usuarios'>DELETAR</button>
                        
                        </form>
                        
                        
                        <form method='post' action='".base_url()."user/editar_usuario_view'>
                        <input type='hidden' name='id_usuario' value='$item->id'></input>
                        <button type='submit' name='gerenciar_usuarios'>EDITAR</button>
                        </form>
                        </td>
                      </tr>";
                    ?>


                  <?php endforeach; ?>
                  </tbody>
        </table>

        <!-- <div class='quadrado'>
        <form method="post" action="<?php //echo base_url(); ?>user/editar_usuario">
              <input type='hidden' name='id_usuario' value='<?php //echo $item->id; ?>'></input>
              <input name='nome' class='inputy' value='<?php //echo $item->nome; ?>'></input>
              <input name='email' class='inputy' value='<?php //echo $item->email; ?>'></input>
              <input name='senha' class='inputy'type='password' value='<?php //echo $item->senha; ?>'></input>
              <select name='privilegio' class='inputy'>
                      <label placeholder='privilegio'>Privilégio</label>
                      
                      <option value='USUÁRIO' <?php //if("USUÁRIO" == $user_privilegio){echo "selected";} ?>>USUÁRIO</option>
                      <option value='ADMIN' <?php// if("ADMIN" == $user_privilegio){echo "selected";} ?>>ADMIN</option>
              </select>
              <button type='submit' name='gerenciar_usuarios'>EDITAR</button>
              
        </form>
        <form method="post" action="<?php //echo base_url(); ?>user/deletar_usuario">
              <input type='hidden' name='id_usuario' value='<?php //echo $item->id; ?>'></input>
              <button type='submit' name='gerenciar_usuarios'>DELETAR</button>
              
        </form>
        </div> -->
        

      </div>

</div>
<div id="Ribeiro" class="tabcontent">
<div class="divFormCriar">
        <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>user/cadastrar_estacionamento">
        <h3 style='color:white;max-width:100%;margin:0 auto;margin-bottom:2vh;'>Cadastre estacionamentos</h3>
            <input name='titulo_estacionamento' placeholder='titulo' class='inputy' value='<?php echo set_value('titulo_estacionamento'); ?>'></input>
            <input name='cep' onblur="pesquisacep(this.value);" id='cep' placeholder='cep' class='inputy' value='<?php echo set_value('cep'); ?>'></input>
            <input name='rua' id='rua' placeholder='rua' class='inputy' value='<?php echo set_value('rua'); ?>'></input>
            <input name='bairro' id='bairro' placeholder='bairro' class='inputy' value='<?php echo set_value('bairro'); ?>'></input>

            <input name='cidade' id='cidade' placeholder='cidade' class='inputy' value='<?php echo set_value('cidade'); ?>'></input>
            <input name='uf' id='uf' placeholder='uf' class='inputy' value='<?php echo set_value('uf'); ?>'></input>
            <input name='numero' placeholder='numero' class='inputy' value='<?php echo set_value('numero'); ?>'></input>
            <input name='numero_vagas' placeholder='numero_vagas' class='inputy' value='<?php echo set_value('numero_vagas'); ?>'></input>
            <select name='categoriass' class='inputy'>
            <?php foreach( $categorias as $item): ?>
              <option value='<?php echo $item->id?>'><?php echo $item->titulo?></option>
              <?php endforeach; ?>
            </select>
            <textarea class="form-control"  id="editor" name="descricao2"><?php echo set_value('descricao2');?></textarea>
            <label style='color:white;'>IMAGEM MÁX 300x300  </label>
            <input  placeholder="" class="form-control-file" type='file' name='userfile' style='color:white;text-align:left' /><br>
            <label style='color:white;'>DATAS DO SEU ESTACIONAMENTO</label>
            <input id="mdp-demo" name='datas'></input>
            <button type="submit" class='' name='cadastrar_estacionamento'>CADASTRAR</button>
        </form>
 
    </div>

    <?php 
    if(isset($_POST['cadastrar_estacionamento'])):
        echo validation_errors("<h4 style='color:red;max-width:30%;margin:0 auto;text-align:center'>","</h4>");
    endif;
    ?>
   
</div>
<div id="Pullman" class="tabcontent">
<table id="tabelaE" class="sortable" style='margin-left:8.2vw;'>
    <thead>
            <tr>
              <td>TITULO 🡙</td>
              <td>VAGAS 🡙</td>
              <td>AÇÕES </td>
            </tr>
          <thead>

          <tbody>

          </tbody>
    </table>
    <?php
    if(isset($estacionamento_deletado)):
        echo "<h4 style='color:#C2C249'>$estacionamento_deletado</h4>";
    endif;
    ?>
</div>


















<?php
if(isset($_SESSION)):
  ?>
  <div class="logout">
  <a title="SAIR" href='<?php echo base_url(); ?>user/logout' class="text-white">SAIR</a>
       
  </div>
<?php
  endif;
?>


<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

 <script src="<?php echo base_url(); ?>assets/adapters/jquery.js"></script>

<script src="<?php echo base_url(); ?>assets/js/vertical_tab.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/dasha/construct_dasha.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/js/dasha/reqs.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/sorttable.js" type="text/javascript"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="<?php echo base_url(); ?>assets/js/search_bar.js"></script>
<script src="<?php echo base_url(); ?>assets/js/exportar.js"></script>  

<!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datepicker-pt-BR.js"></script> 
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'dd/m/y' });
    $('#datepicker').datepicker( $.datepicker.regional[ "hi" ] );

    $( "#datepicker2" ).datepicker({ dateFormat: 'dd/m/y' });
    $('#datepicker2').datepicker( $.datepicker.regional[ "hi" ] );

  } );
</script>

 <script src="<?php echo base_url(); ?>assets/js/dasha/viacep.js"></script>
 



 <script src="<?php echo base_url(); ?>assets/js/dasha/jquery-ui.min.js" type="text/javascript"></script>
 <script src="<?php echo base_url(); ?>assets/js/dasha/jquery-ui.multidatepicker.js" type="text/javascript"></script>
 <script src="<?php echo base_url(); ?>assets/js/datepicker-pt-BR.js"></script> 
 <script>
 $('#mdp-demo').multiDatesPicker({
	dateFormat: "dd/m/y", 
  
});
$('#mdp-demo').multiDatesPicker( $.datepicker.regional[ "pt_BR" ] );

$('#mdp-demo2').multiDatesPicker({
	dateFormat: "dd/m/y", 
  
});
$('#mdp-demo2').multiDatesPicker( $.datepicker.regional[ "pt_BR" ] );


 </script>
 <script src="<?php echo base_url(); ?>assets/js/dasha/ckeditor.js"></script>
 <script src="<?php echo base_url(); ?>assets/js/dasha/ckeditorCallClassicMethod.js"></script>

 <script>

CKEDITOR.replace( 'editor' );

</script>