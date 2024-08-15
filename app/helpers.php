<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\User;
use App\Models\PanelNotifications;
use App\Models\Task;
use App\Models\Country;
use App\Models\Orders;
use App\Models\Tax;
use App\Models\DeliveryPrice;
use App\Models\Language;
use App\Models\Notification;
use App\Models\NotificationLang;
use App\Models\PanelNotificationLang;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;


if (!function_exists('file_checker')) {
    function file_checker($file, $type = null)
    {
        if (isset($file) && !empty($file) && file_exists(base_path() . '/' . $file)) {
            $images = url($file);
        } else {
            $images = url('public/img/' . $type . '.png');
        }
        return $images;
    }
}
if (!function_exists('notificationUserType')) {

    function notificationUserType()
    {
        $data = array('All' => '1', 'User' => '2', "Celebrity" => '3');
        return $data;
    }
}

if (!function_exists('notificationType')) {

    function notificationType()
    {
        $data = array('Email' => '1', 'SMS' => '2', "PushNotification" => '3', 'All' => '4');
        return $data;
    }
}

function calculateDimensions($width, $height, $maxwidth, $maxheight)
{

    if ($width != $height) {
        if ($width > $height) {
            $t_width = $maxwidth;
            $t_height = (($t_width * $height) / $width);
            //fix height
            if ($t_height > $maxheight) {
                $t_height = $maxheight;
                $t_width = (($width * $t_height) / $height);
            }
        } else {
            $t_height = $maxheight;
            $t_width = (($width * $t_height) / $height);
            //fix width
            if ($t_width > $maxwidth) {
                $t_width = $maxwidth;
                $t_height = (($t_width * $height) / $width);
            }
        }
    } else
        $t_width = $t_height = min($maxheight, $maxwidth);

    return array('height' => (int) $t_height, 'width' => (int) $t_width);
}
if (!function_exists('image_upload')) {
    function image_upload($file, $pathName, $multipalImageName = null)
    {
        $path = public_path() . '/uploads/' . $pathName . '/';
        $newFolder = strtoupper(date('M') . date('Y')) . '/';
        $folderPath = $path . $newFolder;
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, $mode = 0777, true);
        }
        $imgsize = getimagesize($file);
        $width = $imgsize[0];
        $height = $imgsize[1];
        $imgre = calculateDimensions($width, $height, 450, 450);
        $image = $file;
        $extension = $image->getClientOriginalExtension();
        //$orignalname = $file->getClientOriginalName();       
        if ($multipalImageName == null) {
            $fileName = time() . '-' . $pathName . '.' . $extension;
        } else {
            $fileName = time() . '-' . $pathName . '-' . $multipalImageName . '.' . $extension;
        }


        if (in_array($extension, ['jpeg', 'jpg', 'JPG', 'JPEG', 'png', 'PNG', 'gif', 'GIF'])) {
            $image->move($folderPath, $fileName);
            return array(true, $newFolder . $fileName, $extension, $fileName);
        } else {
            return array(false, "file should be in jpeg, jpg,png,gif format / double extension not allow.", '');
        }
    }
}

function file_upload($file, $pathName, $multipalImageName = null)
{
    $path =  public_path('storage') . '/' . $pathName . '/';
   
   
    $folderPath         =   $path;
    
    $image = $file;
    
    $extension = $image->getClientOriginalExtension();
    //dd($extension);
    if ($multipalImageName == null) {
        $fileName = time() . '-' . $pathName . '.' . $extension;
    } else {
        $fileName = time() . '-' . $pathName . '-' . $multipalImageName . '.' . $extension;
    }

    $savePath  = 'storage/user/';
  
    if (in_array($extension, ['pdf','doc','jpeg', 'jpg', 'JPG', 'JPEG', 'png', 'PNG'])) {
        $image->move($folderPath, $fileName);
        return array(true,  $savePath . $fileName, $extension, $fileName);
    } else {
        return array(false, "file should be in pdf, doc,docx,jpeg,jpg,JPG,JPEG,png,PNG format / double extension not allow.", '');
    }
}

