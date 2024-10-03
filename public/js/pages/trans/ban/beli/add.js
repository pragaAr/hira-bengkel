$(document).ready(function () {
	$("tfoot").hide();

	$(document).keypress(function (event) {
		if (event.which == "13") {
			event.preventDefault();
		}
	});

	$("#seri").keydown(function (e) {
		if (e.which == "32") {
			return false;
		}
	});

	$("#diskall").on("keypress", function (key) {
		if (key.charCode < 48 || key.charCode > 57) return false;
	});

	$("#ppn").on("keypress", function (key) {
		if (key.charCode < 48 || key.charCode > 57) return false;
	});

	$("#hrg").on("keypress", function (key) {
		if (key.charCode < 48 || key.charCode > 57) return false;
	});

	$("#disk").on("keypress", function (key) {
		if (key.charCode < 48 || key.charCode > 57) return false;
	});

	$(function () {
		$("#diskall").on("keydown keyup click change blur input", function (e) {
			$(this).val(format($(this).val()));
		});
	});

	$(function () {
		$("#ppn").on("keydown keyup click change blur input", function (e) {
			$(this).val(format($(this).val()));
		});
	});

	$(function () {
		$("#hrg").on("keydown keyup click change blur input", function (e) {
			$(this).val(format($(this).val()));
		});
	});

	$(function () {
		$("#disk").on("keydown keyup click change blur input", function (e) {
			$(this).val(format($(this).val()));
		});
	});

	$(".selectstatusbayar").select2({
		placeholder: "Pembayaran",
		theme: "bootstrap4",
		minimumResultsForSearch: Infinity,
	});

	$(".selectstat").select2({
		placeholder: "Status",
		theme: "bootstrap4",
		minimumResultsForSearch: Infinity,
	});

	$(".selectsize").select2({
		placeholder: "Ukuran",
		theme: "bootstrap4",
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
					text: "Data Toko berhasil ditambahkan!",
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

	$("#noseri").on("input", function () {
		$(this).val();
		$.ajax({
			url: "http://localhost/he-bengkel/beli_ban/getSeri",
			type: "POST",
			dataType: "json",
			data: {
				noseri: $(this).val(),
			},
			success: function (data) {
				if (data.length > 0) {
					setTimeout(() => {
						$(".output")
							.show()
							.html(
								"<span class='text-danger font-weight-bold'>No Seri Sudah Ada!</span>"
							)
							.fadeIn("slow");
						$("#merkid").prop("disabled", true);
						$("#size").prop("disabled", true);
						$("#hrg").prop("readonly", true);
						$("#disk").prop("readonly", true);
						$("#stat").prop("disabled", true);
						$("#ket").prop("readonly", true);
					}, 500);
				} else {
					setTimeout(() => {
						$(".output")
							.show()
							.html(
								"<span class='text-success font-weight-bold'>No Seri Belum Tersedia</span>"
							)
							.fadeIn("slow");
						$("#merkid").prop("disabled", false);
						$("#size").prop("disabled", false);
						$("#hrg").prop("readonly", false);
						$("#disk").prop("readonly", false);
						$("#stat").prop("disabled", false);
						$("#ket").prop("readonly", false);
					}, 500);
				}
			},
		});
	});

	// =============== //

	// =============== //

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
			$("#merk").val(data.text);
		});

	function jmlharga() {
		let jmlbeli = $("#jmlbeli").val();
		let hargapcs = $("#hrg")
			.val()
			.replace(/[^\d.]/g, "");
		let subtotal = parseFloat(jmlbeli * hargapcs);
		$("#totmindisk").val(format(subtotal));
	}

	$("#hrg").on("input", function () {
		jmlharga();
	});

	$("#disk").on("input change keyup", function () {
		$("#totmindisk").val(
			$("#disk")
				.val()
				.replace(/[^\d.]/g, "") <= 100
				? diskPersen()
				: diskNominal()
		);
	});

	$("#hrg").on("input change keyup", function () {
		$("#totmindisk").val(
			$("#disk")
				.val()
				.replace(/[^\d.]/g, "") <= 100
				? diskPersen()
				: diskNominal()
		);
	});

	function diskPersen() {
		let harga = $("#hrg")
			.val()
			.replace(/[^\d.]/g, "");
		let diskon = $("#disk")
			.val()
			.replace(/[^\d.]/g, "");
		let persen = 100;
		let diskonpersen = parseFloat(diskon / persen);
		let hargaxdiskon = diskonpersen * harga;

		let bayar = harga - hargaxdiskon;
		return format(bayar);
	}

	function diskNominal() {
		let harga = $("#hrg")
			.val()
			.replace(/[^\d.]/g, "");
		let diskon = $("#disk")
			.val()
			.replace(/[^\d.]/g, "");
		let bayar = parseFloat(harga - diskon);
		return format(bayar);
	}

	// check if this have value or not, affected to the button Tambah
	$("#stat").on("change", function () {
		if ($("#stat").val() == "") {
			$("button#tambah").prop("disabled", true);
		} else {
			$("#ket").focus();
			$("button#tambah").prop("disabled", false);
			$("button#tambah").removeClass("btn-secondary");
			$("button#tambah").addClass("btn-primary");
		}
	});

	let cartPart = [];

	$(document).on("click", "#tambah", function (e) {
		const noseri = $("#noseri").val();

		const dataCart = {
			id: noseri,
			text: noseri,
		};

		const isInCart = cartPart.some((emp) => emp.id === dataCart.id);

		if (isInCart) {
			Swal.fire({
				icon: "warning",
				title: "Oops!",
				text: "No Seri sudah ada di list!",
			});
		} else {
			cartPart.push(dataCart);

			console.log(cartPart);

			const merkid = $("#merkid").val();
			const merk = $("#merk").val();
			const size = $("#size").val();
			const stat = $("#stat").val();
			const jmlbeli = $("#jmlbeli").val();
			const hrg = $("#hrg")
				.val()
				.replace(/[^\d.]/g, "");
			const ket = $("#ket").val();
			const totmindisk = $("#totmindisk")
				.val()
				.replace(/[^\d.]/g, "");
			const disk = $("#disk")
				.val()
				.replace(/[^\d.]/g, "");
			const ppn = $("#ppn")
				.val()
				.replace(/[^\d.]/g, "");

			const newRow = `
      <tr class="cart text-center">
        ${merkid}
        <input type="hidden" name="merkid_hidden[]" value="${merkid}">
  
        ${stat}
        <input type="hidden" name="stat_hidden[]" value="${stat}">
  
        ${ppn}
        <input type="hidden" name="ppn_hidden[]" value="${ppn}">
  
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
  
        <td class="text-uppercase size">
        ${size}
        <input type="hidden" name="size_hidden[]" value="${size}">
        </td>
  
        <td class="text-uppercase hrg">
        ${hrg}
        <input type="hidden" name="hrg_hidden[]" value="${hrg}">
        </td>
  
        <td class="text-uppercase disk">
        ${disk}
        <input type="hidden" name="disk_hidden[]" value="${disk}">
        </td>
  
        <td class="text-uppercase jmlbeli">
        ${jmlbeli}
        <input type="hidden" name="jmlbeli_hidden[]" value="${jmlbeli}">
        </td>
  
        <td class="text-uppercase totmindisk">
        ${totmindisk}
        <input type="hidden" name="totmindisk_hidden[]" value="${totmindisk}">
        </td>
  
        <td class="aksi">
          <button type="button" class="btn btn-danger btn-sm" id="tombol-hapus" data-noseri="${noseri}" data-id="${noseri}">
            <i class="fas fa-trash"></i>
          </button>
        </td>
      </tr>
      `;

			$("#cart tbody").append(newRow);

			$("button#tambah").addClass("btn-secondary");
			$("button#tambah").removeClass("btn-primary");

			reset();

			$("#totalban").html("<p class='m-0'>" + hitung_totalban() + "</p>");
			$("#total").html(
				"<p class='m-0'>" + hitung_total().toLocaleString() + "</p>"
			);
			$('input[name="totalban_hidden"]').val(hitung_totalban());
			$('input[name="total_hidden"]').val(hitung_total());

			$("tfoot").show();
		}
	});

	$("#tglbeli").on("change", function () {
		const tanggalSekarang = new Date();
		const tglbeli = $("#tglbeli").val();

		let tanggalInput = new Date(tglbeli);

		if (tanggalInput > tanggalSekarang) {
			Swal.fire({
				icon: "warning",
				title: "Cek tanggal!",
			});

			$("#noseri").prop("disabled", true);
			$("#btn-submitBan").prop("disabled", true);
		} else {
			$("#noseri").prop("disabled", false);
			$("#btn-submitBan").prop("disabled", false);
		}
	});

	$(document).on("click", "#tombol-hapus", function () {
		const idToRemove = $(this).data("id");

		cartPart = cartPart.filter((item) => item.id !== idToRemove);

		$(this).closest(".cart").remove();

		$("#totalban").html('<p class="m-0">' + hitung_totalban() + "</p>");
		$("#total").html('<p class="m-0">' + hitung_total() + "</p>");
		$('input[name="totalban_hidden"]').val(hitung_totalban());
		$('input[name="total_hidden"]').val(hitung_total());

		if ($("tbody").children().length == 0) $("tfoot").hide();
	});

	$('button[type="submit"]').on("click", function () {
		$("button#tambah").prop("disabled", true);
	});

	function hitung_total() {
		let total = 0;
		let diskall = $("#diskall")
			.val()
			.replace(/[^\d.]/g, "");
		let ppn = $("#ppn")
			.val()
			.replace(/[^\d.]/g, "");
		let min = diskall / 100;
		let hasil = 0;
		let sub = 0;
		if (diskall > 100) {
			$(".totmindisk").each(function () {
				total += parseFloat(
					$(this)
						.text()
						.replace(/[^\d.]/g, "")
				);
			});
			return total - diskall + parseFloat(ppn);
		} else {
			$(".totmindisk").each(function () {
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

	function hitung_totalban() {
		let totalban = 0;
		$(".jmlbeli").each(function () {
			totalban += parseFloat($(this).text());
		});
		return totalban;
	}

	function reset() {
		$(".output").hide();
		$("#noseri").val("");
		$("#size").val(null).trigger("change");
		$("#stat").val(null).trigger("change");
		$("#merkid").val(null).trigger("change");
		$("#jmlbeli").val("1");
		$("#hrg").val("0");
		$("#disk").val("0");
		$("#ket").val("");
		$("#totmindisk").val("0");
		$("#jmlbeli").prop("readonly", true);
		$("#size").prop("disabled", true);
		$("#stat").prop("disabled", true);
		$("#merkid").prop("disabled", true);
		$("#hrg").prop("readonly", true);
		$("#disk").prop("readonly", true);
		$("#ket").prop("readonly", true);
		$("#totmindisk").prop("readonly", true);
		$("button#tambah").prop("disabled", true);
	}

	$(document).on("select2:open", () => {
		document
			.querySelector(".select2-container--open .select2-search__field")
			.focus();
	});
});
