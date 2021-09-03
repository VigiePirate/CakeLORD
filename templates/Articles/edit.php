<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $article->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $article->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Articles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="articles form content">
            <?= $this->Form->create($article) ?>
            <fieldset>
                <legend><?= __('Edit Article') ?></legend>
                <?php
                    echo $this->Form->control('category');
                    echo $this->Form->control('title');
                    echo $this->Form->control('subtitle');
                ?>
                <label for="content"><?= __('Content') ?></label>
                <?php
                    echo $this->Form->control('content', [
                        'type'=> 'hidden',
                        'id' => 'editor',
                        'name' => 'content']);
                ?>
                <div id="editor-container">
                    <?= $article->content ?>
                </div>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<!-- Include the Quill library & stylesheet -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<!-- Initialize Quill editor -->
<script>
    var quill = new Quill('#editor-container', {
    modules: {
      toolbar: [
        ['bold', 'italic'],
        ['link', 'blockquote', 'code-block', 'image'],
        [{ list: 'ordered' }, { list: 'bullet' }]
      ]
    },
    placeholder: 'Type text here...',
    theme: 'snow'
    });

    var form = document.querySelector('content');
    form.onsubmit = function() {
    // Populate hidden form on submit
    var about = document.querySelector('input[name=content]');
    about.value = JSON.stringify(quill.getContents());

    console.log("Submitted", $(form).serialize(), $(form).serializeArray());

    // No back end to actually submit to!
    alert('Open the console to see the submit data!')
    return false;
    };
</script>
