<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>관리자 - 행사장 임대 목록</title>
    <link rel="stylesheet" href="common/css/admin_venue_manager.css">
</head>
<body>
    <div id="wrap">
        <div class="admin-header">
            <div class="admin-header__upper">
                <div class="logo">Bexco 관리자</div>
                <a href="#"><button class="logout-button">메인으로 돌아가기</button></a>
            </div>
            <ul class="admin-header__downer">
                <li>
                    <a href="admin_venue.html">행사장 관리</a>
                </li>
                <li>
                    <a href="admin_transportation.html">교통편 관리</a>
                </li>
                <li class="--active">
                    <a href="admin_venue_manager.html">행사장 임대 관리</a>
                </li>
                <li>
                    <a href="admin_transportation_manager.html">교통편 임대 관리</a>
                </li>
            </ul>
        </div>
        <div class="admin-content">
            <div class="title">행사장 임대 관리</div>
            <table class="list">
                <thead>
                    <tr>
                        <th style="width: 150px">대표 이미지</th>
                        <th style="width: 500px">관련 정보</th>
                        <th style="width: 150px">예약자</th>
                        <th style="width: 150px">예약일자</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="list__thumbnail-container">
                            <img alt="" class="list__thumbnail">
                        </td>
                        <td>
                            <div class="list__detail-row list__festival-name-row">
                                <div class="detail__title">개최 행사 이름</div>
                                <div class="detail__content">행사</div>
                            </div>
                            <div class="list__detail-row list__venue-name">
                                <div class="detail__title">임대한 행사장 이름</div>
                                <div class="detail__content">제 1 행사장</div>
                            </div>
                            <div class="list__detail-row list__festival-date">
                                <div class="detail__title">개최 기간</div>
                                <div class="detail__content">2019.07.30 ~ 2019.10.05</div>
                            </div>
                        </td>
                        <td class="list__user">예약자 이름 (예약자 아이디)</td>
                        <td class="list__created-at">2019.07.30</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>