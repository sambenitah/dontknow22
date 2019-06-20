/*--------- Function animation mediaquery du header ---------*/

$(".m-nav-toggle-icon ").on("click",function () {

        var x = $("#nav-bis").attr("class");

        if(x == "m-bis-no-visible"){

        $(".m-bis-no-visible").attr('class', 'm-bis-visible');

        }else if(x == "m-bis-visible"){

            $(".m-bis-visible").attr('class', 'm-bis-visible--bis');

            setTimeout(function() {
                $(".m-bis-visible--bis").attr('class', 'm-bis-no-visible');
            }, 1000);

        }

});

/*--------- Function scrool ---------*/


$(window).scroll(function() {

    var scroolY=$(window).scrollTop();
    if( (scroolY) > 20){

        $(".m-bis-visible").attr('class', 'm-bis-visible--bis');

        setTimeout(function() {
            $(".m-bis-visible--bis").attr('class', 'm-bis-no-visible');
        }, 1000);
    }

    if( (scroolY) > 80){

        $(".container").attr('class', 'container--bis');

    }else{
        $(".container--bis").attr('class', 'container');
    }

});


/*--------- Function hover Section2 ---------*/


$( "#t1-SectionTwo" ).hover(function() {

    $(".sectionTwo").attr('class', 'sectionTwo');
    $(".divTwoContentSectionTwo").attr('class', 'divTwoContentSectionTwo divTwoContentSectionTwo1');

});


$( "#t2-SectionTwo" ).hover(function() {

    $(".sectionTwo").attr('class', 'sectionTwo SectionTwoBackground2');
    $(".divTwoContentSectionTwo").attr('class', 'divTwoContentSectionTwo divTwoContentSectionTwo2');

});


$( "#t3-SectionTwo" ).hover(function() {

    $(".sectionTwo").attr('class', 'sectionTwo SectionTwoBackground3');
    $(".divTwoContentSectionTwo").attr('class', 'divTwoContentSectionTwo divTwoContentSectionTwo3');

});


$( "#t4-SectionTwo" ).hover(function() {

    $(".sectionTwo").attr('class', 'sectionTwo SectionTwoBackground4');
    $(".divTwoContentSectionTwo").attr('class', 'divTwoContentSectionTwo divTwoContentSectionTwo4');


});


$( "#t5-SectionTwo" ).hover(function() {

    $(".sectionTwo").attr('class', 'sectionTwo SectionTwoBackground5');
    $(".divTwoContentSectionTwo").attr('class', 'divTwoContentSectionTwo divTwoContentSectionTwo5');


});


$( "#t6-SectionTwo" ).hover(function() {

    $(".sectionTwo").attr('class', 'sectionTwo SectionTwoBackground6');
    $(".divTwoContentSectionTwo").attr('class', 'divTwoContentSectionTwo divTwoContentSectionTwo6');


});

/*--------- Function hover click ---------*/


$( ".inputAddLogUser" ).click(function() {

    $(".inputAddLogUser").attr("class", "inputAddLogUser")
    var clss = $(this).attr("id");
    $("#"+clss+"").attr("class", "inputAddLogUser inputAddLogUser--click");

});