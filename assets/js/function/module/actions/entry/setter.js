import elements, { root } from './../../elements/entry/index.js';

// destructuring element
const { inputs } = elements;

/**
 * functions setter elements
 */

// setter form for updating data
export function setFormUpdate({ data, reg }) {
    document.querySelector('#reg-petani').style.display = 'block';
    uiReg(reg);
    // set form atribute
    inputs.periode.setAttribute('data-change', 'update');
    inputs.action.setAttribute('action', root + '/' + data.id_entry);
    inputs.method.innerHTML = '<input type="hidden" name="_method" value="PUT" />';
    // set value all input
    Object.keys(data).map((objectKey) => {
        if (objectKey === 'id_entry' || objectKey === 'id_pabrik') return;
        if (objectKey === 'hpp') return objectKey ? (inputs[objectKey].value = formatRupiah(data.hpp.toString(), 'Rp. ')) : (inputs['hpp'].value = '');
        if (objectKey === 'keterangan') return objectKey ? (inputs[objectKey].value = data[objectKey]) : (inputs['keterangan'].value = '');
        if (objectKey === 'pabrik') return (inputs[objectKey].value = `${data.id_pabrik} | ${data.pabrik}`);
        if (objectKey === 'reg') return (inputs[objectKey].value = `${data.reg} | ${reg.find((v) => v.reg === data.reg).nama_petani}`);
        return (inputs[objectKey].value = data[objectKey]);
    });
}

// function setter ui req
export const uiReg = (data) => {
    let html = `<option value="">Pilih</option>`;
    data.map((da) => {
        html += `<option value="${da.reg} | ${da.nama_petani}">${da.reg}</option>`;
    });
    inputs.reg.innerHTML = html;
};