function file_upload1($file, $pathName, $multipalImageName = null)
{
    $path =  public_path('storage') . '/' . $pathName . '/';
   
   
    $folderPath         =   $path;
    
    $image = $file;
    
    $extension = $image->getClientOriginalExtension();
    //dd($extension);
    if ($multipalImageName == null) {
        $fileName = time() . '-' . $pathName . '.' . $extension;
    } else {
        $fileName = time() . '-' . $pathName . '-' . $multipalImageName . '.' . $extension;
    }

    $savePath  = 'storage/adhar/';
  
    if (in_array($extension, ['pdf','doc','jpeg', 'jpg', 'JPG', 'JPEG', 'png', 'PNG'])) {
        $image->move($folderPath, $fileName);
        return array(true,  $savePath . $fileName, $extension, $fileName);
    } else {
        return array(false, "file should be in pdf, doc,docx,jpeg,jpg,JPG,JPEG,png,PNG format / double extension not allow.", '');
    }
}

function file_upload2($file, $pathName, $multipalImageName = null)
{
    $path =  public_path('storage') . '/' . $pathName . '/';
   
   
    $folderPath         =   $path;
    
    $image = $file;
    
    $extension = $image->getClientOriginalExtension();
    //dd($extension);
    if ($multipalImageName == null) {
        $fileName = time() . '-' . $pathName . '.' . $extension;
    } else {
        $fileName = time() . '-' . $pathName . '-' . $multipalImageName . '.' . $extension;
    }

    $savePath  = 'storage/pancard/';
  
    if (in_array($extension, ['pdf','doc','jpeg', 'jpg', 'JPG', 'JPEG', 'png', 'PNG'])) {
        $image->move($folderPath, $fileName);
        return array(true,  $savePath . $fileName, $extension, $fileName);
    } else {
        return array(false, "file should be in pdf, doc,docx,jpeg,jpg,JPG,JPEG,png,PNG format / double extension not allow.", '');
    }
}

function send_notification_add($form_id, $user_type = 0, $notification_type = null, $notification_for = null, $order_id = null, $title = null, $message = null)
{
    $lang = App::getLocale();
   
     App::SetLocale('en');
    $lang = App::getLocale();

    $notification_title = __('api.notification_court_book_title');
    $message_lang = __('api.'.$message);
    $title_lang = __('api.'.$title);

    $notificationData = new Notification();
    $notificationData->user_id = $form_id;
    $notificationData->user_type = $user_type;
    $notificationData->notification_type = $notification_type;
    $notificationData->notification_for = $notification_for;
    $notificationData->order_id = $order_id;
    $notificationData->title = $title_lang;
    $notificationData->message = $message_lang;
    $notificationData->lang = $lang;
    $notificationData->save();
    // insert notification lang data
    if(isset($notificationData)){
     $notificationLang = new NotificationLang();
     $notificationLang->notification_id = $notificationData->id;
     $notificationLang->title = $title_lang;
     $notificationLang->message = $message_lang;
     $notificationLang->lang = $lang;
     $notificationLang->save();
        // insert AR lang
          App::SetLocale('ar');
        $lang = App::getLocale();
        $message_lang = __('api.'.$message);
        $title_lang = __('api.'.$title);
     $notificationLang = new NotificationLang();
     $notificationLang->notification_id = $notificationData->id;
     $notificationLang->title = $title_lang;
     $notificationLang->message = $message_lang;
     $notificationLang->lang = $lang;
     $notificationLang->save();
    }
}

