$(document).ready(function () {
	$("tfoot").hide();

	$(document).keypress(function (event) {
		if (event.which == "13") {
			event.preventDefault();
		}
	});

	$(".selectstatus").select2({
		placeholder: "Pilih Status",
		theme: "bootstrap4",
		minimumResultsForSearch: Infinity,
	});

	$(".selecttruck")
		.select2({
			placeholder: "Pilih Truck",
			theme: "bootstrap4",
			ajax: {
				url: "http://localhost/he-bengkel/truck/getListTruck",
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

			$("#platno").val(data.text);
			$("#montir").prop("readonly", false).focus();
		});

	$(".selectpart")
		.select2({
			placeholder: "Pilih Part",
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

			$("#jenispart").val(data.namapart);
			$("#merk").val(data.merkpart);
			$("#merkid").val(data.merkid);
			$("#sat").val(data.satuanpart);
			$("#baru").val(data.baru);
			$("#bekas").val(data.bekas);
			$("#jml").val(1);
			$("#jml").prop("readonly", false).focus();
			$(".selectstatus").prop("disabled", false);
			$("#ket").prop("readonly", false);
		});

	$(".selectstatus").on("change", function () {
		if ($(".selectstatus").val() == "") {
			$("button#tambah").prop("disabled", true);
		} else {
			$("button#tambah").prop("disabled", false);
			$("button#tambah").removeClass("btn-secondary");
			$("button#tambah").addClass("btn-primary");
		}
	});

	// =============== //

	$(document).on("click", "#tambah", function (e) {
		const truckid = $("#truckid").val(),
			platno = $("#platno").val(),
			montir = $("#montir").val(),
			partid = $("#partid").val(),
			part = $("#jenispart").val(),
			merkid = $("#merkid").val(),
			merk = $("#merk").val(),
			sat = $("#sat").val(),
			baru = $("#baru").val(),
			bekas = $("#bekas").val(),
			statuspart = $("#statuspart").val(),
			jml = $("#jml").val(),
			ket = $("#ket").val();

		if (statuspart === "Baru" && parseInt(baru) < parseInt(jml)) {
			alert("Stok tidak tersedia! Stok Baru yang tersedia: " + parseInt(baru));
			reset();
		} else if (statuspart === "Bekas" && parseInt(bekas) < parseInt(jml)) {
			alert(
				"Stok tidak tersedia! Stok Bekas yang tersedia: " + parseInt(bekas)
			);
			reset();
		} else {
			const newRow = `
        <tr class="text-center cart-pakai">
          <td class="align-middle part">
            ${part}
            <input type="hidden" name="part_hidden[]" value="${part}">
          </td>

          ${partid}
          <input type="hidden" name="partid_hidden[]" value="${partid}">

          <td class="align-middle merk">
            ${merk}
            <input type="hidden" name="merk_hidden[]" value="${merk}">
          </td>

          ${merkid}
          <input type="hidden" name="merkid_hidden[]" value="${merkid}">

          <td class="align-middle statuspart">
            ${statuspart}
            <input type="hidden" name="statuspart_hidden[]" value="${statuspart}">
          </td>

          <td class="align-middle jml">
            ${jml}
            <input type="hidden" name="jml_hidden[]" value="${jml}">
          </td>

          <td class="align-middle sat">
            ${sat}
            <input type="hidden" name="sat_hidden[]" value="${sat}">
          </td>

          ${ket}
          <input type="hidden" name="ket_hidden[]" value="${ket}">

          ${totalpart}
          <input type="hidden" name="totalpart_hidden[]" value="${totalpart}">

          <td class="align-middle aksi">
            <button type="button" class="btn btn-danger btn-sm" id="tombol-hapus" data-toggle="tooltip" title="Delete" data-partid="${partid}">
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
			$('input[name="totalpart_hidden"]').val(hitung_totalpart());

			$("tfoot").show();
		}
	});

	$("#tgl").on("change", function () {
		const tanggalSekarang = new Date();

		const tgl = $("#tgl").val();

		let tanggalInput = new Date(tgl);

		if (tanggalInput > tanggalSekarang) {
			Swal.fire({
				icon: "warning",
				title: "Cek tanggal!",
			});

			$("#partid").prop("disabled", true);
			$("#btn-submitPakaiPart").prop("disabled", true);
		} else {
			$("#partid").prop("disabled", false);
			$("#btn-submitPakaiPart").prop("disabled", false);
		}
	});

	$(document).on("click", "#tombol-hapus", function () {
		$(this).closest(".cart-pakai").remove();

		$("#totalpart").html("<p>" + hitung_totalpart() + "</p>");
		$('input[name="totalpart_hidden"]').val(hitung_totalpart());

		if ($("tbody").children().length == 0) $("tfoot").hide();
	});

	$('button[type="submit"]').on("click", function () {
		$("#jenispart").prop("disabled", true);
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
		$("#jenispart").val("");
		$("#sat").val("");
		$("#merk").val("");
		$("#merkid").val("");
		$("#jml").val(1);
		$("#statuspart").val(null).trigger("change");
		$("#ket").val("");
		$("#statuspart").prop("disabled", true);
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
