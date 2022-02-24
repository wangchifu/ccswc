<script>
    function change_img(){
        var d = new Date();
        $('#captcha_img').attr('src',  'pic?' + d.getTime());
    }
</script>