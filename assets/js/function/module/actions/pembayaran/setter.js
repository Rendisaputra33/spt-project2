import elements, { elementDetail, elementList } from '../../elements/pembayaran/index.js';
import { formatRupiah } from '../../general/index.js';

// swal definition
export const swalDelete = (param) => {
	Swal.fire({
		title: 'Yakin ingin Menghapus?',
		text: 'Data pembayaran  akan di hapus secara permanet',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Ya',
		cancelButtonText: 'Batal'
	}).then((result) => {
		result.isConfirmed ? (window.location.href = param) : '';
	});
};

export const setListDetail = (data) => {
	let html = '';
	const total = data.reduce((a, b) => a + b.harga_beli * b.bobot, 0);
	data.map((item, index) => (html += elementDetail(item, index)));
	elements.listDetail.innerHTML = html;
	elements.totals.innerHTML = formatRupiah(total.toString(), 'Rp. ');
};

export const setListFilter = (data) => {
	let html = '';
	data.map((item) => (html += elementList(item)));
	elements.tbody.innerHTML = html;
};

export const setListGlobalTgl = (data, callbak) => {
	let html = '';
	data.map((item, index) => (html += callbak(item, index)));
	elements.tbody.innerHTML = html;
};

export const clearFormUpdateHarga = (elHarga, elLoader) => {
	elHarga.value = '';
	elLoader.style.display = 'none';
	document.getElementById('close-modal')?.click();
};
