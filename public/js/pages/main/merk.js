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

$('#merkTables').DataTable({
  ordering: false,
  initComplete: function () {
    var api = this.api();
    $('#merkTables_filter input')
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
    url: 'http://localhost/he-bengkel/merk/getMerk',
    type: 'POST',
    dataType: 'json',
  },
  columns: [
    {
      data: 'id_merk',
      className: 'text-center',
    },
    {
      data: 'nama_merk',
      className: 'text-center',
      render: function (data, type, row) {
        return data.toUpperCase();
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

$('#btn-add-merk').on('click', function () {
  $('#addMerk').modal('show');
});

$('#addMerk').on('shown.bs.modal', function () {
  $('input[name="merk"]').focus();
});

$('#form_addMerk').on('submit', function () {
  const merk = $('#merk').val();

  $.ajax({
    url: 'http://localhost/he-bengkel/merk/create',
    type: 'POST',
    data: {
      merk: merk,
    },
    success: function (data) {
      $('#merk').val('');
      $('#addMerk').modal('hide');

      Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: 'Data Merk berhasil ditambah!',
      });
      $('#merkTables').DataTable().ajax.reload(null, false);
    },
  });
  return false;
});

$('#editMerk').on('shown.bs.modal', function () {
  $('input[name="merkedit"]').focus();
});

$('#merkTables').on('click', '.btn-edit-merk', function (e) {
  const id = $(this).data('id');

  $.ajax({
    url: 'http://localhost/he-bengkel/merk/getId',
    type: 'POST',
    data: {
      idmerk: id,
    },
    success: function (data) {
      const parsedata = JSON.parse(data);

      $('#idmerk').val(parsedata.id_merk);
      $('#merkedit').val(parsedata.nama_merk);

      $('#editMerk').modal('show');
      $('[data-toggle="tooltip"]').tooltip('hide');
    },
  });
});

$('#form_editMerk').on('submit', function () {
  const id = $('#idmerk').val();
  const merk = $('#merkedit').val();

  $.ajax({
    type: 'POST',
    url: 'http://localhost/he-bengkel/merk/update',
    data: {
      id: id,
      merk: merk,
    },
    success: function (data) {
      $('#idmerk').val('');
      $('#merkedit').val('');
      $('#editMerk').modal('hide');

      Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: 'Data Merk berhasil diubah!',
      });
      $('#merkTables').DataTable().ajax.reload(null, false);
    },
  });
  return false;
});

$('#merkTables').on('click', '.btn-delete-merk', function () {
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
        url: 'http://localhost/he-bengkel/merk/delete',
        method: 'POST',
        data: { idmerk: id },
        success: function (data) {
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Data Merk berhasil dihapus!',
          });
          $('#merkTables').DataTable().ajax.reload(null, false);
        },
      });
    }
  });
});

$(document).on('select2:open', () => {
  document
    .querySelector('.select2-container--open .select2-search__field')
    .focus();
});
