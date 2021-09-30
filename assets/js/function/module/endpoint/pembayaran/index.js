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

// binding event user typing letters
elements?.inputNumbe?.addEventListener('keypress', isNumber);
