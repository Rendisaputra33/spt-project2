const URL = document
  .querySelector('meta[name=baseurl]')
  .getAttribute('aria-valuemin');
const URL_PETANI = URL + '/petani/';

const ELEMENT = {
  bodyTable: document.querySelector('#list'),
};

const INPUT = {
  action: document.getElementById('form-'),
  method: document.getElementById('method'),
  nama: document.querySelector('input[name=nama]'),
  kode: document.querySelector('input[name=register]'),
  pabrik: document.querySelector('select[name=pabrik]'),
  close: document.getElementById('close-modal'),
  seacrh: document.querySelector('#search'),
};

/**
 * @function definition & @processed handler here
 */

const bindingUpdate = () => {
  const btnUpdate = document.querySelectorAll('.update');
  for (let i = 0; i < btnUpdate.length; i++) {
    btnUpdate[i].onclick = async function () {
      await fetchUpdate(this);
    };
  }
};

const clearForm = () => {
  INPUT.action.setAttribute('action', URL_PETANI);
  INPUT.method.innerHTML = '';
  INPUT.nama.value = '';
  INPUT.kode.value = '';
  INPUT.pabrik.value = '';
};

const fetchUpdate = async THIS => {
  await fetch(`${URL_PETANI}json/${THIS.getAttribute('data-id')}`)
    .then(res => res.json())
    .then(result => setFormUpdate(result.data))
    .catch(error => console.log(error));
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

const setFormUpdate = result => {
  INPUT.action.setAttribute('action', URL_PETANI + result.id_petani);
  INPUT.method.innerHTML = '<input type="hidden" name="_method" value="PUT" />';
  INPUT.nama.value = result.nama_petani;
  INPUT.kode.value = result.reg;
  INPUT.pabrik.value = result.id_pabrik;
};

// function execution here

bindingUpdate();
listDelete();

INPUT.close.onclick = function () {
  clearForm();
};
