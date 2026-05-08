

<?php $__env->startSection('content'); ?>

<h1 class="text-3xl font-bold mb-6">Gráfico de ventas por producto</h1>

<canvas id="myCanvas" style="border:1px solid #000000;"></canvas>

<div id="contenidor-lista" class="mt-6">
    <ul id="lista-elementos"></ul>
</div>

<!-- JS -->
<script>
    // Datos enviados desde Laravel
    const dades = <?php echo json_encode($ventas, 15, 512) ?>;
    const nombres = <?php echo json_encode($nombres, 15, 512) ?>;

    // funcion para añadir colores
    function generarColores(num) {
        const colores = [];
        for (let i = 0; i < num; i++) {
            const r = Math.floor(Math.random() * 200);
            const g = Math.floor(Math.random() * 200);
            const b = Math.floor(Math.random() * 200);
            colores.push(`rgb(${r}, ${g}, ${b})`);
        }
        return colores;
    }

    const colors = generarColores(dades.length);

    const canvas = document.getElementById('myCanvas');
    canvas.width = 500;
    canvas.height = 500;
    const contexto = canvas.getContext('2d');

    class Grafica {
        // constructor con los parametros
        constructor(canvas, context, dades, titol, colors) {
            this.canvas = canvas;
            this.context = context;
            this.dades = dades;
            this.titol = titol;
            this.colors = colors;
        }

        dibujar() {
            // variables con los margenes en cada lado
            const margenIzq = 20;
            const margeDere = 20;
            const margeSup = 20;
            const margeInf = 20;
            // variables con el ancho y alto del canvas
            const anchoCanvas = this.canvas.width;
            const altCanvas = this.canvas.height;
            // variables con el ancho y alto Utlies
            const anchoUtil = anchoCanvas - margenIzq - margeDere;
            const altoUtil = altCanvas - margeSup - margeInf;
            
            // constantes con el numero de barras que hay y el ancho de estas
            const numBarras = this.dades.length;
            const anchoBarras = anchoUtil / numBarras;

            // Encontrar el numero maximo 
            let max = Math.max(...this.dades);

            // le doy estilo al contexto para poner un titulo
            this.context.fillStyle = "black";
            this.context.font = "14px Arial";
            this.context.textAlign = "center";

            // añado un texto al final de la grafica , que es el tiulo
            this.context.fillText(
                this.titol,
                this.canvas.width / 2,
                this.canvas.height - 6
            );

            this.dibujarLineas(margenIzq, margeSup, anchoUtil, altoUtil, max);

            for (let i = 0; i < numBarras; i++) {
                // variable que obtiene el numero del array de datos segun su posicion
                const valor = this.dades[i];
                const color = this.colors[i % this.colors.length];

                const altBarra = (valor / max) * altoUtil;
                // x reresenta la posicion en la que quiero las barras
                const x = margenIzq + i * anchoBarras;
                // y representa la altura inicial en la que quiero las barras
                const y = altCanvas - margeInf - altBarra;
                // llamo a la funcion que dibuja las barras , que recipe los parametros necesarios
                // el contexto, x , y , anchoBarras, altBarra, color
                this.dibujarBarra(this.context, x, y, anchoBarras, altBarra, color);
            }

            // llamo a la funcion generarLista para que salga la lista
            this.generarLista();
        }

        // funcion para dibujar las barras
        dibujarBarra(context, x, y, ample, alt, color) {
            context.fillStyle = color;
            context.fillRect(x, y, ample, alt);
        }

        // funcion para crear la lista
        generarLista() {
            const lista = document.getElementById("lista-elementos"); 
            // para escribir en el html
            lista.innerHTML = "";
            // for para crear la leyenda con el color que corresponde a cada barra
            // con el valor que corresponde del array dades
            for (let i = 0; i < this.dades.length; i++) {
                // creo variables para tener el valor del array de cada posicion
                const valor = this.dades[i];
                // crea variable para obtener el color que corresponde
                const color = this.colors[i % this.colors.length];
                // creo la etiqueta li dentro de lista-elementos
                const li = document.createElement("li");
                li.style.borderLeft = `15px solid ${color}`;
                // para tener un espacio entre el texto y texto
                li.style.marginBottom = "10px";
                // para tener un espacio entre el texto y el color
                li.innerHTML = `<span style="margin-left:8px;">${nombres[i]} (${valor})</span>`;            // utlizo el appendChild para que el colo y el texto de Valor salga dentro 
                // del contenedor lista-elementos
                lista.appendChild(li);
            }
        }

        // funcion que dibuja las lineas
        dibujarLineas(margenIzq, margeSup, anchoUtil, altoUtil, max) {
            // creo variable con el numero de lineas que quiero
            const pasos = 6; 
            // creo variable que representa el valor de cada linea 
            const pasoValor = max / pasos; 
            // creo variable con la altura entre cada línea en píxeles 
            const pasoAltura = altoUtil / pasos; 

            // el estylo de estas linias
            this.context.strokeStyle = "#cccccc"; 
            this.context.lineWidth = 1; 
            this.context.font = "10px Arial"; 
            // el color de los números
            this.context.fillStyle = "gray"; 
            // quiero que el numero quede a la derecha
            this.context.textAlign = "right"; 
            
            // for para generar la linias
            for (let i = 0; i <= pasos; i++) {
                // creo variable que representa la posicion vertical de cada línea
                const y = margeSup + i * pasoAltura; 
                // creo variable que representa el numero de la linea (de mayor a menor)
                const valor = Math.round(max - i * pasoValor); 
                // empiezo una nueva línea
                this.context.beginPath(); 
                // coordinas de donde empieza desde el margen izquierdo
                this.context.moveTo(margenIzq, y); 
                // coordinadas de donde acaba la línea (hasta el ancho útil)
                this.context.lineTo(margenIzq + anchoUtil, y); 
                // dibuja la linea
                this.context.stroke(); 
                // escribe el número a la izquierda de la línea
                this.context.fillText(valor, margenIzq - 5, y + 3); 
            }
        }
    }

    // Crear y dibujar la gráfica
    const grafica = new Grafica(canvas, contexto, dades, "Ventas por producto", colors);
    grafica.dibujar();
    
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pepe\Documents\GitHub\RouiasApp\resources\views/admin/grafico.blade.php ENDPATH**/ ?>