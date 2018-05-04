<?= $renderer->render('header') ?>

<h1> Every characters </h1>

<ul>
    <li><a href="<?=$router->generateUri('character.show', ['name' => 'ichigo', 'id' => 123]);?>"> Ichigo </a></li>
</ul>
<?= $renderer->render('footer') ?>