function add_player_notification_by_admin($form_id, $user_type = 0, $notification_type = null, $notification_for = null, $order_id = null, $title = null, $message = null){
//   dd($form_id, $user_type, $notification_type, $notification_for, $order_id, $title, $message);
  $lang = Language::pluck('lang')->toArray();
//   dd($lang,$title,$message);
  foreach ($lang as $lang) {
      if ($lang == 'en') {
        $notificationData = new Notification();
        $notificationData->user_id = $form_id;
        $notificationData->user_type = $user_type;
        $notificationData->notification_type = $notification_type;
        $notificationData->notification_for = $notification_for;
        $notificationData->order_id = $order_id;
        $notificationData->title = $title[$lang];
        $notificationData->message = $message[$lang];
        $notificationData->lang = $lang;
        $notificationData->save();
      }
      $notificationLang = new NotificationLang();
      $notificationLang->notification_id = $notificationData->id;
      $notificationLang->title = $title[$lang];
      $notificationLang->message = $message[$lang];
      $notificationLang->lang = $lang;
      $notificationLang->save();
  }
}
function addNotificationByAdminForOwner($user_type = 1, $notification_type=1, $notification_for='admin_notification', $title, $message, $user_id , $order_id = 1){
    // dd($user_type = 1, $notification_type=1, $notification_for='admin_notification', $titles, $messages, $user_id , $order_id = 1);
    $lang = Language::pluck('lang')->toArray();
  foreach ($lang as $lang) {
      if ($lang == 'en') {
        $notificationData = new PanelNotifications();
        $notificationData->user_id = $user_id;
        $notificationData->user_type = $user_type;
        $notificationData->notification_type = $notification_type;
        $notificationData->notification_for = $notification_for;
        $notificationData->order_id = $order_id;
        $notificationData->title = $title[$lang];
        $notificationData->message = $message[$lang];
        $notificationData->save();
      }
        $notificationLang = new PanelNotificationLang();
        $notificationLang->panel_notification_id = $notificationData->id;
        $notificationLang->title = $title[$lang];
        $notificationLang->message = $message[$lang];
        $notificationLang->lang = $lang;
        $notificationLang->save();
  }
}

if (!function_exists('send_notification')) {
    function send_notification($form_id, $user_id = 0, $title = null, $body = array())
    {
        $arrNotification = array();
        $arrNotification["body"]  = $body;
        $arrNotification["title"] = $title;

        if (!$form_id) {
            $arrNotification["content-available"] = 1;
            $arrNotification["slient_notification"] = 'Yes';
        } else {
            $arrNotification["content-available"] = 0;
            $arrNotification["slient_notification"] = 'No';
        }
        $arrNotification["sound"] = "default";
        $arrNotification["type"] = 1;
        $user = User::where('id', $user_id)->with('devices')->first();

        if (isset($user->devices[0])) {
            foreach ($user->devices as $device) {
                $device_type = $device->device_type;
                if ($device_type != 'Android') {
                    $arrNotification["body"]  = $body['message'];
                } else {
                    $arrNotification["body"]  = $body['message'];
                }
                $user_id = $device->user_id;
                $device_id = $device->device_token;
                $result = push_notification($device_id, $arrNotification, $device_type, $form_id);
            }
        }
    }

    if (!function_exists('push_notification')) {
        function push_notification($registatoin_ids, $notification, $device_type, $form_id)
        {
            $url = 'https://fcm.googleapis.com/fcm/send';
            if ($device_type == "Android") {
                // dd('ddd',$device_type);
                $fields = array(
                    'to' => $registatoin_ids,
                    'notification' => $notification
                );
            } else {

                if (!$form_id) {
                    $fields = array(
                        'to' => $registatoin_ids,
                        'content-available' => 1,
                        'notification' => $notification
                    );
                } else {
                    $fields = array(
                        'to' => $registatoin_ids,
                        'notification' => $notification
                    );
                }
            }
            //Firebase API Key

            if ($device_type == 'Android') {
                $headers = array('Authorization:key=AAAA_bLVrM8:APA91bH5VpXcpOltqNjwRb8tqT4Cj1C4WTWHQ5PCOMLzhggebKhjCS91YV_nwVQEVhxurMPKFaSyMMqlAQD8pcmmquPGdaKhNBkWc80co0VYFW5EvNT6wx1x70cuvwLA8R_VQ61vjSjG', 'Content-Type:application/json');
            } else {
                $headers = array('Authorization:key=AAAA_bLVrM8:APA91bH5VpXcpOltqNjwRb8tqT4Cj1C4WTWHQ5PCOMLzhggebKhjCS91YV_nwVQEVhxurMPKFaSyMMqlAQD8pcmmquPGdaKhNBkWc80co0VYFW5EvNT6wx1x70cuvwLA8R_VQ61vjSjG', 'Content-Type:application/json');
            }

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            // dd($result);

            if ($result === false) {
                die('Curl failed: ' . curl_error($ch));
            }
            curl_close($ch);
        }
    }
}

