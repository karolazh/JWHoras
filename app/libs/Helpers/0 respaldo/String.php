<?php

class String {

    static private function _nextChar() {
        return base_convert(mt_rand(0, 35), 10, 36);
    }
    
    /**
     * Elimina de la cadena todos los caracteres no numericos
     * @param string $string
     * @return string
     */
    static public function dejarSoloNumeros($string){
        $filter = new Zend_Filter_Digits();
        return $filter->filter($string);
    }
    
    /**
     * Elimina numeros de una cadena
     * @param string $string
     * @return string
     */
    static public function quitarNumero($string){
        $filter = new Zend_Filter_Digits();
        $numero = $filter->filter($string);
        return str_replace($numero, "", $string);
    }
    
    /**
     * 
     * @param string $string1
     * @param string $string2
     * @return string
     */
    static public function juntarConComa($string1, $string2 = null){
        if(!empty($string2)){
            return $string1 . ", " . $string2;
        } else {
            return $string1;
        }
    }
    
    /**
     * Borra de un texto lo contenido entre 2 tags
     * @param string $texto
     * @param string $texto_inicio
     * @param string $texto_termino
     * @return string
     */
    static public function quitarTextoEntreTags($texto, $texto_inicio, $texto_termino){
        $cadena_termino = $texto_termino;
        $posicion_inicio = strpos($texto, $texto_inicio);
        $posicion_termino = strpos($texto, $cadena_termino);

        return substr($texto, 0, $posicion_inicio) . 
               substr($texto, $posicion_termino + strlen($cadena_termino), strlen($texto));
    
    }
    
    /**
     * Recupera el texto entre tags
     * @param string $texto
     * @param string $texto_inicio
     * @param string $texto_termino
     * @return string
     */
    static public function textoEntreTags($texto, $texto_inicio, $texto_termino){
        $cadena_termino = $texto_termino;
        $posicion_inicio = strpos($texto, $texto_inicio);
        $posicion_termino = strpos($texto, $cadena_termino);
        
        $correcto = true;
        if($posicion_inicio === false){
            $correcto = false;
        }
        
        if($posicion_termino === false){
            $correcto = false;
        }
        
        if($correcto){
            $inicio = $posicion_inicio+  strlen($texto_inicio);
            $termino = $posicion_termino;
            return substr($texto, $inicio, $termino - $inicio);
        }
    }

    /**
     * 
     * @return string
     */
    static public function cadenaAleatoria() {
        $parts = explode('.', uniqid('', true));

        $id = str_pad(base_convert($parts[0], 16, 2), 56, mt_rand(0, 1), STR_PAD_LEFT)
            . str_pad(base_convert($parts[1], 10, 2), 32, mt_rand(0, 1), STR_PAD_LEFT);
        $id = str_pad($id, strlen($id) + (8 - (strlen($id) % 8)), mt_rand(0, 1), STR_PAD_BOTH);

        $chunks = str_split($id, 8);

        $id = array();
        foreach ($chunks as $key => $chunk) {
            if ($key & 1) {  // odd
                array_unshift($id, $chunk);
            } else {         // even
                array_push($id, $chunk);
            }
        }

        // add random seeds
        $prefix = str_pad(base_convert(mt_rand(), 10, 36), 6, self::_nextChar(), STR_PAD_BOTH);
        $id = str_pad(base_convert(implode($id), 2, 36), 19, self::_nextChar(), STR_PAD_BOTH);
        $suffix = str_pad(base_convert(mt_rand(), 10, 36), 6, self::_nextChar(), STR_PAD_BOTH);

        return $prefix . self::_nextChar() . $id . $suffix;
    }


    /**
     * @param string $buff
     * @return mixed|string
     */
    public static function br2nl($buff=''){
        $buff = preg_replace('#<br\s*/?>#si', "\n", $buff);
        $buff = trim($buff);

        return $buff;
    }
}
