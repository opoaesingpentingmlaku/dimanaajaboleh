<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/jquery.fileupload-ui.css">
<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap-image-gallery.min.css">
<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap-responsive.min.css">
<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap.min.css">
<noscript><link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/jquery.fileupload-ui-noscript.css"></noscript>

<form id="fileupload" action="<?php echo Yii::app()->createUrl('/places/journal/save')?>" method="POST" enctype="multipart/form-data">
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><input type="hidden" name="redirect" value="http://blueimp.github.com/jQuery-File-Upload/"></noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="span7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="icon-plus icon-white"></i>
                    <span>Add files...</span>
                    <input type="file" name="files[]" multiple>
                </span>
                <button type="submit" class="btn btn-primary start">
                    <i class="icon-upload icon-white"></i>
                    <span>Start upload</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="icon-ban-circle icon-white"></i>
                    <span>Cancel upload</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="icon-trash icon-white"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" class="toggle">
            </div>
            <!-- The global progress information -->
            <div class="span5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="bar" style="width:0%;"></div>
                </div>
                <!-- The extended global progress information -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The loading indicator is shown during file processing -->
        <div class="fileupload-loading"></div>
        <br>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody></table>
    </form>
	
	<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td class="preview"><span class="fade"></span></td>
        <td class="name"><span>{%=file.name%}</span></td>
        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        {% if (file.error) { %}
            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        {% } else if (o.files.valid && !i) { %}
            <td>
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
            </td>
            <td>{% if (!o.options.autoUpload) { %}
                <button class="btn btn-primary start">
                    <i class="icon-upload icon-white"></i>
                    <span>Start</span>
                </button>
            {% } %}</td>
        {% } else { %}
            <td colspan="2"></td>
        {% } %}
        <td>{% if (!i) { %}
            <button class="btn btn-warning cancel">
                <i class="icon-ban-circle icon-white"></i>
                <span>Cancel</span>
            </button>
        {% } %}</td>
    </tr>
{% } %}
</script>

<!-- The template to display files available for download -->
<!--script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++){ %}
    <tr class="template-download fade">
        {% if (file.error){  %}
            <td></td>
            <td class="name"><span>{%=file.name%}</span></td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        {% } else { %}
            <td class="preview">{% if (file.thumbnail_url) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>
            {% } %}</td>
            <td class="name">
                <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
            </td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td colspan="2"></td>
        {% } %}
        <td>
			<input type="button" name="insert[]" multiple onclick="insert_img('{%=file.url%}')" value="ADD">
			<button class="btn btn-danger delete" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                <i class="icon-trash icon-white"></i>
                <span>Delete</span>
            </button>
            <input type="checkbox" name="delete" value="1" class="toggle">
        </td>
    </tr>
{% } %}
</script-->

<span id="ids" style="display:none;"></span>
<div id="template-download">
	<ul id="result">
	</ul>
</div>

<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/tiny_mce/tiny_mce.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="<?php echo Yii::app()->baseUrl; ?>/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="<?php echo Yii::app()->baseUrl; ?>/js/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="<?php echo Yii::app()->baseUrl; ?>/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS and Bootstrap Image Gallery are not required, but included for the demo -->
<script src="<?php echo Yii::app()->baseUrl; ?>/js/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/js/bootstrap-image-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.fileupload.js"></script>
<!-- The File Upload file processing plugin -->
<script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.fileupload-fp.js"></script>
<!-- The File Upload user interface plugin -->
<script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<!--script src="<?php //echo Yii::app()->baseUrl; ?>/js/main.js"></script-->
<script language="javascript" type="text/javascript">

function del_img(id){
	$.ajax({
	  type: "POST",
	  url: 'delete/',
	  data: {fid : id},
	  success: function(data){
					$('#item_'+id).remove();
				}
	});
}

function saveImg(){
	var ids = $('#ids').text();
	$.post('updatefiles/', {data : ids});
}

$(function(){
	$('#fileupload').fileupload({
		url: 'upload/',
		dataType: 'json',
		complete: function (result) {
			console.log(result);
			var res = $.parseJSON(result.responseText);
			$.each(res.files, function (index, file) {
				$.ajax({
				  type: "POST",
				  url: 'savefiletodb/',
				  data: {filename : file.name, filetype : file.type, filesize : file.size},
				  success: function(data){
								$('#template-download').append(data);
							}
				});
			});
        }
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
    });
});
</script>