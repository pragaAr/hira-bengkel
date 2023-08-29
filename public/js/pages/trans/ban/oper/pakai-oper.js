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

$('#allPakaiBanTables').DataTable({
  ordering: true,
  order: [[0, 'desc']],
  language: {
    searchPlaceholder: 'Search Kd Pakai',
  },
  pageLength: 10,
  initComplete: function () {
    var api = this.api();
    $('#allPakaiBanTables_filter input')
      .off('.DT')
      .on('input.DT', function () {
        api.search(this.value).draw();
      });
  },
  lengthChange: false,
  autoWidth: false,
  processing: true,
  serverSide: true,
  deferRender: true,
  ajax: {
    url: 'http://localhost/he-bengkel/oper_ban/getPakaiAll',
    type: 'POST',
    dataType: 'json',
  },
  columns: [
    {
      data: 'id_detail_pakai_ban',
      className: 'text-center',
      searchable: false,
    },
    {
      data: 'kd_pakai_ban',
      searchable: true,
      render: function (data, type, row) {
        return data.toUpperCase();
      },
    },
    {
      data: 'truck',
      searchable: false,
      render: function (data, type, row) {
        return data === null
          ? '<i class="fas fa-minus fa-sm"></i>'
          : data.toUpperCase();
      },
    },
    {
      data: 'no_seri',
      searchable: false,
      render: function (data, type, row) {
        if (data == null && row.nama_merk == null) {
          return '-';
        } else if (data == null) {
          return ', ' + row.nama_merk.toUpperCase();
        } else if (row.nama_merk == null) {
          return data.toUpperCase() + ', -';
        } else {
          return data.toUpperCase() + ', ' + row.nama_merk.toUpperCase();
        }
      },
    },
    {
      data: 'jml_pakai_ban',
      searchable: false,
      className: 'text-center',
      render: function (data, type, row) {
        return data.toUpperCase();
      },
    },
    {
      data: 'status_pakai_ban',
      searchable: false,
      render: function (data, type, row) {
        return data;
      },
    },
    {
      data: 'ket_pakai_ban',
      searchable: false,
      render: function (data, type, row) {
        if (data == '') {
          return '<i class="fas fa-minus"></i>';
        } else {
          return data.toUpperCase();
        }
      },
    },
    {
      data: 'tgl_pakai_ban',
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
      data: 'view',
      className: 'text-center',
      render: function (data, type, row) {
        if (row.jml_pakai_ban != 0) {
          return (
            '<a href="javascript:void(0);" class="btn btn-sm btn-danger text-white btn-oper-ban" data-id="' +
            row.id_detail_pakai_ban +
            '">Oper</a>'
          );
        } else {
          return '<button type="button" class="btn btn-sm btn-dark text-white" disabled>Oper</button>';
        }
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

$('#operBanModal').on('shown.bs.modal', function () {
  $('.selecttruck')
    .select2({
      placeholder: 'Pilih Truck',
      theme: 'bootstrap4',
      ajax: {
        url: 'http://localhost/he-bengkel/truck/getListTruck',
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
      $('#tujuan').val(data.text);
    });
});

$('#allPakaiBanTables').on('click', '.btn-oper-ban', function () {
  const id = $(this).data('id');

  $.ajax({
    url: 'http://localhost/he-bengkel/oper_ban/getDetailPakaiForOper',
    type: 'POST',
    data: {
      id: id,
    },
    success: function (data) {
      const parsedata = JSON.parse(data);

      $('#subtitle').html('Oper Ban dari ' + parsedata.truck.toUpperCase());

      $('#detailpakai_id').val(id);
      $('#kdpakai').val(parsedata.kd_pakai_ban);
      $('#jml').val(parsedata.jml_pakai_ban);
      $('#asalid').val(parsedata.id_truck);
      $('#asal').val(parsedata.truck);
      $('#noseri').val(parsedata.no_seri);
      $('#banid').val(parsedata.id_ban);
      $('#merk').val(parsedata.nama_merk);
      $('#merkid').val(parsedata.id_merk);
      $('#totpakai').val(parsedata.total_pakai_ban);

      $('#jmloper').attr({
        min: 1,
        max: parsedata.jml_pakai_ban,
      });

      $('#operBanModal').modal('show');

      $('[data-toggle="tooltip"]').tooltip('hide');
    },
  });
});

$('#jmloper').on('input', function () {
  if ($('#jmloper').val() > $('#jml').val()) {
    alert('Jumlah maksimal = ' + $('#jml').val());
    $('#jmloper').val('');
  }
});

$(document).on('select2:open', () => {
  document
    .querySelector('.select2-container--open .select2-search__field')
    .focus();
});
