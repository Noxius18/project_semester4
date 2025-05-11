document.addEventListener('DOMContentLoaded', function () {
    const tipeSelect = document.getElementById('tipe_jadwal');
    const tanggalGroup = document.getElementById('field-tanggal');
    const timLawanGroup = document.getElementById('field-tim-lawan');

    function updateFieldVisibility() {
        const tipe = tipeSelect.value;

        if (tipe === 'REG') {
            tanggalGroup.classList.add('d-none');
            timLawanGroup.classList.add('d-none');
        } else if (tipe === 'PNG') {
            tanggalGroup.classList.remove('d-none');
            timLawanGroup.classList.add('d-none');
        } else if (tipe === 'PRT') {
            tanggalGroup.classList.remove('d-none');
            timLawanGroup.classList.remove('d-none');
        }
    }

    // Jalankan saat load awal
    updateFieldVisibility();

    // Jalankan saat berubah
    tipeSelect.addEventListener('change', updateFieldVisibility);
});
