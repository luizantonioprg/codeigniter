window.onload = function () {
	paginarNova1();
	paginarNova2();
	$("#loader").hide();
	$("#loader2").hide();
	$id = document.getElementById("id_usuario").value;
	let url2 = "http://ambiente-desenvolvimento15.provisorio.ws/gomes/codeigniter/user/info?id=" + $id;
	$.ajax({
		type: "GET",
		url: url2,
		beforeSend: function () {
			$("#loader").show();
		},
		success: function (data) {
			$("#loader").hide();
			document.getElementById("usuario_nome").innerText = data[0]["nome"];
			document.getElementById("usuario_credito").innerText = data[0]["credito"];
		},
		error: function (xhr) {
			console.log("deu erro");
		},
		dataType: "JSON",
	});

	// /* POPULA RESERVAS */
	let url3 = "http://ambiente-desenvolvimento15.provisorio.ws/gomes/codeigniter/user/allReservas";
	$.ajax({
		type: "GET",
		url: url3,
		beforeSend: function () {
			$("#loader").show();
		},
		success: function (data) {
			$("#loader").hide();
			if (data.length == 0) {
				$("<tr><td>Não há nada para mostrar</td></tr>").appendTo("#tabela");
			} else {
				$("#vazio").remove();
			}
			popula(data);
			paginar();
			$("#loader").hide();
			$("#tabela").show();
		},
		error: function (xhr) {
			console.log("deu erro");
		},
		dataType: "JSON",
	});
	/* POPULA PAGAMENTOS */
	let url6 = "http://ambiente-desenvolvimento15.provisorio.ws/gomes/codeigniter/user/allPagamentos";

	$.ajax({
		type: "GET",
		url: url6,
		beforeSend: function () {
			$("#loader2").show();
		},
		success: function (data) {
			$("#loade2").hide();
			if (data.length == 0) {
				$("<tr><td>Não há nada para mostrar</td></tr>").appendTo("#tabelaP");
			} else {
				$("#vazio").remove();
			}
			populaPagamentos(data);
			paginar2();

			$("#tabelaP").show();
			$("#loader2").hide();
		},
		error: function (xhr) {
			console.log("deu erro");
		},
		dataType: "JSON",
	});
	/*POPULA ESTACIONAMENTOS */
	let url8 = "http://ambiente-desenvolvimento15.provisorio.ws/gomes/codeigniter/populate/filtro1";
	$.ajax({
		type: "GET",
		url: url8,
		beforeSend: function () {
			// $("#loader").show();
		},
		success: function (data) {
			console.log(data);
			populaEstacionamentos(data);
			paginarEst();
		},
		error: function (xhr) {
			console.log("deu erro");
		},
		dataType: "JSON",
	});

	/*FIM */
	/* fim pag */
	document.getElementById("defaultOpen").click();

	if (
		(value_or_null = (document.cookie.match(
			/^(?:.*;)?\s*TTTlpq\s*=\s*([^;]+)(?:.*)?$/
		) || [, null])[1])
	) {
		document.getElementById("criar").click();
		setTimeout(deleteAllCookies(), 50);
	}
//nova
	if (
		(value_or_null = (document.cookie.match(
			/^(?:.*;)?\s*TTTlpqSUCESS\s*=\s*([^;]+)(?:.*)?$/
		) || [, null])[1])
	) {
		document.getElementById("gerenciar_usuarios").click();
		setTimeout(deleteAllCookies(), 1000);
	}
	if (
		(value_or_null = (document.cookie.match(
			/^(?:.*;)?\s*QQQomdaw\s*=\s*([^;]+)(?:.*)?$/
		) || [, null])[1])
	) {
		document.getElementById("planos2").click();
		setTimeout(deleteAllCookies(), 1000);
	}

	if (
		(value_or_null = (document.cookie.match(
			/^(?:.*;)?\s*pLOFFTO\s*=\s*([^;]+)(?:.*)?$/
		) || [, null])[1])
	) {
		// alert('oi');
		document.getElementById("categorias").click();
		setTimeout(deleteAllCookies(), 1000);
	}

	if (
		(value_or_null = (document.cookie.match(
			/^(?:.*;)?\s*PapKolo\s*=\s*([^;]+)(?:.*)?$/
		) || [, null])[1])
	) {
		// alert('oi');
		document.getElementById("criar_categoria").click();
		setTimeout(deleteAllCookies(), 1000);
	}
	if (
		(value_or_null = (document.cookie.match(
			/^(?:.*;)?\s*TRAtrad\s*=\s*([^;]+)(?:.*)?$/
		) || [, null])[1])
	) {
		// alert('oi');
		document.getElementById("categorias").click();
		setTimeout(deleteAllCookies(), 1000);
	}

	if (
		(value_or_null = (document.cookie.match(
			/^(?:.*;)?\s*PimpTOK\s*=\s*([^;]+)(?:.*)?$/
		) || [, null])[1])
	) {
		// alert('oi');
		document.getElementById("gerenciar_usuarios").click();
		setTimeout(deleteAllCookies(), 1000);
	}
	if (
		(value_or_null = (document.cookie.match(
			/^(?:.*;)?\s*QQOKADMLOO\s*=\s*([^;]+)(?:.*)?$/
		) || [, null])[1])
	) {
		// alert('oi');
		document.getElementById("gerenciar_usuarios").click();
		setTimeout(deleteAllCookies(), 1000);
	}
// here
	if (
		(value_or_null = (document.cookie.match(
			/^(?:.*;)?\s*RRRGBA\s*=\s*([^;]+)(?:.*)?$/
		) || [, null])[1])
	) {
		// alert('oi');
		document.getElementById("cadastrar_estacionamento").click();
		setTimeout(deleteAllCookies(), 1000);
	}

	if (
		(value_or_null = (document.cookie.match(
			/^(?:.*;)?\s*Toakqpl\s*=\s*([^;]+)(?:.*)?$/
		) || [, null])[1])
	) {
		// alert('oi');
		document.getElementById("gerenciar_estacionamentos").click();
		setTimeout(deleteAllCookies(), 1000);
	}
//novo
	if (
		(value_or_null = (document.cookie.match(
			/^(?:.*;)?\s*RRRGBASUC\s*=\s*([^;]+)(?:.*)?$/
		) || [, null])[1])
	) {
		// alert('oi');
		document.getElementById("gerenciar_estacionamentos").click();
		setTimeout(deleteAllCookies(), 1000);
	}
};
function popula(data) {
	for ($i = 0; $i < data.length; $i++) {
		$dia = data[$i]["data"].split("/")[0];
		$mes = data[$i]["data"].split("/")[1];

		var $tr = $("<tr>")
			.append($("<td>").text(data[$i]["nome"]))
			.append($("<td>").text(data[$i]["titulo"]))
			.append($("<td>").text($dia))
			.append($("<td>").text($mes))
			.appendTo("#tabela");
	}
}
function populaEstacionamentos(data) {
	for ($i = 0; $i < data.length; $i++) {
		// $dia = data[$i]["data"].split("/")[0];
		// $mes = data[$i]["data"].split("/")[1];

		var $tr = $("<tr>")
			.append($("<td>").text(data[$i]["titulo"]))
			.append($("<td>").text(data[$i]["numero_vagas"]))
			.append(
				$(
					"<a href='" +
						"http://ambiente-desenvolvimento15.provisorio.ws/gomes/codeigniter/user/editar_estacionamento?titulo=" +
						data[$i]["titulo"] +
						"' style='margin-right:5px'>EDITAR</a><a href='http://ambiente-desenvolvimento15.provisorio.ws/gomes/codeigniter/user/deletar_estacionamento?titulo=" +
						data[$i]["titulo"] +
						"'>EXCLUIR</a>"
				)
			)
			.appendTo("#tabelaE");
	}
}
function paginar3() {
	$("#tabelaP").after('<div id="nav2"></div>');
	var rowsShown = 10;
	var rowsTotal = $("#tabelaP tbody tr").length;
	var numPages = rowsTotal / rowsShown;
	//console.log(rowsTotal);
	for (i = 0; i < numPages; i++) {
		var pageNum = i + 1;
		$("#nav2").append(
			'<a tabindex="0" href="#" rel="' + i + '">' + pageNum + "</a> "
		);
	}
	$("#tabelaP tbody tr").hide();
	$("#tabelaP tbody tr").slice(0, rowsShown).show();
	$("#nav2 a:first").addClass("active");
	$("#nav2 a").bind("click", function () {
		$("#nav2 a").removeClass("active");
		$(this).addClass("active");
		var currPage = $(this).attr("rel");
		var startItem = currPage * rowsShown;
		var endItem = startItem + rowsShown;
		$("#tabelaP tbody tr")
			.css("opacity", "0.0")
			.hide()
			.slice(startItem, endItem)
			.css("display", "table-row")
			.animate({ opacity: 1 }, 300);
	});
}

