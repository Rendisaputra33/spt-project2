import { root } from '../../elements/entry/index.js';

export const requestUpdate = async (id) => await (await fetch(root + '/json/' + id)).json();
