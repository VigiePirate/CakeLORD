<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat $rat
 */
?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav-group">
                <?= $this->element('default_sidebar') ?>
            </div>
            <?php if (isset($rattery)) : ?>
                <div class="side-nav-group">
                    <div class="tooltip">
                        <?= $this->Html->image('/img/icon-back.svg', [
                            'url' => ['controller' => 'Ratteries', 'action' => 'view', $rattery->id],
                            'class' => 'side-nav-icon',
                            'alt' => __('Back to rattery sheet')]) ?>
                            <span class="tooltiptext"><?= __('Back to rattery sheet') ?></span>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="rats form content">

            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Ratteries') ?></div>
            </div>

            <h1><?= __('Rattery Map') ?></h1>

            <?php if (isset($rattery) && (! isset($rattery->latitude) || ! isset($rattery->longitude))) : ?>
                <div class="message error"><?= __('The rattery you asked for has not recorded its zipcode and therefore, cannot be displayed. Here are the other located ratteries.') ?></div>
            <?php endif; ?>

            <?php $this->append('script');?>
                <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
            <?php $this->end(); ?>
            <?php
                $map = $this->GoogleMap->map($map_options);

                echo $map;

                foreach ($ratteries as $marker) {
                    $icon = $this->GoogleMap->iconSet('purple', '', 's');
                    $this->GoogleMap->addMarker([
                        'lat' => $marker->latitude,
                        'lng' => $marker->longitude,
                        'title' => $marker->full_name,
                        'content' =>
                            '<span class="map-legend">
                                <b>' . $marker->name . '</b><br/>'
                                . __('Prefix: ') . $marker->prefix . ', ' . __('Owner: ') . $marker->user->username
                                . '<br/>'
                                . $this->Html->link(__('View rattery sheet'), ['action' => 'view', $marker->id], ['target' => '_blank'])
                            . '</span>',
                        'icon' => $icon,
                    ]);
                }

                if (isset($rattery)) {
                    if (isset($rattery->latitude) && isset($rattery->longitude)) {
                        $icon = $this->GoogleMap->iconSet('red', 'O', 'l');
                        $this->GoogleMap->addMarker([
                            'lat' => $rattery->latitude,
                            'lng' => $rattery->longitude,
                            'title' => $rattery->full_name,
                            'content' =>
                                '<span class="map-legend">
                                    <b>' . $rattery->name . '</b><br/>'
                                    . __('Prefix: ') . $rattery->prefix . ', ' . __('Owner: ') . $rattery->user->username
                                    . '<br/>'
                                    . $this->Html->link(__('View rattery sheet'), ['action' => 'view', $rattery->id], ['target' => '_blank'])
                                . '</span>',
                            'icon' => $icon,
                            'open' => true
                        ]);
                    }
                }

                $this->GoogleMap->finalize();
            ?>
        </div>
    </div>
</div>

<?= $this->Html->css('maps.css') ?>
