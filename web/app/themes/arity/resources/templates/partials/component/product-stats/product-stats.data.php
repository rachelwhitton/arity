<?php

// Make sure stats isn't empty
if (empty($data['stats'])) {
  return false;
}

// Loop through each value
foreach ($data['stats'] as $key => $stat) {
  // Stat value is required
  if (empty($stat['value'])) {
    unset($data['stats'][$key]);
    return;
  }

  // replace '.' in value for element ID
  $data['stats'][$key]['value_id'] = str_replace(".", "_", $stat['value']);

  // Determine how many decimals the value has
  $decimals = explode('.', $stat['value']);
  $decimals = !empty($decimals[1]) ? strlen($decimals[1]) : 0;
  $data['stats'][$key]['value_decimals'] = strval($decimals);
}

// Again make sure stats isn't empty
if (empty($data['stats'])) {
  return false;
}

return $data;
