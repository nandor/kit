        <div id = "container">
            <div id = "sidebar">
                <? $this->render_view('profile_short'); ?> 
            </div> 
            <div id = "content">
                <h1> List of Universities </h1>
                <div id = "univ_table_container">
                    <table id = "univ_table">
                        <tr>
                        	<th>Name</th>
                        	<th>Address</th>
                        	<th>Phone Number</th>
                        	<th>Email</th>
                    	</tr>
                        <?
                            for($i = 0; $i < $this->num_univs; $i++)
                            {
                                ?><tr class = "row <?=((($i & 1) ? 'odd' : 'even'));?>">
                                	<td>
                                		<a href = "<?=url('univ/profile/'.$this->universities[$i]['id']);?>">
                                			<?=$this->universities[$i]['name'];?>
                            			</a>
                        			</td>
                                	<td><?=$this->universities[$i]['address'];?></td>
                                	<td><?=$this->universities[$i]['phone_number'];?></td>
                                	<td>
                                		<a href = "mailto:<?=$this->universities[$i]['email'];?>">
                                			<?=$this->universities[$i]['email'];?>
                            			</a>
                        			</td>
                                </tr><?
                            }
                        ?>
                    	<tr class = 'last'>
                    		<th id = 'univ_buttons_container' colspan = "4">
                        		<input type = 'button' id = 'prev_button' value = "<- Previous Page" /> |
                        		Page: <input type = 'text' id = 'page_number_input' value = '1' style = 'width: 20px; text-align:center;'/> / 
                        		<span> <?=$this->num_pages ?> </span> 
                            	<input type = 'button' id = "goto_button" value = 'Go' />|
                        		<input type = 'button' id = 'next_button'  value = "Next Page ->"/>
                    		</th>
                    	</tr>
                    </table>
                </div>
                <div style = 'text-align: center;'>
                	Can't find your university? <a href = "<?=url('univ/add');?>"> Add a new one! </a>
                </div>
            </div>
            <? $this->render_view('footer'); ?>
        </div>
    </body>
</html>
