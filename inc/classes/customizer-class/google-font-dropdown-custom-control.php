<?php

if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;


if ( ! class_exists( 'WCAL_Google_Font_Dropdown_Custom_Control' ) ){
    /**
     * A class to create a dropdown for all google fonts
     */
    class WCAL_Google_Font_Dropdown_Custom_Control extends WP_Customize_Control{
        private $fonts = false;

        public function __construct($manager, $id, $args = array(), $options = array())
        {
            $this->fonts = $this->get_fonts();
            parent::__construct( $manager, $id, $args );
        }

        /**
         * Render the content of the category dropdown
         *
         * @return HTML
         */
        public function render_content()
        {
            if(!empty($this->fonts))
            {
                ?>
                    <label>
                        <span class="customize-category-select-control customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                        <select <?php $this->link(); ?>>
                            <?php
                                foreach ( $this->fonts as $k => $v )
                                {
                                    printf('<option value="%s" %s>%s</option>', $v->family, selected($this->value(), $v->family, false), $v->family);
                                }
                            ?>
                        </select>
                    </label>
                <?php
            }
        }

        /**
         * Get the google fonts from the API or in the cache
         *
         * @param  integer $amount
         *
         * @return String
         */
        public function get_fonts( $amount = 'all' ){
            $fontFile = WCAL_PATH . 'inc/classes/customizer-class/cache/google-web-fonts.txt';

            //Total time the file will be cached in seconds, set to a week
            $cachetime = 86400 * 7;

            if(file_exists($fontFile) && $cachetime < filemtime($fontFile))
            {
                $content = json_decode(file_get_contents($fontFile));
            } else {

                $googleApi = 'https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=AIzaSyBv0n3TySOXNxig0NJjRBBgVDBae6AGsV4';

                $fontContent = wp_remote_get( $googleApi, array('sslverify'   => false) );

                $fp = fopen($fontFile, 'w');
                fwrite($fp, $fontContent['body']);
                fclose($fp);

                $content = json_decode($fontContent['body']);
            }

            if($amount == 'all'){
                return $content->items;
            } else {
                return array_slice($content->items, 0, $amount);
            }
        }
    }
}

?>