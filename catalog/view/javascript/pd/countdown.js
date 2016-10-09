 $(function() {
    $('[data-countdown]').each(function() {
         var $this = $(this), finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function(event) {
            $this.html(event.strftime('%D Ngày %H:%M:%S'));
            
        });
    });
 });
 $(function() {
    $('[data-countdown]').each(function() {
         var $this = $(this), finalDate = $(this).data('countdowns');
            $this.countdown(finalDate, function(event) {
            $this.html(event.strftime('%D days %H hours %M minutes %S senconds'));
            
        });
    });
 });