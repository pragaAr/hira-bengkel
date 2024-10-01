const flashLogin = $('.flashlogin').data('flashdata');
const flashrole = $('.flashrole').data('flashdata');

if (flashLogin) {
  Swal.fire({
    icon: 'success',
    title: 'Selamat Datang',
    text: flashLogin,
  });
}

if (flashrole) {
  Swal.fire({
    icon: 'error',
    title: 'Eheeemmmm !!',
    text: flashrole,
  });
}
