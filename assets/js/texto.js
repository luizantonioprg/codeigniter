$("#sobre").click(function () {
	var p1 = $("#p1").addClass("rotation");
	var p2 = $("#p2").addClass("rotation");
});

$("#defaultOpen").click(function () {
	var p1 = $("#p1");
	p1.removeClass("rotation");

	var p2 = $("#p2");
	p2.removeClass("rotation");
});
