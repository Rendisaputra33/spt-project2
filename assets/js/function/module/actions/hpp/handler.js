import { getUpdate } from "./request.js";
import { setForm } from "./setter.js";

export async function handlerBtnupdate(e) {
	const id = this.getAttribute("data-id");
	const data = await getUpdate(id);
	await setForm(data);
}
