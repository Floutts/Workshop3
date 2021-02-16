$(document).ready(function() {

        function test(valeur){
            var requestTest= $.ajax({
                url: "http://serveur1.arras-sio.com/symfony4-4060/ProjetSalles/web/index.php?page=test&id="+valeur,
                method: "GET",
                dataType: "json",
                beforeSend: function( xhr ) {
                    xhr.overrideMimeType( "application/json; charset=utf-8" );}

            });
            requestTest.done(function( msgTest ) {
                for (var i = 0;i<msgTest.options.length;i++){
                    console.log(msgTest.options[i].id)
                    texte = "<input class=\"form-check-input\" type=\"checkbox\" value=\"" + msgTest.options[i].id + "\" id=\"optionSalle[]\" name=\"optionSalle[]\"> "// <label class=\"form-check-label\" for=\"optionSalle[]\">" + " option1 " + "</label><br/>"
                    texteBis = "<label class=\"form-check-label\" for=\"optionSalle[]\">" + msgTest.options[i].libelle + "</label><br/>"
                    $("#option").append(texte+texteBis)

                }
            });


            // Fonction qui se lance lorsque l’accès au web service provoque une erreur
            requestTest.fail(function( jqXHR, textStatus ) {
                alert ('erreur');
            });
        }


    // Je lance l’ajax en cliquant sur le bouton
    $("#idSalle").change(function () {
        $("#option").empty()
        var valeur;
        valeur = $("#idSalle").val();
        test(valeur)
        //ajax();
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
                    $("#nomAssociation").val(msgAssociation[i].NomAssociation)
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

    function dateTime(){
        var debut = ($("#DateDebut").val() + " " + $("#heureDebut").val())
        var fin = ($("#DateFin").val() + " " + $("#heureFin").val())
        $("#DateTimeDebut").val(debut)
        $("#DateTimeFin").val(fin)
        console.log(debut)
        console.log(fin)

    }

    $("#btValider").click(function(){
        $("#DateTimeDebut").val("")
        $("#DateTimeFin").val("")
        dateTime()

    })
})





