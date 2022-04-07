<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category[] $categories
 */
$this->assign('title', 'Liste des categories');
$this->setLayout('blog');
?>
<h1 class="d-flex justify-content-between">
  <span><?= $this->fetch('title') ?></span>
  <div>
  <a href="<?= $this->Url->build(['_name' => 'categories:add']) ?>" class="btn btn-sm btn-primary">Nouveau</a>
  </div>
</h1>

<table class="table mt-4">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Description</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($categories as $category) : ?>
      <tr>
        <td><?= $category->name ?></td>
        <td><?= $category->description ?></td>
        <td>
          <a href="<?= $this->Url->build(['_name' => 'categories:edit', 'id' => $category->id]) ?>" class="btn btn-sm btn-primary">Editer</a>

          <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id), "class" => "btn btn-danger btn-sm"]) ?>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>