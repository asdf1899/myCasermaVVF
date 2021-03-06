<?php
  if (!isset($_SESSION['search']) or empty($_SESSION['search'])){
    redirect('dashboard.php?redirect=mezzi');
  }
?>
<div style="text-align:center">
  <h2 class="mdl-color-text--grey-800">Mezzi</h2>
  <button class="style-button-red" onclick="location.href='dashboard.php?redirect=mezzi' ">INDIETRO</button>
</div>
<div>
  <form action="app/controllers/search.php" method="POST" style="text-align:center">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:40%;">
      <input class="mdl-textfield__input" 
              style="border-bottom:1px solid #c5003e;color:grey" 
              type="text" 
              id="find" 
              name="find"
              value="<?php echo $_SESSION['searchKeyword'] ?>"
              required="">
      <label class="mdl-textfield__label" for="find">Cerca</label>
    </div>
    <button id="btn-search" 
            name="submit"
            type="submit" 
            value="mezzi"
            class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect style-text-red">
      <i class="material-icons style-text-darkRed">search</i>
    </button>
  </form>
</div>
<div style="text-align:center">
  <h5>Risultati relativi alla ricerca <i>"<?php echo $_SESSION['searchKeyword'] ?> "</i></h5>
</div>
<div style="overflow:auto">
  <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:95%;margin:10px">
    <thead>
      <tr style="text-align:left">
        <th class="style-td">Mezzo</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
        $mezziID = $_SESSION['search'];
        for ($i=0;$i<count($mezziID);$i++){
          $checkingExists = true;
          $mezzo = getMezzi($mezziID[$i][0], null, $db_conn);
          if (!empty($mezzo)){
            echo '<tr>
            <td class="style-td">'.$mezzo.'</td>
            <td class="style-td"><a onclick="alertDeleteMezzo('.$mezziID[$i][0].')" style="color:red;cursor:pointer;text-decoration:underline">Elimina</a></td>
          </tr>';
          }
        }
       ?>
    </tbody>
  </table>
</div>
<div style="text-align:center">
  <?php
  if(!$checkingExists){
    echo "<h5 class='style-text-darkblue'>Nessun mezzo</h5>";
  }
  ?>
</div>
<script>
  var mezzo = '';
  function newMezzo(){
    this.mezzo =
    '<div class="mdl-card mdl-shadow--8dp" style="border-radius:20px;padding:20px;width:85%;min-height:200px;display:inline-block;margin:20px;text-align:center">'+
    '<h3>Aggiungi un mezzo</h3>'+
    '<br>'+
    '<form method="post" action="app/controllers/newMezzo.php" enctype="multipart/form-data">' +
    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">'+
    '<p class="mdl-color-text--grey-900">Mezzo</p>'+
    '<input class="mdl-textfield__input" type="text" id="mezzo" name="mezzo" style="outline:none" required="">'+
    '</div><br>'+
    '<button class="style-button-red" name="salva" id="salva" type="submit">SALVA</button>'+
    '<button class="style-button-red" name="annulla" id="annulla" type="reset" onclick=newMezzoModal.close()>ANNULLA</button>';
    newMezzoModal.open();
  }
  var newMezzoModal = new tingle.modal({
        closeMethods: ['overlay', 'button', 'escape'],
        closeLabel: "Chiudi",
        cssClass: ['custom-class-1', 'custom-class-2'],
        onOpen: function() {
            newMezzoModal.setContent(
              mezzo
            );
        },
        onClose: function() {
            console.log('modal closed');
        },
        beforeClose: function() {
            return true; // close the modal
            return false; // nothing happens
        }
    });
</script>
