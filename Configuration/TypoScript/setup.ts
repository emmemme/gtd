
plugin.tx_gtd_frontendgtd {
  view {
    templateRootPaths.0 = EXT:gtd/Resources/Private/Templates/
    templateRootPaths.1 = {$plugin.tx_gtd_frontendgtd.view.templateRootPath}
    partialRootPaths.0 = EXT:gtd/Resources/Private/Partials/
    partialRootPaths.1 = {$plugin.tx_gtd_frontendgtd.view.partialRootPath}
    layoutRootPaths.0 = EXT:gtd/Resources/Private/Layouts/
    layoutRootPaths.1 = {$plugin.tx_gtd_frontendgtd.view.layoutRootPath}
  }
  persistence {
    storagePid = {$plugin.tx_gtd_frontendgtd.persistence.storagePid}
  }
  features {
    #skipDefaultArguments = 1
  }
  mvc {
    #callDefaultActionIfActionCantBeResolved = 1
  }
}

plugin.tx_gtd._CSS_DEFAULT_STYLE (
    textarea.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    input.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    #tx-gtd .typo3-messages .message-error {
        color:red;
    }

    #tx-gtd .typo3-messages .message-ok {
        color:green;
    }

    #tx-gtd .nav > li > a {
        padding: 5px 10px !important;
    }

    #tx-gtd hr {
      margin-top: 10px !important;
      margin-bottom: 10px !important;
    }
)

page.includeCSS.file1 = EXT:gtd/Resources/Public/Css/jquery-ui.css

page.includeJSFooterlibs.jqueryui = http://code.jquery.com/ui/1.11.4/jquery-ui.js
page.includeJSFooterlibs.jqueryui.external = 1

