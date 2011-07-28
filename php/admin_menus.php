<div id="message" class="updated fade">
	Time Line Graph Settings
<?php
   if(isset($_POST['submit'])) {
       if(isset ($_REQUEST['heightY'])) {
            update_option('timeline_height', $_REQUEST["heightY"]);
       }
       if(isset ($_REQUEST['widthX'])) {
            update_option('timeline_width', $_REQUEST["widthX"]);
       }
       $error_message = "";
       $status_message = "";
       $savePath = "../wp-content/plugins/TimeLineGraph/data/".basename($_FILES['uploadedfile']['name']);
       
       if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $savePath)) {
            $status_message = 'Data saved.';
        } else{
            $error_message = "Data Not save.";

        }
   }
?>
</div>
<?php if($error_message != "")
{ ?>
<div class="error"><?php echo $error_message; ?></div>
<?php }
else if($status_message != "")
{
?>
<div class="updated"><?php echo $status_message; ?></div>
<?php }?>
<script type="text/javascript">

function validate_form_setting_form()
{
    var flag = false;
    var form = document.submit_form;
    try{
        var w = parseInt(document.getElementById('txtWidth').value);
        var h = parseInt(document.getElementById('txtHeight').value);
        if(w <= 0 || h <= 0)
            document.getElementById('size_error').innerHTML = "Please give size.";
    }catch(err){
            document.getElementById('size_error').innerHTML = "Please give size.";
    }

    if (form.uploadedfile.value.length != 0)
    {
        document.getElementById('upload_file_error').innerHTML = "";
        flag = true;
    }
    else
    {
        document.getElementById('upload_file_error').innerHTML = "Please add your data.";
    }
    return flag;
}

</script>

<div style="padding: 10px  0 40px 40px;">
<form enctype="multipart/form-data" action="#" method="POST" name="submit_form">
    <input type="hidden" name="page" value="admin_menu"/>
    <table>
        <tr>
            <td>Data : </td>
            <td><input name="uploadedfile" type="file" /></td>
            <td> <span style="color:red;" id="upload_file_error"></span> </td>
        </tr>
        <tr>
            <td>Size : </td>
            <td><input id="txtWidth" type="text" name="widthX" style="width: 89px;" value="<?php echo get_option("timeline_width"); ?>" /> X <input type="text" id="txtHeight" name="heightY" style="width: 87px;" value="<?php echo get_option("timeline_height"); ?>"/>(Width x Height)</td>
            <td><span style="color:red;" id="size_error"></span></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="submit" onclick="return validate_form_setting_form();"/></td>
            <td></td>
        </tr>
    
    </table>
</form>
</div>