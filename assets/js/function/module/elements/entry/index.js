const url = document.querySelector('meta[name=baseurl]').getAttribute('aria-valuemin');

const detail = {
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

const atribt = {
    d: `class="btn btn-sm btn-info btn-icon-text detail" data-target="#modal-lg-detail" id='tbh' data-toggle="modal"`,
    id: `<i class="mdi mdi-information-outline btn-icon-prepend"></i>`,
    u: `class="btn btn-sm btn-warning btn-icon-text update" data-target="#modal-lg-tambah" id='tbh' data-toggle="modal"`,
    iu: `<i class="mdi mdi-lead-pencil btn-icon-prepend"></i>`,
    del: `class="btn btn-sm btn-danger btn-icon-text delete"`,
    idel: `<i class="mdi mdi-delete-forever btn-icon-prepend"></i>`,
};

const inputs = {
    close: document.querySelector('.add'),
    action: document.querySelector('#form-'),
    method: document.querySelector('#method'),
    periode: document.querySelector('select[name=periode]'),
    masa_giling: document.querySelector('input[name=masa]'),
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
    petani: document.querySelector('input[name=petani]'),
};

const other = {
    tanggal: document.querySelector('input[name=data-filter]'),
    btnUpdate: document.querySelectorAll('.update'),
    btnDetail: document.querySelectorAll('.detail'),
};

export default {
    details: { ...detail },
    atribut: { ...atribt },
    inputs: { ...inputs },
    other: { ...other },
};

export const root = url + '/entry';

export const periode = ['001', '002', '003', '004', '005', '006', '007', '008', '009', '010', '011', '012', '013', '014', '015', '016', '017', '018', '019', '020', '021', '022', '023', '024', '025', '026', '027', '028', '029', '030'];
