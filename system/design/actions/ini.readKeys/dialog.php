<?

$r = array();

$r[] = array(
             'TYPE'=>'INPUT_DLG',
             'CAPTION'=>t('Section'),
             'USE_QUOTE'=>true,
             );
$r[] = array(
             'TYPE'=>'VARS',
             'CAPTION'=>t('Variable-array'),
             'USE_QUOTE'=>false,
             );
return $r;
