const URL = document.querySelector('.baseurl').value;
const URL_PABRIK = URL + '/pabrik/';

const INPUT = {
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

const fetchUpdate = async THIS => {
  await fetch(`${URL_PABRIK}json?id=${THIS.getAttribute('data-id')}`)
    .then(res => res.json())
    .then(result => setFormUpdate(result.data))
    .catch(error => console.log(error));
};

const setFormUpdate = result => {
  INPUT.nama.value = result.nama_pabrik;
  INPUT.kode.value = result.kode_pabrik;
};

// function execution here

bindingUpdate();
