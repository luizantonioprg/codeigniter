<?php
 if(isset($_SESSION['loggedin'])){
  redirect('/login/index');
 }

?>
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'London')" id="sobre" >SOBRE</button>
  <button class="tablinks" onclick="openCity(event, 'Paris')" id="defaultOpen">ESTACIONAMENTOS</button>
  <button class="tablinks" onclick="openCity(event, 'Tokyo')" id="logincadastro">LOGIN / CADASTRO</button>

</div>


<div id="London" class="tabcontent" >
  <h3 class="tituloSobre">EMPRESA TRADICIONAL DESDE 1989</h3>
  <img class="jornal" src="<?php echo base_url(); ?>images/jornal.png">
  <p class="p1 " id="p1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker</p>
  <div class="splide">
				<div class="splide__track">
					<div class="splide__list">
            <div class="splide__slide">
               <img class="jornal" src="<?php echo base_url(); ?>images/estac1.png">
            </div>
            <div class="splide__slide">
               <img class="jornal" src="<?php echo base_url(); ?>images/estac2.jpg">
            </div>
            <div class="splide__slide">
               <img class="jornal" src="<?php echo base_url(); ?>images/estac3.jpg">
            </div>
					</div>
				</div>
		</div>
  <!-- <p class="p1 " id="p2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p> -->
</div>

<div id="Paris" class="tabcontent">
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
            <div class="container_select" id="container_municipio">
              <label style="display:block;color:white;">Município</label>
              <select id="select_municipios" class="select-selected" name="select_municipios" style="max-width:80px">
                <option></option>
              </select>
            </div>
            <div class="container_select">
              <label style="display:block;color:white;">Estado</label>
              <select id="select_estados" class="select-selected" name="select_estados">
                <option></option>
              </select>
            </div>
            
            <div class="container_select">
                <label style="display:block;color:white;">Categoria</label>
                <select id="select_categorias" class="select-selected" name="select_categorias">
                <option></option>
                  <?php
                      foreach($categorias as $item):
                        echo "<option value='$item->id'>".$item->titulo."</option>";
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

<table id="tabela" class="sortable">
<thead>
        <tr>
          <td>ESTACIONAMENTO 🡙</td>
          <td>ENDEREÇO 🡙</td>
          <td>CATEGORIA 🡙</td>
          <td>VAGAS 🡙</td>
        </tr>
      <thead>
      <div id="loader" class="loader"></div>
      <tbody>

      </tbody>
</table>




</div>



<div id="Tokyo" class="tabcontent">
<div class="container">
          <input type="radio" name="tab" id="signin" checked="checked"/>
          <input type="radio" name="tab" id="register"/>
          <div class="pages">
            <div class="page">
              <div class="input">
              <form method="POST" action="<?php echo base_url(); ?>login/signIN">
                    <div class="title">EMAIL</div>
                    <input value='<?php echo set_value('email'); ?>' class="text" type="text" placeholder="" name="email"/>
                  </div>
                  <div class="input">
                    <div class="title">SENHA</div>
                    <input value='<?php echo set_value('senha'); ?>' class="text" type="password" placeholder="" name="senha"/>
                  </div>
                  <div class="input">
                    <input type="submit" value="LOGAR"/>
                  </div>
              </form>
            <a href="<?php echo base_url(); ?>reset/recupera">ESQUECEU ?</a>
            </div>
            <div class="page signup">
            <form method="POST" action="<?php echo base_url(); ?>user/signUP">
             <div class="input">
                <div class="title">NOME</div>
                <input value='<?php echo set_value('nome_signup'); ?>' name="nome_signup" class="text" type="text" placeholder=""/>
              </div>
              <div class="input">
                <div class="title">EMAIL</div>
                <input value='<?php echo set_value('email_signup'); ?>' name="email_signup" class="text" type="text" placeholder=""/>
              </div>
              <div class="input">
                <div class="title">SENHA</div>
                <input value='<?php echo set_value('senha_signup'); ?>' name="senha_signup" class="text" type="password" placeholder=""/>
              </div>
              <div class="input">
                <div class="title">CONFIRMAR SENHA</div>
                <input value='<?php echo set_value('confirmar_senha_signup'); ?>' name="confirmar_senha_signup" class="text" type="password" placeholder=""/>
              </div>
              <div class="input">
                <input type="submit" value="CADASTRAR"/>
              </div>
            </div>
            </form>
          </div>
          <div class="tabs">
            <label class="tab" for="signin">
              <div class="text">LOGAR</div>
            </label>
            <label class="tab" for="register">
              <div id="signup_btn" class="text">CADASTRAR</div>
            </label>
            
          </div>

   </div>
   <div id="cadastro_resposta">
   <?php echo validation_errors("<div class='alert alert-danger' style='color:red'>","</div>")?>
   <?php
      if(isset($credenciais_invalidas)){
        echo "<h4 style='color:red'>$credenciais_invalidas</h4>";
      }

    ?>
   </div>
</div>


<script src="<?php echo base_url(); ?>assets/js/sorttable.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/vertical_tab.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/texto.js"></script>   
<script src="<?php echo base_url(); ?>assets/js/reqs.js"></script>  
<script src="<?php echo base_url(); ?>assets/js/construc.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/js/search_bar.js"></script>
<script src="<?php echo base_url(); ?>assets/js/exportar.js"></script>     
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datepicker-pt-BR.js"></script> 
  <script>
  $( function() {
   
    $('#datepicker').datepicker( $.datepicker.regional[ "hi" ] );
    $( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });

  } );
</script>

<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
<script>
new Splide( '.splide', {
	type    : 'loop',
	perPage : 3,
	autoplay: true,
} ).mount();
</script>
