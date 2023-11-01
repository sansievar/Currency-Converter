<?php

require_once 'fxCalc.ini';

class FxDataModel
{
    const FX_DATA_MODEL_KEY  = 'fx.data.model';
    const DST_AMT_KEY        = 'dst.amt';
    const DST_CUCY_KEY       = 'dst.cucy';
    const SRC_AMT_KEY        = 'src.amt';
    const SRC_CUCY_KEY       = 'src.cucy';
    const DB_PASSWORD_KEY    = 'db.password'   ;
    const DB_USERNAME_KEY    = 'db.username'   ;
    const DSN_KEY            = 'dsn'           ;

    private $iniArray;
    private $fxCurrencies;
    private $fxRates;

    public function __construct()
    {
        $this->iniArray = parse_ini_file('fxCalc.ini');
        $this->fxCurrencies = array();

        $dbh = new PDO( 
          $this->iniArray[ self::DSN_KEY ]        ,
          $this->iniArray[ self::DB_USERNAME_KEY ],
          isset( $this->iniArray[ self::DB_PASSWORD_KEY ] ) ? $this->iniArray[ self::DB_PASSWORD_KEY ] : NULL
        );

        $sql = "SELECT srcCucy, dstCucy, fxRate FROM fxRates ORDER BY srcCucy, dstCucy";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $srcCucy = $row['srcCucy'];
            $dstCucy = $row['dstCucy'];
            $fxRate  = $row['fxRate'];

            if (!in_array($srcCucy, $this->fxCurrencies)) {
                $this->fxCurrencies[] = $srcCucy;
            }

            $this->fxRates[$srcCucy][$dstCucy] = $fxRate;
        }

        $stmt = null;
        $dbh = null;
    }

    public function getIniArray()
    {
        return $this->iniArray;
    }

    public function getFxCurrencies()
    {
        return $this->fxCurrencies;
    }

    public function getFxRate($fromCurrency, $toCurrency)

    {

        return $this->fxRates[$fromCurrency][$toCurrency];

    }
}
?>
