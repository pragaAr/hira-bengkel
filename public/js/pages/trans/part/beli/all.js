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

$('#allBeliPartTables').DataTable({
  ordering: true,
  order: [[0, 'desc']],
  language: {
    searchPlaceholder: 'Search DO',
  },
  pageLength: 10,
  initComplete: function () {
    var api = this.api();
    $('#allBeliPartTables_filter input')
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
    url: 'http://localhost/he-bengkel/beli/getDetailAll',
    type: 'POST',
    dataType: 'json',
  },
  columns: [
    {
      data: 'id_detail_beli',
      className: 'text-center',
      searchable: false,
    },
    {
      data: 'kd_beli',
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
      data: 'jenis_part',
      searchable: true,
      render: function (data, type, row) {
        if (data === null && row.nama_merk === null) {
          return '<i class="fas fa-minus fa-sm"></i>, <i class="fas fa-minus fa-sm"></i>';
        } else if (data === null) {
          return (
            '<i class="fas fa-minus fa-sm"></i>,' + row.nama_merk.toUpperCase()
          );
        } else if (row.nama_merk === null) {
          return data.toUpperCase() + ', <i class="fas fa-minus fa-sm"></i>';
        } else {
          return data.toUpperCase() + ', ' + row.nama_merk.toUpperCase();
        }
      },
    },
    {
      data: 'jml_beli',
      searchable: false,
      className: 'text-center',
      render: function (data, type, row) {
        return data;
      },
    },
    {
      data: 'harga_pcs',
      searchable: false,
      render: function (data, type, row) {
        var value = parseFloat(data);
        return (
          'Rp. ' + value.toLocaleString('id-ID', { minimumFractionDigits: 0 })
        );
      },
    },
    {
      data: 'sub_total',
      searchable: false,
      render: function (data, type, row) {
        var value = parseFloat(data);
        return (
          'Rp. ' + value.toLocaleString('id-ID', { minimumFractionDigits: 0 })
        );
      },
    },
    {
      data: 'tgl_beli',
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
      data: 'ket_beli',
      searchable: false,
      className: 'text-center',
      render: function (data, type, row) {
        if (data == '') {
          return '<i class="fas fa-minus fa-sm"></i>';
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

$('#allBeliPartTables').on('click', '.btn-retur-part', function () {
  const id = $(this).data('id');

  $.ajax({
    url: 'http://localhost/he-bengkel/beli/getDetailAllById',
    type: 'POST',
    data: {
      id: id,
    },
    success: function (data) {
      const parsedata = JSON.parse(data);

      $('#id').val(parsedata.id_detail_beli);
      $('#kd').val(parsedata.kd_beli);
      $('#toko').val(parsedata.nama_toko);
      $('#tokoid').val(parsedata.id_toko);
      $('#part').val(
        parsedata.jenis_part +
          ', ' +
          parsedata.nama_merk +
          ', ' +
          parsedata.status_part_beli
      );
      $('#partid').val(parsedata.part_id);
      $('#merkid').val(parsedata.merk_id);
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

$('#returpart').on('shown.bs.modal', function () {
  $('input[name="jmlbeli"]').focus();
});


$('#form_returPart').on('submit', function () {
  const id = $('#id').val();
  const kd = $('#kd').val();
  const toko = $('#toko').val();
  const tokoid = $('#tokoid').val();
  const partid = $('#partid').val();
  const merkid = $('#merkid').val();
  const stat = $('#statretur').val();
  const jmlretur = $('#jmlbeli').val();
  const sat = $('#sat').val();
  const hrgpcs = $('#hrgpcs').val();
  const diskon = $('#diskon').val();
  const ket = $('#ket').val();

  $.ajax({
    url: 'http://localhost/he-bengkel/beli/retur',
    type: 'POST',
    data: {
      id: id,
      kd: kd,
      toko: toko,
      tokoid: tokoid,
      partid: partid,
      merkid: merkid,
      stat: stat,
      jmlretur: jmlretur,
      sat: sat,
      hrgpcs: hrgpcs,
      diskon: diskon,
      ket: ket,
    },
    success: function (data) {
      $('#id').val('');
      $('#kd').val('');
      $('#toko').val('');
      $('#tokoid').val('');
      $('#partid').val('');
      $('#merkid').val('');
      $('#statretur').val('');
      $('#jmlbeli').val('');
      $('#sat').val('');
      $('#hrgpcs').val('');
      $('#diskon').val('');
      $('#subtotal').val('');
      $('#ket').val('');

      $('#returpart').modal('hide');

      Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: 'Stok Berhasil diretur !',
      });
      $('#allBeliPartTables').DataTable().ajax.reload(null, false);
    },
  });

  return false;
});

$('#printall').on('shown.bs.modal', function () {
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
    });
});

$(document).on('select2:open', () => {
  document
    .querySelector('.select2-container--open .select2-search__field')
    .focus();
});
