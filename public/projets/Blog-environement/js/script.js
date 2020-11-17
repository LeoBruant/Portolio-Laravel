// barre de navigation

var liste = false;

$(document).ready(function(){
    $(".mobile").click(function(){
        if(liste == false){
            $(".mobile .liste").slideDown(250);
            liste = true;
        }
        else{
            $(".mobile .liste").slideUp(250);
            liste = false;
        }
    });
    $(window).resize(function(){
        if ($(window).width() > 1100){
            $(".mobile .liste").slideUp(250);
            liste = false;
        }
    });
});

// bloc 7-1

var liste_boutons = [
    true,
    false,
    false
];

function boutons(){
    $(".bloc7-1 .bouton").animate({
        backgroundColor: "white"
    }, 0);
    $(".bloc7 .bouton:nth-of-type(1), .bloc7 .bouton:nth-of-type(2), .bloc7 .bouton:nth-of-type(3)").animate({
        color: "rgb(100,100,100)"
    }, 0);
    $(".bloc7-1 .texte:nth-of-type(4)").slideUp(0);
    liste_boutons[0] = false;
    $(".bloc7-1 .texte:nth-of-type(5)").slideUp(0);
    liste_boutons[1] = false;
    $(".bloc7-1 .texte:nth-of-type(6)").slideUp(0);
    liste_boutons[2] = false;
}

$(document).ready(function(){
    for (let index = 0; index < liste_boutons.length; index++){
        $(".bloc7-1 .bouton:nth-of-type("+(index+1)+")").click(function () {
            if (liste_boutons[index] == false) {
                boutons();
                $(".bloc7-1 .bouton:nth-of-type("+(index+1)+")").animate({
                    backgroundColor: "rgb(100,200,225)"
                }, 0);
                $(".bloc7-1 .bouton:nth-of-type("+(index+1)+")").animate({
                    color: "white"
                }, 0);
                $(".bloc7-1 .texte:nth-of-type("+(index+4)+")").slideDown(250);
                liste_boutons[index] = true;
            }
            else {
                boutons();
                liste_boutons[index] = false;
            }
        });
    }
});

// bloc 7-2

var pourcentage = [78, 73, 92, 88, 78];

for (let i = 0; i < pourcentage.length; i++) {
    $(function(){
        $(".bloc7-2 .graph:nth-of-type("+(i+1)+")").animate({
            width: pourcentage[i] + "%"
        });
        $(".bloc7-2 .graph:nth-of-type("+(i+1)+") .pourcentage").append(pourcentage[i] + "%");
    });
}