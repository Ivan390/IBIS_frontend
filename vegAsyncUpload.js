   	$(function(){
  /*
   * For the sake keeping the code clean and the examples simple this file
   * contains only the plugin configuration & callbacks.
   * 
   * UI functions ui_* can be located in: demo-ui.js
   */
  $('#drag-and-drop-zone').dmUploader({ //
    url: '../../cgi-bin/IBISnewVegetables.php3',
    maxFileSize: 10000000, // 10 Megs 
    onDragEnter: function(){
      // Happens when dragging something over the DnD area
      this.addClass('active');
    },
    extraData: function() {
   // var formData = $("#gdtestF").serialize();
   var Akingdom = 'Plantae';
   var phylum = $("#Phylum").val();
		var Vclass = $("#Class").val();
		var subClass = $("#subClass").val();
		var order = $("#Order").val();
		var subOrder = $("#subOrder").val();
		var family = $("#Family").val();
		var subFamily = $("#subFamily").val();
		var genus = $("#Genus").val();
		var subGenus = $("#subGenus").val();
		var species = $("#Species").val();
		var subSpecies = $("#subSpecies").val();
		var common_Names = $("#Common_Names").val();
		var reftit = $("#refTit").val();
		var pgNumber = $("#pgnum").val();
		var name_Notes = $("#Name_Notes").val();
		var status = $("#Status").val();
		var description = $("#Description").val();
		var ecology = $("#Ecology").val();
		var habits = $("#Habits").val();
		var distrib_Notes = $("#Distrib_Notes").val();
		var img_Tags = $("#Image_Tags").val();
		var contributer_ID = $("#contrib_ID").val();
		var thecat = $("#thecatid").val();
		var uses = $("#Uses").val();
		var category = $("#Category").val();
		var growing = $("#Growing").val();
		var acclvl = $("#acclevel").val();
      return {
      	 "Akingdom": Akingdom,
        "phylum": phylum,
        "class" : Vclass,
        "subClass" : subClass,
        "order" : order,
        "subOrder": subOrder,
        "family" : family,
        "subFamily" : subFamily,
        "genus" : genus,
        "subGenus" : subGenus,
        "species" : species,
        "subSpecies" : subSpecies,
        "common_Names" : common_Names,
        "reftit" : reftit,
        "pgNumber" : pgNumber,
        "name_Notes" : name_Notes,
        "status" : status,
        "description" : description,
        "ecology" : ecology,
        "habits" : habits,
        "distrib_Notes" : distrib_Notes,
        "imgtag" : img_Tags,
        "contributer_ID" : contributer_ID,
        "thecat" :thecat,
        "uses" : uses,
        "category" : category,
        "growing" : growing,
        "acclvl" : acclvl 
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
