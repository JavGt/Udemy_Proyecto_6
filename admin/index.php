<?php 
    // Importar la conexion
    require '../includes/config/database.php';
    $conexion = conectarDB();

    // Escribir el query
    $query = "SELECT * FROM propiedades";

    // Consultar la base de datos
    $resultadoConsulta = mysqli_query($conexion, $query);

    // Muestra mensaje adicional
    $resultado = $_GET['resultado'] ?? null; 
    $casa = $_GET['casa'] ?? null; 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if ($id) {
            // Eliminar el archivo 
            $query = "SELECT Imagen FROM propiedades WHERE id = ${id}";
            $resultado = mysqli_query($conexion, $query);
            $propiedad = mysqli_fetch_assoc($resultado) ;
            unlink('../imagenes/' . $propiedad['Imagen']);

            // Eliminar la propiedad
            $query = "DELETE FROM propiedades WHERE id = ${id}";
            $resultado = mysqli_query($conexion, $query);
            if ($resultado) {
                header('Location:/admin?resultado=3');
            }
        }
    }
    
    // Incluye un template
    require '../includes/funciones.php';
    incluirTemplates('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php if ( intval( $resultado ) === 1 ) :?>
            <p class="alerta exito" >"<?php echo $casa; ?>" Creado Correctamente</p>  

        <?php elseif( intval( $resultado ) === 2 ) : ?>
        <p class="alerta exito" >"<?php echo $casa; ?>" Actualizado Correctamente</p>  

        <?php elseif( intval( $resultado ) === 3 ) : ?>
        <p class="alerta error" > Borrado Correctamente</p>  

        <?php endif; ?>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody> <!--Mostrar los resultados-->
            <?php  while ( $row = mysqli_fetch_assoc($resultadoConsulta)  ) :?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['Titulo']; ?></td>
                    <td><img src="/imagenes/<?php echo$row['Imagen'];?>" alt="" class="imagen-tabla" ></td>
                    <td>$<?php echo $row['Precio']; ?></td>
                    <td>
                        <form action="" method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar" ></input>
                        </form>
                        <a href="/admin/propiedades/actualizar.php?id=<?php echo $row['id']; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
                
            </tbody>
        </table>
    </main>

<?php 
    // Cerrar la conexión
    mysqli_close($conexion);


    incluirTemplates('footer'); 
?>

