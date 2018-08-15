<?php
$defaultSettings = $this->defail_settings;

$action = $_REQUEST['frm-action'];
if($action && $action == 'RPS_SCROLL_PAGE_TO_TOP_SETTINGS'){
    $response = $this->applyActions($_REQUEST['frm-action'],$_REQUEST);
}
$savedSettings = unserialize(get_option('_rps_scroll_page_to_top_settings'));
?>
<div class="wrap">
    <?php if($response) { ?>
        <?php $_cls = ($response['status'] !== false)?'notice-success':'notice-error error'; ?>
        <div id="message" class="updated notice <?php echo $_cls;?> is-dismissible">
            <p><?php echo $response['msg']?></p>
            <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
        </div>
    <?php } ?>
    <h1>Basic Settings</h1>

    <form method="post" action="">
        <input type="hidden" name="frm-action" value="RPS_SCROLL_PAGE_TO_TOP_SETTINGS" />
        <?php wp_nonce_field('RPS_SCROLL_PAGE_TO_TOP_SETTINGS'); ?>
        <table class="form-table rps">

            <tbody>
            <tr>
                <th scope="row"><label for="scroll_distance">Scroll Distance</label></th>
                <td>
                    <input name="scroll_distance" type="text" id="scroll_distance" value="<?php echo $savedSettings['scroll_distance']?>" class="regular-text"/>
                    <span>px</span>
                    <p class="description" id="scroll_distance_description">Distance from top/bottom before showing element (px).</p>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="scroll_speed">Scroll Speed</label></th>
                <td>
                    <input name="scroll_speed" type="text" id="scroll_speed" value="<?php echo $savedSettings['scroll_speed']?>" class="regular-text"/>
                    <span>px</span>
                    <p class="description" id="scroll_speed_description">Speed back to top (ms).</p>
                </td>
            </tr>

            <tr>
                <th scope="row">Button Animation</th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span>Button Animation</span></legend>
                        <label>
                            <input type="radio" name="button_animation" value="fade" <?php if($savedSettings['button_animation']=='fade'){?> checked="checked"<?php }?>/>
                            <span class="date-time-text format-i18n">Fade</span>
                        </label><br>
                        <label>
                            <input type="radio" name="button_animation" value="slide" <?php if($savedSettings['button_animation']=='slide'){?> checked="checked"<?php }?>/>
                            <span class="date-time-text format-i18n">Slide</span>
                        </label><br>
                        <label>
                            <input type="radio" name="button_animation" value="none" <?php if($savedSettings['button_animation']=='none'){?> checked="checked"<?php }?>/>
                            <span class="date-time-text format-i18n">None</span>
                        </label>
                    </fieldset>
                </td>
            </tr>

            <tr>
                <th scope="row">Button Position<br/><small>Select Scroll to up button position</small></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span>Button Position</span></legend>
                        <label>
                            <input type="radio" name="button_position" value="bottom_right" <?php if($savedSettings['button_position']=='bottom_right'){?> checked="checked"<?php }?>/>
                            <span class="date-time-text format-i18n">Bottom right</span>
                        </label><br>
                        <label>
                            <input type="radio" name="button_position" value="bottom_left" <?php if($savedSettings['button_position']=='bottom_left'){?> checked="checked"<?php }?>/>
                            <span class="date-time-text format-i18n">Bottom left</span>
                        </label>
                    </fieldset>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="distance_from_left_right">Distance from left/right</label></th>
                <td>
                    <input name="distance_from_left_right" type="text" id="distance_from_left_right" value="<?php echo $savedSettings['distance_from_left_right']?>" class="regular-text"/>
                    <span>px</span>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="distance_from_bottom">Distance from bottom</label></th>
                <td>
                    <input name="distance_from_bottom" type="text" id="distance_from_bottom" value="<?php echo $savedSettings['distance_from_bottom']?>" class="regular-text"/>
                    <span>px</span>
                </td>
            </tr>

            <tr>
                <th scope="row">Select "Scroll Page To Top" Method</th>
                <td>
                    <fieldset>
                        <label>
                            <input type="radio" name="rps_scroll_method" class="method_buttons" value="simple_text" <?php if($savedSettings['rps_scroll_method']=='simple_text'){?> checked="checked"<?php }?>/>
                            <span class="date-time-text format-i18n">Simple Text</span>
                        </label><br>
                        <label>
                            <input type="radio" name="rps_scroll_method" class="method_buttons" value="your_image" <?php if($savedSettings['rps_scroll_method']=='your_image'){?> checked="checked"<?php }?>/>
                            <span class="date-time-text format-i18n">Image</span>
                        </label>
                    </fieldset>
                </td>
            </tr>
            <tr class="simple_text" style="display: <?php echo (($savedSettings['rps_scroll_method']=='simple_text')?'table-row':'none');?>;">
                <th scope="row"><label for="rps_label_text">Button Label Text</label></th>
                <td>
                    <input type="text" name="rps_label_text" id="rps_label_text" value="<?php echo $savedSettings['rps_label_text']?>"/>
                </td>
            </tr>
            <tr class="simple_text" style="display: <?php echo (($savedSettings['rps_scroll_method']=='simple_text')?'table-row':'none');?>;">
                <th scope="row"><label for="rps_bga_color">Background Color</label></th>
                <td>
                    <input type="text" name="rps_bga_color" id="rps_bga_color" value="<?php echo $savedSettings['rps_bga_color']?>" class="rps-color-picker" >
                </td>
            </tr>
            <tr class="simple_text" style="display: <?php echo (($savedSettings['rps_scroll_method']=='simple_text')?'table-row':'none');?>;">
                <th scope="row"><label for="rps_hover_bga_color">Hover Background Color</label></th>
                <td>
                    <input type="text" name="rps_hover_bga_color" id="rps_hover_bga_color" value="<?php echo $savedSettings['rps_hover_bga_color']?>" class="rps-color-picker" >
                </td>
            </tr>
            <tr class="simple_text" style="display: <?php echo (($savedSettings['rps_scroll_method']=='simple_text')?'table-row':'none');?>;">
                <th scope="row"><label for="rps_text_color">Text Color</label></th>
                <td>
                    <input type="text" name="rps_text_color" id="rps_text_color" value="<?php echo $savedSettings['rps_text_color']?>" class="rps-color-picker" >
                </td>
            </tr>
            <tr class="simple_text" style="display: <?php echo (($savedSettings['rps_scroll_method']=='simple_text')?'table-row':'none');?>;">
                <th scope="row"><label for="rps_hover_text_color">Hover Text Color</label></th>
                <td>
                    <input type="text" name="rps_hover_text_color" id="rps_hover_text_color" value="<?php echo $savedSettings['rps_hover_text_color']?>" class="rps-color-picker" >
                </td>
            </tr>
            <tr class="simple_text" style="display: <?php echo (($savedSettings['rps_scroll_method']=='simple_text')?'table-row':'none');?>;">
                <th scope="row"><label for="rps_font_size">Font Size</label></th>
                <td>
                    <input type="text" name="rps_font_size" id="rps_font_size" value="<?php echo $savedSettings['rps_font_size']?>" >px
                </td>
            </tr>
            <tr class="simple_text" style="display: <?php echo (($savedSettings['rps_scroll_method']=='simple_text')?'table-row':'none');?>;">
                <th scope="row"><label for="rps_button_radius">Button Border radius</label></th>
                <td>
                    <input type="text" name="rps_button_radius" id="rps_button_radius" value="<?php echo $savedSettings['rps_button_radius']?>" >px
                </td>
            </tr>
            <tr class="simple_text" style="display: <?php echo (($savedSettings['rps_scroll_method']=='simple_text')?'table-row':'none');?>;">
                <th scope="row"><label for="rps_button_padding">Button Padding</label></th>
                <td>
                    <input type="text" name="rps_button_padding" id="rps_button_padding" value="<?php echo $savedSettings['rps_button_padding']?>" >
                </td>
            </tr>
            <tr class="your_image" style="display: <?php echo (($savedSettings['rps_scroll_method']=='your_image')?'table-row':'none');?>;">
                <th scope="row"><label for="rps_icon_image_url">Icon Image URL</label></th>
                <td>
                    <input type="text" name="rps_icon_image_url" id="rps_icon_image_url" value="<?php echo $savedSettings['rps_icon_image_url']?>" class="regular-text">
                    <input type="hidden" name="rps_icon_image_id" id="rps_icon_image_id" value="<?php echo $savedSettings['rps_icon_image_id']?>" class="regular-text">
                    <a href="#" class="button csf-button" id="rps_icon_image_uploader">Upload Image</a>
                    <p><img src="<?php echo $savedSettings['rps_icon_image_url']?>" id="rps_icon_image_preview" style="width: 50px;height: 50px;display: <?php echo (!empty($savedSettings['rps_icon_image_url'])?'block':'none')?>;margin-top: 10px;"/></p>
                </td>
            </tr>
            <tr class="your_image" style="display: <?php echo (($savedSettings['rps_scroll_method']=='your_image')?'table-row':'none');?>;">
                <th scope="row"><label for="rps_image_width">Image Width</label></th>
                <td>
                    <input type="text" name="rps_image_width" id="rps_image_width" value="<?php echo $savedSettings['rps_image_width']?>" >px
                </td>
            </tr>
            <tr class="your_image" style="display: <?php echo (($savedSettings['rps_scroll_method']=='your_image')?'table-row':'none');?>;">
                <th scope="row"><label for="rps_image_height">Image Height</label></th>
                <td>
                    <input type="text" name="rps_image_height" id="rps_image_height" value="<?php echo $savedSettings['rps_image_height']?>" >px
                </td>
            </tr>
            </tbody>
        </table>
        <p class="submit">
            <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
            <input type="submit" name="scroll_page_to_top_resetall" id="scroll_page_to_top_resetall" class="button button-primary" value="Reset All Options" onclick="return confirm('Are you sure you would like to reset all options?');"/>
            <style type="text/css">
                table.rps tr th{width: 300px;}
                .wp-core-ui .button-primary#scroll_page_to_top_resetall {
                    background: #e14d43!important;
                    color: #fff;
                    border-color: #d02c21 #ba281e #ba281e!important;
                    box-shadow: 0 1px 0 #e14d43!important;
                    color: #fff;
                    text-decoration: none;
                    text-shadow: 0 -1px 1px #e14d43, 1px 0 1px #e14d43, 0 1px 1px #e14d43, -1px 0 1px #e14d43;
                }
            </style>
        </p>
    </form>
    <script>
        jQuery(document).ready(function() {
            $( '.rps-color-picker' ).wpColorPicker();

            jQuery(document).on("click", ".method_buttons", function(event) {
                var method = $('input[name=rps_scroll_method]:checked').val();
                if(method == 'simple_text'){
                    $('table.rps').find('tr.your_image').hide();
                    $('table.rps').find('tr.simple_text').show();
                }else{
                    $('table.rps').find('tr.simple_text').hide();
                    $('table.rps').find('tr.your_image').show();
                }
            });
            var custom_file_frame;
            jQuery(document).on("click", "#rps_icon_image_uploader", function(event) {
                event.preventDefault();
                if (typeof(custom_file_frame)!=="undefined") {
                    custom_file_frame.close();
                }

                //Create WP media frame.
                custom_file_frame = wp.media.frames.customHeader = wp.media({
                    //Title of media manager frame
                    title: "Media Uploader",
                    library: {
                        type: "image"
                    },
                    button: {
                        //Button text
                        text: "Select"
                    },
                    //Do not allow multiple files, if you want multiple, set true
                    multiple: false
                });

                //callback for selected image
                custom_file_frame.on("select", function() {
                    var attachment = custom_file_frame.state().get("selection").first().toJSON();
                    //do something with attachment variable, for example attachment.filename
                    //console.log(attachment);
                    if(attachment.id && attachment.url){
                        $('#rps_icon_image_id').val(attachment.id);
                        $('#rps_icon_image_url').val(attachment.url);
                        $('#rps_icon_image_preview').attr('src',attachment.url).fadeIn(400);
                    }
                });
                //Open modal
                custom_file_frame.open();
            });
        });
    </script>

</div>
