<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title></title>
    <link rel="stylesheet" href="{{"/common/css/base.css"}}">
    <link rel="stylesheet" href="{{"/Pages/Components/Header/styles.css"}}"/>
    <link rel="stylesheet" href="{{"/Pages/Statistic/StatisticGeneral/styles.css"}}"/>
</head>
<body onLoad="load()">
<!--------------HEADER-------------------->
@include('Components.Header.Header')
<!--------------/HEADER-------------------->
<div class="diagram">
    @foreach($diagramData as $item)
            <button class="button " name="interviewColumn" id="button" onclick="test('{{route('login')}}')">
                <div hidden id="points">{{$item->count}}</div>
                <div class="rating__nextlevel__progress">
                    <div class="progress-bar">
                        <div class="percent-count"></div>
                    </div>
                </div>
            </button>
    @endforeach
</div>
</body>
<script>
    function test(route) {
        window.location = route
    }

    function load() {
        const x = document.getElementsByName("interviewColumn")
        for (i = 0; i < x.length; i++) {
            const nextLevel = x[i].querySelector('.rating__nextlevel__progress');
            const progress = nextLevel.querySelector('.progress-bar');
            const percent = progress.querySelector('.percent-count');
            const result = x[i].querySelector('#points').textContent
            setTimeout(() => {
                progress.style.opacity = 1;
                progress.style.height = result + '%';
                percent.textContent = Math.round(result) + '%';
            })

        }
    }

    // const progress = document.querySelector('.progress-bar');
    // let percent = document.querySelector('.percent-count');
    // let result = document.getElementById('points').textContent
    // setTimeout(() => {
    //     progress.style.opacity = 1;
    //     progress.style.height = result + '%';
    //     percent.textContent = Math.round(result) + '%';
    // })
</script>
</html>
