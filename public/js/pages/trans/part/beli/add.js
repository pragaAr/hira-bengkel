$(document).ready(function () {
	$("tfoot").hide();

	$(document).keypress(function (event) {
		if (event.which == "13") {
			event.preventDefault();
		}
	});

	$(function () {
		$("#diskon_belipart").on(
			"keydown keyup click change blur input",
			function (e) {
				$(this).val(format($(this).val()));
			}
		);
	});

	$(function () {
		$("#ppn_belipart").on(
			"keydown keyup click change blur input",
			function (e) {
				$(this).val(format($(this).val()));
			}
		);
	});

	$(function () {
		$("#harga_pcs").on("keydown keyup click change blur input", function (e) {
			$(this).val(format($(this).val()));
		});
	});

	$(function () {
		$("#diskon").on("keydown keyup click change blur input", function (e) {
			$(this).val(format($(this).val()));
		});
	});

	$(".status_bayar").select2({
		placeholder: "Pembayaran",
		theme: "bootstrap4",
		minimumResultsForSearch: Infinity,
	});

	$(".status_part_beli").select2({
		placeholder: "Status Part",
		theme: "bootstrap4",
		minimumResultsForSearch: Infinity,
	});

	$(".selecttoko")
		.select2({
			placeholder: "Pilih Toko",
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
			$("#merk_part").val(data.merkpart);
			$("#merk_partid").val(data.merkid);
			$("#jml_beli").prop("readonly", false);
			$("#harga_pcs").prop("readonly", false);
			$("#diskon").prop("readonly", false);
			$("#status_part_beli").prop("disabled", false);
			$("#ket_beli").prop("readonly", false);
			$("button#tambah").prop("disabled", false);
			$("button#tambah").removeClass("btn-secondary");
			$("button#tambah").addClass("btn-primary");
		});

	$(document).on("click", ".btn-add-part", function () {
		$("#modal-addnew-part").modal("show");
		$("#modal-addnew-part").on("shown.bs.modal", function () {
			$('input[name="namapart"]').focus();
		});
	});

	$("#btn-submit-part").on("click", function (e) {
		e.preventDefault();
		const namapart = $("#namapart").val();
		const merk = $("#namamerk").val();
		const merknama = $("#merknama").val();
		const baru = $("#baru").val();
		const bekas = $("#bekas").val();
		const satuan = $("#satuan").val();
		const rak = $("#rak").val();

		$.ajax({
			url: "http://localhost/he-bengkel/stok/addSelect",
			method: "POST",
			data: {
				nama: namapart,
				merk: merk,
				merknama: merknama,
				baru: baru,
				bekas: bekas,
				satuan: satuan,
				rak: rak,
			},
			success: function (response) {
				$("#namapart").val("");
				$("#namamerk").val(null).trigger("change");
				$("#merknama").val("");
				$("#baru").val(0);
				$("#bekas").val(0);
				$("#satuan").val("");
				$("#rak").val("");
				$("#modal-addnew-part").modal("hide");

				Swal.fire({
					icon: "success",
					title: "Success!",
					text: "Data Sparepart ditambahkan!",
				});

				const dataparse = JSON.parse(response);
				const newOption = new Option(dataparse.text, dataparse.id, true, true);

				$("#part_belipart").append(newOption).trigger("change");

				$("#partid").val(dataparse.id);
				$("#partname").val(dataparse.text);
				$("#merk_part").val(dataparse.merknama);
				$("#merk_partid").val(dataparse.merk);
				$("#sat").val(dataparse.satuan);
				$("#jml_beli").prop("readonly", false);
				$("#harga_pcs").prop("readonly", false);
				$("#diskon").prop("readonly", false);
				$("#status_part_beli").prop("disabled", false);
				$("#ket_beli").prop("readonly", false);
				$("button#tambah").prop("disabled", false);
				$("button#tambah").removeClass("btn-secondary");
				$("button#tambah").addClass("btn-primary");
			},
		});
	});

	// =============== //
	$("#btn-add-merk").on("click", function () {
		$("#modal-addnew-part").modal("hide");
		$("#modal-addnew-merk").modal("show");
		$("#modal-addnew-merk").on("shown.bs.modal", function () {
			$('input[name="addnewmerk"]').focus();
		});
	});

	$("#modal-addnew-merk").on("hidden.bs.modal", function () {
		$("#modal-addnew-part").modal("show");
		$('input[name="namapart"]').focus();
	});

	$(".selectmerk")
		.select2({
			placeholder: "Pilih Merk",
			theme: "bootstrap4",
			ajax: {
				url: "http://localhost/he-bengkel/merk/getDataMerk",
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
			$("#merknama").val(data.text);
		});

	$(document).on("click", ".btn-add-merk", function () {
		$("#modal-addnew-merk").modal("show");
		$("#modal-addnew-merk").on("shown.bs.modal", function () {
			$('input[name="namamerk"]').focus();
		});
	});

	$("#btn-submit-merk").on("click", function (e) {
		e.preventDefault();
		const namamerk = $("#addnewmerk").val();

		$.ajax({
			url: "http://localhost/he-bengkel/merk/addSelect",
			method: "POST",
			data: {
				namamerk: namamerk,
			},
			success: function (response) {
				$("#addnewmerk").val("");

				Swal.fire({
					icon: "success",
					title: "Success!",
					text: "Data Merk ditambahkan!",
				});

				$("#modal-addnew-merk").modal("hide");

				const merkparse = JSON.parse(response);
				const newMerkOptions = new Option(
					merkparse.text,
					merkparse.id,
					true,
					true
				);
				$(".selectmerk").append(newMerkOptions).trigger("change");
				$("#merknama").val(merkparse.text);
			},
		});
	});

	function hitungTotalNominal() {
		let jml = $('input[name="jml_beli"]').val();
		let diskon = $('input[name="diskon"]')
			.val()
			.replace(/[^\d.]/g, "");
		let harga = $('input[name="harga_pcs"]')
			.val()
			.replace(/[^\d.]/g, "");
		let jmlxharga = parseFloat(jml * harga);
		let tot = jmlxharga - parseFloat(diskon);
		return format(tot);
	}

	function hitungTotalPersen() {
		let jml = $('input[name="jml_beli"]').val();
		let diskon = $('input[name="diskon"]')
			.val()
			.replace(/[^\d.]/g, "");
		let harga = $('input[name="harga_pcs"]')
			.val()
			.replace(/[^\d.]/g, "");
		let jmlxharga = parseFloat(jml * harga);
		let persen = parseFloat(diskon / 100);
		let tot = jmlxharga * persen;
		let byr = jmlxharga - tot;
		return format(byr);
	}

	$('input[name="jml_beli"]').on("input keyup change", function () {
		if ($('input[name="diskon"]').val() <= 100) {
			$('input[name="total_min_diskon"]').val(hitungTotalPersen());
		} else {
			$('input[name="total_min_diskon"]').val(hitungTotalNominal());
		}
	});

	$('input[name="harga_pcs"]').on("input keyup change", function () {
		if ($('input[name="diskon"]').val() <= 100) {
			$('input[name="total_min_diskon"]').val(hitungTotalPersen());
		} else {
			$('input[name="total_min_diskon"]').val(hitungTotalNominal());
		}
	});

	$('input[name="diskon"]').on("input keyup change", function () {
		if ($('input[name="diskon"]').val() <= 100) {
			$('input[name="total_min_diskon"]').val(hitungTotalPersen());
		} else {
			$('input[name="total_min_diskon"]').val(hitungTotalNominal());
		}
	});

	$(document).on("click", "#tambah", function (e) {
		console.log($("#total_min_diskon").val());

		let subtotal = $('input[name="total_min_diskon"]')
			.val()
			.replace(/[^\d.]/g, "");

		if (subtotal === "") {
			subtotal = 0;
		}

		const cart = {
			partid: $('select[name="part_belipart"]').val(),
			partname: $('input[name="partname"]').val(),
			sat: $('input[name="sat"]').val(),
			merkname: $('input[name="merk_part"]').val(),
			merkid: $('input[name="merk_partid"]').val(),
			jmlbeli: $('input[name="jml_beli"]').val(),
			hrgpcs: $('input[name="harga_pcs"]')
				.val()
				.replace(/[^\d.]/g, ""),
			diskon: $('input[name="diskon"]')
				.val()
				.replace(/[^\d.]/g, ""),
			statuspart: $('select[name="status_part_beli"]').val(),
			keterangan: $('input[name="ket_beli"]').val(),
			subtotal: subtotal,
			ppn: $('input[name="ppn_belipart"]')
				.val()
				.replace(/[^\d.]/g, ""),
		};

		$.ajax({
			url: "http://localhost/he-bengkel/beli/cart",
			type: "POST",
			data: cart,
			success: function (data) {
				$("button#tambah").prop("disabled", true);
				$("button#tambah").addClass("btn-secondary");
				$("button#tambah").removeClass("btn-primary");
				reset();

				$("table#cart tbody").append(data);
				$("#totalpart").html("<p>" + hitung_totalpart() + "</p>");
				$("#total").html("<p>" + hitung_total().toLocaleString() + "</p>");
				$('input[name="totalpart_hidden"]').val(hitung_totalpart());
				$('input[name="total_hidden"]').val(hitung_total());

				$("tfoot").show();
			},
		});
	});

	$(document).on("click", "#tombol-hapus", function () {
		$(this).closest(".row-cart").remove();

		$("#totalpart").html("<p>" + hitung_totalpart() + "</p>");
		$("#total").html("<p>" + hitung_total() + "</p>");

		$('input[name="totalpart_hidden"]').val(hitung_totalpart());
		$('input[name="total_hidden"]').val(hitung_total());

		if ($("tbody").children().length == 0) $("tfoot").hide();
	});

	$('button[type="submit"]').on("click", function () {
		$("#partname").prop("disabled", true);
	});

	$("#belipart_add").on("change", function () {
		const tanggalSekarang = new Date();
		const belipartAdd = $("#belipart_add").val();

		let tanggalInput = new Date(belipartAdd);

		if (tanggalInput > tanggalSekarang) {
			Swal.fire({
				icon: "warning",
				title: "Cek tanggal!",
			});

			$("#part_belipart").prop("disabled", true);
			$("#btn-submitBeli").prop("disabled", true);
		} else {
			$("#part_belipart").prop("disabled", false);
			$("#btn-submitBeli").prop("disabled", false);
		}
	});

	function hitung_total() {
		let total = 0;
		let diskall = $('input[name="diskon_belipart"]')
			.val()
			.replace(/[^\d.]/g, "");
		let ppn = $('input[name="ppn_belipart"]')
			.val()
			.replace(/[^\d.]/g, "");
		let min = diskall / 100;
		let hasil = 0;
		let sub = 0;
		if (diskall > 100) {
			$(".subtotal").each(function () {
				total += parseFloat(
					$(this)
						.text()
						.replace(/[^\d.]/g, "")
				);
			});
			return total - diskall + parseFloat(ppn);
		} else {
			$(".subtotal").each(function () {
				hasil += parseFloat(
					$(this)
						.text()
						.replace(/[^\d.]/g, "")
				);
			});
			sub = hasil * min;
			return hasil - sub + parseFloat(ppn);
		}
	}

	function hitung_totalpart() {
		let totalpart = 0;
		$(".jmlbeli").each(function () {
			totalpart += parseFloat($(this).text());
		});
		return totalpart;
	}

	function reset() {
		$("#part_belipart").val(null).trigger("change");
		$('input[name="partname"]').val("");
		$('input[name="sat"]').val("");
		$('input[name="merk_part"]').val("");
		$('input[name="merk_partid"]').val("");
		$('input[name="jml_beli"]').val(1);
		$('input[name="harga_pcs"]').val(0);
		$('input[name="diskon"]').val(0);
		$("#status_part_beli").val(null).trigger("change");
		$('input[name="ket_beli"]').val("");
		$('input[name="total_min_diskon"]').val("");
		$("#status_part_beli").prop("disabled", true);
		$('input[name="jml_beli"]').prop("readonly", true);
		$('input[name="harga_pcs"]').prop("readonly", true);
		$('input[name="sat"]').prop("readonly", true);
		$('input[name="diskon"]').prop("readonly", true);
		$('input[name="ket_beli"]').prop("readonly", true);
		$("button#tambah").prop("disabled", true);
	}

	$(document).on("select2:open", () => {
		document
			.querySelector(".select2-container--open .select2-search__field")
			.focus();
	});
});
