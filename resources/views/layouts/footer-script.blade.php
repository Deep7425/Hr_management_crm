
<script src="{{ URL::asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<!--plugins-->
<script src="{{ URL::asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ URL::asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/chartjs/chart.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/sparkline-charts/jquery.sparkline.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/jquery-knob/excanvas.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/jquery-knob/jquery.knob.js')}}"></script>
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery-ui.js')}}"></script>


	<!-- <script src="{{ asset('assets/plugins/apexcharts-bundle/js/apex-custom.js')}}"></script> -->


<!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
<script src="{{ asset('js/parsley.min.js') }}"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!--plugins-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js">
 <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script> 
  </script><script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
	<script>
		new PerfectScrollbar('.email-navigation');
		new PerfectScrollbar('.email-read-box');
	</script>
	<!--app JS-->
	<script src="assets/js/app.js"></script>
  <!-- <script>
    $(function() {
      $(".knob").knob();
    });
  </script> -->
<!--app JS-->
<!-- <script src="{{ URL::asset('assets/js/app.js')}}"></script> -->




<div class="container">
   <!-- <h2>Large Modal</h2> -->
  
  <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".business_popup">
    Open modal
  </button> -->

 
  <div class="modal business_popup" id="business_popup_new">
    <div class="modal-dialog modal-lg">
   
      <div class="modal-content"> 


      <!-- <div class="modal-header">
      <h4 class="modal-title">Modal Heading</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>  -->

      <form id="amount_form" name="amount_form" method="POST" action="javascript:void(0)">
      @csrf
      <div class="modal-body">
      <div class="mb-3">

      <label for="inputbusiness_amount" class="form-label">Amount</label>
      <?php  $errorClass =  !empty($errors->has('business_amount')) ? 'is-invalid':''; ?>   
      {!! Form::text('business_amount',null, array('id'=>'business_amount','placeholder' => 'Enter Amount','required'=>'required', 'class' => 'form-control business_amount edit_amount'.$errorClass )) !!}
      {!! !empty($errors->has('business_amount')) ?'<div class="invalid-feedback"><span>'.$errors->first('business_amount').'</span></div>' :'' !!}
      </div>
      </div> 
      <input type="hidden" name="record_id" id="record_id" value="">
      <input type="hidden" name="type" id="record_type" value="">
      <div class="modal-body">
      <div class="mb-3">
      <label for="inputqualified_comment" class="form-label">Comment</label>
      <?php   $errorClass =  !empty($errors->has('qualified_comment')) ? 'is-invalid':''; ?>   
      {!! Form::text('qualified_comment', null, array('id'=>'qualified_comment','placeholder' => 'Enter comment', 'class' => 'form-control business_popup'.$errorClass )) !!}
      {!! !empty($errors->has('qualified_comment')) ?'<div class="invalid-feedback"><span>'.$errors->first('qualified_comment').'</span></div>' :'' !!}
      </div>
      </div> 

      
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary close_data" onClick="closeModel()" data-bs-dismiss="modal">Close</button>
      <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Save">
      </div>
      </form>

      </div>
     
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).on('submit', "#amount_form", function(e) {
    var id = $('#record_id').val();
    var value = $(this).val();
    var business_amount = $('#business_amount').val();
    
    var qualified_comment = $('#qualified_comment').val();
    var record_type = $('#record_type').val();
    var path = "{{url('admin/lead-dashboard/status?id=')}}"+id+'&business_amount='+business_amount+'&qualified_comment='+qualified_comment+'&value='+record_type;
     //alert(path);return false
      $.ajax({
        url: path,
        type: "GET",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
        data: $('#amount_form').serialize(),
        success: function(response) {
          if(response.type = 1) {
             
            toastr.success(response.message);
            $('.business_popup').hide('modal');
            tables.ajax.reload();
            $('.loader').hide();
            window.location.href = "{{url('/admin/lead-dashboard/contacts-lead')}}";
          
        }else{
          toastr.error(response.message);
        }
        }
      });
  });
</script>
<script>
function closeModel() {
    $('#business_popup_new').hide();
  }
  </script>
<script>
	jQuery('.business_amount').keyup(function () { 
    this.value = this.value.replace(/[^0-9\.]/g,'');
});
</script>
<script type="text/javascript">
  $(document).on('change','.typeAction',function(){
    
      var id = $(this).attr('id');
      var value = $(this).val();
      var statusMsg = ""
      $('#record_id').val(id);
     
     
      if(value == 'archive'){
        statusMsg = 'Are you sure you want to archive lead?';
      }
      else if(value == 'contacts_lead') {
          statusMsg = 'Are you sure you want to contacts lead?';

      }else if(value == 'won_lead') {
          statusMsg = 'Are you sure you want to won lead?';
      }

      else if(value == 'cold_lead') {
          statusMsg = 'Are you sure you want to cold lead?';
      }

      else if(value == 'lost_lead') {
          statusMsg = 'Are you sure you want to lost lead?';
      }
      else{
        statusMsg = 'Are You Sure ?';
      }


      if(value == 'business_submit_lead' || value == 'qualified_lead'){
        if(value == 'business_submit_lead'){
              $('#record_type').val('business_submit_lead');
              //$('#business_amount').val(business_amount);
              $('.business_popup').show('modal');
              
              
              
            }
              else if(value == 'qualified_lead'){
                $('#record_type').val('qualified_lead');
                $('.business_popup').show('modal');
        
         }

            } else {

               
              if(window.confirm(statusMsg)) {
                
                  var path = $(this).data('path');               
                  $('.loader').show();
                

                  $.ajax({
                      url:path,
                      method: 'get',
                      data: {'id':id,'value':value},
                      success: function(result){  
                        console.log(result);
                      tables.ajax.reload();  
                      sweetalert(result.type,result.message);
                      $('.loader').hide();
                      }
                  }); 
                
              }else{
                  var oldValue = $(this).attr('data-value');
                  $(this).val(oldValue);
                  return false;
              }

              }

              });
</script>

<!-- <script type="text/javascript">
  $(document).on('change','.typeAction',function(){
    var id = $(this).attr('id');
     
     var value = $(this).val();
     let statusMsg = ""
     if(value == 'business_submit_lead'){
       var amount = prompt("Please Enter Amount");
       var business_amount = parseInt(amount);
      }
      else if(value == 'qualified_lead'){
        var qualified_comment = prompt("Please Enter Comment");
      }
      else if(value == 'contacts_lead') {
          statusMsg = 'Are you sure you want to contacts lead?';
      }else if(value == 'archive') {
          statusMsg = 'Are you sure you want to Archive lead?';
      }else if(value == 'won_lead') {
          statusMsg = 'Are you sure you want to won lead?';
      }
      else if(value == 'cold_lead') {
          statusMsg = 'Are you sure you want to cold lead?';
      }
      else if(value == 'lost_lead') {
          statusMsg = 'Are you sure you want to lost lead?';
      }else{
        statusMsg = 'somthing went wrong!'
      }
      
     
      
      if(window.confirm(statusMsg)) {
         
          var path = $(this).data('path');               
          $('.loader').show();
         
          $.ajax({
              url:path,
              method: 'get',
              data: {'id':id,'value':value,'business_amount':business_amount,'qualified_comment':qualified_comment},
              success: function(result){
                  
              tables.ajax.reload();  

              sweetalert(result.type,result.message);
              $('.loader').hide();
              }
          });
         
        
      }else{
          var oldValue = $(this).attr('data-value');
          $(this).val(oldValue);
      
          return false;
      }
      
  });
</script> -->



 
 

  

