<?php
require_once("inc/functions.php");
$shop = "mymoodlecourse";
$token = "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";
$products_arr = shopify_call($token, $shop, "/admin/products.json", array(), 'GET');
// Convert product JSON information into an array
$products_arr = json_decode($products_arr['response'], TRUE);
// Get the ID of the first product
// $product_id = $products['products'][0]['id'];
$product_data=[];
if(isset($_POST['sync_course']))
{
  
  $moodel_params= array(
    'wstoken' => '49d636e047583000bd60cc81bb96166e',
    'wsfunction' => 'core_course_get_courses',
    'moodlewsrestformat' => 'json',
);
$url = $_POST['moodleurl'] . http_build_query($moodel_params);

$response = file_get_contents($url);
  $courses = json_decode($response,true);
  if ( ! empty( $courses ) ){

    foreach ( $courses as $course ) {
              if ( $course[ 'format' ] == 'site' ) {
                  continue;
              }
              $product_data=[ 
                "product"=>[
                  "title"=>$course[ 'fullname' ],
                  "body_html"=>$course[ 'summary' ],
                  "vendor" => "moodle demo site",
                  "product_type" => "course",
                  "status" => "draft",
                  "metafields" => [
                          [
                            "namespace" => "Moodle Course Id",
                            "key" => "course_id",
                            "value" => $course[ 'id' ],
                            'value_type' => 'string'
                          ]
                  ]
                ]
              ];
              if(checkMoodlecourseIdExitOrNot($products_arr['products'],$course[ 'id' ],$shop,$token))
              {
                $modified_product = shopify_call($token, $shop, "/admin/products.json", $product_data, 'POST');
              }
              
              
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap 4 Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
  <div class="row mt-4 mb-4">
    <div class="col-md-12">
          <h5 class="text-center underline">Moodle To Shopify</h5>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 text-center">
      <form action="" method="post">
        <input type="hidden" name="moodleurl" value="http://dev.moodle35.com/webservice/rest/server.php?">
        <button class="btn btn-primary" type="submit" name="sync_course">Sync Course To Shopify</button>
      </form>
    </div>
  </div>

  <div class="row mt-4">
      <div class="col-md-12">
        <div class="card">
            <div class="card-body">
              <h5 class="text-center">Shopify Product</h5>
              <table class="table mt-2 table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="text-center" scope="col">S.No.</th>
                    <th class="text-center" scope="col">Product Name</th>
                    <th class="text-center" scope="col">Moodle Course Id</th>
                    <th class="text-center" scope="col">Sync Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $products_arr = shopify_call($token, $shop, "/admin/products.json", array(), 'GET');
                    // Convert product JSON information into an array
                    $products_arr = json_decode($products_arr['response'], TRUE);
                    // echo "<pre>";
                    // print_r($products_arr);
                    // echo "</pre>";
                    // exit;
                      if(!empty($products_arr['products']))
                      {
                        $i=1;
                        foreach($products_arr['products'] as $products)
                        {
                          $products_meta = shopify_call($token, $shop, "/admin/products/".$products['id']."/metafields.json");
			                    $products_meta = json_decode($products_meta['response'], TRUE);
                  ?>
                  <tr>
                    <td class="text-center"><?php echo $i++;?></td>
                    <td class="text-center"><?php echo $products['title']?></td>
                    <td class="text-center"><?php echo $products_meta["metafields"][0]["value"]?></td>
                    <td class="text-center"><?php echo date('Y-m-d h:i',strtotime($products['created_at']));?></td>
                  </tr>
                  <?php
                      }}
                      else{
                        echo'<tr><td class="text-center" colspan="4"> No Records</td></tr>';
                      }
                  ?>
                </tbody>
              </table>
            </div>
        </div>
      </div>
  </div>
  
</div>

</body>
</html>