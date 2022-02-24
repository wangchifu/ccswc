<script>
     function change_button1(){
            $("#submit_button").attr('disabled','disabled');
            $("#submit_button").addClass('disabled');
            var n = 0;
            $( ".rq" ).each(function() {
                if($(this).val()==''){
                    alert('必填欄位沒有填');
                    n = 1;;
                    return false;
                };
            });
            if(n==0){
                $("#this_form").submit();
            }
        
        }
    function change_button2(){
            $("#submit_button").removeAttr('disabled');
            $("#submit_button").removeClass('disabled');
        }
</script>