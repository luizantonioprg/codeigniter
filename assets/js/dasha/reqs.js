$("#select_estacionamento,#datepicker").change(function () {
	$("#nav").remove();

	let url = "http://ambiente-desenvolvimento15.provisorio.ws/gomes/codeigniter/populate/filtro2";
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
	//alert(url);

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
			paginar();
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
});

$("#pesquisar1").on("keypress", function (e) {
	if (e.which == 13) {
		$("#nav").remove();
		let url = "http://ambiente-desenvolvimento15.provisorio.ws/gomes/codeigniter/populate/buscar_reservas";
		let params = {};
		document.querySelectorAll("#pesquisar1 input").forEach((element) => {
			if (element.value.length > 0) params[element.id] = element.value;
		});
		let esc = encodeURIComponent;
		let query = Object.keys(params)
			.map((k) => esc(k) + "=" + esc(params[k]))
			.join("&");
		url += "?" + query;
		//alert(url);
		if (document.getElementById("txt").value == "") {
			url = "http://ambiente-desenvolvimento15.provisorio.ws/gomes/codeigniter/populate/buscar_reservas";
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
				paginar();
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
	}
});
$("#pesquisar2").on("keypress", function (e) {
	if (e.which == 13) {
		$("#nav").remove();
		let url = "http://ambiente-desenvolvimento15.provisorio.ws/gomes/codeigniter/populate/buscar_pagamentos";
		let params = {};
		document.querySelectorAll("#pesquisar2 input").forEach((element) => {
			if (element.value.length > 0) params[element.id] = element.value;
		});
		let esc = encodeURIComponent;
		let query = Object.keys(params)
			.map((k) => esc(k) + "=" + esc(params[k]))
			.join("&");
		url += "?" + query;
		// alert(url);
		if (document.getElementById("txt2").value == "") {
			url = "http://ambiente-desenvolvimento15.provisorio.ws/gomes/codeigniter/populate/buscar_pagamentos";
		}

		$.ajax({
			type: "GET",
			url: url,
			beforeSend: function () {
				console.log("antes");
				$("#tabelaP").hide();
				$("#tabelaP").find("tbody").empty();
				$("#nav2").remove();
				$("#loader2").show();
			},
			success: function (data) {
				if (data.length == 0) {
					$("<tr><td>Não há nada para mostrar</td></tr>").appendTo("#tabelaP");
					// $("#tabela").find("span").remove();
					// $("<span id='vazio'>Não há nada para mostrar</span>").appendTo(
					// 	"#tabela"
					// );
				} else {
					$("#vazio").remove();
				}

				populaPagamentos(data);
				paginar3();
				// setTimeout(() => {
				$("#loader2").hide();
				$("#tabelaP").show();
				// alert("suceso");
				// }, 1000);
			},
			error: function (xhr) {
				console.log("deu erro");
			},
			dataType: "JSON",
		});
	}
});
$("#select_estacionamento2,#datepicker2").change(function () {
	$("#nav").remove();

	let url = "http://ambiente-desenvolvimento15.provisorio.ws/gomes/codeigniter/populate/filtro3";
	let params = {};
	document
		.querySelectorAll("#parameters .select-selected-pagamentos")
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
			$("#tabelaP").hide();
			$("#tabelaP").find("tbody").empty();
			$("#nav2").remove();
			$("#loader2").show();
		},
		success: function (data) {
			// console.log(data);
			if (data.length == 0) {
				//$("#tabela").find("td").remove();
				$("<tr><td>Não há nada para mostrar</td></tr>").appendTo("#tabelaP");
				// $("#tabela").find("span").remove();
				// $("<span id='vazio'>Não há nada para mostrar</span>").appendTo(
				// 	"#tabela"
				// );
			} else {
				$("#vazio").remove();
			}
			populaPagamentos(data);
			paginar3();
			// setTimeout(() => {
			$("#loader2").hide();
			$("#tabelaP").show();
			// }, 1000);
		},
		error: function (xhr) {
			console.log("deu erro");
		},
		dataType: "JSON",
	});
});