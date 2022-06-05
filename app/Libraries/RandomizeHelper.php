<?php namespace App\Libraries;

class RandomizeHelper
{
    public function randN($length) {
        $chars = "23456789";
        $charArray = str_split($chars);
        $charCount = strlen($chars);
        $result = "";
        for($i=1;$i<=$length;$i++)
        {
            $randChar = rand(0,$charCount-1);
            $result .= $charArray[$randChar];
        }
        return $result;
    }

    public function randUC($length) {
        $chars = "ABCDEFGHJKLMNPRSTUVWXYZ";
        $charArray = str_split($chars);
        $charCount = strlen($chars);
        $result = "";
        for($i=1;$i<=$length;$i++)
        {
            $randChar = rand(0,$charCount-1);
            $result .= $charArray[$randChar];
        }
        return $result;
    }
    public function randLC($length) {
        $chars = "abcdefghijkmnprstuvwxyz";
        $charArray = str_split($chars);
        $charCount = strlen($chars);
        $result = "";
        for($i=1;$i<=$length;$i++)
        {
            $randChar = rand(0,$charCount-1);
            $result .= $charArray[$randChar];
        }
        return $result;
    }

    public function randULC($length) {
        $chars = "ABCDEFGHJKLMNPRSTUVWXYZabcdefghijkmnprstuvwxyz";
        $charArray = str_split($chars);
        $charCount = strlen($chars);
        $result = "";
        for($i=1;$i<=$length;$i++)
        {
            $randChar = rand(0,$charCount-1);
            $result .= $charArray[$randChar];
        }
        return $result;
    }

    public function randNLC($length) {
        $chars = "23456789abcdefghijkmnprstuvwxyz";
        $charArray = str_split($chars);
        $charCount = strlen($chars);
        $result = "";
        for($i=1;$i<=$length;$i++)
        {
            $randChar = rand(0,$charCount-1);
            $result .= $charArray[$randChar];
        }
        return $result;
    }

    public function randNUC($length) {
        $chars = "23456789ABCDEFGHJKLMNPRSTUVWXYZ";
        $charArray = str_split($chars);
        $charCount = strlen($chars);
        $result = "";
        for($i=1;$i<=$length;$i++)
        {
            $randChar = rand(0,$charCount-1);
            $result .= $charArray[$randChar];
        }
        return $result;
    }

    public function randNULC($length) {
        $chars = "23456789ABCDEFGHJKLMNPRSTUVWXYZabcdefghijkmnprstuvwxyz";
        $charArray = str_split($chars);
        $charCount = strlen($chars);
        $result = "";
        for($i=1;$i<=$length;$i++)
        {
            $randChar = rand(0,$charCount-1);
            $result .= $charArray[$randChar];
        }
        return $result;
    }
}