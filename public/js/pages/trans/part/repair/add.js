$(document).ready(function () {
	$("tfoot").hide();

	$(document).keypress(function (event) {
		if (event.which == "13") {
			event.preventDefault();
		}
	});

	$(".selectstatpart").select2({
		placeholder: "Status Part",
		theme: "bootstrap4",
		minimumResultsForSearch: Infinity,
	});

	$(".selecttoko")
		.select2({
			placeholder: "Pilih Bengkel",
			theme: "bootstrap4",
			ajax: {
				url: "http://localhost/he-bengkel/toko/getListToko",
				dataType: "json",
				data: function (params) {
					return {
						q: params.term,
					};
				},
				processResults: function (data) {
					return {
						results: data,
					};
				},
			},
		})
		.on("select2:select", function (e) {
			const data = e.params.data;
			$("#toko").val(data.text);
		});

	$(document).on("click", ".btn-add-toko", function () {
		$("#modal-addnew-toko").modal("show");
		$("#modal-addnew-toko").on("shown.bs.modal", function () {
			$('input[name="namatoko"]').focus();
		});
	});

	$("#btn-submit-toko").on("click", function (e) {
		e.preventDefault();
		const namatoko = $("#namatoko").val();
		const telptoko = $("#telptoko").val();

		$.ajax({
			url: "http://localhost/he-bengkel/toko/addSelect",
			method: "POST",
			data: {
				namatoko: namatoko,
				telptoko: telptoko,
			},
			success: function (response) {
				$("#namatoko").val("");
				$("#telptoko").val("");
				$("#modal-addnew-toko").modal("hide");

				Swal.fire({
					icon: "success",
					title: "Success!",
					text: "Data Toko ditambahkan!",
				});

				const tokoparse = JSON.parse(response);
				const newTokoOptions = new Option(
					tokoparse.text,
					tokoparse.id,
					true,
					true
				);
				$(".selecttoko").append(newTokoOptions).trigger("change");
				$("#toko").val(newTokoOptions.text);
			},
		});
	});

	// =============== //

	$(".selectpart")
		.select2({
			placeholder: "Pilih Sparepart",
			theme: "bootstrap4",
			ajax: {
				url: "http://localhost/he-bengkel/stok/getListStok",
				dataType: "json",
				data: function (params) {
					return {
						q: params.term,
					};
				},
				processResults: function (data) {
					return {
						results: data,
					};
				},
			},
		})
		.on("select2:select", function (e) {
			const data = e.params.data;
			$("#partid").val(data.id);
			$("#partname").val(data.namapart);
			$("#sat").val(data.satuanpart);
			$("#merk").val(data.merkpart);
			$("#merkid").val(data.merkid);
			$("#jml").prop("readonly", false).focus();
			$("#baru").val(data.baru);
			$("#bekas").val(data.bekas);
			$("#statpart").prop("disabled", false);
			$("#ket").prop("readonly", false);
			$("button#tambah").prop("disabled", false);
			$("button#tambah").removeClass("btn-secondary");
			$("button#tambah").addClass("btn-primary");
		});

	$(document).on("click", "#tambah", function (e) {
		const cart = {
			partid: $("#partid").val(),
			partname: $("#partname").val(),
			merk: $("#merk").val(),
			merkid: $("#merkid").val(),
			sat: $("#sat").val(),
			jml: $("#jml").val(),
			baru: $("#baru").val(),
			bekas: $("#bekas").val(),
			statpart: $("#statpart").val(),
			ket: $("#ket").val(),
		};

		cart.statpart === "Baru" && parseInt(cart.baru) < parseInt(cart.jml)
			? (alert(
					"Stok tidak tersedia! Stok Baru yang tersedia: " + parseInt(cart.baru)
			  ),
			  reset())
			: cart.statpart === "Bekas" && parseInt(cart.bekas) < parseInt(cart.jml)
			? (alert(
					"Stok tidak tersedia! Stok Bekas yang tersedia: " +
						parseInt(cart.bekas)
			  ),
			  reset())
			: send();
		$("tfoot").show();

		function send() {
			$.ajax({
				url: "http://localhost/he-bengkel/repair/cart",
				type: "POST",
				data: cart,
				success: function (data) {
					$("button#tambah").prop("disabled", true);
					$("button#tambah").addClass("btn-secondary");
					$("button#tambah").removeClass("btn-primary");
					reset();

					$("table#cart tbody").append(data);
					$("#totalpart").html("<p>" + hitung_totalpart() + "</p>");
					$('input[name="totalpart_hidden"]').val(hitung_totalpart());
				},
			});
		}
	});

	$(document).on("click", "#tombol-hapus", function () {
		$(this).closest(".cart").remove();

		$('option[value="' + $(this).data("partid") + '"]').show();
		$("#totalpart").html("<p>" + hitung_totalpart() + "</p>");
		$('input[name="totalpart_hidden"]').val(hitung_totalpart());

		if ($("tbody").children().length == 0) $("tfoot").hide();
	});

	$('button[type="submit"]').on("click", function () {
		$("#partname").prop("disabled", true);
	});

	function hitung_totalpart() {
		let totalpart = 0;
		$(".jml").each(function () {
			totalpart += parseFloat($(this).text());
		});

		return totalpart;
	}

	function reset() {
		$("#partid").val(null).trigger("change");
		$("#partname").val("");
		$("#sat").val("");
		$("#merk").val("");
		$("#merkid").val("");
		$("#jml").val("");
		$("#statpart").val(null).trigger("change");
		$("#baru").val("");
		$("#bekas").val("");
		$("#ket").val("");
		$("#statpart").prop("disabled", true);
		$("#jml").prop("readonly", true);
		$("#sat").prop("readonly", true);
		$("#ket").prop("readonly", true);
		$("button#tambah").prop("disabled", true);
	}

	$(document).on("select2:open", () => {
		document
			.querySelector(".select2-container--open .select2-search__field")
			.focus();
	});
});
