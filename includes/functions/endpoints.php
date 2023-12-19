<?php
function custom_api_endpoint_callback()
{
  $response = array(
    'status' => 'success',
    'message' => 'Custom API endpoint works!',
  );

  wp_send_json($response);
}

// function custom_post_api_endpoint_callback(WP_REST_Request $request)
// {
//   // Retrieve data from the request
//   $data = $request->get_json_params();

//   // Perform any necessary processing on $data

//   $response = array(
//     'status' => 'success',
//     'message' => 'Custom POST API endpoint works!',
//     'data' => $data, // You can send back data received in the request
//   );

//   return rest_ensure_response($response);
// }

function create_plugin_endpoints()
{
  $endpoints = [
    [
      "path" => '/endpoint/',
      "methods" => 'GET',
      "callback" => 'custom_api_endpoint_callback',
      "permission_callback" => '__return_true', // Allow any user to access this endpoint (customize as needed)
    ]
  ];

  foreach ($endpoints as $endpoint) {
    register_rest_route('custom/v1', $endpoint['path'], array(
      'methods' => $endpoint['methods'],
      'callback' => $endpoint['callback'],
      'permission_callback' => $endpoint['permission_callback'],
    ));
  }
}
add_action('rest_api_init', 'create_plugin_endpoints');
