$(document).on('change', '.hijri', function(){
    date = $(this).val();
    $startElement = $(this);
    index = $('.hijri').index(this)+1;

    //get all text inputs
    var inputs = $('input[class=hijri]');



    var _date = date.split('/');
    var year = _date[0];
    var month = _date[1];
    var day = _date[2];
    console.log(year, month, day);

    for(i=month; i<=12; i++)
    {
        // if(i < month)
        //     continue;

        for(j=1; j<=30; j++)
        {
            if(i == month && j <= day)
                continue;
            $(inputs[index]).val(year+'/'+i+'/'+j);
            index++;
        }
    }






    // fill_dates(inputs, date, index+1);

    // for (var i = 0; i < $inputs.length; i++) {
    //     if (isAfter($inputs[i], $startElement)) {
    //         var nextInput = $inputs[i];

    //         // $(nextInput).val(date)
    //         fill_dates(nextInput, date);

    //     }
    // }
});


function isAfter(elA, elB) {
    return ($('*').index($(elA).last()) > $('*').index($(elB).first()));
}

function fill_dates(inputs, date, index)
{
    var _date = date.split('/');
    var year = _date[0];
    var month = _date[1];
    var day = _date[2];
    console.log(year, month, day);

    for(i=month; i<=12; i++)
    {
        for(j=day; j<=30; j++)
        {
            $(inputs[index]).val(year+'/'+i+'/'+j);
            index++;
        }
    }
}