function paginarEst() {
	$("#tabelaE").after('<div id="nav4"></div>');
	var rowsShown = 10;
	var rowsTotal = $("#tabelaE tbody tr").length;
	var numPages = rowsTotal / rowsShown;
	//console.log(rowsTotal);
	for (i = 0; i < numPages; i++) {
		var pageNum = i + 1;
		$("#nav4").append(
			'<a tabindex="0" href="#" rel="' + i + '">' + pageNum + "</a> "
		);
	}
	$("#tabelaE tbody tr").hide();
	$("#tabelaE tbody tr").slice(0, rowsShown).show();
	$("#nav4 a:first").addClass("active");
	$("#nav4 a").bind("click", function () {
		$("#nav4 a").removeClass("active");
		$(this).addClass("active");
		var currPage = $(this).attr("rel");
		var startItem = currPage * rowsShown;
		var endItem = startItem + rowsShown;
		$("#tabelaE tbody tr")
			.css("opacity", "0.0")
			.hide()
			.slice(startItem, endItem)
			.css("display", "table-row")
			.animate({ opacity: 1 }, 300);
	});
}
function populaPagamentos(data) {
	for ($i = 0; $i < data.length; $i++) {
		$dia = data[$i]["data_pagamento"].split("/")[0];
		$mes = data[$i]["data_pagamento"].split("/")[1];
		var $tr = $("<tr>")
			.append($("<td>").text($dia))
			.append($("<td>").text($mes))
			.append($("<td>").text(data[$i]["plano"]))
			.append($("<td>").text(data[$i]["nome"]))
			.appendTo("#tabelaP");
	}
}
function paginar() {
	$("#tabela").after('<div id="nav"></div>');
	var rowsShown = 10;
	var rowsTotal = $("#tabela tbody tr").length;
	var numPages = rowsTotal / rowsShown;
	//console.log(rowsTotal);
	for (i = 0; i < numPages; i++) {
		var pageNum = i + 1;
		$("#nav").append(
			'<a tabindex="0" href="#" rel="' + i + '">' + pageNum + "</a> "
		);
	}
	$("#tabela tbody tr").hide();
	$("#tabela tbody tr").slice(0, rowsShown).show();
	$("#nav a:first").addClass("active");
	$("#nav a").bind("click", function () {
		$("#nav a").removeClass("active");
		$(this).addClass("active");
		var currPage = $(this).attr("rel");
		var startItem = currPage * rowsShown;
		var endItem = startItem + rowsShown;
		$("#tabela tbody tr")
			.css("opacity", "0.0")
			.hide()
			.slice(startItem, endItem)
			.css("display", "table-row")
			.animate({ opacity: 1 }, 300);
	});
}
function paginar2() {
	$("#tabelaP").after('<div id="nav2"></div>');
	var rowsShown = 10;
	var rowsTotal = $("#tabelaP tbody tr").length;
	var numPages = rowsTotal / rowsShown;
	//console.log(rowsTotal);
	for (i = 0; i < numPages; i++) {
		var pageNum = i + 1;
		$("#nav2").append(
			'<a tabindex="0" href="#" rel="' + i + '">' + pageNum + "</a> "
		);
	}
	$("#tabelaP tbody tr").hide();
	$("#tabelaP tbody tr").slice(0, rowsShown).show();
	$("#nav2 a:first").addClass("active");
	$("#nav2 a").bind("click", function () {
		$("#nav2 a").removeClass("active");
		$(this).addClass("active");
		var currPage = $(this).attr("rel");
		var startItem = currPage * rowsShown;
		var endItem = startItem + rowsShown;
		$("#tabelaP tbody tr")
			.css("opacity", "0.0")
			.hide()
			.slice(startItem, endItem)
			.css("display", "table-row")
			.animate({ opacity: 1 }, 300);
	});
}
function deleteAllCookies() {
	var c = document.cookie.split("; ");
	for (i in c)
		document.cookie =
			/^[^=]+/.exec(c[i])[0] + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
}
function paginarNova1() {
	$("#tabelaNova1").after('<div id="navNova1"></div>');
	var rowsShown = 10;
	var rowsTotal = $("#tabelaNova1 tbody tr").length;
	var numPages = rowsTotal / rowsShown;
	//console.log(rowsTotal);
	for (i = 0; i < numPages; i++) {
		var pageNum = i + 1;
		$("#navNova1").append(
			'<a tabindex="0" href="#" rel="' + i + '">' + pageNum + "</a> "
		);
	}
	$("#tabelaNova1 tbody tr").hide();
	$("#tabelaNova1 tbody tr").slice(0, rowsShown).show();
	$("#navNova1 a:first").addClass("active");
	$("#navNova1 a").bind("click", function () {
		$("#navNova1 a").removeClass("active");
		$(this).addClass("active");
		var currPage = $(this).attr("rel");
		var startItem = currPage * rowsShown;
		var endItem = startItem + rowsShown;
		$("#tabelaNova1 tbody tr")
			.css("opacity", "0.0")
			.hide()
			.slice(startItem, endItem)
			.css("display", "table-row")
			.animate({ opacity: 1 }, 300);
	});
}
function paginarNova2() {
	$("#tabelaNova2").after('<div id="navNova2"></div>');
	var rowsShown = 10;
	var rowsTotal = $("#tabelaNova2 tbody tr").length;
	var numPages = rowsTotal / rowsShown;
	//console.log(rowsTotal);
	for (i = 0; i < numPages; i++) {
		var pageNum = i + 1;
		$("#navNova2").append(
			'<a tabindex="0" href="#" rel="' + i + '">' + pageNum + "</a> "
		);
	}
	$("#tabelaNova2 tbody tr").hide();
	$("#tabelaNova2 tbody tr").slice(0, rowsShown).show();
	$("#navNova2 a:first").addClass("active");
	$("#navNova2 a").bind("click", function () {
		$("#navNova2 a").removeClass("active");
		$(this).addClass("active");
		var currPage = $(this).attr("rel");
		var startItem = currPage * rowsShown;
		var endItem = startItem + rowsShown;
		$("#tabelaNova2 tbody tr")
			.css("opacity", "0.0")
			.hide()
			.slice(startItem, endItem)
			.css("display", "table-row")
			.animate({ opacity: 1 }, 300);
	});
}