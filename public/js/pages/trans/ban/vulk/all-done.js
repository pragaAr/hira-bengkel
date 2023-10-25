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

$('#detailAllDoneTables').DataTable({
  ordering: true,
  order: [[0, 'desc']],
  pageLength: 10,
  initComplete: function () {
    var api = this.api();
    $('#detailAllDoneTables_filter input')
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
    url: 'http://localhost/he-bengkel/vulkanisir/getAllDetailDone',
    type: 'POST',
    dataType: 'json',
  },
  columns: [
    {
      data: 'id_detail_vulk_selesai',
      className: 'text-center',
    },
    {
      data: 'kd_vulk',
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
      data: 'no_nota',
      render: function (data, type, row) {
        return data === ''
          ? '<span><i class="fas fa-minus fa-sm"></i></span>'
          : data.toUpperCase();
      },
    },
    {
      data: 'no_seri',
      render: function (data, type, row) {
        return data.toUpperCase() + ', ' + row.merk + ',' + row.ukuran;
      },
    },
    {
      data: 'ongkos',
      className: 'text-center',
      render: function (data, type, row) {
        return format(data);
      },
    },
    {
      data: 'tgl_selesai',
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
