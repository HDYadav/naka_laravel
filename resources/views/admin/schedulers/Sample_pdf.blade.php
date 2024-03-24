<!DOCTYPE html>
<html>

<head>
    <title>Schedule {{$month}}</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            margin-top: 20px;
        }

        table tr th,
        table tr td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        table tr th {
            background-color: #2f75b5;
            color: white;
        }
    </style>
</head>

<body>
    <table class="table table-bordered table-schedule">
        <tbody>
            <tr style="color:#fce4d6">
                <th colspan="4">Word of God - List (Speakers list) - {{$month}}</th>
            </tr>
        </tbody>
    </table>
    <?php
    $z = 0;
    ?>

    @foreach ($days as $key => $day)
    <?php
    $i = 1;
    $usersCitys = getSchedular($day->id);
    $x = array();
    ?>

    <table class="table table-bordered table-schedule">
        <thead>
            <tr>
                <th>Sr. No</th>
                <th>Date</th>
                <th>Place</th>
                <th>Speaker</th>
            </tr>
        </thead>
        @foreach ($usersCitys as $key => $usersCity)
        <tbody>
            <tr style="<?php if($z%2==0){echo "background-color:#f2f8ee";}else {
                            echo "background-color:#fff3ff";}?>">
                <td>{{$i}} </td>
                <td style="border: none;">
                    @if ($i == 6)
                    {{$day->date}}

                    @endif
                </td>
                <td>{{@$usersCity->city_name}}</td>
                <td>{{@$usersCity->name}}</td>
            </tr>
            <?php

            $i++;
            $x[] = $i;
            ?>
            @endforeach
        </tbody>
    </table>
    <?php $z++; ?>
    @endforeach
</body>

</html>