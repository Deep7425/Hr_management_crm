@extends('layouts.master')

@section('content')
  <!--start page wrapper -->
  <div class="page-wrapper">
    <div class="page-content">
      <!--breadcrumb-->
      <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Profile</div>
        <div class="ps-3">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
              <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">Administrator Profile</li>
            </ol>
          </nav>
        </div>
        <!-- <div class="ms-auto">
          <div class="btn-group">
            <button type="button" class="btn btn-light">Settings</button>
            <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">  <span class="visually-hidden">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">  <a class="dropdown-item" href="javascript:;">Action</a>
              <a class="dropdown-item" href="javascript:;">Another action</a>
              <a class="dropdown-item" href="javascript:;">Something else here</a>
              <div class="dropdown-divider"></div>  <a class="dropdown-item" href="javascript:;">Separated link</a>
            </div>
          </div>
        </div> -->
      </div>
      <!--end breadcrumb-->
      <div class="container">
        <div class="main-body">
          <div class="row">
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body p-4">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="{{Auth::user()->image}}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                    <div class="mt-3">
                      <h4>{{ucwords(Auth::user()->name)}}</h4>
                      <p class="mb-1">{{Auth::user()->email}}</p>
                      <!-- <p class="font-size-sm">{{Auth::user()->mobile}}</p> -->
                      <!-- <button class="btn btn-light">Follow</button>
                      <button class="btn btn-light">Message</button> -->
                    </div>
                  </div>
                  <!-- <hr class="my-4" />
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Website</h6>
                      <span class="text-white">https://codervent.com</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github me-2 icon-inline"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>Github</h6>
                      <span class="text-white">codervent</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter me-2 icon-inline"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>Twitter</h6>
                      <span class="text-white">@codervent</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram me-2 icon-inline"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>Instagram</h6>
                      <span class="text-white">codervent</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook me-2 icon-inline"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>
                      <span class="text-white">codervent</span>
                    </li>
                  </ul> -->
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <form method="POST" action="{{ url('admin/saveProfile') }}" id="save_profile">
              @csrf
                <div class="card">
                  <div class="card-body p-4">
                    <div class="row mb-3">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Full Name</h6>
                      </div>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}" data-parsley-required="true" />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Email</h6>
                      </div>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="email" value="{{Auth::user()->email}}" readonly/>
                      </div>
                    </div>
                    <!-- <div class="row mb-3">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Phone</h6>
                      </div>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="(239) 816-9029" />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Mobile</h6>
                      </div>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="(320) 380-4539" />
                      </div>
                    </div> -->
                    <!-- <div class="row mb-3">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Address</h6>
                      </div>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="Bay Area, San Francisco, CA" />
                      </div>
                    </div> -->
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Profile Image</h6>
                      </div>
                      <div class="col-sm-9">

                        <div class="form-group input-group">
                            <div id="image_preview"><img id="previewing" src="{{ URL::asset('assets/images/image.png')}}"></div>
                            <!-- <input type="file" id="file" name="image" class="form-control"> -->
                            <!-- <label for="files" >{{__('backend.Select_Image')}}</label>
                            <input type="file" id="file" name="image" style="visibility:hidden;" class="form-control"> -->
                            <div class="form-control" onclick="document.getElementById('file').click()">
                                <label for="files">Select Image</label>
                                <input type="file" id="file" name="image" style="visibility:hidden;" class="form-control">
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3"></div>
                      <div class="col-sm-9">
                        <input type="submit" class="btn btn-light px-4" value="Save Changes" />
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--end page wrapper -->
  <!--start overlay-->
  <div class="overlay toggle-icon"></div>
  <!--end overlay-->
  <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
  <!--End Back To Top Button-->

