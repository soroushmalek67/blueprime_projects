<div class="company-show">
    <div style="float:right">
        @if($company->details->facebook_url != '')
            <a href="{{$company->details->facebook_url}}" target="_blank">
                <img src="{{asset('assets/img/facebook32.png')}}">
            </a>
        @endif

        @if($company->details->twitter_url != '')
            <a href="{{$company->details->twitter_url}}" target="_blank">
                <img src="{{asset('assets/img/twitter32.png')}}">
            </a>
        @endif

        @if($company->details->linkedin_url != '')
            <a href="{{$company->details->linkedin_url}}" target="_blank">
                <img src="{{asset('assets/img/linkedin32.png')}}">
            </a>
        @endif

        <a href="{{url('/companies/'.$company->matching_source.'/'.$company->matching_company_id)}}">
        	<img src="{{asset('assets/img/graph1.png')}}">
        </a>
    </div>

	<div>
		<label>Product & services: </label> {{$company->details->services}}
	</div>

	<div>
		<label>Address: </label> {{$company->details->address}}, {{$company->details->city}}, {{$company->details->province}}, {{$company->details->country}}
	</div> 
	   
	<div>
		<label>Phone: </label> {{$company->details->phone}}
	</div>

    <div>
    	<label>Employees: </label> {{$company->details->employees}}
    </div>

	<div>
		<label>Website: </label> {{$company->details->url}}
	</div>


	<br><br>

	<div>
		<label>Company Description: </label>
		<p>{{$company->details->description}}</p>
	</div>

	<br>

	<div>
		<label>Company Capabilities: </label>
		<ul>
		@foreach ($company->capabilities as $capability)
			<li>{{$capability->name}}</li>
		@endforeach
		</ul>
	</div>
</div>