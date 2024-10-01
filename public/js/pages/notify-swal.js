const flashData = $('.success').data('flashdata');

if (flashData) {
  Swal.fire({
    icon: 'success',
    title: 'Selamat,',
    text: flashData,
  });
}

const kembaligudang = $('.kembaligudang').data('flashdata');

if (kembaligudang) {
  Swal.fire({
    icon: 'success',
    title: 'Selamat,',
    text: kembaligudang,
  });
}
