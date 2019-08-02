        <div class="title-section">
            <div class="title-section__text">
                <div class="title-section__title">행사장 임대</div>
                <div class="title-section__description">행사장을 임대할 수 있는 페이지입니다.</div>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <table class="placements">
                    <thead>
                        <tr>
                            <th style="width: 140px">행사장 사진</th>
                            <th style="width: 200px">행사장 이름</th>
                            <th>행사장 소개</th>
                            <th style="width: 200px">임대료</th>
                            <th style="width: 200px">휴무일</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="placement">
                            <td>
                                <div class="placement__frame"></div>
                            </td>
                            <td class="placement__title">

                            </td>
                            <td>
                                <div class="placement__info-row">
                                    <div class="placement__info-title">설명</div>
                                    <div class="placement__description"></div> 
                                </div>
                                <div class="placement__info-row">
                                    <div class="placement__score"></div> 
                                </div>
                            </td>
                            <td class="placement__price">

                            </td>
                            <td class="placement__rest">

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <div class="reservation-dialog">
        <h2 class="reservation__name">행사장 이름</h2>
        <div class="reservation__datepicker-row">
            <input type="text" class="start-datepicker reservation__datepicker" placeholder="시작일"> ~ 
            <input type="text" class="end-datepicker reservation__datepicker" placeholder="종료일">
        </div>
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
        function on(event, target, callback) {
            $(document).on(event, target, callback);
        }

        var reservations = [];
        var placements = [];
        var currentPlacement = {};
        var currentPlacementReservations = [];

        $(document).tooltip();

        $.get('/api/reservation/get').then((data) => {
            reservations = data;
            return $.get('/api/placement/get');
        }).then((data) => {
            placements = data;
            PlacementTableManager.draw(placements);
        });

        var PlacementTableManager = {
            table: '.placements',
            thead: '.placements thead',
            tbody: '.placements tbody',
            row: $('.placements tbody tr').get(0),
            draw(placements) {
                this.clear();
                for (var i = 0; i < placements.length; i += 1) {
                    var placement = placements[i];
                    var clone = $(this.row).clone();

                    var id = placement.id;
                    var name = placement.name;
                    var score = placement.score;
                    var description = placement.description;
                    var price = placement.price;
                    var rest = JSON.parse(placement.rest) || [];
                    var image = placement.image;
                    var restKor = [];
                    rest.forEach((index) => { restKor.push(RestFilter.get(index)); });

                    clone.attr('data-idx', id);
                    clone.find('.placement__frame').css('background-image', `url(${`images/${image}`})`);
                    clone.find('.placement__title').text(name);
                    clone.find('.placement__description').text(description);
                    clone.find('.placement__price').text(`${price}원`);
                    clone.find('.placement__score').text(`${score}점`);
                    clone.find('.placement__rest').text(restKor.join(', '));
                    $(this.tbody).append(clone);
                }
            },
            clear() {
                $(this.tbody).html('');
            },
        };

        var RestFilter = {
            data: ['일', '월', '화', '수', '목', '금', '토'],
            get(index) {
                return this.data[index] || null;
            },
        };

        var ReservationDialogManager = {
            target: $('.reservation-dialog'),
            init() {
                this.target.dialog({
                    title: '예약',
                    modal: true,
                    width: 500,
                    height: 150,
                    open() {
                        $('input').blur();
                    },
                });
                this.target.dialog('close');
            },
            visible(flag) {
                flag ? this.target.dialog('open') : this.target.dialog('close');
            },
            setTitle(title) {
                this.target.find('.reservation__name').text(title);
            },
        };
        ReservationDialogManager.init();

        var DatepickerManager = {
            startTarget: $('.start-datepicker'),
            endTarget: $('.end-datepicker'),
            init() {
                this.startTarget.datepicker({ dateFormat: 'yy-mm-dd' }).on('change', (date) => {
                    this.setEndDatepickerLimit(this.startTarget.val());
                });
                this.endTarget.datepicker({ dateFormat: 'yy-mm-dd' }).on('change', (date) => {
                    this.setStartDatepickerLimit(this.endTarget.val());
                });
                this.startTarget.datepicker('setDate', null);
                this.endTarget.datepicker('setDate', null);
                this.startTarget.datepicker('option', 'minDate', new Date());
                this.startTarget.datepicker('option', 'maxDate', null);
                this.endTarget.datepicker('option', 'minDate', new Date());
                this.endTarget.datepicker('option', 'maxDate', null);
            },
            setStartDatepickerLimit(date) {
                var recentlyReservationDate = ReservationDataManager.getRecentlyUntil(date);
                this.startTarget.datepicker('option', 'minDate', recentlyReservationDate);
                this.startTarget.datepicker('option', 'maxDate', date);
            },
            setEndDatepickerLimit(date) {
                var recentlyReservationDate = ReservationDataManager.getRecentlySince(date);
                this.endTarget.datepicker('option', 'minDate', date);
                this.endTarget.datepicker('option', 'maxDate', recentlyReservationDate);
            },
            setRest(reservations) {
                var callback = (date) => {
                    var rest = currentPlacement.rest;
                    var flag = true;
                    var day = date.getDay();

                    for (let i = 0; i < reservations.length; i += 1) {
                        var since = new Date(reservations[i].since);
                        var until = new Date(reservations[i].until);
                        since.setHours(0, 0, 0, 0); // 기존 9시로 설정된 날짜를 0시로 변경
                        until.setHours(0, 0, 0, 0); // 기존 9시로 설정된 날짜를 0시로 변경

                        if (rest.indexOf(day) > -1) {
                            flag = false;
                            break;
                        }

                        if (date.getTime() >= since.getTime() && date.getTime() <= until.getTime() && flag) {
                            flag = false;
                            break;
                        }
                    }
                    return [flag];
                };

                this.startTarget.datepicker('option', 'beforeShowDay', callback);
                this.endTarget.datepicker('option', 'beforeShowDay', callback);
            },
        };
        DatepickerManager.init();

        var ReservationDataManager = {
            get(index) {
                return reservations[index] || null;
            },
            getByPlacement(placement) {
                var result = [];
                for (let i = 0; i < reservations.length; i += 1) {
                    if (reservations[i].placement === placement) result.push(reservations[i]);
                }
                return result;
            },
            getRecentlySince(date) {
                var standard = new Date(date);
                var result = Infinity;
                standard.setHours(0, 0, 0, 0);
                for (var i = 0; i < currentPlacementReservations.length; i += 1) {
                    var reservation = currentPlacementReservations[i];
                    var since = new Date(reservation.since);
                    if (since > standard && since < result) result = since;
                }
                return result || standard;
            },
            getRecentlyUntil(date) {
                var standard = new Date(date);
                var result = -Infinity;
                standard.setHours(0, 0, 0, 0);
                for (var i = 0; i < currentPlacementReservations.length; i += 1) {
                    var reservation = currentPlacementReservations[i];
                    var until = new Date(reservation.until);
                    if (until < standard && until > result) result = until;
                }
                return result || standard;
            },
        };

        var PlacementDataManager = {
            get(index) {
                return placements[index];
            },
            getById(index) {
                var result = null;
                for (let i = 0; i < placements.length; i += 1) {
                    if (placements[i].id == index) {
                        result = placements[i];
                        break;
                    }
                }
                return result;
            },
        };

        on('click', `${PlacementTableManager.tbody} tr`, (e) => {
            var target = $(e.currentTarget);
            currentPlacement = PlacementDataManager.getById(target.data('idx'));
            currentPlacementReservations = ReservationDataManager.getByPlacement(currentPlacement.id);
            ReservationDialogManager.visible(true);
            ReservationDialogManager.setTitle(currentPlacementReservations.name);
            DatepickerManager.setRest(currentPlacementReservations);
            DatepickerManager.init();
        });
    </script>