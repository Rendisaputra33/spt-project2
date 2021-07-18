const URL = document
  .querySelector('meta[name=baseurl]')
  .getAttribute('aria-valuemin');
const URL_ROOT = URL + '/user';

// declaration input form
const FORM = {
  close: document.getElementById('tbh'),
  action: document.getElementById('form-'),
  method: document.getElementById('method'),
  nama: document.querySelector('input[name=nama]'),
  password: document.querySelector('input[name=password]'),
  username: document.querySelector('input[name=username]'),
  level: document.querySelector('select[name=level]'),
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
  FORM.action.setAttribute('action', URL_ROOT);
  FORM.method.innerHTML = '';
  FORM.nama.value = '';
  FORM.username.value = '';
  FORM.password.value = '';
  FORM.level.value = '';
};

const fetchUpdate = async THIS => {
  await fetch(`${URL_ROOT}/json/${THIS.getAttribute('data-id')}`)
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
  FORM.action.setAttribute('action', URL_ROOT + '/' + result.id_user);
  FORM.method.innerHTML = '<input type="hidden" name="_method" value="PUT" />';
  FORM.nama.value = result.nama;
  FORM.username.value = result.username;
  FORM.password.value = result.password;
  FORM.level.value = result.level;
};

// global function execution here

bindingUpdate();
listDelete();

FORM.close.onclick = function () {
  clearForm();
};
