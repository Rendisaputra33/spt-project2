const logout = document.getElementById('log');
const URL_ = document
  .querySelector('meta[name=baseurl]')
  .getAttribute('aria-valuemin');

log.onclick = function () {
  swalLogout(URL_ + '/auth/logout');
};

const swalLogout = param => {
  Swal.fire({
    title: 'Logout sekarang ?',
    text: 'Logout setelah konfirmasi !',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya',
    cancelButtonText: 'Batal',
  }).then(result => {
    result.isConfirmed ? (window.location.href = param) : '';
  });
};
