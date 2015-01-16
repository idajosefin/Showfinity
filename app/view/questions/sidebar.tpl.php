<div class="panel panel-default">
    <div class="panel-body">
        <?php $url = $this->url->create('questions/new'); ?>

        <a href="<?=$this->url->create('questions')?>">
            <h2 class="panel-title"><?=$title?></h2>
        </a>

        <?php if(!empty($questions)) : ?>

            <table>
                <tbody>
                    <?php foreach ($questions as $question) : ?>
                        <?php $url = $this->url->create('questions/title/' . $question->q_id .'/' . $question->slug)?>
                        <tr onclick="document.location = '<?=$url?>'">
                            <td>
                                <h3><?=(strlen($question->title) > 20) ? substr($question->title,0,40).'...' : $question->title?></h3>
                                <p><?=(strlen($question->content) > 178) ? substr($question->content,0,175).'...' : $question->content?></p>
                                <p>
                                    <a href="<?=$this->url->create('users/profile/' . $question->acronym) ?>"><?=$question->acronym?></a> |
                                    <span><?=$this->time->getRelativeTime($question->created)?></span>
                                </p>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>

        <?php else : ?>
        <p>No questions found.</p>
        <?php endif; ?>
    </div>
</div>
