@if($projects)
    
    @if(!empty($projects))
    @foreach($projects as $key => $project)
        <option value="{{$project->total_amount}}" <?php echo isset($invoice) && $invoice->total_amount == $project->total_amount   ? 'selected' : '' ?> >{{$project->total_amount}}</option>

    
    @endforeach
    @else
    @endif
@endif