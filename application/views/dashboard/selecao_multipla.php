<?php
foreach($info as $item):
  $id_estacionamento = $item->id;
endforeach;

?>
<h2 style='color:white;'>SELECAO MULTIPLA DE VAGAS</h2>



<form class='' id='formulario_reserva' method="post" action="<?php echo base_url(); ?>reservas/reservarNova">
<input type='hidden' id='datas_banco' name='datas_banco' value='<?php 
if(isset($_POST['datas_banco'])){
echo $_POST['datas_banco'];
}else{
  echo implode(",",$vagas);
}

?>'></input>
                    <div class='erroRe'>
                    <?php echo validation_errors("<h4 style='color:red'>","</h4>")?>
                    </div>
                    <input id="mdp-demo" name='datas_escolhidas'></input>
                    <input value='<?php echo set_value('cpf'); ?>' type='text' name='cpf' id='cpf' placeholder='CPF'></input>
                    <input value='<?php echo set_value('cep'); ?>' type='text' name='cep' placeholder='CEP' onblur="pesquisacep(this.value);"></input><br>
                    <input value='<?php echo set_value('estado'); ?>' type='text' id='uf' name='estado' placeholder='ESTADO'></input>
                    <input value='<?php echo set_value('cidade'); ?>' type='text' id="cidade"  name='cidade' placeholder='CIDADE'></input><br>
                    <input value='<?php echo set_value('rua'); ?>' type='text' id="rua"  name='rua' class='cem' placeholder='RUA'></input><br>
                    <input value='<?php echo set_value('bairro'); ?>' type='text' id="bairro"  name='bairro' placeholder='BAIRRO'></input>
                    <input value='<?php echo set_value('numero'); ?>' type='text' name='numero' placeholder='NÚMERO'></input><br>
                    <input value='<?php echo set_value('marcaemodelo'); ?>' type='text' name='marcaemodelo' placeholder='MARCA+MODELO'></input>
                    <input value='<?php echo set_value('placa'); ?>' type='text' name='placa' placeholder='PLACA'></input><br>
                
                    <input type="hidden" name='id_estacionamento' id='id_estacionamento' value='<?php echo $id_estacionamento;?>'></input>
                    <input type="hidden" name='titulo' value='<?php echo $titulo;?>'></input>
                    <input type="hidden" name='id_usuario' id='id_usuario' value='<?php echo $_SESSION['loggedin']['id'];?>'></input>
                    <button id='' type='submit'>RESERVAR</button>
                    <?php
                          if(isset($reserva_realizada)){
                            echo "<h4 class='realizou' style='color:#C2C249'>$reserva_realizada<h4>";
                          }

                    ?>
              </form>




            
<!-- Adicionando Javascript -->
<script>
    
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
           // document.getElementById('ibge').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
           // document.getElementById('ibge').value=(conteudo.ibge);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";
               // document.getElementById('ibge').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };

    </script>




























<script src="<?php echo base_url(); ?>assets/js/jquery.maskedinput-1.1.4.pack.js" type="text/javascript"></script>
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
<script>




</script>
