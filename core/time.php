<?
class Time
{
    function GetTime ($time)
    {
        if ($time > 0)
        {
            return $time;
        }
        else
        {
            return time();
        }       
    }

    function GetTimeNumeric ($time)
    {
        $time = $this->GetTime ($time);
        return $this->GetHourDate($time) . ":" . $this->GetMinDate($time) . ":" . $this->GetSecDate($time);
    }
    
    function GetDateNumeric ($time)
    {
        $time = $this->GetTime ($time);
        return $this->GetNumericDate($time) . "-" . $this->GetMonthDate($time) . "-" . $this->GetYearDate($time);
    }
    
    function GetDateString ($time)
    {
        $time  = $this->GetTime ($time);
        $Month = $this->GetMonthDate($time);
        return $this->GetNumericDate($time) . "-" . $this->GetNameMonth($Month) . "-" . $this->GetYearDate($time);
    }

    function GetDate ($IsTime = false, $IsDate = false, $IsDay = false, $IsString = false, $time)
    {
        $time     = $this->GetTime ($time);
        $CurrTime = "";
        $Added    = false;

        if ($IsTime)
        {
            $CurrTime .= $this->GetTimeNumeric($time);
            $Added = true;
        }
    
        if ($IsDate)
        {
            if ($Added)
            {
                $CurrTime .= ", ";
            }

            if ($IsString)
            {
                $CurrTime .= $this->GetDateString($time);
            }
            else
            {
                $CurrTime .= $this->GetDateNumeric($time);
            }

            $Added = true;
        }
        
        if ($IsDay)
        {
            if ($Added)
            {
                $CurrTime .= ", ";
            }

            $CurrTime .= $this->GetStringDay($time);
        }
        
        return $CurrTime;
    }

    function GetNumericDate ($time)
    {
        $time = $this->GetTime ($time);
        return date("d", $time);
    }

    function GetMonthDate ($time)
    {
        $time = $this->GetTime ($time);
        return date("m", $time);
    }

    function GetYearDate ($time)
    {
        $time = $this->GetTime ($time);
        return date("o", $time);
    }

    function GetDayDate ($time)
    {
        $time = $this->GetTime ($time);
        return date("N", $time);
    }

    function GetHourDate ($time)
    {
        $time = $this->GetTime ($time);
        return date("H", $time);
    }

    function GetMinDate ($time)
    {
        $time = $this->GetTime ($time);
        return date("i", $time);
    }

    function GetSecDate ($time)
    {
        $time = $this->GetTime ($time);
        return date("s", $time);
    }

    function GetStringDay ($time)
    {
        $time = $this->GetTime ($time);
        $Day  = $this->GetDayDate($time);
        return $this->GetNameDay($Day);
    }

    function GetNameDay ($numeric = 1)
    {
        switch ($numeric)
        {
            case 1: $name = "Понедельник"; break;
            case 2: $name = "Вторник"; break;
            case 3: $name = "Среда"; break;
            case 4: $name = "Четверг"; break;
            case 5: $name = "Пятница"; break;
            case 6: $name = "Суббота"; break;
            case 7: $name = "Воскресенье"; break;
            default: $name = "Аппаратная ошибка в памяти дня недели.";
        }
        
        return $name;
    }

    function GetNameMonth ($numeric = 1)
    {
        switch ($numeric)
        {
            case 1: $name = "Январь"; break;
            case 2: $name = "Февраль"; break;
            case 3: $name = "Март"; break;
            case 4: $name = "Апрель"; break;
            case 5: $name = "Май"; break;
            case 6: $name = "Июнь"; break;
            case 7: $name = "Июль"; break;
            case 8: $name = "Август"; break;
            case 9: $name = "Сентябрь"; break;
            case 10: $name = "Октябрь"; break;
            case 11: $name = "Ноябрь"; break;
            case 12: $name = "Декабрь"; break;
            default: $name = "Аппаратная ошибка в памяти номера месяца.";
        }
        
        return $name;
    }
}
