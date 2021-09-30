import * as General from '../../general/index.js';
import { handlerBtnupdate } from './handler.js';

export function bindingUpdate() {
    return General.bindingUpdate(handlerBtnupdate);
}

export function isNumber(e) {
    var charCode = e.which ? e.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) return e.preventDefault();
    return true;
}
