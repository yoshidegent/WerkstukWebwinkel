$(document).ready(function()
{
    $("#beheerPopup").hide();

    $("#beheerBtn").click(function()
    {
        $("#beheerBtn").fadeOut();
        $("#beheerPopup").fadeIn();
    });
});

$(document).mouseup(function (e)
{
    //Select the container that is active
    var container = $("#naamForm");

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        $("#beheerBtn").fadeIn();
        $("#beheerPopup").fadeOut();
    }
});