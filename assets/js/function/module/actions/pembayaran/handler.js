import elements, { elementGlobal, elementPembayaran } from '../../elements/pembayaran/index.js';
import { getDetail, getFilter, getDataWithTgl, requestupdateHarga } from './request.js';
import elglobal from '../../elements/index.js';
import { clearFormUpdateHarga, setListDetail, setListFilter, setListGlobalTgl, swalDelete } from './setter.js';
import { bindingDelete, bindingDetail, bindingUpdate } from './index.js';

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
			await handlerTgl({});
		}
	});
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
	}

	handlerAfterElementChanged();
}

export function handlerUpdateHarga(e) {
	const formUpdate = elements.formUpdate;
	document.querySelector('input[name=harga]').value = this.getAttribute('data-harga');
	formUpdate?.setAttribute('action', elglobal.baseUrl + '/pembayaran/' + this.getAttribute('data-id'));
}

export function handlerAfterElementChanged() {
	bindingDelete();
	bindingDetail();
	bindingUpdate();
}
