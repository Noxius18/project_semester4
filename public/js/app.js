document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
    toggle.addEventListener('click', function (e) {
        e.preventDefault();
        const parentItem = this.closest('.menu-item');
        parentItem.classList.toggle('open');
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Contoh pemanggilan SweetAlert
    if (window.sessionMessage) {
        Swal.fire({
            title: 'Berhasil!',
            text: window.sessionMessage,
            icon: 'success',
            confirmButtonText: 'OK'
        });
    }
});