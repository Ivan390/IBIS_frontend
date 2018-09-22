   	$(function(){
  /*
   * For the sake keeping the code clean and the examples simple this file
   * contains only the plugin configuration & callbacks.
   * 
   * UI functions ui_* can be located in: demo-ui.js
   */
  $('#drag-and-drop-zone').dmUploader({ //
    url: 'cgi-bin/IBISnewMinerals.php',
    maxFileSize: 10000000, // 10 Megs 
    onDragEnter: function(){
      // Happens when dragging something over the DnD area
      this.addClass('active');
    },
    extraData: function() {
   // var formData = $("#gdtestF").serialize();
   var Akingdom = 'Minerals';
   var Mname = $("#Name").val();
   var Mgroup = $("#Group").val();
		var crystSys = $("#Crystal_System").val();
		var Mhabit = $("#Habit").val();
		var Mchemical_Formula = $("#Chemical_Formula").val();
		var Mhardness = $("#Hardness").val();
		var Mdensity = $("#Density").val();
		var Mcleavage = $("#Cleavage").val();
		var Mfracture = $("#Fracture").val();
		var Mstreak = $("#Streak").val();
		var Mlustre = $("#Lustre").val();
		var Mfluorescence = $("#Fluorescence").val();
		var Mnotes = $("#Notes").val();
		var reftit = $("#refTit").val();
		var pgNumber = $("#pgnum").val();
		var Morigin = $("#Origin").val();
		var Mcharacteristics = $("#Characteristics").val();
		var Muses = $("#Uses").val();
		var Mdistrib = $("#Distribution").val();
		var distrib_Notes = $("#Distrib_Notes").val();
		var Mimg_Tags = $("#Image_Tags").val();
		var contributer_ID = $("#contrib_ID").val();
		var thecat = $("#thecatid").val();
		var Macclvl = $("#acclevel").val();
      return {
 				"Akingdom": Akingdom,
 				"Mname" : Mname,
        "Mgroup": Mgroup,
        "crystSys" : crystSys,
        "Mhabit" : Mhabit,
        "Mchemical_Formula" : Mchemical_Formula,
        "Mhardness": Mhardness,
        "Mdensity" : Mdensity,
        "Mcleavage" : Mcleavage,
        "Mfracture" : Mfracture,
        "Mstreak" : Mstreak,
        "Mlustre" : Mlustre,
        "Mfluorescence" : Mfluorescence,
        "Mnotes" : Mnotes,
        "reftit" : reftit,
        "pgNumber" : pgNumber,
        "Morigin" : Morigin,
        "Mcharacteristics" : Mcharacteristics,
        "Muses" : Muses,
        "Mdistrib" : Mdistrib,
        "distrib_Notes" : distrib_Notes,
        "Mimg_Tags" : Mimg_Tags,
        "contributer_ID" : contributer_ID,
        "thecat" :thecat,
        "Macclvl" : Macclvl 
      };
   },
   auto : false,
   multiple : false,
    onDragLeave: function(){
      // Happens when dragging something OUT of the DnD area
      this.removeClass('active');
    },
    onInit: function(){
      // Plugin is ready to use
      ui_add_log('Penguin initialized :)', 'info');
    },
    onComplete: function(){
      // All files in the queue are processed (success or error)
      ui_add_log('All pending tranfers finished');
    },
    onNewFile: function(id, file){
      // When a new file is added using the file selector or the DnD area
      ui_add_log('New file added #' + id);
      ui_multi_add_file(id, file);
    },
    onBeforeUpload: function(id){
      // about tho start uploading a file
      ui_add_log('Starting the upload of #' + id);
      ui_multi_update_file_status(id, 'uploading', 'Uploading...');
      ui_multi_update_file_progress(id, 0, '', true);
    },
    onUploadCanceled: function(id) {
      // Happens when a file is directly canceled by the user.
      ui_multi_update_file_status(id, 'warning', 'Canceled by User');
      ui_multi_update_file_progress(id, 0, 'warning', false);
    },
    onUploadProgress: function(id, percent){
      // Updating file progress
      ui_multi_update_file_progress(id, percent);
    },
    onUploadSuccess: function(id, data){
      // A file was successfully uploaded
      ui_add_log('Server Response for file #' + id + ': ' + JSON.stringify(data));
      $("#ajaxBox").html(data);
      $("#ajaxBox").show();
      ui_add_log('Upload of file #' + id + ' COMPLETED', 'success');
      ui_multi_update_file_status(id, 'success', 'Upload Complete');
      ui_multi_update_file_progress(id, 100, 'success', false);
    },
    onUploadError: function(id, xhr, status, message){
      ui_multi_update_file_status(id, 'danger', message);
      ui_multi_update_file_progress(id, 0, 'danger', false);  
    },
    onFallbackMode: function(){
      // When the browser doesn't support this plugin :(
      ui_add_log('Plugin cant be used here, running Fallback callback', 'danger');
    },
    onFileSizeError: function(file){
      ui_add_log('File \'' + file.name + '\' cannot be added: size excess limit', 'danger');
    }
  });
});
function sendit(){
	$("#drag-and-drop-zone").dmUploader("start");
}
function closethis(){
$("#ajaxBox").fadeOut('slow');
}
