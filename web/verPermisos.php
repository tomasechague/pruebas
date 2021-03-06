<?php
require("../scripts/acceso.php");
tieneAcceso('permisos_listar');


require_once("../functions/funciones.php");
?>

<!DOCTYPE html>

<html>
    <head>
        <?php
        $rootpath = $_SERVER['DOCUMENT_ROOT'];

        $path = $rootpath . '/pruebas/_partials/head.php';
        include_once($path);
        ?>
        <script src="js/permisos.js" type="text/javascript"></script>
    </head>
    <body>

        <?php
        $path = $rootpath . '/pruebas/_partials/header.php';
        include_once($path);

        $path = $rootpath . '/pruebas/_partials/menu.php';
        include_once($path);
        $path = $rootpath . '/pruebas/functions/funciones.php';
        include_once($path);
        ?>

        <div>
            <?php if (tienePermiso($_SESSION['usuario'], 'permisos_agregar')) { ?>
                <a href="agregarPermiso.php" class="btn btn-info">Agregar Permiso</a>
            <?php } ?>
            <br>
            <br/>

            <input type="hidden" value="id" id="ordenActual">
            <input type="hidden" value="ASC" id="direccionActual">
            <input type="hidden" value="1" id="paginaActual">


            <input type="text" placeholder="Buscar" id="busqueda" name="busqueda" onkeyup="listPermisos()">


            <br/><br/>
            <label>Items Pagina</label>    
            <select id="cantItems">
                <option value="5" selected>5</option>
                <option value="10">10</option>
                <option value="20">20</option>
            </select>

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>    
                <tbody id="body-permisos"> 


                </tbody>
            </table>
        </div>

        <div>
            <ul class="pagination">


            </ul>

        </div> 
        <?php
        $path = $rootpath . '/pruebas/_partials/footer.php';
        include_once($path);
        ?>
        <script>
            $(document).ready(function () {
                listPermisos();
            });


            $('#cantItems').change(function () {
                listPermisos();
            });
        </script>

    </body>
</html>