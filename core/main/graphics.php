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
  

///////////////////////////////////////////////////////////////////////////////
///                             TPoint                                      ///
///////////////////////////////////////////////////////////////////////////////
class TPoint{
    
    public $x;
    public $y;
    
    function __construct($x,$y){
        $this->x = (integer)$x;
        $this->y = (integer)$y;
    }
}

///////////////////////////////////////////////////////////////////////////////
///                             TRect                                       ///
///////////////////////////////////////////////////////////////////////////////
class TRect{
    
    public $left;
    public $top;
    public $right;
    public $bottom;
    
    function __construct($left,$top,$right,$bottom){
        $this->left   = (integer)$left;
        $this->top    = (integer)$top;
        $this->right  = (integer)$right;
        $this->bottom = (integer)$bottom;
    }
}

function rect($left,$top,$right,$bottom){
    return new TRect($left,$top,$right,$bottom);
}

function point($x,$y){
    return new TPoint($x,$y);
}


///////////////////////////////////////////////////////////////////////////////
///                             TPen, TBrush                                ///
///////////////////////////////////////////////////////////////////////////////
class TPen extends TComponent{
    
    public $class_name = __CLASS__;
    public $self;
    function __construct($onwer = nil,$init = true,$self = nil){}
}

class TBrush extends TComponent{
    
    public $class_name = __CLASS__;
    public $self;
    
    function __construct($onwer = nil,$init = true,$self = nil){}
}


///////////////////////////////////////////////////////////////////////////////
///                             TCanvas                                     ///
///////////////////////////////////////////////////////////////////////////////
class TCanvas extends TControl{
        
    public $class_name = __CLASS__;
    public $pen;
    public $brush;
    public $font;
    
    function __construct($init=true){
	
    }
    
    function lineTo($x, $y){
	
	canvas_lineto($this->self,$x,$y);
    }
    
    function moveTo($x, $y){
	
	canvas_moveto($this->self,$x,$y);
    }
    
    function textHeight($text){
	
	return canvas_textHeight($this->self, $text);
    }
    
    function textWidth($text){
	
	return canvas_textWidth($this->self, $text);
    }
    
    function refresh(){
	
	canvas_refresh($this->self);
    }
    
    function pixel($x, $y, $color = null){
	
	if ($color === null)
	    return canvas_pixel($this->self, (int)$x, (int)$y, null);
	else
	    canvas_pixel($this->self, (int)$x, (int)$y, $color);
    }
    
    function textOut($x, $y, $text){
	
	canvas_textout($this->self, $x, $y, $text);
    }
    
    function rectangle($x1, $y1, $x2, $y2){
	
	canvas_rectangle($this->self, $x1, $y1, $x2, $y2);
    }
    
    function ellipse($x1, $y1, $x2, $y2){
	
		canvas_ellipse($this->self, $x1, $y1, $x2, $y2);
    }
    
    function lock(){
		canvas_lock($this->self);
    }
    
    function unlock(){
		canvas_unlock($this->self);
    }
    
    function drawBitmap(TBitmap $bmp, $x = 0, $y = 0){
	
	canvas_drawBitmap($this->self, $bmp->self, $x, $y);
    }
    
    function drawPicture($fileName, $x = 0, $y = 0){
	
		$b = new TBitmap;
		$b->loadAnyFile($fileName);
		$this->drawBitmap($b, $x, $y);
		$b->free();
    }
    
    function clear(){
		canvas_clear($this->self);
    }
    
    // ����� ������ ��� �����
    function textOutAngle($x, $y, $angle, $text){
	
		canvas_angle($this->self,$angle);
		$this->textOut($x, $y, $text);
		canvas_angle($this->self,0);
    }
    
    
    function writeBitmap(TBitmap $bitmap){
	
		canvas_writeBitmap($this->self, $bitmap->self);
    }
    
    function savePicture($filename){
	
		$b = new TBitmap;
		$this->writeBitmap($b);
		$b->saveToFile($filename);
		$b->free();
    }
    
