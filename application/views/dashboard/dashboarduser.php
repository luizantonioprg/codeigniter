<?php
 if(!isset($_SESSION['loggedin'])){
   redirect('/');
 }
echo $id_do_usuario;
echo $_SESSION['loggedin']['email'];


?>
<div class="dash_welcome">
  <div>
    <h3><span id="bem_vindo">Bem-vindo(a), </span><span id="usuario_nome"></span></h3>
  </div>
  <div>
    <h3>💰<span id="usuario_credito"></span></h3>
  </div>

</div>
<?php 
if(isset($_SESSION['reserva_realizada'])){
 echo "<h4 style='color:yellow'>RESERVA(S) REALIZADA(S)</h4>";
}
?>
<div class="tab" >
  <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">ESTACIONAMENTOS</button>
  <button class="tablinks" onclick="openCity(event, 'Paris')" id="meus_dados">MINHAS INFORMAÇÕES</button>
  <button class="tablinks" id="creditos" onclick="openCity(event, 'Tokyo')">ADICIONAR CRÉDITOS</button>
  <button class="tablinks" onclick="openCity(event, 'Barueri')">MINHAS RESERVAS</button>
  <button class="tablinks" onclick="openCity(event, 'Santos')">MEUS PAGAMENTOS</button>
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

<div id="Paris" class="tabcontent">
    <div id="dashu_dados">
        <form id="dashu_form" method="post" action="<?php echo base_url(); ?>user/edit">
          <div>
            <input id="id_usuario" name="id_usuario" type="hidden" value="<?php if(isset($_SESSION['loggedin']['id'])):echo $_SESSION['loggedin']['id'];else:echo $id_do_usuario;endif;?>"type="text"></input>
            <input id="nome_usuario" name="nome" type="text"></input>
          </div>
          <div>
          <input id="email_usuario" name="email" type="text"></input>
          </div>
          <div>
             <input id="senha" type="password" name="senha" placeholder="NOVA SENHA"  value='<?php echo set_value('senha');?>'></input>
          </div>
          <div>
             <input id="confirmarSenha" type="password" name="confirmar" placeholder="CONFIRMAR NOVA SENHA" value='<?php echo set_value('confirmar');?>'></input>
          </div>
          <button id="dashu_atualizar">GUARDA</button>
          <?php echo validation_errors("<div class='aviso'>","</div>")?>
          <?php
              if(isset($usuario_atualizado)){
                echo "<div class='aviso' style='color:#C2C249'>".$usuario_atualizado."</div>";

              }
              if(isset($email_invalido)){
                echo "<div class='aviso' style='color:red;'>".$email_invalido."</div>";

              }
          ?>
        </form>

    </div>
</div>

<div id="Tokyo" class="tabcontent">
  <div id="planos">
 
        <select id="select_planos" name="select_planos">
        <?php
        
            foreach($planos as $item):
                echo "<option value='$item->titulo'>".$item->titulo."</option>";
            endforeach;
        ?>
        </select>
        <?php
            foreach($planos as $item):
                echo "<div class='descricao_plano' id='$item->titulo'>".$item->descrição."</div>";
            endforeach;
        ?>    
        <div id="paypal-button-container-P-014696710N602254RMDGI5KQ" class='p-btn'></div>
        <div id="paypal-button-container-P-49N05800SW808751EMDGJC2Y" class='p-btn'></div>
        <div id="paypal-button-container-P-6WU0151704777271JMDGJEOY" class='p-btn'></div>

        <?php
            if(isset($plano_adquirido)):
              echo "<div class='aviso' style='color:#C2C249'>".$plano_adquirido."</div>";
            endif;
        ?>
    </div>
</div>

<div id="Barueri" class="tabcontent">
  <table id="tabela2" class="sortable">
  <thead>
          <tr>
            <td>ESTACIONAMENTO 🡙</td>
            <td>ENDEREÇO 🡙</td>
            <td>DIA 🡙</td>
            <td>MÊS 🡙</td>
          </tr>
        <thead>
        <tbody>
   
              <?php
              if(empty($reservas)):
                echo "<tr>
                  <td>Você ainda não possui reservas</td>
                </tr>";
              endif;
          
              foreach($reservas as $item):
		$data_limpa = trim($item->data," ");
                $dia = strval(substr($data_limpa, 0, 2));
if (strpos($dia, '/') !== false) {
$dia = strval(substr($data_limpa, 0, 1));
}
		
                $arr = $bits = explode('/',$item->data);
                $mes = $arr[1];
            
                echo "
                <tr>
       //luuu
                  <td onclick=integra(this.innerText)>$item->titulo</td>
                  <td>$item->rua, $item->complemento - $item->bairro($item->cidade/$item->estado)</td>
                  <td>$dia</td>
                  <td>$mes</td>
                </tr>
                
                ";
              endforeach;
              ?>
      
        </tbody>
  </table>
