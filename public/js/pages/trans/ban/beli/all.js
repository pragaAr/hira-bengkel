$.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
  return {
    iStart: oSettings._iDisplayStart,
    iEnd: oSettings.fnDisplayEnd(),
    iLength: oSettings._iDisplayLength,
    iTotal: oSettings.fnRecordsTotal(),
    iFilteredTotal: oSettings.fnRecordsDisplay(),
    iPage: Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
    iTotalPages: Math.ceil(
      oSettings.fnRecordsDisplay() / oSettings._iDisplayLength
    ),
  };
};

$('#allBeliBanTables').DataTable({
  ordering: true,
  order: [[0, 'desc']],
  language: {
    searchPlaceholder: 'Search DO',
  },
  pageLength: 20,
  initComplete: function () {
    var api = this.api();
    $('#allBeliBanTables_filter input')
      .off('.DT')
      .on('input.DT', function () {
        api.search(this.value).draw();
      });
  },
  lengthChange: false,
  autoWidth: false,
  processing: true,
  serverSide: true,
  ajax: {
    url: 'http://localhost/he-bengkel/beli_ban/getDetailAll',
    type: 'POST',
    dataType: 'json',
  },
  columns: [
    {
      data: 'id_detail_beli_ban',
      className: 'text-center',
      searchable: false,
    },
    {
      data: 'kd_beli_ban',
      searchable: true,
      render: function (data, type, row) {
        return data.toUpperCase();
      },
    },
    {
      data: 'nama_toko',
      searchable: false,
      render: function (data, type, row) {
        return data.toUpperCase();
      },
    },
    {
      data: 'no_seri_ban',
      className: 'text-center',
      render: function (data, type, row) {
        return (
          data.toUpperCase() +
          ', ' +
          row.nama_merk.toUpperCase()
        );
      },
    },
    {
      data: 'ukuran_ban_beli',
      className: 'text-center',
      render: function (data, type, row) {
        return data.toUpperCase();
      },
    },
    {
      data: 'status_ban_beli',
      searchable: false,
      className: 'text-center',
      render: function (data, type, row) {
        if (data == 0) {
          return 'Ori';
        } else {
          return 'Vulk';
        }
      },
    },
    {
      data: 'jml_beli_ban',
      searchable: false,
      className: 'text-center',
      render: function (data, type, row) {
        return data;
      },
    },
    {
      data: 'harga_ban',
      searchable: false,
      render: function (data, type, row) {
        var value = parseFloat(data);
        return (
          'Rp. ' + value.toLocaleString('id-ID', { minimumFractionDigits: 0 })
        );
      },
    },
    {
      data: 'diskon_ban',
      searchable: false,
      className: 'text-center',
      render: function (data, type, row) {
        if (data.length <= 2) {
          return data + '%';
        } else {
          var value = parseFloat(data);
          return (
            'Rp. ' + value.toLocaleString('id-ID', { minimumFractionDigits: 0 })
          );
        }
      },
    },
    {
      data: 'sub_total_ban',
      searchable: false,
      render: function (data, type, row) {
        var value = parseFloat(data);
        return (
          'Rp. ' + value.toLocaleString('id-ID', { minimumFractionDigits: 0 })
        );
      },
    },
    {
      data: 'tgl_beli_ban',
      searchable: false,
      className: 'text-center',
      render: function (data, type, row) {
        var date = new Date(data);
        return date.toLocaleDateString('id-ID', {
          day: '2-digit',
          month: '2-digit',
          year: 'numeric',
        });
      },
    },
    {
      data: 'ket_beli_ban',
      searchable: false,
      className: 'text-center',
      render: function (data, type, row) {
        if (data == '') {
          return '<i class="fas fa-minus"></i>';
        } else {
          return data.toUpperCase();
        }
      },
    },

    {
      data: 'view',
      className: 'text-center',
    },
  ],

  fnDrawCallback: function (oSettings) {
    $('[data-toggle="tooltip"]').tooltip();
  },

  rowCallback: function (row, data, iDisplayIndex) {
    var info = this.fnPagingInfo();
    var page = info.iPage;
    var length = info.iLength;
    var index = page * length + (iDisplayIndex + 1);
    $('td:eq(0)', row).html(index + '.');
  },
});

$('#allBeliBanTables').on('click', '.btn-retur', function () {
  const id = $(this).data('id');

  $.ajax({
    url: 'http://localhost/he-bengkel/beli_ban/getDetailAllById',
    type: 'POST',
    data: {
      id: id,
    },
    success: function (data) {
      const parsedata = JSON.parse(data);

      console.log(parsedata);

      $('#id').val(parsedata.id_detail_beli_ban);
      $('#kd').val(parsedata.kd_beli_ban);
      $('#toko').val(parsedata.nama_toko);
      $('#tokoid').val(parsedata.id_toko);
      $('#noseri').val(parsedata.no_seri_ban);
      $('#merkid').val(parsedata.id_merk);
      $('#statretur').val(parsedata.status_ban_beli);
      $('#ukuran').val(parsedata.ukuran_ban_beli);
      $('#jmlbeli').val(parsedata.jml_beli_ban);
      $('#jmlbeli').attr({
        min: 1,
        max: parsedata.jml_beli_ban,
      });
      $('#hrgpcs').val(format(parsedata.harga_ban));
      $('#diskon').val(parsedata.diskon_ban);
      $('#subtotal').val(format(parsedata.sub_total_ban));
    },
  });

  $('#returban').modal('show');
});

$('#returban').on('shown.bs.modal', function () {
  $('#jmlbeli').focus();
});

$('#form_returban').on('submit', function () {
  const id = $('#id').val();
  const kd = $('#kd').val();
  const toko = $('#toko').val();
  const tokoid = $('#tokoid').val();
  const noseri = $('#noseri').val();
  const merkid = $('#merkid').val();
  const stat = $('#statretur').val();
  const jmlretur = $('#jmlbeli').val();
  const ukuran = $('#ukuran').val();
  const hrgpcs = $('#hrgpcs').val();
  const diskon = $('#diskon').val();
  const ket = $('#ket').val();

  $.ajax({
    url: 'http://localhost/he-bengkel/beli_ban/retur',
    type: 'POST',
    data: {
      id: id,
      kd: kd,
      toko: toko,
      tokoid: tokoid,
      noseri: noseri,
      merkid: merkid,
      stat: stat,
      jmlretur: jmlretur,
      ukuran: ukuran,
      hrgpcs: hrgpcs,
      diskon: diskon,
      ket: ket,
    },
    success: function (data) {
      $('#id').val('');
      $('#kd').val('');
      $('#toko').val('');
      $('#tokoid').val('');
      $('#noseri').val('');
      $('#merkid').val('');
      $('#statretur').val('');
      $('#jmlbeli').val('');
      $('#ukuran').val('');
      $('#hrgpcs').val('');
      $('#diskon').val('');
      $('#subtotal').val('');
      $('#ket').val('');

      $('#returban').modal('hide');

      Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: 'Ban Berhasil diretur !',
      });
      $('#allBeliBanTables').DataTable().ajax.reload(null, false);
    },
  });

  return false;
});
