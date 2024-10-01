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

$('#belibanTables').DataTable({
  ordering: true,
  order: [[0, 'desc']],
  language: {
    searchPlaceholder: 'Search DO',
  },
  pageLength: 10,
  initComplete: function () {
    var api = this.api();
    $('#belibanTables_filter input')
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
    url: 'http://localhost/he-bengkel/beli_ban/getBeli',
    type: 'POST',
    dataType: 'json',
  },
  columns: [
    {
      data: 'id_beli_ban',
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
      data: 'no_nota_ban',
      searchable: false,
      render: function (data, type, row) {
        if (data === '') {
          return '<i class="fas fa-minus fa-sm"></i>';
        } else {
          return data.toUpperCase();
        }
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
      data: 'total_beli_ban',
      searchable: false,
      render: function (data, type, row) {
        return data;
      },
    },
    {
      data: 'total_harga_ban',
      searchable: false,
      render: function (data, type, row) {
        var value = parseFloat(data);
        return (
          'Rp. ' + value.toLocaleString('id-ID', { minimumFractionDigits: 0 })
        );
      },
    },
    {
      data: 'status_bayar_ban',
      searchable: false,
      className: 'text-center',
      render: function (data, type, row) {
        if (data == 'Lunas') {
          return '<button type="button" class="btn btn-info btn-sm" style="cursor:default;" data-toggle="tooltip" title="Lunas"> <i class="fas fa-check-circle fa-sm"></button>';
        } else {
          return (
            '<a href="javascript:void(0);" class="btn btn-warning btn-sm btn-pelunasan" data-toggle="tooltip" title="Pelunasan" data-kd="' +
            row.kd_beli_ban +
            '"><i class="fas fa-money-bill fa-sm"></i></a>'
          );
        }
      },
    },
    {
      data: 'retur',
      searchable: false,
      className: 'text-center',
      render: function (data, type, row) {
        if (data == 1) {
          return '<a href="http://localhost/he-bengkel/retur_ban" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Ada Retur"><i class="fas fa-exclamation-circle fa-sm"></i></a>';
        } else {
          return '<button type="button" class="btn btn-secondary text-light btn-sm" data-toggle="tooltip" title="Tidak ada Retur" style="cursor:default;"><i class="fas fa-minus-circle fa-sm"></i></button>';
        }
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

$('#belibanTables').on('click', '.btn-delete', function () {
  const kd = $(this).data('kd');

  Swal.fire({
    title: 'Apakah anda yakin ?',
    text: 'Data akan di hapus !!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Batal',
    confirmButtonText: 'Ya, Hapus !',
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: 'http://localhost/he-bengkel/beli_ban/delete',
        method: 'POST',
        data: { kd: kd },
        success: function (data) {
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Data Ban Masuk berhasil dihapus!',
          });
          $('#belibanTables').DataTable().ajax.reload(null, false);
        },
      });
    }
  });
});

$('#belibanTables').on('click', '.btn-pelunasan', function () {
  const kd = $(this).data('kd');

  Swal.fire({
    title: 'Apakah anda yakin ?',
    text: 'Data akan dilunasi !!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Batal',
    confirmButtonText: 'Ya, Lunasi !',
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: 'http://localhost/he-bengkel/beli_ban/pelunasan',
        method: 'POST',
        data: { kd: kd },
        success: function (data) {
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Data Ban Masuk berhasil dilunasi!',
          });
          $('#belibanTables').DataTable().ajax.reload(null, false);
        },
      });
    }
  });
});
