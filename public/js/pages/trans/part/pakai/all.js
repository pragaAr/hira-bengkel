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

$('#allPakaiPartTables').DataTable({
  ordering: true,
  order: [[0, 'desc']],
  language: {
    searchPlaceholder: 'Search Kd/Part/Truck',
  },
  pageLength: 10,
  initComplete: function () {
    var api = this.api();
    $('#allPakaiPartTables_filter input')
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
    url: 'http://localhost/he-bengkel/pakai/getDetailAll',
    type: 'POST',
    dataType: 'json',
  },
  columns: [
    {
      data: 'id_detail_pakai',
      className: 'text-center',
      searchable: false,
    },
    {
      data: 'kd_pakai',
      searchable: true,
      render: function (data, type, row) {
        return data.toUpperCase();
      },
    },
    {
      data: 'truck',
      searchable: true,
      render: function (data, type, row) {
        return data.toUpperCase();
      },
    },
    {
      data: 'jenis_part',
      searchable: true,
      render: function (data, type, row) {
        if (data == null && row.nama_merk == null) {
          return '-';
        } else if (row.nama_merk == null) {
          return data.toUpperCase() + ', -';
        } else if (data == null) {
          return ', ' + row.nama_merk.toUpperCase();
        } else {
          return data.toUpperCase() + ', ' + row.nama_merk.toUpperCase();
        }
      },
    },
    {
      data: 'jml_pakai',
      searchable: false,
      className: 'text-center',
      render: function (data, type, row) {
        return data.toUpperCase() + ' ' + row.sat;
      },
    },
    {
      data: 'status_pakai',
      searchable: false,
      render: function (data, type, row) {
        return data;
      },
    },
    {
      data: 'ket_pakai',
      searchable: false,
      render: function (data, type, row) {
        if (data == '') {
          return '<i class="fas fa-minus fa-sm"></i>';
        } else {
          return data.toUpperCase();
        }
      },
    },
    {
      data: 'tgl_pakai',
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
});

$(document).on('select2:open', () => {
  document
    .querySelector('.select2-container--open .select2-search__field')
    .focus();
});
