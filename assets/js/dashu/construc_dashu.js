window.onload = function () {
	var today = new Date();
	var dd = String(today.getDate()).padStart(1, "0");
	var mm = String(today.getMonth() + 1).padStart(1, "0"); //January is 0!
	var yyyy = today.getFullYear() % 100;

	today = dd + "/" + mm + "/" + yyyy;

	$("#data_pagamento").attr("value", today);
	paginar2();
	paginar3();
	$("#loader").hide();
	if (
		(value_or_null = (document.cookie.match(
			/^(?:.*;)?\s*p4VkYpf\s*=\s*([^;]+)(?:.*)?$/
		) || [, null])[1])
	) {
		document.getElementById("meus_dados").click();
	}

	if (
		(value_or_null = (document.cookie.match(
			/^(?:.*;)?\s*OOpTqs\s*=\s*([^;]+)(?:.*)?$/
		) || [, null])[1])
	) {
		document.getElementById("meus_dados").click();
	}

	if (
		(value_or_null = (document.cookie.match(
			/^(?:.*;)?\s*PAplq56\s*=\s*([^;]+)(?:.*)?$/
		) || [, null])[1])
	) {
		document.getElementById("creditos").click();
	}

	$("#nav").remove();
	document.getElementById("MENSAL").style.display = "block";
	$("#paypal-button-container-P-014696710N602254RMDGI5KQ").show();
	$("#paypal-button-container-P-49N05800SW808751EMDGJC2Y").hide();
	$("#paypal-button-container-P-6WU0151704777271JMDGJEOY").hide();

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

	$id = document.getElementById("id_usuario").value;
	let url2 = "http://ambiente-desenvolvimento15.provisorio.ws/gomes/codeigniter/user/info?id=" + $id;
	$.ajax({
		type: "GET",
		url: url2,
		beforeSend: function () {},
		success: function (data) {
			document.getElementById("usuario_nome").innerText = data[0]["nome"];
			document.getElementById("usuario_credito").innerText = data[0]["credito"];
		},
		error: function (xhr) {
			console.log("deu erro");
		},
		dataType: "JSON",
	});
};

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
	$("#tabela2").after('<div id="nav2"></div>');
	var rowsShown = 10;
	var rowsTotal = $("#tabela2 tbody tr").length;
	var numPages = rowsTotal / rowsShown;
	//console.log(rowsTotal);
	for (i = 0; i < numPages; i++) {
		var pageNum = i + 1;
		$("#nav2").append(
			'<a tabindex="0" href="#" rel="' + i + '">' + pageNum + "</a> "
		);
	}
	$("#tabela2 tbody tr").hide();
	$("#tabela2 tbody tr").slice(0, rowsShown).show();
	$("#nav2 a:first").addClass("active");
	$("#nav2 a").bind("click", function () {
		$("#nav2 a").removeClass("active");
		$(this).addClass("active");
		var currPage = $(this).attr("rel");
		var startItem = currPage * rowsShown;
		var endItem = startItem + rowsShown;
		$("#tabela2 tbody tr")
			.css("opacity", "0.0")
			.hide()
			.slice(startItem, endItem)
			.css("display", "table-row")
			.animate({ opacity: 1 }, 300);
	});
}

function paginar3() {
	$("#tabela3").after('<div id="nav3"></div>');
	var rowsShown = 10;
	var rowsTotal = $("#tabela3 tbody tr").length;
	var numPages = rowsTotal / rowsShown;
	//console.log(rowsTotal);
	for (i = 0; i < numPages; i++) {
		var pageNum = i + 1;
		$("#nav3").append(
			'<a tabindex="0" href="#" rel="' + i + '">' + pageNum + "</a> "
		);
	}
	$("#tabela3 tbody tr").hide();
	$("#tabela3 tbody tr").slice(0, rowsShown).show();
	$("#nav3 a:first").addClass("active");
	$("#nav3 a").bind("click", function () {
		$("#nav3 a").removeClass("active");
		$(this).addClass("active");
		var currPage = $(this).attr("rel");
		var startItem = currPage * rowsShown;
		var endItem = startItem + rowsShown;
		$("#tabela3 tbody tr")
			.css("opacity", "0.0")
			.hide()
			.slice(startItem, endItem)
			.css("display", "table-row")
			.animate({ opacity: 1 }, 300);
	});
}
