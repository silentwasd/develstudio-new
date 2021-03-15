<?php

return array(
    'parent' => 'TControl',
    'items' => array(
        array(
            'CAPTION' => tm('components.methods.undo'),
            'PROP' => 'undo()',
            'INLINE' => 'undo ( void )'
        ),
        array(
            'CAPTION' => tm('components.methods.clearSelected'),
            'PROP' => 'clearSelected()',
            'INLINE' => 'clearSelected ( void )'
        )
    )
);