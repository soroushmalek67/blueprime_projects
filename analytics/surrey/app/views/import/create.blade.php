<section class="postal-codes-create">
    <h1 class="title">Import Data</h1>

    <form class="form-horizontal" enctype="multipart/form-data" role="form" action="{{ route('import.import') }}" method="post">

		@include('shared._errors')


		<div class="form-group">
		    <label for="type" class="col-sm-2 control-label">Type</label>
		    <div class="col-sm-10">
		    	<input type="radio" name="type" value="firmogram_company" checked> Companies &nbsp;&nbsp;&nbsp;<input type="text" name="database_name" placeholder=" Enter Database Name"> <br>
				<input type="radio" name="type" value="postal"> Postal Codes<br>
				<input type="radio" name="type" value="naics"> NAICS Codes		
			</div>
		</div>



		<div class="form-group">
		    <label for="file" class="col-sm-2 control-label">File input</label>
		    <div class="col-sm-10">
		    	<input type="file" name="file" id="file">
		    	<p class="help-block">
		            <div>Import data from <b>Windows Comma Speerated</b> csv file format</div>
		            <br>
		            Fields accepted:
		            <table>
		                <tr><td>Company</td><td>&nbsp;:&nbsp;name, name_2, address, address_2, city, province, country, postal, phone, url, naics, naics_2, established_at, revenue, employees and services</td></tr>
		            	<tr><td>Postal</td><td>&nbsp;:&nbsp;postal, lat, lng, city and province</td></tr>
		            	<tr><td>NAICS</td><td>&nbsp;:&nbsp;naics and description</td></tr>
		            </table>	
		    	</p>
			</div>
		</div>


		<div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		        <button type="submit" class="btn btn-primary">Import</button>
		        <a href="{{ route('projects.index') }}" type="submit" class="btn btn-default">Cancel</a>
		    </div>
		</div>

    </form>
</section>