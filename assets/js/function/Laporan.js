const URL = document.querySelector('meta[name=baseurl]').getAttribute('aria-valuemin');

const ELEMEN = {
	tanggalaw: document.getElementById('taw'),
	tanggalak: document.getElementById('tak'),
	periode: document.getElementById('periode'),
	pabrik: document.getElementById('pabrik'),
	type: document.getElementById('type'),
	filter: document.getElementById('filter')
};

const periode = ['001', '002', '003', '004', '005', '006', '007', '008', '009', '010', '011', '012', '013', '014', '015', '016', '017', '018', '019', '020', '021', '022', '023', '024', '025', '026', '027', '028', '029', '030'];

const setPeriode = () => {
	let peri = '<option value="">Pilih</option>';
	for (let i = 0; i < periode.length; i++) {
		peri += /*html*/ `<option value="${periode[i]}">${periode[i]}</option>`;
	}
	if (ELEMEN.periode) {
		ELEMEN.periode.innerHTML = peri;
	}
};

setPeriode();

const selector = document.querySelector('.filter-pem');

selector &&
	selector.addEventListener('click', function (e) {
		e.preventDefault();
		const tgl1 = document.querySelector('input[name=tanggalawal]').value;
		const tgl2 = document.querySelector('input[name=tanggalakhir]').value;
		window.location.href = URL + '/pembayaran/report/detail?tgl=' + tgl1 + '|' + tgl2;
	});
