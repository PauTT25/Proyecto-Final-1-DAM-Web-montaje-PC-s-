<?php
    // 1. Conexión (Asegúrate de que conexion.php esté en esta misma carpeta)
    include "conexion.php"; 

    // 2. Consulta a la tabla
    $sql = "SELECT * FROM noticias";
    $resultado = $conexion->query($sql);

    // 3. Generación del HTML para el Admin
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            echo '
            <article class="tarjeta-producto">
                <div style="text-align: right; color: #0327f5; font-weight: bold; font-size: 1.1rem;">
                    ID: #'.$fila['id'].'
                </div>

                <h4>'.$fila['titulo'].'</h4>
                
                <div style="font-size: 1.2rem; color: #666; margin-bottom: 1.5rem;">
                    <time>'.$fila['fecha_publicacion'].'</time>
                </div>
                
                <p style="font-size: 1.4rem; color: #555; margin-bottom: 2rem;">
                    '.substr($fila['contenido'], 0, 80).'... 
                </p>
                
                <div style="display: flex; gap: 1rem; justify-content: center;">
                    <a href="editar.php?id='.$fila['id'].'" class="btn btn-principal" style="padding: 0.8rem 1.5rem; font-size: 1.3rem; margin-top: 0;">Editar</a>
                    
                    <a href="includes/borrar.php?id='.$fila['id'].'" 
                       class="btn btn-principal" 
                       style="background-color: #d9534f; border:none; padding: 0.8rem 1.5rem; font-size: 1.3rem; margin-top: 0; box-shadow: none;"
                       onclick="return confirm(\'¿Estás seguro de que deseas eliminar este artículo?\')">
                       Borrar
                    </a>
                </div>
            </article>
            ';
        }
    } else {
        echo "<p style='color: white; font-size: 1.8rem; text-align: center; width: 100%;'>No hay registros disponibles.</p>";
    }
?>