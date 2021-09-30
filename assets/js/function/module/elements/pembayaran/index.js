export default {
    listDetail: document.getElementById('list-detail'),
    inputNumbe: document.querySelector('input[name=harga]'),
    inputFilter: document.querySelector('select[name=filter]'),
    btnFilter: document.querySelector('.filter'),
    formUpdate: document.querySelector('#form-'),
    tbody: document.querySelector('#list-data'),
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
        <td>
            <button type="button" class="btn btn-sm btn-info btn-icon-text detaill"
                data-target="#modal-lg-detail" id='tbh' data-toggle="modal"
                data-id="">
                <i class="mdi mdi-information-outline btn-icon-prepend"></i>Detail
            </button>
        </td>
    </tr>
`;
