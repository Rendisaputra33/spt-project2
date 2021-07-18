const URL = document
  .querySelector('meta[name=baseurl]')
  .getAttribute('aria-valuemin');
const URL_PABRIK = URL + '/pabrik';

// declaration input form
const INPUT = {
  close: document.querySelector('.add'),
  action: document.getElementById('form-'),
  method: document.getElementById('method'),
  nama: document.querySelector('input[name=nama]'),
  kode: document.querySelector('input[name=kode]'),
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
  INPUT.action.setAttribute('action', URL_PABRIK);
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
  INPUT.nama.value = result.nama_pabrik;
  INPUT.kode.value = result.kode_pabrik;
};

// global function execution here

bindingUpdate();

INPUT.close.onclick = function () {
  clearForm();
};
