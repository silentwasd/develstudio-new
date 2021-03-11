<?

$result = array();

$result[] = array(
    'CAPTION' => t('Align'),
    'TYPE' => 'combo',
    'PROP' => 'align',
    'VALUES' => array('alNone', 'alTop', 'alBottom', 'alLeft', 'alRight', 'alClient', 'alCustom'),
    'ADD_GROUP' => true
);

$result[] = array(
    'CAPTION' => t('Minimum'),
    'TYPE' => 'number',
    'PROP' => 'min',
);

$result[] = array(
    'CAPTION' => t('Maximum'),
    'TYPE' => 'number',
    'PROP' => 'max',
);

$result[] = array(
    'CAPTION' => t('Position'),
    'TYPE' => 'number',
    'PROP' => 'position',
);

$result[] = array(
    'CAPTION' => t('Orientation'),
    'TYPE' => 'combo',
    'PROP' => 'Orientation',
    'VALUES' => array('pbHorizontal', 'pbVertical'),
);

$result[] = array(
    'CAPTION' => t('Step'),
    'TYPE' => 'number',
    'PROP' => 'step',
);

$result[] = array(
    'CAPTION' => t('Smooth'),
    'TYPE' => 'check',
    'PROP' => 'smooth',
);

$result[] = array(
    'CAPTION' => t('Hint'),
    'TYPE' => 'text',
    'PROP' => 'hint',
);

$result[] = array(
    'CAPTION' => t('Cursor'),
    'TYPE' => 'combo',
    'PROP' => 'cursor',
    'VALUES' => $GLOBALS['cursors_meta'],
    'ADD_GROUP' => true,
);

$result[] = array(
    'CAPTION' => t('Sizes and position'),
    'TYPE' => 'sizes',
    'PROP' => '',
    'ADD_GROUP' => true,
);

$result[] = array(
    'CAPTION' => t('Enabled'),
    'TYPE' => 'check',
    'PROP' => 'aenabled',
    'REAL_PROP' => 'enabled',
    'ADD_GROUP' => true,
);

$result[] = array(
    'CAPTION' => t('visible'),
    'TYPE' => 'check',
    'PROP' => 'avisible',
    'REAL_PROP' => 'visible',
    'ADD_GROUP' => true,
);

$result[] = array('CAPTION' => t('p_Left'), 'PROP' => 'x', 'TYPE' => 'number', 'ADD_GROUP' => 1, 'UPDATE_DSGN' => 1);
$result[] = array('CAPTION' => t('p_Top'), 'PROP' => 'y', 'TYPE' => 'number', 'ADD_GROUP' => 1, 'UPDATE_DSGN' => 1);
$result[] = array('CAPTION' => t('Width'), 'PROP' => 'w', 'TYPE' => 'number', 'ADD_GROUP' => 1, 'UPDATE_DSGN' => 1);
$result[] = array('CAPTION' => t('Height'), 'PROP' => 'h', 'TYPE' => 'number', 'ADD_GROUP' => 1, 'UPDATE_DSGN' => 1);
return $result;