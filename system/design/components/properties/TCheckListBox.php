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
    'CAPTION' => t('Checked Items'),
    'TYPE' => '',
    'PROP' => 'checkedItems',
);

$result[] = array(
    'CAPTION' => t('List'),
    'TYPE' => 'text',
    'PROP' => 'text',
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
    'CAPTION' => t('Auto Complete'),
    'TYPE' => 'check',
    'PROP' => 'autoComplete',
);
$result[] = array(
    'CAPTION' => t('Ctl3D'),
    'TYPE' => 'check',
    'PROP' => 'ctl3D',
);
$result[] = array(
    'CAPTION' => t('Flat'),
    'TYPE' => 'check',
    'PROP' => 'flat',
);
$result[] = array(
    'CAPTION' => t('Item Index'),
    'TYPE' => 'number',
    'PROP' => 'itemIndex',
);
$result[] = array(
    'CAPTION' => t('Item Height'),
    'TYPE' => 'number',
    'PROP' => 'itemHeight',
);
$result[] = array(
    'CAPTION' => t('Color'),
    'TYPE' => 'color',
    'PROP' => 'color',
);
$result[] = array(
    'CAPTION' => t('Columns'),
    'TYPE' => 'number',
    'PROP' => 'columns',
);
$result[] = array(
    'CAPTION' => t('Style'),
    'TYPE' => 'combo',
    'PROP' => 'style',
    'VALUES' => array('lbStandard', 'lbOwnerDrawFixed', 'lbOwnerDrawVariable', 'lbVirtual', 'lbVirtualOwnerDraw'),
);
$result[] = array(
    'CAPTION' => t('Scroll Width'),
    'TYPE' => 'number',
    'PROP' => 'scrollWidth',
);
$result[] = array(
    'CAPTION' => t('Cursor'),
    'TYPE' => 'combo',
    'PROP' => 'cursor',
    'VALUES' => $GLOBALS['cursors_meta'],
    'ADD_GROUP' => true,
);
$result[] = array(
    'CAPTION' => t('Tab Order'),
    'TYPE' => 'number',
    'PROP' => 'tabOrder',
);
$result[] = array(
    'CAPTION' => t('Tab Stop'),
    'TYPE' => 'check',
    'PROP' => 'tabStop',
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