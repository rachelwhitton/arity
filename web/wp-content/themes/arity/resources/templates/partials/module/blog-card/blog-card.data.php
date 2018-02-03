<?php
//
// global $acf_blog_category;
//
// if(!empty($data['headline'])) {
//   $data['nice_category'] = $acf_blog_category[$data['term']];
// } else if(!empty($data['term'])) {
//     $num_posts = 3;
//
//     if(!empty($data['num_posts'])) {
//       if($data['num_posts'] === -1) {
//         $num_posts = -1;
//       } else {
//         $num_posts = 3;
//       }
//     }
//
//     if(empty($data['taxonomy'])) {
//       $template_slug = get_page_template_slug();
//
//       if ($template_slug === "t5-industry-detail") {
//         $data['taxonomy'] = 'industry';
//       } else {
//         $data['taxonomy'] = 'category';
//       }
//     }
//
//
//     $args = array(
//         'numberposts' => $num_posts,
//         'tax_query' => array(
//           array(
//             'taxonomy' => $data['taxonomy'],
//             'field' => 'slug',
//             'terms' => $data['term'] // Where term_id of Term 1 is "1".
//           )
//         )
// 		);
//
//     $post_array = get_posts($args);
//     $data['posts'] = $post_array;
//     $data['bg_class'] = '';
//     $data['nice_category'] = $acf_blog_category[$data['term']];
//   } else {
//     $data['term'] = null;
//     $data['bg_class'] = 'colors__bg--black bg-dark--';
//   }
  foreach ($data['posts'] as $item) {
    $category_name = yoast_get_primary_term('category', $item);
    $item->primary_term = $category_name;
  }


  //var_dump($data['posts']);
  //var_dump($data);


  return $data;
