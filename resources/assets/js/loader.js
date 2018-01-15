window.loader = function (event, delay) {
    if (event === 'show') {
        $('.loader-wrap').addClass('visible');
        if (delay) {
            setTimeout(function () {
                $('.loader-wrap').removeClass('visible');
            }, delay);
        }
    }
    if (event === 'hide') {
        $('.loader-wrap').removeClass('visible');
    }
};