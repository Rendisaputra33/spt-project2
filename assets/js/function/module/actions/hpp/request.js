import element from './../../elements/index.js';

export const getUpdate = async (id) => await (await fetch(element.baseUrl + '/entry/cek/hpp/' + id)).json();
