<?php
  @ob_start();
  session_start();
  include '../dbConnection.php';
  include '../functions.php';
  include '../models/getData.php';
?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../../js/script.js"></script>
    <script src="../../js/sweetalert.js"></script>
    <link type="text/css" rel="stylesheet" href="../../css/style.css" />
    <link rel="stylesheet" href="../../css/font-quicksand.css">
  </head>
  <body>
    <?php
      if (!$error_message){
        if (isset($_POST['submit']) and isset($_POST['find'])){
          $keyword = text_filter($_POST['find']);
          $type = text_filter($_POST['submit']);
          switch($type){
            case 'vigili':
              // restituisce un array con gli id 
              $firemenID = getFiremanByKeyword($keyword, $_SESSION['ID'], $db_conn);
              if (empty($firemenID)){
                echo "
                <script>
                  flatAlert('', 'La ricerca non ha prodotto risultati', 'warning', '../../dashboard.php?redirect=vigili');
                </script>";
                return;
              }else{
                $_SESSION['searchKeyword'] = $keyword;
                $_SESSION['search'] = $firemenID;
                redirect('../../dashboard.php?redirect=cercavigili');
              }
              break;
            case 'mezzi':
              $mezziID = getMezziByKeyword($keyword, $_SESSION['ID'], $db_conn);
              if (empty($mezziID)){
                echo "
                <script>
                  flatAlert('', 'La ricerca non ha prodotto risultati', 'warning', '../../dashboard.php?redirect=mezzi');
                </script>";
                return;
              }else{
                $_SESSION['searchKeyword'] = $keyword;
                $_SESSION['search'] = $mezziID;
                redirect('../../dashboard.php?redirect=cercamezzi');
              }
              break;
            case 'attrezzature':
              $attrezzatureID = getAttrezzatureByKeyword($keyword, $_SESSION['ID'], $db_conn);
              if (empty($attrezzatureID)){
                echo "
                <script>
                  flatAlert('', 'La ricerca non ha prodotto risultati', 'warning', '../../dashboard.php?redirect=attrezzature');
                </script>";
                return;
              }else{
                $_SESSION['searchKeyword'] = $keyword;
                $_SESSION['search'] = $attrezzatureID;
                redirect('../../dashboard.php?redirect=cercaattrezzature');
              }
              break;
            default:
              break;
          }
        }
      }
    ?>
  </body>
</html>