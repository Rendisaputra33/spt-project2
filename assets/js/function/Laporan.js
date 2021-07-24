const URL = document
  .querySelector('meta[name=baseurl]')
  .getAttribute('aria-valuemin');

const ELEMEN = {
  tanggalaw: document.getElementById('taw'),
  tanggalak: document.getElementById('tak'),
  periode: document.getElementById('periode'),
  pabrik: document.getElementById('pabrik'),
  type: document.getElementById('type'),
};

ELEMEN.tanggalak.onclick = function (e) {
  this.readOnly = false;
  ELEMEN.tanggalaw.readOnly = false;
  ELEMEN.pabrik.readOnly = true;
  ELEMEN.periode.readOnly = true;
  ELEMEN.type.readOnly = true;
  // set value null
  ELEMEN.pabrik.value = '';
  ELEMEN.periode.value = '';
  ELEMEN.type.value = '';
};
ELEMEN.type.onclick = function (e) {
  this.readOnly = false;
  ELEMEN.tanggalaw.readOnly = true;
  ELEMEN.pabrik.readOnly = true;
  ELEMEN.periode.readOnly = true;
  ELEMEN.tanggalak.readOnly = true;
  //   set value null
  ELEMEN.tanggalaw.value = '';
  ELEMEN.pabrik.value = '';
  ELEMEN.periode.value = '';
  ELEMEN.tanggalak.value = '';
};
ELEMEN.tanggalaw.onclick = function (e) {
  this.readOnly = false;
  ELEMEN.tanggalak.readOnly = false;
  ELEMEN.pabrik.readOnly = true;
  ELEMEN.periode.readOnly = true;
  ELEMEN.type.readOnly = true;
  // set value null
  ELEMEN.pabrik.value = '';
  ELEMEN.periode.value = '';
  ELEMEN.type.value = '';
};
ELEMEN.pabrik.onclick = function (e) {
  this.readOnly = false;
  ELEMEN.tanggalaw.readOnly = true;
  ELEMEN.tanggalak.readOnly = true;
  ELEMEN.periode.readOnly = true;
  ELEMEN.type.readOnly = true;
  //   set value null
  ELEMEN.tanggalaw.value = '';
  ELEMEN.tanggalak.value = '';
  ELEMEN.periode.value = '';
  ELEMEN.type.value = '';
};
ELEMEN.periode.onclick = function (e) {
  this.readOnly = false;
  ELEMEN.tanggalaw.readOnly = true;
  ELEMEN.pabrik.readOnly = true;
  ELEMEN.tanggalak.readOnly = true;
  ELEMEN.type.readOnly = true;
  //   set value null
  ELEMEN.tanggalaw.value = '';
  ELEMEN.pabrik.value = '';
  ELEMEN.tanggalak.value = '';
  ELEMEN.type.value = '';
};
