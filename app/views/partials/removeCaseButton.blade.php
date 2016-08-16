@if ($can('remove_case'))
<a href="{{ route('cases.remove', array('case_id' => $case->id)) }}" class="btn btn-success">Remove Case</a>
@endif