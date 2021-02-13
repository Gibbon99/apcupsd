
<script>

    $( document ).ready(function()
	{
	  let messageText = "No status";

       	  ajaxCall(url = "/api/apcupsd/service/getUpsStatus", sendData = {}, callback = function (data, status)
          {
	   messageText = '<div class="alert"><pre>' + data['message'] + '</pre></div>';

	   $("#messageregion").html(messageText); 
          });
	});

</script>

