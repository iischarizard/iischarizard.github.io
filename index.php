<?php

    $counterFile = 'counter.txt' ;

    // jQuery ajax request is sent here
    if ( isset($_GET['increase']) )
    {
        if ( ( $counter = @file_get_contents($counterFile) ) === false ) die('Error : file counter does not exist') ;
        file_put_contents($counterFile,++$counter) ;
        echo $counter ;
        return false ;
    }

    if ( ! $counter = @file_get_contents($counterFile) )
    {
        if ( ! $myfile = fopen($counterFile,'w') )
            die('Unable to create counter file !!') ;
        chmod($counterFile,0644);
        file_put_contents($counterFile,0) ;
    }

?>
<html>
    <head>
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript">
            jQuery(document).on('click','a#download',function(){
                jQuery('div#counter').html('Loading...') ;
                var ajax = jQuery.ajax({
                    method : 'get',
                    url : '/test.php', // Link to this page
                    data : { 'increase' : '1' }
                }) ;
                ajax.done(function(data){
                    jQuery('div#counter').html(data) ;
                }) ;
                ajax.fail(function(data){
                    alert('ajax fail : url of ajax request is not reachable') ;
                }) ;
            }) ;
        </script>
    </head>
	<body>
    <div id="counter"><?php echo $counter ; ?></div>
    <a href="" id="download" onclick="window.open(this.href);return false;">Download btn</a>
	</body>
</html>