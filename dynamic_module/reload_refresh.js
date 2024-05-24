
<button type="button" name="refresh" id="refresh" class="btn btn-success">
     Refresh
</button>

$(document).ready(function() {
    $('#refresh').on('click', function(e){
        e.preventDefault();
        $("#filterform")[0].reset()
        window.location.reload();
    });
});
