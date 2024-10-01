$(document).ready(function () {
	$("tfoot").hide();

	$(function () {
		$("#biaya").on("keydown keyup click change blur", function (e) {
			$(this).val(format($(this).val()));
		});
	});

	$("#biaya").on("keypress", function (key) {
		if (key.charCode < 48 || key.charCode > 57) return false;
	});

	$(".selectpay").select2({
		placeholder: "Pilih Pembayaran",
		theme: "bootstrap4",
		minimumResultsForSearch: Infinity,
	});

	$(".selectban").select2({
		placeholder: "Pilih Ban",
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

			$.ajax({
				url: "http://localhost/he-bengkel/vulkanisir/getDataByTempat",
				type: "POST",
				dataType: "json",
				data: {
					tempat: $("#tempat").val(),
				},
				success: function (data) {
					console.log(data);
					if (data.length == 0) {
						$("#banid").empty().prop("disabled", true);

						reset();
					} else {
						let html = "";
						for (let count = 0; count < data.length; count++) {
							html +=
								'<option data-kd="' +
								data[count].kd_vulk +
								'" value="' +
								data[count].no_seri_vulk +
								'">' +
								data[count].no_seri_vulk;
							("</option>");
						}
						$("#banid").empty();
						$("#banid").prop("disabled", false);
						$("#banid").append(
							`<option value="" selected disabled>Pilih Ban</option>`
						);

						$("#banid").append(html);
					}
				},
			});
		});

	let cartBan = [];

	$(".selectban").on("select2:select", function (e) {
		const data = e.params.data;

		const el = data.element;

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

			const datakd = $(el).data("kd");

			$.ajax({
				url: "http://localhost/he-bengkel/vulkanisir/getDataBan",
				type: "POST",
				dataType: "json",
				data: {
					kd: datakd,
					seri: $(this).val(),
				},
				success: function (data) {
					$("#merk").val(data.merk_vulk);
					$("#kdvulk").val(datakd);
					$("#kdvulk").val(data.kd_vulk);
					$("#size").val(data.ukuran_ban_vulk);
					$("#jml").val(data.jml_vulk);
					$("#jmldivulk").val(data.sudah_vulk);
					$("#biaya").prop("readonly", false);
					$("#biaya").focus();

					$("button#tambah").prop("disabled", false);
				},
			});
		}
	});

	$(document).on("click", "#tambah", function (e) {
		const noseri = $("#banid").val();
		const merk = $("#merk").val();
		const size = $("#size").val();
		const jml = $("#jml").val();
		const kdvulk = $("#kdvulk").val();
		const jmldivulk = $("#jmldivulk").val();
		const biaya = $("#biaya")
			.val()
			.replace(/[^\d.]/g, "");

		const newRow = `
    <tr class="cart-selesai text-center">
      <td class="text-uppercase seri">
      ${noseri}
      <input type="hidden" name="seri_hidden[]" value="${noseri}">
      <input type="hidden" name="jmldivulk_hidden[]" value="${jmldivulk}">
      <input type="hidden" name="kdvulk_hidden[]" value="${kdvulk}">
      </td>

      <td class="text-uppercase merk">
      ${merk}
      <input type="hidden" name="merk_hidden[]" value="${merk}">
      </td>

			<td class="text-uppercase size">
      ${size}
      <input type="hidden" name="size_hidden[]" value="${size}">
      </td>

			<td class="text-uppercase jml">
      ${jml}
      <input type="hidden" name="jml_hidden[]" value="${jml}">
      </td>

			<td class="text-uppercase biaya">
      ${biaya}
      <input type="hidden" name="biaya_hidden[]" value="${biaya}">
      </td>

      <td class="aksi">
        <button type="button" class="btn btn-danger" id="tombol-hapus" data-seri="${noseri}" data-id="${noseri}">
          Hapus
        </button>
      </td>
    </tr>
  `;

		$("#cart-selesai tbody").append(newRow);

		$(".selectban").val(null).trigger("change");
		$("#jmldivulk").val("");
		$("#kdvulk").val("");
		$("#merk").val("");
		$("#size").val("");
		$("#totalban").html("<p class='m-0'>" + hitung_totalban() + "</p>");
		$('input[name="totalban_hidden"]').val(hitung_totalban());
		$("#totalbiaya").html(
			"<p class='m-0'>" + hitungTotalBiaya().toLocaleString() + "</p>"
		);
		$('input[name="total_hidden"]').val(hitungTotalBiaya());

		$("tfoot").show();
	});

	$(document).on("click", "#tombol-hapus", function () {
		const idToRemove = $(this).data("id");

		// hapus cart array dengan key yang ditentukan
		cartBan = cartBan.filter((item) => item.id !== idToRemove);

		$(this).closest(".cart-selesai").remove();

		$("#totalban").html("<p class='m-0'>" + hitung_totalban() + "</p>");
		$('input[name="totalban_hidden"]').val(hitung_totalban());

		$("#totalbiaya").html(
			"<p class='m-0'>" + hitungTotalBiaya().toLocaleString() + "</p>"
		);
		$('input[name="total_hidden"]').val(hitungTotalBiaya());

		$(".selectban").val(null).trigger("change");

		if ($("tbody").children().length == 0) $("tfoot").hide();
	});

	$('button[type="submit"]').on("click", function () {
		$("#toko").prop("readonly", true);
	});

	function hitungTotalBiaya() {
		let totbiaya = 0;
		$(".biaya").each(function () {
			totbiaya += parseFloat(
				$(this)
					.text()
					.replace(/[^\d.]/g, "")
			);
		});
		return totbiaya;
	}

	function hitung_totalban() {
		let totalban = 0;
		$(".jml").each(function () {
			totalban += parseFloat($(this).text());
		});
		return totalban;
	}

	function reset() {
		$("#banid").val(null).trigger("change");
		$("#kdvulk").val("");
		$("#jmldivulk").val("");
		$("#merk").val("");
		$("#size").val("");
		$("#jml").val("");
		$("#biaya").val("");
		$("#biaya").prop("readonly", true);
		$("button#tambah").prop("disabled", true);
	}

	$(document).on("select2:open", () => {
		document
			.querySelector(".select2-container--open .select2-search__field")
			.focus();
	});
});
