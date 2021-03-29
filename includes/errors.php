<?php

/**
 * Clase que maneja los errores del sistema.
 */
class Errors {

    /**
     * Obtiene la descripción del error especificado.
     * 
     * @param type $error El código de error
     * @return string La descripción del error
     */
    public static function get_error($error) {
        switch ($error) {
            case 0: return "Para continuar, por favor inicie sesión.";
            case 1: return "Por favor llene todos los campos antes de continuar.";
            case 2: return "Usuario no encontrado. Por favor verifique sus datos e intente de nuevo.";
            case 3: return "Paciente no encontrado. Por favor verifique sus datos e intente de nuevo.";
            case 4: return "No se encontró ningún paciente con la información proporcionada. Por favor verifique sus datos e intente de nuevo.";
            case 5: return "Por favor llene el campo solicitado antes de continuar.";
            case 6: return "Por favor llene los campos solicitados antes de continuar.";
            case 98: return "No se han registrado usuarios del sistema (especialistas), por favor contacte al administrador.";
            case 99: return "No se encontró ningún usuario en la base de datos. Por favor contacte al administrador.";
            case 100: return "Error de conexión con la base de datos. Por favor contacte al equipo de desarrollo. Código de error: 100";
            case 1062: return "El ID especificado ya se encuentra ocupado, por favor elija otro.";
            case 1064: return "Error de datos, por favor verifique el formato de los datos.";
        }
    }

    /**
     * Redirige hacia otra página y envía un código de error.
     * 
     * @param type $pagina La página a redirigir
     * @param type $error El código de error
     */
    public static function mostrar_error($pagina, $error) {
        Errors::redirect("$pagina?error=$error");
    }

    /**
     * Redirige hacia otra página.
     */
    public static function redirect($page) {
        echo("<script>location.href='$page'</script>");
    }

}
