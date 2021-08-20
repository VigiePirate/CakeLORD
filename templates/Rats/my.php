<div class="row">
    <aside class="column"/>
        <div class="side-nav">
            <?= $this->element('my/sidebar') ?>
        </div>
    </aside>

    <div class="column-responsive column-90">

        <div class="tab-wrapper">
            <input class="radio" id="one" name="group" type="radio" checked>
            <input class="radio" id="two" name="group" type="radio">
            <input class="radio" id="three" name="group" type="radio">
            <div class="tabs">
                <label class="tab" id="one-tab" for="one">CSS</label>
                <label class="tab" id="two-tab" for="two">Skills</label>
                <label class="tab" id="three-tab" for="three">Prerequisites</label>
            </div>
            <div class="panels">
                <div class="panel" id="one-panel">
                    <div class="users view content">
                        <div class="panel-title">Why Learn CSS?</div>
                        <p>Without CSS, every web page would be drab plain text and images that flowed straight down the page. With CSS, you can add color and background images and change the layout of your page — your web pages can feel like works of art!</p>
                    </div>
                </div>
                <div class="panel" id="two-panel">
                    <div class="panel-title">Take-Away Skills</div>
                    <p>You will learn many aspects of styling web pages! You’ll be able to set up the correct file structure, edit text and colors, and create attractive layouts. With these skills, you’ll be able to customize the appearance of your web pages to suit your every need!</p>
                </div>
                <div class="panel" id="three-panel">
                    <div class="panel-title">Note on Prerequisites</div>
                    <p>We recommend that you complete Learn HTML before learning CSS.</p>
                </div>
            </div>
        </div>

        <div class="users view content">
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