function getNotificationList($user_id = null, $user_type = null)
{
    $notificationData = PanelNotifications::select('panel_notifications.*');
    $count = 0;

    if (isset($user_id)) {
        $count = PanelNotifications::where('panel_notifications.is_read', 0)->where('panel_notifications.user_id', $user_id)->count();
        $notificationData = $notificationData->where('panel_notifications.user_id', $user_id)->orderBy('panel_notifications.id', 'desc')->get();
        // dd($notificationData,'dd',$count);
        
    } else {
        $count = PanelNotifications::where('panel_notifications.is_read', 0)->count();
        $notificationData = $notificationData->orderBy('panel_notifications.id', 'desc')->get();
    }

    $data['count'] = $count;
    $data['notificationData'] = $notificationData;
    return $data;
}

function getNotificationPlayerList($user_id = null, $user_type = null)
{
    $notificationData =Notification::select('notifications.*');
    $count = 0;

    if ($user_id) {
        $count =Notification::where('notifications.is_read', 0)->where('notifications.user_id', $user_id)->count();
        $notificationData = $notificationData->where('notifications.user_id', $user_id)->orderBy('notifications.id', 'desc')->get();
    } else {
        $count =Notification::where('notifications.is_read', 0)->count();
        $notificationData = $notificationData->orderBy('notifications.id', 'desc')->get();
    }

    $data['count'] = $count;
    $data['notificationData'] = $notificationData;
    return $data;
}

function getSettingData($field)
{

    if ($field == 'ALL') {
        $settingData = DeliveryPrice::select('*')->first();
        return $settingData;
    } else {
        $settingData = DeliveryPrice::select($field)->first();
        return $settingData->$field;
    }
}

function getCountryTaxByLatLong($lat, $long)
{
    $geolocation = $lat . ',' . $long;
    $request = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $geolocation . '&sensor=false&libraries=places&key=AIzaSyAplPUk9niQdlpNdKgipVXUnrd6Nev5TX4';
    $file_contents = file_get_contents($request);
    $json_decode = json_decode($file_contents);

    // dd($json_decode->results[0]);

    if (isset($json_decode->results[0])) {
        $response = array();
        $responseShortName = array();
        foreach ($json_decode->results[0]->address_components as $addressComponet) {
            if (in_array('political', $addressComponet->types)) {
                $response[] = $addressComponet->long_name;
            }
            $responseShortName[] = $addressComponet->short_name;
        }

        if (isset($response[0])) {
            $first  =  $response[0];
        } else {
            $first  = 'null';
        }
        if (isset($response[1])) {
            $second =  $response[1];
        } else {
            $second = 'null';
        }
        if (isset($response[2])) {
            $third  =  $response[2];
        } else {
            $third  = 'null';
        }
        if (isset($response[3])) {
            $fourth =  $response[3];
        } else {
            $fourth = 'null';
        }
        if (isset($response[4])) {
            $fifth  =  $response[4];
        } else {
            $fifth  = 'null';
        }

        /*if( $first != 'null' && $second != 'null' && $third != 'null' && $fourth != 'null' && $fifth != 'null' ) {
            echo "<br/>Address:: ".$first;
            echo "<br/>City:: ".$second;
            echo "<br/>State:: ".$fourth;
            echo "<br/>Country:: ".$fifth;
        }
        else if ( $first != 'null' && $second != 'null' && $third != 'null' && $fourth != 'null' && $fifth == 'null'  ) {
            echo "<br/>Address:: ".$first;
            echo "<br/>City:: ".$second;
            echo "<br/>State:: ".$third;
            echo "<br/>Country:: ".$fourth;
        }
        else if ( $first != 'null' && $second != 'null' && $third != 'null' && $fourth == 'null' && $fifth == 'null' ) {
            echo "<br/>City:: ".$first;
            echo "<br/>State:: ".$second;
            echo "<br/>Country:: ".$third;
        }
        else if ( $first != 'null' && $second != 'null' && $third == 'null' && $fourth == 'null' && $fifth == 'null'  ) {
            echo "<br/>State:: ".$first;
            echo "<br/>Country:: ".$second;
        }
        else if ( $first != 'null' && $second == 'null' && $third == 'null' && $fourth == 'null' && $fifth == 'null'  ) {
            echo "<br/>Country:: ".$first;
        }*/

        // dd($responseShortName);

        if (isset($responseShortName[3]) && $responseShortName[3]) {
            $countryData = Country::where(['sortname' => $responseShortName[3]])->first();

            if ($countryData) {
                $taxData = Tax::where(['country_id' => $countryData->id])->first();

                if ($taxData) {
                    return $taxData->tax;
                } else {
                    return 1;
                }
            } else {
                return 1;
            }
        } else {
            return 1;
        }
    } else {
        return 1;
    }
}

