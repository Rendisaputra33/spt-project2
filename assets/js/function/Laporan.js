const URL = document
  .querySelector('meta[name=baseurl]')
  .getAttribute('aria-valuemin');

const ELEMEN = {
  tanggalaw: document.getElementById('taw'),
  tanggalak: document.getElementById('tak'),
  periode: document.getElementById('periode'),
  pabrik: document.getElementById('pabrik'),
  type: document.getElementById('type'),
  filter: document.getElementById('filter'),
};

ELEMEN.tanggalak.onclick = function (e) {
  ELEMEN.pabrik.value = '';
  ELEMEN.periode.value = '';
  ELEMEN.type.value = '';
};
ELEMEN.type.onclick = function (e) {
  ELEMEN.tanggalaw.value = '';
  ELEMEN.pabrik.value = '';
  ELEMEN.periode.value = '';
  ELEMEN.tanggalak.value = '';
};
ELEMEN.tanggalaw.onclick = function (e) {
  ELEMEN.pabrik.value = '';
  ELEMEN.periode.value = '';
  ELEMEN.type.value = '';
};
ELEMEN.pabrik.onclick = function (e) {
  ELEMEN.tanggalaw.value = '';
  ELEMEN.tanggalak.value = '';
  ELEMEN.periode.value = '';
  ELEMEN.type.value = '';
};
ELEMEN.periode.onclick = function (e) {
  ELEMEN.tanggalaw.value = '';
  ELEMEN.pabrik.value = '';
  ELEMEN.tanggalak.value = '';
  ELEMEN.type.value = '';
};

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

const setPeriode = () => {
  let peri = '<option value="">Pilih</option>';
  for (let i = 0; i < periode.length; i++) {
    peri += /*html*/ `<option value="${parseInt(periode[i])}">${
      periode[i]
    }</option>`;
  }
  ELEMEN.periode.innerHTML = peri;
};

setPeriode();

ELEMEN.tanggalaw.onchange = function () {
  ELEMEN.filter.setAttribute('href', `${URL}/laporan?f=${this.value}`);
};

ELEMEN.tanggalak.onchange = function () {
  ELEMEN.filter.setAttribute(
    'href',
    `${URL}/laporan?f=${ELEMEN.tanggalaw.value}/${this.value}`
  );
};

ELEMEN.pabrik.onchange = function () {
  ELEMEN.filter.setAttribute('href', `${URL}/laporan?f=${this.value}`);
};

ELEMEN.type.onchange = function () {
  ELEMEN.filter.setAttribute('href', `${URL}/laporan?f=${this.value}`);
};

ELEMEN.periode.onchange = function () {
  ELEMEN.filter.setAttribute('href', `${URL}/laporan?f=${this.value}`);
};
