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

Bind.bindingSearch();

// binding event user typing letters
elements.inputNumbe && elements.inputNumbe?.addEventListener('keyup', Bind.bindingKeyup);
