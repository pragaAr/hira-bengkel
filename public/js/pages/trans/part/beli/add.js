$(document).ready(function () {
	$("tfoot").hide();

	$(document).keypress(function (event) {
		if (event.which == "13") {
			event.preventDefault();
		}
	});

	$(function () {
		// Seleksi semua elemen input yang menggunakan format yang sama
		$("#diskon_belipart, #ppn_belipart, #harga_pcs, #diskon").on(
			"keydown keyup click change blur input",
			function (e) {
				$(this).val(format($(this).val()));
			}
		);
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

	$("#jml_beli").on("input keyup change", function () {
		if ($("#diskon").val() <= 100) {
			$("#total_min_diskon").val(hitungTotalPersen());
		} else {
			$("#total_min_diskon").val(hitungTotalNominal());
		}
	});

	$("#harga_pcs").on("input keyup change", function () {
		if ($("#diskon").val() <= 100) {
			$("#total_min_diskon").val(hitungTotalPersen());
		} else {
			$("#total_min_diskon").val(hitungTotalNominal());
		}
	});

	$("#diskon").on("input keyup change", function () {
		if ($("#diskon").val() <= 100) {
			$("#total_min_diskon").val(hitungTotalPersen());
		} else {
			$("#total_min_diskon").val(hitungTotalNominal());
		}
	});

	$(document).on("click", "#tambah", function (e) {
		let subtotal = $("#total_min_diskon")
			.val()
			.replace(/[^\d.]/g, "");

		if (subtotal === "") {
			subtotal = 0;
		}

		const partid = $("#part_belipart").val(),
			partname = $("#partname").val(),
			sat = $("#sat").val(),
			merkname = $("#merk_part").val(),
			merkid = $("#merk_partid").val(),
			jmlbeli = $("#jml_beli").val(),
			hrgpcs = $("#harga_pcs")
				.val()
				.replace(/[^\d.]/g, ""),
			diskon = $("#diskon")
				.val()
				.replace(/[^\d.]/g, ""),
			statuspart = $("#status_part_beli").val(),
			keterangan = $("#ket_beli").val(),
			ppn = $("#ppn_belipart")
				.val()
				.replace(/[^\d.]/g, "");

		const newRow = `
			<tr class="cart text-center">
				${partid}
				<input type="hidden" name="partid_hidden[]" value="${partid}">

				<td class="align-middle partname">
					${partname}
					<input type="hidden" name="partname_hidden[]" value="${partname}">
				</td>

				${merkid}
				<input type="hidden" name="merkid_hidden[]" value="${merkid}">

				${merkname}
				<input type="hidden" name="merkname_hidden[]" value="${merkname}">

				<td class="align-middle jmlbeli">
					${jmlbeli}
					<input type="hidden" name="jmlbeli_hidden[]" value="${jmlbeli}">
				</td>

				<td class="align-middle sat">
					${sat}
					<input type="hidden" name="sat_hidden[]" value="${sat}">
				</td>

				<td class="align-middle hrgpcs">
					${format(hrgpcs)}
					<input type="hidden" name="hrgpcs_hidden[]" value="${hrgpcs}">
				</td>

				<td class="align-middle diskon">
					${format(diskon)}
					<input type="hidden" name="diskon_hidden[]" value="${diskon}">
				</td>

				${ppn}
				<input type="hidden" name="ppn_hidden[]" value="${ppn}">

				${keterangan}
				<input type="hidden" name="keterangan_hidden[]" value="${keterangan}">

				<td class="align-middle status_part">
					${statuspart}
					<input type="hidden" name="statuspart_hidden[]" value="${statuspart}">
				</td>

				<td class="align-middle subtotal">
					${format(subtotal)}
					<input type="hidden" name="subtotal_hidden[]" value="${subtotal}">
				</td>

				${totalpart}
				<input type="hidden" name="totalpart_hidden[]" value="${totalpart}">

				<td class="align-middle aksi">
					<button type="button" class="btn btn-warning btn-sm" id="tombol-hapus" data-toggle="tooltip" title="Delete" data-partid="${partid}">
						<i class="fa fa-trash fa-sm"></i>
					</button>
				</td>
			</tr>
		`;

		$("#cart tbody").append(newRow);

		$("button#tambah").prop("disabled", true);
		$("button#tambah").addClass("btn-secondary");
		$("button#tambah").removeClass("btn-primary");

		reset();

		$("#totalpart").html("<p>" + hitung_totalpart() + "</p>");
		$("#total").html("<p>" + hitung_total().toLocaleString() + "</p>");
		$('input[name="totalpart_hidden"]').val(hitung_totalpart());
		$('input[name="total_hidden"]').val(hitung_total());

		$("tfoot").show();
	});

	$(document).on("click", "#tombol-hapus", function () {
		$(this).closest(".cart").remove();

		$("#totalpart").html("<p>" + hitung_totalpart() + "</p>");
		$("#total").html("<p>" + hitung_total() + "</p>");

		$("#totalpart_hidden").val(hitung_totalpart());
		$("#total_hidden").val(hitung_total());

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

		let diskall = $("#diskon_belipart")
			.val()
			.replace(/[^\d.]/g, "");
		let ppn = $("#ppn_belipart")
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
		$("#partname").val("");
		$("#sat").val("");
		$("#merk_part").val("");
		$("#merk_partid").val("");
		$("#jml_beli").val(1);
		$("#harga_pcs").val(0);
		$("#diskon").val(0);
		$("#status_part_beli").val(null).trigger("change");
		$("#ket_beli").val("");
		$("#total_min_diskon").val("");
		$("#status_part_beli").prop("disabled", true);
		$("#jml_beli").prop("readonly", true);
		$("#harga_pcs").prop("readonly", true);
		$("#sat").prop("readonly", true);
		$("#diskon").prop("readonly", true);
		$("#ket_beli").prop("readonly", true);
		$("button#tambah").prop("disabled", true);
	}

	$(document).on("select2:open", () => {
		document
			.querySelector(".select2-container--open .select2-search__field")
			.focus();
	});
});
