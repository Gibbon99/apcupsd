<div  class="col-md-12">
    {{ partial('layout_partials/base_form',['fields':generalForm,'id':'frm_GeneralSettings','apply_btn_id':'saveAct'])}}
</div>
<script>
    $(document).ready(function () {
        var data_get_map = { 'frm_GeneralSettings': '/api/apcupsd/settings/get' };

        mapDataToFormUI(data_get_map).done(function(data) {
            // place actions to run after load, for example update form styles.
            formatTokenizersUI();
            $('.selectpicker').selectpicker('refresh');
        });

        // Adds or updates the service control
        updateServiceControlUI('apcupsd');

        var waitEnabled = function(callback, ntry) {
            ntry = ntry || 0;
            ajaxCall('/api/apcupsd/service/status', {}, function(data) {
                if ((data && data['status'] === 'running') || ntry > 5) {
                    callback.call(null);
                } else {
                    setTimeout(function() {
                        waitEnabled(callback, ntry++);
                    }, 1000);
                }
            });
        };

        // link save button to API set action
        $('#saveAct').click(function(){
            saveFormToEndpoint(url='/api/apcupsd/settings/set',formid='frm_GeneralSettings',callback_ok=function(){
                $('#frm_GeneralSettings_progress').addClass('fa fa-spinner fa-pulse');
                // action to run after successful save, for example reconfigure service.
                ajaxCall(url='/api/apcupsd/service/reconfigure', sendData={},callback=function(data,status) {
                    // action to run after reload
                    $('#frm_GeneralSettings_progress').removeClass('fa fa-spinner fa-pulse');
                    updateServiceControlUI('apcupsd');
                    waitEnabled(function() {
                        updateServiceControlUI('apcupsd');
                    });
                });
            });
        });
    });
</script>
