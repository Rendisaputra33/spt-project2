const URL = document
  .querySelector('meta[name=baseurl]')
  .getAttribute('aria-valuemin');
const URL_ROOT = URL + '/user/';

// declaration input form
const FORM = {
  close: document.getElementById('close-modal'),
  action: document.getElementById('form-'),
  method: document.getElementById('method'),
  nama: document.querySelector('input[name=nama]'),
  password: document.querySelector('input[name=password]'),
  username: document.querySelector('input[name=username]'),
  level: document.querySelector('select[name=level]'),
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
  FORM.action.setAttribute('action', URL_ROOT);
  FORM.method.innerHTML = '';
  FORM.nama.value = '';
  FORM.username.value = '';
  FORM.password.value = '';
  FORM.level.value = '';
};

const fetchUpdate = async THIS => {
  await fetch(`${URL_ROOT}json/${THIS.getAttribute('data-id')}`)
    .then(res => res.json())
    .then(result => setFormUpdate(result.data))
    .catch(error => console.log(error));
};

const setFormUpdate = result => {
  FORM.action.setAttribute('action', URL_ROOT + result.id_user);
  FORM.method.innerHTML = '<input type="hidden" name="_method" value="PUT" />';
  FORM.nama.value = result.nama;
  FORM.username.value = result.username;
  FORM.password.value = result.password;
  FORM.level.value = result.level;
};

// global function execution here

bindingUpdate();

FORM.close.onclick = function () {
  clearForm();
};
