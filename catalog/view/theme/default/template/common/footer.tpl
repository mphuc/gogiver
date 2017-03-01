<div id="footer" class="clearfix">
        <!-- Start #footer  -->
        <p class="pull-left">
            Copyrights © 2016 <a href="#" class="color-blue strong underline-effect" target="_blank">Iontach</a>. All rights reserved.
        </p>
        <p class="pull-right">
        <a href="blog.html" class="mr5 strong underline-effect">Blog</a> | 
            <a href="#" class="mr5 strong underline-effect">Terms of use</a>
            |
            <a href="#" class="ml5 mr25 strong underline-effect">Privacy police</a>
        </p>
    </div>
    <!-- End #footer  -->
</div>
<script src="catalog/view/javascript/datatables/jquery.dataTables.min.js"></script>
<script src="catalog/view/javascript/datatables/dataTables.responsive.min.js"></script>

 <script type="text/javascript">
     function openKCFinder() {
        window.KCFinder = {
            callBack: function(url) { 
                $('#thumb_image').attr('src',url);
                $('#fieldID').val(url);
                window.KCFinder = null;
                $.fancybox.close();
            }
        }; 
        }      
          /*fancybox*/
    $('.iframe-btn').fancybox({
        'type': 'iframe',
        fitToView: false,
        autoSize: false,
        autoDimensions: false,
        width: '95%',
        height: '95%',
    });

    $('.close_thumb_image').click(function(e) {
        e.stopPropagation();
        $('#thumb_image').attr('src', dataadmin_url + 'img/notFound.png');
        $('#fieldID').val('');
        return false;
    })
    $('body').on('click', '.fancybox', function() {
        return false;
    })
    $('#fieldID').keyup(function() {
        $('#thumb_image').attr('src', $('#fieldID').val());
    })
    /*fancybox*/
 </script>
</body>
</html>
       