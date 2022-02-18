$("#txt").click(function () {
	$("#filtros").hide();
	$("#tabela").css("margin-top", "60px");
});
$("#txt2").click(function () {
	$("#filtros2").hide();
	$("#tabelaP").css("margin-top", "60px");
});

function isEmpty(str) {
	return !str.trim().length;
}

document.getElementById("txt").addEventListener("input", function () {
	if (isEmpty(this.value)) {
		$("#filtros").show();
	}
});
document.getElementById("txt2").addEventListener("input", function () {
	if (isEmpty(this.value)) {
		$("#filtros2").show();
	}
});
