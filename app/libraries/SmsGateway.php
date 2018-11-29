<?php

class SmsGateway {

    static $baseUrl = "https://smsgateway.me";


    function __construct($email,$password) {
        $this->email = $email;
        $this->password = $password;
    }

    function createContact ($name,$number) {
        return $this->makeRequest('/api/v4/contacts/create','POST',['name' => $name, 'number' => $number]);
    }

    function getContacts ($page=1) {
        return $this->makeRequest('/api/v4/contacts','GET',['page' => $page]);
    }

    function getContact ($id) {
        return $this->makeRequest('/api/v4/contacts/view/'.$id,'GET');
    }


    function getDevices ($page=1)
    {
        return $this->makeRequest('/api/v4/devices','GET',['page' => $page]);
    }

    function getDevice ($id)
    {
        return $this->makeRequest('/api/v4/devices/view/'.$id,'GET');
    }

    function getMessages($page=1)
    {
        return $this->makeRequest('/api/v4/messages','GET',['page' => $page]);
    }

    function getMessage($id)
    {
        return $this->makeRequest('/api/v4/messages/view/'.$id,'GET');
    }

    function sendMessageToNumber($to, $message, $device, $options=[]) {
        $query = array_merge(['number'=>$to, 'message'=>$message, 'device' => $device], $options);
        return $this->makeRequest('/api/v4/messages/send','POST',$query);
    }

    function sendMessageToManyNumbers ($to, $message, $device, $options=[]) {
        $query = array_merge(['number'=>$to, 'message'=>$message, 'device' => $device], $options);
        return $this->makeRequest('/api/v4/messages/send','POST', $query);
    }

    function sendMessageToContact ($to, $message, $device, $options=[]) {
        $query = array_merge(['contact'=>$to, 'message'=>$message, 'device' => $device], $options);
        return $this->makeRequest('/api/v4/messages/send','POST', $query);
    }

    function sendMessageToManyContacts ($to, $message, $device, $options=[]) {
        $query = array_merge(['contact'=>$to, 'message'=>$message, 'device' => $device], $options);
        return $this->makeRequest('/api/v4/messages/send','POST', $query);
    }

    function sendManyMessages ($data) {
        $query['data'] = $data;
        return $this->makeRequest('/api/v4/messages/send','POST', $query);
    }

    private function makeRequest ($url, $method, $fields=[]) {

        $fields['email'] = $this->email;
        $fields['password'] = $this->password;

        $url = smsGateway::$baseUrl.$url;

        $fieldsString = http_build_query($fields);


        $ch = curl_init();

        if($method == 'POST')
        {
            curl_setopt($ch,CURLOPT_POST, count($fields));
            curl_setopt($ch,CURLOPT_POSTFIELDS, $fieldsString);
        }
        else
        {
            $url .= '?'.$fieldsString;
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          'Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTUyNjA2OTI2OCwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjQ1OTU3LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.9YUK41Yb_ghaErrbBsfU7Pj_J57jrfOum-5AJI-yBOo',
          'Content-Type:application/json'
      ));
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HEADER , false);  // we want headers
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec ($ch);

        $return['response'] = json_decode($result,true);

        if($return['response'] == false)
            $return['response'] = $result;

        $return['status'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close ($ch);

        return $return;
    }

    #Api update to v4 must be using json POST
    function sendMessageToNumberV4($message, $phone_number, $device_id){
        #echo '<pre>'.print_r(json_decode(file_get_contents("php://input")),1).'</pre>'; use this on the receipient page to retrieve the POSTed json

        $ch = curl_init( $url );
        # Setup request to send json via POST.
        $payload = json_encode( array( "customer"=> $data ) );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        # Return response instead of printing.
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        # Send request.
        $result = curl_exec($ch);
          curl_close($ch);
          # Print response.
          echo "<pre>$result</pre>";
        }
    }

?>