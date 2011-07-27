<div id="message" class="updated fade">
	Time Line Graph Settings
<?php
   if(isset($_GET['submit'])) :
       if(isset ($_REQUEST['heightY'])) {
            update_option($TimeLineGraph->timeline_graph_height, $_REQUEST["heightY"]);
       }
       if(isset ($_REQUEST['widthX'])) {
            update_option($TimeLineGraph->timeline_graph_width, $_REQUEST["widthX"]);
       }
   endif;
   

?>
</div>


<div style="padding: 10px  0 40px 40px;">
<form action="options-general.php" method="GET">
    <input type="hidden" name="page" value="admin_menu"/>
    <table>
        <tr>
            <td>Data : </td>
            <td><input type="file" name="data" /></td>
        </tr>
        <tr>
            <td>Size : </td>
            <td><input type="text" name="widthX" style="width: 89px;" value="<?php echo get_option("timeline_width"); ?>" /> X <input type="text" name="heightY" style="width: 87px;" value="<?php echo get_option("timeline_width"); ?>"/></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="submit" /></td>
        </tr>
    
    </table>
</form>
</div>