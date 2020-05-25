function clicado(id)
{
    document.getElementById('sub-to').setAttribute('value',id);
}


// Logged user profile settings

$(document).ready(function(){
    $("#Show_Edit_Username").click(function () {
        $("#Show_Edit_Username_Modal").modal();
    });

    $("#Show_Edit_Password").click(function () {
        $("#Show_Edit_Password_Modal").modal();
    });

    $("#Show_Edit_Email").click(function () {
        $("#Show_Edit_Email_Modal").modal();
    });

    $("#Show_Edit_Description").click(function () {
        $("#Show_Edit_Description_Modal").modal();
    });

    $("#Show_Edit_Profile_Color").click(function () {
        $("#Show_Edit_Profile_Color_Modal").modal();
    });
});

