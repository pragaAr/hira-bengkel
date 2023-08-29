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

$('#repairTables').DataTable({
  ordering: true,
  order: [[0, 'desc']],
  pageLength: 10,
  initComplete: function () {
    var api = this.api();
    $('#repairTables_filter input')
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
    url: 'http://localhost/he-bengkel/repair/getRepair',
    type: 'POST',
    dataType: 'json',
  },
  columns: [
    {
      data: 'id_repair',
      searchable: false,
      className: 'text-center',
    },
    {
      data: 'kd_repair',
      searchable: true,
      render: function (data, type, row) {
        return data.toUpperCase();
      },
    },
    {
      data: 'nama_toko',
      searchable: true,
      render: function (data, type, row) {
        return data.toUpperCase();
      },
    },
    {
      data: 'total_repair',
      searchable: false,
      className: 'text-center',
      render: function (data, type, row) {
        return data;
      },
    },
    {
      data: 'tgl_repair',
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

$('#repairTables').on('click', '.btn-retur-part', function () {
  const id = $(this).data('id');

  $.ajax({
    url: 'http://localhost/he-bengkel/beli/getDetailAllById',
    type: 'POST',
    data: {
      id: id,
    },
    success: function (data) {
      const parsedata = JSON.parse(data);

      console.log(parsedata);

      $('#id').val(parsedata.id_detail_beli);
      $('#kd').val(parsedata.kd_beli);
      $('#toko').val(parsedata.nama_toko);
      $('#tokoid').val(parsedata.toko_id);
      $('#part').val(
        parsedata.jenis_part +
          ', ' +
          parsedata.nama_merk +
          ', ' +
          parsedata.status_part_beli
      );
      $('#partid').val(parsedata.part_id);
      $('#merkid').val(parsedata.id_merk);
      $('#statretur').val(parsedata.status_part_beli);
      $('#jmlbeli').val(parsedata.jml_beli);
      $('#jmlbeli').attr({
        min: 1,
        max: parsedata.jml_beli,
      });
      $('#sat').val(parsedata.sat);
      $('#hrgpcs').val(format(parsedata.harga_pcs));
      $('#diskon').val(parsedata.diskon);
      $('#subtotal').val(format(parsedata.sub_total));
    },
  });

  $('#returpart').modal('show');
});

$(document).on('select2:open', () => {
  document
    .querySelector('.select2-container--open .select2-search__field')
    .focus();
});
