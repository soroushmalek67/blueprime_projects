            <style type="text/css">
                .container {
                    max-width: 100%;
                    width: 1200px;
                }
                table {
                    border-collapse: collapse;
                }
                
                .homeLatstProjectsTable {
                    
                }
                .homeLatstProjectsTable td {
                    vertical-align: top;
                }
                .homeLatestProjectBoxes {
                    border: 1px solid #e8e8e8;
                    margin: 15px auto;
                    width: 100%;
                    position: relative;
                    height: 512px;
                    overflow: auto;
                    overflow-x: hidden;
                }
                .homeLatstProjectsTable [class*="col-md-"] > a h3 {
                    font: 30px OpenSansRegular;
                    color: #364859;
                }
                .homeLatstProjectsTable .homeLatestProjectBoxes .dataTables_wrapper .dataTables_info, 
                .homeLatstProjectsTable .homeLatestProjectBoxes .dataTables_wrapper .dataTables_paginate {
                    float: none;
                    padding: 0;
                    text-align: center;
                }
                .homeLatstProjectsTable .homeLatestProjectBoxes table.dataTable {
                    box-sizing: border-box;
                }
                .homeLatstProjectsTable .homeLatestProjectBoxes .projects-show {
                    min-height: inherit;
                }
                
                .homeLatstProjectsTable .homeLatestProjectBoxes .homeLatestProjectAnalyticsBoxes {
                    zoom: 0.7;
					-ms-zoom: 0.7;
					-webkit-zoom: 0.7;
					-moz-transform:  scale(0.7, 0.7);
					-moz-transform-origin: left top;
                }
                .homeLatstProjectsTable .homeLatestProjectBoxes .homeLatestProjectTreemapBoxes {
                    zoom: 0.66;
					-ms-zoom: 0.66;
					-webkit-zoom: 0.66;
					-moz-transform:  scale(0.66, 0.66);
					-moz-transform-origin: left top;
                }

            </style>
			<script src="{{url('assets/js/vendor/d3.v3.min.js')}}"></script>
            
            <div class="row homeTopThreeBoxesCont">
                <div class="col-md-4">
                    <div class="homeTopThreeBox">
                        <h2>Firms</h2>
                        <div class="homeTopThreeBoxesCircleCont">
                            <span>{{count($companies)}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="homeTopThreeBox">
                        <h2>Categories</h2>
                        <div class="homeTopThreeBoxesCircleCont">
                            <span>{{$capabilities}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="homeTopThreeBox">
                        <h2>Revenue</h2>
                        <div class="homeTopThreeBoxesCircleCont">
                            <span>
                            	<span>$</span>@if ($revenue < 1000){{$revenue}} @else{{($revenue / 1000)}}<span>k</span> @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row homeLatstProjectsTable">
                <div class="col-md-6">
                    <a href="{{url("projects/$id")}}"><h3 class="title">Data</h3></a>
                    <div class="homeLatestProjectBoxes">
                        @include('home.partials.projects')
                    </div>
                </div>
                <div class="col-md-6">
                    <a href="{{url("maps/$id")}}"><h3 class="title">Geo-Map</h3></a>
                    <div class="homeLatestProjectBoxes">
                        @include('home.partials.map')
                    </div>
                </div>
                <div class="col-md-12">
                    <a href="{{url("eco/$id")}}"><h3 class="title">Eco-system</h3></a>
                    <div class="homeLatestProjectBoxes" style="height: 850px;padding-top: 20px;">
                        @include('home.partials.eco')
                    </div>
                </div>
                <div class="col-md-6">
                    <a href="{{url("analytics/$id")}}"><h3 class="title">Analytics</h3></a>
                    <!-- <div class="homeLatestProjectBoxes" style="height: 460px; overflow-x: scroll;"> -->
                    <div class="homeLatestProjectBoxes">
                        <div class="homeLatestProjectAnalyticsBoxes">@include('home.partials.analytics')</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <a href="{{url("treemap/$id")}}"><h3 class="title">Tree-Map</h3></a>
                    <!-- <div class="homeLatestProjectBoxes" style="height: 800px; overflow-x: scroll;"> -->
                    <div class="homeLatestProjectBoxes" style="overflow: hidden;">
                        <div class="homeLatestProjectTreemapBoxes">@include('home.partials.treemap')</div>
                    </div>
                </div>
            </div>