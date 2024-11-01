<?php
/**
* WCAL customizer repeater class
*
*
* @package wcal
*/

if( class_exists('WP_Customize_Control')):
    if(!class_exists('WCAL_Repeater_Controler')){
       /**
         * Repeater Custom Control
        */
        class WCAL_Repeater_Controler extends WP_Customize_Control {
            /**
             * The control type.
             *
             * @access public
             * @var string
            */



            public $type = 'repeater';

            public $wcal_box_label = '';

            public $wcal_box_add_control = '';

            private $cats = '';

            /**
             * The fields that each container row will contain.
             *
             * @access public
             * @var array
             */
            public $fields = array();

            /**
             * Repeater drag and drop controler
             *
             * @since  1.0.0
             */
            public function __construct( $manager, $id, $args = array(), $fields = array() ) {
                $this->fields = $fields;
                $this->wcal_box_label = $args['wcal_box_label'] ;
                $this->wcal_box_add_control = $args['wcal_box_add_control'];
                $this->cats = get_categories(array( 'hide_empty' => false ));
                parent::__construct( $manager, $id, $args );
            }

            public function render_content() {

                $values = json_decode($this->value());
                ?>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

                <?php if($this->description){ ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
                <?php } ?>

                <ul class="wcal-repeater-field-control-wrap">
                    <?php
                    $this->wcal_get_fields();
                    ?>
                </ul>

                <input type="hidden" <?php esc_attr( $this->link() ); ?> class="wcal-repeater-collector" value="<?php echo esc_attr( $this->value() ); ?>" />
                <button type="button" class="button wcal-add-control-field"><?php echo esc_html( $this->wcal_box_add_control ); ?></button>
                <?php
            }

            private function wcal_get_fields(){
                $fields = $this->fields;
                $values = json_decode($this->value());

                if(is_array($values)){
                    foreach($values as $value){
                        ?>
                        <li class="wcal-repeater-field-control">
                            <h3 class="wcal-repeater-field-title"><?php echo esc_html( $this->wcal_box_label ); ?></h3>

                            <div class="wcal-repeater-fields">
                                <?php
                                foreach ($fields as $key => $field) {
                                    $class = isset($field['class']) ? $field['class'] : '';
                                    ?>
                                    <div class="wcal-fields wcal-type-<?php echo esc_attr($field['type']).' '.$class; ?>">
                                        <?php 
                                        $label = isset($field['label']) ? $field['label'] : '';
                                        $description = isset($field['description']) ? $field['description'] : '';
                                        if($field['type'] != 'checkbox'){ ?>
                                        <span class="customize-control-fields"><?php echo esc_html( $label ); ?></span>
                                        <span class="description customize-control-description"><?php echo esc_html( $description ); ?></span>
                                        <?php 
                                    }

                                    $new_value = isset($value->$key) ? $value->$key : '';
                                    $default = isset($field['default']) ? $field['default'] : '';

                                    switch ($field['type']) {
                                        case 'text':
                                        echo '<input data-default="'.esc_attr($default).'" data-name="'.esc_attr($key).'" type="text" value="'.esc_attr($new_value).'"/>';
                                        break;

                                        case 'textarea':
                                        echo '<textarea data-default="'.esc_attr($default).'"  data-name="'.esc_attr($key).'">'.esc_textarea($new_value).'</textarea>';
                                        break;

                                        case 'upload':
                                        $image = $image_class= "";
                                        if($new_value){ 
                                            $image = '<img src="'.esc_url($new_value).'" style="max-width:100%;"/>';    
                                            $image_class = ' hidden';
                                        }
                                        echo '<div class="wcal-fields-wrap">';
                                        echo '<div class="attachment-media-view">';
                                        echo '<div class="placeholder'.$image_class.'">';
                                        _e('No image selected', 'wp-custom-admin-login');
                                        echo '</div>';
                                        echo '<div class="thumbnail thumbnail-image">';
                                        echo $image;
                                        echo '</div>';
                                        echo '<div class="actions clearfix">';
                                        echo '<button type="button" class="button wcal-delete-button align-left">'.esc_html__('Remove', 'wp-custom-admin-login').'</button>';
                                        echo '<button type="button" class="button wcal-upload-button alignright">'.esc_html__('Select Image', 'wp-custom-admin-login').'</button>';
                                        echo '<input data-default="'.esc_attr($default).'" class="upload-id" data-name="'.esc_attr($key).'" type="hidden" value="'.esc_attr($new_value).'"/>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';                          
                                        break;

                                        case 'category':
                                        echo '<select data-default="'.esc_attr($default).'"  data-name="'.esc_attr($key).'">';
                                        echo '<option value="0">'.esc_html__('Select Category', 'wp-custom-admin-login').'</option>';
                                        echo '<option value="-1">'.esc_html__('Latest Posts', 'wp-custom-admin-login').'</option>';
                                        foreach ( $this->cats as $cat )
                                        {
                                            printf('<option value="%s" %s>%s</option>', esc_attr($cat->term_id), selected($new_value, $cat->term_id, false), esc_html($cat->name));
                                        }
                                        echo '</select>';
                                        break;

                                        case 'select':
                                        $options = $field['options'];
                                        echo '<select  data-default="'.esc_attr($default).'"  data-name="'.esc_attr($key).'">';
                                        foreach ( $options as $option => $val )
                                        {
                                            printf('<option value="%s" %s>%s</option>', esc_attr($option), selected($new_value, $option, false), esc_html($val));
                                        }
                                        echo '</select>';
                                        break;

                                        case 'checkbox':
                                        echo '<label>';
                                        echo '<input data-default="'.esc_attr($default).'" value="'.$new_value.'" data-name="'.esc_attr($key).'" type="checkbox" '.checked($new_value, 'yes', false).'/>';
                                        echo esc_html( $label );
                                        echo '<span class="description customize-control-description">'.esc_html( $description ).'</span>';
                                        echo '</label>';
                                        break;

                                        case 'colorpicker':
                                        echo '<input data-default="'.esc_attr($default).'" class="wcal-color-picker" data-alpha="true" data-name="'.esc_attr($key).'" type="text" value="'.esc_attr($new_value).'"/>';
                                        break;

                                        case 'selector':
                                        $options = $field['options'];
                                        echo '<div class="selector-labels">';
                                        foreach ( $options as $option => $val ){
                                            $class = ( $new_value == $option ) ? 'selector-selected': '';
                                            echo '<label class="'.$class.'" data-val="'.esc_attr($option).'">';
                                            echo '<img src="'.esc_url($val).'"/>';
                                            echo '</label>'; 
                                        }
                                        echo '</div>';
                                        echo '<input data-default="'.esc_attr($default).'" type="hidden" value="'.esc_attr($new_value).'" data-name="'.esc_attr($key).'"/>';
                                        break;

                                        case 'radio':
                                        $options = $field['options'];
                                        echo '<div class="radio-labels">';
                                        foreach ( $options as $option => $val ){
                                            echo '<label>';
                                            echo '<input value="'.esc_attr($option).'" type="radio" '.checked($new_value, $option, false).'/>';
                                            echo $val;
                                            echo '</label>'; 
                                        }
                                        echo '</div>';
                                        echo '<input data-default="'.esc_attr($default).'" type="hidden" value="'.esc_attr($new_value).'" data-name="'.esc_attr($key).'"/>';
                                        break;

                                        case 'switch':
                                        $switch = $field['switch'];
                                        $switch_class = ($new_value == 'on') ? 'switch-on' : '';
                                        echo '<div class="onoffswitch '.$switch_class.'">';
                                        echo '<div class="onoffswitch-inner">';
                                        echo '<div class="onoffswitch-active">';
                                        echo '<div class="onoffswitch-switch">'.esc_html($switch["on"]).'</div>';
                                        echo '</div>';
                                        echo '<div class="onoffswitch-inactive">';
                                        echo '<div class="onoffswitch-switch">'.esc_html($switch["off"]).'</div>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '<input data-default="'.esc_attr($default).'" type="hidden" value="'.esc_attr($new_value).'" data-name="'.esc_attr($key).'"/>';
                                        break;

                                        case 'range':
                                        $options = $field['options'];
                                        $new_value = $new_value ? $new_value : $options['val'];
                                        echo '<div class="wcal-range-slider" >';
                                        echo '<div class="range-input" data-defaultvalue="'. esc_attr($options['val']) .'" data-value="' . esc_attr($new_value) . '" data-min="' . esc_attr($options['min']) . '" data-max="' . esc_attr($options['max']) . '" data-step="' . esc_attr($options['step']) . '"></div>';
                                        echo '<input  class="range-input-selector" type="text" value="'.esc_attr($new_value).'"  data-name="'.esc_attr($key).'"/>';
                                        echo '<span class="unit">' . esc_html($options['unit']) . '</span>';
                                        echo '</div>';
                                        break;

                                        case 'icon':
                                        echo '<div class="wcal-selected-icon">';
                                        echo '<i class="fa fa-facebook'.esc_attr($new_value).'"></i>';
                                        echo '<span class="wcal-icon-span"><i class="fa fa-chevron-down"></i></span>';
                                        echo '</div>';
                                        echo '<ul class="wcal-icon-list clearfix">';
                                        $wcal_icons_array = $this->wcal_icons_array();
                                        foreach ($wcal_icons_array as $wcal_font_awesome_icon) {
                                            $icon_class = $new_value == $wcal_font_awesome_icon ? 'icon-active' : '';
                                            echo '<li class='.$icon_class.'><i class="fa '.$wcal_font_awesome_icon.'"></i></li>';
                                        }
                                        echo '</ul>';
                                        echo '<input data-default="'.esc_attr($default).'" type="hidden" value="'.esc_attr($new_value).'" data-name="'.esc_attr($key).'"/>';
                                        break;

                                        case 'multicategory':
                                        $new_value_array = !is_array( $new_value ) ? explode( ',', $new_value ) : $new_value;
                                        echo '<ul class="wcal-multi-category-list">';
                                        echo '<li><label><input type="checkbox" value="-1" '. checked('-1', $new_value, false ) .'/>'.esc_html__( 'Latest Posts', 'wp-custom-admin-login' ).'</label></li>';
                                        foreach ( $this->cats as $cat ){
                                            $checked = in_array( $cat->term_id, $new_value_array) ? 'checked="checked"' : '';
                                            echo '<li>';
                                            echo '<label>';
                                            echo '<input type="checkbox" value="'.esc_attr($cat->term_id).'" '. $checked .'/>'; 
                                            echo esc_html( $cat->name );
                                            echo '</label>';
                                            echo '</li>';
                                        }
                                        echo '</ul>';
                                        echo '<input data-default="'.esc_attr($default).'" type="hidden" value="'.esc_attr(implode( ',', $new_value_array )).'" data-name="'.esc_attr($key).'"/>';
                                        break;

                                        default:
                                        break;
                                    }
                                    ?>
                                    </div>
                                    <?php
                                } 
                                ?>
                                <div class="clearfix wcal-repeater-footer">
                                    <div class="alignright">
                                        <a class="wcal-repeater-field-remove" href="#remove"><?php _e('Delete', 'wp-custom-admin-login') ?></a> |
                                        <a class="wcal-repeater-field-close" href="#close"><?php _e('Close', 'wp-custom-admin-login') ?></a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php   
                    }
                }
            }

            function wcal_icons_array(){
                $wcal_icons_array_raw =
                    'fa-facebook,
                     fa-instagram,
                     fa-twitter,
                     fa-youtube-play,
                     fa-google-plus,
                     fa-pinterest
                     ' ;
                $wcal_icons_array = explode( "," , $wcal_icons_array_raw);
                return $wcal_icons_array;
            }

        }  
    }
endif;