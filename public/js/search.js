$('.pick-date').dateRangePicker(
    {
        separator : ' to ',
        autoClose: true,
        startOfWeek: 'monday',
        language:'{{ App::getLocale() }}',
        startDate: new Date(),
        format: 'ddd D.M.YYYY',  //more formats at http://momentjs.com/docs/#/displaying/format/
        customOpenAnimation: function(cb)
        {
            $(this).fadeIn(100, cb);
        },
        customCloseAnimation: function(cb)
        {
            $(this).fadeOut(100, cb);
        },

        getValue: function()
        {
            if ($('#przyjazd').val() && $('#powrot').val() )
                return $('#przyjazd').val() + ' to ' + $('#powrot').val();
            else
                return '';
        },
        setValue: function(s,s1,s2)
        {
            if ('{{ App::getLocale() }}' == 'pl'){
                s1 = s1.replace('Mon', 'Pon').replace('Tue', 'Wto').replace('Wed', 'Śro').replace('Thu', 'Czw').replace('Fri', 'Pią').replace('Sat', 'Sob').replace('Sun', 'Nie');
                s2 = s2.replace('Mon', 'Pon').replace('Tue', 'Wto').replace('Wed', 'Śro').replace('Thu', 'Czw').replace('Fri', 'Pią').replace('Sat', 'Sob').replace('Sun', 'Nie');
            }
            $('#przyjazd').val(s1);
            $('#powrot').val(s2);
        }
    });