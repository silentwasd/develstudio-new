<?php


class myBackup
{
    private static $timer;
    private static $dir;
    private static $count;

    public static function init()
    {
        $timerId = Timer::setInterval('myBackup::doInterval', 60000 * 2);
        self::$timer = c($timerId);
    }

    public static function updateSettings()
    {
        $active = myOptions::get('backup', 'active', true);
        $interval = myOptions::get('backup', 'interval', 2);
        $dir = myOptions::get('backup', 'dir', 'backup');
        $count = myOptions::get('backup', 'count', 3);

        self::setActive($active);
        self::setInterval($interval);
        self::$dir = $dir;
        self::$count = $count > 0 ? $count : 1;
        if ($active)
            self::doInterval();
    }

    public static function isDirValid($dir)
    {
        return preg_match('/^[.\-_a-zа-я0-9]+$/i', $dir);
    }

    private static function setActive($active)
    {
        self::$timer->enable = (bool)$active;
    }

    private static function setInterval($min)
    {
        if ($min < 1)
            $min = 1;

        self::$timer->interval = $min * 60000;
    }

    private static function doInterval()
    {
        global $projectFile;

        if (!self::isDirValid(self::$dir))
            self::$dir = 'backup';

        $dir = dirname($projectFile) . '/' . self::$dir . '/';

        if (!is_dir($dir))
            mkdir($dir, 0777, true);

        $file = basenameNoExt($projectFile) . date('(d.m.Y h.i)');

        $src = $dir . $file . '.dvs';
        $statusSrc = self::$dir . '/' . $file . '.dvs';

        myCompile::setStatus('Backup', t('Создание резервной копии - ') . '"' . $statusSrc . '"');
        myProject::saveAsDVS($src);

        $backupCount = self::backupCount();
        if ($backupCount > self::$count) {
            $files = findFiles(self::fullDir());
            $unnecessary = array_slice($files, 0, $backupCount - self::$count);
            foreach ($unnecessary as $file)
                unlink(self::fullDir() . '/' . $file);
        }
    }

    private static function fullDir()
    {
        global $projectFile;
        return dirname($projectFile) . '/' . self::$dir;
    }

    private static function backupCount()
    {
        return count(findFiles(self::fullDir()));
    }
}

myBackup::init();