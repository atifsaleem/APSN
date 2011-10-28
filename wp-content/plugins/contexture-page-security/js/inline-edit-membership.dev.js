/**
 * This file handles the inline-editor behavior for user membership settings.
 */
(function($) {
    inlineEditMembership = {
        //LOADS ALL INITIAL SETUP FUNCTIONALITY
        init : function(){
            //Open membership expiration editor
            $('a.editmembership').live('click',function(){ inlineEditMembership.edit(this); return false; });

            //Edit window cancel
            $('.submit a.cancel').live('click',function(){
                var myRow = $(this).parents('tr:first'),
                    myId = inlineEditMembership.getId(myRow[0]);
                myRow.remove();
                $('#user-'+myId).css('display','table-row');
            });

            //Edit window save
            $('.submit a.save').live('click',function(){
                var myRow = $(this).parents('tr:first');
                inlineEditMembership.save(myRow[0]);
            });

            //Toggle editor window date enabled
            $('input[name="membership_permanent"]').live('click',function(){
                if( $(this).filter(':checked').length>0 ){
                    $(this).parents('fieldset:first').find('.inline-edit-date').find('input, select').removeAttr('disabled').prop('disabled',false);
                }else{
                    $(this).parents('fieldset:first').find('.inline-edit-date').find('input, select').attr('disabled','disabled').prop('disabled','disabled');
                }
            });

            //Confirm before removing a user
            $('#grouptable .row-actions .trash').click(function(){
                    return confirm(ctxpsmsg.RemoveUser);
            });

        },
        //OPENS THE CURRENTLY CHOSEN EDITOR SCREEN
        edit : function(memberid){
            var rowData, editForm, expires=false;

            //Close other open edit windows
            inlineEditMembership.revert();

            //Set memberid to the memberid int, if its an object
            if (typeof memberid=='object') memberid = inlineEditMembership.getId(memberid);
            //Get data
            rowData = $('#inline_'+memberid);
            //Move editor to new position in table
            editForm = $('#inline-edit').clone().attr('id','edit-'+memberid).prop('id','edit-'+memberid).insertAfter('#user-'+memberid).css('display','table-row');
            //Update username
            $('.username',editForm).text($('.username',rowData).text());
            //Update expires checkbox
            if($('.jj',rowData).text().length!=0){ $('input[name="membership_permanent"]',editForm).attr('checked','checked').prop('checked','checked'); expires=true; }
            //Set dates (if appropriate)
            if(expires){
                editForm.find('.inline-edit-date').find('input, select').removeAttr('disabled').prop('disabled',false)
                    .filter('[name="mm"]').val($('.mm',rowData).text()).end()
                    .filter('[name="aa"]').val($('.aa',rowData).text()).end()
                    .filter('[name="jj"]').val($('.jj',rowData).text()).end();
            }
            //Hide original tr
            $('#user-'+memberid).hide();

        },
        //SUBMIT MEMBERSHIP EDIT FOR SAVE
        save : function(myId){
            var myId, myEdit, rowData, newData, newDate='', hasExpire=0;

            //Show waiting anigif
            $('.inline-edit-save .waiting').show();

            //Set memberid to the memberid int, if its an object
            myId = inlineEditMembership.getId(myId);
            //Get data
            rowData = $('#inline_'+myId);
            //Get editor object
            myEdit = $('#edit-'+myId);
            newData = {
                grel:rowData.find('.grel').text(),
                mon:myEdit.find('select[name="mm"]').val(),
                day:myEdit.find('input[name="jj"]').val(),
                yr:myEdit.find('input[name="aa"]').val()
            };

            //Check if we're sending expires or not
            if(myEdit.find('[name="membership_permanent"]:checked').length!=0){
                //Set expiration flag
                hasExpire = 1;
                //Validate day and year data (if empty, adjust or error
                if(newData.day==''){ newData.day=1 }
                if(newData.yr==''){ $('.inline-edit-save .waiting').hide();alert(ctxpsmsg.YearRequired);return false; }
                //Build new date string
                newDate = newData.yr+'-'+newData.mon+'-'+newData.day;
            }else{
                newData.mon='';
                newData.day='';
                newData.yr='';
            }

            //Submit ajax data to server
            $.post('admin-ajax.php',
            {
                action: 'ctxps_update_member',
                grel:   newData.grel,
                expires:hasExpire,
                date:   newDate
            },
            function(response){ response = $(response);
                var showDate = 'Never',today = new Date();
                //If success (code 1), update original tr, then revert
                if(response.find('update').attr('id') == '1'){
                    //Choose what to show for expiration
                    if(hasExpire==1){
                        showDate = newData.mon+'-'+newData.day+'-'+newData.yr;
                        //If the date just set is older than today, membership is expired
                        if(new Date(showDate)<new Date()){
                            showDate='Expired';
                        }
                    }

                    $('#user-'+myId).find('.column-expires').text(showDate);
                    //Load updated dates into saved row data
                    rowData.find('.jj').text(newData.day);
                    rowData.find('.mm').text(newData.mon);
                    rowData.find('.aa').text(newData.yr);
                    inlineEditMembership.revert();
                    $('#user-'+myId).animate({'background-color':'#e0ffe3'},250,function(){
                        $(this).animate({'background-color':'#ffffff'},1000);
                    });
                //If we get an error...
                }else{
                    //Hide waiting anigif
                    $('.inline-edit-save .waiting').hide();
                    //Show error
                    alert(ctxpsmsg.GeneralError+response.find('wp_error').text());
                }
            },'xml');
        },
        //CLOSE ALL OPEN EDITS AND REVERT/RESTORE CURRENT EDIT
        revert : function(){
            //Close any open edit and restore original row
            $('tr.inline-edit-row:visible').each(function(){
                var myId = inlineEditMembership.getId( $(this)[0] );
                $(this).remove();
                $('#user-'+myId).css('display','table-row');
            });
            $('.inline-edit-save .waiting').hide();
        },
        getId : function(obj){
            var id = (obj.tagName == 'TR') ? obj.id : $(obj).parents('tr:first').attr('id'),
                parts = id.split('-');
            return parts[parts.length-1];
        }
    };
    $(document).ready(function(){ inlineEditMembership.init(); });
})(jQuery);