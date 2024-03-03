<!-- generic sidebar for technical tables -->

<?php
    $labo = 'http://laborats.weebly.com/' . h(preg_replace('/\s+/', '-', str_replace('é', 'eacute', mb_strtolower($object->name)))) . '.html';
?>

<div class="side-nav">
    <div class="side-nav-group">
        <?= $this->element('default_sidebar', ['help_url' => isset($help_url) ? $help_url : ['controller' => 'Faqs', 'action' => 'all']]) ?>
    </div>
    <div class="side-nav-group">
        <?php if (isset($can_cancel) && $can_cancel) : ?>
            <div class="tooltip">
                <?= $this->Html->image('/img/icon-back.svg', [
                    'url' => ['controller' => $controller, 'action' => 'view', $object->id],
                    'class' => 'side-nav-icon',
                    'alt' => __('Back')]) ?>
                    <span class="tooltiptext"><?= __('Cancel and go back') ?></span>
                </div>
            <?php endif; ?>

            <div class="tooltip">
                <?= $this->Html->image('/img/icon-list.svg', [
                    'url' => ['controller' => $controller, 'action' => 'index'],
                    'class' => 'side-nav-icon',
                    'alt' => __('List')]) ?>
                    <span class="tooltiptext"><?= $tooltip ?></span>
            </div>
            <?php if (isset($is_labo) && $is_labo) : ?>
                <div class="tooltip">
                    <!-- multisearch allows several color keys but only one search key for other traits -->
                    <?php if ($controller == 'Colors') {
                        echo $this->Html->link(
                            $this->Html->image('/img/icon-search-rats.svg', ['class' => 'side-nav-icon']),
                            $this->Url->build([
                                'controller' => 'Rats',
                                'action' => 'search',
                                '?' => [
                                    'sex_f' => '1',
                                    'sex_m' => '1',
                                    'alive' => '1',
                                    'deceased' => '1',
                                    'colors' => [$object->id],
                                ]
                            ]),
                            ['escape' => false]
                        );
                    } else {
                        echo $this->Html->link(
                            $this->Html->image('/img/icon-search-rats.svg', ['class' => 'side-nav-icon']),
                            $this->Url->build([
                                'controller' => 'Rats',
                                'action' => 'search',
                                '?' => [
                                    'sex_f' => '1',
                                    'sex_m' => '1',
                                    'alive' => '1',
                                    'deceased' => '1',
                                    strtolower($Variety) . '_id' => $variety->id,
                                ]
                            ]),
                            ['escape' => false]
                        );
                    }
                    ?>
                    <span class="tooltiptext"><?= __('Search rats') ?></span>
                </div>

                <?php if (@get_headers($labo)['0'] != 'HTTP/1.1 404 Not Found'
                    && @get_headers($labo)['0'] != 'HTTP/1.1 400 Bad Request')
                : ?>
                    <div class="tooltip">
                        <?= $this->Html->link(
                            $this->Html->image('/img/icon-laborats.svg', [
                                'class' => 'side-nav-icon',
                                'alt' => __('Laborats')]),
                                $labo,
                                ['escape' => false, 'target' => '_blank']
                            ); ?>
                            <span class="tooltiptext"><?= __('See matching Lab-o-rats entry') ?></span>
                    </div>
                <?php else : ?>
                    <div class="tooltip disabled">
                        <?= $this->Html->image('/img/icon-laborats.svg', [
                            'url' => [],
                            'class' => 'side-nav-icon',
                            'alt' => __('Laborats')
                        ]) ?>
                        <span class="tooltiptext"><?= __('No matching Lab-o-rats entry available') ?></span>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php if (isset($show_staff) && $show_staff && ! is_null($user) && $user->is_staff) : ?>
            <div class="side-nav-group">
                <?= $this->element('staff_sidebar', [
                    'controller' => $controller,
                    'object' => $object,
                    'can_cancel' => isset($can_cancel) ? $can_cancel : false,
                    'user' => $user
                ])
                ?>
        </div>
    <?php endif; ?>
</div>
