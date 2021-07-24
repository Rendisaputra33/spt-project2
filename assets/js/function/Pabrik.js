const URL = document
  .querySelector('meta[name=baseurl]')
  .getAttribute('aria-valuemin');
const URL_PABRIK = URL + '/pabrik';
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

const ELEMENT = {
  bodyTable: document.querySelector('#list'),
  title: document.querySelector('.modal-title'),
};

const C = {
  u: `type="button" class="btn btn-sm btn-warning btn-icon-text update" data-target="#modal-md-tambah" id='tbh' data-toggle="modal"`,
  iconU: `<i class="mdi mdi-lead-pencil btn-icon-prepend"></i>`,
  d: `class="btn btn-sm btn-danger btn-icon-text delete"`,
  iconD: `<i class="mdi mdi-delete btn-icon-prepend"></i>`,
};

// declaration input form
const INPUT = {
  close: document.querySelector('#tbh'),
  action: document.getElementById('form-'),
  method: document.getElementById('method'),
  nama: document.querySelector('input[name=nama]'),
  kode: document.querySelector('input[name=kode]'),
  seacrh: document.getElementById('search'),
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
  ELEMENT.title.innerHTML = 'Tambah Data Pabrik';
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
  ELEMENT.title.innerHTML = 'Edit Data Pabrik';
  INPUT.nama.value = result.nama_pabrik;
  INPUT.kode.value = result.kode_pabrik;
};

const uiSearch = (data, no) => {
  return /*html*/ `
    <tr>
      <td>${no}</td>
      <td>${data.nama_pabrik}</td>
      <td>${data.kode_pabrik}</td>
      <td>${formatTanggal(timeTodate(data.created_at))}</td>
      <td>
        <button ${C.u} data-id="${data.id_pabrik}">${C.iconU} Ubah </button>
        <a ${C.d} href="${URL_PABRIK}/${data.id_pabrik}">${C.iconD} Hapus </a>
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
  await fetch(`${URL_PABRIK}/json/search/${arg}`)
    .then(res => res.json())
    .then(result => setData(result.data))
    .catch(err => err);
};

/**
 * @function global execution here
 */

bindingUpdate();
listDelete();

INPUT.close.onclick = function () {
  clearForm();
};

INPUT.seacrh.addEventListener('keyup', async function () {
  const { value } = this;
  await fetchSearch(value);
});
