    <div id = "container">
        <div id = "search">
            <table class = "filter">
                <tr class = "control">
                    <th> 
                    	<input type = "text" name = "name" placeholder = "Name" /> 
                    	<img id = "name_sort" data-filter = "name" src = "<?=url('img/sort_down.png');?>">
                    </th>
                    <th> 
                    	<input type = "text" name = "addr" placeholder = "Address" /> 
                    	<img id = "address_sort" data-filter = "addr" src = "<?=url('img/sort_down.png');?>">
                    </th>
                    <th> 
                    	<input type = "text" name = "edu" placeholder = "University" /> 
                    	<img id = "edu_sort" data-filter = "edu" src = "<?=url('img/sort_down.png');?>">
                    </th>
                    <th> 
                    	<input type = "text" name = "work" placeholder = "Workplace" /> 
                    	<img id = "name_sort" data-filter = "work" src = "<?=url('img/sort_down.png');?>">
                    </th>
                </tr>
                <?php
                    $count = 0;
                    while ($user = DB::next($this->data))
                	{
                	    $count++;
                		?><tr class = 'row'>
                			<td><a href = "<?=url('profile/'.$user['id']);?>"><?=$user['full_name'];?></a></td>
                			<td><?=$user['address'];?></td>
                			<td></td>
                			<td></td>
                		</tr><?
                	}
                	?>
                	<tr class = "more" style = "display:<?=($count < $this->user->get_count()) ? 'visible': 'none';?>;">
            	        <td colspan = "4"> More </td>
                    </tr>
            </table>
        </div>
        <? $this->render_view('footer'); ?>
    </div>
</div>
