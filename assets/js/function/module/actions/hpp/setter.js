import element from '../../elements/hpp/index.js';
import base from '../../elements/index.js';

export async function setForm({ data }) {
    element.form.setAttribute('action', `${base.baseUrl}/entry/cek/hpp`);
    element.hpp.value = data.hpp ? data.hpp : '';
    element.pengirim.value = data.keterangan ? data.keterangan : '';
    element.id.value = data.id_entry;
}
