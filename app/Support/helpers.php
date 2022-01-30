<?php
 function date_compare($element1, $element2) { 
            $datetime1 = strtotime($element1['time']); 
            $datetime2 = strtotime($element2['time']); 
            return $datetime1 - $datetime2; 
        }


function getSortValues($input, $default_field = 'id', $default_dir = 'desc')
{
	if($input)
    {
        $sort['field'] = $input[0]['field'];
        $sort['dir']   = $input[0]['dir'];
    }
    else
    {
        $sort['field'] = $default_field;
        $sort['dir']   = $default_dir;
    }

    return $sort;
}

function getFilterValues($filter, $option = 'value')
{
    $fields = [];
    
    if($filter)
    {
        foreach ($filter['filters'] as $filter)
        {
            $fields[$filter['field']] = $filter[$option];
        }

        return $fields;
    }
    
    return $fields;
}


function array_recursive($array, $column_parent, $column_key = null)
{
    $list = []; 

    if (count($array))
    {
        $arrayKeys = array_keys(reset($array));  
        $colKey    = $column_key?:reset($arrayKeys);
    
        foreach ($array as $row)
        {
            $key  = $row[$colKey];
            $mref = &$itemId[$key];

            foreach ($arrayKeys as $v)
            {
                $mref[$v] = $row[$v];
            }                                                                

            if (!$row[$column_parent])
            {
                $list[$key] = &$mref;
            }
            else
            {
                $itemId[$row[$column_parent]]['children'][$key] = &$mref;
            }
        }
    }
    
    return $list;
}

function array_group_by( array $array, $key )
{
    if ( ! is_string( $key ) && ! is_int( $key ) && ! is_float( $key ) && ! is_callable( $key ) )
    {
        trigger_error( 'array_group_by(): The key should be a string, an integer, or a callback', E_USER_ERROR );
        return null;
    }

    $func = ( is_callable( $key ) ? $key : null );
    $_key = $key;
    // Load the new array, splitting by the target key
    $grouped = [];

    foreach ( $array as $value )
    {
        if ( is_callable( $func ) )
        {
            $key = call_user_func( $func, $value );
        }
        elseif ( is_object( $value ) && isset( $value->{ $_key } ) )
        {
            $key = $value->{ $_key };
        }
        elseif ( isset( $value[ $_key ] ) )
        {
            $key = $value[ $_key ];
        }
        else
        {
            continue;
        }

        $grouped[ $key ][] = $value;
    }

    // Recursively build a nested grouping if more parameters are supplied
    // Each grouped array value is grouped according to the next sequential key
    if ( func_num_args() > 2 )
    {
        $args = func_get_args();

        foreach ( $grouped as $key => $value )
        {
            $params = array_merge( [ $value ], array_slice( $args, 2, func_num_args() ) );
            $grouped[ $key ] = call_user_func_array( 'array_group_by', $params );
        }
    }
    
    return $grouped;
}


function replaceNulls(&$array, $text = 'N/D', $null_values = [''])
{
    foreach ($array as $key_row => $row)
    {
        foreach ($row as $key_column => $column)
        {
            if ( in_array($column, $null_values))
            {
               $array[$key_row][$key_column] = $text;
            }
        }
    }
}

function getArrayTotal(&$base_array, $data, $options = [])
{
    $last_row_key = getArrayLastKey($base_array);

    $columns      = getArrayColumns($base_array);

    if ( isset($options['excluded_sum_columns']) )
    {
        $columns = array_diff($columns, $options['excluded_sum_columns']);
    }

    if ( isset($options['included_sum_columns']) )
    {
        $columns = array_intersect($columns, $options['included_sum_columns']);
    }

    foreach ($columns as $key => $column)
    {
        $base_array[$last_row_key][$column] = array_sum_column($data, $column);
    }

    if ( isset($options['clean_last_columns']) )
    {
        foreach ($options['clean_last_columns'] as $key => $column)
        {
            $base_array[$last_row_key][$column] = " ";
        }
    }
}

function insertDataInArray(&$base_array, $data, $options = [])
{
    $total_column_name = isset($options['total_column_name']) ? $options['total_column_name'] : '';
    $default_text      = isset($options['default_text']) ? $options['default_text'] : 'N/D';

    foreach ($data as $key => $row)
    {
        foreach ($row as $column => $value)
        {
            if ( ! in_array($column, $options['excluded_replace_columns']) )
            {
                $base_array[$row[$total_column_name]][$column] = $value != '' ? $value : $default_text;
            }
        }
    }
}

function getArrayColumns($array)
{
    return array_keys(current($array));
}

function getArrayLastKey($array)
{
    end($array);

    $last_row_key = key($array);

    reset($array);

    return $last_row_key;
}

function array_sum_column($array, $column)
{
    return array_sum(array_column($array, $column));
}

function getDataAndTotal(&$base_array, $data, $options = [])
{
    insertDataInArray($base_array, $data, $options);
    getArrayTotal($base_array, $data, $options);
}

function ram_used()
{
    $mb = ((memory_get_usage() / 1024) / 1024);
    $mem = round($mb, 2);

    return $mem . ' MB';
}

