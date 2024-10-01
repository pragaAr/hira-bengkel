$(document).ready(function () {
  $('tfoot').hide();

  $(document).keypress(function (event) {
    if (event.which == '13') {
      event.preventDefault();
    }
  });

  $('.selectstatus').select2({
    placeholder: 'Pilih Status',
    theme: 'bootstrap4',
    minimumResultsForSearch: Infinity,
  });

  $('.selecttruck')
    .select2({
      placeholder: 'Pilih Truck',
      theme: 'bootstrap4',
      ajax: {
        url: 'http://localhost/he-bengkel/truck/getListTruck',
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
      $('#platno').val(data.text);
      $('#montir').prop('readonly', false).focus();
    });

  $('.selectpart')
    .select2({
      placeholder: 'Pilih Part',
      theme: 'bootstrap4',
      ajax: {
        url: 'http://localhost/he-bengkel/stok/getListStok',
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
      $('#jenispart').val(data.namapart);
      $('#merk').val(data.merkpart);
      $('#merkid').val(data.merkid);
      $('#sat').val(data.satuanpart);
      $('#baru').val(data.baru);
      $('#bekas').val(data.bekas);
      $('#jml').val(1);
      $('#jml').prop('readonly', false).focus();
      $('.selectstatus').prop('disabled', false);
      $('#ket').prop('readonly', false);
    });

  $('.selectstatus').on('change', function () {
    if ($('.selectstatus').val() == '') {
      $('button#tambah').prop('disabled', true);
    } else {
      $('button#tambah').prop('disabled', false);
      $('button#tambah').removeClass('btn-secondary');
      $('button#tambah').addClass('btn-primary');
    }
  });

  // =============== //

  $(document).on('click', '#tambah', function (e) {
    const cart = {
      truckid: $('#truckid').val(),
      platno: $('#platno').val(),
      montir: $('#montir').val(),
      partid: $('#partid').val(),
      part: $('#jenispart').val(),
      merkid: $('#merkid').val(),
      merk: $('#merk').val(),
      sat: $('#sat').val(),
      baru: $('#baru').val(),
      bekas: $('#bekas').val(),
      statuspart: $('#statuspart').val(),
      jml: $('#jml').val(),
      ket: $('#ket').val(),
    };

    cart.statuspart === 'Baru' && parseInt(cart.baru) < parseInt(cart.jml)
      ? (alert(
          'Stok tidak tersedia! Stok Baru yang tersedia: ' + parseInt(cart.baru)
        ),
        reset())
      : cart.statuspart === 'Bekas' && parseInt(cart.bekas) < parseInt(cart.jml)
      ? (alert(
          'Stok tidak tersedia! Stok Bekas yang tersedia: ' +
            parseInt(cart.bekas)
        ),
        reset())
      : send();
    $('tfoot').show();

    function send() {
      $.ajax({
        url: 'http://localhost/he-bengkel/pakai/cart',
        type: 'POST',
        data: cart,
        success: function (data) {
          $('button#tambah').prop('disabled', true);
          $('button#tambah').addClass('btn-secondary');
          $('button#tambah').removeClass('btn-primary');
          reset();

          $('table#cart tbody').append(data);
          $('#totalpart').html('<p>' + hitung_totalpart() + '</p>');
          $('input[name="totalpart_hidden"]').val(hitung_totalpart());
        },
      });
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

  $(document).on('click', '#tombol-hapus', function () {
    $(this).closest('.cart-pakai').remove();

    $('option[value="' + $(this).data('partid') + '"]').show();
    $('#totalpart').html('<p>' + hitung_totalpart() + '</p>');
    $('input[name="totalpart_hidden"]').val(hitung_totalpart());

    if ($('tbody').children().length == 0) $('tfoot').hide();
  });

  $('button[type="submit"]').on('click', function () {
    $('#jenispart').prop('disabled', true);
  });

  function hitung_totalpart() {
    let totalpart = 0;
    $('.jml').each(function () {
      totalpart += parseFloat($(this).text());
    });

    return totalpart;
  }

  function reset() {
    $('#partid').val(null).trigger('change');
    $('#jenispart').val('');
    $('#sat').val('');
    $('#merk').val('');
    $('#merkid').val('');
    $('#jml').val(1);
    $('#statuspart').val(null).trigger('change');
    $('#ket').val('');
    $('#statuspart').prop('disabled', true);
    $('#jml').prop('readonly', true);
    $('#sat').prop('readonly', true);
    $('#ket').prop('readonly', true);

    $('button#tambah').prop('disabled', true);
  }

  $(document).on('select2:open', () => {
    document
      .querySelector('.select2-container--open .select2-search__field')
      .focus();
  });
});
