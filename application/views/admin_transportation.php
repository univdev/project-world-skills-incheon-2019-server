<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>관리자 - 교통편 예약</title>
    <link rel="stylesheet" href="common/css/admin_transportation.css">
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
                <li class="--active">
                    <a href="admin_transportation.html">교통편 관리</a>
                </li>
                <li>
                    <a href="admin_venue_manager.html">행사장 임대 관리</a>
                </li>
                <li>
                    <a href="admin_transportation_manager.html">교통편 임대 관리</a>
                </li>
            </ul>
        </div>
        <div class="admin-content">
            <div class="title">교통편 임대 관리</div>
            <table class="list">
                <thead>
                    <tr>
                        <th style="width: 150px">대표 이미지</th>
                        <th style="width: 500px">관련 정보</th>
                        <th style="width: 150px">관리</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="list__thumbnail-container">
                            <img alt="" class="list__thumbnail">
                        </td>
                        <td>
                            <div class="list__detail-row list__festival-name-row">
                                <div class="detail__title">교통편 이름</div>
                                <div class="detail__content">고속버스</div>
                            </div>
                            <div class="list__detail-row list__venue-name">
                                <div class="detail__title">교통편 소개</div>
                                <div class="detail__content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum maxime asperiores debitis quod voluptas voluptatem dignissimos blanditiis</div>
                            </div>
                            <div class="list__detail-row list__venue-name">
                                <div class="detail__title">운임</div>
                                <div class="detail__content">&#x20A9;10,000</div>
                            </div>
                        </td>
                        <td class="list__control">
                            <button class="list__control-delete-button button">삭제</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>