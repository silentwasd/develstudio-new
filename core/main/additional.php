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

class TCoolTrayIcon extends TControl {
	public $class_name = __CLASS__;
	protected $_picture;
	protected $_icon;
	
	public function get_picture(){
		
		if (!isset($this->_picture)){
			$this->_picture = new TIcon(false);
			$this->_picture->self = __rtii_link($this->self,'Icon');
			$this->_picture->parent_object = $this->self;
		}
		
		return $this->_picture;
	}
	
	public function get_icon(){
		return $this->picture;
	}
	
	public function loadPicture($file){
		
		$this->picture->loadAnyFile($file);
	}
	
	public function loadFromBitmap($bt){
		
		$this->picture->assign($bt);
	}
	
	public function set_iconFile($v){
		
		$this->aiconFile = $v;
		$v = getFileName($v);
		if (!file_exists($v)) return;
		
		$this->loadPicture($v);
	}
	
	public function get_iconFile(){
		return $this->aiconFile;
	}
	
	public function get_hint(){
		return $this->get_prop('hint');
	}
	
	public function set_hint($v){
		$this->set_prop('hint',$v);
	}
	
	public function assign($icon){
		trayicon_assign($this->self, $icon->self);
	}
	
	public function showBalloonTip(){
		
		return trayicon_balloontip($this->self, $this->title, $this->text, $this->flag, $this->timeout);
	}
	
	public function hideBalloonTip(){
		return trayicon_hideballoontip($this->self);
	}
}

class TTrackBar extends TControl {
	public $class_name = __CLASS__;
}


class THotKey extends TControl {
	public $class_name = __CLASS__;
	
	public function set_hotKey($sc){
		
		if (!is_numeric($sc))
			$sc = text_to_shortcut(strtoupper($sc));
		$this->set_prop('hotKey',$sc);
	}
	
	public function get_hotKey(){
		
		$result = $this->get_prop('hotKey');
		return shortCut_to_text($result);
	}
}



class TMaskEdit extends TControl {
	public $class_name = __CLASS__;
}


class TImage extends TControl {
	public $class_name = __CLASS__;
	protected $_picture;
	
	public function get_picture(){
		
		if (!isset($this->_picture)){
			$this->_picture = new TPicture(false);
			$this->_picture->self = __rtii_link($this->self,'Picture');
			$this->_picture->parent_object = $this->self;
		}
		
		return $this->_picture;
	}
	
	public function getCanvas(){
		
		$tmp = new TCanvas(false);
		$tmp->self = component_canvas($this->self);
		
		return $tmp;
	}
	
	public function loadPicture($file){
		
		$this->picture->loadAnyFile($file);
	}
	
	public function loadFromFile($file){
		$this->loadPicture($file);
	}
	
	public function loadFromBitmap($bt){
		
		$this->picture->assign($bt);
	}
	
	public function loadFromUrl($url, $ext = false){
		$this->picture->loadFromUrl($url, $ext = false);
	}
	
	public function saveToFile($file){
		$file = replaceSl($file);
		$this->picture->saveToFile($file);
	}
}

class TMImage extends TImage {
    
    public $class_name = __CLASS__;
}

class TDrawGrid extends TControl {
	public $class_name = __CLASS__;
}

class TShape extends TControl {
	public $class_name = __CLASS__;
	
	protected $_brush;
	protected $_pen;

	
	public function get_brush(){
		
		if (!$this->_brush){
			$this->_brush = new TBrush(false);
			$this->_brush->self = __rtii_link($this->self,'Brush');
		}
		return $this->_brush;
	}
	
	public function get_pen(){
		
		if (!$this->_pen){
			
			$this->_pen   = new TPen(false);
			$this->_pen->self   = __rtii_link($this->self,'Pen');
		}
		
		return $this->_pen;
	}
	
	function get_brushColor(){ return $this->brush->color; }
	function set_brushColor($v){ $this->brush->color = $v; }
	function get_brushStyle(){ return $this->brush->style; }
	function set_brushStyle($v){ $this->brush->style = $v; }
	
