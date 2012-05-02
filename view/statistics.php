    <div id = "container">
        <div id = "statistics">
            <table class = "stat">
                <tr class = "control">
                    <th> <input type = "text" placeholder = "Name" /> </th>
                    <th> <input type = "text" placeholder = "Address" /> </th>
                    <th> <input type = "text" placeholder = "Education" /> </th>
                    <th> <input type = "text" placeholder = "Workplace" /> </th>
                </tr>
                <?php
                	foreach ($this->data as $user)
                	{
                		?><tr>
                			<td><?=$user['full_name'];?></td>
                			<td><?=$user['address'];?></td>
                			<td></td>
                			<td></td>
                		</tr><?
                	}
                ?>
            </table>
        </div>
        <? $this->render_view('footer'); ?>
    </div>
</div>
