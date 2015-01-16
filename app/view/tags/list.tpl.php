<div class="panel panel-default">
   <div class="panel-body">
    <article class="full-width">

        <h2><?=$title?></h2>

         <table class="table table-responsive">
            <tbody>
                 <?php if(!empty($tags)) : ?>

                    <?php foreach($tags as $tag): ?>
                    	<tr>
                        	<td>
                        		<a class="btn btn-default btn-sm" href="<?=$this->url->create('tags/tag/' . $tag->text)?>">
                                #<?=$tag->text?></a>
                            	<span class='tag-uses'> x <?=$tag->uses?></span>
                        	</td>
                    	</tr>
                        
                    <?php endforeach; ?>

                <?php else : ?>
                    <p>Nothing yet ...</p>
                <?php endif; ?>
            </tbody>
        </table>
    </article>
   </div>
</div>
