import elements, { elementGlobal, elementPembayaran } from '../../elements/pembayaran/index.js';
import { getDetail, getFilter, getDataWithTgl } from './request.js';
import elglobal from '../../elements/index.js';
import { setListDetail, setListFilter, setListGlobalTgl, swalDelete } from './setter.js';
import { bindingDelete, bindingDetail, bindingUpdate } from './index.js';

export function handlerDelete(e) {
    // delete the event
    e.preventDefault();
    // if confirm delete this data
    swalDelete(e.target.href);
}

export async function handlerDetail(e) {
    console.log('detail');
    // get data form server
    const data = await getDetail(this.getAttribute('data-id'));
    // set a title
    elements.detailTitle.innerHTML = this.getAttribute('data-id').replace(/-/gi, '/');
    // set data to view
    setListDetail(data.data);
}

export async function handlerFilter(e) {
    // instance variable
    const selected = elements?.inputFilter?.value;
    const data = await getFilter(selected);
    // set data to view
    setListFilter(data.data);
}

export async function handlerTgl(e) {
    // put value form
    const value = { tgl1: elements.tglAwal.value, tgl2: elements.tglAkhir.value };
    const data = await getDataWithTgl(value, this.getAttribute('data-page'));
    // operation logical
    if (this.getAttribute('data-page') === 'pembayaran') {
        setListGlobalTgl(data.data, elementPembayaran);
    } else {
        setListGlobalTgl(data.data, elementGlobal);
    }

    handlerAfterFilter();
}

export function handlerUpdateHarga(e) {
    return elements.formUpdate?.setAttribute('action', elglobal.baseUrl + '/pembayaran/' + this.getAttribute('data-id'));
}

export function handlerAfterFilter() {
    bindingDelete();
    bindingDetail();
    bindingUpdate();
}
