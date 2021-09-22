import element from "./../../elements/hpp/index.js";

export async function getUpdate(id) {
	const data = await fetch(element.url + "/entry/cek/hpp/" + id);
	return await data.json();
}
