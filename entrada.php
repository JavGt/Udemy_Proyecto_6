<?php 
    require 'includes/funciones.php';
    incluirTemplates('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Guía para la decoración de tu hogar</h1>
        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada2.jpg" alt="Imagen de Propiedad">
        </picture>
        <p class="informacion-meta">Escrito el: <span>20 de Octubre del 2021</span> por: <span>Admin</span></p>

        <div class="resumen-propiedad">            
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut repellat soluta nisi ea. Recusandae nobis possimus, culpa nam rem aliquam laborum molestias voluptates! Eum maiores perspiciatis esse consequuntur tenetur hic.
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus, commodi veritatis obcaecati deserunt vero atque, animi asperiores adipisci tempora recusandae modi officia! Id voluptatum aperiam consequatur modi, molestias laboriosam corporis.
            </p>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Vitae, fugiat non sint perferendis sequi, porro placeat soluta excepturi error maiores dolorum eaque deleniti, quam expedita rerum animi corporis facere velit!
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Omnis fugiat, laboriosam pariatur illo aliquid rerum corporis enim illum facere nulla eligendi reiciendis quae, ea, voluptates tempore harum distinctio modi magni!
            </p>
        
        </div>
    </main>

<?php incluirTemplates('footer'); ?>
