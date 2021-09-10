<?php 

    // Validar que sea un id valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header('Location:/admin');
    }

    // Base de datos
    require '../../includes/config/database.php';
    $conexion = conectarDB();

    // Consulta para obtener las propiedades
    $queryPropiedades = "SELECT * FROM propiedades WHERE id = ${id}";
    $resultadoPropiedades = mysqli_query($conexion, $queryPropiedades);
    $propiedad = mysqli_fetch_assoc($resultadoPropiedades);



    // Consultar para obtener los vendedores
    $query = "SELECT * FROM vendedores";
    $resultado = mysqli_query($conexion, $query);

    // Arreglo por mensajes de errores
    $errores = [];

    $titulo = $propiedad['Titulo'];
    $precio = $propiedad['Precio'] ;
    $descripcion = $propiedad['Descripcion'] ;
    $habitaciones = $propiedad['Habitaciones'] ;
    $wc = $propiedad['WC'] ;
    $estacionamiento = $propiedad['Estacionamiento'] ;
    $vendedor = $propiedad['idVendedor'] ;
    $imagenPropiedad = $propiedad['Imagen'] ;

    // Ejecuta el codigo despues de que el usuario envie el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        // echo "<pre>";
        // var_dump($_FILES);
        // echo "</pre>";

        $titulo = mysqli_real_escape_string( $conexion, $_POST['titulo'] );
        $precio = mysqli_real_escape_string( $conexion, $_POST['precio'] );
        $descripcion = mysqli_real_escape_string( $conexion, $_POST['descripcion'] );
        $habitaciones = mysqli_real_escape_string( $conexion, $_POST['habitaciones'] );
        $wc = mysqli_real_escape_string( $conexion, $_POST['wc'] );
        $estacionamiento = mysqli_real_escape_string( $conexion, $_POST['estacionamiento'] );
        $vendedor = mysqli_real_escape_string( $conexion, $_POST['vendedor'] );
        $fecha = date('Y/m/d');

        // Asignar Files hacia una variable
        $imagen =$_FILES['imagen'];

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

        // Validar por tamaño (1 mb)
        $medida = 1000 * 1000;

        if ($imagen['size'] > $medida) {
            $errores[] = 'La imagen debe pesar maximo 1mb';
        }
        
        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";

        // Revisas si ya no tiene errores
        if (empty($errores)) {

            // Crear una carpeta 
            $carpetaImagenes = '../../imagenes/';

            if (!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }

            $nombreImagen= "";

            // ------Subida de archivos------
            if ($imagen['name']) {
                // Si hay una imagen
                unlink($carpetaImagenes.$propiedad['Imagen']);
                
                // Generar un nombre único
                $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

                // Subir la imagen 
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen );
                echo "hay imagen nueva";

            }else{
                $nombreImagen = $propiedad['Imagen'];  
                echo "No hay imagen nueva";
            }
            
            // Insertar en la base de datos
            $query = "UPDATE  propiedades SET 
            Titulo = '${titulo}', 
            Precio = '${precio}', 
            Imagen = '${nombreImagen}', 
            Descripcion = '${descripcion}', 
            Habitaciones = ${habitaciones},
            WC = ${wc},
            Estacionamiento = ${estacionamiento},
            Creado = '${fecha}',
            idVendedor = ${vendedor}
            WHERE id = ${id} ";
            
            // echo "<pre>";
            // echo var_dump($query);
            // echo "</pre>";

            // exit;

            // echo $query;
            $resultado = mysqli_query($conexion, $query);

            if ($resultado) {
                header('Location:/admin?resultado=2&casa='. $titulo);
            }
        }
    }
    
    // Templates de header
    require '../../includes/funciones.php';
    incluirTemplates('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Actualizar</h1>

        <a href="../index.php" class="boton boton-verde">Volver</a>
        
        <?php foreach($errores as $error): ?>

        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>
        
        <form class="formulario" method="POST" enctype="multipart/form-data" >
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" name="titulo" id="titulo" placeholder="Titulo propiedad" value="<?php echo $titulo; ?>" >

                <label for="precio">Precio:</label>
                <input type="number" name="precio" id="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>" >

                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" id="imagen" accept="image/jpeg, image/png"> 

                <img src="/imagenes/<?php echo $imagenPropiedad ?>" class="imagen-pequeña">

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
            <input type="submit" name="" id="" value="Actualizar Propiedad" class="boton boton-verde">
            
        </form>

    </main>

<?php incluirTemplates('footer'); ?>

