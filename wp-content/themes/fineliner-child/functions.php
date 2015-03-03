<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
    wp_enqueue_script('matchHeightjs', get_stylesheet_directory_uri() . '/js/jquery.matchHeight-min.js', array('jquery'), null, false);
}

register_widget('Social_Media_Widget');
class Social_Media_Widget extends WP_Widget {
  private $fields = array(
    'title'          => 'Title (optional)',
  );

  function __construct() {
    $widget_ops = array('classname' => 'widget_social_media', 'description' => __('Use this widget to add a Social Media. Add the social links via theme settings', 'sallykrivaci'));

    $this->WP_Widget('widget_social_media', __('Social Media', 'sallykrivaci'), $widget_ops);
    $this->alt_option_name = 'widget_social_media';

    add_action('save_post', array(&$this, 'flush_widget_cache'));
    add_action('deleted_post', array(&$this, 'flush_widget_cache'));
    add_action('switch_theme', array(&$this, 'flush_widget_cache'));
  }

  function widget($args, $instance) {
    $cache = wp_cache_get('widget_social_media', 'widget');

    if (!is_array($cache)) {
      $cache = array();
    }

    if (!isset($args['widget_id'])) {
      $args['widget_id'] = null;
    }

    if (isset($cache[$args['widget_id']])) {
      echo $cache[$args['widget_id']];
      return;
    }

    ob_start();
    extract($args, EXTR_SKIP);

    $title = apply_filters('widget_title', empty($instance['title']) ? __('', 'sallykrivaci') : $instance['title'], $instance, $this->id_base);

    foreach($this->fields as $name => $label) {
      if (!isset($instance[$name])) { $instance[$name] = ''; }
    }

    echo $before_widget;

    if ($title) {
      echo $before_title, $title, $after_title;
    }
    $social_string = uxbarn_get_footer_social_list_string();
     if ( $social_string != '' ) : ?>
                                <ul class="bar-social">
                                    <?php echo $social_string; ?>
                                </ul>
<?php endif; ?>


  <?php
    echo $after_widget;

    $cache[$args['widget_id']] = ob_get_flush();
    wp_cache_set('widget_social_media', $cache, 'widget');
  }

  function update($new_instance, $old_instance) {
    $instance = array_map('strip_tags', $new_instance);

    $this->flush_widget_cache();

    $alloptions = wp_cache_get('alloptions', 'options');

    if (isset($alloptions['widget_social_media'])) {
      delete_option('widget_social_media');
    }

    return $instance;
  }

  function flush_widget_cache() {
    wp_cache_delete('widget_social_media', 'widget');
  }

  function form($instance) {
    foreach($this->fields as $name => $label) {
      ${$name} = isset($instance[$name]) ? esc_attr($instance[$name]) : '';
    ?>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id($name)); ?>"><?php _e("{$label}:", 'payoneer'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id($name)); ?>" name="<?php echo esc_attr($this->get_field_name($name)); ?>" type="text" value="<?php echo ${$name}; ?>">
    </p>
    <?php
    }
  }
}
