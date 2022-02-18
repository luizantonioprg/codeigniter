window.onload = function () {
	$("#loader").hide();
	if (
		(value_or_null = (document.cookie.match(
			/^(?:.*;)?\s*n4Ka2LP\s*=\s*([^;]+)(?:.*)?$/
		) || [, null])[1])
	) {
		document.getElementById("logincadastro").click();
	} else if (
		(value_or_null = (document.cookie.match(
			/^(?:.*;)?\s*4kPoqKKam\s*=\s*([^;]+)(?:.*)?$/
		) || [, null])[1])
	) {
		document.getElementById("logincadastro").click();
		document.getElementById("signup_btn").click();
	} else {
		document.getElementById("sobre").click();
	}

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
				// $("<span id='vazio'>Não há nada para mostrar</span>").appendTo(
				// 	"#tabela"
				// );
				$("<tr><td>Não há nada para mostrar</td></tr>").appendTo("#tabela");
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
