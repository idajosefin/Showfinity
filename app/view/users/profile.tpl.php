<div class="panel panel-default">
   <div class="panel-body">
    <article class="full-width">
        <a href="<?=$this->url->create('users')?>"><i class="fa fa-step-backward"></i> Users</a>

        <? if (isset($user) && is_object($user)): ?>
            <?php $gravatar = 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($user->email))) . '.jpg?s=40'; ?>
            <h1>
                <img class="gravatar" style='vertical-align: top; margin-right: 10px;' src='<?= $gravatar ?>' alt="Avatar"/>
                <?=$title?>
            </h1>

            <h3>Latest Questions</h3>
            <?php if(!empty($questions)) : ?>
                <?php foreach($questions as $question): ?>
                    <strong><a href="<?=$this->url->create('questions/title/' . $question->id . '/' . $question->slug)?>">
                             <span><?=$question->title?></span>
                        </a>
                        - <span class="about"><?=$this->time->getRelativeTime($question->created)?></span>
                    </strong><br />
                <?php endforeach; ?>
            <?php else : ?>
                <p>Nothing was found ...</p>
            <?php endif; ?>

            <h3>Latest Comments</h3>
            <?php if(!empty($comments)) : ?>
                <?php foreach($comments as $comment): ?>
                    <strong><a href="<?=$this->url->create('questions/title/' . $comment->q_id . '/' . $comment->q_slug)?>">
                        <span><?=(strlen($comment->content) > 53) ? substr($comment->content,0,50).'...' : $comment->content?></span>
                        </a>
                        - <span class="about"><?=$this->time->getRelativeTime($comment->created)?></span>
                    </strong><br />
                <?php endforeach; ?>
            <?php else : ?>
                <p>Nothing was found ...</p>
            <?php endif; ?>

            <h3>Latest Answers</h3>
            <?php if(!empty($answers)) : ?>
                <?php foreach($answers as $answer): ?>
                    <strong><a href="<?=$this->url->create('questions/title/' . $answer->q_id . '/' . $answer->q_slug . '/#section' . $answer->id)?>">
                        <span><?=(strlen($answer->content) > 53) ? substr($answer->content,0,50).'...' : $answer->content?></span>
                        </a>
                        - <span class="about"><?=$this->time->getRelativeTime($answer->created)?></span>
                    </strong><br />
                <?php endforeach; ?>
            <?php else : ?>
                <p>Nothing was found ...</p>
            <?php endif; ?>

            <?php
                if ($this->auth->isAuthenticated()) {
                if ($this->auth->username() === $user->acronym) {
                    echo "<br /><a class='btn btn-primary' href='" . $this->url->create('users/edit') . '/' . $user->acronym .  "'><i class='fa fa-pencil'></i> Redigera användare</a>";
                    }
                }
            ?>

            <? else : ?>
            <p>User not found!</p>
            <? endif; ?>
    </article>
   </div>
</div>