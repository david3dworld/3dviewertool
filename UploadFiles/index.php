<?php 
  include('constant.php');
?>
<html class="" lang="en"><head>

  <meta charset="UTF-8">
  <title>TruePlan File Upload</title>
  <meta name="robots" content="noindex">
  <link rel="shortcut icon" type="image/svg" href="<?php echo BASE_URL ?>assets/images/trueplan-main-logo-white.svg">
<link rel="stylesheet" href="<?php echo BASE_URL ?>assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo BASE_URL ?>assets/css/font-awesome.min.css">

  <style class="INLINE_PEN_STYLESHEET_ID">
    #one
{
  margin-top:50px;
 box-shadow: 0px 0px 5px 2px rgba(0,0,0,0.2);
}
.it .btn-orange
{
	background-color: transparent;
	border-color: #777!important;
	color: #777;
	text-align: left;
  width:100%;
}
.it input.form-control
{
	height: 54px;
	border:none;
  margin-bottom:0px;
	border-radius: 0px;
	border-bottom: 1px solid #ddd;
	box-shadow: none;
}
.it .form-control:focus
{
	border-color: #ff4d0d;
	box-shadow: none;
	outline: none;
}
.fileUpload {
    position: relative;
    overflow: hidden;
    margin: 10px;
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
.it .btn-new, .it .btn-next
{
	margin: 30px 0px;
	border-radius: 0px;
	background-color: #333;
	color: #f5f5f5;
	font-size: 16px;
	width: 155px;
}
.it .btn-next
{
	background-color: #ff4d0d;
	color: #fff;
}
.it .btn-check
{
  cursor:pointer;
  line-height:54px;
  color:red;
}
.it .uploadDoc
{
	margin-bottom: 20px;
}
.it .uploadDoc
{
	margin-bottom: 20px;
}
.it .btn-orange img {
    width: 30px;
}
p
{
  font-size:16px;
  text-align:center;
  margin:30px 0px;
}
.it #uploader .docErr
{
	position: absolute;
    right:auto;
    left: 10px;
    top: -56px;
    padding: 10px;
    font-size: 15px;
    background-color: #fff;
    color: red;
    box-shadow: 0px 0px 7px 2px rgba(0,0,0,0.2);
    display: none;
}
.it #uploader .docErr:after
{
	content: '\f0d7';
	display: inline-block;
	font-family: FontAwesome;
	font-size: 50px;
	color: #fff;
	position: absolute;
	left: 30px;
	bottom: -40px;
	text-shadow: 0px 3px 6px rgba(0,0,0,0.2);
}
  </style>


</head>

<body>
  <div class="container">
  <div class="row it">
    <div class="col-sm-offset-1 col-sm-10" id="one">
      <p>
        Create 3D Project
      </p><br>
      
      <!--row-->
      <div id="uploader">
        <div class="row uploadDoc">
          <div class="col-sm-3">
            <div class="docErr">Please upload valid file</div>
            <!--error-->
            <div class="fileUpload btn btn-orange">
              <img src="<?php echo BASE_URL ?>assets/images/logo.svg" class="icon">
              <span class="upl" id="upload">Upload 3D files Zip</span>
              <input type="file" class="upload up" id="up" accept=".zip" name="zip_file" >
            </div><!-- btn-orange -->
          </div><!-- col-3 -->
          <div class="col-sm-8">
            <input type="text" class="form-control" id="txtprojectname" name="projectname" placeholder="Project Name">
          </div>
          <!--col-8-->
          <div class="col-sm-1"><a class="btn-check"><i class="fa fa-times"></i></a></div><!-- col-1 -->
        </div>
        <!--row-->
      </div>
      <!--uploader-->
      <div class="text-center">
		<a class="btn btn-next" id="btnupload"><i class="fa fa-paper-plane"></i> Create Project</a>
    <a href="getlink.php" class="btn btn-next"><i class="fa fa-paper-plane"></i> Go to Getlink</a>
    <a href="delete.php" class="btn btn-next"><i class="fa fa-paper-plane"></i> Delete project</a>
        <!--<a class="btn btn-new"><i class="fa fa-trash"></i> Clear</a> -->
      </div>
    </div>
    <!--one-->
  </div><!-- row -->
</div><!-- container -->
<script src="<?php echo BASE_URL ?>/assets/js/jquery.min.js"></script>
<script src="<?php echo BASE_URL ?>/assets/js/bootstrap.min.js"></script>
<script>

$(document).ready(function(){
   
   $(document).on('change','.up', function(){
   	var id = $(this).attr('id'); /* gets the filepath and filename from the input */
	   var profilePicValue = $(this).val();
	   var fileNameStart = profilePicValue.lastIndexOf('\\'); /* finds the end of the filepath */
	   profilePicValue = profilePicValue.substr(fileNameStart + 1).substring(0,20); /* isolates the filename */
	   //var profilePicLabelText = $(".upl"); /* finds the label text */
	   if (profilePicValue != '') {
	   	//console.log($(this).closest('.fileUpload').find('.upl').length);
	      $(this).closest('.fileUpload').find('.upl').html(profilePicValue); /* changes the label text */
	   }
   });
   
   $(".btn-check").on('click',function(){
	   $("#txtprojectname").val('');
   });
	$("#btnupload").on('click',function(){

    if($("#txtprojectname").val()=='')
    {
		  alert('Please enter project name.');
      return;
    }
    $("#btnupload").html('<i class="fa fa-spin fa-circle-o-notch"></i> Create Project');
    var file_data = $('#up').prop('files')[0];   
		var form_data = new FormData();                  
		form_data.append('file', file_data);
		form_data.append('projectname', $("#txtprojectname").val());
		$.ajax({
			url: '<?php echo BASE_URL ?>/upload.php', // point to server-side PHP script 
			dataType: 'text',  // what to expect back from the PHP script, if anything
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,                         
			type: 'post',
			success: function(data){
				alert(data); //display response from the PHP script, if any
        $("#btnupload").html('<i class="fa fa-paper-plane"></i> Create Project');
			}
		 });
	});
   // $(".btn-new").on('click',function(){
        // $("#uploader").append('<div class="row uploadDoc"><div class="col-sm-3"><div class="docErr">Please upload valid file</div><!--error--><div class="fileUpload btn btn-orange"> <img src="https://image.flaticon.com/icons/svg/136/136549.svg" class="icon"><span class="upl" id="upload">Upload document</span><input type="file" class="upload up" id="up" onchange="readURL(this);" /></div></div><div class="col-sm-8"><input type="text" class="form-control" name="" placeholder="Note"></div><div class="col-sm-1"><a class="btn-check"><i class="fa fa-times"></i></a></div></div>');
   // });
    
   // $(document).on("click", "a.btn-check" , function() {
     // if($(".uploadDoc").length>1){
        // $(this).closest(".uploadDoc").remove();
      // }else{
        // alert("You have to upload at least one document.");
      // } 
   // });
});
</script>
</body></html>