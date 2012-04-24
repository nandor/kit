        <div id = "timeline">
            <div class = "bar_horz_holder">
                <table class = "bar_horz">   
                    <tr>
                    <?php
                        foreach ($this->timeline_steps as $time)
                        {
                            echo "<td>{$time}</td>";
                        }
                    ?>
                    </tr>
                </table>
            </div>
            <div class = "bar_vert_holder">
                <div class = "bar_horz">
                
                </div>
            </div>
            <?php
            ?>  
        </div>
    </body>
</html>
