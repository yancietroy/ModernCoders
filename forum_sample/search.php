<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body" id="search_result">
				<div id="preloader3"></div>
			</div>
		</div>
	</div>
</div>
<ul id="clone-ul" style="display: none">
	<li class="list-group-item mb-4">
		<div>
            <span class="float-right mr-4"><small><i>Created: <span class="created"></span></i></small></span>
			<a href="" class=" filter-text title"><?php echo $row['title'] ?></a>

		</div>
		<hr>
		<p class="truncate filter-text desc"></p>
		<p class="row justify-content-left"><span class="badge badge-success text-white"><i>Posted By: <span class="posted"></span></i></span></p>
		<hr>
		<div class="row">
			<div class="col-lg-12">
				<span class="float-left badge badge-secondary text-white"><span class="views"></span> view/s</span>
				<span class="float-left badge badge-primary text-white ml-2"><i class="fa fa-comments"></i> <span class="comments"></span> </span>
				<span class="float-right tags">
					<span>Tags: </span>
				</span>
			</div>
		</div>
	</li>
</ul>
<script>
	window.load_search = function(){
		$.ajax({
			url:'ajax.php?action=search',
			method:'POST',
			data:{keyword : '<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>'},
			success:function(resp){
				if(resp){
					resp = JSON.parse(resp)
					if(resp.length > 0){
						var ul = $('<ul id="topic-list"></ul>');
						Object.keys(resp).map(k=>{
							var li = $('#clone-ul li').clone()
							li.find('.title').text(resp[k].title)
							li.find('.title').attr('href','index.php?page=view_forum&id='+resp[k].id)
							li.find('.posted').text(resp[k].posted)
							li.find('.created').text(resp[k].created)
							li.find('.desc').text(resp[k].desc)
							li.find('.views').text(resp[k].view)
							li.find('.comments').text(resp[k].comments)
							Object.keys(resp[k].tags).map(t=>{
								var span = '<span class="badge badge-info text-white ml-2">'+resp[k].tags[t]+'</span>';
								li.find('.tags').append(span)
							})
							ul.append(li)
								
						})
							$('#search_result').html(ul)
							$('#topic-list').JPaging({
								pageSize: 15,
								visiblePageSize: 10

								});
					}else{
							$('#search_result').html('<h4><b>No seach result for the given keyword.</b></h4>')
					}
				}
			}
		})
	}
	$(document).ready(function(){
		load_search()
	})
</script>