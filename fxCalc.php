<!DOCTYPE html>

<?php

  require_once( 'LoginDataModel.php' );

  if( !isset( $_SESSION ) )
  {
    session_start();
  }

  if( !isset( $_SESSION[ LoginDataModel::USERNAME_KEY ] ) ) 
  {
    include( 'login.php' );
    exit();
  }

  require_once( 'FxDataModel.php' );

  if( isset( $_SESSION[ FxDataModel::FX_DATA_MODEL_KEY ] ) )
  {
    $FxDataModel = unserialize( $_SESSION[ FxDataModel::FX_DATA_MODEL_KEY ] );
  }
  else
  {
    $FxDataModel = new FxDataModel(); 
    $_SESSION[ FxDataModel::FX_DATA_MODEL_KEY ] = serialize( $FxDataModel );
  }

  $iniArray      = $FxDataModel->getIniArray();
  $codes         = $FxDataModel->getFxCurrencies();

  $dstAmtName    = $iniArray[ FxDataModel::DST_AMT_KEY ];
  $dstCucyName   = $iniArray[ FxDataModel::DST_CUCY_KEY ];
  $srcAmtName    = $iniArray[ FxDataModel::SRC_AMT_KEY ];
  $srcCucyName   = $iniArray[ FxDataModel::SRC_CUCY_KEY ];

  if ( array_key_exists( $srcAmtName, $_POST ) )
  {
    $srcAmt      = $_POST[ $srcAmtName ];
    $srcCucy     = $_POST[ $srcCucyName ];
    $dstCucy     = $_POST[ $dstCucyName ];
  }

  if ( isset ( $srcAmt ) && is_numeric( $srcAmt ) )
  {
    $dstAmt   = $srcAmt * $FxDataModel->getFxRate( $srcCucy, $dstCucy );
  }
  else
  {
    $srcAmt       = '';
    $srcCucy      = $codes[ 0 ];
    $dstCucy      = $codes[ 0 ];
    $dstAmt       = '';
  }
?>

<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Foreign Exchange Calculator</title>
  </head>

  <body>
    <h1 align="center">Money Banks F/X Calculator</h1>
    <hr/><br/>
    <form name="fxCalc" action="fxCalc.php" method="post">

      <center>

        <h2>Welcome <?php echo $_SESSION[ LoginDataModel::USERNAME_KEY ] ?></h2>

        <select name="<?php echo $srcCucyName ?>">
          <?php 
            foreach( $codes as $currency )
            {
          ?>
            <option value="<?php echo $currency ?>"
              <?php 
                if( $currency == $srcCucy )
                {
              ?>
                selected 
              <?php
                }
              ?>
              ><?php echo $currency?></option>
          <?php
            }
          ?>
        </select>
        <input type="text" name="<?php echo $srcAmtName ?>" value="<?php echo $srcAmt?>"/>

        <select name="<?php echo $dstCucyName ?>">
          <?php
            foreach($codes as $currency)
            {
          ?>
            <option value="<?php echo $currency ?>"
              <?php
                if($currency == $dstCucy)
                {
              ?>
                selected
              <?php
                }
              ?>
              ><?php echo $currency ?></option>
          <?php
            }
          ?>
        </select>
        <input type="text" name="<?php echo $dstAmtName?>" disabled="disabled" value="<?php echo $dstAmt ?>"/>

        <br/><br/>
        
        <input type="submit" value="Convert"/>
        <input type="reset"/>

      </center>

    </form>
  </body>
</html>
