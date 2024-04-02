<thead>
    <tr>
		@if(isset($headerColumns[0]))
		@foreach($headerColumns as $key => $column)
			<th @if(isset($column[3])) style="{!! $column[3] !!}" @endif>{{ ucwords(str_replace('_', ' ', $column[0])) }}</th>
		@endforeach
		@endif
	</tr>
</thead>