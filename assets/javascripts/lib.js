$(document).ready(function()
    {
        //setTimeout("$('.ui-state-error').slideUp('fast').hide();", 5000);
	
        // ajax progress bar
        $('#ajaxloading').hide();
        $("#ajaxloading").bind("ajaxSend", function(){
            $(this).show();
        }).bind("ajaxComplete", function(){
            $(this).hide();
        });
        
        // jQuery UI Buttons
        $( "input:submit, a.button").button();
        $( "a.button" ).click(function() {
            return false;
        });
        
        // jQuery UI Overlay Dialog
        $( "#dialog:ui-dialog" ).dialog( "destroy" );
        
        
        // forget password dialog
        $( "#dialog-forgot" ).hide();
        $("#forgetpassword").click(function ()
        {
            
            $( "#dialog-forgot" ).dialog({
                modal: true,
                buttons: {
                    Ok: function() {
                        $( this ).dialog( "close" );
                    }
                }
            });

        });

        

        // ajax to check username.
        $('#createuser #username').blur(function (){
            $.ajax({
                type: 'POST',
                url: 'username_check',
                data: ({
                    'username' : $('#username').val()
                }),
                success: function(databack)
                {
                    //console.log(databack);
                    $('#username_status').html(databack);
                }
            })
        });
	
        // ajax to check email.
        $('#createuser #email').blur(function (){
            $.ajax({
                type: 'POST',
                url: 'email_check',
                data: ({
                    'email' : $('#email').val()
                }),
                success: function(databack)
                {
                    //console.log(databack);
                    $('#email_status').html(databack);
                }
            })
        });
								
        

    }); // document ready end here

// delete company logo on click
function del_logo (cid)
{
    $.ajax({
        type: 'POST',
        url: 'delete_logo',
        data: ({
            'cid' : cid
        }),
        success: function(databack)
        {
            //console.log(databack);
            $('#showlogo .logo').html(databack);
            $('#showlogo #delaction').hide();
        }
    })
}

// delete profile picture on click
function del_ppic (uid)
{
    $.ajax({
        type: 'POST',
        url: 'delete_picture',
        data: ({
            'uid' : uid
        }),
        success: function(databack)
        {
            //console.log(databack);
            $('#showlogo .logo').html(databack);
            $('#showlogo #delaction').hide();
        }
    })
}
