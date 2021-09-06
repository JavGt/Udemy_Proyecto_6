<?php 
    require 'includes/funciones.php';
    incluirTemplates('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Case de venta frente al bosque</h1>
        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="Imagen de Propiedad">
        </picture>
        <div class="resumen-propiedad">
            <p class="precio">$3,000,000</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                    <p>4</p>
                </li>
            </ul>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut repellat soluta nisi ea. Recusandae nobis possimus, culpa nam rem aliquam laborum molestias voluptates! Eum maiores perspiciatis esse consequuntur tenetur hic.
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus, commodi veritatis obcaecati deserunt vero atque, animi asperiores adipisci tempora recusandae modi officia! Id voluptatum aperiam consequatur modi, molestias laboriosam corporis.
            </p>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Vitae, fugiat non sint perferendis sequi, porro placeat soluta excepturi error maiores dolorum eaque deleniti, quam expedita rerum animi corporis facere velit!
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Omnis fugiat, laboriosam pariatur illo aliquid rerum corporis enim illum facere nulla eligendi reiciendis quae, ea, voluptates tempore harum distinctio modi magni!
            </p>
        
        </div>
    </main>
    
<?php incluirTemplates('footer'); ?>

