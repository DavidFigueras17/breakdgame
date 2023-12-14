<?php
session_start();
session_destroy();
// Puedes realizar otras tareas de limpieza si es necesario
echo 'Sesión cerrada exitosamente';
?>