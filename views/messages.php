<div class="container" id="content">
<br>
<? if (!isset($messages)): ?>
<div class="alert alert-success" role="alert">Messages not found</div>
<? return false; endif;?>

<table class="table table-striped">
	<thead>
		<tr class="sorting-radio">
			<th width="20%">Sent <input type="radio" name="sort" id="datetime"><label for="datetime" class="glyphicon glyphicon-triangle-top"></label><input type="radio" name="sort" id="datetime_desc"><label for="datetime_desc" class="glyphicon glyphicon-triangle-bottom"></label></a></th>
			<th width="18%">Receiver <input type="radio" name="sort" id="username"><label for="username" class="glyphicon glyphicon-triangle-top"></label><input type="radio" name="sort" id="username_desc"><label for="username_desc" class="glyphicon glyphicon-triangle-bottom"></label></a></th>
			<th width="30%">Message</th>
		</tr>
	</thead>
	<tbody>
		<? foreach($messages as $i=>$v): ?>
		<tr <? if ($v['m_status'] == "new"):?>style="background: rgba(0, 128, 0, 0.13);"<?endif;?> id="item_<?= $v['id'];?>">
			<td><?= date('d-m-Y H:i', strtotime($v['datetime']))?></td>
			<td><?= $v['username'];?></td>
			<td><?= $v['message'];?></td>
			
		</tr>
		<? endforeach;?>
		
	</tbody>
</table>


<ul class="pagination">
	<? for ($page=1; $page<=$total_pages; $page++):?>
		<li <? if ($page == $active_page): ?> class="active" <?endif;?>><a href="javascript://" onclick="get_messages_list(<?= $page;?>)"  ><?= $page;?></a></li>
	<? endfor;?>	
</ul>

</div>
