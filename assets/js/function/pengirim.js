const URL = document.querySelector("meta[name=baseurl]").getAttribute("aria-valuemin");
const URL_PENGIRIM = URL + "/pengirim";

const ELEM = {
	nama: document.querySelector("input[name=nama]"),
	form: document.getElementById("form-")
};

const bindingUpdate = () => {
	const btnUpdate = document.querySelectorAll(".update");
	for (let i = 0; i < btnUpdate.length; i++) {
		btnUpdate[i].onclick = async function () {
			await fetchUpdate(this);
		};
	}
};

// fetching update data
const fetchUpdate = async THIS => {
	await fetch(`${URL_PENGIRIM}/json/${THIS.getAttribute("data-id")}`)
		.then(res => res.json())
		.then(result => setFormUpdate(result.data))
		.catch(error => console.log(error));
};

// function setter form update
const setFormUpdate = data => {
	ELEM.form.setAttribute("action", `${URL_PENGIRIM}/${data.id_pengirim}`);
	ELEM.nama.value = data.nama_pengirim;
};

// funtion binding update interacted delete button
const listDelete = () => {
	const del = document.querySelectorAll(".delete");
	for (let i = 0; i < del.length; i++) {
		del[i].onclick = function (e) {
			e.preventDefault();
			swalDelete(this.getAttribute("href"));
		};
	}
};

// swal definition
const swalDelete = param => {
	Swal.fire({
		title: "Yakin ingin Menghapus?",
		text: "Data akan di hapus secara permanent!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Ya",
		cancelButtonText: "Batal"
	}).then(result => {
		result.isConfirmed ? (window.location.href = param) : "";
	});
};

/**
 * global function execution here
 */

bindingUpdate();
listDelete();
