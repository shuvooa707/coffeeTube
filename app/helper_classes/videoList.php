<?php



class videoList
{
    public static function TopTrending()
    {
        return "Top Trending";
    }
}

app()->bind("videoList",function(){
    return new videoList;
})


?>
