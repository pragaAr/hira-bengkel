$(document).ready(function () {
  $('tfoot').hide();

  $(document).keypress(function (event) {
    if (event.which == '13') {
      event.preventDefault();
    }
  });

  $('#seri').keydown(function (e) {
    if (e.which == '32') {
      return false;
    }
  });

  $('#diskall').on('keypress', function (key) {
    if (key.charCode < 48 || key.charCode > 57) return false;
  });

  $('#ppn').on('keypress', function (key) {
    if (key.charCode < 48 || key.charCode > 57) return false;
  });

  $('#hrg').on('keypress', function (key) {
    if (key.charCode < 48 || key.charCode > 57) return false;
  });

  $('#disk').on('keypress', function (key) {
    if (key.charCode < 48 || key.charCode > 57) return false;
  });

  $(function () {
    $('#diskall').on('keydown keyup click change blur input', function (e) {
      $(this).val(format($(this).val()));
    });
  });

  $(function () {
    $('#ppn').on('keydown keyup click change blur input', function (e) {
      $(this).val(format($(this).val()));
    });
  });

  $(function () {
    $('#hrg').on('keydown keyup click change blur input', function (e) {
      $(this).val(format($(this).val()));
    });
  });

  $(function () {
    $('#disk').on('keydown keyup click change blur input', function (e) {
      $(this).val(format($(this).val()));
    });
  });

  $('.selectstatusbayar').select2({
    placeholder: 'Pembayaran',
    theme: 'bootstrap4',
    minimumResultsForSearch: Infinity,
  });

  $('.selectstat').select2({
    placeholder: 'Status',
    theme: 'bootstrap4',
    minimumResultsForSearch: Infinity,
  });

  $('.selectsize').select2({
    placeholder: 'Ukuran',
    theme: 'bootstrap4',
    minimumResultsForSearch: Infinity,
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

  $(document).on('click', '.btn-add-toko', function () {
    $('#modal-addnew-toko').modal('show');
    $('#modal-addnew-toko').on('shown.bs.modal', function () {
      $('input[name="namatoko"]').focus();
    });
  });

  $('#btn-submit-toko').on('click', function (e) {
    e.preventDefault();
    const namatoko = $('#namatoko').val();
    const telptoko = $('#telptoko').val();

    $.ajax({
      url: 'http://localhost/he-bengkel/toko/addSelect',
      method: 'POST',
      data: {
        namatoko: namatoko,
        telptoko: telptoko,
      },
      success: function (response) {
        $('#namatoko').val('');
        $('#telptoko').val('');
        $('#modal-addnew-toko').modal('hide');

        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: 'Data Toko berhasil ditambahkan!',
        });

        const tokoparse = JSON.parse(response);
        const newTokoOptions = new Option(
          tokoparse.text,
          tokoparse.id,
          true,
          true
        );
        $('.selecttoko').append(newTokoOptions).trigger('change');
        $('#toko').val(newTokoOptions.text);
      },
    });
  });

  // =============== //

  $('#noseri').on('input', function () {
    $(this).val();
    $.ajax({
      url: 'http://localhost/he-bengkel/beli_ban/getSeri',
      type: 'POST',
      dataType: 'json',
      data: {
        noseri: $(this).val(),
      },
      success: function (data) {
        if (data.length > 0) {
          setTimeout(() => {
            $('.output')
              .show()
              .html(
                "<span class='text-danger font-weight-bold'>No Seri Sudah Ada!</span>"
              )
              .fadeIn('slow');
            $('#merkid').prop('disabled', true);
            $('#size').prop('disabled', true);
            $('#hrg').prop('readonly', true);
            $('#disk').prop('readonly', true);
            $('#stat').prop('disabled', true);
            $('#ket').prop('readonly', true);
          }, 500);
        } else {
          setTimeout(() => {
            $('.output')
              .show()
              .html(
                "<span class='text-success font-weight-bold'>No Seri Belum Tersedia</span>"
              )
              .fadeIn('slow');
            $('#merkid').prop('disabled', false);
            $('#size').prop('disabled', false);
            $('#hrg').prop('readonly', false);
            $('#disk').prop('readonly', false);
            $('#stat').prop('disabled', false);
            $('#ket').prop('readonly', false);
          }, 500);
        }
      },
    });
  });

  // =============== //

  // =============== //

  $('.selectmerk')
    .select2({
      placeholder: 'Pilih Merk',
      theme: 'bootstrap4',
      ajax: {
        url: 'http://localhost/he-bengkel/merk/getDataMerk',
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
      $('#merk').val(data.text);
    });

  function jmlharga() {
    let jmlbeli = $('#jmlbeli').val();
    let hargapcs = $('#hrg')
      .val()
      .replace(/[^\d.]/g, '');
    let subtotal = parseFloat(jmlbeli * hargapcs);
    $('#totmindisk').val(format(subtotal));
  }

  $('#hrg').on('input', function () {
    jmlharga();
  });

  $('#disk').on('input change keyup', function () {
    $('#totmindisk').val(
      $('#disk')
        .val()
        .replace(/[^\d.]/g, '') <= 100
        ? diskPersen()
        : diskNominal()
    );
  });

  $('#hrg').on('input change keyup', function () {
    $('#totmindisk').val(
      $('#disk')
        .val()
        .replace(/[^\d.]/g, '') <= 100
        ? diskPersen()
        : diskNominal()
    );
  });

  function diskPersen() {
    let harga = $('#hrg')
      .val()
      .replace(/[^\d.]/g, '');
    let diskon = $('#disk')
      .val()
      .replace(/[^\d.]/g, '');
    let persen = 100;
    let diskonpersen = parseFloat(diskon / persen);
    let hargaxdiskon = diskonpersen * harga;

    let bayar = harga - hargaxdiskon;
    return format(bayar);
  }

  function diskNominal() {
    let harga = $('#hrg')
      .val()
      .replace(/[^\d.]/g, '');
    let diskon = $('#disk')
      .val()
      .replace(/[^\d.]/g, '');
    let bayar = parseFloat(harga - diskon);
    return format(bayar);
  }

  // check if this have value or not, affected to the button Tambah
  $('#stat').on('change', function () {
    if ($('#stat').val() == '') {
      $('button#tambah').prop('disabled', true);
    } else {
      $('#ket').focus();
      $('button#tambah').prop('disabled', false);
      $('button#tambah').removeClass('btn-secondary');
      $('button#tambah').addClass('btn-primary');
    }
  });

  $(document).on('click', '#tambah', function (e) {
    const cart = {
      noseri: $('#noseri').val(),
      merkid: $('#merkid').val(),
      merk: $('#merk').val(),
      size: $('#size').val(),
      stat: $('#stat').val(),
      jmlbeli: $('#jmlbeli').val(),
      hrg: $('#hrg')
        .val()
        .replace(/[^\d.]/g, ''),
      ket: $('#ket').val(),
      totmindisk: $('#totmindisk')
        .val()
        .replace(/[^\d.]/g, ''),
      disk: $('#disk')
        .val()
        .replace(/[^\d.]/g, ''),
      ppn: $('#ppn')
        .val()
        .replace(/[^\d.]/g, ''),
    };

    $.ajax({
      url: 'http://localhost/he-bengkel/beli_ban/cart',
      type: 'POST',
      data: cart,
      success: function (data) {
        $('button#tambah').addClass('btn-secondary');
        $('button#tambah').removeClass('btn-primary');
        reset();

        $('table#cart tbody').append(data);
        $('#totalban').html('<p>' + hitung_totalban() + '</p>');
        $('#total').html('<p>' + hitung_total().toLocaleString() + '</p>');
        $('input[name="totalban_hidden"]').val(hitung_totalban());
        $('input[name="total_hidden"]').val(hitung_total());

        $('tfoot').show();
      },
    });
  });

  $(document).on('click', '#tombol-hapus', function () {
    $(this).closest('.cart').remove();

    $('#totalban').html('<p>' + hitung_totalban() + '</p>');
    $('#total').html('<p>' + hitung_total() + '</p>');
    $('input[name="totalban_hidden"]').val(hitung_totalban());
    $('input[name="total_hidden"]').val(hitung_total());

    if ($('tbody').children().length == 0) $('tfoot').hide();
  });

  $('button[type="submit"]').on('click', function () {
    $('button#tambah').prop('disabled', true);
  });

  function hitung_total() {
    let total = 0;
    let diskall = $('#diskall')
      .val()
      .replace(/[^\d.]/g, '');
    let ppn = $('#ppn')
      .val()
      .replace(/[^\d.]/g, '');
    let min = diskall / 100;
    let hasil = 0;
    let sub = 0;
    if (diskall > 100) {
      $('.totmindisk').each(function () {
        total += parseFloat(
          $(this)
            .text()
            .replace(/[^\d.]/g, '')
        );
      });
      return total - diskall + parseFloat(ppn);
    } else {
      $('.totmindisk').each(function () {
        hasil += parseFloat(
          $(this)
            .text()
            .replace(/[^\d.]/g, '')
        );
      });
      sub = hasil * min;
      return hasil - sub + parseFloat(ppn);
    }
  }

  function hitung_totalban() {
    let totalban = 0;
    $('.jmlbeli').each(function () {
      totalban += parseFloat($(this).text());
    });
    return totalban;
  }

  function reset() {
    $('.output').hide();
    $('#noseri').val('');
    $('#size').val(null).trigger('change');
    $('#stat').val(null).trigger('change');
    $('#merkid').val(null).trigger('change');
    $('#jmlbeli').val('1');
    $('#hrg').val('0');
    $('#disk').val('0');
    $('#ket').val('');
    $('#totmindisk').val('');
    $('#jmlbeli').prop('readonly', true);
    $('#size').prop('disabled', true);
    $('#stat').prop('disabled', true);
    $('#merkid').prop('disabled', true);
    $('#hrg').prop('readonly', true);
    $('#disk').prop('readonly', true);
    $('#ket').prop('readonly', true);
    $('#totmindisk').prop('readonly', true);
    $('button#tambah').prop('disabled', true);
  }

  $(document).on('select2:open', () => {
    document
      .querySelector('.select2-container--open .select2-search__field')
      .focus();
  });
});
