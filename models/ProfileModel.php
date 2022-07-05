<?php
namespace Alireza\Untitled\models;
class ProfileModel
{
    public static function print(array $inscriptions)
    {
        $outputText = "";
        foreach ($inscriptions as $inscription){
            $outputText = $outputText. '<div class="d-flex justify-content-start rounded-3 p-2 mb-2" style="background-color: #efefef;"> <div> <p class="small text-muted mb-1">' . $inscription["id"] . ' '. $inscription["subject"]. '</p><p class="mb-0">'. $inscription["content"]. '</p></div></div>';
        }
        return $outputText;
    }
}