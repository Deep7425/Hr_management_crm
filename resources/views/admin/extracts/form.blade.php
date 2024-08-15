@section('css') 
	<link href="{{ URL::asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css')}}" rel="stylesheet" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
<?php  
use App\Models\User;
$login_user_data = auth()->user();
?>
<style>
	.parsley-required{    
        color: red;   
        font-size: 12px;
	}
	.select2-results__option--selectable {
  cursor: pointer;
  background-color: #132b39;
	}
	.email_cls {
  color: red;
  font-size: 12px;
}
.phone_cls {
  color: red;
  font-size: 12px;
}

  .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
  cursor: default;
  padding-left: 2px;
  padding-right: 5px;
  color: black;
}
.required:after {
    content:" *";
    color: red;
  }

  .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
  background-color: #6b717b;
  color: white;
  }
  .select2-container--default .select2-selection--single .select2-selection__rendered {
  color: white;
  line-height: 28px;
  background-color: #00426b;
}
  .parsley-pattern {
  color: red;
  font-size: 12px;
}
.parsley-type {
  color: red;
  font-size: 12px;
}
.select2-search__field {
  color: white;
}
.hide {
  display: none;
}
#mobile_number {
  width: unset;
}

</style>
<div class="card">
  	<div class="card-body p-4">
	  	<!-- <h5 class="card-title">Add New</h5>
	  	<hr/> -->
       	<div class="form-body mt-4">
		    <div class="row">
			   	<div class="col-lg-12">
		           	<div class="border border-3 p-4 rounded">
					   <div class="mb-3">
							<label for="inputproject_title" class="form-label required">Project Title</label>
							<?php  $errorClass =  !empty($errors->has('project_title')) ? 'is-invalid':''; ?>   
			                {!! Form::text('project_title', null, array('id'=>'project_title','placeholder' => 'Enter project title','required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('project_title')) ?'<div class="invalid-feedback"><span>'.$errors->first('project_title').'</span></div>' :'' !!}
						</div>
						@if($login_user_data->user_type == 1) 
						<div class="mb-3">
						
						<p>Lead Source:</p>

						
						<input  type="radio" id="extract" name="lead_source" value="extract" <?php if ($page_type == 'add') { echo "checked='checked'"; } else { if ($data['lead_source'] == 'extract') { echo "checked='checked'"; } else { if (empty($data['lead_source'])) { echo "checked='checked'"; } } } ?> />
						<label for="extract">Extract </label>
						

						
						<input  type="radio" id="ajaysir" name="lead_source" value="ajaysir" <?php if ($data['lead_source'] == 'ajaysir') { echo "checked='checked'"; } ?>/>
						<label for="ajaysir">Ajay Sir </label>
						
						</div>
						@endif

						<div class="mb-3">
							<label for="inputName" class="form-label required">Full Name</label>
							<?php  $errorClass =  !empty($errors->has('name')) ? 'is-invalid':''; ?>   
			                {!! Form::text('name', null, array('id'=>'name','placeholder' => 'Enter Full Name','required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('name')) ?'<div class="invalid-feedback"><span>'.$errors->first('name').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							<label for="inputEmail" class="form-label required">Email</label>
							<?php $errorClass =  !empty($errors->has('email')) ? 'is-invalid':''; ?>
			                {!! Form::email('email', null, array('id'=>isset($data->email)?true:false,'required'=>'required','placeholder' => 'Email','id'=>'email', 'class' => 'form-control '.$errorClass)) !!}
			                {!! !empty($errors->has('email')) ?'<div class="invalid-feedback"><span>'.$errors->first('email').'</span></div>' :'' !!}
							<div class="email_cls"></div>
						</div>
						<div class="mb-3">
							<label for="inputalternate_email" class="form-label">Email Address(Optional)</label>
							<?php $errorClass =  !empty($errors->has('alternate_email')) ? 'is-invalid':''; ?>
			                {!! Form::email('alternate_email', null, array('id'=>isset($data->alternate_email)?true:false,'placeholder' => 'Email','id'=>'alternate_email', 'class' => 'form-control '.$errorClass)) !!}
			                {!! !empty($errors->has('alternate_email')) ?'<div class="invalid-feedback"><span>'.$errors->first('alternate_email').'</span></div>' :'' !!}
							
						</div>
						<div class="mb-3">
							<label for="inputmobile_number" class="form-label required">Mobile Number</label>
							<?php  $errorClass =  !empty($errors->has('mobile_number')) ? 'is-invalid':''; ?>   
			                {!! Form::text('mobile_number', null, array('id'=>'mobile_number', 'maxlength'=>'20','placeholder' => 'Enter Mobile Number', 'id'=>'mobile_number','class' => 'form-control mobile_number '.$errorClass )) !!}
			                {!! !empty($errors->has('mobile_number')) ?'<div class="invalid-feedback"><span>'.$errors->first('mobile_number').'</span></div>' :'' !!}
							<div class="phone_cls"></div>
							<?php  $errorClass =  !empty($errors->has('whatsapp_url')) ? 'is-invalid':''; ?>   
			                <input type="checkbox" name="whatsapp_url" id="whatsapp_url" value="mobile_number">is available whatsapp for this number
							
						</div>

						<div class="mb-3">
							<label for="inputprimary_country" class="form-label required">Country</label>
							<?php  $errorClass =  !empty($errors->has('primary_country')) ? 'is-invalid':''; ?> 
							<select class ="form-control" name="primary_country" id="primary_country" required="required">
			<option value="">Select Country</option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Afghanistan") { echo "selected"; } ?> value="Afghanistan">Afghanistan </option> 
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Albania") { echo "selected"; } ?> value="Albania">Albania </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Algeria") { echo "selected"; } ?> value="Algeria">Algeria </option> 
			<option <?php if (isset($data->primary_country) && $data->primary_country == "American Samoa") { echo "selected"; } ?> value="American Samoa">American Samoa </option> 
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Andorra") { echo "selected"; } ?> value="Andorra">Andorra </option> 
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Angola") { echo "selected"; } ?> value="Angola">Angola </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Anguilla") { echo "selected"; } ?> value="Anguilla">Anguilla </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Antarctica") { echo "selected"; } ?> value="Antarctica">Antarctica </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Antigua And Barbuda") { echo "selected"; } ?> value="Antigua And Barbuda">Antigua And Barbuda </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Argentina") { echo "selected"; } ?> value="Argentina">Argentina </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Armenia") { echo "selected"; } ?> value="Armenia">Armenia </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Aruba") { echo "selected"; } ?> value="Aruba">Aruba </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Australia") { echo "selected"; } ?> value="Australia">Australia </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Austria") { echo "selected"; } ?> value="Austria">Austria </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Azerbaijan") { echo "selected"; } ?> value="Azerbaijan">Azerbaijan </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Bahamas The") { echo "selected"; } ?> value="Bahamas The">Bahamas The </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Bahrain") { echo "selected"; } ?> value="Bahrain">Bahrain </option> 
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Bangladesh") { echo "selected"; } ?> value="Bangladesh">Bangladesh </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Barbados") { echo "selected"; } ?> value="Barbados">Barbados </option> 
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Belarus") { echo "selected"; } ?> value="Belarus">Belarus </option> 
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Belgium") { echo "selected"; } ?> value="Belgium">Belgium </option> 
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Belize") { echo "selected"; } ?> value="Belize">Belize </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Benin") { echo "selected"; } ?> value="Benin">Benin </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Bermuda") { echo "selected"; } ?> value="Bermuda">Bermuda </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Bhutan") { echo "selected"; } ?> value="Bhutan">Bhutan </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Bolivia") { echo "selected"; } ?> value="Bolivia">Bolivia </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Bosnia and Herzegovina") { echo "selected"; } ?> value="Bosnia and Herzegovina">Bosnia and Herzegovina </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Botswana") { echo "selected"; } ?> value="Botswana">Botswana </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Brazil") { echo "selected"; } ?> value="Brazil">Brazil </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "British Indian Ocean Territory") { echo "selected"; } ?> value="British Indian Ocean Territory">British Indian Ocean Territory </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Brunei") { echo "selected"; } ?> value="Brunei">Brunei </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Bulgaria") { echo "selected"; } ?> value="Bulgaria">Bulgaria </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Burkina Faso") { echo "selected"; } ?> value="Burkina Faso">Burkina Faso </option> 
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Burundi") { echo "selected"; } ?> value="Burundi">Burundi </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Cambodia") { echo "selected"; } ?> value="Cambodia">Cambodia </option> 
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Cameroon") { echo "selected"; } ?> value="Cameroon">Cameroon </option> 
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Canada") { echo "selected"; } ?> value="Canada">Canada </option> 
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Cayman Islands") { echo "selected"; } ?> value="Cayman Islands">Cayman Islands </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Chile") { echo "selected"; } ?> value="Chile">Chile </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "China") { echo "selected"; } ?> value="China">China </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Colombia") { echo "selected"; } ?> value="Colombia">Colombia </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Comoros") { echo "selected"; } ?> value="Comoros">Comoros </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Republic Of The Congo") { echo "selected"; } ?> value="Republic Of The Congo">Republic Of The Congo </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Cook Islands") { echo "selected"; } ?> value="Cook Islands">Cook Islands </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Costa Rica") { echo "selected"; } ?> value="Costa Rica">Costa Rica </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Cuba") { echo "selected"; } ?> value="Cuba">Cuba </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Cyprus") { echo "selected"; } ?> value="Cyprus">Cyprus </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Djibouti") { echo "selected"; } ?> value="Djibouti">Djibouti </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Dominica") { echo "selected"; } ?> value="Dominica">Dominica </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Dominican Republic") { echo "selected"; } ?> value="Dominican Republic">Dominican Republic </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "East Timor") { echo "selected"; } ?> value="East Timor">East Timor </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Ecuador") { echo "selected"; } ?> value="Ecuador">Ecuador </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Egypt") { echo "selected"; } ?> value="Egypt">Egypt </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "El Salvador") { echo "selected"; } ?> value="El Salvador">El Salvador </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Equatorial Guinea") { echo "selected"; } ?> value="Equatorial Guinea">Equatorial Guinea </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Eritrea") { echo "selected"; } ?> value="Eritrea">Eritrea </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Estonia") { echo "selected"; } ?> value="Estonia">Estonia </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Ethiopia") { echo "selected"; } ?> value="Ethiopia">Ethiopia </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Faroe Islands") { echo "selected"; } ?> value="Faroe Islands">Faroe Islands </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Fiji Islands") { echo "selected"; } ?> value="Fiji Islands">Fiji Islands </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Finland") { echo "selected"; } ?> value="Finland">Finland </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "France") { echo "selected"; } ?> value="France">France </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "French Guiana") { echo "selected"; } ?> value="French Guiana">French Guiana </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "French Polynesia") { echo "selected"; } ?> value="French Polynesia">French Polynesia </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Gabon") { echo "selected"; } ?> value="Gabon">Gabon </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Gambia The") { echo "selected"; } ?> value="Gambia The">Gambia The </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Georgia") { echo "selected"; } ?> value="Georgia">Georgia </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Germany") { echo "selected"; } ?> value="Germany">Germany </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Ghana") { echo "selected"; } ?> value="Ghana">Ghana </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Greece") { echo "selected"; } ?> value="Greece">Greece </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Greenland") { echo "selected"; } ?> value="Greenland">Greenland </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Grenada") { echo "selected"; } ?> value="Grenada">Grenada </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Guadeloupe") { echo "selected"; } ?> value="Guadeloupe">Guadeloupe </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Guam") { echo "selected"; } ?> value="Guam">Guam </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Guinea") { echo "selected"; } ?> value="Guinea">Guinea </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Guinea") { echo "selected"; } ?> value="Guinea">Guinea </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Guyana") { echo "selected"; } ?> value="Guyana">Guyana </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Haiti") { echo "selected"; } ?> value="Haiti">Haiti </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Honduras") { echo "selected"; } ?> value="Honduras">Honduras </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Hong Kong S.A.R.") { echo "selected"; } ?> value="Hong Kong S.A.R.">Hong Kong S.A.R. </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Hungary") { echo "selected"; } ?> value="Hungary">Hungary </option>

			<option <?php if (isset($data->primary_country) && $data->primary_country == "Iceland") { echo "selected"; } ?> value="Iceland">Iceland </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "India") { echo "selected"; } ?> value="India">India </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Indonesia") { echo "selected"; } ?> value="Indonesia">Indonesia </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Iran") { echo "selected"; } ?> value="Iran">Iran </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Iraq") { echo "selected"; } ?> value="Iraq">Iraq </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Ireland") { echo "selected"; } ?> value="Ireland">Ireland </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Israel") { echo "selected"; } ?> value="Israel">Israel </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Italy") { echo "selected"; } ?> value="Italy">Italy </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Jamaica") { echo "selected"; } ?> value="Jamaica">Jamaica </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Japan") { echo "selected"; } ?> value="Japan">Japan </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Jordan") { echo "selected"; } ?> value="Jordan">Jordan </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Kazakhstan") { echo "selected"; } ?> value="Kazakhstan">Kazakhstan </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Kenya") { echo "selected"; } ?> value="Kenya">Kenya </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Kiribati") { echo "selected"; } ?> value="Kiribati">Kiribati </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Korea North") { echo "selected"; } ?> value="Korea North">Korea North </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Korea South") { echo "selected"; } ?> value="Korea South">Korea South </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Kuwait") { echo "selected"; } ?> value="Kuwait">Kuwait </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Kyrgyzstan") { echo "selected"; } ?> value="Kyrgyzstan">Kyrgyzstan </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Laos") { echo "selected"; } ?> value="Laos">Laos </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Latvia") { echo "selected"; } ?> value="Latvia">Latvia </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Lebanon") { echo "selected"; } ?> value="Lebanon">Lebanon </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Lesotho") { echo "selected"; } ?> value="Lesotho">Lesotho </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Liberia") { echo "selected"; } ?> value="Liberia">Liberia </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Libya") { echo "selected"; } ?> value="Libya">Libya </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Liechtenstein") { echo "selected"; } ?> value="Liechtenstein">Liechtenstein </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Lithuania") { echo "selected"; } ?> value="Lithuania">Lithuania </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Luxembourg") { echo "selected"; } ?> value="Luxembourg">Luxembourg </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Macau S.A.R.") { echo "selected"; } ?> value="Macau S.A.R.">Macau S.A.R. </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Macedonia") { echo "selected"; } ?> value="Macedonia">Macedonia </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Madagascar") { echo "selected"; } ?> value="Madagascar">Madagascar </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Malawi") { echo "selected"; } ?> value="Malawi">Malawi </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Malaysia") { echo "selected"; } ?> value="Malaysia">Malaysia </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Maldives") { echo "selected"; } ?> value="Maldives">Maldives </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Mali") { echo "selected"; } ?> value="Mali">Mali </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Malta") { echo "selected"; } ?> value="Malta">Malta </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Marshall Islands") { echo "selected"; } ?> value="Marshall Islands">Marshall Islands </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Martinique") { echo "selected"; } ?> value="Martinique">Martinique </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Mauritania") { echo "selected"; } ?> value="Mauritania">Mauritania </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Mauritius") { echo "selected"; } ?> value="Mauritius">Mauritius </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Mexico") { echo "selected"; } ?> value="Mexico">Mexico </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Micronesia") { echo "selected"; } ?> value="Micronesia">Micronesia </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Moldova") { echo "selected"; } ?> value="Moldova">Moldova </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Monaco") { echo "selected"; } ?> value="Monaco">Monaco </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Mongolia") { echo "selected"; } ?> value="Mongolia">Mongolia </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Morocco") { echo "selected"; } ?> value="Morocco">Morocco </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Myanmar") { echo "selected"; } ?> value="Myanmar">Myanmar </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Namibia") { echo "selected"; } ?> value="Namibia">Namibia </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Nauru") { echo "selected"; } ?> value="Nauru">Nauru </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Nepal") { echo "selected"; } ?> value="Nepal">Nepal </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Netherlands Antilles") { echo "selected"; } ?> value="Netherlands Antilles">Netherlands Antilles </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Netherlands The") { echo "selected"; } ?> value="Netherlands The">Netherlands The </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "New Caledonia") { echo "selected"; } ?> value="New Caledonia">New Caledonia </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "New Zealand") { echo "selected"; } ?> value="New Zealand">New Zealand </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Nicaragua") { echo "selected"; } ?> value="Nicaragua">Nicaragua </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Nigeria") { echo "selected"; } ?> value="Nigeria">Nigeria </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Niue") { echo "selected"; } ?> value="Niue">Niue </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Northern Mariana Islands") { echo "selected"; } ?> value="Northern Mariana Islands">Northern Mariana Islands </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Norway") { echo "selected"; } ?> value="Norway">Norway </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Oman") { echo "selected"; } ?> value="Oman">Oman </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Pakistan") { echo "selected"; } ?> value="Pakistan">Pakistan </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Palau") { echo "selected"; } ?> value="Palau">Palau </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Palestinian Territory Occupied") { echo "selected"; } ?> value="Palestinian Territory Occupied">Palestinian Territory Occupied </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Panama") { echo "selected"; } ?> value="Panama">Panama </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Paraguay") { echo "selected"; } ?> value="Paraguay">Paraguay </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Peru") { echo "selected"; } ?> value="Peru">Peru </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Philippines") { echo "selected"; } ?> value="Philippines">Philippines </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Poland") { echo "selected"; } ?> value="Poland">Poland </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Portugal") { echo "selected"; } ?> value="Portugal">Portugal </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Puerto Rico") { echo "selected"; } ?> value="Puerto Rico">Puerto Rico </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Qatar") { echo "selected"; } ?> value="Qatar">Qatar </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Reunion") { echo "selected"; } ?> value="Reunion">Reunion </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Romania") { echo "selected"; } ?> value="Romania">Romania </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Russia") { echo "selected"; } ?> value="Russia">Russia </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Rwanda") { echo "selected"; } ?> value="Rwanda">Rwanda </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Saint Helena") { echo "selected"; } ?> value="Saint Helena">Saint Helena </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Saint Lucia") { echo "selected"; } ?> value="Saint Lucia">Saint Lucia </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Samoa") { echo "selected"; } ?> value="Samoa">Samoa </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Saudi Arabia") { echo "selected"; } ?> value="Saudi Arabia">Saudi Arabia </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Serbia") { echo "selected"; } ?> value="Serbia">Serbia </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Singapore") { echo "selected"; } ?> value="Singapore">Singapore </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Slovakia") { echo "selected"; } ?> value="Slovakia">Slovakia </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Slovenia") { echo "selected"; } ?> value="Slovenia">Slovenia </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Solomon Islands") { echo "selected"; } ?> value="Solomon Islands">Solomon Islands </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "South Africa") { echo "selected"; } ?> value="South Africa">South Africa </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "South Georgia") { echo "selected"; } ?> value="South Georgia">South Georgia </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "South Sudan") { echo "selected"; } ?> value="South Sudan">South Sudan </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Spain") { echo "selected"; } ?> value="Spain">Spain </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Sri Lanka") { echo "selected"; } ?> value="Sri Lanka">Sri Lanka </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Sudan") { echo "selected"; } ?> value="Sudan">Sudan </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Swaziland") { echo "selected"; } ?> value="Swaziland">Swaziland </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Sweden") { echo "selected"; } ?> value="Sweden">Sweden </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Syria") { echo "selected"; } ?> value="Syria">Syria </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Thailand") { echo "selected"; } ?> value="Thailand">Thailand </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Togo") { echo "selected"; } ?> value="Togo">Togo </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Turkey") { echo "selected"; } ?> value="Turkey">Turkey </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Uganda") { echo "selected"; } ?> value="Uganda">Uganda </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Ukraine") { echo "selected"; } ?> value="Ukraine">Ukraine </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "United Arab Emirates") { echo "selected"; } ?> value="United Arab Emirates">United Arab Emirates </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "United Kingdom") { echo "selected"; } ?> value="United Kingdom">United Kingdom </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "United states") { echo "selected"; } ?> value="United states">United states </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Uruguay") { echo "selected"; } ?> value="Uruguay">Uruguay </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Uzbekistan") { echo "selected"; } ?> value="Uzbekistan">Uzbekistan </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Vanuatu") { echo "selected"; } ?> value="Vanuatu">Vanuatu </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Venezuela") { echo "selected"; } ?> value="Venezuela">Venezuela </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Vietnam") { echo "selected"; } ?> value="Vietnam">Vietnam </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Virgin Islands (British)") { echo "selected"; } ?> value="Virgin Islands (British)">Virgin Islands (British) </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Virgin Islands (US)") { echo "selected"; } ?> value="Virgin Islands (US)">Virgin Islands (US) </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Wallis And Futuna Islands") { echo "selected"; } ?> value="Wallis And Futuna Islands">Wallis And Futuna Islands </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Yemen") { echo "selected"; } ?> value="Yemen">Yemen </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Yugoslavia") { echo "selected"; } ?> value="Yugoslavia">Yugoslavia </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Zambia") { echo "selected"; } ?> value="Zambia">Zambia </option>
			<option <?php if (isset($data->primary_country) && $data->primary_country == "Zimbabwe") { echo "selected"; } ?> value="Zimbabwe">Zimbabwe </option>
			
				
								
							</select>
						</div>
						
						<div class="mb-3">
							<label for="inputsecondary_country" class="form-label">Loaction</label>
							<?php  $errorClass =  !empty($errors->has('secondary_country')) ? 'is-invalid':''; ?>  
							<select class ="form-control skills" name="secondary_country[]" multiple="multiple">
								<option value="">Select Secondary Country</option>
							@if(isset($data['secondary_country']))
							@foreach($data['secondary_country'] as $value)
							<option value="{{ $value->secondary_country}}" <?php if (isset($data['selected_secondary_country']) && in_array($value->secondary_country, $data['selected_secondary_country'])) { echo "selected"; } ?>>{{ $value->secondary_country}}</option>
							 @endforeach
							 @endif
							</select>
			
						</div>
						<div class="mb-3">
							<label for="inputrequirements" class="form-label">Requirements</label>
							<?php  $errorClass =  !empty($errors->has('requirements')) ? 'is-invalid':''; ?>   

							<!-- <textarea id="requirements" class="form-control" name="requirements" rows="10" cols="40">
								
							</textarea> -->
			                {!! Form::textarea('requirements', null, array('id'=>'requirements', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('requirements')) ?'<div class="invalid-feedback"><span>'.$errors->first('requirements').'</span></div>' :'' !!}
						</div>
						
						
						
						<div class="mb-3">
							<label for="inputlinkedIn_url" class="form-label">linkedIn URL</label>
							<?php  $errorClass =  !empty($errors->has('linkedIn_url')) ? 'is-invalid':''; ?>   
			                {!! Form::text('linkedIn_url', null, array('id'=>'linkedIn_url','placeholder' => 'Enter linkedIn URL','url'=>'true','pattern'=>'https://.*' ,'class' => 'form-control linkedIn_url'.$errorClass )) !!}
			                {!! !empty($errors->has('linkedIn_url')) ?'<div class="invalid-feedback"><span>'.$errors->first('linkedIn_url').'</span></div>' :'' !!}
						</div>
						@if($login_user_data->user_type == 1) 
						<div id="box" class="hide">
						<div class="mb-3">
							<label for="inputup_url" class="form-label">UP URL</label>
							<?php  $errorClass =  !empty($errors->has('up_url')) ? 'is-invalid':''; ?>   
			                {!! Form::text('up_url', null, array('id'=>'up_url','placeholder' => 'Enter up url','url'=>'true','pattern'=>'https://.*' , 'class' => 'form-control up_url'.$errorClass )) !!}
			                {!! !empty($errors->has('up_url')) ?'<div class="invalid-feedback"><span>'.$errors->first('up_url').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							<label for="inputbark_url" class="form-label">Bark URL</label>
							<?php  $errorClass =  !empty($errors->has('bark_url')) ? 'is-invalid':''; ?>   
			                {!! Form::text('bark_url', null, array('id'=>'bark_url','placeholder' => 'Enter bark url','url'=>'true','pattern'=>'https://.*' , 'class' => 'form-control bark_url'.$errorClass )) !!}
			                {!! !empty($errors->has('bark_url')) ?'<div class="invalid-feedback"><span>'.$errors->first('bark_url').'</span></div>' :'' !!}
						</div>
						</div>
						@else
						<div class="mb-3">
							<label for="inputup_url" class="form-label">UP URL</label>
							<?php  $errorClass =  !empty($errors->has('up_url')) ? 'is-invalid':''; ?>   
			                {!! Form::text('up_url', null, array('id'=>'up_url','placeholder' => 'Enter up URL','url'=>'true','pattern'=>'https://.*' , 'class' => 'form-control up_url'.$errorClass )) !!}
			                {!! !empty($errors->has('up_url')) ?'<div class="invalid-feedback"><span>'.$errors->first('up_url').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							<label for="inputbark_url" class="form-label">Bark URL</label>
							<?php  $errorClass =  !empty($errors->has('bark_url')) ? 'is-invalid':''; ?>   
			                {!! Form::text('bark_url', null, array('id'=>'bark_url','placeholder' => 'Enter bark url','url'=>'true','pattern'=>'https://.*' , 'class' => 'form-control bark_url'.$errorClass )) !!}
			                {!! !empty($errors->has('bark_url')) ?'<div class="invalid-feedback"><span>'.$errors->first('bark_url').'</span></div>' :'' !!}
						</div>
						
						@endif
					
						<div class="mb-3">
							<label for="inputMobile" class="form-label">Attach File</label>
						
							<div class="form-group input-group">
	                        	@if(isset($data->image))
                                    <div id="image_preview"><a href="{{ $data->image }}" download target="_blank"><img src="{{ $data->image }}"></a></div>

                    
	                            @endif

	            
	                            <div class="form-control">
	                                <label for="files">Attach File</label>
	                                <input type="file" id="file" name="image" class="form-control">
	                            </div>
								
	                         </div>
	                    </div>
						<div class="mb-3">
							<label for="inputcreated_at" class="form-label">Created at</label>
							<?php  $errorClass =  !empty($errors->has('created_at')) ? 'is-invalid':''; ?>   
			                {!! Form::datetime('created_at',null, array('id'=>'created_at', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('created_at')) ?'<div class="invalid-feedback"><span>'.$errors->first('created_at').'</span></div>' :'' !!}
						</div>
						<!-- <div class="mb-3">
							<label for="inputProductDescription" class="form-label">Description</label>
							<textarea class="form-control" id="inputProductDescription" rows="3"></textarea>
						</div> -->
			            <div class="mb-3">
						    <div class="d-grid">
	                           <button type="submit" id="submit" class="btn btn-light">Save</button>
						    </div>		  
			            </div>
		            </div>
			   	</div>
			</div>
	   </div><!--end row-->
	</div>
</div>
<script src="{{ URL::asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js')}}"></script>
 <!-- <script>
	$(document).ready(function () {
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
	}) -->
</script> 
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

		<script>

$(".skills").select2({
  tags: true,
  placeholder: "Select a Countries"
  
})	
</script>
<script>
  $(".country_dropdown").select2({
  
});
</script>



<script>
	jQuery('.mobile_number').keyup(function () { 
    this.value = this.value.replace(/[^0-9\.]/g,'');
});
// $('.primary_mobile_number').keyup(function(e){
//   if (/\D/g.test(this.value)) {
//     // Filter non-digits from input value.
//     this.value = this.value.replace(/\D/g, '');
//   }
// });
</script>
<script>

       
      $("#email").keyup(function() {
         var email = $(this).val();
		 $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		if(email != ''){
			// if(email.search('@')){
			// 	alert('iff');
			// }else{
			// 	alert('else');
			// }
			$(".email_cls").html('');
			$.ajax({
				type: "POST",
				url: "{{url('admin/checkEmail')}}",
				//   data: "email=" + $("#email").val(),
				data: {'email':email},
				success: function(data) {
					console.log(data.success);
					if(data.success == true){
						$(".email_cls").html(data.email_cls);
					}
				}
			});
		 }
  });


    
  $("#mobile_number").keyup(function() {
         var mobile_number = $(this).val();
		 $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		if(mobile_number != ''){
			// if(email.search('@')){
			// 	alert('iff');
			// }else{
			// 	alert('else');
			// }
			$(".phone_cls").html('');
			$.ajax({
				type: "POST",
				url: "{{url('admin/checkPhone')}}",
				//   data: "email=" + $("#email").val(),
				data: {'mobile_number':mobile_number},
				success: function(data) {
					console.log(data.success);
					if(data.success == true){
						$(".phone_cls").html(data.phone_cls);
					}
				}
			});
		 }
  });

</script>
<script>
	const box = document.getElementById('box');

	$( document ).ready(function() {
		handleRadioClick();
	});


function handleRadioClick() {
	
  if (document.getElementById('ajaysir').checked) {
    box.style.display = 'block';
  } else {
    box.style.display = 'none';
  }
}

const radioButtons = document.querySelectorAll('input[name="lead_source"]');
radioButtons.forEach(radio => {
  radio.addEventListener('click', handleRadioClick);
});


</script>

	<script>
function myFunction() {
  var checkBox = document.getElementById("whatsapp");
  var text = document.getElementById("whats");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
	