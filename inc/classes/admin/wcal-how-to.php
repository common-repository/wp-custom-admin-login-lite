<?php
/*
* Eight Degree Circular Menu - How to use plugin
*/
defined('ABSPATH') or die("No script kiddies please!");?>
<div class="wcal-wrap wcal-clear">
  <div class="wcal-body-wrapper wcal-add-bar-wrapper">
    <div class="wcal-panel">
      <div class="wcal-panel-head">
        <div class="wcal-head-social-link">
          <span class="wcal-header-close">X</span>
          <p class="wcal-follow-us"><?php _e('Follow us for new updates','wp-custom-admin-login');?></p>
          <div id="fb-root"></div>
          <script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>
          <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
          <a href="https://twitter.com/8degreethemes" class="twitter-follow-button" data-show-count="false"></a>
          <div class="fb-like" data-href="https://www.facebook.com/8DegreeThemes" data-layout="button" data-action="like" data-show-faces="true" data-share="false"></div>
        </div>
      </div>

      <div class="wcal-panel-body">
        <div class="wcal-backend-h-title"><?php _e('How to use','wcal-plugin-pro');?></div>
        <div class="wcal-use-content-wrap">
          <h1><span>WP Custom Admin Login Lite- Free WordPress plugin to make a customized admin login page </span><span class="wcal-version">Version <?php echo WCAL_VERSION;?></span></h1>
          <p>Once you have installed the plugin, you will find a WP Custom Admin Login Lite menu option in your dashboard side bar. Click on the menu and it it will lead you to our about page. You can get information of our product and email address to contract us for any need.</p>
          <p>The backend options of the WP Custom Admin Login Lite plugin is based on WordPress Customizer so click on Start Customizing or hover on the Dashboard admin menu and click on Start Customizing.</p>
          <p>*Note: In the case you are using a multisite, you will not be able to use the Customizer Preview feature and you may see dashboard open inside the Customizer.  If you are using Multisite to access WP Custom Admin login options, simply go to Dashboard-&gt; Appearance-&gt; Customize</p>
          <p>Once you are in the Customizer panel,  go to WP Custom Admin Login Lite Panel. You will see the following sections:</p>
          <ol id="wcal-content-list">
            <li><a href="#wcal-enable-plugin">Enable Plugin</a></li>
            <li><a href="#wcal-select-template">Select Template</a></li>
            <li><a href="#wcal-header-section">Header Section</a></li>
            <li><a href="#wcal-display-option">Display Options</a></li>
            <li><a href="#wcal-login-form">Login Form</a></li>
            <li><a href="#wcal-aditional-content">Additional Content</a></li>
            <li><a href="#wcal-footer-section">Footer Section</a></li>
            <li><a href="#wcal-custom-css">Custom CSS section</a></li> 
          </ol>
          <div class="wcal-how-to-section">
            <h2 id="wcal-enable-plugin"><span>1. Enable Plugin</span> - <a href="#wcal-content-list">Top</a></h2>
            <p>The plugin is turned on at the time of installation. In case you want to disable the plugin or if you think our plugin is causing some issue, check the option to true. This option will act as a kill switch.</p>  
          </div>
          <hr>
          <div class="wcal-how-to-section">
            <h2 id="wcal-select-template"><span>2. Select Template</span> - <a href="#wcal-content-list">Top</a></h2>
            <p>Select template has two settings:</p>
            <ol>
              <li>Templates</li>
              <li>Design</li>
            </ol>
            <div class="wcal-how-to-sub-section">
              <h3>Templates</h3>
              <p>There are 5 different templates which you can choose from. Each template providing a different layout from the other. The plugin uses the built-in login functionality of WordPress and only provides you the design aspects. Select a Template of your liking, click publish and refresh the page. </p>
            </div>
            <div class="wcal-how-to-sub-section">
              <h3>Design </h3>
              <p>
                Once you have selected a template, you can use the template as it is or you can customize different aspects of the templates such as Component colors and Backgrounds.
              </p>
              <ul>
                <li><strong>Enable customization: </strong>Turn on/off the provided customization.</li>
                <li><strong>Background: </strong>The plugin provides you three different background options.
                  <ul>
                    <li><strong>Color: </strong>You can choose from a wide range of colors and even set transparent values or preset values.</li>
                    <li><strong>Image: </strong>You can choose any image from your media library and set it as your form background. Image size may slow your load time so always use optimized images. You can also set background size, repeat and position. The background are set using jarallax.js so all your backgrounds get a parallax effect by default.</li>
                  </ul>
                </li>
                <li><strong>Template Colors: </strong>We have made coloring easy for you by allowing you to change only template colors. Primary colors are the most seen colors, Secondary colors are mostly link hover colors and Tertiary Color are any extra colors to match your template set. Please check the template component and color diagram for better understanding different components and names.</li>
              </ul>
            </div>
          </div>
          <hr>
          <div class="wcal-how-to-section">
            <h2 id="wcal-header-section"><span>3. Header Section</span> - <a href="#wcal-content-list">Top</a></h2>
            <p>Header section consist of two components</p>
            <ol>
              <li>Text</li>
              <li>Logo</li>
            </ol>
            <div class="wcal-how-to-sub-section">
              <h3>Text</h3>
              <ul>
                <li><strong>Header Title: </strong>You can add your header title here. The default value for this is your site title.</li>
                <li><strong>Header Description: </strong>You can add your header description here. The default value for this is your site tagline.</li>
              </ul>
            </div>
            <div class="wcal-how-to-sub-section">
              <h3>Logo</h3>
              <ul>
                <li><strong>Hide Logo: </strong>Turn logo on/off from this settings. Some templates look nice without a logo while for some, your logo may be the greatest asset. </li>
                <li><strong>Set logo: </strong>You can set a logo from the media library. The default logo is the WordPress brand logo.</li>
                <li><strong>Logo URL: </strong>Set where clicking the logo leads to.</li>
                <li><strong>Logo Hover Title: </strong>Set information to show on logo hover.</li>
              </ul>
            </div>
          </div>
          <hr>
          <div class="wcal-how-to-section">
            <h2 id="wcal-display-option"><span>4. Display Options</span> - <a href="#wcal-content-list">Top</a></h2>
            <p>Here you can select option to show or hide different login page components such as:</p>
            <ul>
              <li>Lost password</li>
              <li>Remember me</li>
              <li>Back to option</li>              
            </ul>
          </div>
          <hr>
          <div class="wcal-how-to-section">
            <h2 id="wcal-login-form"><span>5. Login form</span> - <a href="#wcal-content-list">Top</a></h2>
            <p>Login for consist of two sections</p>
            <ol>
              <li>General</li>
              <li>Design</li>
            </ol>
            <div class="wcal-how-to-sub-section">
              <h3>General</h3>
              <p>You can set your form components here like:</p>
              <ul>
                <li><strong>Lost Password Text: </strong>Set the lost password text here</li>
                <li><strong>Remember Me Text: </strong>Set the Remember me text here</li>
                <li><strong>Registration Text: </strong>Set the Registration text here</li>
                <li><strong>Registration Link Text: </strong>Set the Registration link text here</li>
                <li><strong>Registration URL: </strong>You can set the Registration url here. It comes handy if you have a custom registration page.</li>
                <li><strong>Back to Text: </strong>Set the back to text here.</li>
                <li><strong>Back to URL: </strong> Set the back to text URL here. It will lead you to your homepage by default.</li>
              </ul>
            </div>
            <div class="wcal-how-to-sub-section">
              <h3>Design</h3>
              <p>You can added additional colors to your form here. These settings include:</p>
              <ul>
                <li><strong>Enable Customization: </strong>Turn on this to apply color values used in this section.</li>
                <li><strong>Background settings: </strong>You can set two type of background
                  <ul>
                    <li><strong>Color:</strong></li>
                    <li><strong>Image:</strong></li>
                  </ul>
                </li>
                <li><strong>Typography:</strong></li>
                <li><strong>Text Colors:</strong></li>
              </ul>
            </div>
          </div>
          <hr>
          <div class="wcal-how-to-section">
            <h2 id="wcal-aditional-content"><span>8. Additional Content Block</span> - <a href="#wcal-content-list">Top</a></h2>
            <p>For some templates you can add additional text to them to make the templates full. You can add any HTML you like. Here are some of the samples, div structure and classes you can use to get your Templates as our demo.
            </p>
            <h3>Template 1</h3>
            <pre class="wcal-how-to-code">
              <?php
                esc_html_e('
<div class="wcal-additional-content-template-1">
  <div class="wcal-latest-news">Latest News</div>
  <div class="wcal-headline">Puntos Premia is cash.</div>
  <div class="wcal-tagline">Great Theme for your Business and Construction.</div>
  <div class="wcal-readmore"><a href="#">Read more</a> <i class="dashicons dashicons-arrow-right-alt"></i></div>
</div>
                ');
              ?>
            </pre>
          </div>
          <hr>
          <div class="wcal-how-to-section">
            <h2 id="wcal-footer-section"><span>9. Footer Section</span> - <a href="#wcal-content-list">Top</a></h2>
            <p>Footer Section has two components</p>
            <ul>
              <li><strong>Footer Text: </strong>Add your footer text here. You can also add links as 
              <pre class="wcal-how-to-code">
                <?php
                  esc_html_e('
Copyright © 2018 <a href="#">8Degree Themes.</a>
                  ');
                ?>
              </pre>
              </li>
              <li><strong>Social Icons: </strong>You can add social icons to the footer. Select the icon you like add a URL and the Tooltip Text. You can Delete the the icon or leave the URL field empty to not show the icon in the frontend.</li>
            </ul>
          </div>
          <hr>
          <div class="wcal-how-to-section">
            <h2 id="wcal-custom-css"><span>10. Custom CSS</span> - <a href="#wcal-content-list">Top</a></h2>
            <p>If you are not satisfied with the currently design and if all the available customization settings are not enough for you then you can add your own Custom CSS in this section.</p>
          </div>
          <hr>
          <div class="wcal-how-to-section">
            <h2>Documentation link</h2>
            <p>Follow this link for detail documentation: <a href="https://8degreethemes.com/documentation/wp-custom-admin-login-lite/">https://8degreethemes.com/documentation/wp-custom-admin-login-lite/</a> </p>
          </div>
          <div class="wcal-how-to-section">
            <h2>Need Help?</h2>
            <p>If you have any confusion or need our help, drop us a mail at: <a href="support@8degreethemes.com">support@8degreethemes.com</a></p>
          </div>

      </div>
    </div>
  </div>
</div>