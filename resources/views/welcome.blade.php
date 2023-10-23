<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        .cfont {
            font-family: 'Anton', sans-serif;
        }

        input[type="time"]::-webkit-calendar-picker-indicator {
            filter: invert(48%) sepia(13%) saturate(3207%) hue-rotate(130deg) brightness(95%) contrast(80%);
        }
    </style>


</head>

<body class="bg-gray-700">
    <div id="root" class="relative bg-gray-800 container m-auto p-8 text-center min-h-screen flex flex-col items-center">
        <div class="flex items-center">
            <span class="cfont text-3xl bg-amber-400 py-[0.1rem] px-2 rounded"> IMDb TOOLs</span>
        </div>

        <form class="mt-[15vh] p-5 flex flex-col items-center justify-center" method="POST">
            <input type="url" v-model="url" placeholder="URL IMDb" autocomplete="off" autofocus class="p-2 mb-1 rounded-t-md bg-slate-900 text-slate-300" />
            <input type="time" v-model="startTime" class="p-2 mb-1 bg-slate-900 text-slate-300 min-w-[215px] max-w-[269px] w-full inline-block">

            <input type="text" v-model="next" placeholder="A seguir:" class="p-2 rounded-b-md bg-slate-900 text-slate-300" />

            <input type="button" value="Gerar comando" @click="generateCommand()" class="mt-5 p-3 bg-slate-900 hover:bg-slate-700 focus:ring font-bold text-slate-300 font-mono rounded-lg" />

            <span :class="{ 'hidden' : !loading }" class="mt-10">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </span>



            <div @click="copyDoubleClick" id="clipboard" ref="clipboard" :class="{ 'hidden' : !showGeneratedCommand }" class="relative bg-slate-700 rounded mt-10 max-w-sm p-2 text-cyan-400 hover:cursor-pointer">
                <div :class="{'blur' : showCopied}" class="w-full h-full">
                    <span v-text="info.title"></span>
                    (<span v-text="info.year"></span>)
                    (IMDb:
                    <span v-text="info.rating"></span>
                    ) | Categoria:
                    <span v-text="info.genres"></span>
                    | Duração:
                    <span v-text="info.runtime"></span>
                    | Começou: <span v-text="startTime"></span> | Classificação:
                    <span v-text="info.rated"></span> anos <span v-if="next != ''">| A Seguir: <span v-text="next"></span></span></span>
                </div>
                <span :class="{'invisible' : !showCopied, 'animate-fade-in' : showCopied, 'animate-fade-out' : outAnimation}" class="absolute select-none left-0 top-0 bg-opacity-20 w-full h-full flex justify-center items-center rounded bg-black text-xl">Texto copiado!</span>
                <span v-text="errorMessage" :class="{'invisible' : !showError}" class="absolute select-none left-0 top-0 flex justify-center items-center rounded bg-rose-800 text-xl h-full w-full"></span>

            </div>
        </form>
        <div class="absolute right-1 bottom-0 text-white font-mono cursor-pointer">
            <a href="https://github.com/RC0D3/" target="_blank">Created By:RC0D3</a>
        </div>
    </div>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue@2.1.3/dist/vue.js"></script>

    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>