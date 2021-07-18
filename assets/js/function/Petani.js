const URL = document
  .querySelector('meta[name=baseurl]')
  .getAttribute('aria-valuemin');
const URL_PETANI = URL + '/petani/';

const INPUT = {
  action: document.getElementById('form-'),
  method: document.getElementById('method'),
  nama: document.querySelector('input[name=nama]'),
  kode: document.querySelector('input[name=register]'),
  pabrik: document.querySelector('select[name=pabrik]'),
  close: document.getElementById('close-modal'),
};

// function definition here

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

const setFormUpdate = result => {
  INPUT.action.setAttribute('action', URL_PETANI + result.id_petani);
  INPUT.method.innerHTML = '<input type="hidden" name="_method" value="PUT" />';
  INPUT.nama.value = result.nama_petani;
  INPUT.kode.value = result.reg;
  INPUT.pabrik.value = result.id_pabrik;
};

// function execution here

bindingUpdate();

INPUT.close.onclick = function () {
  clearForm();
};
