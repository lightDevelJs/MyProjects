<?php

function postMessage()
{
    $codeApi = '41fb0f95bfaa6fa668';
    $tokenApi = 'd437d3692c3e9e8203bb5a64c3469ba03e3cd404d8e4039a129247c60a58a494a22de4b18e5ab2114d604';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.vkontakte.ru/method/wall.post?owner_id=29257421&from_group=1&message=HelloMessage&attachments=www.google.com&v=5.28&access_token=' . $tokenApi . '');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $res = curl_exec($ch);
    var_dump($res);
    curl_close($ch);
}

/*new permissions = {"access_token":"2c0bc24f135ea815f3db8424e62edf581a9fcf97b9be3762b3fc823dec1030fd3826632c29f7386b19477","expires_in":0,"user_id":29257421,"email":"mycranny@gmail.com"}*/
/*code=*/
https://oauth.vk.com/blank.html#code=0a311794c8407c840e
//{"access_token":"d437d3692c3e9e8203bb5a64c3469ba03e3cd404d8e4039a129247c60a58a494a22de4b18e5ab2114d604","expires_in":0,"user_id":29257421,"email":"mycranny@gmail.com"}
//https://oauth.vk.com/authorize?client_id=4783775&scope=wall,messages,photos,offline,status,groups,email& redirect_uri=https://oauth.vk.com/blank.html& response_type=code& v=5.28& state="SESSION_STATE"
class VK_Api
{

    function __construct($tokenApi)
    {
        if (!$tokenApi) {
            throw new Exception ("No token in the variables constructor");
        } else $this->tokenApi = $tokenApi;
    }

    public function sendMessageToWall($id, $message)
    {
        if (empty($id) || empty($message)) {
            throw new Exception ("Empty params id or message");
        }
        $image =  $this->loadImage();
        $mediaId = $image->response[0]->id;
        $ownerId = $image->response[0]->owner_id;
       // GET parameter from group - 1 (group), from group - 0 send from user
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.vkontakte.ru/method/wall.post?owner_id='.$id.'&from_group=0&message='.$message.'&attachments=photo'.$ownerId.'_'.$mediaId.'&v=5.28&access_token='.$this->tokenApi);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $res = curl_exec($ch);
        var_dump($res);
        curl_close($ch);

    }

    public function loadImage()
    {
        $headers[] = 'Content-Type: multipart/form-data';
        $post_params = array(
            'file1' => '@' . 'T:/home/vksender.local/www/2.jpg'
        );
       // Get Settings to upload a file
        $data = file_get_contents("https://api.vk.com/method/photos.getWallUploadServer?v=5.28&group_id=87450287&access_token=$this->tokenApi");
        $dataArray = json_decode($data);
       // The process of loading images to server
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $dataArray->response->upload_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_params);
        $response = curl_exec($ch);
        $attachphoto = json_decode($response);
        curl_close($ch);

        // The process of saving upload pictures and get options of a  picture
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://api.vk.com/method/photos.saveWallPhoto?v=5.28&group_id=87450287&photo=$attachphoto->photo&server=$attachphoto->server&hash=$attachphoto->hash&access_token=$this->tokenApi");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response1 = curl_exec($ch);
        curl_close($ch);
        return json_decode($response1);

    }

}

try {
    $request = new VK_Api('2c0bc24f135ea815f3db8424e62edf581a9fcf97b9be3762b3fc823dec1030fd3826632c29f7386b19477');
    $request->sendMessageToWall('cobrules', 'Hello');

} catch (Exception $e) {
    die($e->__toString());
}

?>