	function get_penColor(){ return $this->pen->color; }
	function set_penColor($v){ $this->pen->color = $v; }
	function get_penMode(){ return $this->pen->mode; }
	function set_penMode($v){ $this->pen->mode = $v; }
	function get_penStyle(){ return $this->pen->style; }
	function set_penStyle($v){ $this->pen->style = $v; }
	function get_penWidth(){ return $this->pen->width; }
	function set_penWidth($v){ $this->pen->width = $v; }
}

class TBevel extends TControl {
	public $class_name = __CLASS__;
}

class TScrollBox extends TControl {
	public $class_name = __CLASS__;
	protected $_constraints;	
	
	function get_constraints(){
		if (!isset($this->_constraints)){
			$this->_constraints = new TSizeConstraints(nil, false);
			$this->_constraints->self = __rtii_link($this->self,'constraints');
		}
		return $this->_constraints;
	}
	
	public function isVScrollShowing(){
		
		return scrollbox_vsshowing($this->self);
	}
	
	public function isHScrollShowing(){
		
		return scrollbox_hsshowing($this->self);
	}
	
	public function get_scrollBarSize(){
		return scrollbox_sbsize($this->self);
	}
}

class TCheckListBox extends TControl {
	public $class_name = __CLASS__;
	protected $_items;
	
	function get_items(){
		if (!isset($this->_items)){
			$this->_items = new TStrings(false);
			$this->_items->self = __rtii_link($this->self,'Items');
			$this->_items->parent_object = $this->self;
		}
		return $this->_items;
	}
	
	function isChecked($index){
		
		return checklist_checked($this->self, $index);
	}
	
	function setChecked($index, $value = true){
		checklist_setchecked($this->self, $index, $value);
	}
	
	function get_checkedItems(){
		$result = array();
		$list = $this->items->lines;
		if (count($list))
		foreach ($list as $index=>$v){
			if ($this->isChecked($index))
				$result[$index] = $v;
		}
		
		return $result;
	}
	
	function set_checkedItems($v){
		
		$list = $this->items->lines;
		
		if (count($list))
		foreach ($list as $index=>$x){
			
			$this->setChecked($index, in_array($x, $v));
		}
	}
	
	function unCheckedAll(){
		$this->checkedItems = array();
	}
	
	function checkedAll(){
		$list = $this->items->lines;
		$this->checkedItems = $list;
	}
	
	function get_itemIndex(){
		return $this->items->itemIndex;
	}
	
	function set_itemIndex($v){
		$this->items->itemIndex = $v;
	}
	
	function set_inText($v){
		$this->items->setLine($this->itemIndex, $v);
	}
	
	function get_inText(){
		return $this->items->getLine($this->itemIndex);
	}
	
	function set_text($v){
		$this->items->text = $v;
	}
	
	function clear(){
		
		$this->text = '';
	}
	
	function get_text(){
		return $this->items->text;
	}
}

class TSplitter extends TControl {
	public $class_name = __CLASS__;
}

class TStaticText extends TControl {
	public $class_name = __CLASS__;
}

class TControlBar extends TControl {
	public $class_name = __CLASS__;
}

class TValueListEditor extends TControl {
	public $class_name = __CLASS__;
}

class TLabeledEdit extends TControl {
	public $class_name = __CLASS__;
}

class TColorBox extends TControl {
	public $class_name = __CLASS__;
}

class TStatusBar extends TControl {
	public $class_name = __CLASS__;
	
	function __construct($onwer=nil,$init=true,$self=nil){
		parent::__construct($onwer,$init,$self);
		
		if ($init){
			$this->useSystemFont = false;
			$this->simplePanel   = true;
		}
	}
}

class TColorListBox extends TControl {
	public $class_name = __CLASS__;
}


class TTabSet extends TControl {
	public $class_name = __CLASS__;
}


