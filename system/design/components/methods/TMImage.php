<?

$result = array();


$result[] = array(
    'CAPTION' => tm('components.methods.loadFromFile'),
    'PROP' => 'loadFromFile',
    'INLINE' => 'loadFromFile ( string fileName )',
);
$result[] = array(
    'CAPTION' => tm('components.methods.loadFromBitmap'),
    'PROP' => 'loadFromBitmap',
    'INLINE' => 'loadFromBitmap ( TBitmap bmp )',
);
$result[] = array(
    'CAPTION' => tm('components.methods.loadFromUrl'),
    'PROP' => 'loadFromUrl',
    'INLINE' => 'loadFromUrl ( string url )',
);

$result[] = array(
    'CAPTION' => tm('components.methods.saveToFile'),
    'PROP' => 'saveToFile',
    'INLINE' => 'saveToFile ( string fileName )',
);


$result[] = array(
    'CAPTION' => tm('components.methods.picture.loadFromStr'),
    'PROP' => 'picture->loadFromStr',
    'INLINE' => 'picture->loadFromStr ( string binData, [string format = bmp])',
);

$result[] = array(
    'CAPTION' => tm('components.methods.picture.assign'),
    'PROP' => 'picture->assign',
    'INLINE' => 'picture->assign ( TBitmap bmp )',
);

$result[] = array(
    'CAPTION' => tm('components.methods.picture.clear'),
    'PROP' => 'picture->clear()',
    'INLINE' => 'picture->clear ( void )',
);

$result[] = array(
    'CAPTION' => tm('components.methods.picture.isEmpty'),
    'PROP' => 'picture->isEmpty()',
    'INLINE' => 'bool picture->isEmpty ( void )',
);
$result[] = array(
    'CAPTION' => tm('components.methods.picture.copyToClipboard'),
    'PROP' => 'picture->copyToClipboard()',
    'INLINE' => 'picture->copyToClipboard ( void )',
);

$result[] = array(
    'CAPTION' => tm('components.methods.picture.pasteFromClipboard'),
    'PROP' => 'picture->pasteFromClipboard()',
    'INLINE' => 'picture->pasteFromClipboard ( void )',
);

$result[] = array(
    'CAPTION' => tm('components.methods.picture.getBitmap'),
    'PROP' => 'picture->getBitmap()',
    'INLINE' => 'TBitmap picture->getBitmap ( void )',
);


$result[] = array(
    'CAPTION' => tm('components.methods.setFocus'),
    'PROP' => 'setFocus()',
    'INLINE' => 'setFocus ( void )',
);

$result[] = array(
    'CAPTION' => tm('components.methods.show'),
    'PROP' => 'show()',
    'INLINE' => 'show ( void )',
);

$result[] = array(
    'CAPTION' => tm('components.methods.hide'),
    'PROP' => 'hide()',
    'INLINE' => 'hide ( void )',
);


$result[] = array(
    'CAPTION' => tm('components.methods.toBack'),
    'PROP' => 'toBack()',
    'INLINE' => 'toBack ( void )',
);

$result[] = array(
    'CAPTION' => tm('components.methods.toFront'),
    'PROP' => 'toFront()',
    'INLINE' => 'toFront ( void )',
);

$result[] = array(
    'CAPTION' => tm('components.methods.invalidate'),
    'PROP' => 'invalidate()',
    'INLINE' => 'invalidate ( void )',
);

$result[] = array(
    'CAPTION' => tm('components.methods.repaint'),
    'PROP' => 'repaint()',
    'INLINE' => 'repaint ( void )',
);

$result[] = array(
    'CAPTION' => tm('components.methods.perform'),
    'PROP' => 'perform',
    'INLINE' => 'perform ( string msg, int hparam, int lparam )',
);

$result[] = array(
    'CAPTION' => tm('components.methods.create'),
    'PROP' => 'create',
    'INLINE' => 'create ( [object parent = activeForm] )',
);

$result[] = array(
    'CAPTION' => tm('components.methods.free'),
    'PROP' => 'free()',
    'INLINE' => 'free ( void )',
);
return $result;