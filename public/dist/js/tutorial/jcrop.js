$(document).ready(function () {
    $('#image').Jcrop({
        onSelect: function (c) {
            console.log(c);

            console.log(c.x);
            console.log(c.y);
            console.log(c.w);
            console.log(c.h);
        }
    });
});
