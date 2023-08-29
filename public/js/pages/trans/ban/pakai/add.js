$(document).ready(function () {
  $('tfoot').hide();

  $(document).keypress(function (event) {
    if (event.which == '13') {
      event.preventDefault();
    }
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
      $('#montir').focus();
    });

  $('.selectban')
    .select2({
      placeholder: 'Pilih Ban',
      theme: 'bootstrap4',
      ajax: {
        url: 'http://localhost/he-bengkel/ban/getListBan',
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
      $('#noseri').val(data.noseri);
      $('#merk').val(data.merkban);
      $('#merkid').val(data.merkid);
      $('#ukuran').val(data.ukuran);

      if (data.stat == 0) {
        $('#stat').val('Ori');
      } else {
        $('#stat').val('Vulkanisir');
      }

      $('#status').val(data.stat);

      $('#jml').val(1);
      $('#ket').prop('readonly', false).focus();
      $('button#tambah').prop('disabled', false);
    });

  // =============== //

  $(document).on('click', '#tambah', function (e) {
    const cart = {
      banid: $('#banid').val(),
      truckid: $('#truckid').val(),
      platno: $('#platno').val(),
      montir: $('#montir').val(),
      noseri: $('#noseri').val(),
      merkid: $('#merkid').val(),
      merk: $('#merk').val(),
      ukuran: $('#ukuran').val(),
      status: $('#status').val(),
      stat: $('#stat').val(),
      jml: $('#jml').val(),
      ket: $('#ket').val(),
    };

    $.ajax({
      url: 'http://localhost/he-bengkel/pakai_ban/cart',
      type: 'POST',
      data: cart,
      success: function (data) {
        $('button#tambah').prop('disabled', true);

        reset();

        $('table#cart tbody').append(data);
        $('#totalban').html('<p>' + hitung_totalban() + '</p>');
        $('input[name="totalban_hidden"]').val(hitung_totalban());
      },
    });

    $('tfoot').show();
  });

  $(document).on('click', '#tombol-hapus', function () {
    $(this).closest('.cart').remove();

    $('#totalban').html('<p>' + hitung_totalban() + '</p>');
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
    $('#banid').val(null).trigger('change');
    $('#noseri').val('');
    $('#merk').val('');
    $('#merkid').val('');
    $('#ukuran').val('');
    $('#stat').val('');
    $('#status').val('');
    $('#jml').val(1);
    $('#ket').val('');
    $('#ket').prop('readonly', true);

    $('button#tambah').prop('disabled', true);
  }

  $(document).on('select2:open', () => {
    document
      .querySelector('.select2-container--open .select2-search__field')
      .focus();
  });
});
