<?
$r = array();
$r[] = array(
             'TYPE'=>'INPUT_DLG',
             'CAPTION'=>t('File name'),
             'USE_QUOTE'=>true,
             );
$r[] = array(
             'TYPE'=>'INPUT_DLG',
             'CAPTION'=>t('Buffer - variable or object'),
             'USE_QUOTE'=>false,
             );

return $r;