function mb_to_gb($mb)
{
    if ( ! $mb )
    {
        return '';
    }

    $gb = ($mb / 1024);
    $gb = round($gb, 2);

    return $gb . ' GB';
}

function set_unlimited()
{
    set_time_limit(0);
    ini_set('memory_limit', -1);
}

function fulldate()
{
    $months   = config('custom_arrays.months');
    $days     = config('custom_arrays.days');

    $fulldate = $days[ date("w") ] .", ". date("j") ." de ". $months[ date("n") ] ." de ". date("Y");

    return $fulldate;
}

function icon_permission($permission)
{
    $class = "not-active";

    if ( Entrust::ability('superuser', $permission) )
    {
        $class = "";
    }

    return $class;
}

function is_superuser()
{
    return auth()->user()->isSuperUser();
}

function user_icon()
{
    $icon = 'fa-user';

    if ( is_superuser() )
    {
        $icon = 'fa-user-secret';
    }

    return $icon;
}

function set_middleware($permission)
{
    return [ 'middleware' => ['ability:superuser,'. $permission] ];
}

function greetings()
{
    $hour = Carbon::now()->hour;
    $greetings = 'Buenas noches'; // From 6pm to 6am

    if ($hour >=  6 && $hour < 12) $greetings = 'Buenos días';      // After 6am
    if ($hour >= 12 && $hour < 18) $greetings = 'Buenas tardes';    // After 12pm

    return $greetings;
}

function nullIfBlank($field)
{
    return trim($field) !== '' ? $field : null;
}

function api_log($function, $request)
{
    info('----------' . $function . '------------');
    info($request->ip());
    info($request);
}

function getArrayImages($array){




}

function trim_value(&$value)
{
  $value = trim($value);
}

function getFechaExcel($valor)
{
    if($valor!='' && strlen($valor)==5)
    {
        $a=(($valor - 25569) * 86400)+18000;//+18000 = +5 horas
        return date('Y-m',$a);
    }

    if($valor!='' && strlen($valor)==8)
    {
        $mes=['Ene'=>'01','Feb'=>'02','Mar'=>'03','Abr'=>'04','May'=>'05','Jun'=>'06','Jul'=>'07','Ago'=>'08','Set'=>'09','Oct'=>'10','Nom'=>'11','Dic'=>'12'];
        return '20'.substr($valor, 4,2).'-'.$mes[substr($valor, 0,3)];
    }

    return '';
}

function getPercentile($array, $percentile)
{
       $percentile=$percentile*100;
       $percentile = min(100, max(0, $percentile));
       array_values($array);
       sort($array);
       $index = ($percentile / 100) * (count($array) - 1);
       
       $fractionPart = $index - floor($index);
       $intPart = floor($index);

       $percentile = $array[$intPart];
       $percentile += ($fractionPart > 0) ? $fractionPart * ($array[$intPart + 1] - $array[$intPart]) : 0;

       return $percentile;
}

function format_string($cadena) {
$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
$texto = str_replace($no_permitidas, $permitidas ,$cadena);
return $texto;
}


function convert_fecha_to_string_fecha($datos)
{
        $meses = array("Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");

        $fechasfechas=[];
        foreach ($datos as $key => $value) {
            $fechas[] = $meses[(int)substr($value, 5, 2) - 1] . '-' . substr($value, 2, 2);
        }

        return $fechas;
}
function convert_fecha_to_string_fecha_e($datos)
{
        $meses = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");

        $fechasfechas=[];
        foreach ($datos as $key => $value) {
            $fechas[] = $meses[(int)substr($value, 5, 2) - 1] . '-' . substr($value, 2, 2);
        }

        return $fechas;
}

function calculate_interfaz_enlaces($valor)
{
    $interfaz=0;
    if($valor <= 1)
    {
        $interfaz=1;
    }else if($valor <= 10)
    {
        $interfaz=10;
    }else if($valor <= 100)
    {
        $interfaz=100;
    }else if($valor <= 1000)
    {
        $interfaz=1000;
    }else if($valor <= 10000)
    {
        $interfaz=10000;
    }else if($valor <=20000 )
    {
        $interfaz=20000;
    }else if($valor <= 30000)
    {
        $interfaz=30000;
    }else if($valor <= 40000 )
    {
        $interfaz=40000;
    }else if($valor <= 50000)
    {
        $interfaz=50000;
    }else if($valor <= 60000)
    {
        $interfaz=60000;
    }else if($valor <= 70000)
    {
        $interfaz=70000;
    }else if($valor <= 80000)
    {
        $interfaz=80000;
    }else if($valor <= 90000)
    {
        $interfaz=90000;
    }else if($valor <= 100000)
    {
        $interfaz=100000;
    }else if($valor <= 200000)
    {
        $interfaz=200000;
    }

    return $interfaz;
}

function converFechaStringtoInt($mes)
{
    $mes_array=['Ene'=>'01','Feb'=>'02','Mar'=>'03','Abr'=>'04','May'=>'05','Jun'=>'06','Jul'=>'07','Ago'=>'08','Set'=>'09','Oct'=>'10','Nov'=>'11','Dic'=>'12'];

    return $mes_array[$mes];
}