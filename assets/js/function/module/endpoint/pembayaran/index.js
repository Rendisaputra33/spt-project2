import 'regenerator-runtime/runtime';
import * as Bind from '../../actions/pembayaran/index.js';
import elements from '../../elements/pembayaran/index.js';
import { isNumber } from '../../general/index.js';

// bind delete event
Bind.bindingDelete();

// bind detail event
Bind.bindingDetail();

// bind filter event
Bind.bindingFilter();

// bind update event
Bind.bindingUpdate();

//
Bind.bindingFilterTanggal();

//
Bind.bindingForm();

// binding event user typing letters
if (elements.inputNumbe) {
	elements.inputNumbe?.addEventListener('keypress', isNumber);
}
