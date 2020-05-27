$(document).ready(function() {
    function ajax() {

        /*  var requestOption= $.ajax({
             url: "http://serveur1.arras-sio.com/symfony4-4060/ProjetSalles/web/index.php?page=options",
             method: "GET",
             dataType: "json",
             beforeSend: function( xhr ) {
                 xhr.overrideMimeType( "application/json; charset=utf-8" );}

         });
         requestOption.done(function( msgOption ) {
             alert(msgOption[1].libelle)

         });


         // Fonction qui se lance lorsque l’accès au web service provoque une erreur
         requestOption.fail(function( jqXHR, textStatus ) {
             alert ('erreur');
         });
 */
        var requestOptionSalle = $.ajax({
            url: "http://serveur1.arras-sio.com/symfony4-4060/ProjetSalles/web/index.php?page=optionSalle",
            method: "GET",
            dataType: "json",
            beforeSend: function (xhr) {
                xhr.overrideMimeType("application/json; charset=utf-8");
            }

        });
        requestOptionSalle.done(function (msgOptionSalle) {
            var e;
            e = 0
            e = parseInt(e)
            var valeur;
            valeur = $("#idSalle").val();
            $(msgOptionSalle).each(function () {


                if (valeur === msgOptionSalle[e].idSalle) {
                    var texte;
                    texte = "<input class=\"form-check-input\" type=\"checkbox\" value=\"" + msgOptionSalle[e].idOption + "\" id=\"optionSalle[]\" name=\"optionSalle[]\"><label></label><br/> "// <label class=\"form-check-label\" for=\"optionSalle[]\">" + " option1 " + "</label><br/>"
                    $("#option").append(texte)

                    var requestOptions = $.ajax({

                        url: "http://serveur1.arras-sio.com/symfony4-4060/ProjetSalles/web/index.php?page=options&id=" + msgOptionSalle[e].idOption,
                        method: "GET",
                        dataType: "json",
                        beforeSend: function (xhr) {
                            xhr.overrideMimeType("application/json; charset=utf-8");
                        },


                    })

                    requestOptions.done(function (msgOption) {
                        // figer le site
                        var texteBis
                        texteBis = "<label class=\"form-check-label\" for=\"optionSalle[]\">" + msgOption.libelle + "</label><br/>"
                        $("#option").append(texteBis)
                    });
                    // ajouter une fonction qui récupère tout
                }
                e = e + 1
            })
            $(".loader").fadeOut("1000");
        });
        // Fonction qui se lance lorsque l’accès au web service provoque une erreur
        requestOptionSalle.fail(function (jqXHR, textStatus) {
            alert('erreur');
        });
    }

    // Je lance l’ajax en cliquant sur le bouton
    $("#idSalle").change(function () {
        $("#option").empty()
        ajax();
    });

    function assos() {
        var requestAssociation = $.ajax({
            url: "http://serveur1.arras-sio.com/symfony4-4060/ProjetSalles/web/index.php?page=association",
            method: "GET",
            dataType: "json",
            beforeSend: function (xhr) {
                xhr.overrideMimeType("application/json; charset=utf-8");
            }

        });
        requestAssociation.done(function (msgAssociation) {
            var i;
            i = 0
            i = parseInt(i)
            var valeurAssociation;
            valeurAssociation = $("#idAssociation").val();

            $(msgAssociation).each(function () {
                if (msgAssociation[i].id === valeurAssociation) {

                    $("#nom").val(msgAssociation[i].Nom)
                    $("#prenom").val(msgAssociation[i].Prenom)
                    $("#adresse").val(msgAssociation[i].Adresse)
                    $("#email").val(msgAssociation[i].Email)
                    $("#tel").val("0" + msgAssociation[i].NumTelephone)
                }
                i = i+1
            })

        });


        // Fonction qui se lance lorsque l’accès au web service provoque une erreur
        requestAssociation.fail(function (jqXHR, textStatus) {
            alert('erreur');
        });
    }
    $("#idAssociation").change(function () {

        $("#nom").val("")
        $("#prenom").val("")
        $("#adresse").val("")
        $("#email").val("")
        $("#tel").val("")
        assos()

    });

})





