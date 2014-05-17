function deselect()
{
    $(".pop").slideFadeToggle(function()
    {
        $("#beheerBtn").removeClass("selected");
    });
}

$(function()
{
    $("#beheerBtn").live('click', function()
    {
        if($(this).hasClass("selected"))
        {
            deselect();
        }
        else
        {
            $(this).addClass("selected");
            $(".pop").slideFadeToggle(function()
            {
                $("#naamInput").focus();
            });
        }
        return false;
    });

    $(".close").live('click', function()
    {
        deselect();
        return false;
    });
});

$.fn.slideFadeToggle = function(easing, callback)
{
    return this.animate({ opacity: 'toggle', height: 'toggle' }, "fast", easing, callback);
};​ 