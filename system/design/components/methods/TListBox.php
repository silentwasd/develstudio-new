<?php

return array(
    'parent' => 'TControl',
    'items' => array(
        array(
            'CAPTION' => tm('components.methods.getFont'),
            'PROP' => 'getFont()',
            'INLINE' => 'TFont getFont ( int index )',
        ),
        array(
            'CAPTION' => tm('components.methods.clearFont'),
            'PROP' => 'clearFont()',
            'INLINE' => 'clearFont ( int index )',
        ),
        array(
            'CAPTION' => tm('components.methods.getItemColor'),
            'PROP' => 'getItemColor()',
            'INLINE' => 'int getItemColor ( int index )',
        ),
        array(
            'CAPTION' => tm('components.methods.setItemColor'),
            'PROP' => 'setItemColor()',
            'INLINE' => 'setItemColor ( int index, int color )',
        ),
        array(
            'CAPTION' => tm('components.methods.clearItemColor'),
            'PROP' => 'clearItemColor()',
            'INLINE' => 'clearItemColor ( int index )',
        ),
        array(
            'CAPTION' => tm('components.methods.clear'),
            'PROP' => 'clear()',
            'INLINE' => 'clear ( void )'
        )
    )
);