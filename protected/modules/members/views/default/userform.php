<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/jquery.fileupload-ui.css">
<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap-image-gallery.min.css">
<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap-responsive.min.css">
<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap.min.css">
<noscript><link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/jquery.fileupload-ui-noscript.css"></noscript>
<span id="cont"><?=$con?></span>
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

<script language="javascript" type="text/javascript">
/*$(document).ready(function(){
	alert($('#cont').html());
});*/
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
		url: 'http://localhost/kotakjelajah/index.php/members/user/upload/',
		dataType: 'json',
		complete: function (result) {
			console.log(result);
			var res = $.parseJSON(result.responseText);
			$.each(res.files, function (index, file) {
				$.ajax({
				  type: "POST",
				  url: 'http://localhost/kotakjelajah/index.php/members/user/savefiletodb/',
				  data: {filename : file.name, filetype : file.type, filesize : file.size, container : $('#cont').html()},
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