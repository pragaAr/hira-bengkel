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

$('#vulkBanTables').DataTable({
  ordering: true,
  order: [[0, 'desc']],
  pageLength: 20,
  initComplete: function () {
    var api = this.api();
    $('#vulkBanTables_filter input')
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
    url: 'http://localhost/he-bengkel/vulkanisir/getVulkanisir',
    type: 'POST',
    dataType: 'json',
  },
  columns: [
    {
      data: 'id_vulk',
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
      data: 'jml_total_vulk',
      className: 'text-center',
      render: function (data, type, row) {
        return data;
      },
    },
    {
      data: 'tgl_vulk',
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

$('#cetakDo').on('shown.bs.modal', function () {
  $('.selectnota')
    .select2({
      placeholder: 'Pilih Nota',
      theme: 'bootstrap4',
      ajax: {
        url: 'http://localhost/he-bengkel/vulkanisir/getNota',
        dataType: 'JSON',
        delay: 250,
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
        cache: true,
      },
    })
    .on('select2:select', function (e) {
      const data = e.params.data;
      console.log(data);
      $('#nota').val(data.text);
    });
});

$(document).on('select2:open', () => {
  document
    .querySelector('.select2-container--open .select2-search__field')
    .focus();
});
