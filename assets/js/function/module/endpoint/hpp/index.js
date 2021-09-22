import { bindingUpdate, isNumber } from "../../actions/hpp/index.js";
import element from "../../elements/hpp/index.js";

bindingUpdate();
// handler input number
element.hpp.addEventListener("keypress", isNumber);
