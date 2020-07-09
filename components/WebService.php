<?php
namespace app\components;

class WebService {

    const UBICACION_URI = 'https://apis.datos.gob.ar/georef/api/ubicacion';

    /**
     * Devuelve la ubicacion a partir de la
     * latitud y la longitud ingresada
     * @param int $lat Latitud
     * @param int $long Longitud
     */
    public static function getUbicacion($lat, $long)
    {
        $url = self::UBICACION_URI;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "$url?lat=$lat&lon=$long");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);
    
        return json_decode($result, true);
    }

}