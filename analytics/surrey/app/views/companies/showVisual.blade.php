<link rel="stylesheet" href="{{ url('assets/css/dndtree.css') }}">

<div class="panel panel-success">
  <div class="panel-heading">
      <span class="badge pull-right" style="background-color:#7DD188">
        <h5>{{$company->city}}, {{$company->province}}</h5>
      </span>
      <span style="float:right;margin-right:10px">
      </span>
    <h4>{{$company->name}}</h4>
  </div>
  <div class="panel-body">
    
  <div>
    <label>Product & services: </label> {{$company->services}}
  </div>

  <div>
    <label>Address: </label> {{$company->address}}, {{$company->city}}, {{$company->province}}, {{$company->country}}
  </div> 
     
  <div>
    <label>Phone: </label> {{$company->phone}}
  </div>

  <div>
    <label>Employees: </label> {{$company->employees}}
  </div>

  <div>
    <label>Website: </label> {{$company->url}}
  </div>

  <div>
    <label>Description: </label> {{$company->description}}
  </div>
    
  </div>
</div>         
<div style="clear:both"></div>
<div class="jumbotron1">
</div>
<div style="clear:both"></div>
<div id="tree-container"></div>

<script src="{{url('assets/js/vendor/d3.v3.min.js')}}"></script>
<script src="{{url('assets/js/dndtree.js')}}" id="helper" company-type="{{$type}}" company-id="{{$projectCompanyId}}"></script>