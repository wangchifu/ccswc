<script>
    function check_admin(){
        if($('#code').val()==""){
            $("#admin").removeAttr('checked');
            $("#admin").prop('checked',false);
            $("#admin").attr('disabled','disabled');

            $("#school_admin").removeAttr('checked');
            $("#school_admin").prop('checked',false);
            $("#school_admin").attr('disabled','disabled');

        }else{
            if($('#code').val() != "079999"){
            $("#admin").removeAttr('checked');
            $("#admin").prop('checked',false);
            $("#admin").attr('disabled','disabled');

            $("#school_admin").removeAttr('disabled');
        }else{
            $("#admin").removeAttr('disabled');
            $("#school_admin").removeAttr('checked');
            $("#school_admin").prop('checked',false);
            $("#school_admin").attr('disabled','disabled');
        }
        }
    
    }
</script>