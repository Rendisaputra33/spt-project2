import elements from '../../elements/index.js';

const { baseUrl, csrfToken } = elements;

export const getDetail = async (inv) => await (await fetch(baseUrl + '/pembayaran/data/detail/' + inv)).json();

export const getSingle = async (inv) => await (await fetch(baseUrl + '/pembayaran/data/detail/single/' + inv)).json();

export const getDataWithTgl = async (value, delimiter) => {
	// declare option fetch request
	const options = {
		method: 'POST',
		headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
		body: JSON.stringify(value)
	};
	// fecthing data
	return await (await fetch(baseUrl + '/pembayaran/transaksi/filter/' + delimiter, options)).json();
};

export const getFilter = async (selected) => {
	// declare option fetch request
	const options = {
		method: 'POST',
		headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
		body: JSON.stringify({ pengirim: selected })
	};
	// fetching data
	return await (await fetch(baseUrl + '/pembayaran/transaksi/filter', options)).json();
};

export const getFilterRange = async () => {
	// fetching data
	return await (await fetch(baseUrl + '/pembayaran/transaksi/filter/range')).json();
};

export const requestupdateHarga = async (data, url) => {
	// declare option fetch request
	const options = {
		method: 'POST',
		headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
		body: JSON.stringify(data)
	};

	// fetch
	try {
		const result = await (await fetch(url, options)).json();
		return result ? true : false;
	} catch (error) {
		throw false;
	}
};

export const getSearch = async (selected) => {
	// declare option fetch request
	const options = {
		method: 'POST',
		headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
		body: JSON.stringify({ queryData: selected })
	};
	// fetching data
	return await (await fetch(baseUrl + '/pembayaran/data/search', options)).json();
};
