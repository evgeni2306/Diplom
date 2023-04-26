<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{"/common/css/base.css"}}">
    <link rel="stylesheet" href="{{"/Pages/Components/Header/styles.css"}}"/>
    <link rel="stylesheet" href="{{"/Pages/Statistic/StatisticGeneral/styles.css"}}"/>
    <title>Статистика {{$professionName}}</title>
</head>
<body onLoad="load()">
<!--------------HEADER-------------------->
@include('Components.Header.Header')
<!--------------/HEADER-------------------->
<div class="container">
    <h1 class="container__title">Ваша статистика по профессии : {{$professionName}}</h1>
    <div class="generalSector">
        <div class="progressSector">
            <div class="progressBlock">
                <div class="progressBlock-string">
                    <div>Верно пройденных от общего количества вопросов</div>
                    <div hidden class="points">{{$generalData}}%</div>
                </div>
                <div class="progress">
                    <div class="progressBar">
                        {{$generalData}}%
                    </div>
                </div>
            </div>
        </div>


        <div class="diagramSector">
            <div class="diagramSector-text">
                <div>Прогресс по прохождению</div>
                <div>Нажмите на определенную колонку и посмотрите результаты за эту симуляцию</div>
            </div>
            <div class="diagramBlock">
                <div class="simulationCount">10 последних симуляций</div>
                <div class="diagramZone">
                    @foreach($diagramData as $item)
                        <div class="interviewColumn" name="interviewColumn">
                            <button class="button" id="button"
                                    onclick="test('{{route('StatisticConcrete',$item->id)}}')">
                                <div hidden id="interviewPoints">{{$item->count}}</div>
                                <div class="interviewProgress">
                                    <div class="interviewProgressBar">
                                        <div class="interviewPercentCount"></div>
                                    </div>
                                </div>
                            </button>
                            <div class="dateField">{{$item->created_at->format('d.m.y')}}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="categoryDiagramSector">
            <div class="categoryTitle">Прогресс по темам</div>
            <div class="categoryDiagramZone">
                @foreach($categoryData as $item)
                    <div class="categoryBlock">
                        <div class="categoryName">{{$item->name}}</div>
                        <div class="categoryDiagramBlock">
                            <div class="categoryDiagram progress" data-percent={{$item->correctCount}}>
                                <div class="piece left"></div>
                                <div class="piece right"></div>
                                <div class="text">
                                    <div>
                                        <b>{{$item->count}}</b>
                                        <span>{{trans_choice('Вопрос|Вопроса|Вопросов',$item->count)}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
</div>
</body>
<script>
    function test(route) {
        window.location = route
    }

    function load() {
        generalDiagram()
        interviewDiagram()
        categoryProgressView();
    }

    function generalDiagram() {
        let points = {{$generalData}};
        const progress = document.querySelector('.progressBar');
        setTimeout(() => {
            progress.style.opacity = 1;
            progress.style.width = points + '%';
        })
    }

    function interviewDiagram() {
        const x = document.getElementsByName("interviewColumn")
        for (i = 0; i < x.length; i++) {
            const button = x[i].querySelector('#button');
            const result = button.querySelector('#interviewPoints').textContent
            const nextLevel = button.querySelector('.interviewProgress');
            const progress = nextLevel.querySelector('.interviewProgressBar');
            const percent = progress.querySelector('.interviewPercentCount');
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
                percent.textContent = '0%';
            }


        }
    }

    function categoryProgressView() {
        let diagramBox = document.querySelectorAll('.categoryDiagram.progress');
        diagramBox.forEach((box) => {
            let deg = (360 * box.dataset.percent / 100) + 180;
            if (box.dataset.percent >= 50) {
                box.classList.add('over_50');
            } else {
                box.classList.remove('over_50');
            }
            box.querySelector('.piece.right').style.transform = 'rotate(' + deg + 'deg)';
        });
    }


</script>
</html>
