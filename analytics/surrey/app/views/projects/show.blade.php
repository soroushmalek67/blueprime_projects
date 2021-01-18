<section class="projects-show">
    <div class="loading">
        <img src="{{url('assets/img/loader.gif')}}" alt="Loading" />
    </div>

    <header class="title">
        <div class="row">
            <div class="col-sm-10">
                <h4>{{$project->name}}</h4>
            </div>
        </div>
    </header>
    @if ($companies)
        <table class="table table-striped table-bordered companies">
            <thead>
                <th>Company Name</th>
                <th>NAICS</th>
                <th>City</th>
                <th>Province</th>
                <th>Country</th>
                <th></th>
                <th></th>
            </thead>

            <tbody>
                @foreach ($companies as $company)
                    <tr class="company">
                        <td>
                            <a href="javascript:void(0);" class="comany-name" id="{{ $company->id }}" twitter-url="{{ $company->twitter_url }}">
                                {{ $company->name }}
                            </a>
                        </td>
                        <td>
                            {{ $company->naics }}
                        </td>
                        <td>
                            {{ $company->city }}
                        </td>
                        <td>
                            {{ $company->province }}
                        </td>
                        <td>
                            {{ $company->country }}
                        </td>
                        <td>
                            @if($company->facebook_url != '')
                                <a href="{{$company->facebook_url}}" target="_blank">
                                    <img src="{{asset('assets/img/facebook32.png')}}">
                                </a>
                            @endif

                            @if($company->twitter_url != '')
                                <a href="{{$company->twitter_url}}" target="_blank">
                                    <img src="{{asset('assets/img/twitter32.png')}}">
                                </a>
                            @endif

                            @if($company->linkedin_url != '')
                                <a href="{{$company->linkedin_url}}" target="_blank">
                                    <img src="{{asset('assets/img/linkedin32.png')}}">
                                </a>
                            @endif
                        </td>
                        <td>
                            @if($canI('manage', $project))
                            <a href="javascript:void(0);" class="btn btn-danger delete-company" id="{{ $company->id }}">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</section>


<div class="modal fade" id="company-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
                    <li><a href="#tweets" data-toggle="tab">Tweets</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="details">
                    </div>
                    <div class="tab-pane" id="tweets">
                        <div id='divTweets'></div>
                        <iframe id='ifTweets' width="100%" height="390px" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('table').DataTable();
    $('.loading').fadeOut("slow");
});
</script>

