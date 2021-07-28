<?php

namespace App\sections;
use App\Video;
use App\section;

class SectionManager
{
    public function topFiveSections()
    {
        return section::paginate(5)->where("locked", 0);
    }

    public function getSections($offset = 5)
    {

    }
}






//
