<?
/*
  
  SoulEngine Graphics Library
  
  2009 ver 0.1
  
  Dim-S Software (c) 2009
  
*/
global $_c;

$_c->setConstList(array('bsSolid', 'bsClear', 'bsHorizontal', 'bsVertical',
    'bsFDiagonal', 'bsBDiagonal', 'bsCross', 'bsDiagCross'),0);

/* TPenMode = (pmBlack, pmWhite, pmNop, pmNot, pmCopy, pmNotCopy,
    pmMergePenNot, pmMaskPenNot, pmMergeNotPen, pmMaskNotPen, pmMerge,
    pmNotMerge, pmMask, pmNotMask, pmXor, pmNotXor);
*/
$_c->setConstList(array('pmBlack', 'pmWhite', 'pmNop', 'pmNot', 'pmCopy', 'pmNotCopy',
    'pmMergePenNot', 'pmMaskPenNot', 'pmMergeNotPen', 'pmMaskNotPen', 'pmMerge',
    'pmNotMerge', 'pmMask', 'pmNotMask', 'pmXor', 'pmNotXor'),0);

/* TPenStyle = (psSolid, psDash, psDot, psDashDot, psDashDotDot, psClear,
    psInsideFrame);
*/
$_c->setConstList(array('psSolid', 'psDash', 'psDot', 'psDashDot', 'psDashDotDot', 'psClear',
    'psInsideFrame'),0);

$_c->setConstList(array('stRectangle', 'stSquare', 'stRoundRect', 'stRoundSquare', 'stEllipse', 'stCircle'),0);


$_c->COLOR_SCROLLBAR = 0;
$_c->COLOR_BACKGROUND = 1;
$_c->COLOR_ACTIVECAPTION = 2;
$_c->COLOR_INACTIVECAPTION = 3;
$_c->COLOR_MENU = 4;
$_c->COLOR_WINDOW = 5;
$_c->COLOR_WINDOWFRAME = 6;
$_c->COLOR_MENUTEXT = 7;
$_c->COLOR_WINDOWTEXT = 8;
$_c->COLOR_CAPTIONTEXT = 9;
$_c->COLOR_ACTIVEBORDER = 10;
$_c->COLOR_INACTIVEBORDER = 11;
$_c->COLOR_APPWORKSPACE = 12;
$_c->COLOR_HIGHLIGHT = 13;
$_c->COLOR_HIGHLIGHTTEXT = 14;
$_c->COLOR_BTNFACE = 15;
$_c->COLOR_BTNSHADOW = 0x10;
$_c->COLOR_GRAYTEXT = 17;
$_c->COLOR_BTNTEXT = 18;
$_c->COLOR_INACTIVECAPTIONTEXT = 19;
$_c->COLOR_BTNHIGHLIGHT = 20;

$_c->COLOR_3DDKSHADOW = 21;
$_c->COLOR_3DLIGHT = 22;
$_c->COLOR_INFOTEXT = 23;
$_c->COLOR_INFOBK = 24;

$_c->COLOR_HOTLIGHT = 26;
$_c->COLOR_GRADIENTACTIVECAPTION = 27;
$_c->COLOR_GRADIENTINACTIVECAPTION = 28;

$_c->COLOR_MENUHILIGHT = 29;
$_c->COLOR_MENUBAR = 30;

$_c->COLOR_ENDCOLORS = COLOR_MENUBAR;

$_c->COLOR_DESKTOP = COLOR_BACKGROUND;
$_c->COLOR_3DFACE = COLOR_BTNFACE;
$_c->COLOR_3DSHADOW = COLOR_BTNSHADOW;
$_c->COLOR_3DHIGHLIGHT = COLOR_BTNHIGHLIGHT;
$_c->COLOR_3DHILIGHT = COLOR_BTNHIGHLIGHT;
$_c->COLOR_BTNHILIGHT = COLOR_BTNHIGHLIGHT;


$_c->clSystemColor = 0xFF000000;

