<div id="tableT">
	
</div>
<div id="myModal" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Modal header</h3>
	</div>
	<div id="formLocation" class="modal-body">
	
	</div>
</div>
<script>
	var base_url = 'http://localhost/ho/index.php/api/<?php echo $this->modelClass?>/';
	var form_url = 'http://localhost/ho/index.php/<?php echo $this->modelClass?>/form/';
	function getData()
	{
		jQuery.ajax({
			'type':'GET',
			'url':base_url,
			'success':function(data){
					var t = jQuery.parseJSON(data);
					var table = $("<table></table>");
					table.attr("class","table table-striped");
					var thead = $("<thead></thead>");
					for(var attr in t[0]){
						thead.append("<th>"+attr+"</th>");
					}
					thead.append("<th>Action</th>");
					table.append(thead);	
					for(var i=0;i<t.length;i++){
						var row = $("<tr></tr>");
						for(var attr in t[i]){
							row.append("<td>"+t[i][attr]+"</td>");
						}
						row.append("<td><a href=\"#\" onclick=\"update("+t[i].id+")\">Update</a> <a href=\"#\" onclick=\"delete("+t[i].id+")\">Delete</a></td>");
						table.append(row);
					}
					console.log(table);
					$("#tableT").html(table);					
				}
		})
	}
	$("document").ready(function(){
		getData();
	});
	function update(id)
	{
		$("#myModal").off('hidden',getData);
		jQuery.ajax({
			'type':'GET',
			'url':form_url+id,
			'success':function(data)
			{
				$("#formLocation").html(data);
				$("#myModal").modal();
				$("#myModal").on('hidden',getData);
			}
		});
	}
</script>
