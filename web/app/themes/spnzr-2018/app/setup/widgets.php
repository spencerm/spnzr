<?php
/**
 * Register widgets.
 *
 * @see https://developer.wordpress.org/reference/functions/register_widget/
 */

// register_widget( MyWidgetClass::class );

/**
 * Rich Text widget
 */
register_widget( App\Widgets\Carbon_Rich_Text_Widget::class );
