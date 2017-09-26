<?php
namespace App\Theme;

/*
  Template Name:      In-Page Navigation
  Template Type:      Component
  Description:        In Page "dot" navigation with scroll
  Last Updated:       08/02/2017
  Since:              1.0.0
*/

?>

<nav id="page-menu" class="in-page-nav" role="navigation">
  <ul class="in-page-nav__list navlist">
    <li class="navlist__item--vertical navlist__item--title">Menu</li>

    <?php $i=0; foreach ($data['links'] as $link) : $i++; ?>
      <li class="navlist__item--vertical in-page-nav__item">
        <a class="in-page-nav__link <?= $link['id']; ?>--<?php if ($i=='1') : ?> is-selected<?php endif; ?>"
          data-menutarget="<?= $link['id']; ?>--"
          id="in-page-nav__link___<?= $link['id']; ?>--"
          href="#<?= $link['id']; ?>"
          aria-selected="false"
        ><?= $link['label']; ?></a>
      </li>
    <?php endforeach; ?>
  </ul>
</nav>