function getCountryIdByLatLong($lat, $long)
{
    $geolocation = $lat . ',' . $long;
    $request = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $geolocation . '&sensor=false&libraries=places&key=AIzaSyAplPUk9niQdlpNdKgipVXUnrd6Nev5TX4';
    $file_contents = file_get_contents($request);
    $json_decode = json_decode($file_contents);
    $country = '';

    if (isset($json_decode->results[0])) {
        $response = array();
        $responseShortName = array();
        foreach ($json_decode->results[0]->address_components as $addressComponet) {
            if (in_array('political', $addressComponet->types)) {
                $response[] = $addressComponet->long_name;
            }
            $responseShortName[] = $addressComponet->short_name;
        }

        if (isset($response[0])) {
            $first  =  $response[0];
        } else {
            $first  = 'null';
        }
        if (isset($response[1])) {
            $second =  $response[1];
        } else {
            $second = 'null';
        }
        if (isset($response[2])) {
            $third  =  $response[2];
        } else {
            $third  = 'null';
        }
        if (isset($response[3])) {
            $fourth =  $response[3];
        } else {
            $fourth = 'null';
        }
        if (isset($response[4])) {
            $fifth  =  $response[4];
        } else {
            $fifth  = 'null';
        }

        if ($first != 'null' && $second != 'null' && $third != 'null' && $fourth != 'null' && $fifth != 'null') {
            $country = $fifth;
        } else if ($first != 'null' && $second != 'null' && $third != 'null' && $fourth != 'null' && $fifth == 'null') {
            $country = $fourth;
        } else if ($first != 'null' && $second != 'null' && $third != 'null' && $fourth == 'null' && $fifth == 'null') {
            $country = $third;
        } else if ($first != 'null' && $second != 'null' && $third == 'null' && $fourth == 'null' && $fifth == 'null') {
            $country = $second;
        } else if ($first != 'null' && $second == 'null' && $third == 'null' && $fourth == 'null' && $fifth == 'null') {
            $country = $first;
        }

        if (isset($country) && $country) {
            $countryData = Country::where(['name' => $country])->first();

            if ($countryData) {
                return $countryData->id;
            } else {
                return '';
            }
        } else {
            return '';
        }
    } else {
        return '';
    }
}

function switchAccount($userId)
{
    auth()->logout();
    $user = User::find($userId);
    Auth::login($user);
}

function encryptPass($password)
{
    $sSalt = '20adeb83e85f03cfc84d0fb7e5f4d290';
    $sSalt = substr(hash('sha256', $sSalt, true), 0, 32);
    $method = 'aes-256-cbc';

    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

    $encrypted = base64_encode(openssl_encrypt($password, $method, $sSalt, OPENSSL_RAW_DATA, $iv));
    return $encrypted;
}

function decryptPass($password)
{
    $sSalt = '20adeb83e85f03cfc84d0fb7e5f4d290';
    $sSalt = substr(hash('sha256', $sSalt, true), 0, 32);
    $method = 'aes-256-cbc';

    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

    $decrypted = openssl_decrypt(base64_decode($password), $method, $sSalt, OPENSSL_RAW_DATA, $iv);
    return $decrypted;
}

function CallbackApis($url, $type)
{

    if ($type == 'Register') {
        $header = array();
    } else {
        $header = array();
    }

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => $header,
    ));
    $response = curl_exec($curl);
    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    // echo $response;

    if ($httpcode == 200) {
        return  json_decode($response);
    } else if ($httpcode == 401) {
        return  array('staus' => false, 'message' => 'unauthorized');
    }
}


function commonAuthUserId()
{
    $request = app('request');
    return $secret_key = explode('|~@#|', decryptPass($request->header('SECRET-KEY')));
}

