import elements from '../../elements/pembayaran/index.js';
import { handlerDelete, handlerDetail, handlerFilter, handlerSubmitform, handlerTgl, handlerUpdateHarga } from './handler.js';

export function bindingDelete() {
	document.querySelectorAll('.delete').forEach((element) => {
		element.addEventListener('click', handlerDelete);
	});
}

export function bindingDetail() {
	document.querySelectorAll('.detail').forEach((element) => {
		element?.addEventListener('click', handlerDetail);
	});
}

export function bindingFilter() {
	elements?.btnFilter?.addEventListener('click', handlerFilter);
}

export function bindingUpdate() {
	document.querySelectorAll('.update').forEach((element) => {
		element.addEventListener('click', handlerUpdateHarga);
	});
}

export function bindingFilterTanggal() {
	elements?.filterTgl?.addEventListener('click', handlerTgl);
}

export function bindingForm() {
	elements?.formUpdate.addEventListener('submit', handlerSubmitform);
}
