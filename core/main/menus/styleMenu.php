<?


class styleMenu
{

    // add to style menu main or popup
    static function add($menu)
    {
        stylemenu_command($menu->self, 'add', null);
    }

    static function addItem($item)
    {
        stylemenu_command($item->self, 'additem', null);
    }

    static function selectedColor($color = false)
    {
        return self::param('selectedcolor', $color);
    }

    static function param($name, $value = false)
    {
        if ($value)
            stylemenu_command(0, $name, $color);
        else
            return stylemenu_command(0, $name, null);
    }

    static function menuColor($color = false)
    {
        return self::param('menucolor', $color);
    }

    static function gutterColor($color = false)
    {
        return self::param('guttercolor', $color);
    }

    static function minHeight($v = false)
    {
        return self::param('minheight', $v);
    }

    static function minWidth($v = false)
    {
        return self::param('minwidth', $v);
    }
}