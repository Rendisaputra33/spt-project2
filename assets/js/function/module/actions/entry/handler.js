import { requestUpdate } from "./request.js";
import { setFormUpdate } from "./setter.js";

export const handlerUpdate = async object => {
	try {
		const result = await requestUpdate(object.getAttribute("data-id"));
		setFormUpdate(result);
	} catch (error) {
		console.log(error);
	}
};

export const handlerDetail = async object => {
	try {
		const result = await requestUpdate(object.getAttribute("data-id"));
		return result;
	} catch (error) {
		console.log(error);
	}
};
