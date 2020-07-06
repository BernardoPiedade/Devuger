function clicado(id)
{
    document.getElementById('sub-to').setAttribute('value',id);
}


// Logged user profile settings

$(document).ready(function(){

    //hide things when loaded
    $("#Show_Edit_Username_Div").css("display", "none");
    $("#Show_Edit_Password_Div").css("display", "none");
    $("#Show_Edit_Email_Div").css("display", "none");
    $("#Show_Edit_Description_Div").css("display", "none");
    $("#Show_Edit_Color_Div").css("display", "none");


    $("#Show_Edit_Username").click(function () {
        //show
        $("#Show_Edit_Username_Div").css("display", "block");

        //hide
        $("#Show_Edit_Password_Div").css("display", "none");
        $("#Show_Edit_Email_Div").css("display", "none");
        $("#Show_Edit_Description_Div").css("display", "none");
        $("#Show_Edit_Color_Div").css("display", "none");
    });

    $("#Show_Edit_Password").click(function () {
        //show
        $("#Show_Edit_Password_Div").css("display", "block");

        //hide
        $("#Show_Edit_Username_Div").css("display", "none");
        $("#Show_Edit_Email_Div").css("display", "none");
        $("#Show_Edit_Description_Div").css("display", "none");
        $("#Show_Edit_Color_Div").css("display", "none");
    });

    $("#Show_Edit_Email").click(function () {
        //show
        $("#Show_Edit_Email_Div").css("display", "block");

        //hide
        $("#Show_Edit_Username_Div").css("display", "none");
        $("#Show_Edit_Password_Div").css("display", "none");
        $("#Show_Edit_Description_Div").css("display", "none");
        $("#Show_Edit_Color_Div").css("display", "none");
    });

    $("#Show_Edit_Description").click(function () {
        //show
        $("#Show_Edit_Description_Div").css("display", "block");
        
        //hide
        $("#Show_Edit_Username_Div").css("display", "none");
        $("#Show_Edit_Password_Div").css("display", "none");
        $("#Show_Edit_Email_Div").css("display", "none");
        $("#Show_Edit_Color_Div").css("display", "none");
    });

    $("#Show_Edit_Profile_Color").click(function () {
        //show
        $("#Show_Edit_Color_Div").css("display", "block");

        //hide
        $("#Show_Edit_Username_Div").css("display", "none");
        $("#Show_Edit_Password_Div").css("display", "none");
        $("#Show_Edit_Email_Div").css("display", "none");
        $("#Show_Edit_Description_Div").css("display", "none");
    });

    //----------------------------------//
    $("#close_username").click(function () {
        $("#Show_Edit_Username_Div").css("display", "none");
    });

    $("#close_password").click(function () {
        $("#Show_Edit_Password_Div").css("display", "none");
    });

    $("#close_email").click(function () {
        $("#Show_Edit_Email_Div").css("display", "none");
    });

    $("#close_descp").click(function () {
        $("#Show_Edit_Description_Div").css("display", "none");
    });

    $("#close_color").click(function () {
        $("#Show_Edit_Color_Div").css("display", "none");
    });
    
});

// colors

let colorInput = document.querySelector("#color");
let hex = document.querySelector("#hex");

colorInput.addEventListener('input', () => {
    let color = colorInput.value;
    hex.value = color;
});