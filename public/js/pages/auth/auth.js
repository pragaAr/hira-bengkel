const wrongpassoruser = $('.wrongpassoruser').data('flashdata');
const flashceklogin = $('.flashceklogin').data('flashdata');
const flashLogout = $('.flashlogout').data('flashdata');
const flashReg = $('.flashreg').data('flashdata');

if (wrongpassoruser) {
  Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: wrongpassoruser,
  });
}

if (flashceklogin) {
  Swal.fire({
    icon: 'info',
    title: 'Anda siapa ?',
    text: flashceklogin,
  });
}

if (flashLogout) {
  Swal.fire({
    icon: 'success',
    title: 'Anda Telah Keluar',
    text: flashLogout,
  });
}

if (flashReg) {
  Swal.fire({
    icon: 'success',
    title: 'Registrasi berhasil !',
    text: flashReg,
  });
}
