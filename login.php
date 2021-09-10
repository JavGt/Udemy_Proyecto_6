<?php 
    // inportar la base datos
    require 'includes/config/database.php';
    $conexion = conectarDB();
    
    // Autenticar en usuario

    $errores = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        $email = mysqli_real_escape_string($conexion, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) );
        // var_dump($email);

        $password = mysqli_real_escape_string($conexion, $_POST['password']) ;

        if (!$email) {
            $errores[] = "El email no es valido";
        }if (!$password) {
            $errores[] = "El password no es valido";
        }

        if (empty($errores)) {
            // Revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE Email = '${email}' ";
            $resultado =  mysqli_query($conexion, $query);

            if ( $resultado->num_rows) {
                // Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);
                // var_dump($usuario);

                // Verificar si el password es correcto o no 
                $auth = password_verify( $password, $usuario['Password'] );

                if ($auth) {
                    // El usuario esta autenticado
                    session_start();

                    // Llenar el arreglo de sesion
                    $_SESSION['usuario'] = $usuario['id'];
                    $_SESSION['login'] = true;

                    header("Location: /admin");

                    // echo "<pre>";
                    // var_dump($_SESSION);
                    // echo "</pre>";


                }else{
                    $errores [] = 'Contraseña incorrecta';
                }

            } else{
                $errores [] = 'El usuario no existe';
            }
        }
    }


    require 'includes/funciones.php';
    incluirTemplates('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Inciar Sesion</h1>

        <?php foreach ($errores as $error) :?>
            <div class="alerta error" ><?php echo $error;?></div>
        <?php endforeach; ?>

        <form method="POST" action="" class="formulario">
        <fieldset>        
                <legend>Email y Password</legend>

                <label for="email">E-mail:</label>
                <input type="email" id="email" placeholder="Tu Correo" name="email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" placeholder="Tu password" name="password" required>

            </fieldset>
            <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
        </form>
    </main>

<?php incluirTemplates('footer'); ?>

