import elements from '../../elements/index.js';

const { baseUrl, csrfToken } = elements;

export const getDetail = async (inv) => await (await fetch(baseUrl + '/pembayaran/data/detail/' + inv)).json();

export const getSingle = async (inv) => await (await fetch(baseUrl + '/pembayaran/data/detail/single/' + inv)).json();

export const getDataWithTgl = async (value, delimiter) => {
    console.log(value);
    // declare option fetch request
    const options = {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
        body: JSON.stringify(value),
    };
    // fecthing data
    return await (await fetch(baseUrl + '/pembayaran/transaksi/filter/' + delimiter, options)).json();
};

export const getFilter = async (selected) => {
    // declare option fetch request
    const options = {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
        body: JSON.stringify({ pengirim: selected }),
    };
    // fetching data
    return await (await fetch(baseUrl + '/pembayaran/transaksi/filter', options)).json();
};
