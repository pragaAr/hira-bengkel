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

$('#returBanTables').DataTable({
  ordering: true,
  order: [[0, 'desc']],
  pageLength: 20,
  initComplete: function () {
    var api = this.api();
    $('#returBanTables_filter input')
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
    url: 'http://localhost/he-bengkel/retur_ban/getRetur',
    type: 'POST',
    dataType: 'json',
  },
  columns: [
    {
      data: 'id_retur_ban',
      className: 'text-center',
    },
    {
      data: 'kd_retur_ban',
      render: function (data, type, row) {
        return data.toUpperCase();
      },
    },
    {
      data: 'kd_beli_ban',
      render: function (data, type, row) {
        return data.toUpperCase();
      },
    },
    {
      data: 'nama_toko',
      render: function (data, type, row) {
        return data.toUpperCase();
      },
    },
    {
      data: 'jml_ban_retur',
      className: 'text-center',
      render: function (data, type, row) {
        return data;
      },
    },
    {
      data: 'ket_ban_retur',
      render: function (data, type, row) {
        if (data == '') {
          return '<i class="fas fa-minus"></i>';
        } else {
          return data.toUpperCase();
        }
      },
    },
    {
      data: 'tgl_ban_retur',
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
