<?php
use App\Models\Bank;
$bank = Bank::where('beneficiary_name',$data['value'])->get();

?>
@if(isset($bank[0]))
<option value="">-- Select Bank Account --</option>
@foreach($bank as $bank)
<option value="{{$bank->id}}">{{$bank->bank_name}} - ({{$bank->bank_accout_number}})</option>

@endforeach
@endif