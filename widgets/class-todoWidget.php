<?php

class TodoWidget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'TodoWidget',
            __('Todo list', 'todo-lists-for-wp'),
            array('description' => __('Todo List Widget', 'todo-lists-for-wp'))
        );
    }

    public function widget($args, $instance)
    {
        printf("%s", wp_kses_data($args['before_widget']));
        if (isset($instance['title']) && $instance['title'] != '') {
            printf("%s", wp_kses_data($args['before_title']));
            echo apply_filters('widget_title', esc_attr($instance['title']));
            printf("%s", wp_kses_data($args['after_title']));
            ?>
            <div class="todowidget <?php echo esc_attr($args['id']); ?>">
                <?php echo do_shortcode("[todo_lists]"); ?>
            </div>
        <?php
        }
        printf("%s", wp_kses_data($args['after_widget']));
    }

    public function form($instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : esc_html__('Todo List', 'todo-lists-for-wp');
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'todo-lists-for-wp'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
    <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = $new_instance;
        $instance['title'] = sanitize_text_field($instance['title']);
        return $instance;
    }
}
