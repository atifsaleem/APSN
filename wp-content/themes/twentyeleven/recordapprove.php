<?php 
include ('../../../wp-blog-header.php');
global $wpdb;
$email=$_GET['email'];
$wpdb->query("INSERT into wp_volunteers_details (Email) VALUES ('$email')");
$forms = $wpdb->get_results("SELECT * FROM wp_cformssubmissions WHERE email = \"".$email."\"") or die(mysql_error());
foreach($forms as $form)
{
    
    $sql = "SELECT f_id, field_name, field_val FROM wp_cformsdata WHERE sub_id = $form->id ORDER BY f_id";
    
    $records = $wpdb->get_results($sql) or die(mysql_error());
    
        foreach($records as $record)
    {
        if(substr($record->field_name, 0, 8)!='Fieldset' && $record->field_name != 'page'){
        	if ($record->field_name=='Date')
        	{$record->field_name='Date of Birth';
        	$record->field_val='1992-07-23';
        	}
        	$sql="UPDATE wp_volunteers_details SET `$record->field_name`='$record->field_val' WHERE Email=\"$email\"";
    		echo $sql;
            $wpdb->query($sql);
        }
    }

}
?>