function ApiCurlMethod($method, $parms, $type, $method_type = 'POST')
{
    $locale = App::getLocale();

    $currency = Session::get('currentCurrency') ?? 'OAR';
    if ($type == 'Normal') {
        $header = array(
            'Accept:application/json',
            'currency:' . $currency,
            'Accept-Language:' . $locale
        );
    } else {
        $userData =  Session::get('AuthUserData') ?? null;
        $access_token = $userData->token ?? null;
        // dd($userData);

        // dd($access_token);  
        $header = array(
            'Accept:application/json',
            'Authorization:Bearer ' . $access_token,
            'currency:' . $currency,
            'Accept-Language:' . $locale
        );
    }


    // print_r($header);die;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => url('api/auth/') . '/' . $method,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 30,
        CURLOPT_TIMEOUT => 300,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method_type,
        CURLOPT_POSTFIELDS => $parms,
        CURLOPT_HTTPHEADER => $header,
    ));

    $response = curl_exec($curl);

    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    curl_close($curl);
    // echo "<pre>";
    // print_r($response);
    // die;
    // dd($response);
    if ($httpcode == 200) {

        return  json_decode($response);
    } else if ($httpcode == 401) {
        //dd($method,0401);
        Session::forget('AuthUserData');
        Session::forget('AuthUserData');
        //  dd(json_decode($response));
    } else if ($httpcode == 402) {
        dd($method, 0402);
        // Session::forget('AuthUserData');
        // Session::forget('AuthUserData');
        //  dd(json_decode($response));

    } else if ($httpcode == 404) {
        dd($method, 0404);
        //Session::forget('AuthUserData');
        //Session::forget('AuthUserData');
        //      dd($method);
        // dd(json_decode($response));
    } else if ($httpcode == 500) {
        dd($response, 500);
        //Session::forget('AuthUserData');
        // Session::forget('AuthUserData');
        //  dd(json_decode($response));
    }
}
function send_admin_notification($message='',$title='',$channel_name=''){
    // dd('dddddddddd');
    //Admin Notification//
		$publishKey ='pub-c-d7274ea7-836f-4faf-b396-bc4bc9e9f99e';
		$subscribeKey= 'sub-c-560305a8-8b03-11eb-83e5-b62f35940104';
	
		$curl_admin = curl_init();
		curl_setopt_array($curl_admin, array(
		  CURLOPT_URL => "https://ps.pndsn.com/publish/$publishKey/$subscribeKey/0/$channel_name/myCallback?store=0&uuid=db9c5e39-7c95-40f5-8d71-125765b6f561",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "{\n  \"message\": \"$message\", \"title\": \"$title\"}\n",
		  CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"content-type: application/json",
			"location: /publish/$publishKey/$subscribeKey/0/pubnub_onboarding_channel_admin_1/0",
			"postman-token: d536d8da-8709-14cb-3c6d-ee6e19bc9fe5"
		  ),
		));

		$responseNew = curl_exec($curl_admin);
		$err = curl_error($curl_admin);

		curl_close($curl_admin);

		if ($err) {
		//   echo "cURL Error #:" . $err;
		} else {
		//   echo $responseNew;
		}
		//Admin Notification End//
}
function add_admin_notification($user_type = '', $notification_type='', $notification_for='', $title='', $message='', $user_id='', $order_id=''){
    $lang = App::getLocale();
   
     App::SetLocale('en');
    $lang = App::getLocale();

    // $notification_title = __('api.notification_court_book_title');
    $message_lang = __('backend.'.$message);
    $title_lang = __('backend.'.$title);

    $notificationData = new PanelNotifications();
    $notificationData->user_id = $user_id;
    $notificationData->user_type = $user_type;
    $notificationData->notification_type = $notification_type;
    $notificationData->notification_for = $notification_for;
    $notificationData->order_id = $order_id;
    $notificationData->title = $title_lang;
    $notificationData->message = $message_lang;
    $notificationData->save();
    // insert notification lang data
    if(isset($notificationData)){
     $notificationLang = new PanelNotificationLang();
     $notificationLang->panel_notification_id = $notificationData->id;
     $notificationLang->title = $title_lang;
     $notificationLang->message = $message_lang;
     $notificationLang->lang = $lang;
     $notificationLang->save();
        // insert AR lang
          App::SetLocale('ar');
        $lang = App::getLocale();
        $message_lang = __('backend.'.$message);
        $title_lang = __('backend.'.$title);
     $notificationLang = new PanelNotificationLang();
     $notificationLang->panel_notification_id = $notificationData->id;
     $notificationLang->title = $title_lang;
     $notificationLang->message = $message_lang;
     $notificationLang->lang = $lang;
     $notificationLang->save();
    }
}

