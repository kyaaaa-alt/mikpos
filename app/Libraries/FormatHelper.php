<?php namespace App\Libraries;

class FormatHelper
{
    public function formatBytes($size, $precision = 2)
    {
        if ($size == '0') {
            return $size;
        } else {
            $base = log($size, 1024);
            $suffixes = array('', 'KB', 'MB', 'GB', 'TB');

            return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
        }
    }
    public function formatDTM($dtm){
        if(substr($dtm, 1,1) == "d" || substr($dtm, 2,1) == "d"){
            $day = explode("d",$dtm)[0]."d";
            $day = str_replace("d", "d ", str_replace("w", "w ", $day));
            $dtm = explode("d",$dtm)[1];
        }elseif(substr($dtm, 1,1) == "w" && substr($dtm, 3,1) == "d" || substr($dtm, 2,1) == "w" && substr($dtm, 4,1) == "d"){
            $day = explode("d",$dtm)[0]."d";
            $day = str_replace("d", "d ", str_replace("w", "w ", $day));
            $dtm = explode("d",$dtm)[1];
        }elseif (substr($dtm, 1,1) == "w" || substr($dtm, 2,1) == "w" ) {
            $day = explode("w",$dtm)[0]."w";
            $day = str_replace("d", "d ", str_replace("w", "w ", $day));
            $dtm = explode("w",$dtm)[1];
        }

        // secs
        if(strlen($dtm) == "2" && substr($dtm, -1) == "s"){
            $format = $day." 00:00:0".substr($dtm, 0,-1);
        }elseif(strlen($dtm) == "3" && substr($dtm, -1) == "s"){
            $format = $day." 00:00:".substr($dtm, 0,-1);
            //minutes
        }elseif(strlen($dtm) == "2" && substr($dtm, -1) == "m"){
            $format = $day." 00:0".substr($dtm, 0,-1).":00";
        }elseif(strlen($dtm) == "3" && substr($dtm, -1) == "m"){
            $format = $day." 00:".substr($dtm, 0,-1).":00";
            //hours
        }elseif(strlen($dtm) == "2" && substr($dtm, -1) == "h"){
            $format = $day." 0".substr($dtm, 0,-1).":00:00";
        }elseif(strlen($dtm) == "3" && substr($dtm, -1) == "h"){
            $format = $day." ".substr($dtm, 0,-1).":00:00";

            //minutes -secs
        }elseif(strlen($dtm) == "4" && substr($dtm, -1) == "s" && substr($dtm,1,-2) == "m"){
            $format = $day." "."00:0".substr($dtm, 0,1).":0".substr($dtm, 2,-1);
        }elseif(strlen($dtm) == "5" && substr($dtm, -1) == "s" && substr($dtm,1,-3) == "m"){
            $format = $day." "."00:0".substr($dtm, 0,1).":".substr($dtm, 2,-1);
        }elseif(strlen($dtm) == "5" && substr($dtm, -1) == "s" && substr($dtm,2,-2) == "m"){
            $format = $day." "."00:".substr($dtm, 0,2).":0".substr($dtm, 3,-1);
        }elseif(strlen($dtm) == "6" && substr($dtm, -1) == "s" && substr($dtm,2,-3) == "m"){
            $format = $day." "."00:".substr($dtm, 0,2).":".substr($dtm, 3,-1);

            //hours -secs
        }elseif(strlen($dtm) == "4" && substr($dtm, -1) == "s" && substr($dtm,1,-2) == "h"){
            $format = $day." 0".substr($dtm, 0,1).":00:0".substr($dtm, 2,-1);
        }elseif(strlen($dtm) == "5" && substr($dtm, -1) == "s" && substr($dtm,1,-3) == "h"){
            $format = $day." 0".substr($dtm, 0,1).":00:".substr($dtm, 2,-1);
        }elseif(strlen($dtm) == "5" && substr($dtm, -1) == "s" && substr($dtm,2,-2) == "h"){
            $format = $day." ".substr($dtm, 0,2).":00:0".substr($dtm, 3,-1);
        }elseif(strlen($dtm) == "6" && substr($dtm, -1) == "s" && substr($dtm,2,-3) == "h"){
            $format = $day." ".substr($dtm, 0,2).":00:".substr($dtm, 3,-1);

            //hours -secs
        }elseif(strlen($dtm) == "4" && substr($dtm, -1) == "m" && substr($dtm,1,-2) == "h"){
            $format = $day." 0".substr($dtm, 0,1).":0".substr($dtm, 2,-1).":00";
        }elseif(strlen($dtm) == "5" && substr($dtm, -1) == "m" && substr($dtm,1,-3) == "h"){
            $format = $day." 0".substr($dtm, 0,1).":".substr($dtm, 2,-1).":00";
        }elseif(strlen($dtm) == "5" && substr($dtm, -1) == "m" && substr($dtm,2,-2) == "h"){
            $format = $day." ".substr($dtm, 0,2).":0".substr($dtm, 3,-1).":00";
        }elseif(strlen($dtm) == "6" && substr($dtm, -1) == "m" && substr($dtm,2,-3) == "h"){
            $format = $day." ".substr($dtm, 0,2).":".substr($dtm, 3,-1).":00";

            //hours minutes secs
        }elseif(strlen($dtm) == "6" && substr($dtm, -1) == "s" && substr($dtm,3,-2) == "m" && substr($dtm,1,-4) == "h"){
            $format = $day." 0".substr($dtm, 0,1).":0".substr($dtm, 2,-3).":0".substr($dtm, 4,-1);
        }elseif(strlen($dtm) == "7" && substr($dtm, -1) == "s" && substr($dtm,3,-3) == "m" && substr($dtm,1,-5) == "h"){
            $format = $day." 0".substr($dtm, 0,1).":0".substr($dtm, 2,-4).":".substr($dtm, 4,-1);
        }elseif(strlen($dtm) == "7" && substr($dtm, -1) == "s" && substr($dtm,4,-2) == "m" && substr($dtm,1,-5) == "h"){
            $format = $day." 0".substr($dtm, 0,1).":".substr($dtm, 2,-3).":0".substr($dtm, 5,-1);
        }elseif(strlen($dtm) == "8" && substr($dtm, -1) == "s" && substr($dtm,4,-3) == "m" && substr($dtm,1,-6) == "h"){
            $format = $day." 0".substr($dtm, 0,1).":".substr($dtm, 2,-4).":".substr($dtm, 5,-1);
        }elseif(strlen($dtm) == "7" && substr($dtm, -1) == "s" && substr($dtm,4,-2) == "m" && substr($dtm,2,-4) == "h"){
            $format = $day." ".substr($dtm, 0,2).":0".substr($dtm, 3,-3).":0".substr($dtm, 5,-1);
        }elseif(strlen($dtm) == "8" && substr($dtm, -1) == "s" && substr($dtm,4,-3) == "m" && substr($dtm,2,-5) == "h"){
            $format = $day." ".substr($dtm, 0,2).":0".substr($dtm, 3,-4).":".substr($dtm, 5,-1);
        }elseif(strlen($dtm) == "8" && substr($dtm, -1) == "s" && substr($dtm,5,-2) == "m" && substr($dtm,2,-5) == "h"){
            $format = $day." ".substr($dtm, 0,2).":".substr($dtm, 3,-3).":0".substr($dtm, 6,-1);
        }elseif(strlen($dtm) == "9" && substr($dtm, -1) == "s" && substr($dtm,5,-3) == "m" && substr($dtm,2,-6) == "h"){
            $format = $day." ".substr($dtm, 0,2).":".substr($dtm, 3,-4).":".substr($dtm, 6,-1);

        }else{
            $format = $dtm;
        }
        return $format;
    }
}
?>