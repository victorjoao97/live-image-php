<?php

function deldir($dir) { 
    $files = array_diff(scandir($dir), array('.','..')); 
    foreach ($files as $file) { 
        (is_dir("$dir/$file")) ? deldir("$dir/$file") : unlink("$dir/$file"); 
    } 
    return rmdir($dir); 
}

function url($url = null)
{
	if (!$url) {
		return url;
	}else{
		return url . $url;
	}
}


function path($url)
{
    if (!$url) {
        return root;
    }else{
        return root . $url;
    }
}

function date_event($date,$format)
{
	return date_format(new DateTime($date),$format);
}

function item_menu($text,$url = null,$su = null)
{
    global $title;
    if($su)
    {
        if ($_SESSION['su'] == true)
        {
            if ($title == $text)
            {
                echo "<li class=\"active\"><a href=\"" . url($url) . "\">$text</a></li>";
            }
            else
            {
                echo "<li><a href=\"" . url($url) . "\">$text</a></li>";
            }
        }else{
            return null;
        } 
    }
    elseif ($title == $text)
    {
        echo "<li class=\"active\"><a href=\"" . url($url) . "\">$text</a></li>";
    }
    else
    {
        echo "<li><a href=\"" . url($url) . "\">$text</a></li>";
    }
}


/***
 * Função para remover acentos de uma string
 *
 * @autor Thiago Belem <contato@thiagobelem.net>
 */
function encode($string, $slug = false) {

    // if(mb_detect_encoding($string.'x', 'UTF-8, ISO-8859-1') == 'UTF-8'){
    //     $string = utf8_decode(strtolower($string));
    // }
    // $string = strtolower($string);
    // // Código ASCII das vogais
    // $ascii['a'] = range(224, 230);
    // $ascii['e'] = range(232, 235);
    // $ascii['i'] = range(236, 239);
    // $ascii['o'] = array_merge(range(242, 246), array(240, 248));
    // $ascii['u'] = range(249, 252);
    // // Código ASCII dos outros caracteres
    // $ascii['b'] = array(223);
    // $ascii['c'] = array(231);
    // $ascii['d'] = array(208);
    // $ascii['n'] = array(241);
    // $ascii['y'] = array(253, 255);
    // foreach ($ascii as $key=>$item) {
    // $acentos = '';
    // foreach ($item AS $codigo) $acentos .= chr($codigo);
    // $troca[$key] = '/['.$acentos.']/i';
    // }
    // $string = preg_replace(array_values($troca), array_keys($troca), $string);
    // // Slug?
    // if ($slug) {
    // // Troca tudo que não for letra ou número por um caractere ($slug)
    // $string = preg_replace('/[^a-z0-9]/i', $slug, $string);
    // // Tira os caracteres ($slug) repetidos
    // $string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
    // $string = trim($string, $slug);
    // }


  //$string = ereg("[^a-zA-Z0-9_]", "", strtr($string, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));
$string = strtolower( preg_replace( '/\s+/' , '-' , removeAccents( $string ) ) );
  
return $string;
}
/**
* Verifica se uma string é UTF-8
* @param string $string A string que será verificada
* @return boolean
*/
function is_utf8( $string ){
return preg_match( '%^(?:
     [\x09\x0A\x0D\x20-\x7E]
    | [\xC2-\xDF][\x80-\xBF]
    | \xE0[\xA0-\xBF][\x80-\xBF]
    | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}
    | \xED[\x80-\x9F][\x80-\xBF]
    | \xF0[\x90-\xBF][\x80-\xBF]{2}
    | [\xF1-\xF3][\x80-\xBF]{3}
    | \xF4[\x80-\x8F][\x80-\xBF]{2}
    )*$%xs',
    $string
);
}

/**
* Remove os acentos de uma string
* @param string $string
* @return string
*/
function removeAccents( $string ){
return preg_replace(
    array(
        //Maiúsculos
        '/\xc3[\x80-\x85]/',
        '/\xc3\x87/',
        '/\xc3[\x88-\x8b]/',
        '/\xc3[\x8c-\x8f]/',
        '/\xc3([\x92-\x96]|\x98)/',
        '/\xc3[\x99-\x9c]/',

        //Minúsculos
        '/\xc3[\xa0-\xa5]/',
        '/\xc3\xa7/',
        '/\xc3[\xa8-\xab]/',
        '/\xc3[\xac-\xaf]/',
        '/\xc3([\xb2-\xb6]|\xb8)/',
        '/\xc3[\xb9-\xbc]/',
    ),
    str_split( 'ACEIOUaceiou' , 1 ),
    is_utf8( $string ) ? $string : utf8_encode( $string )
);
}

function mime_type($filename) {

    $mime_types = array(

        'txt' => 'text/plain',
        'htm' => 'text/html',
        'html' => 'text/html',
        'php' => 'text/html',
        'css' => 'text/css',
        'js' => 'application/javascript',
        'json' => 'application/json',
        'xml' => 'application/xml',
        'swf' => 'application/x-shockwave-flash',
        'flv' => 'video/x-flv',

        // images
        'png' => 'image/png',
        'jpe' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'gif' => 'image/gif',
        'bmp' => 'image/bmp',
        'ico' => 'image/vnd.microsoft.icon',
        'tiff' => 'image/tiff',
        'tif' => 'image/tiff',
        'svg' => 'image/svg+xml',
        'svgz' => 'image/svg+xml',

        // archives
        'zip' => 'application/zip',
        'rar' => 'application/x-rar-compressed',
        'exe' => 'application/x-msdownload',
        'msi' => 'application/x-msdownload',
        'cab' => 'application/vnd.ms-cab-compressed',

        // audio/video
        'mp3' => 'audio/mpeg',
        'qt' => 'video/quicktime',
        'mov' => 'video/quicktime',

        // adobe
        'pdf' => 'application/pdf',
        'psd' => 'image/vnd.adobe.photoshop',
        'ai' => 'application/postscript',
        'eps' => 'application/postscript',
        'ps' => 'application/postscript',

        // ms office
        'doc' => 'application/msword',
        'rtf' => 'application/rtf',
        'xls' => 'application/vnd.ms-excel',
        'ppt' => 'application/vnd.ms-powerpoint',

        // open office
        'odt' => 'application/vnd.oasis.opendocument.text',
        'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
    );

    $ext = strtolower(array_pop(explode('.',$filename)));
    if (array_key_exists($ext, $mime_types)) {
        return $mime_types[$ext];
    }
    elseif (function_exists('finfo_open')) {
        $finfo = finfo_open(FILEINFO_MIME);
        $mimetype = finfo_file($finfo, $filename);
        finfo_close($finfo);
        return $mimetype;
    }
    else {
        return 'application/octet-stream';
    }
}

?>