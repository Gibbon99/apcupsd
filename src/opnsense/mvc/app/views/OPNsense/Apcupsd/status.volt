<script>
    $( document ).ready(function()
	{
	  let messageText = "No status";

       	  ajaxCall("/api/apcupsd/service/getUpsStatus", {}, function (data, status)
          {
      	   messageText = '<div class="alert"><pre>' + data['message'] + '</pre></div>';
      	   $("#messageregion").html(messageText);
          });
	});
</script>
