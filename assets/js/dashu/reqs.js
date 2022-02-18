$("#meus_dados").click(function () {
	$id = document.getElementById("id_usuario").value;
	let url = "http://ambiente-desenvolvimento15.provisorio.ws/gomes/codeigniter/user/info?id=" + $id;
	$.ajax({
		type: "GET",
		url: url,
		beforeSend: function () {},
		success: function (data) {
			document.getElementById("nome_usuario").value = data[0]["nome"];
			document.getElementById("email_usuario").value = data[0]["email"];
		},
		error: function (xhr) {
			console.log("deu erro");
		},
		dataType: "JSON",
	});
});

$("#select_planos").change(function () {
	if ($("#select_planos :selected").text() == "SEMESTRAL") {
		$("#SEMESTRAL").show();
		$("#MENSAL").hide();
		$("#ANUAL").hide();

		$("#paypal-button-container-P-49N05800SW808751EMDGJC2Y").show();
		$("#paypal-button-container-P-014696710N602254RMDGI5KQ").hide();
		$("#paypal-button-container-P-6WU0151704777271JMDGJEOY").hide();
	} else if ($("#select_planos :selected").text() == "ANUAL") {
		$("#ANUAL").show();
		$("#MENSAL").hide();
		$("#SEMESTRAL").hide();

		$("#paypal-button-container-P-6WU0151704777271JMDGJEOY").show();
		$("#paypal-button-container-P-014696710N602254RMDGI5KQ").hide();
		$("#paypal-button-container-P-49N05800SW808751EMDGJC2Y").hide();
	} else {
		$("#MENSAL").show();
		$("#SEMESTRAL").hide();
		$("#ANUAL").hide();

		$("#paypal-button-container-P-014696710N602254RMDGI5KQ").show();
		$("#paypal-button-container-P-6WU0151704777271JMDGJEOY").hide();
		$("#paypal-button-container-P-49N05800SW808751EMDGJC2Y").hide();
	}

	$("#pagar_plano").attr("value", $("#select_planos :selected").text());
});
