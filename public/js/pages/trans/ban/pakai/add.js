$(document).ready(function () {
	$("tfoot").hide();

	$(document).keypress(function (event) {
		if (event.which == "13") {
			event.preventDefault();
		}
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
			$("#montir").focus();
		});

	let cartBan = [];

	$(".selectban")
		.select2({
			placeholder: "Pilih Ban",
			theme: "bootstrap4",
			ajax: {
				url: "http://localhost/he-bengkel/ban/getListBan",
				dataType: "json",
				data: function (params) {
					return {
						q: params.term,
					};
				},
				processResults: function (data) {
					$.each(data, function (index, value) {
						value.text = value.text.toUpperCase();
					});
					return {
						results: data,
					};
				},
			},
		})
		.on("select2:select", function (e) {
			const data = e.params.data;

			const isInCart = cartBan.some((emp) => emp.id === data.id);

			if (isInCart) {
				// true
				Swal.fire({
					icon: "warning",
					title: "Oops!",
					text: "No Seri sudah ada di list!",
				});

				$(".selectban").val(null).trigger("change");
			} else {
				// false
				// Masukkan ke cart
				cartBan.push(data);

				$("#noseri").val(data.noseri);
				$("#merk").val(data.merkban);
				$("#merkid").val(data.merkid);
				$("#ukuran").val(data.ukuran);

				if (data.stat == 0) {
					$("#stat").val("Ori");
				} else {
					$("#stat").val("Vulkanisir");
				}

				$("#status").val(data.stat);

				$("#jml").val(1);
				$("#ket").prop("readonly", false).focus();
				$("button#tambah").prop("disabled", false);
			}
		});

	// =============== //

	$(document).on("click", "#tambah", function (e) {
		const banid = $("#banid").val();
		const truckid = $("#truckid").val();
		const platno = $("#platno").val();
		const noseri = $("#noseri").val();
		const merkid = $("#merkid").val();
		const merk = $("#merk").val();
		const ukuran = $("#ukuran").val();
		const status = $("#status").val();
		const stat = $("#stat").val();
		const jml = $("#jml").val();
		const ket = $("#ket").val();

		const newRow = `
    <tr class="cart text-center">
			${truckid}
      <input type="hidden" name="truckid_hidden[]" value="${truckid}">

			${platno}
      <input type="hidden" name="platno_hidden[]" value="${platno}">

			${banid}
      <input type="hidden" name="banid_hidden[]" value="${banid}">

			${merkid}
      <input type="hidden" name="merkid_hidden[]" value="${merkid}">

			${status}
      <input type="hidden" name="status_hidden[]" value="${status}">

			${ket}
      <input type="hidden" name="ket_hidden[]" value="${ket}">

      <td class="text-uppercase noseri">
      ${noseri}
      <input type="hidden" name="noseri_hidden[]" value="${noseri}">
      </td>

      <td class="text-uppercase merk">
      ${merk}
      <input type="hidden" name="merk_hidden[]" value="${merk}">
      </td>

      <td class="text-uppercase stat">
      ${stat}
      <input type="hidden" name="stat_hidden[]" value="${stat}">
      </td>

			<td class="text-uppercase ukuran">
      ${ukuran}
      <input type="hidden" name="ukuran_hidden[]" value="${ukuran}">
      </td>

			<td class="text-uppercase jml">
      ${jml}
      <input type="hidden" name="jml_hidden[]" value="${jml}">
      </td>

      <td class="aksi">
        <button type="button" class="btn btn-danger btn-sm" id="tombol-hapus" data-noseri="${noseri}" data-id="${banid}">
          <i class="fas fa-trash"></i>
        </button>
      </td>
    </tr>
  	`;

		$("#cart tbody").append(newRow);

		reset();

		$("#totalban").html("<p class='m-0'>" + hitung_totalban() + "</p>");
		$('input[name="totalban_hidden"]').val(hitung_totalban());

		$("tfoot").show();
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

			$("#banid").prop("disabled", true);
			$("#btn-submitPakaiBan").prop("disabled", true);
		} else {
			$("#banid").prop("disabled", false);
			$("#btn-submitPakaiBan").prop("disabled", false);
		}
	});

	$(document).on("click", "#tombol-hapus", function () {
		const idToRemove = $(this).data("id");

		cartBan = cartBan.filter((item) => parseInt(item.id) !== idToRemove);

		$(this).closest(".cart").remove();

		$("#totalban").html('<p class="m-0">' + hitung_totalban() + "</p>");
		$('input[name="totalban_hidden"]').val(hitung_totalban());

		$(".selectban").val(null).trigger("change");

		if ($("tbody").children().length == 0) $("tfoot").hide();
	});

	$('button[type="submit"]').on("click", function () {
		$("#noseri").prop("disabled", true);
	});

	function hitung_totalban() {
		let totalban = 0;
		$(".jml").each(function () {
			totalban += parseFloat($(this).text());
		});

		return totalban;
	}

	function reset() {
		$("#banid").val(null).trigger("change");
		$("#noseri").val("");
		$("#merk").val("");
		$("#merkid").val("");
		$("#ukuran").val("");
		$("#stat").val("");
		$("#status").val("");
		$("#jml").val(1);
		$("#ket").val("");
		$("#ket").prop("readonly", true);

		$("button#tambah").prop("disabled", true);
	}

	$(document).on("select2:open", () => {
		document
			.querySelector(".select2-container--open .select2-search__field")
			.focus();
	});
});
