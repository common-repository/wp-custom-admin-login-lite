<?php
if( class_exists( 'WP_Customize_Control' ) ) :
    if(!class_exists('WCAL_Header_Control')){
        class WCAL_Header_Control extends WP_Customize_Control{            
            public function render_content() {
                $input_attrs = $this->input_attrs;
                $info = isset($input_attrs['info']) ? $input_attrs['info'] : '';
                $desc = isset($input_attrs['desc']) ? $input_attrs['desc'] : '';
                if(!empty($info)){
                    ?>
                    <h3 class="wcal-customize-header customize-control-title"><?php echo $info; ?></h3>
                    <?php
                }
                if(!empty($desc)){
                    ?>
                    <span class="description customize-control-description"><?php echo $desc; ?></span>
                    <?php
                }
            }
        }
    }
endif;