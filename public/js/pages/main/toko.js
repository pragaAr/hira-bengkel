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

$('#tokoTables').DataTable({
  ordering: false,
  initComplete: function () {
    var api = this.api();
    $('#tokoTables_filter input')
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
    url: 'http://localhost/he-bengkel/toko/getToko',
    type: 'POST',
    dataType: 'json',
  },
  columns: [
    {
      data: 'id_toko',
      className: 'text-center',
    },
    {
      data: 'nama_toko',
      render: function (data, type, row) {
        return data.toUpperCase();
      },
    },
    {
      data: 'no_telp_toko',
      render: function (data, type, row) {
        if (data === '') {
          return '<i class="fas fa-minus fa-sm"></i>';
        } else {
          return data;
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

$('#btn-add-toko').on('click', function () {
  $('#addToko').modal('show');
});

$('#addToko').on('shown.bs.modal', function () {
  $('input[name="nama"]').focus();
});

$('#form_addToko').on('submit', function () {
  const nama = $('#nama').val();
  const telp = $('#telp').val();

  $.ajax({
    url: 'http://localhost/he-bengkel/toko/create',
    type: 'POST',
    data: {
      nama: nama,
      telp: telp,
    },
    success: function (data) {
      $('#nama').val('');
      $('#telp').val('');
      $('#addToko').modal('hide');

      Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: 'Data Toko berhasil ditambah!',
      });
      $('#tokoTables').DataTable().ajax.reload(null, false);
    },
  });
  return false;
});

$('#editToko').on('shown.bs.modal', function () {
  $('input[name="namaedit"]').focus();
});

$('#tokoTables').on('click', '.btn-edit-toko', function (e) {
  const id = $(this).data('id');

  $.ajax({
    url: 'http://localhost/he-bengkel/toko/getId',
    type: 'POST',
    data: {
      idtoko: id,
    },
    success: function (data) {
      const parsedata = JSON.parse(data);

      $('#idtoko').val(parsedata.id_toko);
      $('#namaedit').val(parsedata.nama_toko);
      $('#telpedit').val(parsedata.no_telp_toko);

      $('#editToko').modal('show');
      $('[data-toggle="tooltip"]').tooltip('hide');
    },
  });
});

$('#form_editToko').on('submit', function () {
  const id = $('#idtoko').val();
  const nama = $('#namaedit').val();
  const telp = $('#telpedit').val();

  $.ajax({
    type: 'POST',
    url: 'http://localhost/he-bengkel/toko/update',
    data: {
      id: id,
      nama: nama,
      telp: telp,
    },
    success: function (data) {
      $('#idtoko').val('');
      $('#namaedit').val('');
      $('#telpedit').val('');
      $('#editToko').modal('hide');

      Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: 'Data Toko berhasil diubah!',
      });
      $('#tokoTables').DataTable().ajax.reload(null, false);
    },
  });
  return false;
});

$('#tokoTables').on('click', '.btn-delete-toko', function () {
  const id = $(this).data('id');
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
        url: 'http://localhost/he-bengkel/toko/delete',
        method: 'POST',
        data: { idtoko: id },
        success: function (data) {
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Data Toko berhasil dihapus!',
          });
          $('#tokoTables').DataTable().ajax.reload(null, false);
        },
      });
    }
  });
});
