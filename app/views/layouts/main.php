<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <h1><?= $title; ?></h1>
      <?= $content; ?>
      <div class="card">
        <div class="card-body">
          <code>
            <?
              debug(\vendor\core\Db::$countSql);
              debug(\vendor\core\Db::$queries);
            ?>
          </code>
        </div>
      </div>
    </div>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>