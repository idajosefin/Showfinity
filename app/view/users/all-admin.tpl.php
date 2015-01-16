<div class="panel panel-default">
   <div class="panel-body">
    <article class="full-width">
        <h1><?=$title?></h1>

        <?php if(!empty($users)) : ?>

            <table class='table table-responsive'>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th style="text-align: center;">Remove</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($users as $user) : ?>

                        <?php $properties = $user->getProperties(); ?>
                        <tr>
                            <?php $url = $this->url->create('users/profile/' . $properties['acronym']) ?>
                            <td><a href="<?=$url?>"><?=$properties['acronym']?></a></td>
                            <td><?=$properties['name']?></td>
                            <td><?=$properties['email']?></td>

                            <?php $url = $this->url->create('users/delete/' . $properties['id']) ?>
                            <td style="text-align: center;"><a href="<?=$url?>" class="btn btn-danger user-btn tooltip-test" title="Remove"> <i class="fa fa-times"></i> </a></td>
                        </tr>

                    <?php endforeach; ?>

                </tbody>
            </table>

        <?php else : ?>
            <p>No users found.</p>
        <?php endif; ?>
        
        </article>
   </div>
</div>