<pre id="apcupsd-status">No status</pre>
<script>
    $(document).ready(function() {
        var refreshStatus = function() {
            ajaxCall('/api/apcupsd/service/getUpsStatus', {}, function(data, status) {
                if (status === 'success') {
                    $('#apcupsd-status').text(data.error || data.output);
                    setTimeout(refreshStatus, 5000);
                }
            });
        };
        refreshStatus();
    });
</script>
