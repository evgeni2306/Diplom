<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title></title>
    <link rel="stylesheet" href="{{"/common/css/base.css"}}">
    <link rel="stylesheet" href="{{"/Pages/Components/Header/styles.css"}}"/>
    <link rel="stylesheet" href="{{"/Pages/Statistics/Main/styles.css"}}"/>
</head>
<body>
<!--------------HEADER-------------------->
@include('Components.Header.Header')
<!--------------/HEADER-------------------->
prjvet
<button class="button" onclick="test()">
    <div class="rating__nextlevel__progress">

        <div class="progress-bar">

            <div class="percent-count"></div>

        </div>

    </div>
</button>
</body>
<script>
    function test(){
        console.log('prjvet')
    }

    let points = 34
    let target = 100
    const progress = document.querySelector('.progress-bar');
    let percent = document.querySelector('.percent-count');
    let result = (points * 100) / target;
    setTimeout(() => {
        progress.style.opacity = 1;
        progress.style.width = result + '%';
        percent.textContent = Math.round(result) + '%';
    })
</script>
</html>
