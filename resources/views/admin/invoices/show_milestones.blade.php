@if(count($projects) > 0)
    @for($i = 0; $i < count($projects); $i++) 
        @php
            $milestones = explode(',', $projects[$i]->milestone_name);
            $currencies = explode(',', $projects[$i]->totalproject_currency);
            $total_amounts = explode(',', $projects[$i]->totalproject_amount);
        @endphp

        <div class="row">
            <div class="col-sm-4 mb-3">
                <label for="inputmilestone_name" class="form-label required">Milestone Name</label>
                @foreach($milestones as $index => $milestone)
                    <input type="text" class="form-control" name="milestone[{{ $i }}][]" value="{{ $milestone }}" required="required">
                @endforeach
            </div>

            <div class="col-sm-4 mb-3">
                <label for="inputcurrency" class="form-label required">Currency</label>
                @foreach($currencies as $index => $currency)
                    <input type="text" class="form-control" name="currency[{{ $i }}][]" value="{{ $currency }}" required="required">
                @endforeach
            </div>

            <div class="col-sm-4 mb-3">
                <label for="inputtotal_amount" class="form-label required">Total Amount</label>
                @foreach($total_amounts as $index => $total_amount)
                    <input type="text" class="form-control" name="total_amount[{{ $i }}][]" value="{{ $total_amount }}" required="required">
                @endforeach
            </div>
        </div>
    @endfor
@endif

