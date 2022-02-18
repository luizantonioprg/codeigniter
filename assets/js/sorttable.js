$("#tabela tr td").click(function () {
	var table = $(this).parents("table").eq(0);
	var rows = table
		.find("tr:gt(0)")
		.toArray()
		.sort(comparer($(this).index()));
	this.asc = !this.asc;
	rows = rows.reverse();
	if (!this.asc) {
		rows = rows.reverse();
	}
	for (var i = 0; i < rows.length; i++) {
		table.append(rows[i]);
	}
	$("#nav a:first").click();
});

$("#tabela2 thead tr td").click(function () {
	var table = $(this).parents("table").eq(0);
	var rows = table
		.find("tr:gt(0)")
		.toArray()
		.sort(comparer($(this).index()));
	this.asc = !this.asc;
	rows = rows.reverse();
	if (!this.asc) {
		rows = rows.reverse();
	}
	for (var i = 0; i < rows.length; i++) {
		table.append(rows[i]);
	}
	$("#nav2 a:first").click();
});

$("#tabela3 thead tr td").click(function () {
	var table = $(this).parents("table").eq(0);
	var rows = table
		.find("tr:gt(0)")
		.toArray()
		.sort(comparer($(this).index()));
	this.asc = !this.asc;
	rows = rows.reverse();
	if (!this.asc) {
		rows = rows.reverse();
	}
	for (var i = 0; i < rows.length; i++) {
		table.append(rows[i]);
	}
	$("#nav3 a:first").click();
});

$("#tabelaP thead tr td").click(function () {
	var table = $(this).parents("table").eq(0);
	var rows = table
		.find("tr:gt(0)")
		.toArray()
		.sort(comparer($(this).index()));
	this.asc = !this.asc;
	rows = rows.reverse();
	if (!this.asc) {
		rows = rows.reverse();
	}
	for (var i = 0; i < rows.length; i++) {
		table.append(rows[i]);
	}
	$("#nav2 a:first").click();
});

$("#tabelaE thead tr td").click(function () {
	var table = $(this).parents("table").eq(0);
	var rows = table
		.find("tr:gt(0)")
		.toArray()
		.sort(comparer($(this).index()));
	this.asc = !this.asc;
	rows = rows.reverse();
	if (!this.asc) {
		rows = rows.reverse();
	}
	for (var i = 0; i < rows.length; i++) {
		table.append(rows[i]);
	}
	$("#nav4 a:first").click();
});
function comparer(index) {
	return function (a, b) {
		var valA = getCellValue(a, index),
			valB = getCellValue(b, index);
		return $.isNumeric(valA) && $.isNumeric(valB)
			? valA - valB
			: valA.toString().localeCompare(valB);
	};
}
function getCellValue(row, index) {
	return $(row).children("td").eq(index).text();
}
$("#tabelaNova1 thead tr td").click(function () {
	//alert("oi");
	var table = $(this).parents("table").eq(0);
	var rows = table
		.find("tr:gt(0)")
		.toArray()
		.sort(comparer($(this).index()));
	this.asc = !this.asc;
	rows = rows.reverse();
	if (!this.asc) {
		rows = rows.reverse();
	}
	for (var i = 0; i < rows.length; i++) {
		table.append(rows[i]);
	}
	$("#navNova1 a:first").click();
});
$("#tabelaNova2 thead tr td").click(function () {
	//alert("oi");
	var table = $(this).parents("table").eq(0);
	var rows = table
		.find("tr:gt(0)")
		.toArray()
		.sort(comparer($(this).index()));
	this.asc = !this.asc;
	rows = rows.reverse();
	if (!this.asc) {
		rows = rows.reverse();
	}
	for (var i = 0; i < rows.length; i++) {
		table.append(rows[i]);
	}
	$("#navNova2 a:first").click();
});

