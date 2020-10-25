function Compare () { //Tar in alla värden här, skickar sedan vidare till post_signup om rätt
    var pass = document.forms["myForm"]["pword"].value;
    var cnfrmpass = document.forms["myForm"]["cnfrmpassword"].value;
    var comp = (cnfrmpass).localeCompare(pass);

    if (comp == 0) {
        return true;
    }
    else {
        return false;
    }

}