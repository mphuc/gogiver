 $(function() {
    $('[data-countdown]').each(function() {
         var $this = $(this), finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function(event) {
            $this.html(event.strftime('%D days %H:%M:%S'));
        });
    });
    
 });
  $(function() {
    $('[data-countdowns]').each(function() {
         var $this = $(this), finalDate = $(this).data('countdowns');
            $this.countdown(finalDate, function(event) {
            $this.html(event.strftime('%D days %H:%M:%S'));
        });
    });
 });
   $(function() {
    $('[data-countdownss]').each(function() {
         var $this = $(this), finalDate = $(this).data('countdownss');
            $this.countdown(finalDate, function(event) {
            $this.html(event.strftime('%D days %H:%M:%S'));
        });
    });
 });