<?php
/**
 * @version    1.0.0
 * @package    SPEDI Facebook Album Button
 * @author     SPEDI srl - http://www.spedi.it
 * @copyright  Copyright (c) Spedi srl.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

  define( '_JEXEC', 1 );
  define( 'DS', DIRECTORY_SEPARATOR );
  define( 'JPATH_BASE', realpath( '..'.DS.'..'.DS.'..'.DS ) );
  require_once ( JPATH_BASE.DS.'includes'.DS.'defines.php' );
  require_once ( JPATH_BASE.DS.'includes'.DS.'framework.php' );

  $mainframe = JFactory::getApplication('administrator');
  jimport( 'joomla.plugin.plugin' );
  $ih_name = addslashes( $_GET['ih_name'] );
 ?>
 <html>
  <head>
    <title><?php echo JText::_('Article Gallery - (by SPEDI srl)') ?></title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="dist/style.min.css" />
   <script type="text/javascript">
    function InsertHtmlDialogokClick() {
      var album_id = document.getElementById("album_id").value;
      if (album_id != '') {
        album_id = "album_id="+album_id;
      }
      var tmpl = document.getElementById("tmpl").value;
      if (tmpl != '') {
        tmpl = "|tmpl="+tmpl;
      }
      var limit = document.getElementById("limit").value;
      if (limit != '') {
        limit = "|limit="+limit;
      }
      var hSlider = document.getElementById("hSlider").value;
      if (hSlider != '') {
        hSlider = "|hSlider="+hSlider;
      } else{
        hSlider = "";
      }
      var album_link = document.getElementById("album_link").value;
      if (album_link != '') {
        album_link = "|album_link="+album_link;
      } else{
        album_link = "";
      }
      var col = document.forms.phGalleryForm.col.value;
      if(tmpl == 'thumb_slider')
        col = "";
      else
        col = "|col="+col;

      var tag = "{facebookalbum "+album_id+tmpl+limit+hSlider+col+album_link+"}";

      window.parent.jInsertEditorText(tag, '<?php echo $ih_name ?>');
      window.parent.jModalClose();
     }

     function InsertHtmlDialogcancelClick() {
       window.parent.jModalClose();
     }

     // funzione che testa i cambiamenti di template della galleria
     function onChangeTmpl(){
      var theme = document.getElementById("tmpl").value;
      if(theme != 'thumb_slider'){
        document.getElementById("height-slider").style.display = 'none';
        document.getElementById("hSlider").value = "";
      }
      else
        document.getElementById("height-slider").style.display = 'table-row';

      if(theme == 'thumb_slider'){
        document.getElementById("col-num").style.display = 'none';
        document.getElementById("col").value = "";
      }
      else
        document.getElementById("col-num").style.display = 'table-row';

     }
   </script>

   <style media="screen">
     @import url('https://fonts.googleapis.com/css?family=Titillium+Web:,400,400i,600');
     table{
       font-family: 'Titillium Web', sans-serif;
     }
     td{
       vertical-align: middle !important;
     }
     fieldset{
       border: 0 !important;
     }
    .btn{
      cursor: pointer;
    }

   </style>
   </head>
   <body>
     <form name="phGalleryForm" onSubmit="return false;">
       <fieldset>
         <table class="table">
           <tr>
             <td><label for="album_id" class="col-form-label">Facebook Album ID</label></td>
             <td>
               <input type="text" class="form-control form-control-sm" id="album_id" name="album_id">
             </td>
           </tr>
           <tr>
             <td><label for="tmpl" class="col-form-label">Seleziona il template</label></td>
             <td>
               <select name="tmpl" id="tmpl" class="input form-control form-control-sm" onchange="onChangeTmpl()">
                 <option value="thumb_slider">Slider</option>
                 <option value="grid">Griglia</option>
                 <option value="masonry">Griglia fluida</option>
                 <option value="grid_fluid">Griglia fluida 2</option>
               </select>
             </td>
           </tr>
           <tr>
             <td colspan="2">
                <div class="alert alert-info" role="alert">
                  <p style="margin-bottom:0; margin-top:0;"><strong>Slider: </strong>produce una slider con miniature scorrevoli.</p>
                  <p style="margin-bottom:0; margin-top:0;"><strong>Griglia: </strong>produce una griglia con immagini tutte a dimensione fissa.</p>
                  <p style="margin-bottom:0; margin-top:0;"><strong>Griglia fluida: </strong>produce una griglia con immagini a dimensione automatica.</p>
                </div>
             </td>
           </tr>
           <tr id="image-limit">
             <td><label for="limit" class="col-form-label">Numero massimo di immagini</label></td>
             <td>
               <input type="number" class="form-control form-control-sm" id="limit" name="limit" value="10">
             </td>
           </tr>
           <tr id="height-slider">
             <td><label for="hSlider" class="col-form-label">Altezza immagini</label></td>
             <td>
               <input type="text" class="form-control form-control-sm" id="hSlider" name="hSlider" value="400">
             </td>
           </tr>
           <tr id="col-num" style="display: none;">
             <td><label for="col" class="col-form-label">Immagini per riga</label></td>
             <td>
               <select name="col" id="col" class="input form-control form-control-sm">
                 <option value="6">2</option>
                 <option value="4">3</option>
                 <option value="3">4</option>
                 <option value="2">6</option>
               </select>
             </td>
           </tr>
           <tr>
             <td><label for="album_link" class="col-form-label">Album link</label></td>
             <td>
               <input type="text" class="form-control form-control-sm" id="album_link" name="album_link">
             </td>
           </tr>
           <!-- <tr>
             <td><label for="cat-link" class="col-form-label">Link alla categoria</label></td>
             <td>
               <div class="form-check">
                 <input class="form-check-input" type="radio" name="catLink" id="cat-link-1" value="1" checked="true">
                 <label class="form-check-label" for="cat-link-1">Si</label>
               </div>
               <div class="form-check">
                 <input class="form-check-input" type="radio" name="catLink" id="cat-link-0" value="0">
                 <label class="form-check-label" for="cat-link-0">No</label>
               </div>
             </td>
           </tr> -->
         </table>
       </fieldset>
       <fieldset>
         <table class="table">
           <tr>
             <td>
               <input type="submit" class="btn btn-primary" value="<?= JText::_('Inserisci il codice') ?>" onClick="InsertHtmlDialogokClick()">
               <input type="button" class="btn btn-secondary" value="<?= JText::_('Annulla') ?>" onClick="InsertHtmlDialogcancelClick()">
             </td>
           </tr>
         </table>
       </fieldset>

     </form>
   </body>
 </html>
