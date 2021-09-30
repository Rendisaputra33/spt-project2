import elements, { elementDetail, elementList } from '../../elements/pembayaran/index.js';

// swal definition
export const swalDelete = (param) => {
    Swal.fire({
        title: 'Yakin ingin Menghapus?',
        text: 'Data pembayaran  akan di hapus secara permanet',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal',
    }).then((result) => {
        result.isConfirmed ? (window.location.href = param) : '';
    });
};

export const setListDetail = (data) => {
    let html = '';
    data.map((item, index) => (html += elementDetail(item, index)));
    elements.listDetail.innerHTML = html;
};

export const setListFilter = (data) => {
    let html = '';
    data.map((item, index) => (html += elementList(item)));
    elements.tbody.innerHTML = html;
};
