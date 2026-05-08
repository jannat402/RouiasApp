document.addEventListener("DOMContentLoaded", () => {

    // Si NO está logueado → usar localStorage
    let carrito = JSON.parse(localStorage.getItem("carrito")) || [];

    const actualizarLocalStorage = () => {
        localStorage.setItem("carrito", JSON.stringify(carrito));
    };

    //PINTAR CARRITO DE INVITADO
    if (!window.isLoggedIn) {
        const contenedor = document.getElementById("carrito-invitado");

        if (carrito.length === 0) {
            contenedor.innerHTML = `<p class="text-gray-600">Tu carrito está vacío.</p>`;
        } else {
            contenedor.innerHTML = "";

            carrito.forEach(item => {
                contenedor.innerHTML += `
                    <div class="flex justify-between items-center border-b py-4">

                        <div>
                            <p class="font-bold text-lg">${item.nombre}</p>
                            <p class="text-gray-600">${item.precio.toFixed(2)} €</p>
                        </div>

                        <div class="flex items-center gap-3">
                            <button class="btn-menos bg-gray-300 px-2 rounded" data-id="${item.id}">-</button>
                            <span class="font-bold">${item.cantidad}</span>
                            <button class="btn-mas bg-gray-300 px-2 rounded" data-id="${item.id}">+</button>
                        </div>

                        <div class="font-bold text-orange-700">
                            ${(item.precio * item.cantidad).toFixed(2)} €
                        </div>

                        <button class="btn-eliminar bg-red-600 text-white px-3 py-1 rounded" data-id="${item.id}">
                            Eliminar
                        </button>

                    </div>
                `;
            });
        }
    }

    // BOTÓN SUMAR
    document.querySelectorAll(".btn-mas").forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id;

            if (!window.isLoggedIn) {
                const item = carrito.find(p => p.id == id);
                if (item) item.cantidad++;
                actualizarLocalStorage();
                location.reload();
                return;
            }

            fetch('/carrito/agregar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.csrfToken
                },
                body: JSON.stringify({ id })
            }).then(() => location.reload());
        });
    });

    // BOTÓN RESTAR
    document.querySelectorAll(".btn-menos").forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id;

            if (!window.isLoggedIn) {
                const item = carrito.find(p => p.id == id);
                if (item && item.cantidad > 1) item.cantidad--;
                actualizarLocalStorage();
                location.reload();
                return;
            }

            fetch('/carrito/agregar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.csrfToken
                },
                body: JSON.stringify({ id, restar: true })
            }).then(() => location.reload());
        });
    });

    // BOTÓN ELIMINAR
    document.querySelectorAll(".btn-eliminar").forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id;

            if (!window.isLoggedIn) {
                carrito = carrito.filter(p => p.id != id);
                actualizarLocalStorage();
                location.reload();
                return;
            }

            fetch('/carrito/eliminar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.csrfToken
                },
                body: JSON.stringify({ id })
            }).then(() => location.reload());
        });
    });
});
