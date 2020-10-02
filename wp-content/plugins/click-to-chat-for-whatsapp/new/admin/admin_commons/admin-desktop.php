<?php
/**
*  Admin Desktop
*
* @package ctc
* @subpackage Administration
* @since 2.11
*/

if ( ! defined( 'ABSPATH' ) ) exit;

// style
$style_desktop = ( isset( $options['style_desktop']) ) ? esc_attr( $options['style_desktop'] ) : '';

// position
$side_1 = ( isset( $options['side_1']) ) ? esc_attr( $options['side_1'] ) : '';
$side_1_value = ( isset( $options['side_1_value']) ) ? esc_attr( $options['side_1_value'] ) : '';
$side_2 = ( isset( $options['side_2']) ) ? esc_attr( $options['side_2'] ) : '';
$side_2_value = ( isset( $options['side_2_value']) ) ? esc_attr( $options['side_2_value'] ) : '';

?>

<ul class="collapsible">
<li class="active">
<div class="collapsible-header">Desktop</div>
<div class="collapsible-body">


<!-- style -->
<p class="description ht_ctc_subtitle">Select Style (Desktop):</p class="description">
<div class="row ht_ctc_admin_desktop">
    <div class="input-field col s12 m12">
        <select name="<?php echo $dbrow ?>[style_desktop]" class="chat_select_style select_style_desktop">
            <option value="1" <?php echo $style_desktop == 1 ? 'SELECTED' : ''; ?> >Style-1</option>
            <option value="2" <?php echo $style_desktop == 2 ? 'SELECTED' : ''; ?> >Style-2</option>
            <option value="3" <?php echo $style_desktop == 3 ? 'SELECTED' : ''; ?> >Style-3</option>
            <option value="4" <?php echo $style_desktop == 4 ? 'SELECTED' : ''; ?> >Style-4</option>
            <option value="5" <?php echo $style_desktop == 5 ? 'SELECTED' : ''; ?> >Style-5</option>
            <option value="6" <?php echo $style_desktop == 6 ? 'SELECTED' : ''; ?> >Style-6</option>
            <option value="7" <?php echo $style_desktop == 7 ? 'SELECTED' : ''; ?> >Style-7</option>
            <option value="8" <?php echo $style_desktop == 8 ? 'SELECTED' : ''; ?> >Style-8</option>
            <option value="99" <?php echo $style_desktop == 99 ? 'SELECTED' : ''; ?> >Style-99 (Add your own image / GIF)</option>
        </select>
        <p class="description"><a target="_blank" href="https://www.holithemes.com/plugins/click-to-chat/list-of-styles/">List of styles</a> &emsp; | &emsp; <span>Customize the styles  <a target="_blank" class="customize_styles_link" href="<?php echo admin_url( 'admin.php?page=click-to-chat-customize-styles' ); ?>">( Click to Chat -> Customize Styles )</a></span> </p>
        <p class="description"><span class="check_select_styles" style="font-size: 0.7em;">If Styles for desktop, mobile not selected as expected <a target="_blank" href="<?php echo admin_url( 'admin.php?page=click-to-chat-customize-styles#styles_issue' ); ?>">Check this</a>, - <a target="_blank" href="https://holithemes.com/plugins/click-to-chat/select-styles/">more info</a></span></p>
        <!-- <span class="check_select_styles" style="font-size: 0.7em;">If Styles for desktop, mobile not selected as expected <a target="_blank" href="<?php echo admin_url( 'admin.php?page=click-to-chat-customize-styles#:~:text=check%20this, cache)' ); ?>">Check this</a>, - <a target="_blank" href="https://holithemes.com/plugins/click-to-chat/select-styles/">more info</a></span></p> -->
    </div>
</div>

<!-- Dekstop position -->
<!-- side - 1 -->
<p class="description ht_ctc_subtitle">Position to Place (Desktop):</p>
<div class="row ht_ctc_admin_desktop">
    <br>
    <div class="input-field col s6">
        <select name="<?php echo $dbrow ?>[side_1]" class="select-2">
            <option value="bottom" <?php echo $side_1 == 'bottom' ? 'SELECTED' : ''; ?> >bottom</option>
            <option value="top" <?php echo $side_1 == 'top' ? 'SELECTED' : ''; ?> >top</option>
        </select>
        <label>top / bottom </label>
    </div>
    <div class="input-field col s6">
        <input name="<?php echo $dbrow ?>[side_1_value]" value="<?php echo $side_1_value ?>" id="side_1_value" type="text" class="input-margin">
        <label for="side_1_value">E.g. 10px</label>
    </div>
</div>

<!-- side - 2 -->
<div class="row ht_ctc_admin_desktop" style="margin-bottom:0;">
    <div class="input-field col s6">
        <select name="<?php echo $dbrow ?>[side_2]" class="select-2">
            <option value="right" <?php echo $side_2 == 'right' ? 'SELECTED' : ''; ?> >right</option>
            <option value="left" <?php echo $side_2 == 'left' ? 'SELECTED' : ''; ?> >left</option>
        </select>
        <label>right / left</label>
    </div>

    <div class="input-field col s6">
        <input name="<?php echo $dbrow ?>[side_2_value]" value="<?php echo $side_2_value ?>" id="side_2_value" type="text" class="input-margin">
        <label for="side_2_value">E.g. 50%</label>
    </div>
</div>
<p class="description ht_ctc_admin_desktop">Add css units as suffix - e.g. 10px, 50% - <a target="_blank" href="https://www.holithemes.com/plugins/click-to-chat/position-to-place/">more info</a> </p>

<br class="ht_ctc_admin_desktop">
<hr class="ht_ctc_admin_desktop" style="max-width: 500px;">
<br class="ht_ctc_admin_desktop">


<?php
// Hide on Desktop Devices
if ( isset( $options['hideon_desktop'] ) ) {
    ?>
    <p>
        <label>
            <input name="<?php echo $dbrow ?>[hideon_desktop]" type="checkbox" value="1" <?php checked( $options['hideon_desktop'], 1 ); ?> class="hidebasedondevice" id="hideon_desktop" />
            <span>Hide on - Desktop Devices</span>
        </label>
    </p>
    <?php
} else {
    ?>
    <p>
        <label>
            <input name="<?php echo $dbrow ?>[hideon_desktop]" type="checkbox" value="1" class="hidebasedondevice" id="hideon_desktop" />
            <span>Hide on - Desktop Devices</span>
        </label>
    </p>
    <?php
}
?>

</div>
</div>
</li>
<ul>