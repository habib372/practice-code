<script>
            $(document).ready(function(){
                $(document).on('keyup change', '#mobile', function(){
                    $("#username").val($("#mobile").val());
                });
            })
</script>