import elements from './../index.js';

export default {
    listDetail: document.getElementById('list-detail'),
    inputNumbe: document.querySelector('input[name=harga]'),
    inputFilter: document.querySelector('select[name=filter]'),
    btnFilter: document.querySelector('.filter'),
    detailTitle: document.querySelector('span[id=detail-title]'),
    formUpdate: document.querySelector('#form-'),
    tbody: document.querySelector('#list-data'),
    filterTgl: document.querySelector('button[name=filter]'),
    tglAwal: document.querySelector('input[name=tgl1]'),
    tglAkhir: document.querySelector('input[name=tgl2]'),
};

const timeTodate = (tgl) => {
    const date = new Date(tgl);
    return date.toLocaleDateString();
};

export const elementDetail = (data, no) => `
    <tr>
        <td>${no + 1}</td>
        <td>${data.masa_giling}</td>
        <td>${data.periode}</td>
        <td>${timeTodate(data.created_at)}</td>
        <td>${data.reg}</td>
        <td>${data.nospta}</td>
        <td>${data.nopol}</td>
        <td>${data.pabrik}</td>
    </tr>
`;

export const elementList = (data) => `
    <tr>
        <td><input type="checkbox" name="id[]" class="form-check-info" value="${data.id_entry}"></td>
        <td>${data.masa_giling}</td>
        <td>${data.periode}</td>
        <td>${timeTodate(data.created_at)}</td>
        <td>${data.reg}</td>
        <td>${data.nospta}</td>
        <td>${data.nopol}</td>
        <td>${data.pabrik}</td>
    </tr>
`;

export const elementPembayaran = (data, no) => `
    <tr>
        <td>${no + 1}</td>
        <td>${data.invoice}</td>
        <td>${data.total}</td>
        <td>${timeTodate(data.created_at)}</td>
        <td>
            <button type="button" class="btn btn-sm btn-info btn-icon-text detail"
                data-target="#modal-lg-detail" id='tbh' data-toggle="modal"
                data-id="${data.invoice.replace(/\//gi, '-')}">
                <i class="mdi mdi-information-outline btn-icon-prepend"></i>Detail
            </button>
            <a href="${elements.baseUrl}/pembayaran/${data.invoice.replace(/\//gi, '-')}"
                class="btn btn-sm btn-danger btn-icon-text delete">
                <i class="mdi mdi-delete-forever btn-icon-prepend"></i>Hapus
            </a>
        </td>
    </tr>
`;

export const elementGlobal = (data, no) => `
    <tr>
        <td>${++no}</td>
        <td>${data.masa_giling}</td>
        <td>${data.periode}</td>
        <td>${timeTodate(data.created_at)}</td>
        <td>${data.reg}</td>
        <td>${data.nospta}</td>
        <td>${data.nopol}</td>
        <td>${data.pabrik}</td>
        <td>
            <button type="button"
                class="btn btn-sm btn-${data.harga_beli ? 'danger' : 'warning'} btn-icon-text update"
                data-target="#modal-md-edit" id='tbh' data-toggle="modal"
                data-id="${data.id_entry}">
                <i
                    class="mdi mdi-lead-pencil btn-icon-prepend"></i>${data.harga_beli ? 'Lengkapi' : 'Ubah'}
            </button>
        </td>
    </tr>
`;
