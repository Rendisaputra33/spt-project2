import element from "./../../elements/hpp/index.js";

export const getUpdate = async id => await (await fetch(element.url + "/entry/cek/hpp/" + id)).json();
