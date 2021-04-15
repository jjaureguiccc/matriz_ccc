<?php

$Ruta=Rutas::ctrlRuta();
session_destroy();
echo '<script>
window.location = "'.$Ruta.'";
</script>';
