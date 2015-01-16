<?php if ($this->auth->isAuthenticated()): ?>
    <?php $url = $this->url->create('questions/new'); ?>
    <a class="btn btn-success btn-sm pull-right" href='<?=$url?>'>Ask Question?</a>
<?php else: ?>
    <?php $url = $this->url->create('users/login'); ?>
    <a class="btn btn-default btn-sm pull-right" href='<?=$url?>'>Login</a>
<?php endif; ?>
