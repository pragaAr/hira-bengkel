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

$('#allPercabTables').DataTable({
  ordering: true,
  order: [[0, 'desc']],
  language: {
    searchPlaceholder: 'Search..',
  },
  pageLength: 10,
  initComplete: function () {
    var api = this.api();
    $('#allPercabTables_filter input')
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
    url: 'http://localhost/he-bengkel/percab/getDetailAll',
    type: 'POST',
    dataType: 'json',
  },
  columns: [
    {
      data: 'id_detailpercab',
      className: 'text-center align-middle',
    },
    {
      data: 'nosurat',
      searchable: true,
      className: 'text-center align-middle',
      render: function (data, type, row) {
        return data === null || data === ""
          ? '<i class="fas fa-minus fa-sm"></i>'
          : data.toUpperCase();
      },
    },
    {
      data: 'cabang',
      searchable: true,
      className: 'text-center align-middle',
      render: function (data, type, row) {
        return data === null || data === ""
          ? '<i class="fas fa-minus fa-sm"></i>'
          : data.toUpperCase();
      },
    },
    {
      data: 'bengkel',
      searchable: true,
      className: 'text-center align-middle',
      render: function (data, type, row) {
        return data === null || data === ""
          ? '<i class="fas fa-minus fa-sm"></i>'
          : data.toUpperCase();
      },
    },
    {
      data: 'tglnota',
      className: 'text-center align-middle',
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
      data: 'part',
      searchable: true,
      className: 'text-center align-middle',
      render: function (data, type, row) {
        return data === null || data === ""
        ? '<i class="fas fa-minus fa-sm"></i>'
        : data.toUpperCase();
      },
    },
    {
      data: 'plat_no_truck',
      className: 'text-center align-middle',
      render: function (data, type, row) {
        return data === null || data === ""
        ? '<i class="fas fa-minus fa-sm"></i>'
        : data.toUpperCase();
      },
    },
    {
      data: 'sopir',
      className: 'text-center align-middle',
      render: function (data, type, row) {
        return data === null || data === ""
        ? '<i class="fas fa-minus fa-sm"></i>'
        : data.toUpperCase();
      },
    },
    {
      data: 'ongkos',
      className: 'text-center align-middle',
      render: function (data, type, row) {
        var value = parseFloat(data);
        return (
          'Rp. ' + value.toLocaleString('id-ID', { minimumFractionDigits: 0 })
        );
      },
    },
    {
      data: 'ketpercab',
      className: 'text-center align-middle',
      render: function (data, type, row) {
        return data === null || data === ""
        ? '<i class="fas fa-minus fa-sm"></i>'
        : data.toUpperCase();
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