page.jsInline.999 = TEXT
page.jsInline.999.value (
    $(window).load( function() {
      $( ".dataDetailListTitle").draggable({ cursor: "crosshair", revert: "invalid"  });
      $( ".categoryNode" ).draggable({ cursor: "crosshair", revert: "invalid"  });
      $( ".categoryNode" ).droppable({
          drop: function( event, ui ) {
              var selfId = ("" + $( this ).attr("id")).split("_")[1];
              var draggableId = "" +ui.draggable.attr("id").split("_")[1];
              var draggableType = ""+ui.draggable.attr("id").split("_")[0];
              var rootUrl = $(location).attr('pathname');
              var html4move = "";
              if(draggableType == "dataDetail" || draggableType == "dataDetailProject"){
                  rootUrl = rootUrl + "?tx_gtd_frontendgtd[action]=moveTask";
                  html4move = rootUrl + '&tx_gtd_frontendgtd[srcTask]=' + draggableId + '&tx_gtd_frontendgtd[targetProject]=' + selfId+'&tx_gtd_frontendgtd[controller]=Project';
              } else {
                  rootUrl = rootUrl + "?tx_gtd_frontendgtd[action]=moveProject";
                  html4move = rootUrl + '&tx_gtd_frontendgtd[srcProject]=' + draggableId + '&tx_gtd_frontendgtd[targetProject]=' + selfId+'&tx_gtd_frontendgtd[controller]=Project';
              }
              window.location.replace(html4move);
          }
      });
      $( ".dataDetailListTitle" ).droppable({
          drop: function( event, ui ) {
              var selfId = ("" + $( this ).attr("id")).split("_")[1];
              var draggableId = "" +ui.draggable.attr("id").split("_")[1];
              var draggableType = ""+ui.draggable.attr("id").split("_")[0];
              var rootUrl = $(location).attr('pathname');
              if(draggableType == "dataDetail") {
                  rootUrl = rootUrl + "?tx_gtd_frontendgtd[action]=moveTaskOrder";
              } else if(draggableType == "dataDetailProject") {
                  rootUrl = rootUrl + "?tx_gtd_frontendgtd[action]=moveTaskOrderInsideProject";
              }
              var html4move = rootUrl + '&tx_gtd_frontendgtd[srcTask]=' + draggableId + '&tx_gtd_frontendgtd[targetTask]=' + selfId+'&tx_gtd_frontendgtd[controller]=Task';
              window.location.replace(html4move);
          }
      });
      $("#focus_inbox").droppable({
          drop: function( event, ui ) {
              var selfId = ("" + $( this ).attr("id")).split("_")[1];
              var draggableId = "" +ui.draggable.attr("id").split("_")[1];
              var draggableType = ""+ui.draggable.attr("id").split("_")[0];
              var rootUrl = $(location).attr('pathname');
              if(draggableType == "dataDetail" || draggableType == "dataDetailProject"){
                  var html4move = rootUrl+"?tx_gtd_frontendgtd[task]="+draggableId+"&tx_gtd_frontendgtd[action]=moveToInbox&tx_gtd_frontendgtd[controller]=Task";
                  window.location.replace(html4move);
              }
          }
      });
      $("#focus_today").droppable({
          drop: function( event, ui ) {
              var selfId = ("" + $( this ).attr("id")).split("_")[1];
              var draggableId = "" +ui.draggable.attr("id").split("_")[1];
              var draggableType = ""+ui.draggable.attr("id").split("_")[0];
              var rootUrl = $(location).attr('pathname');
              if(draggableType == "dataDetail" || draggableType == "dataDetailProject"){
                  var html4move = rootUrl+"?tx_gtd_frontendgtd[task]="+draggableId+"&tx_gtd_frontendgtd[action]=moveToToday&tx_gtd_frontendgtd[controller]=Task";
                  window.location.replace(html4move);
              }
          }
      });
      $("#focus_next").droppable({
          drop: function( event, ui ) {
              var selfId = ("" + $( this ).attr("id")).split("_")[1];
              var draggableId = "" +ui.draggable.attr("id").split("_")[1];
              var draggableType = ""+ui.draggable.attr("id").split("_")[0];
              var rootUrl = $(location).attr('pathname');
              if(draggableType == "dataDetail" || draggableType == "dataDetailProject"){
                  var html4move = rootUrl+"?tx_gtd_frontendgtd[task]="+draggableId+"&tx_gtd_frontendgtd[action]=moveToNext&tx_gtd_frontendgtd[controller]=Task";
                  window.location.replace(html4move);
              }
          }
      });
      $("#focus_waiting").droppable({
          drop: function( event, ui ) {
              var selfId = ("" + $( this ).attr("id")).split("_")[1];
              var draggableId = "" +ui.draggable.attr("id").split("_")[1];
              var draggableType = ""+ui.draggable.attr("id").split("_")[0];
              var rootUrl = $(location).attr('pathname');
              if(draggableType == "dataDetail" || draggableType == "dataDetailProject"){
                  var html4move = rootUrl+"?tx_gtd_frontendgtd[task]="+draggableId+"&tx_gtd_frontendgtd[action]=moveToWaiting&tx_gtd_frontendgtd[controller]=Task";
                  window.location.replace(html4move);
              }
          }
      });
      $("#focus_someday").droppable({
          drop: function( event, ui ) {
              var selfId = ("" + $( this ).attr("id")).split("_")[1];
              var draggableId = "" +ui.draggable.attr("id").split("_")[1];
              var draggableType = ""+ui.draggable.attr("id").split("_")[0];
              var rootUrl = $(location).attr('pathname');
              if(draggableType == "dataDetail" || draggableType == "dataDetailProject"){
                  var html4move = rootUrl+"?tx_gtd_frontendgtd[task]="+draggableId+"&tx_gtd_frontendgtd[action]=moveToSomeday&tx_gtd_frontendgtd[controller]=Task";
                  window.location.replace(html4move);
              }
          }
      });
      $("#focus_completed").droppable({
          drop: function( event, ui ) {
              var selfId = ("" + $( this ).attr("id")).split("_")[1];
              var draggableId = "" +ui.draggable.attr("id").split("_")[1];
              var draggableType = ""+ui.draggable.attr("id").split("_")[0];
              var rootUrl = $(location).attr('pathname');
              if(draggableType == "dataDetail" || draggableType == "dataDetailProject"){
                  var html4move = rootUrl+"?tx_gtd_frontendgtd[task]="+draggableId+"&tx_gtd_frontendgtd[action]=moveToCompleted&tx_gtd_frontendgtd[controller]=Task";
                  window.location.replace(html4move);
              }
          }
      });
      $("#focus_trash").droppable({
          drop: function( event, ui ) {
              var selfId = ("" + $( this ).attr("id")).split("_")[1];
              var draggableId = "" +ui.draggable.attr("id").split("_")[1];
              var draggableType = ""+ui.draggable.attr("id").split("_")[0];
              var rootUrl = $(location).attr('pathname');
              if(draggableType == "dataDetail" || draggableType == "dataDetailProject"){
                  var html4move = rootUrl+"?tx_gtd_frontendgtd[task]="+draggableId+"&tx_gtd_frontendgtd[action]=moveToTrash&tx_gtd_frontendgtd[controller]=Task";
                  window.location.replace(html4move);
              }
          }
      });
      $("#taskDueDate ").datepicker({
          dateFormat: 'yy-mm-dd',
          constrainInput: false
      });
  });
)
