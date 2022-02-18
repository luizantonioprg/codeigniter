<?php
  if(!isset($_SESSION['loggedin'])){
    redirect('/');
  }
  foreach($estacionamento as $item):
    $datas = explode(',',$item->datas);
  
    if(isset($data_escolhida)):
      echo "<input type='hidden' id='data_escolhida' value='$data_escolhida'></input>";
    endif;
print_r($vagas);
?>

<div class="containerGeralIntegra">
<input type='hidden' value='<?php 
	if(isset($id_do_usuario)){
		echo $id_do_usuario;
	}else{
		echo $_SESSION['loggedin']['id'];
	}
		
	?>'>
</input>
  <div class="containerDados">

    <div class="containerEstacionamento">
      <div class="containerImagemEstacionamento">
          <h3><?php echo $item->titulo;?></h3>
          <img src="<?php echo base_url().'uploads/'.$item->imagem?>">
      </div>
      <div class="containerInfoEstacionamento">
        <h4>Vagas diárias: <?php echo $item->numero_vagas;?></h4>
        <h4>Email: <?php echo $item->email;?></h4>
        <h4>CEP: <?php echo $item->cep;?></h4>
        <h4>Endereço: <?php echo $item->rua.", ".$item->numero." - ".$item->bairro."( ".$item->cidade." / ".$item->uf." )";?></h4>
      </div>
    </div>

  </div>
  <div class="containerReserva">
   <!--  <div class='headerContainerReserva'>
        <h4>Selecione uma data para verificar a disponibilidade</h4>
        <div class='containerDatas' id='containerDatas'>
          <?php
            for($i=0;$i<sizeof($datas);$i++):
              echo "<div class='data' id='data$i'onclick='disponivel(this.innerText,this.id)'><h4>".$datas[$i]."<h4></div>";
            endfor;
          ?>
          
        </div>
    </div> -->
    <div class='containerReservaForm' id='containerReservaForm'>
          <div>
             <!--  <form class='formulario_reserva' id='formulario_reserva' method="post" action="<?php echo base_url(); ?>reservas/reservar"> -->
              <form class='formulario_reserva' id='formulario_reserva' method="post" action="<?php echo base_url(); ?>reservas/reservarNova">
                <input type='hidden' id='datas_banco' name='datas_banco' value='<?php 
if(isset($_POST['datas_banco'])){
echo $_POST['datas_banco'];
}else{
  echo implode(",",$vagas);
}

