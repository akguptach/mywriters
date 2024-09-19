<div class="footer">
    <div class="copyright">
        <p>Copyright © Designed &amp; Developed by <a href="http://dexignlab.com/" target="_blank">DexignLab</a> 2023
        </p>
    </div>
</div>


<script src="{{env('APP_URL')}}/vendor/global/global.min.js"></script>
	<script src="{{env('APP_URL')}}/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	
	<!-- Datatable -->
    <script src="{{env('APP_URL')}}/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{env('APP_URL')}}/js/plugins-init/datatables.init.js"></script>
	
    <!-- Svganimation scripts -->
    <script src="{{env('APP_URL')}}/vendor/svganimation/vivus.min.js"></script>
    <script src="{{env('APP_URL')}}/vendor/svganimation/svg.animation.js"></script>

    <script src="{{env('APP_URL')}}/js/custom.min.js"></script>
    <script src="{{env('APP_URL')}}/js/dlabnav-init.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <style> 
.direct-chat-text::selection {
  background: #e74c3c;
}
.direct-chat-text a::selection {
  background: #e74c3c;
}
.download-attachment{
  cursor: pointer;
}
</style>
<script> 

function downloadFromUrl(url){
  window.open(
  url,
  '_blank' // <- This is what makes it open in a new window.
);
}
function ltrim(str) {
  if(!str) return str;
    str = str.replace(/(\r\n|\n|\r)/gm, "");
   str = str.replace(/^\s+/g, '');
   alert('--'+str+'___');
   return str;
}
$(document).ready(function(){
    $( ".direct-chat-text" ).find('a').removeAttr('href')
});
$( ".direct-chat-text" ).on( "dblclick", function(e) {
    var span = e.target;
    window.getSelection().selectAllChildren(e.target);
    document.execCommand("copy");
});
</script>
    
    