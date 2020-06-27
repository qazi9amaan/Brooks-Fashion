<?php
session_start();
require_once '/var/www/html/admin/config/config.php';
require_once '/var/www/html/associates/includes/auth_validate.php';
?>

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<body class="bg-secondary">
<style>

.wrapper{
  
  width:100%;
  height:100%;
  display:flex;
  align-items:center;
  justify-content:center;
  
}
.wrapper .file-upload{

    height:200px;
    width:200px;
    border-radius: 100px;
    position:relative;
    display:flex;
    justify-content:center;
    align-items: center;  
    border:4px solid #FFFFFF;
    overflow:hidden;
    background-image: linear-gradient(to bottom, #28a745 50%, #FFFFFF 50%);
    background-size: 100% 200%;
    transition: all 1s;
    color: #FFFFFF;
    font-size:100px;
  }
  .wrapper input[type='file']{

      height:200px;
      width:200px;
      position:absolute;
      top:0;
      left:0;
      opacity:0;
      cursor:pointer;

    }

.file-upload:hover{

      background-position: 0 -100%;
      border:4px solid #28a745;
      color:#28a745;

    }


 

</style>    
<div class="container ">
    <div class="col-md-12">
        <div class="card bg-white shadow mt-5">
            <div class="card-header  bg-white text-dark  text-uppercase text-center"> UPLOADING IMAGES FOR <?php echo @$_GET['name'] ?> 
            <div class="progress mt-2">
                    <div class="progress-bar bg-success"></div>
                </div>
            
            </div>
            <div class="card-body">
           
                <div class="px-2">
                <form id="uploadForm" class="text-center" enctype="multipart/form-data">
                            <input type="text" hidden name="id" value="<?php echo @$_GET['id']; ?>">

                    <div class="input-group mb-1">
                            
                    <div class="wrapper mt-5 py-2">
                                <div class="file-upload">
                                    <input  class="" multiple name="files[]" id="fileInput"  type="file" />
                                   <div id='label-file'>  <i class="fa fa-arrow-up"></i> </div>
                                </div>
                            </div>
                            <span id="help" class="help-block text-dark lead text-center mx-auto font-weight-light">Please select the pictures for the product, click on arrow.</span>

                    </div>
                    
                    <input type="submit" name="submit" class="btn btn-success btn-lg text-center mx-auto mt-3" value="Upload pictures"/>
                </form>
                <div id="uploadStatus" class="px-2"></div>
                </div>
            </div>
                
                  
           
    </div>
</div>



</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
    // File upload via Ajax
    $("#uploadForm").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $(".progress-bar").width(percentComplete + '%');
                        $(".progress-bar").html(percentComplete+'%');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: 'upload.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $(".progress-bar").width('0%');
                $('#uploadStatus').html('<img src="images/loading.gif"/>');
            },
            error:function(){
                $('#uploadStatus').html('<div class="alert alert-info m-2" role="alert"> File upload failed, please try again </div>');
            },
            success: function(resp){
                if(resp == 'ok'){
                    $('#uploadForm')[0].reset();

                    $('#uploadStatus').html('<div class="alert text-center alert-success m-2" role="alert"><p> Files have been uploaded successfully! </p> <a href="../products.php" class="btn btn-success text-center ">Show Product</a> </div> ');
                }else if(resp == 'err'){
                    $('#uploadStatus').html('<div class="alert alert-danger m-2" role="alert"> Please select a valid file to upload. </div>');
                    $(".progress-bar").width('0%');

                }
            }
        });
    });
	
    // File type validation
    $("#fileInput").change(function(){
        var allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        var file = this.files[0];
        var fileType = file.type;
    
    	if(this.files.length>3){
        	 alert('Maximun 3 allowed!');
            $("#fileInput").val('');
            return false;
        }
        if(!allowedTypes.includes(fileType)){
            alert('Please select a valid file (PDF/DOC/DOCX/JPEG/JPG/PNG/GIF).');
            $("#fileInput").val('');
            return false;
        }else{
        $('#label-file').html(this.files.length);
        $('#help').html('Selection, please upload now')
        }
    });
});
</script>
</html>

