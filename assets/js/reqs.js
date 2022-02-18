$estados = [];

$("#defaultOpen").click(function () {
	$.get(
		"https://servicodados.ibge.gov.br/api/v1/localidades/estados?orderBy=nome",
		function (data, status) {
			for ($i = 0; $i < data.length; $i++) {
				$estados.push(data[$i]["sigla"]);
			}
			for ($i = 0; $i < $estados.length; $i++) {
				var opt = document.createElement("option");
				opt.value = $estados[$i];
				opt.innerHTML = $estados[$i];
				document.getElementById("select_estados").appendChild(opt);
			}
		}
	);
});

$("#select_estados").change(function () {
	$municipios = [];
	document.getElementById("container_municipio").style.display = "inline";

	$.get(
		"https://servicodados.ibge.gov.br/api/v1/localidades/estados/" +
			this.value +
			"/distritos?orderBy=nome",
		function (data, status) {
			for ($i = 0; $i < data.length; $i++) {
				$municipios.push(data[$i]["nome"]);
				document.getElementById("select_municipios");
				while (
					document.getElementById("select_municipios").options.length > 0
				) {
					document.getElementById("select_municipios").remove(0);
				}
			}

			var opt = document.createElement("option");
			opt.value = "";
			opt.innerHTML = "";
			document.getElementById("select_municipios").appendChild(opt);

			for ($i = 0; $i < $municipios.length; $i++) {
				var opt = document.createElement("option");
				opt.value = $municipios[$i];
				opt.innerHTML = $municipios[$i];
				document.getElementById("select_municipios").appendChild(opt);
			}
		}
	);
});

// FILTRAR

$(document).on("keypress", function (e) {
	if (e.which == 13) {
		// setTimeout(() => {
		let url = "http://ambiente-desenvolvimento15.provisorio.ws/gomes/codeigniter/populate/buscar_estacionamentos";
		let params = {};
		document.querySelectorAll("#pesquisar1 input").forEach((element) => {
			if (element.value.length > 0) params[element.id] = element.value;
		});
		let esc = encodeURIComponent;
		let query = Object.keys(params)
			.map((k) => esc(k) + "=" + esc(params[k]))
			.join("&");
		url += "?" + query;
		// alert(url);

		if (document.getElementById("txt").value == "") {
			url = "http://ambiente-desenvolvimento15.provisorio.ws/gomes/codeigniter/populate/filtro1";
		}

		$.ajax({
			type: "GET",
			url: url,
			beforeSend: function () {
				console.log("antes");
				$("#tabela").hide();
				$("#tabela").find("tbody").empty();
				$("#nav").remove();
				$("#loader").show();
			},
			success: function (data) {
				if (data.length == 0) {
					$("<tr><td>Não há nada para mostrar</td></tr>").appendTo("#tabela");
					// $("#tabela").find("span").remove();
					// $("<span id='vazio'>Não há nada para mostrar</span>").appendTo(
					// 	"#tabela"
					// );
				} else {
					$("#vazio").remove();
				}

				popula(data);
				// setTimeout(() => {
				$("#loader").hide();
				$("#tabela").show();
				// alert("suceso");
				// }, 1000);
			},
			error: function (xhr) {
				console.log("deu erro");
			},
			dataType: "JSON",
		});
		// }, 1000);
	}
});

$("#select_municipios,#select_estados,#select_categorias,#datepicker").change(
	function () {
		// if ($("#select_municipios").css("visibility") !== "hidden") {
		// 	$("#box").css("margin-bottom", "10px");
		// 	alert($("#select_municipios").css("visibility"));
		// }
		$("#nav").remove();

		let url = "http://ambiente-desenvolvimento15.provisorio.ws/gomes/codeigniter/populate/filtro1";
		let params = {};
		document
			.querySelectorAll("#parameters .select-selected")
			.forEach((element) => {
				if (element.value.length > 0) params[element.id] = element.value;
			});
		let esc = encodeURIComponent;
		let query = Object.keys(params)
			.map((k) => esc(k) + "=" + esc(params[k]))
			.join("&");
		url += "?" + query;
		// alert(url);
		$.ajax({
			type: "GET",
			url: url,
			beforeSend: function () {
				console.log("antes");
				$("#tabela").hide();
				$("#tabela").find("tbody").empty();
				$("#nav").remove();
				$("#loader").show();
			},
			success: function (data) {
				if (data.length == 0) {
					//$("#tabela").find("td").remove();
					$("<tr><td>Não há nada para mostrar</td></tr>").appendTo("#tabela");
					// $("#tabela").find("span").remove();
					// $("<span id='vazio'>Não há nada para mostrar</span>").appendTo(
					// 	"#tabela"
					// );
				} else {
					$("#vazio").remove();
				}
				popula(data);
				// setTimeout(() => {
				$("#loader").hide();
				$("#tabela").show();
				// }, 1000);
			},
			error: function (xhr) {
				console.log("deu erro");
			},
			dataType: "JSON",
		});
	}
);

function popula(data) {
	for ($i = 0; $i < data.length; $i++) {
		var $tr = $("<tr>")
			.append(
				$("<td onclick=integra(this.innerText)>").text(data[$i]["titulo"]),
				$("<td>").text(
					data[$i]["rua"] +
						", " +
						data[$i]["numero"] +
						" - " +
						data[$i]["bairro"] +
						"( " +
						data[$i]["cidade"] +
						" / " +
						data[$i]["uf"] +
						" )"
				),
				$("<td>").text(data[$i]["titulo_categoria"]),
				$("<td>").text(data[$i]["numero_vagas"])
			)
			.appendTo("#tabela");
	}
	// setTimeout(() => {
	paginar();
	// }, 500);
}
function integra(estacionamento) {
	$url = "http://ambiente-desenvolvimento15.provisorio.ws/gomes/codeigniter/user/integra?titulo=";
	location.href = $url + estacionamento;
}
