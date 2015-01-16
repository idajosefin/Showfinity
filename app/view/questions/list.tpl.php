<div class="panel panel-default">
   <div class="panel-body">
    <article class="full-width">

        <?php $url = $this->url->create('questions/new'); ?>

        <h2><?=$title?></h2>
        <a href='<?=$url?>' class="btn btn-default right"><span><i class="fa fa-plus"></i> New</span></a>

        <?php if(!empty($questions)) : ?>

            <table class="table table-responsive">
                <tbody>
                <?php foreach ($questions as $question) : ?>
                    <?php $url = $this->url->create('questions/title/' . $question->q_id .'/' . $question->slug)?>
                        <tr>
                        <td>
                            <h2><a href="<?=$url?>"><?=$question->title?></a></h2>
                            <p class="question-about">
                                <img class="gravatar" style='vertical-align: text-top;' src='<?='http://www.gravatar.com/avatar/' . md5(strtolower(trim($question->email))) . '.jpg?s=15'?>' alt="Avatar"/>
                                <a href="<?=$this->url->create('users/profile/' . $question->acronym) ?>"><?=$question->acronym?></a>
                                <span> | <?=$this->time->getRelativeTime($question->created)?></span>

                            </p>
                            <?php if (isset($question->tags)): ?>
                                    <?php $tags = unserialize($question->tags) ?>
                                    <?php foreach ($tags as $tag): ?>
                                        <a class="btn btn-default btn-xs" href="<?=$this->url->create('tags/tag/' . $tag)?>">#<?=$tag?></a>
                                    <?php endforeach ?>
                            <?php endif ?>

                            <td class="votes">
                                <?php if ($question->q_score > 0): ?>
                                     <span class="blue"><?=$question->q_score?></span><br />votes
                                <?php elseif ($question->q_score < 0): ?>
                                    <span class="red"><?=$question->q_score?></span><br /> votes
                                <?php else: ?>
                                    <span class="blue"><?=$question->q_score?></span><br /> votes 
                                <?php endif ?>
                            </td>

                            <td class="answers">
                                <span class="blue"><?=$question->count?></span>
                                <?php if ($question->count == 1): ?><br />
                                    answer
                                <?php else: ?><br />
                                    answers
                                <?php endif ?>
                            </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>

        <?php else : ?>

            <p>No questions found.</p>

        <?php endif; ?>
    </article>
   </div>
</div>