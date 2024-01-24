<!-- Modal -->
<div class="modal eModal fade" id="confirmSweetAlerts" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered sweet-alerts">
        <div class="modal-content">
            <div class="modal-body">
                <div class="icon icon-confirm">
                    <i class="fa-solid fa-exclamation"></i>
                </div>
                <p class="title">{{ get_phrase('Are you sure') }}?</p>
                <p class="focus-text">{{ get_phrase("You won't able to revert this") }}!</p>
                <div class="confirmBtn">
                    <a href="javascript:;" id="confirmBtn" class="eBtn eBtn-green">
                        <button type="button" id="confirmBtn" class="eBtn eBtn-green">{{ get_phrase('Yes') }}</button>
                      </a>
                    <button type="button" class="eBtn eBtn-red" data-bs-dismiss="modal">
                        {{ get_phrase('Cancel') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

  "use strict";

function confirmModal(deleteUrl, callBackFunction){
    var confirmModal = new bootstrap.Modal(document.getElementById('confirmSweetAlerts'), {
      keyboard: false
    });
    confirmModal.show();

    if(callBackFunction == 'undefined')
    {
      $('#confirmBtn').attr('href', deleteUrl);
    }
    else if(callBackFunction == 'ajax_delete')
    {
        $('#confirmBtn').attr('onclick',deleteUrl);
    }
    else{
      $('#confirmBtn').attr('onclick', "deleteDataUsingAjax('"+deleteUrl+"', "+callBackFunction+");");
    }
  }

  function deleteDataUsingAjax(url, callBackFunction){
    $.ajax({
      type:"POST",
      url: url,
      success: function(response){
        callBackFunction();

        if(response){
          var jsonResponse = JSON.parse(response);
          if(jsonResponse.status == 'error'){
              error_message(jsonResponse.message);
          }else{
            if(jsonResponse.redirect){
                window.location.replace(jsonResponse.redirect);
            }else{
                success_message(jsonResponse.message);
            }
          }
        }
      }
    });
  }

</script>

<script type="text/javascript">

    "use strict";

  var callBackFunction;
  var callBackFunctionForGenericConfirmationModal;
  function nearbyLocationEditModal(url)
  {
    jQuery('#editnearbyModal').modal('show', {backdrop: 'true'});
    // SHOW AJAX RESPONSE ON REQUEST SUCCESS
    $.ajax({
      type: 'get',
      url: url,
      success: function(response)
      {
        jQuery('#editnearbyModal .rm_body').html(response);
      }
    });
  }
  </script>

  <!-- add near by  Modal -->
<div class="modal fade" id="editnearbyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="nearby-modal">
                    <div class="rm_header d-flex justify-content-end align-items-center">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="rm_body">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    "use strict";

  var callBackFunction;
  var callBackFunctionForGenericConfirmationModal;
  function nearbyLocationAddModal(url)
  {
    jQuery('#addnearbyModal').modal('show', {backdrop: 'true'});
    // SHOW AJAX RESPONSE ON REQUEST SUCCESS
    $.ajax({
      type: 'get',
      url: url,
      success: function(response)
      {
        jQuery('#addnearbyModal .rm_body').html(response);
      }
    });
  }
  </script>

  <!-- add near by  Modal -->
<div class="modal fade" id="addnearbyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="nearby-modal">
                    <div class="rm_header d-flex justify-content-end align-items-center">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="rm_body">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