</div>
<div id="Santos" class="tabcontent">
<table id="tabela3" class="sortable">
  <thead>
          <tr>
            <td>DATA DO PAGAMENTO 🡙</td>
            <td>PLANO 🡙</td>
          </tr>
        <thead>
        <tbody>
          
        <?php
              if(empty($pagamentos)):
                echo "<tr>
                  <td>Você ainda não possui pagamentos</td>
                </tr>";
              endif;
          
              foreach($pagamentos as $item):
              //   $dia = substr($item->data, 0, 2);
              //   $arr = $bits = explode('/',$item->data);
              //  $mes = $arr[1];
            
                echo "
                <tr>
       
                  <td>$item->data_pagamento</td>
                  <td>$item->plano</td>
                </tr>
                
                ";
              endforeach;
              ?>
        </tbody>
  </table>


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
 <form id=""style="display:none" method="post" action="<?php echo base_url(); ?>pagamentos/register">
            <input id="id_usuario" name="id_usuario" type="hidden" value="<?php if(isset($_SESSION['loggedin']['id'])):echo $_SESSION['loggedin']['id'];else:echo $id_do_usuario;endif;
              ?>"type="text"></input>
              <input type="text"  name="plano" id="pagar_plano" value="MENSAL"></input>
              <input type="text" name="data_pagamento" id="data_pagamento" value="02/2/21"></input>
              <button type="submit"  id="pagar">PAGAR</button>
              <!-- NO CHANGE DO SELECT DE PLANOS, ALTERAR O VALOR DESSE INPUT ACIMA -->

</form>
<script src="https://www.paypal.com/sdk/js?client-id=AdItMxBx6i6byWZVV5H7_tmFslkIhaMDLMXVJt59rHFWtU3G-YeFbYsiEaga_B0FGzv5yCG26evvHQDq&vault=true&intent=subscription" data-sdk-integration-source="button-factory"></script> 
<script src="<?php echo base_url(); ?>assets/js/sorttable.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/vertical_tab.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/texto.js"></script>   
<script src="<?php echo base_url(); ?>assets/js/reqs.js"></script>  
<script src="<?php echo base_url(); ?>assets/js/dashu/reqs.js"></script>  
<script src="<?php echo base_url(); ?>assets/js/dashu/construc_dashu.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/js/search_bar.js"></script>
<script src="<?php echo base_url(); ?>assets/js/exportar.js"></script>     
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datepicker-pt-BR.js"></script> 
  <script>
  $( function() {
   
    $( "#datepicker" ).datepicker({ dateFormat: 'dd/m/y' });
    $('#datepicker').datepicker( $.datepicker.regional[ "hi" ] );

  } );
</script>

      <script>
        paypal.Buttons({
            style: {
                shape: 'pill',
                color: 'blue',
                layout: 'vertical',
                label: 'subscribe'
            },
            createSubscription: function(data, actions) {
              return actions.subscription.create({
                /* Creates the subscription */
                plan_id: 'P-014696710N602254RMDGI5KQ'
              });
            },
            onApprove: function(data, actions) {
                document.getElementById("pagar").click();
            }
        }).render('#paypal-button-container-P-014696710N602254RMDGI5KQ'); // Renders the PayPal button
      </script>

      <script>
        paypal.Buttons({
            style: {
                shape: 'pill',
                color: 'blue',
                layout: 'vertical',
                label: 'subscribe'
            },
            createSubscription: function(data, actions) {
              return actions.subscription.create({
                /* Creates the subscription */
                plan_id: 'P-49N05800SW808751EMDGJC2Y'
              });
            },
            onApprove: function(data, actions) {
              document.getElementById("pagar").click();
            }
        }).render('#paypal-button-container-P-49N05800SW808751EMDGJC2Y'); // Renders the PayPal button
      </script>

      <script>
        paypal.Buttons({
            style: {
                shape: 'pill',
                color: 'blue',
                layout: 'vertical',
                label: 'subscribe'
            },
            createSubscription: function(data, actions) {
              return actions.subscription.create({
                /* Creates the subscription */
                plan_id: 'P-6WU0151704777271JMDGJEOY'
              });
            },
            onApprove: function(data, actions) {
              document.getElementById("pagar").click();
            }
        }).render('#paypal-button-container-P-6WU0151704777271JMDGJEOY'); // Renders the PayPal button
      </script>
<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
