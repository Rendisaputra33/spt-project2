import elements, { elementList } from "../../elements/pembayaran/index.js";
import { getDetail, getFilter } from "./request.js";
import elglobal from "../../elements/index.js";
import { setListDetail, setListFilter, swalDelete } from "./setter.js";

export function handlerDelete(e) {
	// delete the event
	e.preventDefault();
	// if confirm delete this data
	swalDelete(this.href);
}

export async function handlerDetail(e) {
	// get data form server
	const data = await getDetail(this.getAttribute("data-id"));
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

export function handlerUpdateHarga(e) {
	return elements.formUpdate?.setAttribute("action", elglobal.baseUrl + "/pembayaran/" + this.getAttribute("data-id"));
}
