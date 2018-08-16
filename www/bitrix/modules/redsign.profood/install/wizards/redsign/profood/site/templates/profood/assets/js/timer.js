//������ 1.0.2 

(function( $ ) {
  'use strict';
  var dateNow = BX.message('SERVER_TIME'),
      initTimerSet;

  $.fn.timer = function(options) {

    options = $.extend({
      days:".days", //����� ���� ����� ��������� ���
      hours:".hours", //����
      minute:".minute", //������
      second:".second", //�������
      blockTime:".timer__item", //���� � ������� ����� + ������� (�������� 10 ��)
      linePercent:".progress_bar", //����� � ����������
      textLinePercent:".progress_text", //���� � ������� ����� ���������� ��������
      destroy: false
    }, options);

    var copyOptions = options;
    var timers = this;

    if($(this).length < 1){
      return false;
    }

    return $.timer.count(timers, options);

  };

  jQuery.extend({
      timer: {

        count: function(timers, copyOptions) {
          var blockStyle = $(copyOptions.minute).closest(copyOptions.blockTime).css('display');
          if(!initTimerSet) {
            dateNow = parseInt(dateNow) + 1;
            setInterval(function () {
              dateNow = parseInt(dateNow) + 1;
            }, 1000);
            initTimerSet = true;
          }
          $(timers).not(".runTimer").each(function () {
            var timer = $(this);
            var timeInfo = timer.data('timer');
            if (typeof(timeInfo) != "object") {
              timeInfo = BX.parseJSON(timeInfo)
            }
            $.timer.runTimer(timer, copyOptions, blockStyle, timeInfo);
            setInterval(function(){
              $.timer.runTimer(timer, copyOptions, blockStyle, timeInfo);
            },1000);
            $(timer).addClass('runTimer');
          });
        },

        runTimer: function(timer, options, blockStyle, timeInfo) {
          var timerHtml = timer,
            dataTimer = timeInfo,
            limit = dataTimer.DATE_TO - dataTimer.DATE_FROM,
            gone = dataTimer.DATE_TO - dateNow;

          if (gone < 1 && dataTimer.AUTO_RENEWAL == 'Y') {
            for (var lim = 0; lim < 200; lim++) {
              var newdateTo = (lim * limit + dataTimer.DATE_TO) - dateNow;
              if (newdateTo > 0) {
                gone = newdateTo;
                break;
              }
            }
          }

          if (gone > 0) {

            var days = parseInt((gone / (60 * 60 )) / 24);
            if (days < 10) {
              days = '0' + days;
            }
            days = days.toString();
            var hourse = parseInt(gone / (60 * 60 )),
              hours = parseInt((gone / (60 * 60 )) % 24);
            if (hours < 10) {
              hours = '0' + hours;
            }
            hours = hours.toString();

            var minutes = parseInt(gone / (60)) % 60;
            if (minutes < 10) {
              minutes = '0' + minutes;
            }
            minutes = minutes.toString();

            var seconds = parseInt(gone) % 60;
            if (seconds < 10) {
              seconds = '0' + seconds;
            }
            seconds = seconds.toString();


            //������ ���������
            var widthTimerPerc = false;

            if (!!dataTimer.DINAMICA_DATA) {
              if (dataTimer.DINAMICA_DATA == 'evenly') {
                widthTimerPerc = Math.floor(100 - ((gone / limit) * 100));

                timerHtml.find(options.linePercent).css('width', widthTimerPerc + '%');
                timerHtml.find(options.textLinePercent).text(widthTimerPerc);
              }
              else {
                var prevPerc = false,
                  firstPerc = false;

                for (var timePerc in dataTimer.DINAMICA_DATA) {
                  if (!prevPerc) {
                    prevPerc = timePerc;
                    firstPerc = timePerc;
                  }
                  if (prevPerc < hourse && hourse < timePerc) {
                    widthTimerPerc = dataTimer.DINAMICA_DATA[timePerc];
                    break;
                  }
                  prevPerc = timePerc;
                }

                if (!widthTimerPerc) {
                  if (hourse > prevPerc) {
                    widthTimerPerc = dataTimer.DINAMICA_DATA[prevPerc];
                  }
                  else if (hourse < prevPerc) {
                    widthTimerPerc = dataTimer.DINAMICA_DATA[firstPerc];
                  }
                }

                if (widthTimerPerc) {
                  timerHtml.find(options.linePercent).css('width', widthTimerPerc + '%');
                  timerHtml.find(options.textLinePercent).text(widthTimerPerc);
                }
              }
            }
            else {
              widthTimerPerc = Math.floor((gone / limit) * 100);
              timerHtml.find(options.linePercent).css('width', widthTimerPerc + '%');
              timerHtml.find(options.textLinePercent).text(widthTimerPerc);
            }

            // ������ ��� ��� ������� � ����������� �� ����������� �������
            if (parseInt(days) < 1 && $(options.days).is(":visible")) {

              timerHtml.find(options.days).closest(options.blockTime).css('display', 'none');
              timerHtml.find(options.second).closest(options.blockTime).css('display', blockStyle);

            } else if (parseInt(days) > 0 && $(options.second).is(":visible")) {

              timerHtml.find(options.days).closest(options.blockTime).css('display', blockStyle);
              timerHtml.find(options.second).closest(options.blockTime).css('display', 'none');

            }

            //��������� ����� � �����
            timerHtml.find(options.second).text(seconds);
            timerHtml.find(options.minute).text(minutes);
            timerHtml.find(options.hours).text(hours);
            timerHtml.find(options.days).text(days);

          }
          else {
            //timerCanDelete(timerHtml);
          }
        }
      }

  });
})(jQuery);
