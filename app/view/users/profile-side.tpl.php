<div class="panel panel-default">
    <div class="panel-body">

        <h2 class="panel-title">About</h2>
            <? if (isset($user) && is_object($user)): ?>
            
                    <h3>Name</h3>
                    <p><?=$user->name?></p>

                    <h3>Username</h3>
                    <p><?=$user->acronym?></p>

                    <h3>Email</h3>
                    <p><?=$user->email?></p>

                    <h3>Reputation</h3>
                    <p>
                    <?php if ($user->rep < -30): ?>
                        <span class="red bold"> Low: </span>
                    <?php elseif ($user->rep < 10): ?>
                        <span class="bold"> Newbie: </span>
                    <?php elseif ($user->rep < 25): ?>
                        <span class="grn bold"> Average: </span>
                    <?php elseif ($user->rep < 100): ?>
                        <span class="grn bold"> High: </span>
                    <?php elseif ($user->rep < 1000): ?>
                        <span class="grn bold"> Expert: </span>
                    <?php endif ?>
                    <span> <?=$user->rep?> points / <?=$user->score?> posts</span>
                    
                    <h3>Member for</h3>
                    <p><?=$this->time->getRelativeTime($user->created)?></p>
                    
                    <h3>User level</h3>
                    <p><?=$user->permissionToString()?></p>

            <? else : ?>
            <? endif; ?>
    </div>
</div>
