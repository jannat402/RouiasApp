document.addEventListener("DOMContentLoaded", () => {

    const botones = document.querySelectorAll(".btn-ver-mas");
    const modal = document.getElementById("modalProducto");
    const contenido = document.getElementById("modalContenido");
    const cerrar = document.getElementById("cerrarModal");

    if (!modal) return;

    botones.forEach(btn => {
        btn.addEventListener("click", () => {

            fetch(`/producto/${btn.dataset.id}/ajax`)
                .then(res => res.json())
                .then(data => {

                    contenido.innerHTML = `
                        <img src="${data.imagen}" class="w-full h-48 object-contain mb-4">
                        <h2 class="text-2xl font-bold text-orange-700">${data.nombre}</h2>
                        <p class="mt-2 text-gray-700">${data.descripcion}</p>
                        <p class="mt-3 font-bold text-orange-600 text-xl">${data.precio} €</p>
                        <p class="mt-2 text-sm text-gray-600">
                            Categoría: <strong>${data.categoria}</strong><br>
                            Subcategoría: <strong>${data.subcategoria}</strong>
                        </p>
                    `;

                    modal.classList.remove("hidden");
                    modal.classList.add("flex");
                });
        });
    });

    cerrar.addEventListener("click", () => {
        modal.classList.add("hidden");
        modal.classList.remove("flex");
    });

    modal.addEventListener("click", e => {
        if (e.target === modal) {
            modal.classList.add("hidden");
            modal.classList.remove("flex");
        }
    });
});