class TTabControl extends TControl {
	public $class_name = __CLASS__;
	protected $_tabs;
	
	function get_tabs(){
		if (!isset($this->_tabs)){
			$this->_tabs = new TStrings(false);
			$this->_tabs->self = gui_propGet($this->self,'tabs');
			$this->_tabs->parent_object = $this->self;
		}
		return $this->_tabs;
	}
	
	function addPage($caption){
		
		$tabs = $this->tabs;
		$tabs->add($caption);
	}
	
	
	function indexOfTabXY($x, $y){
		
		return tabcontrol_indexofxy($this->self, $x, $y);
	}
	
	function set_text($v){
		$this->tabs->text = $v;
	}
	
	function get_text(){
		return $this->tabs->text;
	}
}

class TPageControl extends TControl {
	public $class_name = __CLASS__;
	public $pages;
	
	function __loadDesign(){
		
		$this->__initComponentInfo();
	}
	
	function __initComponentInfo(){
		
		$index = (int)$this->apageIndex;
		if ($index == 0){
			if ($this->pageCount == 1){
				$this->addPage('-');
				$this->pageIndex = 1;
				$this->pageIndex = $index;
				$this->delete(1);
			} else {
				$this->pageIndex = 1;
				$this->pageIndex = $index;
			}
		} else {
			$this->pageIndex = $index;
		}
	}
	
	function set_ActivePage($page){
		
		pagecontrol_activepage($this->self, $page->self);
		$this->apageIndex = $this->pageIndex;
	}
	
	function get_ActivePage(){
		
		return _c(pagecontrol_activepage($this->self, null));
	}
	
	function addPage($caption){
		
		$p = new TTabSheet(_c($this->owner));
		$p->parent = $this;
		$p->parentControl = $this;
		$p->caption = $caption;
		$p->doubleBuffer = true;
		$p->aenabled = true;
		$p->avisible = true;
		
		return $p;
	}
	
	function get_pageCount(){
		
		return pagecontrol_pagecount($this->self);
	}
	
	function pages(){
		
		$c = $this->pageCount;
		
		for ($i=0; $i<$c; $i++){
			
			$result[] = _c(pagecontrol_pages($this->self,$i));
		}
		
		return $result;
	}
	
	function set_pageIndex($v){
		$pages = $this->pages();
		
		if ($pages[$v]){
			//c('fmMain')->caption = ($pages[$v]->caption);
			$this->ActivePage = $pages[$v];
			$pages[$v]->visible = true;
		}
	}
	
	function get_pageIndex(){
		
		$a_page = $this->ActivePage;
		$pages  = $this->pages();
		
		for ($i=0; $i<count($pages); $i++){
			if ($pages[$i]->self == $a_page->self)
				return $i;
		}
		return -1;
	}
	
	function set_pagesList($arr){
		
		if (!is_array($arr))
			$arr = explode(_BR_, $arr);
		
		foreach ($arr as $i=>$el){
			if ($el)
			$tmp[] = trim($el);
		}
		
		unset($arr);
		$arr =& $tmp;
		
		$pages = $this->pages();
		for ($i=0; $i<count($pages); $i++){
			
			if (count($arr)-1<$i){
				$pages[$i]->free();
			} else {
				$pages[$i]->caption = $arr[$i];
			}
		}
		
		for ($i=count($pages)-1; $i<count($arr)-1; $i++)
			$this->addPage($arr[$i+1]);
		
	}
	
	function get_pagesList(){
		
		$pages = $this->pages();
		$result = array();
		
		
		for($i=0; $i<count($pages); $i++){
			$result[] = $pages[$i]->caption;
		}
		
		return implode(_BR_, $result);
	}
	
	function clear(){
		$pages = $this->pages();
		for ($i=0; $i<count($pages); $i++)
			$pages[$i]->free();
	}
	
	function delete($index){
		$pages = $this->pages();
		
		if ($pages[$index])
			$pages[$index]->free();
	}
	
}

