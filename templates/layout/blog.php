<?php

/**
 * @var \App\View\AppView $this
 */


?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog MVC | <?= $this->fetch('title') ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Blog MVC</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= $this->Url->build(['_name' => 'posts:index']) ?>">Articles</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= $this->Url->build(['_name' => 'categories:index']) ?>">Categories</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container pt-4">
    <?= $this->Flash->render() ?>

    <?= $this->fetch('content') ?>
  </div>
</body>

</html>