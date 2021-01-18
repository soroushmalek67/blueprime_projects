<section class="admin-home">
	<button id="enrich" class="btn btn-primary">Enrich twitter stats</button>
</section>

<script type="text/javascript">
	$("#enrich").click(function(){
		$.get("admin/enrich/twitter-stats", function(data){
  			alert(data);
		});	
	});

</script>