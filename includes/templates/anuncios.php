<?php 
    // Importar la conexión
    require 'includes/config/database.php';
    $conexion = conectarDB();

    // Consultar 
    $query = "SELECT * FROM propiedades LIMIT ${limite}";

    // Leer los resultados
    $resultado = mysqli_query($conexion, $query);
?>
<div class="contenedor-anuncios">
    <?php while ( $row = mysqli_fetch_assoc($resultado) ) : ?>
             
    <div class="anuncio">
            
        <img  loading="lazy" src="/imagenes/<?php echo $row['Imagen'];?>" alt="Anuncio ">

        <div class="contenido-anuncio">
            <h3><?php echo $row['Titulo'];?></h3>
            <p><?php echo $row['Descripcion'];?></p>
            <p class="precio">$<?php echo $row['Precio'];?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $row['WC'];?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $row['Estacionamiento'];?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                    <p><?php echo $row['Habitaciones'];?></p>
                </li>
            </ul>

            <a class="boton-amarillo-block" href="anuncio.php?id=<?php echo $row['id'];?>">Ver Propiedad</a>

        </div><!--.contenido-anuncio-->
    </div><!--.anuncio-->

    <?php endwhile; ?>

</div><!--.contenedor-anuncios-->

<?php 
    // Cerrar la conexión
    mysqli_close($conexion);
?>