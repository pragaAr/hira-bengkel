$(document).ready(function () {
  $('tfoot').hide();

  $(document).keypress(function (event) {
    if (event.which == '13') {
      event.preventDefault();
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

			$(".selectban").prop("disabled", true);
			$("#btn-submitVulk").prop("disabled", true);
		} else {
			$(".selectban").prop("disabled", false);
			$("#btn-submitVulk").prop("disabled", false);
		}
	});

  $('.selecttoko')
    .select2({
      placeholder: 'Pilih Toko',
      theme: 'bootstrap4',
      ajax: {
        url: 'http://localhost/he-bengkel/toko/getListToko',
        dataType: 'json',
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
    .on('select2:select', function (e) {
      const data = e.params.data;
      $('#toko').val(data.text);
    });

  let cartBan = [];

  $('.selectban')
    .select2({
      placeholder: 'Pilih Ban',
      theme: 'bootstrap4',
      ajax: {
        url: 'http://localhost/he-bengkel/ban/getDataBanVulk',
        dataType: 'json',
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
    .on('select2:select', function (e) {
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

				$("#noseri").val(data.text);
				$("#merk").val(data.merk);
				$("#size").val(data.size);
				$("#jml").val(1);
				$("#ket").prop("readonly", false).focus();
				$("button#tambah").prop("disabled", false);
			}
    });

  $(document).on('click', '#tambah', function (e) {
    const noseri = $("#noseri").val();
		const banid = $("#banid").val();
		const merk = $("#merk").val();
		const size = $("#size").val();
		const jml = $("#jml").val();
		const ket = $("#ket").val();

    const newRow = `
    <tr class="cart text-center">
		 	${banid}
      <input type="hidden" name="banid_hidden[]" value="${banid}">

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

			<td class="text-uppercase jml">
      ${jml}
      <input type="hidden" name="jml_hidden[]" value="${jml}">
      </td>

      <td class="aksi">
        <button type="button" class="btn btn-danger" id="tombol-hapus" data-no-seri-ban="${noseri}" data-id="${banid}">
          Hapus
        </button>
      </td>
    </tr>
  `;

		$("#cart tbody").append(newRow);

		$(".selectban").val(null).trigger("change");
		$("#totalban").html("<p class='m-0'>" + hitung_totalban() + "</p>");
		$('input[name="totalban_hidden"]').val(hitung_totalban());

		$("tfoot").show();
  });

  $(document).on('click', '#tombol-hapus', function () {
    const idToRemove = $(this).data("id");

		// hapus cart array dengan key yang ditentukan
		cartBan = cartBan.filter((item) => parseInt(item.id) !== idToRemove);
    
    $(this).closest('.cart').remove();

    $('option[value="' + $(this).data('noseri') + '"]').show();
    $('#totalban').html('<p class="m-0">' + hitung_totalban() + '</p>');
    $('input[name="totalban_hidden"]').val(hitung_totalban());

    if ($('tbody').children().length == 0) $('tfoot').hide();
  });

  $('button[type="submit"]').on('click', function () {
    $('#noseri').prop('disabled', true);
  });

  function hitung_totalban() {
    let totalban = 0;
    $('.jml').each(function () {
      totalban += parseFloat($(this).text());
    });
    return totalban;
  }

  function reset() {
    $('#banid').val('');
    $('#noseri').val('');
    $('#merk').val('');
    $('#jml').val('');
    $('#ket').val('');
    $('#size').val('');
    $('#jml').prop('readonly', true);
    $('#merk').prop('readonly', true);
    $('#merkid').prop('readonly', true);
    $('#size').prop('readonly', true);
    $('#ket').prop('readonly', true);

    $('button#tambah').prop('disabled', true);
  }

  $(document).on('select2:open', () => {
    document
      .querySelector('.select2-container--open .select2-search__field')
      .focus();
  });
});
