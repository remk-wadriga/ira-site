<?php
use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:v="urn:schemas-microsoft-com:vml">
<head>
    <!-- Define Charset -->
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <!-- Responsive Meta Tag -->
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
    <meta name="viewport" content="width=600,initial-scale = 2.3,user-scalable=no">
    <link href='https://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,500,300,600,700' rel='stylesheet' type='text/css'>
    <title><?= Html::encode($this->title) ?></title>

    <style type="text/css">

        body{
            width: 100%;
            background-color: #e2e2e2;
            margin:0;
            padding:0;
            -webkit-font-smoothing: antialiased;
            mso-margin-top-alt:0px; mso-margin-bottom-alt:0px; mso-padding-alt: 0px 0px 0px 0px;
        }
        tr td{
            padding-left: 10px;
        }

        span.preheader{display: none; font-size: 1px;}

        html{
            width: 100%;
        }

        table{
            font-size: 14px;
            border: 0;
        }

        /* ----------- responsivity ----------- */
        @media only screen and (max-width: 640px){

            /*------ top header ------ */
            body[yahoo] .main-header{font-size: 20px !important;}
            body[yahoo] .main-section-header{font-size: 30px !important;}
            body[yahoo] .show{display: block !important;}
            body[yahoo] .hide{display: none !important;}
            body[yahoo] .align-center{text-align: center !important;}

            /*-------- container --------*/
            body[yahoo] .container590{width: 440px !important;}
            body[yahoo] .container580{width: 400px !important;}
            body[yahoo] .half-container{width: 220px !important;}
            body[yahoo] .main-button{width: 220px !important;}

            /*-------- secions ----------*/
            body[yahoo] .section-img img{width: 320px !important; height: auto !important;}

        }

        @media only screen and (max-width: 479px){
            /*------ top header ------ */
            body[yahoo] .main-header{font-size: 20px !important;}
            body[yahoo] .main-section-header{font-size: 26px !important;}

            /*-------- container --------*/
            body[yahoo] .container590{width: 280px !important;}
            body[yahoo] .container580{width: 260px !important;}
            body[yahoo] .half-container{width: 130px !important;}

            /*-------- secions ----------*/
            body[yahoo] .section-img img{width: 280px !important; height: auto !important;}
        }

    </style>
    <?php $this->head() ?>
</head>
<body yahoo="fix" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
