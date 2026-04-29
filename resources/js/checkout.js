document.addEventListener("DOMContentLoaded", () => {
    const checkbox = document.getElementById('misma');
    const campos = document.getElementById('facturacionCampos');

    if (checkbox) {
        checkbox.addEventListener('change', () => {
            campos.style.display = checkbox.checked ? 'none' : 'block';
        });
    }
});
