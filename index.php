<?php
$apikeyfnm = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'; // Get From GETresponse API 32 characters 
$emailmmm = 'phoenix@phoenixpeth.com'; // Your Valid Email e.g. phoenix@phoenixpeth.com
$getfullname = 'Raju Harry'; // Your Name e.g. Raju Harry
$mobilecode = '+xx'; // Your Country code e.g. +91
$mobile = 'xxxxxxxxxx'; // Your 10 digit mobile code e.g. 9999999999
$addcontacturl = 'https://api.getresponse.com/v3/contacts/';
$getcontacturl = 'https://api.getresponse.com/v3/contacts?query[email]='.$emailmmm;
$data = array (
'name' => $getfullname,
'email' => $emailmmm,
'dayOfCycle' => 0,
'campaign' => array('campaignId'=>'xxxxx'),  // Your Valid Email e.g. ThwHa
'ipAddress'=>  $_SERVER['REMOTE_ADDR'], // $_SERVER['REMOTE_ADDR'] 

);  

$data_string = json_encode($data); 

$ch = curl_init($addcontacturl);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',
    'X-Auth-Token: api-key '.$apikeyfnm,
)           
);                                                                                                                   
                                                                                                                     
$result = curl_exec($ch); // Print this If you want to verfify


$chmmn = curl_init($getcontacturl );
curl_setopt($chmmn, CURLOPT_CUSTOMREQUEST, "GET");                                                                     
curl_setopt($chmmn, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($chmmn, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',
    'X-Auth-Token: api-key '.$apikeyfnm,
)           
);                                                                                                                   
$resultmn = curl_exec($chmmn);
$resultmn = array_shift(json_decode($resultmn,true)); // Print this If you want to verfify


$contactId = trim($resultmn['contactId']);
$customfld1 = 'xxxxx';
$customfld2 = 'xxxxx';
$datamn = array (
'contactId' => $contactId,
'customFieldValues'=> array(
        array(
        'customFieldId'=> $customfld1, // e.g. OiBzq use this to get Custom field id - https://api.getresponse.com/v3/custom-fields/
        'href'=> 'https://api.getresponse.com/v3/custom-fields/'.$customfld1,                        
        'name'=> 'mobile_phone',
        'fieldType'=> 'text',
        'format'=> 'text',
        'valueType'=> 'phone',
        'type'=> 'phone',
        'hidden'=> 'false',
        'values'=> array($mobilecode.$mobile)
        ),
        array(
        'customFieldId'=> $customfld2,
        'href'=> 'https://api.getresponse.com/v3/custom-fields/'.$customfld2,                        
        'name'=> 'country',
        'fieldType'=> 'single_select',
        'format'=> 'single_select',
        'valueType'=> 'country',
        'type'=> 'country',
        'hidden'=> 'false',
        'values'=> array('India') // Your Country Value in Getresponse.
        ),
    )
); 

$data_stringmn = json_encode($datamn);                                                                                   
//echo '<pre>';print_r($data_stringmn);exit;   
$mnurl = 'https://api.getresponse.com/v3/contacts/'.$contactId.'/custom-fields/';  
//echo $mnurl;exit;
$chfeld = curl_init($mnurl);
curl_setopt($chfeld, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($chfeld, CURLOPT_POSTFIELDS, $data_stringmn);                                                                  
curl_setopt($chfeld, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($chfeld, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',
    'X-Auth-Token: api-key '.$apikeyfnm,
)           
);                                                                                                                   
                                                                                                                     
$resultcustomfld = curl_exec($chfeld); // Print this If you want to verfify

curl_close($ch);
curl_close($chmmn);
curl_close($chfeld);


?>
