$(document).ready(function()
{
    $(".popup").hide();

    $(".popupBtn").click(function()
    {
        $(".popupBtn").fadeOut();
        $(".popup").fadeIn();
    });
});

$(document).mouseup(function (e)
{
    //Select the container that is active
    var container = $("#popupForm");

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        $(".popupBtn").fadeIn();
        $(".popup").fadeOut();
    }
});