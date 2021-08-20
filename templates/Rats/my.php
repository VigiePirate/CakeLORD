<div class="row">
    <aside class="column"/>
        <div class="side-nav">
            <?= $this->element('my/sidebar') ?>
        </div>
    </aside>



    <div class="column-responsive column-90">





        <div class="users view content">


            <div class="mg-tabs" data-toggle="tabs" id="tabs-example">
                          <ul>
                            <li class="mg-tabs--item active" data-target="tab1">
                              <a href="#" class="secondary">Tab one</a>
                            </li>
                            <li class="mg-tabs--item" data-target="tab2">
                              <a href="#" class="button--outline">Tab two</a>
                            </li>
                            <li class="mg-tabs--item" data-target="tab3">
                              <a href="#" class="secondary">Tab one</a>
                            </li>
                          </ul>
                          <div class="mg-tabs--content" id="tab1">
                            1 Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Magni iste, placeat voluptates sapiente blanditiis fuga ullam.
                            Iure dolorum libero fugit quidem, voluptate veniam aut animi
                            nihil voluptas mollitia, aliquid inventore.
                          </div>
                          <div class="mg-tabs--content" id="tab2">
                            2 Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Magni iste, placeat voluptates sapiente blanditiis fuga ullam.
                            Iure dolorum libero fugit quidem, voluptate veniam aut animi
                            nihil voluptas mollitia, aliquid inventore.
                          </div>
                          <div class="mg-tabs--content" id="tab3">
                            3 Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Magni iste, placeat voluptates sapiente blanditiis fuga ullam.
                            Iure dolorum libero fugit quidem, voluptate veniam aut animi
                            nihil voluptas mollitia, aliquid inventore.
                          </div>
                        </div>


                <?= $this->element('rats', [
                    'rubric' => __('My Rats'),
                    'exceptions' => [
                        'pup_name',
                        'birth_date',
                        'owner_user_id',
                    ],
                ]) ?>
        </div>
    </div>
</div>
