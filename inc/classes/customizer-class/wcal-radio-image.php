<?php
if( class_exists('WP_Customize_Control')):
  if(!class_exists('WCAL_Customize_Radioimage_Control')){
    class WCAL_Customize_Radioimage_Control extends WP_Customize_Control {
      public function render_content() {
        if ( empty( $this->choices ) )
          return;
        
        $name = '_customize-radio-' . $this->id;
        ?>
          <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <?php
        if(!empty($this->description)){
          ?>
          <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
          <?php
        }
        ?>
        <ul class="controls" id ="wcal-img-container">
           <?php
           foreach ( $this->choices as $value => $label ) :
                     //$class = ($this->value() == $value)?'the-monday-radio-img-selected the-monday-radio-img-img':'the-monday-radio-img-img';
            $class = ($this->value() == $value)?'wcal-radio-img-selected':' ';
            ?>
            <li>
              <div class="wcal-image-title-wrap <?php echo $class; ?>" >
                <label class="wcal-template-image">
                  <input <?php $this->link(); ?>style = 'display:none' type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
                  <img src = '<?php echo esc_html( $label ); ?>'  class="wcal-radio-img-img" id="lazy" />
                </label>
                <div class="wcal-template-title">
                  <?php 
                    $wcal_broken_label = explode("-",$value);
                    _e($wcal_broken_label[1].' '.$wcal_broken_label[2]);
                  ?>
                </div>
              </div>
            </li>
         <?php endforeach; ?>
        </ul>
        <?php 
      } 
    }
  }
endif;