    function saveFile($filename){
		$this->savePicture($filename);
    }
    
    function loadPicture($filename){
		$this->drawPicture(getFileName($filename));
    }
    
    function loadFile($filename){
		$this->drawPicture($filename);
    }
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

class TCanvasFont extends TFont {
    
    
    function prop($prop){
	
	return rtii_get($this, $prop);
    }
	
	function set_name($name){rtii_set($this,'name',$name);}
	function set_size($size){rtii_set($this,'size',$size);}
	function set_color($color){rtii_set($this,'color',$color);}
	function set_charset($charset){rtii_set($this,'charset',$charset);}
	function set_style($style){
	    
	    if (is_array($style)) $style = implode(',', $style);
	    rtii_set($this,'style',$style);
	}
	
	function get_name(){ return $this->prop('name'); }
	function get_color(){ return $this->prop('color'); }
	function get_size(){ return $this->prop('size'); }
	function get_charset(){ return $this->prop('charset'); }
	function get_style(){
	    
	    $result = $this->prop('style');
	    $result = explode(',',$result);
	    foreach ($result as $x=>$e)
		$result[$x] = trim($e);
	    return $result;
	}
}

class TControlCanvas extends TCanvas {
    
    public $class_name = __CLASS__;
    
    function __construct($ctrl = false){
		parent::__construct(nil,true,nil);
		
		$this->self = control_canvas();
		
			$this->brush = new TBrush;
				$this->brush->self = canvas_brush($this->self);
				
				$this->pen = new TPen;
				$this->pen->self = canvas_pen($this->self);
				
				$this->font = new TCanvasFont;
				$this->font->self = canvas_font($this->self);
			$this->font->size = 15;
		
		if (($ctrl instanceof TControl) || ($ctrl instanceof TBitMap))
			$this->control = $ctrl;
    }
    
    function get_control(){
		return _c(canvas_control($this->self, null));
    }
    
    function set_control($v){
	
		
		if (method_exists($v,'getCanvas')){
			$this->self = $v->getCanvas()->self;
				
				$this->brush = new TBrush;
				$this->brush->self = canvas_brush($this->self);
				
				$this->pen = new TPen;
				$this->pen->self = canvas_pen($this->self);
				
				$this->font = new TCanvasFont;
				$this->font->self = canvas_font($this->self);
			$this->font->size = 15;
		} else {
			canvas_control($this->self, $v->self);
		}
    }
    
    function free(){
        if ($this->self)
            obj_free($this->self);
    }
}

function canvas($ctrl = false){
    
    return new TControlCanvas($ctrl);
}

class TBitmap extends TObject{
    
    public $class_name = __CLASS__;
    public $parent_object = nil;
    
    public function __construct($init=true){
        if ($init)
            $this->self = tbitmap_create();
    }
    
    public function loadFromFile($filename){
	
		$filename = replaceSr(getFileName($filename));
		
		if (fileExt($filename)=='bmp'){
			bitmap_loadfile($this->self,replaceSr($filename));
		} else {
		   
			convert_file_to_bmp($filename, $this->self);
		}
    }
    
    public function saveToFile($filename){
		$filename = replaceSr($filename);
        bitmap_savefile($this->self,replaceSr($filename));
    }
    
    // �������� ����� ��������...
    public function loadAnyFile($filename){
	
		$filename = replaceSr(getFileName($filename));
		convert_file_to_bmp($filename, $this->self);
    }
    
    public function loadFileWithBorder($filename, $border = 1){
        
        $filename = replaceSr(getFileName($filename));
		convert_file_to_bmp_border($filename, $this->self, $border);    
    }
    
    public function loadFromStream($stream){
		picture_loadstream($this->self, $stream->self);
    }
    
    public function saveToStream($stream){
		picture_loadstream($this->self, $stream->self);
    }
    
	public function loadFromStr($str){
		bitmap_loadstr($this->self, $str);
	}
	
	public function saveToStr(&$str){
		$str = bitmap_savestr($this->self);
	}
	
