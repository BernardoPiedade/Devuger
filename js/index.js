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
    $("#Submit_New_Username").click(function () {
        $("#Show_Edit_Username_Div").css("display", "block");

        $('#Show_Edit_Username_Div').addClass('is-active');
       
    });
    
    $("#Submit_New_Password").click(function () {
        $("#Show_Edit_Password_Div").css("display", "block");

        $('#Show_Edit_Password_Div').addClass('is-active');
    });

    $("#Submit_New_Email").click(function () {
        $("#Show_Edit_Email_Div").css("display", "block");
    });

    $("#Submit_New_Description").click(function () {
        $("#Show_Edit_Description_Div").css("display", "block");
    });

    $("#Submit_New_Color").click(function () {
        $("#Show_Edit_Color_Div").css("display", "block");
    });
});

// colors

let colorInput = document.querySelector("#color");
let hex = document.querySelector("#hex");

colorInput.addEventListener('input', () => {
    let color = colorInput.value;
    hex.value = color;
});