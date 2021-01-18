<section class="projects-show">
    <div class="loading">
        <img src="{{url('assets/img/loader.gif')}}" alt="Loading" />
    </div>
    @if ($companies)
    <div class="project-index table-responsive">    
        <table id="projectDetiilsTable" class="table table-striped table-bordered companies">
            <thead>
                <th>Company Name</th>
                <th>NAICS</th>
                <th>City</th>
                <th>Province</th>
                <th>Country</th>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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
    $('#projectDetiilsTable').DataTable({
//        "searching": false,  
        "lengthChange": false,
        "pageLength": 6,
        "ordering": false
    });
    $('.loading').fadeOut("slow");
});
</script>

