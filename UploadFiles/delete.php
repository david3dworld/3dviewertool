<?php 
include('constant.php');

$project_dir_path= dirname(__FILE__).'/Projects/';

$dir_list=scandir($project_dir_path);
unset($dir_list[0]);
unset($dir_list[1]);
?>
<html class="" lang="en"><head>

  <meta charset="UTF-8">
  <title>Trueplan delete</title>
  <meta name="robots" content="noindex">
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL ?>assets/images/trueplan-main-logo-white.svg">
  <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/css/select2.min.css">
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
        Delete 3D Project
      </p><br>
      <div class="row">
        <div class="col-sm-offset-4 col-sm-4 form-group">
          <h3 class="text-center"></h3>
        </div>
        <!--form-group-->
      </div>
      <!--row-->
      <div id="uploader">
        <div class="row uploadDoc">
          <div class="col-sm-6">
            <label>Select Project :</label>
            <Select type="text" class="form-control select2" id="ddlProjectname">
              <?php 
              foreach ($dir_list as $key => $value) {
                echo "<option> ".$value."</option>";
              }
            ?>
            </Select>
          </div><!-- col-3 -->
          <div class="col-sm-8">
              <a class="btn btn-new" id="btndelete"><i class="fa fa-trash"></i> Delete</a>
          </div>
        </div>
      </div>
    </div>
  </div><!-- row -->
</div><!-- container -->
<script src="<?php echo BASE_URL ?>/assets/js/jquery.min.js"></script>
<script src="<?php echo BASE_URL ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo BASE_URL ?>/assets/js/select2.min.js"></script>
<script>

$(document).ready(function(){
  $(".select2").select2();
  $("#btndelete").on('click',function(){
    if($("#ddlProjectname").val()!='' && confirm('Are you sure you want to delete selected project?')){
      $("#btndelete").html('<i class="fa fa-spin fa-circle-o-notch"></i> Delete');
      $.ajax({
        url: '<?php echo BASE_URL ?>/deletproject.php', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        //processData: false,
        data: {pname: $("#ddlProjectname").val()},                         
        type: 'get',
        success: function(data){
          alert(data); //display response from the PHP script, if any
          $("#btndelete").html('<i class="fa fa-trash"></i> Delete');
        }
       });
    }
    
  });
});
</script>
</body></html>