function customeRoute($route=null,$params=null){
    
    if(!empty(Auth::user())){
        return   route('admin.'.$route,$params);
    }else{
        return   route($route,$params);
    }
}

function customeRedirect($route=null,$params=null,$type,$message){
    if(!empty(Auth::user())){
    if(Auth::user()->role_id==1)
     {
        return  redirect()->route('admin.'.$route,$params)->with($type,$message);
     }
     else if(Auth::user()->role_id==2)
     {
        return  redirect()->route('subadmin.'.$route,$params)->with($type,$message);
     }
    }else{
        return  redirect()->route($route,$params)->with($type,$message);
    }
}

function createAction($data){
    
    return '<div class="d-flex order-actions" role="group" aria-label="Basic example">'.$data.'</div>';
     //return  '<div class="dropdown"><a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal font-size-18"></i></a><ul class="dropdown-menu dropdown-menu-right">'.$data.'</ul></div>';
}

function leadAdminAction($data){
    
    return '<div class="d-flex order-actions" role="group" aria-label="Basic example">'.$data.'</div>';
     //return  '<div class="dropdown"><a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal font-size-18"></i></a><ul class="dropdown-menu dropdown-menu-right">'.$data.'</ul></div>';
}

function linkAction($data){
    
    return '<div class="d-flex order-actions" role="group" aria-label="Basic example">'.$data.'</div>';
     //return  '<div class="dropdown"><a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal font-size-18"></i></a><ul class="dropdown-menu dropdown-menu-right">'.$data.'</ul></div>';
}
function whatappAction($route,$parms){
    return '<a href="'.customeRoute($route,$parms).'" class="ms-1"><i class="bx bxs-low-vision" ></i></a>';
}

function upAction($route,$parms){
    return '<a href="'.customeRoute($route,$parms).'" class="ms-1"><i class="bx bxs-low-vision" ></i></a>';
}

function barkAction($route,$parms){
    return '<a href="'.customeRoute($route,$parms).'" class="ms-1"><i class="bx bxs-low-vision" ></i></a>';
}

function linkdinAction($route,$parms){
    return '<a href="'.customeRoute($route,$parms).'" class="ms-1"><i class="bx bxs-low-vision" ></i></a>';
}


function taskcreateAction($data){
    
    return '<div class="d-flex order-actions" role="group" aria-label="Basic example">'.$data.'</div>';
     //return  '<div class="dropdown"><a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal font-size-18"></i></a><ul class="dropdown-menu dropdown-menu-right">'.$data.'</ul></div>';
}

function editAction($route,$parms){
    
    return '<a href="'.customeRoute($route,$parms).'" class="ms-1"><i class="bx bx-edit" ></i></a>';
}

function viewAction($route,$parms){
    return '<a href="'.customeRoute($route,$parms).'" class="ms-1"><i class="bx bxs-low-vision" ></i></a>';
}



function deleteAction($route,$parms){
    return '<a href="'.customeRoute($route,$parms).'"  class="ms-1"><i class="fas fa fa-trash  mr-1"></i></a>';
}


function taskAction($route,$parms){
    return '<a href="'.customeRoute($route,$parms).'" class="ms-1"><i class="fa fa-tasks" title="Task Management" ></i></a>';
}

function documentAction($route,$parms){
    return '<a href="'.customeRoute($route,$parms).'" class="ms-1"><i class="fa fa-file-text"  title="view document" ></i></a>';
}
function infoAction($route,$parms){
    return '<a href="'.customeRoute($route,$parms).'" class="ms-1"><i class="fa fa-graduation-cap"  title="view Info" ></i></a>';
}

function milestoneAction($route,$parms){
    return '<a href="'.customeRoute($route,$parms).'" class="ms-1"><i class="fa fa-close"  title="" ></i></a>';
}

