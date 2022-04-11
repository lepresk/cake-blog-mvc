<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post[] $posts
 */
$this->setLayout('blog');
$this->assign('title', 'Liste des articles');
?>
<h1 class="d-flex justify-content-between">
  <span><?= $this->fetch('title') ?></span>
  <div>
  <a href="<?= $this->Url->build(['action' => 'add']) ?>" class="btn btn-sm btn-primary">Nouveau</a>
  </div>
</h1>

<table class="table mt-4">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Image</th>
      <th>Catégorie</th>
      <th>Contenu</th>
      <th>Date de création</th>
      <th>Date de modification</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($posts as $post) : ?>
      <tr>
        <td><?= $post->name ?></td>
        <td><?= $this->Html->image($post->image, ['class' => "img-fluid w-50", "alt" => "alt de test"]) ?></td>
        <td><?= $post->category->name ?></td>
        <td><?= $this->Text->truncate($post->content, 50) ?></td>
        <td><?= $post->created ?></td>
        <td><?= $post->modified ?></td>
        <td>
          
          <a href="<?= $this->Url->build(['_name' => 'posts:edit', 'id' => $post->id]) ?>" class="btn btn-sm btn-primary">Editer</a>

          <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $post->id], ['confirm' => __('Are you sure you want to delete # {0}?', $post->id), "class" => "btn btn-danger btn-sm"]) ?>
        
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>