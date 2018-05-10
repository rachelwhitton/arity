<?php

$data['classes'][] = 'highlight-block';

if(!empty($data['subhead']) && !empty($data['cta'])) {
  $data['cta']['analytics'] = $data['subhead'];
}

return $data;
