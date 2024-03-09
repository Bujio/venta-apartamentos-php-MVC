<div class="contenedor-anuncios">
    <?php foreach ($propiedades as $propiedad) : ?>
        <div class="anuncio">
            <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="anuncio">

            <div class="contenido-anuncio">
                <h3 class="line-clamp-title module uppercase"><?php echo $propiedad->titulo; ?></h3>
                <p class="line-clamp module"><?php echo $propiedad->descripcion; ?></p>
                <p class="precio"><?php $string = $propiedad->precio;
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

                <a href="propiedad?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">
                    Ver Propiedad
                </a>
            </div><!--.contenido-anuncio-->
        </div><!--anuncio-->
    <?php endforeach; ?>
</div> <!--.contenedor-anuncios-->