?>'></input>
                    <div class='erroRe'>
                    <?php echo validation_errors("<h4>","</h4>")?>
                    </div>
                    
                    <input value='<?php echo set_value('cpf'); ?>' type='text' name='cpf' id='cpf' placeholder='CPF'></input>
                    <input value='<?php echo set_value('cep'); ?>' type='text' name='cep' placeholder='CEP' onblur="pesquisacep(this.value);"></input><br>
                    <input value='<?php echo set_value('estado'); ?>' type='text' id='uf' name='estado' placeholder='ESTADO'></input>
                    <input value='<?php echo set_value('cidade'); ?>' type='text' id="cidade"  name='cidade' placeholder='CIDADE'></input><br>
                    <input value='<?php echo set_value('rua'); ?>' type='text' id="rua"  name='rua' class='cem' placeholder='RUA'></input><br>
                    <input value='<?php echo set_value('bairro'); ?>' type='text' id="bairro"  name='bairro' placeholder='BAIRRO'></input>
                    <input value='<?php echo set_value('numero'); ?>' type='text' name='numero' placeholder='NÚMERO'></input><br>
                    <input value='<?php echo set_value('marcaemodelo'); ?>' type='text' name='marcaemodelo' placeholder='MARCA+MODELO'></input>
                    <input value='<?php echo set_value('placa'); ?>' type='text' name='placa' placeholder='PLACA'></input><br>
                   <!--  <input type='text' name='data' id='input_data' class='cem' placeholder='DATA'  readonly="readonly"></input> -->
                   <input type="hidden" name='titulo' value='<?php 
                   if(isset($_POST['titulo'])):
                    echo $_POST['titulo'];
                   else:
                    echo $_GET['titulo'];
                   endif;
                   ?>'></input>

                   <input id="mdp-demo" name='datas_escolhidas' placeholder="SELECIONE DATAS"></input>
                    <input type="hidden" name='id_estacionamento' id='id_estacionamento' value='<?php echo $item->id;?>'></input>
                    <input type="hidden" name='id_usuario' id='id_usuario' value='<?php 
				if(isset($id_do_usuario)){
					echo $id_do_usuario;
				}else{
					echo $_SESSION['loggedin']['id'];
				}	
		    ?>'></input>
                    <button id='sub_form' type='submit'>RESERVAR</button>
                    <?php
                          if(isset($reserva_realizada)){
                            echo "<h4 class='realizou'>$reserva_realizada<h4>";
                          }
                          if(isset($acabou_credito)){
                            echo "<h4 class='realizou'>$acabou_credito<h4>";
                          }
			if(isset($mais_vagas_doq_credito)){
				echo "<h4 class='realizou'>$mais_vagas_doq_credito<h4>";
			}

                    ?>
              </form>
             <!--  <form method="post" action="<?php echo base_url(); ?>user/selecao_multipla_view">
                      <input type='hidden' name='titulo_estacionamento' value='<?php 
                      if(isset($_GET['titulo'])){
                        $_SESSION['titulo'] = $_GET['titulo'];
                        echo $_GET['titulo'];
                      }else{
                        echo $_SESSION['titulo'];
                      }
                      
                      ?>'></input>
                      <button type='selecao_multipla_submit'>SELEÇÃO MULTIPLA</button>
              </form>
             -->
          </div>
    </div>
  </div>
 
 
 

  </div>
 
<?php
  endforeach;
?>  
<script src="<?php echo base_url(); ?>assets/js/jquery.maskedinput-1.1.4.pack.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/integra.js" type="text/javascript"></script>
<script>
    $("#cpf").mask("999.999.999-99");
</script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="<?php echo base_url(); ?>assets/js/datepicker-pt-BR.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/nova/1.js"></script>

<script src="<?php echo base_url(); ?>assets/js/nova/2.js"></script>

<script src="<?php echo base_url(); ?>assets/js/nova/3.js"></script>

<script src="<?php echo base_url(); ?>assets/js/nova/4.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" crossorigin="anonymous"></script>
 <script>
var datas = [];
var today = new Date();

var getDaysBetweenDates = function(startDate, endDate) {
        var now = startDate.clone(), dates = [];
  
        while (now.isSameOrBefore(endDate)) {
            dates.push(now.format('DD/M/YY'));
            now.add(1, 'days');
        }
        return dates;
    };
  
    var startDate = moment('2021-01-01');
    var endDate = moment('2021-10-31');
  
    var dateList = getDaysBetweenDates(startDate, endDate);
    var diasSelecionadosInput = document.getElementById("datas_banco").value;
    var diasSelecionados = diasSelecionadosInput.replace(/\s+/g, '').split(',');
    
    // TIRA AS DATAS DO BANCO DA ARRAY QUE VAI SER O VALUE DO CALENDARIO
    for (var i = dateList.length - 1; i >= 0; i--) {
    for (var j = 0; j < diasSelecionados.length; j++) {
      if (dateList[i] === diasSelecionados[j]) {
        dateList.splice(i, 1);
        }
      }
    }
  //console.log(dateList);

  $('#mdp-demo').multiDatesPicker({
      
        dateFormat: "d/m/y", 
        addDisabledDates: dateList

    });

   </script>
<script src="<?php echo base_url(); ?>assets/js/datepicker-pt-BR.js"></script> 
  <script>
  $( function() {
   
    $('#mdp-demo').datepicker( $.datepicker.regional[ "hi" ] );
 

  } );
</script>