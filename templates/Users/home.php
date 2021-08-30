<div class="row">
    <aside class="column"/>
        <div class="side-nav">
            <?= $this->element('my/sidebar') ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="users view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= h($user->username) . '’s dashboard' ?></div>
            </div>
            <?= $this->element('my/user-summary') ?>
        </div>
        <div class="spacer"> </div>
        <div class="users view content">
            <h4>Go to...</h4>
            <p><?= $this->Html->link('Login and go to dashboard', '/users/home') ?></p>
            <p><?= $this->Html->link('Users', '/users') ?></p>
            <p><?= $this->Html->link('Ratteries', '/ratteries') ?></p>
            <p><?= $this->Html->link('Rats', '/rats') ?></p>
            <p><?= $this->Html->link('Litters', '/litters') ?></p>
            <p><?= $this->Html->link('Colors', '/colors') ?> (all physical traits: markings, coats, etc. work the same)</p>
            <p><?= $this->Html->link('Pending staff action', '/states/view/3') ?> (all objects needing staff action; change number to see sheets in other states, but avoid n°2, there are a lot of them)</p>
        </div>
        <div class="users view content">
            <h4>Available finders (copy and edit end of url to customize your search)</h4>
            <p>Rats:
                <ul>
                    <li>• By name or pup name: <?= $this->Html->link('https://artefact.kubrick.srfa.info/rats/named/super', '/rats/named/super') ?></li>
                    <li>• By owner username: <?= $this->Html->link('https://artefact.kubrick.srfa.info/rats/owned-by/arte', '/rats/owned-by/arte') ?></li>
                    <li>• By rattery name or prefix: <?= $this->Html->link('https://artefact.kubrick.srfa.info/rats/from-rattery/del', '/rats/from-rattery/del') ?></li>
                    <li>• Born before some date: <?= $this->Html->link('https://artefact.kubrick.srfa.info/rats/born-before/2000-01-01', '/rats/born-before/2000-01-01') ?></li>
                    <li>• Born after some date: <?= $this->Html->link('https://artefact.kubrick.srfa.info/rats/born-after/2020-01-01', '/rats/born-after/2020-01-01') ?></li>
                </ul>
            </p>
            <p>Ratteries:
                <ul>
                    <li>• By name or prefix: <?= $this->Html->link('https://artefact.kubrick.srfa.info/ratteries/named/aa', '/ratteries/named/aa') ?></li>
                    <li>• By owner username: <?= $this->Html->link('https://artefact.kubrick.srfa.info/ratteries/owned-by/ee', '/ratteries/owned-by/ee') ?></li>
                </ul>
            </p>
        </div>
        <div class="users view content">
            <h4>Some other available functions</h4>
            <p> Attention, en mode debug les fonctions notées avec une * n'envoient pas "vraiment" les mails, ce qui fait pour l'instant bugguer ces fonctions (mais elles marchent quand on fait vraiment envoyer un mail.) </p>
            <p> Pour accéder aux liens générés et tester la fonction jusqu'au bout, depuis la page d'erreur il faut appuyer sur le gateau en bas à droite, puis sur l'onglet "mail" pour voir le mail qui serait envoyé en environnement de production, copier le lien et l'ouvrir dans une autre page.</p>
            <p><ul>
                <li>• <?= $this->Html->link('*Register', '/users/register') ?></li>
                <li>• <?= $this->Html->link('*Reset Password', '/users/lost-password') ?></li>
                <li>• <?= $this->Html->link('Register Rattery', '/ratteries/register') ?></li>
            </ul></p>
        </div>
        <div class="spacer"> </div>
        <div class="users view content">
            <div class="related">
                <?= $this->element('my/messages') ?>
            </div>
        </div>
        <div class="spacer"> </div>
        <div class="users view content">
            <div class="related">
                <?= $this->element('my/statistics') ?>
            </div>
        </div>
    </div>
</div>
