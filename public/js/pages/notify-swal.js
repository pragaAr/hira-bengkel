const flashData = $('.success').data('flashdata');

if (flashData) {
  Swal.fire({
    icon: 'success',
    title: 'Selamat,',
    text: flashData,
  });
}
