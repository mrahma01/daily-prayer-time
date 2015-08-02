<?php
include 'db.php';

class TimeTable
{
    private $isJamahOnly = false;

    public function setJamahOnly()
    {
        $this->isJamahOnly = true;
    }
                public static function getCalendarTodayAsString($row){
                        $str = "";
                        $str = "<table class='full timetable' >";
                        $str .= "<tr><th style='border:none;'></th><th>Begins</th><th>Jammah</th></tr>";
                        $str .= "<tr><td>Fajr</td><td>".self::formatHourAndMinuteOnly($row["fajr_begins"])."</td><td>".self::formatHourAndMinuteOnly($row["fajr_jamah"])."</td></tr>";
                        $str .= "<tr><td>Sunrise</td><td colspan='2'>".self::formatHourAndMinuteOnly($row["sunrise"])."</td></tr>";
                        $str .= "<tr><td>Zuhr</td><td>".self::formatHourAndMinuteOnly($row["zuhr_begins"])."</td><td>".self::formatHourAndMinuteOnly($row["zuhr_jamah"], 43200)."</td></tr>";
                        $str .= "<tr><td>Asr</td><td>".self::formatHourAndMinuteOnly($row["asr_mithl_1"], 43200)."</td><td>".self::formatHourAndMinuteOnly($row["asr_jamah"], 43200)."</td></tr>";
                        $str .= "<tr><td>Magrib</td><td>".self::formatHourAndMinuteOnly($row["maghrib_begins"], 43200)."</td><td>".self::formatHourAndMinuteOnly($row["maghrib_jamah"], 43200)."</td></tr>";
                        $str .= "<tr><td>Isha</td><td>".self::formatHourAndMinuteOnly($row["isha_begins"], 43200)."</td><td>".self::formatHourAndMinuteOnly($row["isha_jamah"], 43200)."</td></tr></table>";

                        return $str;

                }


    public function verticalTime()
    {
        $row = $this->getCalendarToday();
var_dump($row);
        if ($this->isJamahOnly) {
            return '<table border="1" cellpadding="2" cellspacing="2"><tr><td>vertical jamahOnly</td</tr></table>';
        }

        return 'vertical time';
    }

    public function horizontalTime()
    {
        $row = $this->getCalendarToday();
        if ($this->isJamahOnly) {
            return 'horizontal jamahOnly';
        }
        return
        '<table border="1" cellpadding="2" cellspacing="2">
            <tr>
             <th colspan="3">Salah time for '.$row['d_date'].'</th>
            </tr>
            <tr>
             <th>Prayer</th><th>Starts</th><th>Jamah</th>
            </tr>
            <tr><td>Fajr</td><td>'.$row['fajr_begins'].'</td><td>'.$row['fajr_jamah'].'</tr>
            <tr><td>Sunrise</td><td colspan="2">'.$row['sunrise'].'</td></tr>
        </table>';
    }

    private function getCalendarToday()
    {
        $db = new DatabaseConnection();
        $day = date("j");
        $month = date("m");
        $sql = "SELECT * FROM ".DB_NAME.".timetable
                WHERE month(d_date) = $month and day(d_date) = $day LIMIT 1";

        return $db->returnArray($sql);
    }
}
