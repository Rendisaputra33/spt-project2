import element from "../../elements/hpp/index.js";

export async function getUpdate(id) {
	const data = await fetch(element.url + "/entry/cek/hpp/" + id);
	return await data.json();
}

export async function setForm({ data }) {
	element.hpp.value = data.hpp;
	element.pengirim.value = data.keterangan;
}

export function bindingUpdate() {
	element.btnupdate.forEach(btn => {
		btn.addEventListener("click", handlerBtnupdate);
	});
}

export function isNumber(e) {
	var charCode = e.which ? e.which : event.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		e.preventDefault();
		return false;
	}
	return true;
}

export async function handlerBtnupdate(e) {
	const id = this.getAttribute("data-id");
	const data = await getUpdate(id);
	setForm(data);
}
