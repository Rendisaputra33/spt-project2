import elements from '../../elements/pembayaran/index.js';
import { formatRupiah } from '../../general/index.js';
import { handlerAfterElementChanged, handlerDelete, handlerDetail, handlerFilter, handlerSubmitform, handlerTgl, handlerUpdateHarga, hanldeWhenCheckedAll } from './handler.js';
import { getSearch } from './request.js';
import { setListSearch } from './setter.js';

export function bindingDelete() {
	document.querySelectorAll('.delete')?.forEach((element) => {
		element?.addEventListener('click', handlerDelete);
	});
}

export function bindingDetail() {
	document.querySelectorAll('.detail')?.forEach((element) => {
		element?.addEventListener('click', handlerDetail);
	});
}

export function bindingFilter() {
	elements.btnFilter && elements.btnFilter?.addEventListener('click', handlerFilter);
}

export function bindingUpdate() {
	document.querySelectorAll('.update')?.forEach((element) => {
		element?.addEventListener('click', handlerUpdateHarga);
	});
}

export const bindingSearch = () => {
	let timeout = null;
	const elem = document.querySelector('input[name=search-pem]');
	elem &&
		elem.addEventListener('keyup', function (e) {
			document.querySelector('#loader-2').style.display = 'flex';
			clearTimeout(timeout);
			timeout = setTimeout(async () => {
				const value = this.value;
				if (value !== '') {
					const data = await getSearch(value);
					setListSearch(data);
					document.querySelector('#loader-2').style.display = 'none';
					handlerAfterElementChanged();
				} else {
					document.querySelector('#loader-2').style.display = 'none';
				}
			}, 600);
		});
};

export function bindingFilterTanggal() {
	elements.filterTgl && elements.filterTgl?.addEventListener('click', handlerTgl);
}

export function bindingForm() {
	elements.formUpdate && elements.formUpdate?.addEventListener('submit', handlerSubmitform);
}

export function bindingKeyup(e) {
	var charCode = e.which ? e.which : event.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) return e.preventDefault();
	const bobot = document.querySelector('input[name=bobot]').value;
	if (this.value !== '') {
		document.querySelector('#total-update').innerHTML = formatRupiah((parseInt(this.value) * parseInt(bobot)).toString(), 'Rp. ');
	} else {
		document.querySelector('#total-update').innerHTML = 'Rp. 0';
	}
}
