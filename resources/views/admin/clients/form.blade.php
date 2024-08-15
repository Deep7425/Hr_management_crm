@section('css') 
	<link href="{{ URL::asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css')}}" rel="stylesheet" />
@endsection
<style>
	.required:after {
    content:" *";
    color: red;
  }
  .parsley-required{    
        color: red;   
        font-size: 12px;
	}
	.btn.btn-primary.btn-xs {
  width: 33px;
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
						    <input type="hidden" name="primary_country_id" value="">
							<label for="inputName" class="form-label required">Name</label>
							<?php  $errorClass =  !empty($errors->has('client_name')) ? 'is-invalid':''; ?>   
			                {!! Form::text('client_name', null, array('id'=>'client_name','placeholder' => 'Enter Client Name', 'required'=>'required', 'class' => 'form-control '.$errorClass )) !!}
			                {!! !empty($errors->has('client_name')) ?'<div class="invalid-feedback"><span>'.$errors->first('client_name').'</span></div>' :'' !!}
						</div>
						
						<div class="mb-3">
							<label for="inputEmail" class="form-label required">Email Address</label>
							<?php $errorClass =  !empty($errors->has('email')) ? 'is-invalid':''; ?>
			                {!! Form::email('email', null, array('id'=>isset($data->email)?true:false,'placeholder' => 'Enter Client Email', 'required'=>'required', 'class' => 'form-control '.$errorClass)) !!}
			                {!! !empty($errors->has('email')) ?'<div class="invalid-feedback"><span>'.$errors->first('email').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
							<label for="inputclient_mobile_number" class="form-label required"> Mobile Number</label>
							<?php  $errorClass =  !empty($errors->has('client_mobile_number')) ? 'is-invalid':''; ?>   
			                {!! Form::text('client_mobile_number', null, array('id'=>'client_mobile_number', 'maxlength'=>'20','placeholder' => 'Enter Mobile Number', 'required'=>'required', 'class' => 'form-control client_mobile_number '.$errorClass )) !!}
			                {!! !empty($errors->has('client_mobile_number')) ?'<div class="invalid-feedback"><span>'.$errors->first('client_mobile_number').'</span></div>' :'' !!}
						</div>
						<div class="mb-3">
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
							<label for="inputclient_GST_number" class="form-label">GST-Number</label>
							<?php  $errorClass =  !empty($errors->has('client_GST_number')) ? 'is-invalid':''; ?>   
			                {!! Form::text('client_GST_number', null, array('id'=>'client_GST_number', 'placeholder' => 'Enter GST Number', 'class' => 'form-control client_GST_number '.$errorClass )) !!}
			                {!! !empty($errors->has('client_GST_number')) ?'<div class="invalid-feedback"><span>'.$errors->first('client_GST_number').'</span></div>' :'' !!}
						</div>





						<div class="mb-3">
							<label for="inputclient_address" class="form-label required"> Address <span id="charNum">(Character limit - 150)</span></label>
							<?php  $errorClass =  !empty($errors->has('client_address')) ? 'is-invalid':''; ?>   
			                {!! Form::textarea('client_address',null, array('placeholder'=>'Enter Client Address','maxlength'=>'150','id'=>'client_address','rows'=>'5','required'=>'required','class' => 'form-control textarea ckeditor '.$errorClass )) !!}
			                {!! !empty($errors->has('client_address')) ?'<div class="invalid-feedback"><span>'.$errors->first('client_address').'</span></div>' :'' !!}
						</div>
						
						
			            <div class="mb-3">
						    <div class="d-grid">
	                           <button type="submit" class="btn btn-light">{{$data['button']}}</button>
						    </div>		  
			            </div>
		            </div>
			   	</div>
			</div>
	   </div><!--end row-->
	</div>
</div>
<script src="{{ URL::asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
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
	})
</script> -->


<script>

	const phone = document.getElementById('client_mobile_number');
	phone.addEventListener('input', function() {
	let start = this.selectionStart;
	let end = this.selectionEnd;
	
	const current = this.value
	const corrected = current.replace(/([^+0-9]+)/gi, '');
	this.value = corrected;
	
	if (corrected.length < current.length) --end;
	this.setSelectionRange(start, end);
});
</script>

<script>

	var maxlength = 150;

	$( document ).ready(function() {
		var define = "{{ isset($data) && !empty($data->client_address) ? $data->client_address : '' }}";
		if(define.length > 0){
			var textlen = maxlength - define.length;
			$('#charNum').text('(Character limit - '+ textlen+')');
		}
	});
	
	$('.textarea').keyup(function(){
		var textlen = maxlength -  $(this).val().length;
		$('#charNum').text('(Character limit - '+ textlen+')');
	})

</script>
