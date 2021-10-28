(() => {
	'use strict';
	const t = { btnUpdate: document.querySelectorAll('.update'), btnDelete: document.querySelectorAll('.delete'), btnDetail: document.querySelectorAll('.detail'), formUpdate: document.querySelector('#form-'), baseUrl: document.querySelector('meta[name=baseurl]')?.getAttribute('aria-valuemin'), csrfToken: document.querySelector('meta[name=token]')?.getAttribute('content') };
	function e(t, e) {
		var n = t
				.replace(/[^,\d]/g, '')
				.toString()
				.split(','),
			a = n[0].length % 3,
			d = n[0].substr(0, a),
			i = n[0].substr(a).match(/\d{3}/gi);
		return i && (d += (a ? '.' : '') + i.join('.')), (d = null != n[1] ? d + ',' + n[1] : d), null == e ? d : d ? 'Rp. ' + d : '';
	}
	const n = { listDetail: document.getElementById('list-detail'), inputNumbe: document.querySelector('input[name=harga]'), inputFilter: document.querySelector('select[name=filter]'), btnFilter: document.querySelector('.filter'), detailTitle: document.querySelector('span[id=detail-title]'), formUpdate: document.querySelector('#form-'), tbody: document.querySelector('#list-data'), filterTgl: document.querySelector('button[name=filter]'), tglAwal: document.querySelector('input[name=tgl1]'), tglAkhir: document.querySelector('input[name=tgl2]'), loader: document.getElementById('loader'), totals: document.getElementById('totals') },
		a = (t) => {
			const e = new Date(t);
			return `${e.getDate()}/${d(e.getMonth())}/${e.getFullYear()}`;
		},
		d = (t) => (t + 1 <= 9 ? `0${t + 1}` : t + 1),
		i = (e, n) => `\n    <tr>\n        <td>${n + 1}</td>\n        <td>${e.invoice}</td>\n        <td>${a(e.creates)}</td>\n        <td>${e.pengirim}</td>\n        <td>${e.totals}</td>\n        <td>\n            <button type="button" class="btn btn-sm btn-info btn-icon-text detail"\n                data-target="#modal-lg-detail" id='tbh' data-toggle="modal"\n                data-id="${e.invoice.replace(/\//gi, '-')}">\n                <i class="mdi mdi-information-outline btn-icon-prepend"></i>Detail\n            </button>\n            <a href="${t.baseUrl}/pembayaran/${e.invoice.replace(/\//gi, '-')}"\n                class="btn btn-sm btn-danger btn-icon-text delete">\n                <i class="mdi mdi-delete-forever btn-icon-prepend"></i>Hapus\n            </a>\n        </td>\n    </tr>\n`,
		r = (t, n) => `\n    <tr>\n        <td>${++n}</td>\n        <td>${t.masa_giling}</td>\n        <td>${t.periode}</td>\n        <td>${a(t.created_at)}</td>\n        <td>${t.reg}</td>\n        <td>${t.nospta}</td>\n        <td>${t.nopol}</td>\n        <td>${t.pabrik}</td>\n        <td>${t.bobot + ' KW'}</td>\n        <td>${t.nama_pengirim}</td>\n        <td>${t.harga_beli ? e(t.harga_beli.toString(), 'Rp. ') : '-'}</td>\n        <td>\n            <button type="button"\n                class="btn btn-sm btn-${t.harga_beli ? 'warning' : 'danger'} btn-icon-text update"\n                data-target="#modal-md-edit" id='tbh' data-toggle="modal"\n                data-id="${t.id_entry}">\n                <i\n                    class="mdi mdi-lead-pencil btn-icon-prepend"></i>${t.harga_beli ? 'Ubah' : 'Lengkapi'}\n            </button>\n        </td>\n    </tr>\n`,
		{ baseUrl: o, csrfToken: l } = t;
	function c(t) {
		var e;
		t.preventDefault(),
			(e = t.target.href),
			Swal.fire({ title: 'Yakin ingin Menghapus?', text: 'Data pembayaran  akan di hapus secara permanet', icon: 'warning', showCancelButton: !0, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Ya', cancelButtonText: 'Batal' }).then((t) => {
				t.isConfirmed && (window.location.href = e);
			});
	}
	async function u(t) {
		document.getElementById('loader').style.display = ' flex ';
		const d = await (async (t) => await (await fetch(o + '/pembayaran/data/detail/' + t)).json())(this.getAttribute('data-id'));
		(document.getElementById('loader').style.display = ' none '),
			(n.detailTitle.innerHTML = this.getAttribute('data-id').replace(/-/gi, '/')),
			((t) => {
				let d = '';
				const i = t.reduce((t, e) => t + e.harga_beli * e.bobot, 0);
				t.map((t, n) => (d += ((t, n) => `\n    <tr>\n        <td>${n + 1}</td>\n        <td>${t.masa_giling}</td>\n        <td>${t.periode}</td>\n        <td>${a(t.created_at)}</td>\n        <td>${t.reg}</td>\n        <td>${t.nospta}</td>\n        <td>${t.nopol}</td>\n        <td>${t.pabrik}</td>\n        <td>${e(t.harga_beli.toString(), 'Rp. ')}</td>\n        <td>${e((t.harga_beli * t.bobot).toString(), 'Rp. ')}</td>\n    </tr>\n\n`)(t, n))), (n.listDetail.innerHTML = d), (n.totals.innerHTML = e(i.toString(), 'Rp. '));
			})(d.data);
	}
	async function s(t) {
		const e = { tgl1: n.tglAwal.value, tgl2: n.tglAkhir.value },
			a = void 0 === this ? 'cek' : this.getAttribute('data-page'),
			d = await (async (t, e) => {
				const n = { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': l }, body: JSON.stringify(t) };
				return await (await fetch(o + '/pembayaran/transaksi/filter/' + e, n)).json();
			})(e, a);
		((t, e) => {
			let a = '';
			t.map((t, n) => (a += e(t, n))), (n.tbody.innerHTML = a);
		})(d.data, 'pembayaran' === a ? i : r),
			p(),
			b(),
			g();
	}
	function m(e) {
		return n.formUpdate.setAttribute('action', t.baseUrl + '/pembayaran/' + this.getAttribute('data-id'));
	}
	function p() {
		document.querySelectorAll('.delete')?.forEach((t) => {
			t?.addEventListener('click', c);
		});
	}
	function b() {
		document.querySelectorAll('.detail')?.forEach((t) => {
			t?.addEventListener('click', u);
		});
	}
	function g() {
		document.querySelectorAll('.update')?.forEach((t) => {
			t?.addEventListener('click', m);
		});
	}
	p(),
		b(),
		n.btnFilter?.addEventListener('click', async function (t) {
			const d = n.inputFilter.value,
				i = await (async (t) => {
					const e = { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': l }, body: JSON.stringify({ pengirim: t }) };
					return await (await fetch(o + '/pembayaran/transaksi/filter', e)).json();
				})(d);
			((t) => {
				let d = '';
				t.map((t) => (d += ((t) => `\n    <tr>\n        <td><input type="checkbox" name="id[]" class="form-check-info" value="${t.id_entry}"></td>\n        <td>${t.masa_giling}</td>\n        <td>${t.periode}</td>\n        <td>${a(t.created_at)}</td>\n        <td>${t.reg}</td>\n        <td>${t.nospta}</td>\n        <td>${t.nopol}</td>\n        <td>${t.pabrik}</td>\n        <td>${t.bobot} KW</td>\n        <td>${t.nama_pengirim}</td>\n        <td>${e(t.harga_beli.toString(), 'Rp. ')}</td>\n    </tr>\n`)(t))), (n.tbody.innerHTML = d);
			})(i.data);
		}),
		g(),
		n.filterTgl?.addEventListener('click', s),
		n.formUpdate?.addEventListener('submit', function (t) {
			t.preventDefault();
			const e = document.querySelector('input[name=harga]');
			(n.loader.style.display = 'flex'),
				(async (t, e) => {
					const n = { method: 'PUT', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': l }, body: JSON.stringify(t) };
					try {
						return !!(await (await fetch(e, n)).json());
					} catch (t) {
						throw !1;
					}
				})({ harga: e.value }, this.getAttribute('action')).then(async (t) => {
					var a, d;
					await s(), (a = e), (d = n.loader), (a.value = ''), (d.style.display = 'none'), document.getElementById('close-modal')?.click();
				});
		}),
		n.inputNumbe?.addEventListener('keypress', function (t) {
			var e = t.which ? t.which : event.keyCode;
			return !(e > 31 && (e < 48 || e > 57)) || t.preventDefault();
		});
})();
