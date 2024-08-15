@if($projects)
    <option value="">Select Project</option>
    @if(!empty($projects))
    @foreach($projects as $key => $project)
        <option value="{{$project->project_name}}" <?php echo isset($invoice) && $invoice->project_name == $project->project_name ? 'selected' : '' ?>>{{$project->project_name}}</option>
    @endforeach
    @else
    @endif
@endif