class TTabSheet extends TControl {
	public $class_name = __CLASS__;
	
	function set_parentControl($obj){
		tabsheet_parent($this->self, $obj->self);
	}
	
	function get_parentControl(){
		return _c(tabsheet_parent($this->self,0));
	}
	
	function free(){
		
		foreach ($this->componentList as $el)
			$el->free();
			
		parent::free();
	}
}


class TSizeConstraints extends TComponent {
	
	public $class_name = __CLASS__;
	
	#maxWidth
	#maxHeight
	#minWidth
	#minHeight

}

class TPadding extends TControl {
	
	public $class_name = __CLASS__;
}

class TListItems extends TControl {
	
	public $class_name = __CLASS__;
	
	function delete($index){ listitems_command($this->self, __FUNCTION__, $index,0); }
	function add(){ return _c(listitems_command($this->self, __FUNCTION__,0,0)); }
	function clear(){ listitems_command($this->self, __FUNCTION__,0,0); }
	function addItem($item, $index) { return _c(listitems_command($this->self, __FUNCTION__, $item->self, $index)); }
	function indexOf($item) { return listitems_command($this->self, __FUNCTION__, $item->self, 0); }
	function insert($index) { return _c(listitems_command($this->self, __FUNCTION__, $index, 0)); }
	
	function count(){ return listitems_command($this->self, __FUNCTION__, 0, 0); }
	function get($index){ return _c(listitems_command($this->self, __FUNCTION__, $index, 0)); }
	
	function get_selected(){
		
		$result = array();
		$arr = explode(',',listitems_command($this->self, 'selected', 0,0));
		
		foreach ($arr as $el) if ($el!='')
			$result[] = $el;
		
		return $result;
	}
	
	function set_selected($var){
			
		foreach ($var as $k=>$v)
			listitems_selected($this->self, $k, $v);
	}
	
	function select($index){
		listitems_selected($this->self, $index, true);
	}
	
	function unSelect($index){
		listitems_selected($this->self, $index, false);
	}
	
	function unSelectAll(){
		$c = $this->count();
		for($i=0; $i<$c-1; $i++)
			$this->unSelect($i);
	}
	
	function selectAll(){
		$c = $this->count();
		for($i=0; $i<$c-1; $i++)
			$this->select($i);
	}
	
	function indexByCaption($caption){
		
		$c       = $this->count();
		$caption = strtolower($caption);
		
		for ($i=0; $i<$c; $i++){
			
			$item = $this->get($i);
			if (strtolower($item->caption)==$caption)
				return $i;
		}
		
		return -1;
	}
	
	function selectByCaption($caption){
		
		if (is_array($caption)){
			$this->unSelectAll();
			if (count($caption)){
			foreach ($caption as $el){
				$index = $this->indexByCaption($el);
				if ($index > -1)
					$this->select($index);
			}
			}
		} else {
			$index = $this->indexByCaption($caption);
			$this->unSelectAll();
			if ($index > -1)
				$this->select($index);
		}
	}
	
	function get_selectedCaption(){
		
		$arr    = $this->selected;
		$result = array();
		foreach ($arr as $id){
			
			$result[] = $this->get($id)->caption;
		}
		return $result;
	}
	
	function set_selectedCaption($caption){
		$this->selectByCaption($caption);
	}
}

class TListItem extends TControl {
	
	public $class_name = __CLASS__;
	
	function delete(){ listitem_command($this->self, __FUNCTION__); }
	function update(){ listitem_command($this->self, __FUNCTION__); }
	function canceledit(){ listitem_command($this->self, __FUNCTION__); }
	function editcaption(){ return listitem_command($this->self, __FUNCTION__); }
	
	function get_index(){ return listitem_prop($this->self, __FUNCTION__, null);}
	function get_selected() { return listitem_prop($this->self, __FUNCTION__, null);}
	
