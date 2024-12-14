<?php

class database
{
    private $con;
    public $host = "localhost";
    public $usr = "root";
    public $pasw = "";
    public $db = "db_vinjhonterpal";

    function __construct()
    {
        $this->start_con();
    }
    function start_con()
    {
        if (!$this->con = new mysqli($this->host, $this->usr, $this->pasw, $this->db))
            die('Can not connect mysql server local');
    }

    function close_con()
    {
        return mysqli_close($this->con);
    }
    function sqlquery($sql)
    {
        if (!$this->con = new mysqli($this->host, $this->usr, $this->pasw, $this->db))
            die('Can not connect mysql server');
        return $this->con->query($sql);
    }

    function jumrec($sql)
    {
        if ($hasil = $this->sqlquery($sql))
            $jum = mysqli_num_rows($hasil);
        else
            $jum = 0;
        return $jum;
    }


    function datasql($sql)
    {
        $data = array();
        if ($hasil = $this->sqlquery($sql))
            $data = $hasil->fetch_array(MYSQLI_BOTH);
        return $data;
    }

    function fetchdata($sql)
    {
        $res = array();
        if ($hasil = $this->sqlquery($sql))
            while ($data = $hasil->fetch_array(MYSQLI_BOTH)) {
                $res[] = $data;
            }
        return $res;
    }
    function getQueryResult($db, $sql, $field)
    {
        $result = $db->sqlquery($sql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row[$field] ?: 0;
        }
        return 0;
    }
    function createDashboardBox($color, $icon, $label, $data, $link)
    {
        echo "
        <div class='col-sm-2 col-xs-2'>
          <div class='small-box bg-$color'>
            <div class='inner' style='display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%;'>
              <h1 style='font-weight: bolder; text-align: center;'>$data</h1>
              <p style='text-align: center;'>$label</p>
            </div>
            <div class='icon'>
              <i class='$icon'></i>
            </div>
            <a href='$link' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>";
    }
    function createDashboardBoxMoney($color, $icon, $label, $data, $link)
    {
        echo "
        <div class='col-sm-3 col-xs-2'>
          <div class='small-box bg-$color'>
            <div class='inner' style='display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%;'>
              <h1 style='font-weight: bolder; text-align: center;'>Rp. " . number_format($data, 0, ',', '.') . "</h1>
              <p style='text-align: center;'>$label</p>
            </div>
            <div class='icon'>
              <i class='$icon'></i>
            </div>
            <a href='$link' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>";
    }
}
