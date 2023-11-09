<?php 
// En un helper o archivo separado, por ejemplo, app/Helpers/AuthHelper.php

if (!function_exists('usuario_autenticado')) {
    function usuario_autenticado()
    {
        // Lógica para verificar si el usuario está autenticado
        // Por ejemplo, si estás utilizando CodeIgniter's session, puedes hacer algo como:
        return session()->get('isLoggedIn') === true;
    }
}




?>