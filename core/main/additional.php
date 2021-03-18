<?
/*
  
  SoulEngine Additional Library
  
  2009 ver 0.1
  
  Dim-S Software (c) 2009
  
				TTrayIcon, TBalloonHint, TMaskEdit,
                TStringGrid, TStringGridStrings,
                TDrawGrid, TImage, TShape, TBevel,
                TScrollBox, TCheckListBox, TSplitter,
                TStaticText, TLinkLabel, TControlBar,
                TValueListEditor, TValueListStrings,
                TLabeledEdit, TColorBox, TColorListBox,
                TDockTabSet, TTabSet, THotKey
  
*/

global $_c;

//TAlign = (alNone, alTop, alBottom, alLeft, alRight, alClient, alCustom);
$_c->setConstList(array('alNone', 'alTop', 'alBottom', 'alLeft', 'alRight', 'alClient', 'alCustom'),0);
$_c->setConstList(array('tsTabs', 'tsButtons', 'tsFlatButtons'),0);
$_c->setConstList(array('lbStandard', 'lbOwnerDrawFixed', 'lbOwnerDrawVariable',
    'lbVirtual', 'lbVirtualOwnerDraw'),0);
$_c->setConstList(array('cbUnchecked', 'cbChecked', 'cbGrayed'),0);

$_c->setConstList(array('trHorizontal', 'trVertical'), 0);
$_c->setConstList(array('tmBottomRight', 'tmTopLeft', 'tmBoth'), 0);
$_c->setConstList(array('tsNone', 'tsAuto', 'tsManual'), 0);

$_c->setConstList(array('sbHorizontal', 'sbVertical'), 0);
$_c->setConstList(array('scLineUp', 'scLineDown', 'scPageUp', 'scPageDown', 'scPosition',
    'scTrack', 'scTop', 'scBottom', 'scEndScroll'),0);

$_c->setConstList(array('dfShort','dfLong'), 0);
$_c->setConstList(array('dmComboBox','dmUpDown'), 0);
$_c->setConstList(array('dtkDate','dtkTime'), 0);

$_c->setConstList(array('bsBox', 'bsFrame', 'bsTopLine', 'bsBottomLine', 'bsLeftLine',
                                'bsRightLine', 'bsSpacer'),0);