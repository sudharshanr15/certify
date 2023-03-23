<?php
namespace Certify\Certify\core\certificates;

require_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

class Generate{
    private $root_dir;
    private $font = __DIR__ ."/lucida calligraphy italic.ttf";
    private $winner_certificate = __DIR__ . "/template_winner.jpeg";
    private $participant_certificate = __DIR__ . "/template_participant.jpeg";
    private $upload_path = __DIR__ . "/../../../assets/certificates/";

    function __construct()
    {
        $this->root_dir = ROOT_DIR;
    }
    
    // public function generate_winner_certificate($name, $dept, $place, $competition, $year){
    //     $file_name = md5(round(microtime(true))) . ".jpeg";
    //     $image_path = $this->upload_path . $file_name;
    //     $image = imagecreatefromjpeg($this->winner_certificate);
    //     $color = imagecolorallocate($image, 23, 15, 13);
    //     imagettftext($image, 30, 0, 670, 520, $color, $this->font, $name);
    //     imagettftext($image, 30, 0, 200, 585, $color, $this->font, $dept);
    //     imagettftext($image, 30, 0, 780, 585, $color, $this->font, $place);
    //     imagettftext($image, 30, 0, 180, 655, $color, $this->font, $competition);
    //     imagettftext($image, 30, 0, 350, 720, $color, $this->font, $year);
    //     imagejpeg($image, $image_path);
    //     imagedestroy($image);

    //     return ["image" => "/assets/certificates/" . $file_name];
    // }

    public function generate_participant_certificate($name, $dept, $competition, $year){
        $link = "http://localhost:5000/api/generate/participant?name=" . urlencode($name) . "&degree=". urlencode($dept) ."&competition=". urlencode($competition) ."&year=". urlencode($year);
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $link,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        $response = json_decode($response, true);
        curl_close($curl);

        if($response['result'] == true){
            return ["image" => $response['output_file']];
        }
    }

    public function generate_winner_certificate($name, $dept, $place, $competition, $year){
        $link = "http://localhost:5000/api/generate/winner?name=" . urlencode($name) . "&degree=". urlencode($dept) ."&competition=". urlencode($competition) ."&year=". urlencode($year) ."&place=" . urlencode($place);
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $link,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        $response = json_decode($response, true);
        curl_close($curl);

        if($response['result'] == true){
            return ["image" => $response['output_file']];
        }
    }
}