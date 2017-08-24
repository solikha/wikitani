<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 
?>
<div class="col-md-12" style=" backgroun-color:#EEEEEE">
 <form method="post" action="<?php echo base_url()?>/index.php/artikel/approveArtikelFromUser">
   <div class="row">
		<div class="col-md-12">
			<div class="col-md-4">
				<input style="display:none;" value="<?php echo $artikel_id; ?>" type="text" readonly="readonly" id="artikel_id" name="artikel_id"/>
			</div>
		</div>
   </div>
   <div class="row" style="font-size:22px; font-face=Helvetica; color:#69C4F1;">Edit Konten Item
                </div>
   <div class="row" style="margin-bottom:10px; ">        
      <div class="col-md-4">
         <div class="row" >
            Kategori
         </div>
         <div class="row" style="margin-right:3px">
           
               <select class="form-control" name="kategori_nama" id="kategori_nama" readonly="readonly">
                  <?php
                     foreach ($lookup_kategori as $key => $value){
                        ?>
                  <option value="<?php echo $value["kategori_id"];  ?>"><?php echo $value["nama_kategori"]; ?></option>
                  <?php																  
                     }
                     ?>
               </select>
         </div>
      </div>
      <div class="col-md-4">
      <div class="row">Sub Kategori</div>
      <div class="row" style="margin-right:3px">
      <select class="form-control" name="subkategori_nama" id="subkategori_nama" readonly="readonly">			
                  <?php
                     foreach ($lookup_subkategori as $key => $value){
                        ?>
                  <option value="<?php echo $value["subkategori_id"];  ?>"><?php echo $value["subkategori_nama"]; ?></option>
                  <?php																  
                     }
                     ?>

      </select>
      </div>
      </div>
      <div class="col-md-4">
      <div class="row">Judul Artikel</div>
      <div class="row" stydle="margin-right:3px">
      <input type="text" class="form-control crud-param" value="<?php echo $judulartikel; ?>" readonly="readonly" placeholder="" name="judul_artikel" id="judul_artikel" style="" >
      </div>
      </div>
     
</div>

<div class="row" style="margin-bottom:10px; ">
     <div class="col-md-4">
      <div class="row">Judul Konten</div>
      <div class="row" style="margin-right:3px">
      <input type="text" class="form-control crud-param" value="<?php echo $judul_konten_artikel; ?>" readonly="readonly" placeholder="" name="judul_konten" id="judul_konten" style="" >
      </div>
      </div>
      <div class="col-md-4">
         <div class="row" >
            Penyunting
         </div>
         <div class="row" style="margin-right:3px">
           <input readonly="readonly" class="form-control crud-param" type="text" value="<?php echo $editor; ?>" name="penyunting" id="penyunting" />
         </div>
      </div>
	  
	  <div class="col-md-4">
         <div class="row" >
            Tanggal Sunting
         </div>
         <div class="row">
           <input readonly="readonly" class="form-control crud-param" type="text" value="<?php echo $tanggal_sunting; ?>" name="tanggal_sunting" id="tanggal_sunting" />
         </div>
      </div>
</div>

<div class="row">
<input type="text" name="artikel_konten_id" id="artikel_konten_id" style="display:none;" value="<?php echo $artikel_konten_id; ?>"/>
<input type="text" name="update_artikel_id" id="update_artikel_id" style="display:none;" value="<?php echo $update_artikel_id; ?>"/>
</div>
<div class="row" >
 <textarea name="editor1" id="editor1"></textarea>
</div>
<div clasms="col-md-12">
<div class="row">
<!--<div class="col-md-12">

<!-- tadinya wisiwig disini

</div>-->
<div class="widget-toolbox padding-4 clearfix">
<div class="btn-group pull-left">
<div class="btn btn-sm btn-blue">
<a href="<?php echo base_url(); ?>index.php/menu/improvement_page">
<i class="ace-icon fa fa-arrow-left bigger-125"></i>
Back
</a>
</div>
</div>
<div style="display : none;" class="btn-group pull-left">
<button class="btn btn-sm btn-info">
<i class="ace-icon fa fa-times bigger-125"></i>
Cancel
</button>
</div>
<div class="btn-group pull-left">
<button class="btn btn-sm btn-purple">
<i class="ace-icon fa fa-check-square-o"></i>
Approve
</button>
</div>
</div>
</div>
</div>
<div class="row">
        <script>

			CKEDITOR.replace( 'editor1', {
								filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
								filebrowserImageBrowseUrl: '/ckfinder/ckfinder.html?type=Images',
								filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
								filebrowserImageUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
							});					
			CKEDITOR.instances.editor1.setData(""+<?php echo $konten ?>+"");			

        </script>
</div>
</form>	

<script src='<?php echo base_url(); ?>themes/aceadmin/js/jquery.min.js'></script>
<script>
function test(){
	alert(CKEDITOR.instances.editor1.getData());
	
}
$("#editor1").change(function() {
	alert(1);
 console.log(CKEDITOR.instances.editor1.getData());
});

  $("#kategori_nama" ).change(function() {
	 var url_lookup_subkategori ="<?php echo base_url()?>"+"index.php/artikel/getLookupSubkategori";
	 //var kategori_nama="";
	   var values = $(this).serialize();
	   console.log($(this).serialize());
        $.ajax({
        url: url_lookup_subkategori,
        type: "post",
        data: values ,
        success: function (response) {
		var obj = JSON.parse(response);
          
         //console.clear();		   
           $("#subkategori_nama").empty();
			for (var i = 0; i < obj.length; i++){
             
			   $("#subkategori_nama").append("<option  value="+obj[i].subkategori_id+">"+obj[i].subkategori_nama+"</option>")
			}
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });
});

</script>
 
