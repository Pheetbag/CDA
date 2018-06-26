<?php

//Esta función convierte cualquier string en una expresión regular bastante inclusiva, que filtra errores comunes, para poder usarlo en las búsquedas del sitio, aumentando las probalidades de obtener los resultados esperados.

function transformar_regexp($texto){

    $regexp = [];

        //Esto devuelve un array separado por los espacios en blanco presentes
        $palabras = explode(' ',$texto);

        //Esto elimina los espacios en blanco redundantes y tambien las palabras repetidas. los espacios serán parceados más adelante.
        $palabras = array_unique($palabras);


        function filtrar_especiales(&$texto){

            //Esta función será llamada por la función array_walk, de esta forma podrá ser aplciada a cada contenido del array, que ya ha sido fragmentado. Reemplazando en cada uno de estos los caracteres espaciales, por un codigo del tipo ///WWW1ww3// en donde 1 significa el numero de el tipo de caracter y el 3 representa el caracter dentro de la correspondiente lista.

            $caracteres = ['/','+','-','_','\\', '"','?','¿','!','¡','#','$','%','&', '*','(',')','=','{','}','[',']','´','\'','<','>', ':', '.', ',', '|'];

            $caract_q = count($caracteres);
            

            for ($i=0; $i < $caract_q; $i++) { 

               $texto = str_ireplace($caracteres[$i], '///WWW1ww'.($i + 1).'//', $texto);
            }

        }

        function filtrar_generales(&$texto){

            //Esta función será llamada por la función array_walk, de esta forma podrá ser aplciada a cada contenido del array, que ya ha sido fragmentado. Reemplazando en cada uno de estos los caracteres, por un codigo del tipo ///WWW1ww3// en donde 1 significa el numero de el tipo de caracter y el 3 representa el caracter dentro de la correspondiente lista.

            $caracteres = [
                'b'   => '///WWW2ww1//',  //Se convertirá en [bv]
                'v'   => '///WWW2ww1//',



                'sa'  => '///WWW2ww2//a', //Se convertirá en [zs] (incluye al final la vocal que se uso para el reemplazo)
                'so'  => '///WWW2ww2//o',
                'su'  => '///WWW2ww2//u',
                'za'  => '///WWW2ww2//a',
                'zo'  => '///WWW2ww2//o',
                'zu'  => '///WWW2ww2//u',

                'sá'  => '///WWW2ww2//á', 
                'só'  => '///WWW2ww2//ó',
                'sú'  => '///WWW2ww2//ú',
                'zá'  => '///WWW2ww2//á',
                'zó'  => '///WWW2ww2//ó',
                'zú'  => '///WWW2ww2//ú',



                'si'  => '///WWW2ww3//i', //Se convertirá en [zsc] (incluye al final la vocal que se uso para el reemplazo)
                'se'  => '///WWW2ww3//e',
                'zi'  => '///WWW2ww3//i',
                'ze'  => '///WWW2ww3//e',
                'ci'  => '///WWW2ww3//i',
                'ce'  => '///WWW2ww3//e',

                'sí'  => '///WWW2ww3//í',
                'sé'  => '///WWW2ww3//é',
                'zí'  => '///WWW2ww3//í',
                'zé'  => '///WWW2ww3//é',
                'cí'  => '///WWW2ww3//í',
                'cé'  => '///WWW2ww3//é',



                'lla' => '///WWW2ww4//a', //Se convertirá en (Y|L{2}) (incluye al final la vocal que se uso para el reemplazo)
                'lle' => '///WWW2ww4//e',
                'lli' => '///WWW2ww4//i',
                'llo' => '///WWW2ww4//o',
                'llu' => '///WWW2ww4//u',
                'ya'  => '///WWW2ww4//a',
                'ye'  => '///WWW2ww4//e',
                'yi'  => '///WWW2ww4//i',
                'yo'  => '///WWW2ww4//o',
                'yu'  => '///WWW2ww4//u',
                
                'llá' => '///WWW2ww4//á', 
                'llé' => '///WWW2ww4//é',
                'llí' => '///WWW2ww4//í',
                'lló' => '///WWW2ww4//ó',
                'llú' => '///WWW2ww4//ú',
                'yá'  => '///WWW2ww4//á',
                'yé'  => '///WWW2ww4//é',
                'yí'  => '///WWW2ww4//í',
                'yó'  => '///WWW2ww4//ó',
                'yú'  => '///WWW2ww4//ú',

                

                'ge'  => '///WWW2ww5//e', //Se convertirá en [gj] (incluye al final la vocal que se uso para el reemplazo)
                'gi'  => '///WWW2ww5//i',
                'je'  => '///WWW2ww5//e',
                'ji'  => '///WWW2ww5//i',

                'gé'  => '///WWW2ww5//é', 
                'gí'  => '///WWW2ww5//í',
                'jé'  => '///WWW2ww5//é',
                'jí'  => '///WWW2ww5//í',
                


                'a'   => '///WWW2ww6//', //Se convertirá en [aá]
                'á'   => '///WWW2ww6//',
                
                'e'   => '///WWW2ww7//', //Se convertirá en [eé]
                'é'   => '///WWW2ww7//',

                'i'   => '///WWW2ww8//', //Se convertirá en [ií]
                'í'   => '///WWW2ww8//',

                'o'   => '///WWW2ww9//', //Se convertirá en [oó]
                'ó'   => '///WWW2ww9//',
 
                'u'   => '///WWW2ww10//',//Se convertirá en [uú]
                'ú'   => '///WWW2ww10//',



                'h'   => '///WWW2ww11//' //Se convertirá en h?  

            ];

            $caract_index = array_keys($caracteres);
            $caract_q = count($caract_index);

            for ($i=0; $i < $caract_q; $i++) { 

                $texto = str_ireplace($caract_index[$i], $caracteres[$caract_index[$i]], $texto);
             }

        }

        function filtrar_espacios(&$array){ 

            //Esta función será llamada por la función array_walk, de esta forma podrá ser aplciada a cada contenido del array, que ya ha sido fragmentado. Reemplazando en cada uno de estos los espacios en blanco, por un codigo del tipo ///WWW1ww3// en donde 1 significa el numero de el tipo de caracter y el 3 representa el caracter dentro de la correspondiente lista.

            $caract_index = array_keys($array);
            $caract_q = count($caract_index);

            for ($i=0; $i < $caract_q; $i++) { 

                if($array[$caract_index[$i]] == null)
                
                unset($array[$caract_index[$i]]);
             }
        }


        //Generamos todos los array_walk, para obtener un codigo final completamente escapado a el modelo ///WWW1ww1//
        filtrar_espacios($palabras);

        array_walk($palabras, 'filtrar_especiales');

        array_walk($palabras, 'filtrar_generales');
        
        function recodificar(&$texto){

            //Esta función será llamada por el array_walk, y se encargará de recodificar todos y cada uno de los escapados concodigo especial que se crearon asegurandose unicamente de que el ultimo en ser escapado sea el caracter especial "/"

            $caracteres = [
                '///WWW2ww1//'   => '[bv]',  

                '///WWW2ww2//'   => '[zs]', 

                '///WWW2ww3//'   => '[zsc]', 

                '///WWW2ww4//'   => '(Y|L{2})',

                '///WWW2ww5//'   => '[gj]', 
                
                '///WWW2ww6//'   => '[aá]', 
                
                '///WWW2ww7//'   => '[eé]',

                '///WWW2ww8//'   => '[ií]',

                '///WWW2ww9//'   => '[oó]',
 
                '///WWW2ww10//'  => '[uú]',

                '///WWW2ww11//'  => 'h?',




                '///WWW3ww12//'  => '.*',




                '///WWW1ww2//'   =>  '(\+)?',
 
                '///WWW1ww3//'   =>  '\-',

                '///WWW1ww4//'   =>  '\_',

                '///WWW1ww5//'   =>  '(\\\\)?',

                '///WWW1ww6//'   =>  '(\")?',

                '///WWW1ww7//'   =>  '(\?)?',

                '///WWW1ww8//'   =>  '(\¿)?',

                '///WWW1ww9//'   =>  '(\!)?',

                '///WWW1ww10//'  =>  '(\¡)?',

                '///WWW1ww11//'  =>  '(\#)?',

                '///WWW1ww12//'  =>  '(\$)?',

                '///WWW1ww13//'  =>  '(\%)?',

                '///WWW1ww14//'  =>  '(\&)?',

                '///WWW1ww15//'  =>  '(\*)?',

                '///WWW1ww16//'  =>  '(\()?',

                '///WWW1ww17//'  =>  '(\))?',

                '///WWW1ww18//'  =>  '(\=)?',

                '///WWW1ww19//'  =>  '(\{)?',

                '///WWW1ww20//'  =>  '(\})?',

                '///WWW1ww21//'  =>  '(\[)?',

                '///WWW1ww22//'  =>  '(\])?',

                '///WWW1ww23//'  =>  '(\´)?',

                '///WWW1ww24//'  =>  '(\\\')?',

                '///WWW1ww25//'  =>  '(\<)?',

                '///WWW1ww26//'  =>  '(\>)?',

                '///WWW1ww27//'  =>  '(\:)?',

                '///WWW1ww28//'  =>  '(\.)?',

                '///WWW1ww29//'  =>  '(\,)?',

                '///WWW1ww30//'  =>  '(\|)?',

                '///WWW1ww1//'  =>  '(\/)?'
            ];

            $caract_index = array_keys($caracteres);
            $caract_q = count($caract_index);

            for ($i=0; $i < $caract_q; $i++) { 

                $texto = str_replace($caract_index[$i], $caracteres[$caract_index[$i]], $texto);
             }
        }

        array_walk($palabras, 'recodificar');

        $regexp[0] ='(' . implode(')|(',$palabras) . ')';
        $regexp[1] = implode('.*',$palabras);

        return $regexp; 

}