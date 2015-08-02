
<?php
include 'db.php';

class TimeTable
{
    private $isJamahOnly = false;

    private $isHanafiAsr = false;

    private $asrBegins = "";

    private $row = array();

    public function __construct()
    {
        $this->row = $this->getCalendarToday();
    }

    public function setJamahOnly()
    {
        $this->isJamahOnly = true;
    }

    public function setHanafiAsr()
    {
        $this->isHanafiAsr = true;
    }

    public function verticalTime()
    {
        $row = $this->row;
var_dump($row);
        if ($this->isJamahOnly) {
            return '<table border="1" cellpadding="4" cellspacing="4"><tr><td>vertical jamahOnly</td</tr></table>';
        }

        return 'vertical time';
    }

    public function horizontalTime()
    {
        $row = $this->row;
        $this->asrBegins = $this->isHanafiAsr ? $this->row['asr_mithl_2'] : $this->row['asr_mithl_1'];

        if ($this->isJamahOnly) {
            return 'horizontal jamahOnly';
        }

        return
        '<table style="text-align:center">
            <tr>
             <th colspan="3" style="text-align:center">'.$this->formatDate($row['d_date']).'</th>
            </tr>
            <tr>
             <th style="text-align:center">Prayer</th><th style="text-align:center">Starts</th><th style="text-align:center">Jamah</th>
            </tr>
            <tr>
                <td style="text-align:center">Fajr</td><td style="text-align:center">'.$this->formatDateForPrayer($row['fajr_begins']).'</td>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['fajr_jamah']).'
            </tr>
            <tr><td style="text-align:center">Sunrise</td><td colspan="2" style="text-align:center">'.$this->formatDateForPrayer($row['sunrise']).'</td></tr>
            <tr>
                <td style="text-align:center">Zuhr</td><td style="text-align:center">'.$this->formatDateForPrayer($row['zuhr_begins']).'</td>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['zuhr_jamah']).'
            </tr>
            <tr>
                <td style="text-align:center">Asr</td><td style="text-align:center">'.$this->formatDateForPrayer($this->asrBegins).'</td>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['asr_jamah']).'
            </tr>
            <tr>
                <td style="text-align:center">Magrib</td><td style="text-align:center">'.$this->formatDateForPrayer($row['maghrib_begins']).'</td>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['maghrib_jamah']).'
            </tr>
            <tr>
                <td style="text-align:center">Isha</td><td style="text-align:center">'.$this->formatDateForPrayer($row['isha_begins']).'</td>
                <td style="text-align:center">'.$this->formatDateForPrayer($row['isha_jamah']).'
            </tr>
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

    private function formatDate($mysqlDate, $format=null)
    {
        $phpdate = strtotime($mysqlDate);
        $date =  date( 'l j, M Y', $phpdate );
        if ($format) {
            $date = date($format, $phpdate);
        }

        return $date;
    }

    private function formatDateForPrayer($mysqlDate)
    {
        return $this->formatDate($mysqlDate, 'H:i');
    }
}
