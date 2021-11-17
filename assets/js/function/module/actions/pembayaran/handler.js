import elements, { elementGlobal, elementPembayaran } from '../../elements/pembayaran/index.js';
import { getDetail, getFilter, getDataWithTgl, requestupdateHarga, getFilterRange } from './request.js';
import elglobal from '../../elements/index.js';
import { clearFormUpdateHarga, setListDetail, setListFilter, setListGlobalTgl, swalDelete } from './setter.js';
import { bindingDelete, bindingDetail, bindingUpdate } from './index.js';
import { formatRupiah, useStatePembayaran } from '../../general/index.js';

export function handlerDelete(e) {
	// delete the event
	e.preventDefault();
	// if confirm delete this data
	swalDelete(e.target.href);
}

export async function handlerDetail(e) {
	document.getElementById('loader').style.display = 'flex';
	// get data form server
	const data = await getDetail(this.getAttribute('data-id'));

	document.getElementById('loader').style.display = 'none';
	// set a title
	elements.detailTitle.innerHTML = this.getAttribute('data-id').replace(/-/gi, '/');
	// set data to view
	setListDetail(data.data);
}

export function handlerSubmitform(e) {
	// remove default event
	e.preventDefault();
	// put input data
	const harga = document.querySelector('input[name=harga]');
	//
	elements.loader.style.display = 'flex';
	// make a request to server
	requestupdateHarga({ harga: harga.value }, this.getAttribute('action')).then(async (res) => {
		if (this.getAttribute('data-form')) {
			clearFormUpdateHarga(harga, elements.loader);
			window.location.href = elglobal.baseUrl + '/pembayaran/transaksi/cek-harga';
		} else {
			clearFormUpdateHarga(harga, elements.loader);
			await afterUpdate();
		}
	});
}

export async function afterUpdate() {
	const tgl = document.querySelector('input[name=tgl-fil]');
	if (tgl.getAttribute('data-tgl1') !== '') {
		await handlerTgl({});
	} else {
		const data = await getFilterRange();
		setListGlobalTgl(data.data, elementGlobal);
		handlerAfterElementChanged();
	}
}

export async function handlerFilter(e) {
	// instance variable
	const selected = elements.inputFilter?.value;
	const data = await getFilter(selected);
	// if not data filter disable button
	if (data.data.length !== 0) {
		document.querySelectorAll('input[type=checkbox]')?.forEach((el) => {
			el.disabled = false;
		});
	}

	// set data to view
	setListFilter(data.data);
	hanlderChecklist();
}

export async function handlerTgl(e) {
	// put value form
	const value = { tgl1: elements?.tglAwal?.value, tgl2: elements?.tglAkhir?.value };
	const delimiter = this === undefined ? 'cek' : this.getAttribute('data-page');
	const data = await getDataWithTgl(value, delimiter);
	// operation logical
	if (delimiter === 'pembayaran') {
		setListGlobalTgl(data.data, elementPembayaran);
	} else {
		setListGlobalTgl(data.data, elementGlobal);
		// set attribure filter
		document.querySelector('input[name=tgl-fil]')?.setAttribute('data-tgl1', data.tgl[0]);
		document.querySelector('input[name=tgl-fil]')?.setAttribute('data-tgl2', data.tgl[1]);
	}
	// binding event
	handlerAfterElementChanged();
}

export function handlerUpdateHarga(e) {
	const formUpdate = elements.formUpdate;
	const harga = document.querySelector('input[name=harga]');
	const bobot = document.querySelector('input[name=bobot]');
	bobot.value = this.getAttribute('data-bobot');
	harga.value = this.getAttribute('data-harga');
	formUpdate?.setAttribute('action', elglobal.baseUrl + '/pembayaran/' + this.getAttribute('data-id'));
	document.querySelector('#total-update').innerHTML = formatRupiah((parseInt(harga.value) * parseInt(bobot.value)).toString(), 'Rp. ');
}

export function handlerAfterElementChanged() {
	bindingDelete();
	bindingDetail();
	bindingUpdate();
}

export function hanlderChecklist(e) {
	const [getTotal, setTotal] = useStatePembayaran(0, document.querySelector('.total-check'));

	document.querySelectorAll('input[type=checkbox]').forEach((el) => {
		el.addEventListener('input', function () {
			const after = parseInt(this.getAttribute('data-hrg'));
			if (this.checked) {
				setTotal(after ? getTotal() + after : getTotal() + 0);
			} else {
				document.querySelector('#check-all').checked = false;
				setTotal(getTotal() ? getTotal() - after : 0);
			}
		});
	});
	hanldeWhenCheckedAll(getTotal, setTotal)();
}

export const hanldeWhenCheckedAll = (get, set) => {
	document.querySelector('#check-all').disabled = false;
	return () => {
		document.querySelector('#check-all').onclick = function (el) {
			if (!this.checked) {
				document.querySelectorAll('input[type=checkbox]').forEach((el) => {
					el.checked = false;
					set(0);
				});
			} else {
				set(0);
				document.querySelectorAll('input[type=checkbox]').forEach((el) => {
					el.checked = true;
					set(get() + parseInt(el.getAttribute('data-hrg')));
				});
			}
		};
	};
};
