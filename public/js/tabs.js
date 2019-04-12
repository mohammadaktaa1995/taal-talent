(function () {
    let $i = i = 0;
    let $tabUl = $('#nav-tab');
    let $tabContent = $('.tab-content');
    let $tabsItems = $tabUl.find('a');
    let $data = [];
    $.each($tabsItems, function (i, v) {
        $data.push($(v).attr('data-tab'))
    });
    changeTimeOut('#nav-2');
    $data.push(null);
    let $activeTab = $tabUl.find('a.active');
    let $nextBtn = $('#btnMoveRightTab');
    let $prevBtn = $('#btnMoveLeftTab');
    $prevBtn.hide();
    $nextBtn.on('click', function () {
        $prevBtn.show();
        $i = $activeTab.data('id');
        if ($data[$i] !== null) {
            $activeTab.removeClass('active');
            $activeTab.attr('aria-expanded', 'false');
            $tabContent.find('div.active').removeClass('active').removeClass('show').attr('aria-expanded', 'false');
            let $active = $data[++$i];
            $activeTab = $tabUl.find('a[data-tab=' + '\'' + $active + '\'' + ']').addClass('active').attr('aria-expanded', 'true');
            $tabContent.find('div[id=' + '\'' + $active.split('#').join('') + '\'' + ']').addClass('show active').attr('aria-expanded', 'true');
            changeTimeOut($activeTab.attr('data-tab'));
            if ($activeTab.attr('href') === $tabsItems.last().attr('href')) {
                $(this).hide();
                $('#car-submit').show();
            }
        }
    });

    $prevBtn.on('click', function () {
        $nextBtn.show();
        $('#car-submit').hide();
        $i = $activeTab.data('id');
        if ($data[$i] !== null) {
            $activeTab.removeClass('active');
            $activeTab.attr('aria-expanded', 'false');
            $tabContent.find('div.active').removeClass('active').removeClass('show').attr('aria-expanded', 'false');
            let $active = $data[--$i];
            $activeTab = $tabUl.find('a[data-tab=' + '\'' + $active + '\'' + ']').addClass('active').attr('aria-expanded', 'true');
            $tabContent.find('div[id=' + '\'' + $active.split('#').join('') + '\'' + ']').addClass(' show active').attr('aria-expanded', 'true');
            if ($activeTab.attr('href') === $tabsItems.first().attr('href')) {
                $(this).hide();
            }
        }
    });
    $tabsItems.each(function (i, v) {
        $(v).on('click', function () {
            $activeTab = $(this);
            if ($activeTab.attr('href') === $tabsItems.last().attr('href')) {
                $('#car-submit').show();
                $nextBtn.hide();
                $prevBtn.show();
            } else if ($activeTab.attr('href') === $tabsItems.first().attr('href')) {
                $('#car-submit').hide();
                $nextBtn.show();
                $prevBtn.hide();
            } else {
                $('#car-submit').hide();
                $nextBtn.show();
                $prevBtn.show();
            }
        })
    })
})($);

function changeTimeOut($cont) {
    let $countdown = $($cont + ' .countdown.question-time');
    console.log($countdown);
    let $convert_time = $countdown.attr('data-time');
    let $seconds = '';
    let interval = setInterval(function () {

        let timer = $convert_time.split(':');

        let minutes = parseInt(timer[0], 10);
        let seconds = parseInt(timer[1], 10);
        --seconds;
        minutes = (seconds < 0) ? '00' : minutes;
        if (minutes < 0) clearInterval(interval);
        seconds = (seconds < 0) ? '0' : seconds;
        seconds = (seconds < 10) ? '0' + seconds : seconds;
        //minutes = (minutes < 10) ?  minutes : minutes;
        $countdown.html(minutes + ':' + seconds);
        $convert_time = minutes + ':' + seconds;
        $seconds = seconds;
        if ($seconds === '00') {
            $($cont + ' input').attr('readonly', 'readonly');
            $($cont + ' .radio').css('cursor', 'not-allowed');
        }
    }, 1000);

}