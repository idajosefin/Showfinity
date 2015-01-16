<div class="panel panel-default">
   <div class="panel-body">
    <article class="full-width">

        <a href="<?=$this->url->create('questions')?>"><i class="fa fa-step-backward"></i> Questions</a>

        <? if (isset($question) && is_object($question)): ?>

        <h2><?=$title?></h2>
        <table class="table table-responsive">
            <tbody>
                <tr style='border: 0;'>
                    <td style="white-space: nowrap; vertical-align: top;">
                        <div class="vote-box">
                            <?=$question->q_score?>
                            <a href="<?=$this->url->create('questions/vote/' . $question->q_id . '/' . 'up')?>"><i class="vote-up fa fa-chevron-up"></i></a>
                            <a href="<?=$this->url->create('questions/vote/' . $question->q_id . '/' . 'down')?>"><i class="vote-down fa fa-chevron-down"></i></a>
                        </div>
                    </td>

                    <td style="vertical-align: top; width: 100%;">
                        <p><?=$question->content?></p>
                        <p class="question-about">
                            <a class="comment-about" href="<?=$this->url->create('users/profile/' . $question->acronym) ?>"><?=$question->acronym?></a>
                            <span class="comment-about">| <?=$this->time->getRelativeTime($question->created)?></span>
                            <a class="btn btn-primary btn-xs right" href='<?=$this->url->create('questions/comment/' . 'question' . '/' . $question->q_id . '/' . $question->q_id)?>'><i class="fa fa-comment"></i> Comment</a>
                            <a class="btn btn-success btn-xs right" href='<?=$this->url->create('questions/answer/' . $question->q_id . '/' . $question->slug)?>'><i class="fa fa-check"></i> Answer</a>
                        </p>
                        <?php if (isset($question->tags)): ?>
                            
                                <?php $tags = unserialize($question->tags) ?>
                                <?php foreach ($tags as $tag): ?>
                                    <a class="btn btn-default btn-xs" href="<?=$this->url->create('tags/tag/' . $tag)?>">#<?=$tag?></a>
                                <?php endforeach ?>
                        <?php endif ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php $comments = $this->dispatcher->forward(['controller' => 'questions', 'action' => 'comments', 'params' => ['question', $question->q_id],]); ?>
        <?php if(!empty($comments)) : ?>

                <table class="table table-responsive">
                    <tbody>
                        <?php foreach($comments as $comment): ?>
                            <tr class="comment" style='border: 0;'>
                                <td style="vertical-align: top;">
                                    <?=$this->textFilter->doFilter($comment->content, 'shortcode, markdown')?>
                                    <p class="comment-about">
                                        <img class="gravatar" style='vertical-align: text-top;' src='<?='http://www.gravatar.com/avatar/' . md5(strtolower(trim($comment->email))) . '.jpg?s=15'?>' alt="Avatar"/>
                                        <a href="<?=$this->url->create('users/profile/' . $comment->acronym) ?>"><?=$comment->acronym?></a> |
                                        <span><?=$this->time->getRelativeTime($comment->created)?></span>
                                    </p>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
        <?php endif; ?>

        <h2>Answers</h2>
            <?php if ($sort == 'score'): ?>
                <a style='margin-left: .3em;' class="sort small right" href="<?=$this->url->create('questions/title/' . $question->q_id . '/' . $question->slug . '/created')?>"><i class="fa fa-chevron-down"></i> Newest</a>
                <span class="small right">Score </span>
            <?php else: ?>
                <span style='margin-left: .3em;' class="small right">Newest </span>
                <a class="sort small right" href="<?=$this->url->create('questions/title/' . $question->q_id . '/' . $question->slug . '/score')?>"><i class="fa fa-chevron-down"></i> Score</a>
            <?php endif ?>

        <?php if(!empty($answers)) : ?>
            <table class="table table-responsive">
                <tbody>

                <?php foreach ($answers as $answer) : ?>
                    <?php
                        $click = null;
                        if ($this->auth->isAuthenticated()) {
                            if ($this->auth->username() === $question->acronym) {
                                $class = 'mark-answer hover';
                                $click = 'onclick="document.location = ' . "'" . $this->url->create('questions/correct/' . $question->q_id . '/' . $answer->id . "'" . '"');
                                if ($question->correct_answer == $answer->id) {
                                    $class = 'correct-answer-admin hover';
                                }
                            } else {
                                $class = 'no-mark';
                                $click = null;
                                if ($question->correct_answer == $answer->id) {
                                    $class = 'correct-answer';
                                }
                            }
                        } else {
                            $class = 'no-mark';
                            $click = null;
                            if ($question->correct_answer == $answer->id) {
                                $class = 'correct-answer';
                            }
                        }

                    ?>
                    <tr <?=$click?> id="section<?=$answer->id?>" class="<?=$class?>">

                        <td style="white-space: nowrap; vertical-align: top;">
                            <div class="vote-box">
                                <span><?=$answer->score?></span>
                                <a href="<?=$this->url->create('questions/voteAnswer/' . $answer->id . '/' . 'up')?>"><i class="vote-up fa fa-chevron-up"></i></a>
                                <a href="<?=$this->url->create('questions/voteAnswer/' . $answer->id . '/' . 'down')?>"><i class="vote-down fa fa-chevron-down"></i></a>
                            </div>
                        </td>

                        <td style="width: 100%;">
                            <p class="comment-content"><?=$this->textFilter->doFilter($answer->content, 'shortcode, markdown')?></p>
                            <p class="comment-about">
                                <img class="gravatar" style='vertical-align: text-top;' src='<?='http://www.gravatar.com/avatar/' . md5(strtolower(trim($answer->email))) . '.jpg?s=15'?>' alt="Avatar"/>
                                <a href="<?=$this->url->create('users/profile/' . $answer->acronym) ?>"><?=$answer->acronym?></a> |
                                <span><?=$this->time->getRelativeTime($answer->created)?></span>
                                <a class="btn btn-default btn-xs right" href='<?=$this->url->create('questions/comment/' . 'answer' . '/' . $answer->id . '/' . $question->q_id)?>'><i class="fa fa-comment"></i> Comment</a>
                            </p>
                        </td>

                    </tr>

                    <?php $comments = $this->dispatcher->forward(['controller' => 'questions', 'action' => 'comments', 'params' => ['answer', $answer->id],]); ?>
                    <?php if(!empty($comments)) : ?>

                        <?php foreach($comments as $comment): ?>
                            <tr class="comment">
                                <td style="vertical-align: top;"></td>
                                <td style="vertical-align: top;">
                                    <?=$this->textFilter->doFilter($comment->content, 'shortcode, markdown')?>
                                    <p class="comment-about">
                                        <img class="gravatar" style='vertical-align: text-top;' src='<?='http://www.gravatar.com/avatar/' . md5(strtolower(trim($comment->email))) . '.jpg?s=15'?>' alt="Avatar"/>
                                        <a href="<?=$this->url->create('users/profile/' . $comment->acronym) ?>"><?=$comment->acronym?></a> |
                                        <span><?=$this->time->getRelativeTime($comment->created)?></span>
                                    </p>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                    <?php endif; ?>
                <?php endforeach; ?>

                </tbody>
            </table>
            <?php else : ?>
                <p>Be the first one to answer.</p>
            <?php endif; ?>

            <?php else : ?>
            <p>Question does not exist!</p>
            <?php endif; ?>
    </article>
   </div>
</div>
