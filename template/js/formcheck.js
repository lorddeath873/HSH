
function chkregrom () {
    var f = document.regrom;
    var fehler = '';
    if (f.ma.value == "") 
    {
        fehler += "Bitte Loginnamen eingeben\n";
        f.ma.style.border = "solid red 2px";
    }
    else 
    {
        if (f.ma.value.length<5) 
        {
            fehler += "Dein Loginname ist zu kurz\n";
            f.ma.style.border = "solid red 2px";
        }
        else 
        {
            f.ma.style.border = "";
        }
    }
    if (f.p.value == "") 
    {
        fehler += "Passwort ist leer\n";
        f.p.style.border = "solid red 2px";
    }
    else 
    {
        if (f.p.value.length<5) 
        {
            fehler += "Passwort ist zu kurz\n";
            f.p.style.border = "solid red 2px";
        } 
        else 
        {
            f.p.style.border = "";
        }
    }
    if (f.pp.value == "") 
    {
        fehler += "Passwortwiederholung ist leer\n";
        f.pp.style.border = "solid red 2px";
    }
    else 
    {
        f.pp.style.border = "";
        if (f.pp.value != f.p.value) 
        {
            fehler += "Passwörter stimmen nicht überein\n";
            f.pp.style.border = "solid red 2px";
            f.p.style.border = "solid red 2px";
        }
        else 
        {
            f.p.style.border = "";
            f.pp.style.border = "";
        }
    }
    if (f.plz.value == "") 
    {
        fehler += "Bitte wähle deine Postleitzahl\n";
        f.plz.style.border = "solid red 2px";
    }
    else 
    {
        f.plz.style.border = "";
    }
    if (f.plz.value == "0") 
    {
        fehler += "Bitte wähle deine Postleitzahl\n";
        f.plz.style.border = "solid red 2px";
    }
    else 
    {
        f.plz.style.border = "";
    }
    if (f.geb.value == "")
    {
        fehler += "Bitte gebe dein Geburtstag an\n";
        f.geb.style.border = "solid red 2px";
    }
    else
    {
        f.geb.style.border = "";

        var alter = 0;
        var gebu = f.geb.value;
        var gebua;
        gebua = gebu.split(".");
        var day = gebua[0];
        var month = gebua[1];
        var year = gebua[2];

        var today = new Date();
        var birthdate = new Date(year, month, day);

        var age = today.getFullYear() - birthdate.getFullYear();
        var m = today.getMonth() - birthdate.getMonth();

        if (m < 0 || (m === 0 && today.getDate() < birthdate.getDate()))
        {
            age--;
        }

        if (age < "14")
        {
            fehler += "Du bist leider zu jung\n";
            f.geb.style.border = "solid red 2px";
        }
        else
        {
            f.geb.style.border = "";
        }
    }
    if (f.na.value == "") 
    {
        fehler += "Bitte gebe deinen Namen an\n";
        f.na.style.border = "solid red 2px";
    }
    else 
    {
        f.na.style.border = "";
    }
    if (f.vna.value == "") 
    {
        fehler += "Bitte gebe deinen Vornamen an\n";
        f.vna.style.border = "solid red 2px";
    }
    else 
    {
        f.vna.style.border = "";
    }
    if (!validEmail(f.email.value))
    {
        fehler += "In der E-Mail-Adresse steckt der Wurm drin!\n";
        f.email.style.border = "solid red 2px";
    }
    else 
    {
        f.email.style.border = "";
    }
    if (f.tel.value == "" && f.mob.value == "")
    {
        fehler += "Entweder Telefonnummer oder Mobilnummer\n";
        f.tel.style.border = "solid red 2px";
        f.mob.style.border = "solid red 2px";
    }
    else
    {
        if (f.tel.value != "")
        {
            f.tel.style.border = "";
            f.mob.style.border = "";
            if (!f.tel.value.match(/^[\d\/\\\s+-]+$/))
            {
                fehler += "In der Telefonnummer steckt der Wurm drin!\n";
                f.tel.style.border = "solid red 2px";
            }
            else 
            {
                f.tel.style.border = "";
            }
        }
        else
        {
            f.tel.style.border = "";
           if (f.mob.value.match(/^[\d\/\\\s+-]+$/))
            {
                fehler += "In der Mobilnummer steckt der Wurm drin!\n";
                f.mob.style.border = "solid red 2px";
            }
            else 
            {
            f.mob.style.border = "";
            }
        }
    }
    if (f.str.value == "") 
    {
        fehler += "Bitte gebe dein Strasse an\n";
        f.str.style.border = "solid red 2px";
    }
    else 
    {
        f.str.style.border = "";
    }
    if (fehler.length>0) 
    {
        alert("Festgestellte Probleme: \n\n"+fehler);
        return(false);
    }
    else 
    {
        return (true);
    }
    function validEmail(email)
    {
        var strReg = "^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$";
        var regex = new RegExp(strReg);
        return (regex.test(email));
    }
}
function checkerfan () 
{
    var fehler = '';
    var f = document.erfan;
    if (f.dat.value == "")
    {
        fehler += "Bitte gib das Datum an\n";
        f.dat.style.border = "solid red 2px";
    }
    else
    {
        f.dat.style.border = "";
    }
    if (f.ort.value == "") 
    {
        fehler += "Bitte wähle den Ort\n";
        f.ort.style.border = "solid red 2px";
    }
    else 
    {
        f.ort.style.border = "";
    }
    if (f.ort.value == "0") 
    {
        fehler += "Bitte wähle den Ort\n";
        f.ort.style.border = "solid red 2px";
    }
    else 
    {
        f.ort.style.border = "";
    }
    if (f.wg.value == "") 
    {
        fehler += "Bitte sag uns wo genau\n";
        f.wg.style.border = "solid red 2px";
    }
    else 
    {
        if (f.wg.value.length<50) 
        {
            fehler += "Der Text ist zu kurz (mind. 50 Zeichen)\n";
            f.wg.style.border = "solid red 2px";
        }
        else 
        {
            f.wg.style.border = "";
        }
    }
    if (f.ws.value == "") 
    {
        fehler += "Bitte sag uns wie du aussahst\n";
        f.ws.style.border = "solid red 2px";
    }
    else 
    {
        if (f.ws.value.length<50) 
        {
            fehler += "Der Text ist zu kurz (mind. 50 Zeichen)\n";
            f.ws.style.border = "solid red 2px";
        }
        else 
        {
            f.ws.style.border = "";
        }
    }
    if (f.wse.value == "") 
    {
        fehler += "Bitte sag uns wie er aussah\n";
        f.wse.style.border = "solid red 2px";
    }
    else 
    {
        if (f.wse.value.length<50) 
        {
            fehler += "Der Text ist zu kurz (mind. 50 Zeichen)\n";
            f.wse.style.border = "solid red 2px";
        }
        else 
        {
            f.wse.style.border = "";
        }
    }
    if (f.wdes.value == "") 
    {
        fehler += "Bitte sag uns was du/er/sie gemacht hat\n";
        f.wdes.style.border = "solid red 2px";
    }
    else 
    {
        if (f.wdes.value.length<50) 
        {
            fehler += "Der Text ist zu kurz (mind. 50 Zeichen)\n";
            f.wdes.style.border = "solid red 2px";
        }
        else 
        {
            f.wdes.style.border = "";
        }
    }
    if (fehler.length>0) 
    {
        alert("Festgestellte Probleme: \n\n"+fehler);
        return(false);
    }
    else 
    {
        return (true);
    }
}
