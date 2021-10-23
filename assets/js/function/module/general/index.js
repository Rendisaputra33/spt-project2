import elements from "../elements/index.js";

export function bindingUpdate(handler = defaultHandler) {
	elements.btnUpdate.forEach(async element => {
		element.addEventListener("click", handler);
	});
}

export function bindingDelete(handler = defaultHandler) {
	elements.btnDelete.forEach(element => {
		element.addEventListener("click", handler);
	});
}

export function bindingDetail(handler = defaultHandler) {
	elements.btnDetail.forEach(element => {
		element.addEventListener("click", handler);
	});
}

export function isNumber(e) {
	var charCode = e.which ? e.which : event.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) return e.preventDefault();
	return true;
}

export function formatRupiah(angka, prefix) {
	var number_string = angka.replace(/[^,\d]/g, "").toString(),
		split = number_string.split(","),
		sisa = split[0].length % 3,
		rupiah = split[0].substr(0, sisa),
		ribuan = split[0].substr(sisa).match(/\d{3}/gi);

	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	if (ribuan) {
		const separator = sisa ? "." : "";
		rupiah += separator + ribuan.join(".");
	}

	rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
	return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}

const defaultHandler = e => console.log(e);
