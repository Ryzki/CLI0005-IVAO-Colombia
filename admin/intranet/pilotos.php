 <?php $source = file_get_contents("https://www.ivao.aero/members/person/country.asp?Id=CO"); if ( preg_match('|<div class="col-md-8 col-md-offset-2">|is',$source,$cap) ){        echo $cap[1];}?>