/**
 * @variable global here
 */

const URL = document
  .querySelector('meta[name=baseurl]')
  .getAttribute('aria-valuemin');

const URL_ROOT = URL + '/entry';

const periode = [
  '001',
  '002',
  '003',
  '004',
  '005',
  '006',
  '007',
  '008',
  '009',
  '010',
  '011',
  '012',
  '013',
  '014',
  '015',
  '016',
  '017',
  '018',
  '019',
  '020',
  '021',
  '022',
  '023',
  '024',
  '025',
  '026',
  '027',
  '028',
  '029',
  '030',
];

const INPUT = {
  close: document.querySelector('.add'),
  action: document.querySelector('#form-'),
  method: document.querySelector('#method'),
  periode: document.querySelector('select[name=periode]'),
  masa: document.querySelector('input[name=masa]'),
  reg: document.querySelector('select[name=reg]'),
  nospta: document.querySelector('input[name=nospta]'),
  variasi: document.querySelector('select[name=variasi]'),
  type: document.querySelector('select[name=type]'),
  nopol: document.querySelector('input[name=nopol]'),
  keterangan: document.querySelector('input[name=keterangan]'),
  hpp: document.querySelector('input[name=hpp]'),
  harga: document.querySelector('input[name=harga_beli]'),
  bobot: document.querySelector('input[name=bobot]'),
  sisa: document.querySelector('input[name=sisa]'),
  pabrik: document.querySelector('select[name=pabrik]'),
};

/**
 * @state definition here
 */

const state = {
  sisa: 0,
};

/**
 * @function definition here
 */

const bindingUpdate = () => {
  const up = document.querySelectorAll('.update');
  for (let i = 0; i < up.length; i++) {
    up[i].onclick = async function () {
      await fetchUpdate(this);
    };
  }
};

const setFormUpdate = result => {
  INPUT.periode.setAttribute('data-change', 'update');
  INPUT.action.setAttribute('action', URL_ROOT + '/' + result.id_entry);
  INPUT.method.innerHTML = '<input type="hidden" name="_method" value="PUT" />';
  INPUT.periode.value = result.periode;
  INPUT.masa.value = result.masa_giling;
  INPUT.reg.value = result.reg;
  INPUT.nospta.value = result.nospta;
  INPUT.nopol.value = result.nopol;
  INPUT.variasi.value = result.variasi;
  INPUT.type.value = result.type;
  INPUT.keterangan.value = result.keterangan;
  INPUT.harga.value = formatRupiah(result.harga_beli.toString(), 'Rp. ');
  INPUT.hpp.value = formatRupiah(result.hpp.toString(), 'Rp. ');
  INPUT.bobot.value = result.bobot;
  INPUT.sisa.value = formatRupiah(result.sisa.toString(), 'Rp. ');
  INPUT.pabrik.value = result.id_pabrik;
};

const clearForm = () => {
  INPUT.action.setAttribute('action', URL_ROOT);
  INPUT.periode.setAttribute('data-change', 'add');
  INPUT.periode.value = window.localStorage.getItem('periode');
  INPUT.masa.value = new Date().getFullYear();
  INPUT.reg.value = '';
  INPUT.nospta.value = '';
  INPUT.nopol.value = '';
  INPUT.variasi.value = '';
  INPUT.type.value = '';
  INPUT.keterangan.value = '';
  INPUT.harga.value = '';
  INPUT.hpp.value = '';
  INPUT.bobot.value = '';
};

const fetchUpdate = async THIS => {
  await fetch(`${URL_ROOT}/json/${THIS.getAttribute('data-id')}`)
    .then(res => res.json())
    .then(result => setFormUpdate(result.data))
    .catch(error => console.log(error));
};

const generateTahun = () => {
  let start = new Date('2021');
  return {
    start: start.getFullYear(),
    end: new Date(start.getTime() + 31622400000 * 20).getFullYear(),
  };
};

const setTahun = async d => {
  let peri = '<option value="">Pilih</option>';
  for (let i = d.start; i <= d.end; i++) {
    peri += /*html*/ `<option value="${i}">${i}</option>`;
  }
  INPUT.masa.innerHTML = peri;
};

const setPeriode = () => {
  let peri = '<option value="">Pilih</option>';
  for (let i = 0; i < periode.length; i++) {
    peri += /*html*/ `<option value="${parseInt(periode[i])}">${
      periode[i]
    }</option>`;
  }
  INPUT.periode.innerHTML = peri;
};

function isNumber(evt) {
  var charCode = evt.which ? evt.which : event.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
  return true;
}

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

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split = number_string.split(','),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
  }

  rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
  return prefix == undefined ? rupiah : rupiah ? 'Rp. ' + rupiah : '';
}

const parseRupiah = str => parseInt(str.split(' ')[1].split('.').join(''));

/**
 * global @function execution
 */

setPeriode();

// setTahun(generateTahun());

bindingUpdate();

INPUT.masa.value = new Date().getFullYear();

INPUT.close.onclick = function () {
  clearForm();
};

if (INPUT.periode.getAttribute('data-change') === 'add') {
  INPUT.periode.onchange = function () {
    window.localStorage.setItem('periode', parseInt(this.value));
  };
} else {
  INPUT.periode.onchange = function () {
    window.localStorage.setItem('periode-update', parseInt(this.value));
  };
}

INPUT.periode.value =
  window.localStorage.getItem('periode') === null
    ? ''
    : window.localStorage.getItem('periode');

INPUT.harga.addEventListener('keyup', function () {
  this.value = formatRupiah(this.value, 'Rp. ');
});

INPUT.hpp.addEventListener('keyup', function () {
  this.value = formatRupiah(this.value, 'Rp. ');
});

INPUT.bobot.addEventListener('keyup', function () {
  if (this.value === '') {
    INPUT.sisa.value = '';
  } else {
    const total =
      (parseRupiah(INPUT.hpp.value) - parseRupiah(INPUT.harga.value)) *
      parseInt(this.value);
    INPUT.sisa.value = formatRupiah(total.toString(), 'Rp. ');
  }
});

listDelete();
