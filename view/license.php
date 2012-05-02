        <div id = "container">
            <div id = "sidebar">
                <? $this->render_view('profile_short'); ?> 
            </div> 
            <div id = "content">
                <? $this->render_view('messages'); ?>
                <h1> License </h1>
                                
                <p> Copyright &copy; 2012, licj11c <br /> All rights reserved. </p>

                <p>
                    Redistribution and use in source and binary forms, with or 
                    without modification, are permitted provided that the 
                    following conditions are met:
                </p>
                <ul>
                    <li> 
                        Redistributions of source code must retain the above copyright 
                        notice, this list of conditions and the following disclaimer. 
                    </li>
                    <li> 
                        Redistributions in binary form must reproduce the above copyright 
                        notice, this list of conditions and the following disclaimer in 
                        the documentation and/or other materials provided with the distribution.
                    </li>
                </ul>
                
                <p>
                    THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" 
                    AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE 
                    IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE 
                    ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE 
                    LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL 
                    DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR 
                    SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER 
                    CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, 
                    OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE 
                    OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
                </p>
                
                <p>
                    You can find more information about the BSD License <a href = "http://www.opensource.org/licenses/bsd-license.php"> here </a>.
                </p>
                <p>
                    The source code of the site is available on github: <a href = "https://github.com/nandor/kit">https://github.com/nandor/kit</a>.
                </p>
            </div>
            <? $this->render_view('footer'); ?>
        </div>
    </body>
</html>
