const logout = document.getElementById('log');

log.onclick = function () {
  swalLogout(URL + '/auth/logout');
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
