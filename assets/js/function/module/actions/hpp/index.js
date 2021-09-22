import element from "../../elements/hpp/index.js";
import { handlerBtnupdate } from "./handler.js";

export function bindingUpdate() {
	element.btnupdate.forEach(btn => {
		btn.addEventListener("click", handlerBtnupdate);
	});
}

export function isNumber(e) {
	var charCode = e.which ? e.which : event.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) return e.preventDefault();
	return true;
}
