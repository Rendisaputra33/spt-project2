const URL = document
  .querySelector('meta[name=baseurl]')
  .getAttribute('aria-valuemin');
const URL_PABRIK = URL + '/pabrik';

// declaration input form
const INPUT = {
  close: document.querySelector('.add'),
  action: document.getElementById('form-'),
  method: document.getElementById('method'),
  nama: document.querySelector('input[name=nama]'),
  kode: document.querySelector('input[name=kode]'),
};

/**
 * @function definition & @processed handler here
 */

// funtion binding update interacted update button
const bindingUpdate = () => {
  const btnUpdate = document.querySelectorAll('.update');
  for (let i = 0; i < btnUpdate.length; i++) {
    btnUpdate[i].onclick = async function () {
      await fetchUpdate(this);
    };
  }
};
// funtion binding update interacted delete button
const listDelete = () => {
  const del = document.querySelectorAll('.delete');
  for (let i = 0; i < del.length; i++) {
    del[i].onclick = function (e) {
      e.preventDefault();
      swalDelete(this.getAttribute('href'));
    };
  }
};
// swal definition
const swalDelete = param => {
  Swal.fire({
    title: 'Yakin ingin Menghapus?',
    text: 'Data akan di hapus secara permanent!',
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
// function clear form after update data
const clearForm = () => {
  INPUT.action.setAttribute('action', URL_PABRIK);
  INPUT.method.innerHTML = '';
  INPUT.nama.value = '';
  INPUT.kode.value = '';
};

const fetchUpdate = async THIS => {
  await fetch(`${URL_PABRIK}/json/${THIS.getAttribute('data-id')}`)
    .then(res => res.json())
    .then(result => setFormUpdate(result.data))
    .catch(error => console.log(error));
};

const setFormUpdate = result => {
  INPUT.action.setAttribute('action', URL_PABRIK + '/' + result.id_pabrik);
  INPUT.method.innerHTML = '<input type="hidden" name="_method" value="PUT" />';
  INPUT.nama.value = result.nama_pabrik;
  INPUT.kode.value = result.kode_pabrik;
};

/**
 * @function execution here
 */

bindingUpdate();
listDelete();

INPUT.close.onclick = function () {
  clearForm();
};
