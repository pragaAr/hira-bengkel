$(document).ready(function () {
  $('tfoot').hide();

  $(document).keypress(function (event) {
    if (event.which == '13') {
      event.preventDefault();
    }
  });

  $('#ongkos').on('keypress', function (key) {
    if (key.charCode < 48 || key.charCode > 57) return false;
  });

  $(function () {
    $('#ongkos').on('keydown keyup click change blur input', function (e) {
      $(this).val(format($(this).val()));
    });
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
      console.log(data);
      $('#platno').val(data.text);
    });

  $(document).on('click', '#tambah', function (e) {
    const cart = {
      truck: $('#truckid').val(),
      plat: $('#platno').val(),
      sopir: $('#sopir').val(),
      bengkel: $('#bengkel').val(),
      tglnota: $('#tglnota').val(),
      part: $('#part').val(),
      ongkos: $('#ongkos')
        .val()
        .replace(/[^\d.]/g, ''),
      ket: $('#ket').val(),
    };

    $.ajax({
      url: 'http://localhost/he-bengkel/percab/cart',
      type: 'POST',
      data: cart,
      success: function (data) {
        if ($('#truckid').val() == cart.truck)
          $('option[value="' + cart.truck + '"]').hide();

        reset();

        $('table#cart tbody').append(data);
        $('#total').html(
          "<p class='font-weight-bold'>" +
            hitung_total().toLocaleString() +
            '</p>'
        );
        $('input[name="total_hidden"]').val(hitung_total());

        $('tfoot').show();
      },
    });
  });

  $(document).on('click', '#tombol-hapus', function () {
    $(this).closest('.cart').remove();

    $('option[value="' + $(this).data('truck') + '"]').show();
    $('#total').html("<p class='font-weight-bold'>" + hitung_total() + '</p>');
    $('input[name="total_hidden"]').val(hitung_total());

    if ($('tbody').children().length == 0) $('tfoot').hide();
  });

  $('button[type="submit"]').on('click', function () {
    $('#sopir').prop('disabled', true);
  });

  function hitung_total() {
    let totalongkos = 0;
    $('.ongkos').each(function () {
      totalongkos += parseFloat(
        $(this)
          .text()
          .replace(/[^\d.]/g, '')
      );
    });
    return totalongkos;
  }

  function reset() {
    $('#part').val('');
    $('#ongkos').val('');
    $('#ket').val('');
  }

  $(document).on('select2:open', () => {
    document
      .querySelector('.select2-container--open .select2-search__field')
      .focus();
  });
});