function moveAction($route,$parms){
    return '<a href="'.customeRoute($route,$parms).'" class="ms-1"><i class="fa fa-tasks" title="Move to Archive" ></i></a>';
}
//'.public_path('storage/' . $data->image).'
function pdfAction($route,$parms){
   
    return '<a href="'.customeRoute($route,$parms).'" onClick="" download target="_blank"  class=""><i class="fas fa fa-download  mr-1"></i></a>';


    //return '<a href="public/'.$parms.'" onClick="" download target="_blank"  class=""><i class="fas fa fa-download  mr-1"></i></a>';
    
}

function defaultAction($route,$parms,$icon,$class,$name){
    return '<a href="'.customeRoute($route,$parms).'" class="btn btn-'.$name.'"><i style=" color: #fff !important;" class="fas fa-'.$icon.' text-'.$class.' mr-1"></i></a></li>';
}

function defaultAjaxAction($route,$parms,$icon,$action,$class,$name){
    return '<a href="javascript:;" data-url="'.customeRoute($route,$parms).'" class="btn btn-'.$class.' '.$action.'"><i class="fas fa-'.$icon.'  mr-1"></i></a>';
}

function statusAction($status, $id, $array = null, $class = 'statusAction', $path = null,$placeholder = null) {
    if (!$array) {        
        $array = [0 => 'Pending',1 => 'Active', 2 => 'Inactive'];
    }
    return $html = Form::select('active', $array, $status, ['class' => 'form-control ' . $class,'style'=>'width:100px' ,'id' => $id, 'data-path' => customeRoute($path), 'data-value' => $status,'placeholder'=>$placeholder]);
}

function typeAction($type, $id, $array = null, $class = 'typeAction', $path = null,$placeholder = null) {
    if (!$array) {        
        $array = [0=>'Contacts',1=>'Qualified',2=>'will_join',3=>'Cold',4=>'Won',5=>'Lost'];
    }
    return $html = Form::select('contacts', $array, $type, ['class' => 'form-control ' . $class,'style'=>'width:100px' ,'id' => $id, 'data-path' => customeRoute($path), 'data-value' => $type,'placeholder'=>$placeholder]);
}

// function typeAction($type, $id, $array = null, $class = 'typeAction', $path = null,$placeholder = null) {
//     if (!$array) {        
//         $array = [1=>'working',2=>'left',3=>'will_join',4=>'absent',5=>'under_discussion'];
//     }
//     return $html = Form::select('contacts', $array, $type, ['class' => 'form-control ' . $class,'style'=>'width:100px' ,'id' => $id, 'data-path' => customeRoute($path), 'data-value' => $type,'placeholder'=>$placeholder]);
// }




//  function enquiryApis($method,$parms,$type,$headerData = array(),$method='POST'){

//     if ($type=='index') {
//         $header = array();

//     } else {
//         $header = $headerData;
//     }

//     $HTTP_HOST = $_SERVER['HTTP_HOST'];

//     if ($HTTP_HOST == 'localhost') {
//         $url = 'http://localhost/management/'.'api'.'/'.$method;
//         // $url = Config::get('global.giftLocalKPUrl').'api/auth'.'/'.$method;

//     } else {
//         $url = Config::get('global.management').'api'.'/'.$method;
//     }

//     // $url = url('/api/auth').'/'.$method;
//     // dd($url);
//     $curl = curl_init();
//     curl_setopt_array($curl, array(
//         CURLOPT_URL => $url,
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_ENCODING => '',
//         CURLOPT_MAXREDIRS => 10,
//         CURLOPT_TIMEOUT => 0,
//         CURLOPT_FOLLOWLOCATION => true,
//         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//         CURLOPT_CUSTOMREQUEST => $method,
//         CURLOPT_POSTFIELDS => $parms,
//         CURLOPT_HTTPHEADER => $header,
//     ));
//     $response = curl_exec($curl);
//     $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);    
//     curl_close($curl);
//     // echo $response; die;

//     /*$BDJsonData = new BdJson;
//     $BDJsonData->json = json_encode($response);
//     $BDJsonData->save();*/

//     if ($httpcode ==200){
//         return  json_decode($response);
//     } else if($httpcode ==401){
//         return  array('staus'=>false,'status'=>false,'message'=>'unauthorized');
//     }

// }

