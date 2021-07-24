const URL = document
  .querySelector('meta[name=baseurl]')
  .getAttribute('aria-valuemin');
const URL_ROOT = URL + '/user';

const listMonth = [
  'Januari',
  'Februari',
  'Maret',
  'April',
  'Mei',
  'Juni',
  'Juli',
  'Agustus',
  'September',
  'November',
  'Desember',
];

const C = {
  u: `type="button" class="btn btn-sm btn-warning btn-icon-text update" data-target="#modal-md-tambah" id='tbh' data-toggle="modal"`,
  iconU: `<i class="mdi mdi-lead-pencil btn-icon-prepend"></i>`,
  d: `class="btn btn-sm btn-danger btn-icon-text delete"`,
  iconD: `<i class="mdi mdi-delete btn-icon-prepend"></i>`,
};

// declaration element
const ELEMENT = {
  bodyTable: document.querySelector('#list'),
  title: document.querySelector('.modal-title'),
};

// declaration input form
const FORM = {
  close: document.getElementById('tbh'),
  action: document.getElementById('form-'),
  method: document.getElementById('method'),
  nama: document.querySelector('input[name=nama]'),
  password: document.querySelector('input[name=password]'),
  username: document.querySelector('input[name=username]'),
  level: document.querySelector('select[name=level]'),
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
// clearing form
const clearForm = () => {
  FORM.action.setAttribute('action', URL + '/auth/register');
  ELEMENT.title.innerHTML = 'Tambah Data User';
  FORM.username.readOnly = false;
  FORM.method.innerHTML = '';
  FORM.nama.value = '';
  FORM.username.value = '';
  FORM.password.value = '';
  FORM.level.value = '';
};
// request data update to backend
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
// setter form update
const setFormUpdate = result => {
  FORM.action.setAttribute('action', URL_ROOT + '/' + result.id_user);
  FORM.method.innerHTML = '<input type="hidden" name="_method" value="PUT" />';
  ELEMENT.title.innerHTML = 'Edit Data User';
  FORM.username.readOnly = true;
  FORM.nama.value = result.nama;
  FORM.username.value = result.username;
  FORM.password.value = result.password;
  FORM.level.value = result.level;
};
// generate ui search
const uiSearch = (data, no) => {
  return /*html*/ `
    <tr>
      <td>${no}</td>
      <td>${data.nama}</td>
      <td>${data.username}</td>
      <td>${data.level === 1 ? 'Admin' : 'Super Admin'}</td>
      <td>${formatTanggal(timeTodate(data.created_at))}</td>
      <td>
        <button ${C.u} data-id="${data.id_petani}">${C.iconU} Ubah </button>
        <a ${C.d} href="${URL_ROOT}/${data.id_petani}">${C.iconD} Hapus </a>
      </td>
    </tr>
  `;
};
// parsing data timestamp to date localsting
const timeTodate = tgl => {
  const date = new Date(tgl);
  return date.toLocaleDateString();
};
// generate format tanggal indonesia
const formatTanggal = tgl => {
  const month = tgl.split('/');
  return `${month[1]}/${listMonth[parseInt(month[0]) - 1]}/${month[2]}`;
};
// set data resultset fetch search
const setData = result => {
  let html = '';
  let no = 1;
  result.map(data => (html += uiSearch(data, no++)));
  ELEMENT.bodyTable.innerHTML = html;
  bindingUpdate();
};

const fetchSearch = async arg => {
  await fetch(`${URL_ROOT}/json/search/${arg}`)
    .then(res => res.json())
    .then(result => setData(result.data))
    .catch(err => err);
};

// global function execution here

bindingUpdate();
listDelete();

FORM.close.onclick = function () {
  clearForm();
};

FORM.seacrh.addEventListener('keyup', async function () {
  const { value } = this;
  await fetchSearch(value);
});
