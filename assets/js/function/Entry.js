/**
 * @variable global here
 */

const URL = document.querySelector('meta[name=baseurl]').getAttribute('aria-valuemin');

const URL_ROOT = URL + '/entry';

const listMonth = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'November', 'Desember'];

const A = {
    d: `class="btn btn-sm btn-info btn-icon-text detail" data-target="#modal-lg-detail" id='tbh' data-toggle="modal"`,
    id: `<i class="mdi mdi-information-outline btn-icon-prepend"></i>`,
    u: `class="btn btn-sm btn-warning btn-icon-text update" data-target="#modal-lg-tambah" id='tbh' data-toggle="modal"`,
    iu: `<i class="mdi mdi-lead-pencil btn-icon-prepend"></i>`,
    del: `class="btn btn-sm btn-danger btn-icon-text delete"`,
    idel: `<i class="mdi mdi-delete-forever btn-icon-prepend"></i>`,
};

const Detail = {
    periode: document.querySelector('td[class=periode]'),
    masa: document.querySelector('td[class=masa]'),
    tanggal: document.querySelector('td[class=tanggal]'),
    reg: document.querySelector('td[class=reg]'),
    nospta: document.querySelector('td[class=nospta]'),
    nopol: document.querySelector('td[class=nopol]'),
    bobot: document.querySelector('td[class=bobot]'),
    ket: document.querySelector('td[class=ket]'),
    hpp: document.querySelector('td[class=hpp]'),
    sisa: document.querySelector('td[class=sisa]'),
    harga: document.querySelector('td[class=harga]'),
    petani: document.querySelector('td[class=petani]'),
    type: document.querySelector('td[class=type]'),
    variasi: document.querySelector('td[class=variasi]'),
    pabrik: document.querySelector('td[class=pabrik]'),
};

const ELEMENT = {
    tableBody: document.querySelector('#list'),
    btnHpp: document.querySelector('.hpp'),
};

const periode = ['001', '002', '003', '004', '005', '006', '007', '008', '009', '010', '011', '012', '013', '014', '015', '016', '017', '018', '019', '020', '021', '022', '023', '024', '025', '026', '027', '028', '029', '030'];

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
    keterangan: document.querySelector('select[name=keterangan]'),
    hpp: document.querySelector('input[name=hpp]'),
    bobot: document.querySelector('input[name=bobot]'),
    pabrik: document.querySelector('select[name=pabrik]'),
    search: document.querySelector('#search'),
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
        up[i].onclick = async function (e) {
            await fetchUpdate(this);
        };
    }
};

const binddingDetail = () => {
    const de = document.querySelectorAll('.detail');
    for (let i = 0; i < de.length; i++) {
        de[i].onclick = async function () {
            await fetchDetail(this);
        };
    }
};
// fetch get data update
const fetchUpdate = async (THIS) => {
    await fetch(`${URL_ROOT}/json/${THIS.getAttribute('data-id')}`)
        .then((res) => res.json())
        .then((result) => setFormUpdate(result))
        .catch((error) => console.log(error));
};
// fetch get data update
const fetchDetail = async (THIS) => {
    await fetch(`${URL_ROOT}/json/${THIS.getAttribute('data-id')}`)
        .then((res) => res.json())
        .then((result) => setDetail(result.data))
        .catch((error) => console.log(error));
};
// fetch get data search
const fetchSearch = async (THIS) => {
    const param = THIS.value === '' ? 'tidak-ada' : THIS.value;

    const final_param = document.querySelector('input[name=data-filter]').getAttribute('data-tanggal') !== 'null' ? document.querySelector('input[name=data-filter]').getAttribute('data-tanggal') : null;

    const uris = final_param ? `${URL_ROOT}/json/search/${param}&${final_param}` : `${URL_ROOT}/json/search/${param}`;

    await fetch(uris)
        .then((res) => res.json())
        .then((result) => setSearch(result.data))
        .catch((error) => console.log(error));
    bindingUpdate();
    binddingDetail();
    listDelete();
};

const setSearch = (data) => {
    let html = '';
    let no = 1;
    let sisa = 0;
    let bobot = 0;
    data.map((data) => {
        html += uiSearch(data, no++);
        sisa += data.sisa;
        bobot += data.bobot;
    });
    ELEMENT.tableBody.innerHTML = html;
    document.getElementById('total_').innerHTML = `<tr class="bg-dark">
  <td></td>
  <td>Total Bobot</td>
  <td>:</td>
  <td>${bobot} KW</td>
</tr>
<tr>
  <td></td>
  <td>Total Sisa</td>
  <td>:</td>
  <td>${formatRupiah(sisa.toString(), 'Rp. ')}</td>
</tr>`;
};

