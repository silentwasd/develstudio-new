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
    'CAPTION' => t('Caption'),
    'TYPE' => 'text',
    'PROP' => 'caption',
);

$result[] = array(
    'CAPTION' => t('font'),
    'TYPE' => 'font',
    'PROP' => 'font',
    'CLASS' => 'TFont',
);


$result[] = array('CAPTION' => t('Font color'), 'PROP' => 'font->color');
$result[] = array('CAPTION' => t('Font size'), 'PROP' => 'font->size');
$result[] = array('CAPTION' => t('Font style'), 'PROP' => 'font->style');

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

$result[] = array(
    'CAPTION' => t('Handle'),
    'TYPE' => '',
    'PROP' => 'handle',
);

$result[] = array(
    'CAPTION' => t('Component List'),
    'TYPE' => '',
    'PROP' => 'componentList',
);
$result[] = array(
    'CAPTION' => t('Component Count'),
    'TYPE' => '',
    'PROP' => 'componentCount',
);
$result[] = array(
    'CAPTION' => t('Double Buffered'),
    'TYPE' => '',
    'PROP' => 'doubleBuffered',
);

return $result;