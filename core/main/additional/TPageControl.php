<?


class TPageControl extends TControl
{
    public $class_name = __CLASS__;
    public $pages;

    function __loadDesign()
    {

        $this->__initComponentInfo();
    }

    function __initComponentInfo()
    {

        $index = (int)$this->apageIndex;
        if ($index == 0) {
            if ($this->pageCount == 1) {
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

    function addPage($caption)
    {

        $p = new TTabSheet(_c($this->owner));
        $p->parent = $this;
        $p->parentControl = $this;
        $p->caption = $caption;
        $p->doubleBuffer = true;
        $p->aenabled = true;
        $p->avisible = true;

        return $p;
    }

    function delete($index)
    {
        $pages = $this->pages();

        if ($pages[$index])
            $pages[$index]->free();
    }

    function pages()
    {

        $c = $this->pageCount;

        for ($i = 0; $i < $c; $i++) {

            $result[] = _c(pagecontrol_pages($this->self, $i));
        }

        return $result;
    }

    function set_ActivePage($page)
    {

        pagecontrol_activepage($this->self, $page->self);
        $this->apageIndex = $this->pageIndex;
    }

    function get_ActivePage()
    {

        return _c(pagecontrol_activepage($this->self, null));
    }

    function get_pageCount()
    {

        return pagecontrol_pagecount($this->self);
    }

    function set_pageIndex($v)
    {
        $pages = $this->pages();

        if ($pages[$v]) {
            //c('fmMain')->caption = ($pages[$v]->caption);
            $this->ActivePage = $pages[$v];
            $pages[$v]->visible = true;
        }
    }

    function get_pageIndex()
    {

        $a_page = $this->ActivePage;
        $pages = $this->pages();

        for ($i = 0; $i < count($pages); $i++) {
            if ($pages[$i]->self == $a_page->self)
                return $i;
        }
        return -1;
    }

    function set_pagesList($arr)
    {

        if (!is_array($arr))
            $arr = explode(_BR_, $arr);

        foreach ($arr as $i => $el) {
            if ($el)
                $tmp[] = trim($el);
        }

        unset($arr);
        $arr =& $tmp;

        $pages = $this->pages();
        for ($i = 0; $i < count($pages); $i++) {

            if (count($arr) - 1 < $i) {
                $pages[$i]->free();
            } else {
                $pages[$i]->caption = $arr[$i];
            }
        }

        for ($i = count($pages) - 1; $i < count($arr) - 1; $i++)
            $this->addPage($arr[$i + 1]);

    }

    function get_pagesList()
    {

        $pages = $this->pages();
        $result = array();


        for ($i = 0; $i < count($pages); $i++) {
            $result[] = $pages[$i]->caption;
        }

        return implode(_BR_, $result);
    }

    function clear()
    {
        $pages = $this->pages();
        for ($i = 0; $i < count($pages); $i++)
            $pages[$i]->free();
    }

}