    <div class="title-section">
        <div class="title-section__text">
            <div class="title-section__title">교통편 임대</div>
            <div class="title-section__description">교통편을 임대할 수 있는 페이지입니다.</div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <table class="transportation">
                <thead>
                    <tr>
                        <th style="width: 200px">교통편 이름</th>
                        <th>교통편 정보</th>
                        <th style="width: 250px">교통편 운행 정보</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="transportation__name">교통편 이름</div>
                        </td>
                        <td class="transportation__detail">
                            <div class="transportation__detail-row">
                                <div class="transportation__row-title">교통편 설명</div>
                                <div class="transportation__content transportation__description">qwe</div>
                            </div>
                            <div class="transportation__detail-row">
                                <div class="transportation__row-title">운임료</div>
                                <div class="transportation__content transportation__price">qwe</div>
                            </div>
                            <div class="transportation__notice">
                                위 요금은 성인 기준이며, 어린이는 40%의 요금 할인, 경로자는 무료입니다.
                            </div>
                        </td>
                        <td class="transportation__detail">
                            <div class="transportation__detail-row">
                                <div class="transportation__row-title">운행 주기</div>
                                <div class="transportation__content transportation__cycle">qwe</div>
                            </div>
                            <div class="transportation__detail-row">
                                <div class="transportation__row-title">운행 시간대</div>
                                <div class="transportation__content transportation__time">qwe</div>
                            </div>
                            <div class="transportation__detail-row">
                                <div class="transportation__row-title">휴무일</div>
                                <div class="transportation__content transportation__rest">qwe</div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <div class="footer__upper">
                <ul class="footer__menu">
                    <li>CONTACT US</li>
                    <li>SOCIAL</li>
                    <li>STAGES</li>
                    <li>WORLD</li>
                </ul>
                <div class="footer__copyright">
                    COPYRIGHT ⓒ ALL RIGHT RESERVED.
                </div>
            </div>
            <div class="footer__downer">
                <div class="footer__description">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facere quidem nulla sapiente culpa eveniet et<br>
                    minima numquam veniam? Dolores molestias consectetur voluptatibus ratione in possimus,
                </div>
                <img src="assets/grayscale_logo.png" alt="Bexco" class="footer__logo">
            </div>
        </div>
    </div>
</div>
<div class="reservation-dialog">
    <form action="#" id="reservationForm">
        <div class="reservation__row reservation__date-row">
            <div class="reservation__title">탑승 일자</div>
            <div class="reservation__inline-row">
                <div class="reservation__col">
                    <div class="reservation__datepicker"></div>
                </div>
                <div class="reservation__col">
                    <select name="time" class="reservation__time-combobox" disabled></select>
                </div>
            </div>
        </div>
        <div class="reservation__row">
            <div class="reservation__title">탑승객 유형</div>
            <div class="reservation__inline-row">
                <div class="reservation__col">
                    <div class="reservation__col-title">어른</div>
                    <div class="reservation__col-content">
                        <input type="text" id="adultCount" name="adult" class="number-spinner" value="0" data-type="adult">
                    </div>
                </div>
                <div class="reservation__col">
                    <div class="reservation__col-title">어린이</div>
                    <div class="reservation__col-content">
                        <input type="text" id="kidCount" name="kid" class="number-spinner" value="0" data-type="kid">
                    </div>
                </div>
                <div class="reservation__col">
                    <div class="reservation__col-title">노약자</div>
                    <div class="reservation__col-content">
                        <input type="text" id="oldCount" name="old" class="number-spinner" value="0" data-type="old">
                    </div>
                </div>
            </div>
        </div>
        <div class="reservation__row">
            <h3>총 합 가격: <span class="reservation__price">0원</span></h3>
        </div>
        <div class="reservation__row">
            <div class="reservation__col">
                <button type="submit" class="reservation__submit">예약하기</button>
            </div>
        </div>
    </form>
