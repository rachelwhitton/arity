<?php

if (empty($data['url'])) {
    return false;
}

// Default Class
$data['classes'][] = 'button';

// If external link, force external icon (will override download icon)
if (!empty($data['icon']) && !empty($data['target']) && $data['target'] == '_blank') {
  $data['icon'] = 'external';
}

if (empty($data['analytics'])){
  $data['analytics'] ='';
}

if(!empty($data['icon'])) {
  $data['classes'][] = 'has-icon--';
}

return $data;
