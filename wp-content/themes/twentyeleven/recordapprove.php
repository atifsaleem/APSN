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
    {   switch($record->field_name){
            case "Title": if($record->field_val=="1")
                            $record->field_val="Dr.";
                          else if($record->field_val=="2")
                            $record->field_val="Mr.";
                          else if($record->field_val=="3")
                            $record->field_val="Mdm.";
                          else if($record->field_val=="4")
                            $record->field_val="Mrs.";
                          else if($record->field_val=="5")
                            $record->field_val="Ms.";
            case "Sex": if($record->field_val=="1")
                            $record->field_val="Male";
                          else if($record->field_val=="2")
                            $record->field_val="Female";
            case "SgPr": if($record->field_val=="1")
                            $record->field_val="Yes";
                          else if($record->field_val=="2")
                            $record->field_val="No";
            case "Marital": if($record->field_val=="1")
                            $record->field_val="Single";
                          else if($record->field_val=="2")
                            $record->field_val="Married";
                          else if($record->field_val=="3")
                            $record->field_val="Divorced/Seperated";
                          else if($record->field_val=="4")
                            $record->field_val="Widowed";
            case "NS_Status": if($record->field_val=="1")
                            $record->field_val="Full Time";
                          else if($record->field_val=="2")
                            $record->field_val="Reservist";
                          else if($record->field_val=="3")
                            $record->field_val="Exempted";
            case "HigherEdu": if($record->field_val=="1")
                            $record->field_val="Primary";
                          else if($record->field_val=="2")
                            $record->field_val="Secondary";
                          else if($record->field_val=="3")
                            $record->field_val="GCE 'N'/'O'";
                          else if($record->field_val=="4")
                            $record->field_val="ITE";
                          else if($record->field_val=="5")
                            $record->field_val="GCE";
                          if($record->field_val=="6")
                            $record->field_val="Diploma";
                          else if($record->field_val=="7")
                            $record->field_val="Pass Degree";
                          else if($record->field_val=="8")
                            $record->field_val="Honors Dgree";
                          else if($record->field_val=="9")
                            $record->field_val="Masters Degree";
                          else if($record->field_val=="10")
                            $record->field_val="Doctorate";
            case "Dwelling": if($record->field_val=="1")
                            $record->field_val="HDB Room";
                          else if($record->field_val=="2")
                            $record->field_val="HD Executive";
                          else if($record->field_val=="3")
                            $record->field_val="HUDC";
                          else if($record->field_val=="4")
                            $record->field_val="Semi-detached/Terrace";
                          else if($record->field_val=="5")
                            $record->field_val="Condominium/Private Appt";
            case "PrevVolunExp": if($record->field_val=="1")
                            $record->field_val="Yes";
                          else if($record->field_val=="2")
                            $record->field_val="No";
            case "Availibility": if($record->field_val=="1")
                            $record->field_val="Once Weekly";
                          else if($record->field_val=="2")
                            $record->field_val="Twice Weekly";
                          else if($record->field_val=="2")
                            $record->field_val="More than Twice Weekly";
                            
                            }

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