    public function assign($bitmap){
	
		if ($bitmap instanceof TPicture)
			$this->assign($bitmap->getBitmap());
		else
			bitmap_assign($this->self, $bitmap->self);
    }

    public function copyToClipboard(){

            clipboard_assign( $this->self );
    }
    
    public function clear(){
		$this->assign(null);
    }
    
    public function isEmpty(){
		return !bitmap_empty($this->self);
    }
	
	public function getCanvas(){
		
		$tmp = new TCanvas(false);
		$tmp->self = bitmap_canvas($this->self);
		
		return $tmp;
	}
	
	public function setSizes($width, $height){
		bitmap_size($this->self, $width, $height);
	}
}

class TIcon extends TObject{
    
    public $class_name    = __CLASS__;
    public $parent_object = nil;
    
    function __construct($init=true){
        if ($init)
            $this->self = ticon_create();
    }
    
    function loadFromFile($filename){
		$filename = getFileName($filename);
        icon_loadfile($this->self,replaceSr($filename));
    }
    
    function saveToFile($filename){
        icon_savefile($this->self,replaceSr($filename));
    }
    
    function loadAnyFile($filename){
		$this->loadFromFile($filename);
    }
    
    
    function loadFromStream($stream){
	
		picture_loadstream($this->self, $stream->self);
    }
    
    function saveToStream($stream){
	
		picture_loadstream($this->self, $stream->self);
    }
    
    function assign($bitmap){
	
		if ($bitmap instanceof TBitmap){
			icon_assign($this->self, $bitmap->self);
		} elseif ($bitmap instanceof TIcon){
			icon_assign_ico($this->self, $bitmap->self);
		}
    }
    
    function isEmpty(){
	
		return !icon_empty($this->self);
    }
    

    public function copyToClipboard(){

            clipboard_assign( $this->self );
    }
}

class TPicture extends TObject{
    
    public $class_name = __CLASS__;
    public $parent_object = nil;
    
    function __construct($init=true){
        if ($init)
            $this->self = tpicture_create();
    }
    
    function loadAnyFile($filename){
	$this->loadFromFile($filename);
    }
    
    function loadFromFile($filename){
		//$filename = replaceSr($filename);
	$this->clear();
		//$this->getBitmap()->loadAnyFile($filename);
        picture_loadfile($this->self, replaceSr(getFileName($filename)));
    }
    
    function loadFromStream($stream){
	picture_loadstream($this->self, $stream->self);
    }
	
    function loadFromStr($data, $format = 'bmp'){
            
        picture_loadstr($this->self, $data, $format);
    }
    
    function saveToStream($stream){
	
	picture_loadstream($this->self, $stream->self);
    }
    
    function loadFromUrl($url, $ext = false){
	
	// �������� ������ �����
	$text = file_get_contents($url);
	// ��������� �� � ����
	if (!$ext) $ext = fileExt($url);
	
	$file = replaceSl( winLocalPath(CSIDL_TEMPLATES) ) . '/' . md5($url) .'.'. $ext;
	file_put_contents($file,$text);
	
	$this->loadAnyFile($file);
	unlink($file);
    }
    
    function saveToFile($filename){
	$filename = replaceSr($filename);
        picture_savefile($this->self,replaceSr($filename));
    }
    
    function getBitmap(){
	
		$self = picture_bitmap($this->self);
		$result = new TBitmap(false);
		$result->self = $self;
		return $result;
    }
    
    function assign($pic){
	
	if ($pic instanceof TBitmap) 
	    picture_bitmap_assign($this->self, $pic->self);
	else
	    picture_assign($this->self,$pic->self);
    }
    
    function clear(){
	picture_clear($this->self);
    }
    
    function isEmpty(){
	return !picture_empty($this->self);
    }

    public function copyToClipboard(){

            clipboard_assign( $this->self );
    }

    public function pasteFromClipboard(){
           picture_assign($this->self, clipboard_get());
    }
}




function createImage($filename, $type = 'TBitmap'){
        $result = new $type;
        $result->loadAnyFile($filename);
    return $result;
}

?>