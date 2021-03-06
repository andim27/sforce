<?php
define('PATH_STATE','log/');
//$action=$_GET['action'];

//----------------------------- add slide token ---------------------------------------------
if ((isset($_GET['action']))&&($_GET['action']=='tk-add')) {
  if ((isset($_GET['org_id']))&&(isset($_GET['app_id']))) {
        $org_id=$_GET['org_id'];
        $app_id=$_GET['app_id'];
        require_once "sftk.php";
        $cur_token="0";
        $az_store= new AzureStore();
        try {
            $cur_token = $az_store->addSlideToken($org_id,$app_id);
        } catch (Exception $e) {
            $cur_token="-2";
            error_log(__FILE__.' ->token->'.$e->getMessage());
        }
        echo $cur_token;
        exit;
  }
  echo "error org_id,app_id...";
  exit;
}
//----------------------------- add org token ---------------------------------------------
if ((isset($_GET['action']))&&($_GET['action']=='tk-org-add')) {
  if ((isset($_GET['org_id']))) {
        $org_id=$_GET['org_id'];
        require_once "sftk.php";
        $cur_token="0";
        $az_store= new AzureStore();
        try {
            $cur_token = $az_store->addOrgToken($org_id);
        } catch (Exception $e) {
            $cur_token="-2";
            error_log(__FILE__.' ->token->'.$e->getMessage());
        }
        echo $cur_token;
        exit;
  }
  echo "error org_id...";
  exit;
}
//----------------------------- out org token   ---------------------------------------------
if ((isset($_GET['action']))&&($_GET['action']=='tk-org')) {
    if ((isset($_GET['org_id']))) {
        $org_id=$_GET['org_id'];
        require_once "sftk.php";
        $cur_token="0";
        $az_store= new AzureStore();
        try {
            $cur_token = $az_store->getOrgToken($org_id);
        } catch (Exception $e) {
            $cur_token="-2";
            error_log(__FILE__.' ->token->'.$e->getMessage());
        }
        echo $cur_token;
        exit;
   }
}
//----------------------------- out slide token ---------------------------------------------
if ((isset($_GET['action']))&&($_GET['action']=='tk')) {
  if ((isset($_GET['org_id']))&&(isset($_GET['app_id']))) {
        $org_id=$_GET['org_id'];
        $app_id=$_GET['app_id'];
        require_once "sftk.php";
        $cur_token="0";
        $az_store= new AzureStore();
        try {
            $cur_token = $az_store->getSlideToken($org_id,$app_id);
        } catch (Exception $e) {
            $cur_token="-2";
            error_log(__FILE__.' ->token->'.$e->getMessage());
        }
        echo $cur_token;
        exit;
   }
   echo "error org_id,app_id...";
   exit;
}
//------------------------------ out state --------------------------------------------
try {
    $filename_arr = glob(PATH_STATE."state_ppt.*",GLOB_NOSORT);
    $res=file_get_contents(getcwd().'/'.$filename_arr[0]);
} catch (Exception $e){
    $error_mes=$e->getMessage();
    error_log(__FILE__.' ->state_ppt->'.$error_mes);
    $res=json_encode(array('state'=>'error','job'=>'state-ppt-read','mes'=>$error_mes,'time'=>date("d/m/H/i/s")));
}
echo $res;
?>