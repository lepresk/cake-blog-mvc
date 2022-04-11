<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post $post
 */
$this->assign('title', 'Editer un article');
$this->setLayout('blog');
?>

<?= $this->Form->create($post, ['type' => 'file']) ?>
  <div class="mb-3">
    <?= $this->Form->control('name', ['label' => ['text' => 'Nom', 'class' => 'control-label'], 'class' => 'form-control']) ?>
  </div>

  <div class="mb-3">
    <?= $this->Form->control('change_file', ['label' => ['text' => 'Image', 'class' => 'control-label'], 'type' => 'file', 'class' => 'form-control']) ?>
  </div>

  <div class="mb-3">
    <?= $this->Form->control('content', ['label' => ['text' => 'Contenu', 'class' => 'control-label'], 'class' => 'form-control']) ?>
  </div>

  <div class="mb-3">
    <?= $this->Form->control('category_id', ['label' => ['text' => 'Catégorie', 'class' => 'control-label'], 'class' => 'form-control']) ?>
  </div>

  <button type="submit" class="btn btn-primary">Enregistrer</button>
<?= $this->Form->end() ?>