        <div id = "container">
            <div id = "sidebar">
                <? $this->render_view('profile_short'); ?> 
            </div> 
            <div id = "content">
                <? $this->render_view('messages'); ?>
                <h1> KIT - Documentation </h1>
                <h2> API </h2>
                <p>
                    KIT has a REST api which allows programmers to retrieve data from
                    the site programatically using AJAX and JSON. The API returns a
                    response in the following format:
                    
                    <pre>
                    {
                        "status": "error" or "success",
                        "message": "Success" or description of the error,
                        "data": object containing requested data in case of success
                    }                    
                    </pre>
                    
                    The following queries are available: 
                    <ul>
                        <li>
                            /api/get/$user: Return all the available information for
                            a user. $user can be the numerical id of the user or the
                            username.
                        </li>                    
                    </ul>
                </p>
            </div>
            <? $this->render_view('footer'); ?>
        </div>
    </body>
</html>
