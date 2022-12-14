<?php
namespace Certify\Certify\core\certificates;

class Generate{
    private $font = __DIR__ ."/lucida calligraphy italic.ttf";
    private $winner_certificate = __DIR__ . "/template_winner.jpeg";
    private $participant_certificate = __DIR__ . "/template_participant.jpeg";
    private $upload_path = __DIR__ . "/../../../assets/certificates/";

    public function generate_winner_certificate($name, $dept, $place, $competition, $year){
        $file_name = md5(round(microtime(true))) . ".jpeg";
        $image_path = $this->upload_path . $file_name;
        $image = imagecreatefromjpeg($this->winner_certificate);
        $color = imagecolorallocate($image, 23, 15, 13);
        imagettftext($image, 30, 0, 670, 520, $color, $this->font, $name);
        imagettftext($image, 30, 0, 200, 585, $color, $this->font, $dept);
        imagettftext($image, 30, 0, 780, 585, $color, $this->font, $place);
        imagettftext($image, 30, 0, 180, 655, $color, $this->font, $competition);
        imagettftext($image, 30, 0, 350, 720, $color, $this->font, $year);
        imagejpeg($image, $image_path);
        imagedestroy($image);

        return ["image" => "/assets/certificates/" . $file_name];
    }

    public function generate_participant_certificate($name, $dept, $competition, $year){
        $file_name = md5(round(microtime(true))) . ".jpeg";
        $image_path = $this->upload_path . $file_name;
        $image = imagecreatefromjpeg($this->participant_certificate);
        $color = imagecolorallocate($image, 23, 15, 13);
        imagettftext($image, 30, 0, 670, 520, $color, $this->font, $name);
        imagettftext($image, 30, 0, 250, 590, $color, $this->font, $dept);
        imagettftext($image, 30, 0, 180, 655, $color, $this->font, $competition);
        imagettftext($image, 30, 0, 350, 720, $color, $this->font, $year);
        imagejpeg($image, $image_path);
        imagedestroy($image);

        return ["image" => "/assets/certificates/" . $file_name];
    }
}