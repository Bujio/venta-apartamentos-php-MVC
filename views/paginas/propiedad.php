<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad->titulo; ?></h1>


    <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen de la propiedad">

    <div class="resumen-propiedad">
        <p class="precio"><?php
                            $string = $propiedad->precio;
                            $string = str_replace(['.00', ''], '', $string);
                            // Inserta un punto cada tres caracteres comenzando desde el final
                            $string = implode('.', str_split(strrev($string), 3));

                            // Invierte nuevamente el string para obtener el formato deseado
                            $string = strrev($string);

                            echo $string;

                            ?> €</p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad->wc; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p><?php echo $propiedad->estacionamiento; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                <p><?php echo $propiedad->habitaciones; ?></p>
            </li>
        </ul>

        <?php echo $propiedad->descripcion; ?>
    </div>
    <a href="/propiedades" class="boton-verde uppercase">Ver otras propiedades</a>
</main>