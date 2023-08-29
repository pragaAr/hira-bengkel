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

$('#returPartTables').DataTable({
  ordering: true,
  order: [[0, 'desc']],
  pageLength: 10,
  initComplete: function () {
    var api = this.api();
    $('#returPartTables_filter input')
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
    url: 'http://localhost/he-bengkel/retur/getRetur',
    type: 'POST',
    dataType: 'json',
  },
  columns: [
    {
      data: 'id_retur',
      className: 'text-center',
    },
    {
      data: 'kd_retur',
      render: function (data, type, row) {
        return data.toUpperCase();
      },
    },
    {
      data: 'kd_beli',
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
      data: 'jml_retur',
      className: 'text-center',
      render: function (data, type, row) {
        return data;
      },
    },
    {
      data: 'ket_retur',
      render: function (data, type, row) {
        if (data == '') {
          return '<i class="fas fa-minus"></i>';
        } else {
          return data.toUpperCase();
        }
      },
    },
    {
      data: 'tgl_retur',
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

$(document).on('select2:open', () => {
  document
    .querySelector('.select2-container--open .select2-search__field')
    .focus();
});
