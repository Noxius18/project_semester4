import './bootstrap';
import * as bootstrap from 'bootstrap';

import swal from 'sweetalert2';

document.addEventListener('DOMContentLoaded', function () {
    const success = document.body.dataset.success;
    const error = document.body.dataset.error;

    if (success) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: success,
            showConfirmButton: true,
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6',
            allowOutsideClick: false,
        });
    }

    if (error) {
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: error,
            showConfirmButton: true,
            confirmButtonText: 'OK',
            confirmButtonColor: '#D33',
            allowOutsideClick: false
        });
    }

    // Konfirmasi hapus
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            Swal.fire({
                title: 'Yakin ingin menghapus data ini?',
                text: "Tindakan ini tidak dapat dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            });
        });
    });
});