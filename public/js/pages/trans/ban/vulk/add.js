$(document).ready(function () {
  $('tfoot').hide();

  $(document).keypress(function (event) {
    if (event.which == '13') {
      event.preventDefault();
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
      console.log(data);
      $('#toko').val(data.text);
    });

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
          return {
            results: data,
          };
        },
      },
    })
    .on('select2:select', function (e) {
      const data = e.params.data;
      $('#noseri').val(data.text);
      $('#merk').val(data.merk);
      $('#size').val(data.size);

      $('#jml').val(1);
      $('#ket').prop('readonly', false).focus();
      $('button#tambah').prop('disabled', false);
    });

  $(document).on('click', '#tambah', function (e) {
    const cart = {
      noseri: $('#noseri').val(),
      banid: $('#banid').val(),
      merk: $('#merk').val(),
      size: $('#size').val(),
      jml: $('#jml').val(),
      ket: $('Ket').val(),
    };

    $.ajax({
      url: 'http://localhost/he-bengkel/vulkanisir/cart',
      type: 'POST',
      data: cart,
      success: function (data) {
        if ($('#banid').val() == cart.banid)
          $('option[value="' + cart.banid + '"]');

        $('#banid').val('').trigger('change');

        reset();

        $('table#cart tbody').append(data);
        $('#totalban').html('<p>' + hitung_totalban() + '</p>');
        $('input[name="totalban_hidden"]').val(hitung_totalban());

        $('tfoot').show();
      },
    });
  });

  $(document).on('click', '#tombol-hapus', function () {
    $(this).closest('.cart').remove();

    $('option[value="' + $(this).data('noseri') + '"]').show();
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
