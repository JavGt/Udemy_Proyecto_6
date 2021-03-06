<?php 
    require 'includes/funciones.php';
    incluirTemplates('header');

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if (!$id) {
        header('Location: /');
    }

    // Importar la conexión
    require 'includes/config/database.php';
    $conexion = conectarDB();

    // Consultar 
    $query = "SELECT * FROM propiedades WHERE id = ${id}";

    // Leer los resultados
    $resultado = mysqli_query($conexion, $query);

    if (!$resultado->num_rows) {
        header('Location: /');
    }

    $row = mysqli_fetch_assoc($resultado);

?>

    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $row['Titulo'];?></h1>

        <img  loading="lazy" src="/imagenes/<?php echo $row['Imagen'];?>" alt="Anuncio ">

        <div class="resumen-propiedad">
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
            <p><?php echo $row['Descripcion'];?></p>
        
        </div>
    </main>
    
<?php 

    // Cerrar la conexión
    mysqli_close($conexion);

    incluirTemplates('footer'); 
?>

