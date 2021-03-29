<?php

/**
 * Realiza conversiones de fechas y horas.
 */
class FechaHora {
    /**
     * Convierte un día en inglés a español.
     * 
     * @param type $d El día en inglés
     * @return string El día en español
     */
    public static function dia($d) {
        if ($d == "Monday") {
            return "Lunes";
        }
        if ($d == "Tuesday") {
            return "Martes";
        }
        if ($d == "Wednesday") {
            return "Miércoles";
        }
        if ($d == "Thursday") {
            return "Jueves";
        }
        if ($d == "Friday") {
            return "Viernes";
        }
        if ($d == "Saturday") {
            return "Sábado";
        }
        if ($d == "Sunday") {
            return "Domingo";
        }
    }

    /**
     * Convierte un mes en inglés a español.
     * 
     * @param type $m El mes en inglés
     * @return string El mes en español
     */
    public static function mes($m) {
        if ($m == "January") {
            return "Enero";
        }
        if ($m == "February") {
            return "Febrero";
        }
        if ($m == "March") {
            return "Marzo";
        }
        if ($m == "April") {
            return "Abril";
        }
        if ($m == "May") {
            return "Mayo";
        }
        if ($m == "June") {
            return "Junio";
        }
        if ($m == "July") {
            return "Julio";
        }
        if ($m == "August") {
            return "Agosto";
        }
        if ($m == "September") {
            return "Setiembre";
        }
        if ($m == "October") {
            return "Octubre";
        }
        if ($m == "November") {
            return "Noviembre";
        }
        if ($m == "December") {
            return "Diciembre";
        }
    }

    public static function hoy() {
        date_default_timezone_set('America/Monterrey');
        return date("Y") . "-" . date("m") . "-" . date("d");
    }
    
    public static function hoyl() {
        return FechaHora::dia(date("l")) . " " . date("j") . " de " .
                        FechaHora::mes(date("F")) . " de " . date("Y");
    }
}
