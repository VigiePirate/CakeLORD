<div class="row">
    <aside class="column"/>
        <div class="side-nav">
            <?= $this->element('my/sidebar') ?>
        </div>
    </aside>



    <div class="column-responsive column-90">
        <div class="users view content">


            <div class="mg-nav mg-nav--inline" id="nav-horizontal-example" data-toggle="nav">
                <ul>
                    <li class="active"><a href="#home">Home</a></li>
                    <li><a href="#news">News</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li class="mg-right"><a href="#about">About</a></li>
                </ul>
            </div>


            <?= $this->element('card', [
                'image' => $user->avatar,
                'rubric' => $user->username,
                $user->username => [
                    'Email:' => h($user->email) . ' (' . ($user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '') . ')',
                    'First Name:' => h($user->firstname),
                    'Last Name:' => h($user->lastname),
                    'Sex:' => $user->sex,
                    'Birth Date:' => $user->birth_date,
                    'Localization:' => h($user->localization),
                    'About Me:' => h($user->about_me),
                    'Wants Newsletter:' => $user->wants_newsletter ? __('Yes') : __('No'),
                ]
            ]) ?>
        </div>
    </div>
</div>
