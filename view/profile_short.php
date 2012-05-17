<? if (!$this->user->logged_in()): ?>
<div id = "login">
    <h3> Sign in! </h3>
    <form method = "POST" action = "<?=url('login');?>">
        <input name = "user" type = "text" placeholder = "Username"/>
        <input name = "pass" type = "password" placeholder = "Password"/>
        <input type = "submit" value = "Login" />
    </form>                
    <h3> Sign up! </h3>   
    <form method = "POST" action = "<?=url('register');?>">
        <input name = "user" type = "text" placeholder = "Username" />
        <input name = "pass" type = "password" placeholder = "Password" />
        <input name = "cpass" type = "password" placeholder = "Confirm Password" />
        <input type = "submit" value = "Register" />        
    </form> 
</div>
<? else: ?>
    <div id = 'profile'>
        <? if ($this->user->profile): ?>
            <img src = "<?=content($this->user->profile);?>" width = "120" height = "120" />
        <? else: ?>
            <img src = "<?=url('img/pdef.png');?>" width = "120" height = "120" />
        <? endif; ?>
        
        <div><span class = 'title'>Full name</span> <?=$this->user->full_name;?> </div>
        <div><span class = 'title'>Username</span> <?= $this->user->name; ?></div>
        <div><span class = 'title'>Date joined</span> <?= date("F j, o", $this->user->time_registered); ?></div>
        <div><a href="<?=url("profile/{$this->user->id}");?>">Public profile</a></div>    
        <div><a href="<?=url("group/{$this->user->group}");?>">Group profile</a></div> 
    </div>
<? endif; ?>
