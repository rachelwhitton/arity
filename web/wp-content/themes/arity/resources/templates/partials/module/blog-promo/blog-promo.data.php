<?php
  foreach ($data['posts'] as $item) {
    $category_name = yoast_get_primary_term('category', $item);
    $item->primary_term = $category_name;

    $abstract = get_field('abstract', $item);
    $item->abstract = $abstract;
  }

  return $data;
