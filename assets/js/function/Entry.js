/**
 * @variable global here
 */

const URL = document
  .querySelector('meta[name=baseurl]')
  .getAttribute('aria-valuemin');

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
  periode: document.querySelector('select[name=periode]'),
  masa: document.querySelector('select[name=masa_giling]'),
  reg: document.querySelector('input[name=reg]'),
  nospta: document.querySelector('input[name=nospta]'),
  variasi: document.querySelector('input[name=variasi]'),
  type: document.querySelector('input[name=type]'),
  nopol: document.querySelector('input[name=nopol]'),
  keterangan: document.querySelector('input[name=keterangan]'),
  hpp: document.querySelector('input[name=hpp]'),
  harga: document.querySelector('input[name=harga_beli]'),
  bobot: document.querySelector('input[name=bobot]'),
  sisa: document.querySelector('input[name=sisa]'),
};

/**
 * @function definition here
 */

const setPeriode = () => {
  let peri = '<option value="">Pilih</option>';
  for (let i = 0; i < periode.length; i++) {
    peri += /*html*/ `<option value="${periode[i]}">${periode[i]}</option>`;
  }
  INPUT.periode.innerHTML = peri;
};

/**
 * global @function execution
 */

setPeriode();

INPUT.periode.addEventListener('change', function () {
  console.log('ok');
  window.localStorage.setItem('periode', this.value);
});

INPUT.periode.value =
  window.localStorage.getItem('periode') === null
    ? ''
    : window.localStorage.getItem('periode');
