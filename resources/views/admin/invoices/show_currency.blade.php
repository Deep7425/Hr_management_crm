@if($projects)
    
    @if(!empty($projects))
    @foreach($projects as $key => $project)
        <option value="{{$project->currency}}" <?php echo isset($invoice) && $invoice->currency == $project->currency   ? 'selected' : '' ?> >{{$project->currency}}</option>
       
        
    @endforeach
    @else
    @endif
@endif