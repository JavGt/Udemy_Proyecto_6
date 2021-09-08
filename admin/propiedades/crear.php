<?php 
    // Base de datos
    require '../../includes/config/database.php';
    $conexion = conectarDB();

    // Consultar para obtener los vendedores

    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($conexion, $consulta);

    // Arreglo por mensajes de errores
    $errores = [];

    $titulo = '' ;
    $precio = '' ;
    $descripcion = '' ;
    $habitaciones = '' ;
    $wc = '' ;
    $estacionamiento = '' ;
    $vendedor = '' ;


    // Ejecuta el codigo despues de que el usuario envie el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        $titulo = $_POST['titulo'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $habitaciones = $_POST['habitaciones'];
        $wc = $_POST['wc'];
        $estacionamiento = $_POST['estacionamiento'];
        $vendedor = $_POST['vendedor'];
        $fecha = date('Y/m/d');

        if (!$titulo) {
            $errores[] = 'Debes añadir un titulo';
        }if (!$precio) {
            $errores[] = 'Debes añadir un precio';
        }if (strlen($descripcion) < 50) {
            $errores[] = 'Debe tener al menos 50 caracteres';
        }if (!$habitaciones) {
            $errores[] = 'Debes añadir una habitaciones';
        }if (!$wc) {
            $errores[] = 'Debes añadir un Baño';
        }if (!$estacionamiento) {
            $errores[] = 'Debes añadir un estacionamiento';
        }if (!$vendedor) {
            $errores[] = 'Debes añadir un vendedor';
        }
        
        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";

        // Revisas si ya no tiene errores
        if (empty($errores)) {
            // Insertar en la base de datos
            $query = "INSERT INTO propiedades (Titulo, Precio, Descripcion, Habitaciones, WC, Estacionamineto, Creado, idVendedor) 
                    VALUES ( '$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$fecha', '$vendedor') ";

            // echo $query;
            $resultado = mysqli_query($conexion, $query);

            if ($resultado) {
                header('Location:/admin');
            }
        }
    }
    
    // Templates de header
    require '../../includes/funciones.php';
    incluirTemplates('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Crear</h1>

        <a href="../index.php" class="boton boton-verde">Volver</a>
        
        <?php foreach($errores as $error): ?>

        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>
        
        <form action="" class="formulario" method="POST" action="/admin/propiedades/crear.php" >
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" name="titulo" id="titulo" placeholder="Titulo propiedad" value="<?php echo $titulo; ?>" >

                <label for="precio">Precio:</label>
                <input type="number" name="precio" id="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>" >

                <label for="imagen">Imagen:</label>
                <input type="file" name="" id="imagen" accept="image/jpeg, image/png"> 

                <label for="descripcion">Descripcion:</label>
                <textarea name="descripcion" id="descripcion" ><?php echo $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Información de la propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" name="habitaciones" id="habitaciones"min="1" max="9" placeholder="Ejemplo: 3" value="<?php echo $habitaciones; ?>" >

                <label for="wc">Baños:</label>
                <input type="number" name="wc" id="wc"min="1" max="9" placeholder="Ejemplo: 2" value="<?php echo $wc; ?>" >

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" name="estacionamiento" id="estacionamiento"min="1" max="9" placeholder="Ejemplo: 1" value="<?php echo $estacionamiento; ?>" >
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <input name="vendedor" type="text" list="mylist" placeholder="-- Seleccione --" value="<?php echo $vendedor; ?>" >

                <datalist id="mylist">
                    <?php while ( $row = mysqli_fetch_assoc($resultado) ) : ?>
                        <option value="<?php echo $row['id'] ?>"> <?php  echo $row['Nombre'] ." ". $row['Apellido'] ;?> </option>
                    <?php endwhile; ?>
                </datalist>
            </fieldset>
            <input type="submit" name="" id="" value="Crear Propiedad" class="boton boton-verde">
            
        </form>

    </main>

<?php incluirTemplates('footer'); ?>