const generateTahun = () => {
    let start = new Date('2021');
    return {
        start: start.getFullYear(),
        end: new Date(start.getTime() + 31622400000 * 20).getFullYear(),
    };
};

const setTahun = async (d) => {
    let peri = '<option value="">Pilih</option>';
    for (let i = d.start; i <= d.end; i++) {
        peri += /*html*/ `<option value="${i}">${i}</option>`;
    }
    INPUT.masa.innerHTML = peri;
};

const timeTodate = (tgl) => {
    const date = new Date(tgl);
    return date.toLocaleDateString();
};

const formatTanggal = (tgl) => {
    const month = tgl.split('/');
    return `${month[1]}/${listMonth[parseInt(month[0]) - 1]}/${month[2]}`;
};

const formatTanggalNew = (tgl) => {
    const tanggal = tgl.split('/');
    const bulan = parseInt(tanggal[0]) <= 9 ? '0' + tanggal[0] : tanggal[0];
    const hari = parseInt(tanggal[1]) <= 9 ? '0' + tanggal[1] : tanggal[1];
    return `${hari}/${bulan}/${tanggal[2]}`;
};

const setPeriode = () => {
    let peri = '<option value="">Pilih</option>';
    for (let i = 0; i < periode.length; i++) {
        peri += /*html*/ `<option value="${periode[i]}">${periode[i]}</option>`;
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

const setFormUpdate = (result) => {
    document.querySelector('#reg-petani').style.display = 'block';
    uiReg(result.reg);
    INPUT.periode.setAttribute('data-change', 'update');
    INPUT.action.setAttribute('action', URL_ROOT + '/' + result.data.id_entry);
    binddingPeriode();
    INPUT.method.innerHTML = '<input type="hidden" name="_method" value="PUT" />';
    INPUT.periode.value = result.data.periode;
    INPUT.masa.value = result.data.masa_giling;
    INPUT.reg.value = `${result.data.reg} | ${result.reg.filter((v) => v.reg === result.data.reg)[0].nama_petani}`;
    INPUT.nospta.value = result.data.nospta;
    INPUT.nopol.value = result.data.nopol;
    INPUT.variasi.value = result.data.variasi;
    INPUT.type.value = result.data.type;
    INPUT.keterangan.value = result.data.keterangan === null ? '' : result.data.keterangan;
    INPUT.hpp.value = result.data.hpp ? formatRupiah(result.data.hpp.toString(), 'Rp. ') : '';
    INPUT.bobot.value = result.data.bobot;
    INPUT.pabrik.value = `${result.data.id_pabrik} | ${result.data.pabrik}`;
    document.querySelector('input[name=petani]').value = result.data.petani;
};

const setDetail = (data) => {
    Detail.bobot.innerHTML = data.bobot;
    Detail.harga.innerHTML = data.harga_beli !== null ? formatRupiah(data.harga_beli.toString(), 'Rp. ') : '-';
    Detail.hpp.innerHTML = data.hpp ? formatRupiah(data.hpp.toString(), 'Rp. ') : '-';
    Detail.ket.innerHTML = data.keterangan !== null ? data.keterangan : '-';
    Detail.masa.innerHTML = data.masa_giling;
    Detail.nopol.innerHTML = data.nopol;
    Detail.periode.innerHTML = data.periode;
    Detail.reg.innerHTML = data.reg;
    Detail.sisa.innerHTML = data.harga_beli && data.hpp !== null ? formatRupiah(((data.hpp - data.harga_beli) * data.bobot).toString(), 'Rp. ') : '-';
    Detail.nospta.innerHTML = data.nospta;
    Detail.tanggal.innerHTML = formatTanggalNew(timeTodate(data.created_at));
    Detail.petani.innerHTML = data.petani;
    Detail.type.innerHTML = data.type_;
    Detail.variasi.innerHTML = data.variasi_;
    Detail.pabrik.innerHTML = data.pabrik;
};

const clearForm = () => {
    INPUT.action.setAttribute('action', URL_ROOT);
    INPUT.periode.setAttribute('data-change', 'add');
    binddingPeriode();
    INPUT.periode.value = window.localStorage.getItem('periode');
    INPUT.masa.value = new Date().getFullYear();
    INPUT.reg.value = '';
    INPUT.nospta.value = '';
    INPUT.nopol.value = '';
    INPUT.variasi.value = '';
    INPUT.type.value = '';
    INPUT.keterangan.value = '';
    // INPUT.harga.value = "";
    INPUT.hpp.value = '';
    INPUT.bobot.value = '';
    INPUT.pabrik.value = '';
    document.querySelector('input[name=petani]').value = '';
};
// swal definition
const swalDelete = (param) => {
    Swal.fire({
        title: 'Yakin ingin Menghapus?',
        text: 'Data akan di hapus secara permanent!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal',
    }).then((result) => {
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

const binddingPeriode = () => {
    if (INPUT.periode.getAttribute('data-change') === 'add') {
        INPUT.periode.onchange = function () {
            window.localStorage.setItem('periode', this.value);
        };
    } else {
        INPUT.periode.onchange = function () {
            window.localStorage.setItem('periode-update', this.value);
        };
    }
};

const setReg = async (parameter) => {
    await fetch(URL + '/petani/pabrik/' + parameter)
        .then((res) => res.json())
        .then((res) => uiReg(res.data))
        .catch((err) => err);
    parameter === '' ? (document.querySelector('#reg-petani').style.display = 'none') : (document.querySelector('#reg-petani').style.display = 'block');
};

const uiReg = (data) => {
    let html = `<option value="">Pilih</option>`;
    data.map((da) => {
        html += /*html*/ `<option value="${da.reg} | ${da.nama_petani}">${da.reg}</option>`;
    });
    INPUT.reg.innerHTML = html;
};

const uiSearch = (data, no) => {
    return /*html*/ `
      <tr>
          <td>${no}</td>
          <td>${data.masa_giling}</td>
          <td>${data.periode}</td>
          <td>${formatTanggalNew(timeTodate(data.created_at))}</td>
          <td>${data.reg}</td>
          <td>${data.nospta}</td>
          <td>${data.nopol}</td>
          <td>${data.pabrik}</td>
          <td>
              <button type="button" ${A.d} data-id="${data.id_entry}">${A.id} Detail </button>
              <button type="button" ${A.u} data-id="${data.id_entry}">${A.iu} Ubah </button>
              <a href="${URL_ROOT}/${data.id_entry}" ${A.del}>${A.idel} Hapus </a>
          </td>
    </tr>
  `;
};

const parseRupiah = (str) => parseInt(str.split(' ')[1].split('.').join(''));

/**
 * global @function execution
 */
// set form periode
setPeriode();
// setTahun(generateTahun());
bindingUpdate();
// binding action change input periode
binddingPeriode();
// binding event delete
listDelete();
// binding click detail button
binddingDetail();
// set default input massa gilings
INPUT.masa.value = new Date().getFullYear();
// bindding event after
INPUT.close.onclick = function () {
    clearForm();
};
// set dafault input periode
INPUT.periode.value = window.localStorage.getItem('periode') === undefined ? '' : window.localStorage.getItem('periode');
// binding format input harga beli
/* INPUT.harga.addEventListener("keyup", function () {
	this.value = formatRupiah(this.value, "Rp. ");
}); */
// binding format input hpp
INPUT.hpp.addEventListener('keyup', function () {
    this.value = formatRupiah(this.value, 'Rp. ');
});

// binding format input bobot & sisa
/* INPUT.bobot.addEventListener("keyup", function () {
	if (this.value === "") {
		INPUT.sisa.value = "";
	} else {
		const total = (parseRupiah(INPUT.hpp.value) - parseRupiah(INPUT.harga.value)) * parseInt(this.value);
		INPUT.sisa.value = formatRupiah(total.toString(), "Rp. ");
	}
}); */

// binding event search
INPUT.search.onkeyup = async function () {
    await fetchSearch(this);
};

INPUT.pabrik.onchange = async function () {
    await setReg(this.value);
    document.querySelector('input[name=petani]').value = '';
};

INPUT.reg.onchange = function () {
    let data = this.value.split(' | ')[1];
    document.querySelector('input[name=petani]').value = data;
};

document.querySelector('.filter').setAttribute('href', URL_ROOT + `?tgl=${document.querySelector('input[name=tanggalawal]').value}|${document.querySelector('input[name=tanggalakhir]').value}`);

document.querySelector('input[name=tanggalawal]').onchange = function () {
    document.querySelector('.filter').setAttribute('href', URL_ROOT + `?tgl=${this.value}|${document.querySelector('input[name=tanggalakhir]').value}`);
};

document.querySelector('input[name=tanggalakhir]').onchange = function () {
    const uri = document.querySelector('.filter').getAttribute('href');
    document.querySelector('.filter').setAttribute('href', uri.split('|')[0] + `|${this.value}`);
};
