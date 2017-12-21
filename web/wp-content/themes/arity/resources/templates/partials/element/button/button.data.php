<?php

if (empty($data['url'])) {
    return false;
}

// Default Class
$data['classes'][] = 'button';

// If external link, add external icon
if (!empty($data['target']) && $data['target'] == '_blank') {
  $data['icon'] = 'external';
}

if(!empty($data['icon'])) {
  $data['classes'][] = 'has-icon--';
}

return $data;