	function get_imageindex() {return listitem_prop($this->self, __FUNCTION__, null);}
	function get_stateindex() {return listitem_prop($this->self, __FUNCTION__, null);}
	function get_indent() {return listitem_prop($this->self, __FUNCTION__, null);}
	function get_caption() {return listitem_prop($this->self, __FUNCTION__, null);}
	function get_checked() {return listitem_prop($this->self, __FUNCTION__, null);}
	
	function set_imageindex($v) {listitem_prop($this->self, __FUNCTION__, $v);}
	function set_stateindex($v) {listitem_prop($this->self, __FUNCTION__, $v);}
	function set_indent($v) {listitem_prop($this->self, __FUNCTION__, $v);}
	function set_caption($v) {listitem_prop($this->self, __FUNCTION__, $v);}
	function set_checked($v) {listitem_prop($this->self, __FUNCTION__, $v);}
	
	function set_subItems($arr){
		
		if (is_array($arr))
			$arr = implode(_BR_, $arr);
		
		listitem_prop($this->self, __FUNCTION__, $arr);
	}
	
	function get_subItems(){
		$str = listitem_prop($this->self, __FUNCTION__, null);
		return explode(_BR_, $str);
	}
}

class TListView extends TControl {
	
	public $class_name = __CLASS__;
	protected $_items;
	
	function get_items(){
		
		if (!$this->_items){
			$this->_items = new TListItems($this,false);
			$this->_items->self = __rtii_link($this->self,'items');
		}
		return $this->_items;
	}
	
	function set_images($c){
		imagelist_set_images($this->self, $c->self);
	}
	
	function get_selected(){
		return $this->items->get_selected();
	}
}


class TDateTimePicker extends TControl {
	
	public $class_name = __CLASS__;
	
	public function get_date(){
		
		return datetime_str($this->get_prop('date'));
	}
	
	function set_date($v){ $this->set_prop('date', str_datetime($v)); }
	
	function get_maxDate(){ return datetime_str($this->get_prop('maxDate'));}
	function get_minDate(){ return datetime_str($this->get_prop('minDate'));}
	function get_time(){return wtime_str($this->get_prop('time'));}
	
	function set_maxDate($v){ $this->set_prop('maxDate', str_datetime($v)); }
	function set_minDate($v){ $this->set_prop('minDate', str_datetime($v)); }
	function set_time($v){ $this->set_prop('time', str_wtime($v)); }
	
}

class TTreeView extends TControl {
	
	public $class_name = __CLASS__;
	
	public function loadFromStr($str){
		
		tree_loadstr($this->self,$str);
	}
	
	public function get_text(){
		
		return tree_gettext($this->self);
	}
	
	public function set_text($v){
		$this->loadFromStr($v);
	}
	
	public function get_itemSelected(){
		
		$arr = explode(_BR_,$this->text);
		return trim($arr[ $this->absIndex ]);
	}
	
	public function set_itemSelected($v){
		
		$this->absIndex = -1;
		$v   = strtolower($v);
		$arr = explode(_BR_,$this->text);
		foreach ($arr as $i=>$text){
			$text = strtolower(trim($text));
			if ($v==$text){
				$this->absIndex = $i;
			}
		}
	}
	
	public function get_selected(){
		
		$res = tree_selected($this->self);
		if ($res === null){
			return null;
		} else
			return _c( $res );
	}
	
	public function set_selected($v){
		
		tree_select($this->self, $v->self);
	}
	
	public function get_absIndex(){
		$sel = $this->selected;
		if ($sel)
			return $sel->absIndex;
		else
			return -1;
	}
	
	public function set_absIndex($v){
		return tree_setAbsIndex($this->self, (int)$v);
	}
	
	public function fullExpand(){
		tree_fullExpand($this->self);
	}
	
	public function fullCollapse(){
		tree_fullCollapse($this->self);
	}
}

class TTreeNode extends TControl {
	
	public $class_name = __CLASS__;
	
	public function get_absIndex(){
		return tree_absIndex($this->self);
	}
}



?>