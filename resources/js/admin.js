document.addEventListener("DOMContentLoaded", () => {

    // Aplicar descuento global
    const formDesc = document.getElementById("formDescuento");
    if (formDesc) {
        formDesc.addEventListener("submit", e => {
            if (!confirm("¿Aplicar descuento a todos los productos?")) {
                e.preventDefault();
            }
        });
    }

    // Gráfico de ventas
    const canvas = document.getElementById("graficoVentas");
    if (canvas) {
        const ctx = canvas.getContext("2d");

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: window.labelsProductos,
                datasets: [{
                    label: "Ventas",
                    data: window.ventasProductos,
                    backgroundColor: "rgba(255, 159, 64, 0.7)"
                }]
            }
        });
    }

});
