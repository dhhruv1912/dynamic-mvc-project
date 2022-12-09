$(function () {
    $("#countdown").countdown(timerdate, function (event) {
        $(this).html(
            event.strftime(
                "<div class='cd-item'><span>%D</span> <p>Days</p> </div>" +
                    "<div class='cd-item'><span>%H</span> <p>Hours</p> </div>" +
                    "<div class='cd-item'><span>%M</span> <p>Minutes</p> </div>" +
                    "<div class='cd-item'><span>%S</span> <p>Seconds</p> </div>"
            )
        );
    });
});
