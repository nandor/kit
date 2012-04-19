<? if ($this->user->profile): ?>
    <img src = "<?=content($this->user->profile);?>" width = "120" height = "120" />
<? else: ?>
    <img src = "<?=url('img/pdefault');?>" width = "120" height = "120" />
<? endif; ?>
<?= $this->user->name; ?><br />

<a href = "<?=url('user');?>">Profile</a>
<a href = "<?=url('logout');?>">Logout</a>