$_c->clScrollBar = clSystemColor | COLOR_SCROLLBAR;
$_c->clBackground = clSystemColor | COLOR_BACKGROUND;
$_c->clActiveCaption = clSystemColor | COLOR_ACTIVECAPTION;
$_c->clInactiveCaption = clSystemColor | COLOR_INACTIVECAPTION;
$_c->clMenu = clSystemColor | COLOR_MENU;
$_c->clWindow = clSystemColor | COLOR_WINDOW;
$_c->clWindowFrame = clSystemColor | COLOR_WINDOWFRAME;
$_c->clMenuText = clSystemColor | COLOR_MENUTEXT;
$_c->clWindowText = clSystemColor | COLOR_WINDOWTEXT;
$_c->clCaptionText = clSystemColor | COLOR_CAPTIONTEXT;
$_c->clActiveBorder = clSystemColor | COLOR_ACTIVEBORDER;
$_c->clInactiveBorder = clSystemColor | COLOR_INACTIVEBORDER;
$_c->clAppWorkSpace = clSystemColor | COLOR_APPWORKSPACE;
$_c->clHighlight = clSystemColor | COLOR_HIGHLIGHT;
$_c->clHighlightText = clSystemColor | COLOR_HIGHLIGHTTEXT;
$_c->clBtnFace = clSystemColor | COLOR_BTNFACE;
$_c->clBtnShadow = clSystemColor | COLOR_BTNSHADOW;
$_c->clGrayText = clSystemColor | COLOR_GRAYTEXT;
$_c->clBtnText = clSystemColor | COLOR_BTNTEXT;
$_c->clInactiveCaptionText = clSystemColor | COLOR_INACTIVECAPTIONTEXT;
$_c->clBtnHighlight = clSystemColor | COLOR_BTNHIGHLIGHT;
$_c->cl3DDkShadow = clSystemColor | COLOR_3DDKSHADOW;
$_c->cl3DLight = clSystemColor | COLOR_3DLIGHT;
$_c->clInfoText = clSystemColor | COLOR_INFOTEXT;
$_c->clInfoBk = clSystemColor | COLOR_INFOBK;
$_c->clHotLight = clSystemColor | COLOR_HOTLIGHT;
$_c->clGradientActiveCaption = clSystemColor | COLOR_GRADIENTACTIVECAPTION;
$_c->clGradientInactiveCaption = clSystemColor | COLOR_GRADIENTINACTIVECAPTION;
$_c->clMenuHighlight = clSystemColor | COLOR_MENUHILIGHT;
$_c->clMenuBar = clSystemColor | COLOR_MENUBAR;

$_c->clBlack = 0x000000;
$_c->clMaroon = 0x000080;
$_c->clGreen = 0x008000;
$_c->clOlive = 0x008080;
$_c->clNavy = 0x800000;
$_c->clPurple = 0x800080;
$_c->clTeal = 0x808000;
$_c->clGray = 0x808080;
$_c->clSilver = 0xC0C0C0;
$_c->clRed = 0x0000FF;
$_c->clLime = 0x00FF00;
$_c->clYellow = 0x00FFFF;
$_c->clBlue = 0xFF0000;
$_c->clFuchsia = 0xFF00FF;
$_c->clAqua = 0xFFFF00;
$_c->clLtGray = 0xC0C0C0;
$_c->clDkGray = 0x808080;
$_c->clWhite = 0xFFFFFF;
$_c->StandardColorsCount = 16;

$_c->clMoneyGreen = 0xC0DCC0;
$_c->clSkyBlue = 0xF0CAA6;
$_c->clCream = 0xF0FBFF;
$_c->clMedGray = 0xA4A0A0;
$_c->ExtendedColorsCount = 4;

$_c->clNone = 0x1FFFFFFF;
$_c->clDefault = 0x20000000;

function rect($left,$top,$right,$bottom){
    return new TRect($left,$top,$right,$bottom);
}

function point($x,$y){
    return new TPoint($x,$y);
}

/*
 $cv = new TControlCanvas(c('form1'));
$cv->brush->color = clBlack;
$cv->font->color  = clWhite;
$cv->textOut(100,100, 'Hellow World');
*/
	
$_c->fsBold      = 'fsBold';
$_c->fsItalic    = 'fsItalic';
$_c->fsUnderline = 'fsUnderline';
$_c->fsStrikeOut = 'fsStrikeOut';

function canvas($ctrl = false){
    
    return new TControlCanvas($ctrl);
}

function createImage($filename, $type = 'TBitmap'){
        $result = new $type;
        $result->loadAnyFile($filename);
    return $result;
}