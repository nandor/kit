        <div id = "container">
            <div id = "sidebar">
                <? $this->render_view('profile_short'); ?> 
            </div> 
            <div id = "content">
                <? $this->render_view('messages'); ?>
                <h1> Authors </h1>
               
               	<p>
                	This site was created by students from the "Tiberiu Popoviciu" High School of Computer 
                	Science in Cluj-Napoca, Romania, coordinated by prof. Mihaela Giurgea.
                </p>
                
               	<ul>
               		<li> Nandor Licker &lt;<a href = "mailto:licker.nandor@gmail.com">licker.nandor@gmail.com</a>&gt; </li>
               		<li> Cristian Militaru &lt;<a href = "mailto:cristipiticul@yahoo.com">cristipiticul@yahoo.com</a>&gt; </li>
               		<li> Stefan Suciu &lt;<a href = "mailto:stefisuciu@yahoo.com">stefisuciu@yahoo.com</a>&gt; </li>
           		</ul>
           		
           		If you have any questions related to this project, feel free to contact us at the given addresses.
            </div>
            <? $this->render_view('footer'); ?>
        </div>
    </body>
</html>