<script type="text/javascript">
  $(document).ready(function() {
    $('#save_profile').parsley();

    $("#file").change(function(){
      var fileObj = this.files[0];
      var imageFileType = fileObj.type;
      var imageSize = fileObj.size;

      var file = $('#file')[0].files[0].name;
      $(this).prev('label').text(file);
    
      var match = ["image/jpeg","image/png","image/jpg"];
      if(!((imageFileType == match[0]) || (imageFileType == match[1]) || (imageFileType == match[2]))){
        $('#previewing').attr('src','images/image.png');
        toastr.error('Please Select A valid Image File <br> Note: Only jpeg, jpg and png Images Type Allowed!!');
        return false;
      }else{
        //console.log(imageSize);
        if(imageSize < 5000000){
          var reader = new FileReader();
          reader.onload = imageIsLoaded;
          reader.readAsDataURL(this.files[0]);
        }else{
          toastr.error('Images Size Too large Please Select Less Than 5MB File!!');
          return false;
        }
        
      }
      
    });
    function imageIsLoaded(e){
      //console.log(e);
      $("#file").css("color","green");
      $('#previewing').attr('src',e.target.result);

    }

    $("#save_profile").on('submit',function(e){
      e.preventDefault();
      var _this=$(this); 
      var formData = new FormData(this);
        $.ajax({
          url:'{{ url("admin/saveProfile") }}',
          dataType:'json',
          data:formData,
          cache:false,
          contentType: false,
          processData: false,
          type:'POST',
          // beforeSend: function (){before(_this)},
          // hides the loader after completion of request, whether successfull or failor.
          // complete: function (){complete(_this)},
          success:function(result){
              if(result.status){
                toastr.success(result.message)
                $('#save_profile')[0].reset();
                $('#save_profile').parsley().reset();
                window.location.reload();
              }else{
                toastr.error(result.message)
              }
          },
          error:function(jqXHR,textStatus,textStatus){
            if(jqXHR.responseJSON.errors){
              $.each(jqXHR.responseJSON.errors, function( index, value ) {
                toastr.error(value)
              });
            }else{
              toastr.error(jqXHR.responseJSON.message)
            }
          }
        });
        return false;   
    });
  });
</script>

<script>
$(document).ready(function(){

$('#change_email').parsley();
$('#change_password').parsley();

// $("#change_email").on('submit',function(e){
//   e.preventDefault();
//   var _this=$(this); 
//     var values = $('#change_email').serialize();
//     $.ajax({
//     url:'{{ url('sendVerificationLink') }}',
//     dataType:'json',
//     data:values,
//     type:'POST',
//     beforeSend: function (){before(_this)},
//     // hides the loader after completion of request, whether successfull or failor.
//     complete: function (){complete(_this)},
//     success:function(result){
//         if(result.status){
//           toastr.success(result.message)
//           $('#change_email')[0].reset();
//           $('#change_email').parsley().reset();
//         }else{
//           toastr.error(result.message)
//         }
//       },
//     error:function(jqXHR,textStatus,textStatus){
//       if(jqXHR.responseJSON.errors){
//         $.each(jqXHR.responseJSON.errors, function( index, value ) {
//           toastr.error(value)
//         });
//       }else{
//         toastr.error(jqXHR.responseJSON.message)
//       }
//     }
//       });
//       return false;   
//     });

// $("#change_password").on('submit',function(e){
//   e.preventDefault();
//   var _this=$(this); 
//     var values = $('#change_password').serialize();
//     $.ajax({
//     url:'{{ url('admin/changePassword') }}',
//     dataType:'json',
//     data:values,
//     type:'POST',
//     beforeSend: function (){before(_this)},
//     // hides the loader after completion of request, whether successfull or failor.
//     complete: function (){complete(_this)},
//     success:function(result){
//         if(result.status){
//           toastr.success(result.message)
//           $('#change_password')[0].reset();
//           $('#change_password').parsley().reset();
//           $('.setting_change_password').modal('hide');
//         }else{
//           toastr.error(result.message)
//         }
//       },
//     error:function(jqXHR,textStatus,textStatus){
//       if(jqXHR.responseJSON.errors){
//         $.each(jqXHR.responseJSON.errors, function( index, value ) {
//           toastr.error(value)
//         });
//       }else{
//         toastr.error(jqXHR.responseJSON.message)
//       }
//     }
//       });
//       return false;   
//     });
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
   });
  });
  
</script>

@endsection
