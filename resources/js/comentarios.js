document.addEventListener("DOMContentLoaded", () => {
    // Quan l'usuari arriba amb #valorar i tenim window.lineaID (AJAX)
    if (window.location.hash === "#valorar" && window.lineaID) {
        const input = document.getElementById("linea_id_valoracion");
        if (input) {
            input.value = window.lineaID;
        }
    }
});
