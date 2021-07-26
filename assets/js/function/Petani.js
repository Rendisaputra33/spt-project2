const URL = document
  .querySelector('meta[name=baseurl]')
  .getAttribute('aria-valuemin');
const URL_PETANI = URL + '/petani';

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

const ELEMENT = {
  bodyTable: document.querySelector('#list'),
  title: document.querySelector('.modal-title'),
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
  ELEMENT.title.innerHTML = 'Tambah Data Petani';
  INPUT.method.innerHTML = '';
  INPUT.nama.value = '';
  INPUT.kode.value = '';
  INPUT.pabrik.value = '';
};

const fetchUpdate = async THIS => {
  await fetch(`${URL_PETANI}/json/${THIS.getAttribute('data-id')}`)
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
  INPUT.action.setAttribute('action', URL_PETANI + '/' + result.id_petani);
  INPUT.method.innerHTML = '<input type="hidden" name="_method" value="PUT" />';
  INPUT.nama.value = result.nama_petani;
  INPUT.kode.value = result.reg;
  INPUT.pabrik.value = result.id_pabrik;
};

const uiSearch = (data, no) => {
  return /*html*/ `
    <tr>
      <td>${no}</td>
      <td>${data.reg}</td>
      <td>${data.nama_petani}</td>
      <td>${data.nama_pabrik}</td>
      <td>${formatTanggal(timeTodate(data.created_at))}</td>
      <td>
        <button ${C.u} data-id="${data.id_petani}">${C.iconU} Ubah </button>
        <a ${C.d} href="${URL_PETANI}/${data.id_petani}">${C.iconD} Hapus </a>
      </td>
    </tr>
  `;
};

const timeTodate = tgl => {
  const date = new Date(tgl);
  return date.toLocaleDateString();
};

const formatTanggal = tgl => {
  const month = tgl.split('/');
  return `${month[1]}/${listMonth[parseInt(month[0]) - 1]}/${month[2]}`;
};

const setData = result => {
  let html = '';
  let no = 1;
  result.map(data => (html += uiSearch(data, no++)));
  ELEMENT.bodyTable.innerHTML = html;
  bindingUpdate();
};

const fetchSearch = async arg => {
  await fetch(`${URL_PETANI}/json/search/${arg}`)
    .then(res => res.json())
    .then(result => setData(result.data))
    .catch(err => err);
};

// function execution here

bindingUpdate();
listDelete();

INPUT.close.onclick = function () {
  clearForm();
};

INPUT.seacrh.addEventListener('keyup', async function () {
  const { value } = this;
  await fetchSearch(value);
});
