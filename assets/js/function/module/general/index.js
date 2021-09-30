import elements from '../elements/index.js';

export function bindingUpdate(handler = defaultHandler) {
    elements.btnUpdate.forEach(async (element) => {
        element.addEventListener('click', handler);
    });
}

export function bindingDelete(handler = defaultHandler) {
    elements.btnDelete.forEach((element) => {
        element.addEventListener('click', handler);
    });
}

export function bindingDetail(handler = defaultHandler) {
    elements.btnDetail.forEach((element) => {
        element.addEventListener('click', handler);
    });
}

export function isNumber(e) {
    var charCode = e.which ? e.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) return e.preventDefault();
    return true;
}

const defaultHandler = (e) => console.log(e);
