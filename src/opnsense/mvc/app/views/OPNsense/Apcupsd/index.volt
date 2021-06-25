<script>
  $(document).ready(function ()
  {
    var data_get_map = { 'frm_GeneralSettings': "/api/apcupsd/settings/get" };
    mapDataToFormUI(data_get_map).done(function (data)
    {
      // place actions to run after load, for example update form styles.
      updateServiceControlUI('apcupsd');
      formatTokenizersUI();
      $('.selectpicker').selectpicker('refresh');
    });

    // link save button to API set action
    $("#saveAct").click(function ()
    {
      saveFormToEndpoint(url = "/api/apcupsd/settings/set", formid = 'frm_GeneralSettings', callback_ok = function (data, status)
      {
        // Give some feedback
      	$("#responseMsg").removeClass("hidden");
        $("#responseMsg").html("Configuration saved. The service will need to be restarted for changes to take effect." );
      });
    });

    // link button to API stop action
    $("#stopAct").click(function ()
    {
      $("#responseMsg").removeClass("hidden");
      ajaxCall(url = "/api/apcupsd/service/stopService", sendData = {}, callback = function (data, status)
      {
        // action to run after button click
        $("#responseMsg").html(data['message']);
      });
    });

    // link button to API start action
    $("#startAct").click(function ()
    {
      $("#responseMsg").removeClass("hidden");
      ajaxCall(url = "/api/apcupsd/service/startService", sendData = {}, callback = function (data, status)
      {
        // action to run after button click
        $("#responseMsg").html(data['message']);
      });
    });

    // link button to API restart action
    $("#restartAct").click(function ()
    {
      $("#responseMsg").removeClass("hidden");
      ajaxCall(url = "/api/apcupsd/service/restartService", sendData = {}, callback = function (data, status)
      {
        // action to run after button click
        $("#responseMsg").html(data['message']);
      });
    });

    // link status button to API status action
    $("#statusAct").click(function ()
    {
      $("#responseMsg").removeClass("hidden");
      ajaxCall(url = "/api/apcupsd/service/statusService", sendData = {}, callback = function (data, status)
      {
        // action to run after button click
        $("#responseMsg").html(data['message']);
      });
    });
  });

</script>

<div class="alert alert-info hidden" role="alert" id="responseMsg">

</div>

<div  class="col-md-12">
    {{ partial("layout_partials/base_form",['fields':generalForm,'id':'frm_GeneralSettings'])}}
</div>

<div class="col-md-12">
    <button class="btn btn-primary"  id="saveAct" type="button"><b>{{ lang._('Save Config') }}</b></button>
    <button class="btn btn-primary"  id="stopAct" type="button"><b>{{ lang._('Stop Service') }}</b></button>
    <button class="btn btn-primary"  id="startAct" type="button"><b>{{ lang._('Start Service') }}</b></button>
    <button class="btn btn-primary"  id="restartAct" type="button"><b>{{ lang._('Restart Service') }}</b></button>
    <button class="btn btn-primary"  id="statusAct" type="button"><b>{{ lang._('Service Status') }}</b></button>
</div>
