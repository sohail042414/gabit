<style type="text/css">
@font-face {
  font-family: 'Calibri';
  src: url('../fonts/Calibri.eot?#iefix') format('embedded-opentype'),
       url('../fonts/Calibri.woff') format('woff'),
    url('../fonts/Calibri.ttf')  format('truetype'),
    url('../fonts/Calibri.svg#Calibri') format('svg');
  font-weight: normal;
  font-style: normal;
}
h1,h2,h3,h4,h5,h6{
	display:inline-block;
		color:#464646;
}

body {
	font-family:Arial, Helvetica, sans-serif;
	/*background:url(../images/index1.jpg) top center no-repeat;
	opacity:0.3;*/
	color:#464646;
	font-size:12px;
}

.note-item{
    width: 100%;
    height: 100%;
    background-image: url(<?php echo $popup_image; ?>);
    background-size:     cover; 
    background-repeat:   no-repeat;
    background-position: center center; 
}

</style>

<div id="sing-up">
    <div class="main_banner" xmlns="http://www.w3.org/1999/html">
        <div class="inner-container">
            <?php if(!empty($popup_url)){ ?>
                <a href="<?php echo $popup_url; ?>" target="_blank">
                    <div class="inner-page note-item">                
                    </div>
                </a>
            <?php }else{ ?>
                <div class="inner-page note-item">                
                </div>
            <?php } ?>
        </div>
    </div>
</div>