</div>
<script
src="https://code.jquery.com/jquery-3.4.1.js"
integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
crossorigin="anonymous"></script>
<script
src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
crossorigin="anonymous"></script>
<script>
    (() => {
        function on(event, target, callback) {
            $(document).on(event, target, callback);
        }

        var currentTransportation = {};
        var currentTransportationReservations = [];

        var TransporationReservationDataManager = {
            data: [],
            get(index) {
                return (this.data || []).filter(item => item.id === index)[0];
            },
            getByTransportation(id) {
                return (this.data || []).filter(item => item.transportation === id);
            },
            getPeopleCountByDay(date) {
                var dateFormat = DateManager.format(date);
                var arr = (this.data || []).filter(item => item.date === dateFormat);
                var result = 0;
                for (var i = 0; i < arr.length; i += 1) {
                    var member = arr[i].member || {};
                    result += member.old + member.kid + member.adult;
                }
                return result;
            },
            getCountByDateWithTime(transporationId, date, time) {
                var reservations = this.getByTransportation(transporationId);
                var arr = reservations.filter(item => item.date === DateManager.format(date) && item.time === time);
                var result = 0;
                for (var i = 0; i < arr.length; i += 1) {
                    var item = arr[i];
                    var member = item.member || {};
                    result += (member.old || 0) + (member.adult || 0) + (member.kid || 0);
                }
                return result;
            },
        };

        var TransportationDataManager = {
            data: [],
            get(index) {
                return (this.data || []).filter(item => item.id == index)[0];
            },
            getTimeList(transportation) {
                var result = [];
                var cycle = transportation.cycle;
                var cycleStart = DateManager.getOnlyTime(cycle[0]).getTime();
                var cycleEnd = DateManager.getOnlyTime(cycle[1]).getTime();
                var interval = transportation.interval;
                var current = cycleStart;

                while (current <= cycleEnd) {
                    result.push(new Date(current));
                    current += interval * 1000 * 60;
                }

                return result;
            },
        };

        var ReservationDataManager = {
            data: [],
            get(index) {
                return (this.data || []).filter(item => item.id === index)[0];
            },
            getDates() {
                var result = [];
                for (var i = 0; i < this.data.length; i += 1) {
                    result.push([this.data[i].since, this.data[i].until]);
                }
                return result;
            },
        };

        $.get('/api/reservation/get').then((data) => {
            ReservationDataManager.data = data;
        });

        $.get('/api/transportation_reservation/get').then((data) => {
            TransporationReservationDataManager.data = data;
        });

        $.get('/api/transportation/get').then((data) => {
            TransportationDataManager.data = data;
            TransportationTableManager.draw(TransportationDataManager.data);
        });

        var TransportationTableManager = {
            table: $('.transportation'),
            row: $($('.transportation tbody tr').get(0)),
            draw(transporations) {
                this.clear();
                for (var i = 0; i < transporations.length; i += 1) {
                    var transportation = transporations[i];
                    var clone = this.row.clone();
                    var cycle = JSON.parse(transportation.cycle);
                    var rest = JSON.parse(transportation.rest);
                    clone.attr('data-idx', transportation.id);
                    clone.find('.transportation__name').text(transportation.name);
                    clone.find('.transportation__description').text(transportation.description);
                    clone.find('.transportation__price').text(`${transportation.price}원`);
                    clone.find('.transportation__cycle').text(`${transportation.interval}분`);
                    clone.find('.transportation__time').text(`${cycle[0]} ~ ${cycle[1]}`);
                    clone.find('.transportation__rest').text(RestFilter.getAll(rest).join(', '));
                    this.table.find('tbody').append(clone);
                }
            },
            clear() {
                this.table.find('tbody').html('');
            },
        };

        var RestFilter = {
            data: ['일', '월', '화', '수', '목', '금', '토'],
            get(index) {
                return this.data[index] || null;
            },
            getAll(arr) {
                var result = [];
                for (var i = 0; i < arr.length; i += 1) {
                    result.push(RestFilter.get(arr[i]));
                }
                return result;
            },
        };

        var ReservationDialogManager = {
            target: $('.reservation-dialog'),
            init() {
                this.target.dialog({
                    modal: true,
                    title: '예약',
                    width: 550,
                    height: 550,
                    open() {
                        $('input').blur();
                    },
                    close() {
                        ReservationDialogManager.clear();
                    },
                });
                this.target.dialog('close');
            },
            show(flag) {
                flag ? this.target.dialog('open') : this.target.dialog('close');
            },
            setPrice(price) {
                this.target.find('.reservation__price').text(`${price}원`);
            },
            clear() {
                $('#reservationForm')[0].reset();
                this.target.find('.reservation__price').text('0원');
            },
        };

        var PriceManager = {
            get(price, data) {
                var result = (price * data.adult) + (price * 0.6 * data.kid);
                var oldPercent = (price <= 100000 && price > 20000) ? 0.5 : (price > 100000) ? 0.8 : 0;
                result += (price * oldPercent * data.old);

                return result;
            },
        };

        var ReservationManager = {
            ableCount: 0,
            submit(formData) {
                var adultCount = formData.get('adult') * 1;
                var kidCount = formData.get('kid') * 1;
                var oldCount = formData.get('old') * 1;
                var sumCount = adultCount + kidCount + oldCount;
                var message = '';

                if (sumCount <= 0) message += '최소한 한 명 이상 탑승해야 합니다.';
                if (sumCount > this.ableCount) message += '남은 인원 수보다 더 많은 인원은 예약이 불가능합니다!';

                if (message) {
                    alert(message);
                    return;
                }
            },
        };

        var SpinnerManager = {
            init() {
                $('#adultCount, #kidCount, #oldCount').spinner({
                    min: 0,
                    value: 0,
                    stop() {
                        var obj = {
                            adult: $('#adultCount').val(),
                            kid: $('#kidCount').val(),
                            old: $('#oldCount').val(),
                        };
                        var price = PriceManager.get(currentTransportation.price, obj);
                        ReservationDialogManager.setPrice(price);
                    },
                });
            },
        };

        var DatepickerManager = {
            target: $('.reservation__datepicker'),
            selected: null,
            init() {
                this.target.datepicker({
                    minDate: new Date(),
                    onSelect(date) {
                        var timeList = TransportationDataManager.getTimeList(currentTransportation);
                        var timeListFormat = [];
                        DatepickerManager.selected = new Date(date);
                        for (var i = 0; i < timeList.length; i += 1) {
                            var format = DateManager.timeFormat(timeList[i]);
                            var countPeople = TransporationReservationDataManager.getCountByDateWithTime(currentTransportation.id, new Date(date), format);
                            var disabled = countPeople >= currentTransportation.limit;
                            // TODO: 이거 disabled 제한 걸 것.
                            timeListFormat.push({ time: format, disabled });
                        }
                        TimeComboboxManager.addItems(timeListFormat);
                    },
                });
            },
            setDisabledDate(data) {
                this.target.datepicker('option', 'beforeShowDay', (date) => {
                    var rest = data.rest || [];
                    var reservations = data.reservations;
                    var currentDay = date.getDay();
                    var flag = false;
                    var zeroDate = DateManager.setZeroTime(date);

                    for (var i = 0; i < reservations.length; i += 1) {
                        var reservation = reservations[i];
                        var since = reservation[0] || null;
                        var until = reservation[1] || null;

                        if (since && until) {
                            since = DateManager.setZeroTime(since);
                            until = DateManager.setZeroTime(until);
                            if (zeroDate >= new Date(since) && zeroDate <= new Date(until)) {
                                flag = true;
                                break;
                            }
                        }
                    }

                    if (rest.indexOf(currentDay) > -1 || !flag) flag = false;
                    return [flag];
                });
            },
        };

        var DateManager = {
            setZeroTime(date) {
                date = new Date(date);
                date.setHours(0, 0, 0, 0);
                return date;
            },
            pad(number) {
                return `${number}`.padStart(2, '0');
            },
            format(date) {
                var month = this.pad(date.getMonth() + 1);
                var days = this.pad(date.getDate());
                return `${date.getFullYear()}-${month}-${days}`;
            },
            getOnlyTime(time) {
                var standard = this.getStandardDate();
                var timePart = time.split(':');
                var hours = timePart[0] || 0;
                var minutes = timePart[1] || 0;
                var seconds = timePart[2] || 0;
                standard.setHours(hours, minutes, seconds);
                return standard;
            },
            getStandardDate() {
                return new Date('1970-01-01 00:00:00');
            },
            addMinutes(date, minutes) {
                return new Date(new Date(date) + (minutes * 1000 * 60));
            },
            timeFormat(date) {
                var hours = `${date.getHours()}`.padStart(2, '0');
                var minutes = `${date.getMinutes()}`.padStart(2, '0');
                return `${hours}:${minutes}`;
            },
        };

        var TimeComboboxManager = {
            target: $('.reservation__time-combobox'),
            addItems(items) {
                this.clear();
                for (var i = 0; i < items.length; i += 1) {
                    var item = items[i];
                    var time = item.time;
                    var disabled = item.disabled;
                    var option = document.createElement('option');
                    option.setAttribute('value', time);
                    option.setAttribute('label', time);
                    if (disabled) option.setAttribute('disabled', true);
                    this.target.append(option);
                    if (this.target.find('option').length > 0) this.activate(true);
                }
            },
            clear() {
                this.target.find('option').remove();
                if (this.target.find('option').length <= 0) this.activate(false);
            },
            activate(flag) {
                this.target.prop('disabled', !flag);
            },
        };

        DatepickerManager.init();
        SpinnerManager.init();
        ReservationDialogManager.init();

        on('click', '.transportation tbody tr', (e) => {
            var target = $(e.currentTarget);
            var transportationId = target.data('idx');
            var transportation = TransportationDataManager.get(transportationId);
            ReservationDialogManager.show(true);
            currentTransportation = transportation;
            currentTransportationReservations = TransporationReservationDataManager.getByTransportation(currentTransportation.id);

            var beforeShowDayOptions = {
                rest: currentTransportation.rest,
                reservations: ReservationDataManager.getDates(),
            };
            DatepickerManager.setDisabledDate(beforeShowDayOptions);
            TimeComboboxManager.clear();
        });

        on('submit', '#reservationForm', (e) => {
            e.preventDefault();
            var formData = new FormData(e.currentTarget);
            ReservationManager.submit(formData);
        });

        on('change', '.reservation__time-combobox', (e) => {
            var target = $(e.currentTarget);
            var selectedTime = target.val();
            var selectedDate = DatepickerManager.selected;
            var countPeople = TransporationReservationDataManager.getCountByDateWithTime(currentTransportation.id, selectedDate, selectedTime);
            var ableCount = currentTransportation.limit - countPeople; // 예약 가능한 사람 수
            ReservationManager.ableCount = ableCount;
        });
    })();
</script>