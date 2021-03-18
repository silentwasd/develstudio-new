<?


class Timer {

    static $exec = array();
    static $data = array();
    static $free = array();

    static function createTimer(){

        $result = 0;
        foreach(Timer::$free as $timer => $busy){
            if ( !$busy ){
                $result = $timer;
                break;
            }
        }

        if ( !$result )
            $result = gui_create('TTimer', null);

        Timer::$free[ $result ] = true;
        return $result;
    }

    static function setInterval($func, $interval){

        $result = Timer::createTimer();
        Timer::setIntervalTime($result, $interval);

        $myfunc = function($self) use ($func){
            Timer::$exec[ $self ] = true;

            call_user_func($func, $self);

            Timer::$exec[ $self ] = false;
        };

        event_set( $result, 'OnTimer', $myfunc );

        return $result;
    }

    static function setTimeout($func, $interval){

        $result = Timer::createTimer();
        Timer::setIntervalTime($result, $interval);

        $myfunc = function($self) use ($func){
            Timer::$exec[ $self ] = true;

            call_user_func($func, $self);

            Timer::removeData( $self );
            gui_propSet( $self, 'enabled', false );
            //gui_safeDestroy( $self );

            Timer::$exec[ $self ] = false;
        };
        event_set( $result, 'OnTimer', $myfunc );

        return $result;
    }

    static function clearTimer($timer){

        if ( gui_is($timer, 'TTimer') ){
            Timer::removeData( $timer );
            Timer::setEnabled( $timer, false );

            event_set( $result, 'OnTimer', null );
            self::$free[ $timer ] = true;
        }
    }

    static function clearInterval($timer){
        self::clearInterval($timer);
    }

    static function clearTimeout($timer){
        self::clearInterval($timer);
    }

    static function setIntervalTime($timer, $interval){
        gui_propSet($timer, 'interval', (int)$interval );
    }

    static function setEnabled($timer, $value){
        gui_propSet($timer, 'enabled', $value);
    }

    static function getEnabled($timer){
        return gui_propGet($timer, 'enabled');
    }

    static function setData($timer, $name, $value){
        if ( gui_is($timer, 'TTimer') ){
            self::$data[ $timer ][ $name ] = $value;
        }
    }

    static function getData($timer, $name){
        if ( gui_is($timer, 'TTimer') ){
            return self::$data[ $timer ][ $name ];
        } else
            return NULL;
    }

    static function removeData($timer){
        unset( self::$data[ $timer ] );
    }
}