import elements from '../../elements/entry/index.js';
import * as Handler from './handler.js';
// all atribute and detail elements
const {
    other: { btnUpdate, btnDetail },
} = elements;

export function bindingUpdate() {
    btnUpdate.forEach((elment) => {
        elment.addEventListener('click', async function () {
            await Handler.handlerUpdate(this);
        });
    });
}

export function bindingDetail() {
    btnDetail.forEach((element) => {
        element.addEventListener('click', async function () {
            await Handler.handlerUpdate(this);
        });
    });
}
