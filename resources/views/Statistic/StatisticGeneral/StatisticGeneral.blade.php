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
        <div class="interviewColumn" name="interviewColumn">
            <button class="button " id="button" onclick="test('{{route('StatisticConcrete',$item->id)}}')">
                <div hidden id="points">{{$item->count}}</div>
                <div class="rating__nextlevel__progress">
                    <div class="progress-bar ">
                        <div class="percent-count"></div>
                    </div>
                </div>
            </button>
            <div class="dateField">{{$item->created_at->format('d.m.y')}}</div>
        </div>
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
            const button = x[i].querySelector('#button');
            const result = button.querySelector('#points').textContent
            const nextLevel = button.querySelector('.rating__nextlevel__progress');
            const progress = nextLevel.querySelector('.progress-bar');
            const percent = progress.querySelector('.percent-count');
            progress.style.opacity = 1;
            if (result !== "0") {
                setTimeout(() => {
                    progress.classList.add('orange')

                    progress.style.height = result + '%';
                    percent.textContent = Math.round(result) + '%';
                })
            } else {
                progress.classList.add('gray')
                progress.style.height = '100%';
                percent.textContent =  '0%';
            }


        }
    }

</script>
</html>
