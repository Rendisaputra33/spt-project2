import { requestUpdate } from './request.js';
import { setFormUpdate } from './setter.js';

export const handlerUpdate = async (This) => {
    try {
        const result = await requestUpdate(This.getAttribute('data-id'));
        setFormUpdate(result);
    } catch (error) {
        console.log(error);
    }
};

export const handlerDetail = async (This) => {
    try {
        const result = await requestUpdate(This.getAttribute('data-id'));
        return result;
    } catch (error) {
        console.log(error);
    }
};
