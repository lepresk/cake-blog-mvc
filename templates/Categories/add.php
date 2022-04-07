<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
$this->assign('title', 'Nouvelle catégorie');
$this->setLayout('blog');
?>

<?= $this->Form->create($category) ?>
  <div class="mb-3">
    <?= $this->Form->control('name', ['label' => ['text' => 'Nom', 'class' => 'control-label'], 'class' => 'form-control']) ?>
  </div>

  <div class="mb-3">
    <?= $this->Form->control('description', ['label' => ['text' => 'Description', 'class' => 'control-label'], 'class' => 'form-control']) ?>
  </div>

  <button type="submit" class="btn btn-primary">Enregistrer</button>
<?= $this->Form->end() ?>