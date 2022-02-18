function fnExcelReport() {
	var tab_text = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
	tab_text =
		tab_text +
		"<head><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet>";

	tab_text = tab_text + "<x:Name>Estacionamentos</x:Name>";

	tab_text =
		tab_text +
		"<x:WorksheetOptions><x:Panes></x:Panes></x:WorksheetOptions></x:ExcelWorksheet>";
	tab_text =
		tab_text + "</x:ExcelWorksheets></x:ExcelWorkbook></xml></head><body>";

	tab_text = tab_text + "<table border='1px'>";
	tab_text = tab_text + $("#tabela").html();
	tab_text = tab_text + "</table></body></html>";

	var data_type = "data:application/vnd.ms-excel";

	var ua = window.navigator.userAgent;
	var msie = ua.indexOf("MSIE ");

	if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
		if (window.navigator.msSaveBlob) {
			var blob = new Blob([tab_text], {
				type: "application/csv;charset=utf-8;",
			});
			navigator.msSaveBlob(blob, "exportar_tabela.xls");
		}
	} else {
		$("#download").attr(
			"href",
			data_type + ", " + encodeURIComponent(tab_text)
		);
		$("#download").attr("download", "exportar_tabela.xls");
	}
}

function fnExcelReport2() {
	var tab_text = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
	tab_text =
		tab_text +
		"<head><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet>";

	tab_text = tab_text + "<x:Name>Estacionamentos</x:Name>";

	tab_text =
		tab_text +
		"<x:WorksheetOptions><x:Panes></x:Panes></x:WorksheetOptions></x:ExcelWorksheet>";
	tab_text =
		tab_text + "</x:ExcelWorksheets></x:ExcelWorkbook></xml></head><body>";

	tab_text = tab_text + "<table border='1px'>";
	tab_text = tab_text + $("#tabelaP").html();
	tab_text = tab_text + "</table></body></html>";

	var data_type = "data:application/vnd.ms-excel";

	var ua = window.navigator.userAgent;
	var msie = ua.indexOf("MSIE ");

	if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
		if (window.navigator.msSaveBlob) {
			var blob = new Blob([tab_text], {
				type: "application/csv;charset=utf-8;",
			});
			navigator.msSaveBlob(blob, "exportar_tabela.xls");
		}
	} else {
		$("#download2").attr(
			"href",
			data_type + ", " + encodeURIComponent(tab_text)
		);
		$("#download2").attr("download", "exportar_tabela.xls");
	}
}
