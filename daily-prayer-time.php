<?php
/*
Plugin Name: Daily Prayer Time
Version: 1.0
Plugin URI: http://comingsoon.com
Description: Show daily prayer time vertically or horizontally
Author: Mustafiz
Author URI: http://mustafiz.com/
*/
include 'timetable.php';

class DailyPrayerTime extends WP_Widget
{
    public function __construct()
    {
        $widget_details = array(
            'className' => 'DailyPrayerTime',
            'description' => 'Show daily prayer time vertically or horizontally'
        );
        $this->timeTable = new TimeTable();

        parent::__construct('DailyPrayerTime', 'Daily Prayer Time', $widget_details);
    }

    public function form($instance)
    {

        echo "</br>Current selection: <b>" . $instance["choice"] . "</b>";
        $choice = "";
        if( !empty( $instance['choice'] ) ) {
            $choice = $instance['choice'];
   }

        ?>
        <div>
            <span>
            </br></br>
                <input
                    type="radio"
                    name="<?php echo $this->get_field_name( 'choice' ); ?>"
                    value="vertical"
                    <?php if($instance["choice"] === 'vertical'){ echo 'checked="checked"'; } ?>
                />Vertically</br></br>
                <input
                    type="radio"
                    name="<?php echo $this->get_field_name( 'choice' ); ?>"
                    value="horizontal"
                    <?php if($instance["choice"] === 'horizontal'){ echo 'checked="checked"'; } ?>
                />Horizontally</br></br>
            </span>
        </div>

        <div class='mfc-text'>
        </div>

        <?php

        // echo $args['after_widget'];
    }

    public function update( $new_instance, $old_instance ) {
        return $new_instance;
    }

    public function widget($args, $instance)
    {
        if ($instance['choice'] === 'vertical') {
            echo $this->timeTable->verticalTime();
        } else {
            echo $this->timeTable->horizontalTime();
        }
    }
}
add_action('widgets_init', 'init_my_widget');

function init_my_widget()
{
    register_widget('DailyPrayerTime');
}
