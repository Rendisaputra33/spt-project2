import * as General from '../../general/index.js';
import elements from '../../elements/pembayaran/index.js';
import { handlerDelete, handlerDetail, handlerFilter, handlerUpdateHarga } from './handler.js';

export function bindingDelete() {
    return General.bindingDelete(handlerDelete);
}

export function bindingDetail() {
    return General.bindingDetail(handlerDetail);
}

export function bindingFilter() {
    elements?.btnFilter?.addEventListener('click', handlerFilter);
}

export function bindingUpdate() {
    return General.bindingUpdate(handlerUpdateHarga);
}
