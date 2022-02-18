$(document).ready(function () {
document.getElementById("formulario_reserva").style.display = "block";
	$id = document.getElementById("id_usuario").value;
	url = "http://ambiente-desenvolvimento15.provisorio.ws/gomes/codeigniter/reservas/taSemCredito?id=" + $id;
	$.ajax({
		type: "GET",
		url: url,
		beforeSend: function () {},
		success: function (data) {
			if (data == 0) {
				$url = "http://ambiente-desenvolvimento15.provisorio.ws/gomes/codeigniter/login/index";
				$("#respostaAJAX").remove();
				$(
					"<h4 id='respostaAJAX'>Assine um plano para ter créditos de reserva <a href='" +
						$url +
						"'>aqui</a></h4>"
				).prependTo("#containerReservaForm");

				$arr = document.querySelectorAll(".data");

				for ($i = 0; $i < $arr.length; $i++) {
					$arr[$i].style.pointerEvents = "none";
				}
			}
		},
		error: function (xhr) {
			console.log("deu erro");
		},
		dataType: "JSON",
	});
});

if (
	(value_or_null = (document.cookie.match(
		/^(?:.*;)?\s*KJDa990\s*=\s*([^;]+)(?:.*)?$/
	) || [, null])[1])
) {
	$data_escolhida = document.getElementById("data_escolhida").value;

	$arr = document.querySelectorAll(".data");

	for ($i = 0; $i < $arr.length; $i++) {
		if ($arr[$i].innerText == $data_escolhida) {
			$arr[$i].click();
		}
	}
}
function disponivel($texto, $id_est) {
	document.getElementById("input_data").value = $texto;
	document.getElementById("formulario_reserva").style.display = "none";
	$items = document.querySelectorAll(".data");

	for ($i = 0; $i < $items.length; $i++) {
		$items[$i].style.color = "white";
	}
	document.getElementById($id_est).style.color = "#6faaff";
	$data = $texto;
	$id = document.getElementById("id_estacionamento").value;
	url =
		"http://ambiente-desenvolvimento15.provisorio.ws/gomes/codeigniter/reservas/isDisponivel?id_estacionamento=" +
		$id +
		"&data=" +
		$data;
	$.ajax({
		type: "GET",
		url: url,
		beforeSend: function () {},
		success: function (data) {
			if (data == 0) {
				$("#respostaAJAX").remove();
				$("<h4 id='respostaAJAX'>Indisponível</h4>").prependTo(
					"#containerReservaForm"
				);
			} else {
				document.getElementById("formulario_reserva").style.display = "block";
				$("#respostaAJAX").remove();
				$(
					"<h4 id='respostaAJAX'>Disponível com " + data + " vagas</h4>"
				).prependTo("#containerReservaForm");
			}
			$("#cpf").mask("999.999.999-99");
		},
		error: function (xhr) {
			console.log("deu erro");
		},
		dataType: "JSON",
	});
}
// via cep

function limpa_formulário_cep() {
	//Limpa valores do formulário de cep.
	document.getElementById("rua").value = "";
	document.getElementById("bairro").value = "";
	document.getElementById("cidade").value = "";
	document.getElementById("uf").value = "";
	document.getElementById("ibge").value = "";
}

function meu_callback(conteudo) {
	if (!("erro" in conteudo)) {
		//Atualiza os campos com os valores.
		document.getElementById("rua").value = conteudo.logradouro;
		document.getElementById("bairro").value = conteudo.bairro;
		document.getElementById("cidade").value = conteudo.localidade;
		document.getElementById("uf").value = conteudo.uf;
		document.getElementById("ibge").value = conteudo.ibge;
	} //end if.
	else {
		//CEP não Encontrado.
		limpa_formulário_cep();
		alert("CEP não encontrado.");
	}
}

function pesquisacep(valor) {
	//Nova variável "cep" somente com dígitos.
	var cep = valor.replace(/\D/g, "");

	//Verifica se campo cep possui valor informado.
	if (cep != "") {
		//Expressão regular para validar o CEP.
		var validacep = /^[0-9]{8}$/;

		//Valida o formato do CEP.
		if (validacep.test(cep)) {
			//Preenche os campos com "..." enquanto consulta webservice.
			document.getElementById("rua").value = "...";
			document.getElementById("bairro").value = "...";
			document.getElementById("cidade").value = "...";
			document.getElementById("uf").value = "...";
			// document.getElementById("ibge").value = "...";

			//Cria um elemento javascript.
			var script = document.createElement("script");

			//Sincroniza com o callback.
			script.src =
				"https://viacep.com.br/ws/" + cep + "/json/?callback=meu_callback";

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
}
