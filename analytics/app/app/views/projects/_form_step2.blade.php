<input type="hidden" name="step" value="2"/>
<input type="hidden" name="name" value="{{$project['name']}}"/>
<input type="hidden" name="type" value="{{$project['type']}}"/>
<h3>Step 2 : Confirm file headers</h3>

@if (isset($error))
    <div class="alert alert-danger" role="alert">
        <h4><strong>Oh no! Something went wrong</strong></h4>
        <hr>
        <p>{{ $error }}</p>
    </div>
@endif

<div id="fields-container">
@foreach ($columns as $column)
	<div class="form-group">
	    <label for="type" class="col-sm-2 control-label">
	    	@if($column == 'town_center')
	    		local area
	    	@else
	    		{{$column}}
	    	@endif
	    </label>
	    <div class="col-sm-10">
	        <select name="headers[{{$column}}]">
	        	<option value="null"></option>
			@foreach ($headers as $header)
			    <option @if( ($column==$header && !isset($old_headers)) || (isset($old_headers) && $old_headers[$column] == $header) ) selected @endif>
			    	{{$header}}
			    </option>
			@endforeach        	
	        </select>
	    </div>
	</div>
@endforeach

	<div class="form-group">
	    <label for="type" class="col-sm-2 control-label">Capabilities</label>
	    <div class="col-sm-10">
	        <select name="capabilities[]" multiple>
			@foreach ($headers as $header)
			    <option>{{$header}}</option>
			@endforeach        	
	        </select>
	    </div>
	</div>

</div>


<style>
.select2-container{
	width: 400px;
}
</style>